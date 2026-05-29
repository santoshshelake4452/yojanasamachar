<?php

error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('log_errors', 1);
require_once __DIR__ . '/../includes/config.php';

header('Content-Type: application/json; charset=utf-8');
ob_start();
// =============================================
// api/api.php – Central API handler
// All AJAX calls from index.html hit this file
// =============================================


header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, DELETE');
header('Access-Control-Allow-Headers: Content-Type');

$sessionId = getSessionId();
$db        = getDB();
$action    = $_GET['action'] ?? $_POST['action'] ?? '';

// ── Route ──────────────────────────────────
switch ($action) {

    // ─────────────────────────────────────────
    // SCHEMES
    // ─────────────────────────────────────────
    case 'get_schemes':
        getSchemes($db);
        break;

    case 'add_scheme':
        verifyAdmin();
        addScheme($db);
        break;

    case 'delete_scheme':
        verifyAdmin();
        deleteScheme($db);
        break;

    // ─────────────────────────────────────────
    // PROFILE
    // ─────────────────────────────────────────
    case 'save_profile':
        saveProfile($db, $sessionId);
        break;

    case 'get_profile':
        getProfile($db, $sessionId);
        break;

    // ─────────────────────────────────────────
    // SAVED SCHEMES
    // ─────────────────────────────────────────
    case 'toggle_save':
        toggleSave($db, $sessionId);
        break;

    case 'get_saved':
        getSaved($db, $sessionId);
        break;

    // ─────────────────────────────────────────
    // RECENTLY VIEWED
    // ─────────────────────────────────────────
    case 'record_view':
        recordView($db, $sessionId);
        break;

    case 'get_recent':
        getRecent($db, $sessionId);
        break;

    case 'clear_recent':
        clearRecent($db, $sessionId);
        break;

    // ─────────────────────────────────────────
    // ADMIN AUTH
    // ─────────────────────────────────────────
    case 'verify_admin':
        verifyAdminCode();
        break;

    default:
        jsonErr('Unknown action: ' . $action);
}

// ══════════════════════════════════════════════
// FUNCTIONS – SCHEMES
// ══════════════════════════════════════════════

function getSchemes(mysqli $db): void {
    $cat    = $_GET['cat']    ?? 'all';
    $search = trim($_GET['q'] ?? '');

    // Build WHERE clause
    $where  = [];
    $params = [];
    $types  = '';

    if ($cat !== 'all') {
        $where[]  = 's.cat = ?';
        $params[] = $cat;
        $types   .= 's';
    }

    if ($search !== '') {
        $like     = "%{$search}%";
        $where[]  = '(s.title LIKE ? OR s.description LIKE ? OR s.badge LIKE ? OR s.benefit LIKE ?)';
        $params   = array_merge($params, [$like, $like, $like, $like]);
        $types   .= 'ssss';
    }

    $sql = 'SELECT s.*, GROUP_CONCAT(DISTINCT e.item ORDER BY e.id SEPARATOR "||") AS eligibility,
                   GROUP_CONCAT(DISTINCT CONCAT(d.id,":",d.item) ORDER BY d.id SEPARATOR "||") AS documents,
                   GROUP_CONCAT(DISTINCT CONCAT(st.step_no,":",st.item) ORDER BY st.step_no SEPARATOR "||") AS steps
            FROM schemes s
            LEFT JOIN eligibility e  ON e.scheme_id  = s.id
            LEFT JOIN documents d    ON d.scheme_id  = s.id
            LEFT JOIN steps st       ON st.scheme_id = s.id';

    if ($where) {
        $sql .= ' WHERE ' . implode(' AND ', $where);
    }
    $sql .= ' GROUP BY s.id ORDER BY s.id DESC';

    $stmt = $db->prepare($sql);
    if ($params) {
        $stmt->bind_param($types, ...$params);
    }
    $stmt->execute();
    $res = $stmt->get_result();

    $schemes = [];
    while ($row = $res->fetch_assoc()) {
        $schemes[] = [
            'id'           => (int)$row['id'],
            'cat'          => $row['cat'],
            'title'        => $row['title'],
            'desc'         => $row['description'],
            'benefit'      => $row['benefit'],
            'badge'        => $row['badge'],
            'deadline'     => $row['deadline'],
            'deadlineType' => $row['deadline_type'],
            'link'         => $row['link'],
            'is_custom'    => (bool)$row['is_custom'],
            'eligibility'  => $row['eligibility']
                ? explode('||', $row['eligibility'])
                : ['All eligible applicants'],
            'documents'    => parseNumbered($row['documents']),
            'steps'        => parseNumbered($row['steps']),
        ];
    }

    jsonOk(['schemes' => $schemes, 'total' => count($schemes)]);
}

// Strip "id:" prefix from GROUP_CONCAT'd numbered rows
function parseNumbered(?string $raw): array {
    if (!$raw) return [];
    return array_map(function ($item) {
        return preg_replace('/^\d+:/', '', $item);
    }, explode('||', $raw));
}

function addScheme(mysqli $db): void {
    $body = json_decode(file_get_contents('php://input'), true) ?? $_POST;

    $required = ['title','cat','badge','benefit','desc','deadline','deadlineType','link'];
    foreach ($required as $f) {
        if (empty($body[$f])) jsonErr("Field '{$f}' is required.");
    }

    $db->begin_transaction();
    try {
        $stmt = $db->prepare(
            'INSERT INTO schemes (cat,title,description,benefit,badge,deadline,deadline_type,link,is_custom)
             VALUES (?,?,?,?,?,?,?,?,1)'
        );
        $stmt->bind_param('ssssssss',
            $body['cat'], $body['title'], $body['desc'],
            $body['benefit'], $body['badge'],
            $body['deadline'], $body['deadlineType'], $body['link']
        );
        $stmt->execute();
        $schemeId = $db->insert_id;

        // Eligibility
        if (!empty($body['eligibility']) && is_array($body['eligibility'])) {
            $ei = $db->prepare('INSERT INTO eligibility (scheme_id,item) VALUES (?,?)');
            foreach ($body['eligibility'] as $item) {
                if (trim($item) === '') continue;
                $ei->bind_param('is', $schemeId, $item);
                $ei->execute();
            }
        }

        // Documents
        if (!empty($body['documents']) && is_array($body['documents'])) {
            $di = $db->prepare('INSERT INTO documents (scheme_id,item) VALUES (?,?)');
            foreach ($body['documents'] as $item) {
                if (trim($item) === '') continue;
                $di->bind_param('is', $schemeId, $item);
                $di->execute();
            }
        }

        // Steps
        if (!empty($body['steps']) && is_array($body['steps'])) {
            $si = $db->prepare('INSERT INTO steps (scheme_id,step_no,item) VALUES (?,?,?)');
            $no = 1;
            foreach ($body['steps'] as $item) {
                if (trim($item) === '') continue;
                $si->bind_param('iis', $schemeId, $no, $item);
                $si->execute();
                $no++;
            }
        }

        $db->commit();
        jsonOk(['id' => $schemeId, 'message' => 'Scheme added successfully.']);

    } catch (Exception $e) {
        $db->rollback();
        jsonErr('Failed to add scheme: ' . $e->getMessage(), 500);
    }
}

function deleteScheme(mysqli $db): void {
    $body = json_decode(file_get_contents('php://input'), true) ?? $_POST;
    $id   = (int)($body['id'] ?? $_GET['id'] ?? 0);
    if (!$id) jsonErr('Scheme ID required.');

    $stmt = $db->prepare('DELETE FROM schemes WHERE id = ?');
    $stmt->bind_param('i', $id);
    $stmt->execute();

    if ($stmt->affected_rows === 0) jsonErr('Scheme not found.', 404);
    jsonOk(['message' => 'Scheme deleted.']);
}

// ══════════════════════════════════════════════
// FUNCTIONS – PROFILE
// ══════════════════════════════════════════════

function saveProfile(mysqli $db, string $sessionId): void {
    $body = json_decode(file_get_contents('php://input'), true) ?? $_POST;

    $stmt = $db->prepare(
        'INSERT INTO users (session_id,name,age,state,category,role)
         VALUES (?,?,?,?,?,?)
         ON DUPLICATE KEY UPDATE
           name=VALUES(name), age=VALUES(age), state=VALUES(state),
           category=VALUES(category), role=VALUES(role)'
    );
    $name  = substr(trim($body['name']     ?? ''), 0, 100);
    $age   = $body['age']      ? (int)$body['age']  : null;
    $state = substr($body['state']    ?? '', 0, 60);
    $cat   = substr($body['category'] ?? '', 0, 20);
    $role  = substr($body['role']     ?? '', 0, 30);

    $stmt->bind_param('ssisss', $sessionId, $name, $age, $state, $cat, $role);
    $stmt->execute();

    jsonOk(['message' => 'Profile saved.']);
}

function getProfile(mysqli $db, string $sessionId): void {
    $stmt = $db->prepare('SELECT * FROM users WHERE session_id = ?');
    $stmt->bind_param('s', $sessionId);
    $stmt->execute();
    $row = $stmt->get_result()->fetch_assoc();

    jsonOk(['profile' => $row ?: null]);
}

// ══════════════════════════════════════════════
// FUNCTIONS – SAVED SCHEMES
// ══════════════════════════════════════════════

function toggleSave(mysqli $db, string $sessionId): void {
    $body     = json_decode(file_get_contents('php://input'), true) ?? $_POST;
    $schemeId = (int)($body['scheme_id'] ?? 0);
    if (!$schemeId) jsonErr('scheme_id required.');

    // Check if already saved
    $check = $db->prepare('SELECT id FROM saved_schemes WHERE session_id=? AND scheme_id=?');
    $check->bind_param('si', $sessionId, $schemeId);
    $check->execute();
    $exists = $check->get_result()->fetch_assoc();

    if ($exists) {
        $del = $db->prepare('DELETE FROM saved_schemes WHERE session_id=? AND scheme_id=?');
        $del->bind_param('si', $sessionId, $schemeId);
        $del->execute();
        jsonOk(['saved' => false]);
    } else {
        $ins = $db->prepare('INSERT IGNORE INTO saved_schemes (session_id,scheme_id) VALUES (?,?)');
        $ins->bind_param('si', $sessionId, $schemeId);
        $ins->execute();
        jsonOk(['saved' => true]);
    }
}

function getSaved(mysqli $db, string $sessionId): void {
    $stmt = $db->prepare(
        'SELECT s.id FROM saved_schemes ss
         JOIN schemes s ON s.id = ss.scheme_id
         WHERE ss.session_id = ?'
    );
    $stmt->bind_param('s', $sessionId);
    $stmt->execute();
    $res  = $stmt->get_result();
    $ids  = [];
    while ($row = $res->fetch_assoc()) $ids[] = (int)$row['id'];
    jsonOk(['saved_ids' => $ids]);
}

// ══════════════════════════════════════════════
// FUNCTIONS – RECENTLY VIEWED
// ══════════════════════════════════════════════

function recordView(mysqli $db, string $sessionId): void {
    $body     = json_decode(file_get_contents('php://input'), true) ?? $_POST;
    $schemeId = (int)($body['scheme_id'] ?? 0);
    if (!$schemeId) jsonErr('scheme_id required.');

    // Upsert – updates viewed_at on duplicate
    $stmt = $db->prepare(
        'INSERT INTO recently_viewed (session_id,scheme_id)
         VALUES (?,?)
         ON DUPLICATE KEY UPDATE viewed_at = CURRENT_TIMESTAMP'
    );
    $stmt->bind_param('si', $sessionId, $schemeId);
    $stmt->execute();

    // Keep only the last 10
    $trim = $db->prepare(
        'DELETE FROM recently_viewed
         WHERE session_id = ?
           AND scheme_id NOT IN (
             SELECT scheme_id FROM (
               SELECT scheme_id FROM recently_viewed
               WHERE session_id = ?
               ORDER BY viewed_at DESC
               LIMIT 10
             ) AS t
           )'
    );
    $trim->bind_param('ss', $sessionId, $sessionId);
    $trim->execute();

    jsonOk(['message' => 'Recorded.']);
}

function getRecent(mysqli $db, string $sessionId): void {
    $stmt = $db->prepare(
        'SELECT s.id, s.title, s.cat, s.badge, rv.viewed_at
         FROM recently_viewed rv
         JOIN schemes s ON s.id = rv.scheme_id
         WHERE rv.session_id = ?
         ORDER BY rv.viewed_at DESC
         LIMIT 10'
    );
    $stmt->bind_param('s', $sessionId);
    $stmt->execute();
    $res   = $stmt->get_result();
    $items = [];
    while ($row = $res->fetch_assoc()) {
        $items[] = [
            'id'        => (int)$row['id'],
            'title'     => $row['title'],
            'cat'       => $row['cat'],
            'badge'     => $row['badge'],
            'viewed_at' => $row['viewed_at'],
        ];
    }
    jsonOk(['recent' => $items]);
}

function clearRecent(mysqli $db, string $sessionId): void {
    $stmt = $db->prepare('DELETE FROM recently_viewed WHERE session_id = ?');
    $stmt->bind_param('s', $sessionId);
    $stmt->execute();
    jsonOk(['message' => 'History cleared.']);
}

// ══════════════════════════════════════════════
// ADMIN AUTH
// ══════════════════════════════════════════════

function verifyAdminCode(): void {
    $body = json_decode(file_get_contents('php://input'), true) ?? $_POST;
    $code = $body['code'] ?? '';
    if ($code === ADMIN_SECRET) {
        $_SESSION['is_admin'] = true;
        jsonOk(['message' => 'Access granted.']);
    } else {
        jsonErr('Invalid admin code.', 403);
    }
}

function verifyAdmin(): void {
    if (session_status() === PHP_SESSION_NONE) session_start();
    $body = json_decode(file_get_contents('php://input'), true) ?? [];
    $code = $body['admin_code'] ?? $_GET['admin_code'] ?? '';
    if ($code !== ADMIN_SECRET && empty($_SESSION['is_admin'])) {
        jsonErr('Admin access required.', 403);
    }
}