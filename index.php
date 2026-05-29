<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>YojanaSamachar – Goverment Schemes & Scholarships Portal</title>
<link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700&family=DM+Sans:ital,wght@0,300;0,400;0,500;1,400&display=swap" rel="stylesheet">
<style>
/* ══════════════════════════════════════════
   CSS CUSTOM PROPERTIES
══════════════════════════════════════════ */
:root {
  --bg:       #f4f1ea;
  --surface:  #fffef9;
  --surface2: #f0ede4;
  --border:   #d8d2c4;
  --accent:   #1a4f3a;
  --accent2:  #e8622a;
  --text:     #1a1916;
  --muted:    #7a7468;
  --blue:     #185fa5;
  --danger:   #b8341a;
  --warning:  #a86b0a;
}
*,*::before,*::after { box-sizing:border-box; margin:0; padding:0 }
body { font-family:'DM Sans',sans-serif; background:var(--bg); color:var(--text); min-height:100vh }

/* ── LOADING OVERLAY ── */
#appLoader {
  position:fixed; inset:0; z-index:9999;
  background:var(--accent);
  display:flex; flex-direction:column;
  align-items:center; justify-content:center; gap:16px;
  transition:opacity .4s;
}
#appLoader.hide { opacity:0; pointer-events:none }
.loader-logo { font-size:48px; animation:pulse 1.2s ease infinite }
.loader-text { font-family:'Sora',sans-serif; color:#fff; font-size:18px; font-weight:600; letter-spacing:-.3px }
.loader-sub  { color:rgba(255,255,255,.6); font-size:13px }
.loader-bar  { width:200px; height:3px; background:rgba(255,255,255,.2); border-radius:4px; overflow:hidden }
.loader-fill { height:100%; background:var(--accent2); border-radius:4px; animation:load 1.4s ease-in-out infinite }
@keyframes pulse { 0%,100%{transform:scale(1)} 50%{transform:scale(1.08)} }
@keyframes load   { 0%{width:0%} 100%{width:100%} }

/* ── HEADER ── */
header { background:var(--accent); position:sticky; top:0; z-index:200; box-shadow:0 2px 20px rgba(0,0,0,.15) }
.header-inner { max-width:1100px; margin:0 auto; padding:.9rem 2rem; display:flex; align-items:center; justify-content:space-between; gap:1rem }
.logo { display:flex; align-items:center; gap:12px }
.logo-icon { width:40px; height:40px; background:var(--accent2); border-radius:10px; display:flex; align-items:center; justify-content:center; font-size:20px }
.logo-text h1 { font-family:'Sora',sans-serif; font-size:18px; font-weight:700; color:#fff; letter-spacing:-.3px }
.logo-text p  { font-size:11px; color:rgba(255,255,255,.65); margin-top:1px }
.header-search { flex:1; max-width:400px; position:relative }
.header-search input { width:100%; padding:9px 16px 9px 40px; border-radius:8px; border:1px solid rgba(255,255,255,.2); background:rgba(255,255,255,.12); color:#fff; font-size:14px; font-family:'DM Sans',sans-serif; outline:none; transition:background .2s }
.header-search input::placeholder { color:rgba(255,255,255,.5) }
.header-search input:focus { background:rgba(255,255,255,.2) }
.header-search svg { position:absolute; left:12px; top:50%; transform:translateY(-50%); opacity:.6 }
.header-right { display:flex; align-items:center; gap:8px }
.scheme-count-badge { background:var(--accent2); color:#fff; font-size:12px; font-weight:600; padding:4px 12px; border-radius:20px; white-space:nowrap }
.hdr-btn { display:inline-flex; align-items:center; gap:6px; background:rgba(255,255,255,.12); color:#fff; border:1px solid rgba(255,255,255,.25); font-size:12px; font-weight:600; padding:6px 13px; border-radius:8px; cursor:pointer; font-family:'DM Sans',sans-serif; transition:background .2s; white-space:nowrap }
.hdr-btn:hover { background:rgba(255,255,255,.22) }
.profile-btn { position:relative; background:none; border:2px solid rgba(255,255,255,.4); border-radius:50%; width:36px; height:36px; cursor:pointer; overflow:hidden; flex-shrink:0; transition:border-color .2s }
.profile-btn:hover { border-color:#fff }
.avatar-circle { width:100%; height:100%; display:flex; align-items:center; justify-content:center; font-family:'Sora',sans-serif; font-weight:700; font-size:14px; color:#fff; background:rgba(255,255,255,.18) }
.profile-dot { position:absolute; bottom:0; right:0; width:10px; height:10px; background:#4cda64; border:2px solid var(--accent); border-radius:50% }

/* ── HERO ── */
.hero-strip { background:linear-gradient(135deg,#1a4f3a 0%,#0f3328 100%); padding:2.5rem 2rem; text-align:center; position:relative; overflow:hidden }
.hero-strip::before { content:''; position:absolute; inset:0; background:repeating-linear-gradient(45deg,transparent,transparent 40px,rgba(255,255,255,.02) 40px,rgba(255,255,255,.02) 80px) }
.hero-greeting { position:relative; margin-bottom:.5rem }
.hero-greeting span { display:inline-block; background:rgba(255,255,255,.12); border:1px solid rgba(255,255,255,.2); border-radius:20px; padding:4px 14px; font-size:12px; color:rgba(255,255,255,.85); margin-bottom:.6rem }
.hero-strip h2 { font-family:'Sora',sans-serif; font-size:28px; font-weight:700; color:#fff; margin-bottom:8px; position:relative }
.hero-strip .hero-sub { color:rgba(255,255,255,.7); font-size:15px; position:relative }
.stats-row { display:flex; justify-content:center; gap:2rem; margin-top:1.5rem; position:relative }
.stat strong { display:block; font-size:24px; font-weight:700; color:#fff; font-family:'Sora',sans-serif }
.stat span { font-size:12px; color:rgba(255,255,255,.6) }

/* ── RECENTLY VIEWED BAR ── */
.recently-bar { background:var(--surface); border-bottom:1px solid var(--border); display:none }
.recently-inner { max-width:1100px; margin:0 auto; padding:.75rem 2rem; display:flex; align-items:center; gap:12px }
.recently-label { font-size:11px; font-weight:600; text-transform:uppercase; letter-spacing:1px; color:var(--muted); white-space:nowrap; flex-shrink:0 }
.recently-chips { display:flex; gap:8px; overflow-x:auto; scrollbar-width:none; flex:1 }
.recently-chips::-webkit-scrollbar { display:none }
.recent-chip { display:inline-flex; align-items:center; gap:6px; background:var(--surface2); border:1px solid var(--border); border-radius:20px; padding:4px 12px; font-size:12px; font-weight:500; color:var(--text); white-space:nowrap; cursor:pointer; transition:background .15s; flex-shrink:0 }
.recent-chip:hover { background:#e4e0d8; border-color:#c8c2b4 }
.chip-dot { width:7px; height:7px; border-radius:50%; flex-shrink:0 }
.recently-clear { font-size:11px; color:var(--muted); background:none; border:none; cursor:pointer; padding:3px 8px; border-radius:6px; transition:background .15s; white-space:nowrap; flex-shrink:0 }
.recently-clear:hover { background:var(--surface2); color:var(--text) }

/* ── MAIN LAYOUT ── */
.main { max-width:1100px; margin:0 auto; padding:2rem; display:grid; grid-template-columns:240px 1fr; gap:2rem; align-items:start }

/* ── SIDEBAR ── */
.sidebar { position:sticky; top:68px }
.sidebar-title { font-family:'Sora',sans-serif; font-size:11px; font-weight:600; letter-spacing:1.5px; text-transform:uppercase; color:var(--muted); margin-bottom:10px }
.cat-list { list-style:none }
.cat-item { margin-bottom:4px }
.cat-btn { width:100%; display:flex; align-items:center; gap:10px; padding:10px 14px; border-radius:10px; border:none; background:transparent; cursor:pointer; text-align:left; transition:background .15s; font-family:'DM Sans',sans-serif }
.cat-btn:hover { background:var(--surface2) }
.cat-btn.active { background:var(--accent) }
.cat-btn.active .cat-label { color:#fff; font-weight:500 }
.cat-btn.active .cat-count { background:rgba(255,255,255,.25); color:#fff }
.cat-icon  { width:32px; height:32px; border-radius:8px; display:flex; align-items:center; justify-content:center; font-size:16px; flex-shrink:0 }
.cat-label { font-size:14px; color:var(--text); flex:1 }
.cat-count { font-size:11px; background:var(--surface2); border-radius:20px; padding:2px 8px; color:var(--muted); font-weight:500 }

/* ── SCHEME CARDS ── */
.content-header { display:flex; align-items:center; justify-content:space-between; margin-bottom:1.25rem }
.content-title  { font-family:'Sora',sans-serif; font-size:18px; font-weight:600 }
.schemes-grid   { display:grid; gap:12px }
.scheme-card { background:var(--surface); border:1px solid var(--border); border-radius:14px; padding:1.25rem 1.5rem; transition:box-shadow .2s,transform .15s; position:relative; overflow:hidden }
.scheme-card::before { content:''; position:absolute; left:0; top:0; bottom:0; width:4px; background:var(--card-accent,#ccc); border-radius:4px 0 0 4px }
.scheme-card:hover { box-shadow:0 6px 24px rgba(0,0,0,.08); transform:translateY(-1px) }
.card-header-row { display:flex; align-items:flex-start; justify-content:space-between; gap:1rem; margin-bottom:8px }
.card-title { font-family:'Sora',sans-serif; font-size:15px; font-weight:600; color:var(--text); margin-bottom:6px; line-height:1.3 }
.badge { display:inline-block; font-size:11px; font-weight:500; padding:2px 10px; border-radius:20px; margin-right:6px }
.deadline-badge { display:inline-flex; align-items:center; gap:4px; font-size:11px; font-weight:600; padding:3px 10px; border-radius:20px; white-space:nowrap }
.deadline-open      { background:#e1f5ee; color:#0a6e4f }
.deadline-soon      { background:#fef3d6; color:var(--warning) }
.deadline-urgent    { background:#fde0d8; color:var(--danger) }
.deadline-yearround { background:#e6f1fb; color:var(--blue) }
.card-desc  { font-size:13.5px; color:var(--muted); line-height:1.6; margin-bottom:12px }
.card-footer { display:flex; align-items:center; justify-content:space-between; gap:1rem; padding-top:12px; border-top:1px solid var(--border) }
.benefit-pill { display:flex; align-items:center; gap:6px; font-size:13px; font-weight:500; color:var(--accent); background:rgba(26,79,58,.08); padding:5px 12px; border-radius:20px }
.footer-actions { display:flex; gap:8px; align-items:center }
.details-btn { display:inline-flex; align-items:center; gap:4px; font-size:13px; font-weight:500; color:var(--accent); background:transparent; border:1.5px solid var(--accent); padding:6px 12px; border-radius:8px; cursor:pointer; font-family:'DM Sans',sans-serif; transition:background .15s,color .15s }
.details-btn:hover { background:var(--accent); color:#fff }
.chev { transition:transform .2s }
.details-btn.open .chev { transform:rotate(180deg) }
.visit-link { display:inline-flex; align-items:center; gap:6px; font-size:13px; font-weight:500; color:var(--accent2); text-decoration:none; padding:6px 14px; border:1.5px solid var(--accent2); border-radius:8px; transition:background .15s,color .15s; white-space:nowrap }
.visit-link:hover { background:var(--accent2); color:#fff }
.details-section { margin-top:14px; padding-top:14px; border-top:1px dashed var(--border); display:none; animation:fadeIn .25s ease }
.details-section.open { display:block }
@keyframes fadeIn { from{opacity:0;transform:translateY(-4px)} to{opacity:1;transform:translateY(0)} }
.details-grid { display:grid; grid-template-columns:1fr 1fr; gap:1.25rem; margin-bottom:1rem }
.details-block h4 { font-family:'Sora',sans-serif; font-size:12px; font-weight:600; text-transform:uppercase; letter-spacing:.8px; color:var(--accent); margin-bottom:8px }
.doc-list   { list-style:none }
.doc-list li { font-size:13px; color:var(--text); padding:5px 0 5px 22px; position:relative; line-height:1.45 }
.doc-list li::before { content:'📄'; position:absolute; left:0; top:4px; font-size:12px }
.steps-list { list-style:none; counter-reset:step }
.steps-list li { font-size:13px; color:var(--text); padding:6px 0 6px 30px; position:relative; line-height:1.5; counter-increment:step }
.steps-list li::before { content:counter(step); position:absolute; left:0; top:5px; width:20px; height:20px; background:var(--accent); color:#fff; border-radius:50%; font-size:11px; font-weight:600; display:flex; align-items:center; justify-content:center; font-family:'Sora',sans-serif }
.deadline-info { background:var(--surface2); padding:10px 14px; border-radius:8px; font-size:13px; color:var(--text); display:flex; align-items:center; gap:8px; margin-bottom:1rem }
.deadline-info strong { color:var(--accent) }
.no-results { text-align:center; padding:4rem 2rem; color:var(--muted) }
.no-results svg { opacity:.3; margin-bottom:12px }
.no-results p { font-size:15px }
.elig-tags { display:flex; flex-wrap:wrap; gap:5px; margin-bottom:10px }
.elig-tag  { font-size:11px; padding:2px 8px; border-radius:4px; background:var(--surface2); color:var(--muted); border:1px solid var(--border) }
.custom-tag { background:#fff8e1; border:1px solid #f5d87a; color:#7a5c00; font-size:10px; padding:1px 6px; border-radius:4px; margin-left:4px }
.save-btn { display:inline-flex; align-items:center; gap:4px; font-size:12px; color:var(--muted); background:var(--surface2); border:1px solid var(--border); border-radius:7px; padding:5px 10px; cursor:pointer; font-family:'DM Sans',sans-serif; transition:all .15s }
.save-btn:hover,.save-btn.saved { background:#fff8e1; border-color:#f5d87a; color:#7a5c00 }

/* ── MODAL OVERLAY ── */
.modal-overlay { display:none; position:fixed; inset:0; z-index:500; background:rgba(10,20,15,.55); backdrop-filter:blur(6px); align-items:center; justify-content:center }
.modal-overlay.active { display:flex }
@keyframes slideUp { from{opacity:0;transform:translateY(24px)} to{opacity:1;transform:translateY(0)} }

/* ── LOCK BOX ── */
.lock-box { background:var(--surface); border:1px solid var(--border); border-radius:20px; padding:2.5rem; width:360px; text-align:center; box-shadow:0 24px 80px rgba(0,0,0,.25); animation:slideUp .3s cubic-bezier(.22,1,.36,1) }
.lock-icon { width:64px; height:64px; border-radius:16px; background:var(--accent); margin:0 auto 1.2rem; display:flex; align-items:center; justify-content:center; font-size:28px }
.lock-box h2 { font-family:'Sora',sans-serif; font-size:20px; font-weight:700; margin-bottom:6px }
.lock-box p  { font-size:13px; color:var(--muted); margin-bottom:1.5rem }
.lock-input-wrap { position:relative; margin-bottom:1rem }
.lock-input { width:100%; padding:12px 44px 12px 16px; border:1.5px solid var(--border); border-radius:10px; font-size:16px; letter-spacing:6px; text-align:center; font-family:'Sora',sans-serif; background:var(--bg); color:var(--text); outline:none; transition:border-color .2s }
.lock-input:focus { border-color:var(--accent) }
.lock-input.shake { animation:shake .4s; border-color:var(--danger) }
@keyframes shake { 0%,100%{transform:translateX(0)} 20%{transform:translateX(-8px)} 40%{transform:translateX(8px)} 60%{transform:translateX(-5px)} 80%{transform:translateX(5px)} }
.toggle-pw { position:absolute; right:12px; top:50%; transform:translateY(-50%); background:none; border:none; cursor:pointer; color:var(--muted); padding:4px }
.lock-error  { color:var(--danger); font-size:12px; margin-bottom:10px; min-height:18px; display:block }
.lock-submit { width:100%; padding:12px; background:var(--accent); color:#fff; border:none; border-radius:10px; font-size:15px; font-weight:600; font-family:'Sora',sans-serif; cursor:pointer; transition:background .2s }
.lock-submit:hover { background:#0f3328 }
.lock-cancel { width:100%; margin-top:10px; padding:10px; background:transparent; color:var(--muted); border:1px solid var(--border); border-radius:10px; font-size:13px; cursor:pointer; font-family:'DM Sans',sans-serif; transition:background .15s }
.lock-cancel:hover { background:var(--surface2) }

/* ── PROFILE MODAL ── */
.profile-modal { background:var(--surface); border:1px solid var(--border); border-radius:20px; width:min(500px,95vw); max-height:90vh; overflow-y:auto; box-shadow:0 24px 80px rgba(0,0,0,.25); animation:slideUp .3s cubic-bezier(.22,1,.36,1) }
.profile-header { background:linear-gradient(135deg,var(--accent) 0%,#0f3328 100%); padding:1.75rem 2rem; border-radius:20px 20px 0 0 }
.profile-header-top { display:flex; align-items:center; justify-content:space-between; margin-bottom:1.25rem }
.profile-header h2 { font-family:'Sora',sans-serif; font-size:18px; font-weight:700; color:#fff }
.profile-close { width:34px; height:34px; border-radius:50%; background:rgba(255,255,255,.15); border:none; cursor:pointer; color:#fff; font-size:16px; display:flex; align-items:center; justify-content:center; transition:background .15s }
.profile-close:hover { background:rgba(255,255,255,.28) }
.profile-avatar-row { display:flex; align-items:center; gap:16px }
.profile-avatar-big { width:72px; height:72px; border-radius:50%; border:3px solid rgba(255,255,255,.4); background:rgba(255,255,255,.18); display:flex; align-items:center; justify-content:center; font-family:'Sora',sans-serif; font-weight:700; font-size:28px; color:#fff; flex-shrink:0; overflow:hidden }
.profile-name-display { font-family:'Sora',sans-serif; font-size:18px; font-weight:700; color:#fff; line-height:1.2 }
.profile-sub-display { font-size:12px; color:rgba(255,255,255,.65); margin-top:3px }
.profile-body { padding:1.5rem 2rem }
.pf-section-title { font-family:'Sora',sans-serif; font-size:11px; font-weight:600; text-transform:uppercase; letter-spacing:1.2px; color:var(--muted); margin-bottom:12px; margin-top:20px }
.pf-section-title:first-child { margin-top:0 }
.pf-form-group { margin-bottom:14px }
.pf-label  { font-size:12px; font-weight:600; color:var(--accent); margin-bottom:5px; display:block }
.pf-input,.pf-select { width:100%; padding:10px 14px; border:1.5px solid var(--border); border-radius:8px; background:var(--bg); color:var(--text); font-size:14px; font-family:'DM Sans',sans-serif; outline:none; transition:border-color .2s }
.pf-input:focus,.pf-select:focus { border-color:var(--accent) }
.pf-row { display:grid; grid-template-columns:1fr 1fr; gap:12px }
.pf-save-btn { width:100%; padding:12px; background:var(--accent); color:#fff; border:none; border-radius:10px; font-size:15px; font-weight:600; font-family:'Sora',sans-serif; cursor:pointer; transition:background .2s; margin-top:8px }
.pf-save-btn:hover { background:#0f3328 }
.pf-save-toast { display:none; align-items:center; gap:8px; background:#e1f5ee; border:1px solid #a4d9c4; border-radius:8px; padding:10px 14px; font-size:13px; color:#0a6e4f; margin-bottom:12px }
.pf-save-toast.show { display:flex }
.recent-list { display:flex; flex-direction:column; gap:8px }
.recent-item { display:flex; align-items:center; gap:12px; padding:10px 12px; background:var(--surface2); border-radius:10px; cursor:pointer; transition:background .15s; border:1px solid transparent }
.recent-item:hover { background:#e4e0d8; border-color:var(--border) }
.recent-item-dot  { width:10px; height:10px; border-radius:50%; flex-shrink:0 }
.recent-item-info { flex:1; min-width:0 }
.recent-item-title { font-size:13px; font-weight:500; color:var(--text); white-space:nowrap; overflow:hidden; text-overflow:ellipsis }
.recent-item-meta  { font-size:11px; color:var(--muted); margin-top:2px }
.recent-item-time  { font-size:11px; color:var(--muted); white-space:nowrap; flex-shrink:0 }
.recent-empty { font-size:13px; color:var(--muted); font-style:italic; padding:12px 0 }
.pf-clear-btn { background:none; border:1px solid var(--border); border-radius:7px; padding:6px 12px; font-size:12px; color:var(--muted); cursor:pointer; font-family:'DM Sans',sans-serif; transition:background .15s }
.pf-clear-btn:hover { background:var(--surface2); color:var(--text) }

/* ── ADMIN PANEL ── */
.admin-panel { background:var(--surface); border:1px solid var(--border); border-radius:20px; width:min(820px,95vw); max-height:92vh; overflow-y:auto; display:flex; flex-direction:column; box-shadow:0 24px 80px rgba(0,0,0,.25); animation:slideUp .3s cubic-bezier(.22,1,.36,1) }
.admin-header { background:var(--accent); padding:1.5rem 2rem; border-radius:20px 20px 0 0; display:flex; align-items:center; justify-content:space-between; position:sticky; top:0; z-index:10 }
.admin-header-left { display:flex; align-items:center; gap:12px }
.admin-header-icon { font-size:24px }
.admin-header h2 { font-family:'Sora',sans-serif; font-size:18px; font-weight:700; color:#fff }
.admin-header p  { font-size:12px; color:rgba(255,255,255,.65); margin-top:2px }
.admin-close { width:36px; height:36px; border-radius:50%; background:rgba(255,255,255,.15); border:none; cursor:pointer; color:#fff; font-size:18px; display:flex; align-items:center; justify-content:center; transition:background .15s }
.admin-close:hover { background:rgba(255,255,255,.28) }
.admin-body { padding:2rem }
.admin-tabs { display:flex; gap:8px; margin-bottom:1.5rem }
.admin-tab { padding:8px 18px; border-radius:8px; border:1.5px solid var(--border); background:transparent; cursor:pointer; font-family:'DM Sans',sans-serif; font-size:13px; font-weight:500; color:var(--muted); transition:all .15s }
.admin-tab.active { background:var(--accent); border-color:var(--accent); color:#fff }
.admin-tab:hover:not(.active) { background:var(--surface2); color:var(--text) }
.tab-panel { display:none }
.tab-panel.active { display:block }
.form-grid { display:grid; grid-template-columns:1fr 1fr; gap:1rem }
.form-group { display:flex; flex-direction:column; gap:6px }
.form-group.full { grid-column:1/-1 }
.form-label { font-size:12px; font-weight:600; text-transform:uppercase; letter-spacing:.6px; color:var(--accent) }
.form-input,.form-select,.form-textarea { padding:10px 14px; border:1.5px solid var(--border); border-radius:8px; background:var(--bg); color:var(--text); font-size:14px; font-family:'DM Sans',sans-serif; outline:none; transition:border-color .2s }
.form-input:focus,.form-select:focus,.form-textarea:focus { border-color:var(--accent) }
.form-textarea { resize:vertical; min-height:80px }
.add-row-btn { display:inline-flex; align-items:center; gap:6px; background:var(--surface2); border:1px dashed var(--border); border-radius:8px; padding:8px 14px; font-size:13px; color:var(--muted); cursor:pointer; font-family:'DM Sans',sans-serif; transition:background .15s }
.add-row-btn:hover { background:#e4e0d8; color:var(--text) }
.dynamic-list { display:flex; flex-direction:column; gap:6px; margin-bottom:8px }
.dynamic-row { display:flex; gap:6px; align-items:center }
.dynamic-row input { flex:1; padding:8px 12px; border:1.5px solid var(--border); border-radius:7px; background:var(--bg); font-size:13px; font-family:'DM Sans',sans-serif; color:var(--text); outline:none }
.dynamic-row input:focus { border-color:var(--accent) }
.remove-row { width:28px; height:28px; border-radius:6px; background:#fde0d8; border:none; cursor:pointer; color:var(--danger); font-size:16px; display:flex; align-items:center; justify-content:center; flex-shrink:0; transition:background .15s }
.remove-row:hover { background:#f8c5b8 }
.form-submit-row { grid-column:1/-1; display:flex; gap:10px; justify-content:flex-end; margin-top:8px }
.submit-btn { padding:11px 28px; background:var(--accent); color:#fff; border:none; border-radius:10px; font-size:14px; font-weight:600; font-family:'Sora',sans-serif; cursor:pointer; transition:background .2s }
.submit-btn:hover { background:#0f3328 }
.reset-btn { padding:11px 20px; background:transparent; color:var(--muted); border:1.5px solid var(--border); border-radius:10px; font-size:14px; cursor:pointer; font-family:'DM Sans',sans-serif; transition:background .15s }
.reset-btn:hover { background:var(--surface2) }
.success-toast { display:none; align-items:center; gap:10px; background:#e1f5ee; border:1px solid #a4d9c4; border-radius:10px; padding:12px 16px; font-size:14px; color:#0a6e4f; margin-bottom:1rem }
.success-toast.show { display:flex }
.manage-table-wrap { overflow-x:auto }
.manage-table { width:100%; border-collapse:collapse; font-size:13px }
.manage-table th { text-align:left; padding:10px 12px; background:var(--surface2); color:var(--muted); font-size:11px; font-weight:600; text-transform:uppercase; letter-spacing:.6px; border-bottom:1px solid var(--border) }
.manage-table td { padding:10px 12px; border-bottom:1px solid var(--border); vertical-align:middle }
.manage-table tr:last-child td { border-bottom:none }
.manage-table tr:hover td { background:var(--bg) }
.tbl-title { font-weight:500; color:var(--text); max-width:200px; line-height:1.35 }
.tbl-cat-badge { font-size:11px; padding:2px 8px; border-radius:4px; background:var(--surface2); color:var(--muted); white-space:nowrap }
.delete-row-btn { display:inline-flex; align-items:center; gap:4px; background:#fde0d8; border:none; border-radius:6px; color:var(--danger); font-size:12px; font-weight:500; padding:5px 10px; cursor:pointer; font-family:'DM Sans',sans-serif; transition:background .15s }
.delete-row-btn:hover { background:#f8c5b8 }
.api-error { background:#fde0d8; border:1px solid #f0a090; color:var(--danger); border-radius:8px; padding:10px 14px; font-size:13px; margin-bottom:12px; display:none }
.api-error.show { display:block }

/* ── RESPONSIVE ── */
@media(max-width:700px){
  .main { grid-template-columns:1fr; padding:1rem }
  .sidebar { position:static }
  .cat-list { display:flex; flex-wrap:wrap; gap:6px }
  .cat-item { margin-bottom:0 }
  .cat-btn { padding:7px 12px }
  .stats-row { gap:1rem }
  .header-inner { flex-wrap:wrap }
  .header-search { order:3; max-width:100%; width:100% }
  .details-grid { grid-template-columns:1fr; gap:1rem }
  .card-footer { flex-direction:column; align-items:stretch }
  .footer-actions { justify-content:space-between }
  .form-grid { grid-template-columns:1fr }
  .pf-row { grid-template-columns:1fr }
  .recently-inner { padding:.75rem 1rem }
}
</style>
</head>
<body>

<!-- LOADING SCREEN -->
<div id="appLoader">
  <div class="loader-logo">🇮🇳</div>
  <div class="loader-text">YojanaSamachar</div>
  <div class="loader-sub">Loading schemes from database…</div>
  <div class="loader-bar"><div class="loader-fill"></div></div>
</div>

<!-- HEADER -->
<header>
  <div class="header-inner">
    <div class="logo">
      <div class="logo-icon">🇮🇳</div>
      <div class="logo-text">
        <h1>YojanaSamachar</h1>
        <p>Government Schemes &amp; Scholarships Portal</p>
      </div>
    </div>
    <div class="header-search">
      <svg width="16" height="16" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
      <input type="text" id="searchInput" placeholder="Search schemes, categories, benefits…">
    </div>
    <div class="header-right">
      <span class="scheme-count-badge" id="countBadge">— Schemes</span>
      <button class="hdr-btn" onclick="openLock()">
        <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
        Admin
      </button>
      <button class="profile-btn" onclick="openProfile()" title="My Profile">
        <div class="avatar-circle" id="avatarCircle">👤</div>
        <span class="profile-dot"></span>
      </button>
    </div>
  </div>
</header>

<!-- RECENTLY VIEWED BAR -->
<div class="recently-bar" id="recentlyBar">
  <div class="recently-inner">
    <span class="recently-label">🕐 Recent</span>
    <div class="recently-chips" id="recentlyChips"></div>
    <button class="recently-clear" onclick="clearRecent()">Clear</button>
  </div>
</div>

<!-- HERO -->
<div class="hero-strip">
  <div class="hero-greeting" id="heroGreeting" style="display:none">
    <span id="greetingText"></span>
  </div>
  <h2>Find Schemes &amp; Scholarships for You</h2>
  <p class="hero-sub">Government benefits for students, farmers, workers, women, seniors &amp; more</p>
  <div class="stats-row">
    <div class="stat"><strong id="totalCount">—</strong><span>Total schemes</span></div>
    <div class="stat"><strong>9</strong><span>Categories</span></div>
    <div class="stat"><strong>Free</strong><span>To apply</span></div>
  </div>
</div>

<!-- MAIN -->
<div class="main">
  <aside class="sidebar">
    <p class="sidebar-title">Categories</p>
    <ul class="cat-list" id="catList"></ul>
  </aside>
  <section class="content">
    <div class="content-header">
      <p class="content-title" id="contentTitle">All Schemes</p>
    </div>
    <div class="api-error" id="apiError"></div>
    <div class="schemes-grid" id="schemesGrid"></div>
  </section>
</div>

<!-- MODAL OVERLAY -->
<div class="modal-overlay" id="modalOverlay" onclick="overlayClick(event)">

  <!-- LOCK SCREEN -->
  <div class="lock-box" id="lockBox">
    <div class="lock-icon">🔐</div>
    <h2>Admin Access</h2>
    <p>Enter the secret code to access the admin panel</p>
    <div class="lock-input-wrap">
      <input class="lock-input" type="password" id="lockInput" placeholder="••••••" maxlength="20"
        onkeydown="if(event.key==='Enter')verifyCode()">
      <button class="toggle-pw" onclick="togglePw()">
        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
      </button>
    </div>
    <span class="lock-error" id="lockError"></span>
    <button class="lock-submit" onclick="verifyCode()">Unlock Panel →</button>
    <button class="lock-cancel" onclick="closeModal()">Cancel</button>
  </div>

  <!-- PROFILE MODAL -->
  <div class="profile-modal" id="profileModal" style="display:none">
    <div class="profile-header">
      <div class="profile-header-top">
        <h2>My Profile</h2>
        <button class="profile-close" onclick="closeModal()">✕</button>
      </div>
      <div class="profile-avatar-row">
        <div class="profile-avatar-big" id="profileAvatarBig">👤</div>
        <div class="profile-name-area">
          <div class="profile-name-display" id="profileNameDisplay">Guest User</div>
          <div class="profile-sub-display" id="profileSubDisplay">Set up your profile →</div>
        </div>
      </div>
    </div>
    <div class="profile-body">
      <div class="pf-save-toast" id="pfSaveToast">✅ Profile saved successfully!</div>

      <p class="pf-section-title">Personal Information</p>
      <div class="pf-row">
        <div class="pf-form-group"><label class="pf-label">Full Name</label><input class="pf-input" id="pf-name" placeholder="Your full name"/></div>
        <div class="pf-form-group"><label class="pf-label">Age</label><input class="pf-input" id="pf-age" type="number" placeholder="e.g. 24" min="1" max="120"/></div>
      </div>
      <div class="pf-row">
        <div class="pf-form-group">
          <label class="pf-label">State / UT</label>
          <select class="pf-select" id="pf-state">
            <option value="">— Select State —</option>
            <option>Andhra Pradesh</option><option>Arunachal Pradesh</option><option>Assam</option>
            <option>Bihar</option><option>Chhattisgarh</option><option>Goa</option>
            <option>Gujarat</option><option>Haryana</option><option>Himachal Pradesh</option>
            <option>Jharkhand</option><option>Karnataka</option><option>Kerala</option>
            <option>Madhya Pradesh</option><option>Maharashtra</option><option>Manipur</option>
            <option>Meghalaya</option><option>Mizoram</option><option>Nagaland</option>
            <option>Odisha</option><option>Punjab</option><option>Rajasthan</option>
            <option>Sikkim</option><option>Tamil Nadu</option><option>Telangana</option>
            <option>Tripura</option><option>Uttar Pradesh</option><option>Uttarakhand</option>
            <option>West Bengal</option><option>Delhi</option><option>Jammu &amp; Kashmir</option>
            <option>Ladakh</option><option>Other UT</option>
          </select>
        </div>
        <div class="pf-form-group">
          <label class="pf-label">Category</label>
          <select class="pf-select" id="pf-category">
            <option value="">— Select —</option>
            <option>General</option><option>OBC</option><option>SC</option>
            <option>ST</option><option>EWS</option><option>Minority</option>
          </select>
        </div>
      </div>
      <p class="pf-section-title" style="margin-top:16px">I am a…</p>
      <div class="pf-form-group">
        <select class="pf-select" id="pf-role">
          <option value="">— Select your role —</option>
          <option value="student">🎓 Student</option>
          <option value="farmer">🌾 Farmer</option>
          <option value="worker">🔨 Worker / Labourer</option>
          <option value="women">👩 Woman / Homemaker</option>
          <option value="senior">🧓 Senior Citizen</option>
          <option value="entrepreneur">💼 Entrepreneur / Business</option>
          <option value="disabled">♿ Person with Disability</option>
          <option value="health">🏥 Seeking Health Benefits</option>
          <option value="housing">🏠 Seeking Housing</option>
        </select>
      </div>
      <button class="pf-save-btn" onclick="saveProfile()">Save Profile</button>

      <!-- Saved Schemes -->
      <p class="pf-section-title" style="margin-top:24px">
        ★ Saved Schemes
        <span id="savedCountBadge" style="background:var(--surface2);border:1px solid var(--border);border-radius:10px;padding:1px 8px;font-size:11px;color:var(--muted);margin-left:6px;font-family:'DM Sans',sans-serif;text-transform:none;letter-spacing:0">0</span>
      </p>
      <div id="savedSchemesList"><p class="recent-empty">No saved schemes yet. Click ☆ on any scheme to save it.</p></div>

      <!-- Recently Viewed -->
      <div style="display:flex;align-items:center;justify-content:space-between;margin-top:24px;margin-bottom:12px">
        <p class="pf-section-title" style="margin:0">
          🕐 Recently Viewed
          <span id="recentCountBadge" style="background:var(--surface2);border:1px solid var(--border);border-radius:10px;padding:1px 8px;font-size:11px;color:var(--muted);margin-left:6px;font-family:'DM Sans',sans-serif;text-transform:none;letter-spacing:0">0</span>
        </p>
        <button class="pf-clear-btn" onclick="clearRecent()">Clear all</button>
      </div>
      <div class="recent-list" id="recentSchemesList">
        <p class="recent-empty">No schemes viewed yet.</p>
      </div>
    </div>
  </div>

  <!-- ADMIN PANEL -->
  <div class="admin-panel" id="adminPanel" style="display:none">
    <div class="admin-header">
      <div class="admin-header-left">
        <span class="admin-header-icon">⚙️</span>
        <div><h2>Admin Panel</h2><p>Add or manage schemes &amp; scholarships</p></div>
      </div>
      <button class="admin-close" onclick="closeModal()">✕</button>
    </div>
    <div class="admin-body">
      <div class="admin-tabs">
        <button class="admin-tab active" onclick="switchTab('add',this)">➕ Add New Scheme</button>
        <button class="admin-tab" onclick="switchTab('manage',this)">📋 Manage Schemes</button>
      </div>

      <!-- ADD TAB -->
      <div class="tab-panel active" id="tab-add">
        <div class="success-toast" id="addSuccessToast">✅ <span id="addSuccessMsg">Scheme added!</span></div>
        <div class="form-grid">
          <div class="form-group"><label class="form-label">Scheme Title *</label><input class="form-input" id="f-title" placeholder="e.g. PM Scholarship for Girls"/></div>
          <div class="form-group"><label class="form-label">Category *</label>
            <select class="form-select" id="f-cat">
              <option value="">— Select Category —</option>
              <option value="student">Students</option><option value="farmer">Farmers</option>
              <option value="worker">Workers</option><option value="women">Women</option>
              <option value="senior">Senior Citizens</option><option value="entrepreneur">Entrepreneurs</option>
              <option value="disabled">Disabled / PwD</option><option value="health">Health</option>
              <option value="housing">Housing</option>
            </select>
          </div>
          <div class="form-group"><label class="form-label">Badge / Type *</label><input class="form-input" id="f-badge" placeholder="e.g. Scholarship, Pension, Loan…"/></div>
          <div class="form-group"><label class="form-label">Benefit / Amount *</label><input class="form-input" id="f-benefit" placeholder="e.g. ₹10,000/year"/></div>
          <div class="form-group full"><label class="form-label">Description *</label><textarea class="form-textarea" id="f-desc" placeholder="Describe the scheme…"></textarea></div>
          <div class="form-group"><label class="form-label">Deadline *</label><input class="form-input" id="f-deadline" placeholder="e.g. 31 October 2025"/></div>
          <div class="form-group"><label class="form-label">Deadline Status *</label>
            <select class="form-select" id="f-deadlineType">
              <option value="open">🟢 Open</option><option value="soon">🟡 Closing Soon</option>
              <option value="urgent">🔴 Urgent</option><option value="yearround">🔵 Year-round</option>
            </select>
          </div>
          <div class="form-group full"><label class="form-label">Official Link *</label><input class="form-input" id="f-link" placeholder="https://…"/></div>
          <div class="form-group full">
            <label class="form-label">Eligibility Criteria</label>
            <div class="dynamic-list" id="elig-list"><div class="dynamic-row"><input placeholder="e.g. Students in Class 1–12"/><button class="remove-row" onclick="removeRow(this)">×</button></div></div>
            <button class="add-row-btn" onclick="addRow('elig-list','e.g. Income ≤ ₹8 LPA')">+ Add eligibility</button>
          </div>
          <div class="form-group full">
            <label class="form-label">Documents Required</label>
            <div class="dynamic-list" id="docs-list"><div class="dynamic-row"><input placeholder="e.g. Aadhaar Card"/><button class="remove-row" onclick="removeRow(this)">×</button></div></div>
            <button class="add-row-btn" onclick="addRow('docs-list','e.g. Bank Passbook')">+ Add document</button>
          </div>
          <div class="form-group full">
            <label class="form-label">How to Apply (Steps)</label>
            <div class="dynamic-list" id="steps-list"><div class="dynamic-row"><input placeholder="e.g. Visit official website and register"/><button class="remove-row" onclick="removeRow(this)">×</button></div></div>
            <button class="add-row-btn" onclick="addRow('steps-list','e.g. Submit application form online')">+ Add step</button>
          </div>
          <div class="form-submit-row">
            <button class="reset-btn" onclick="resetForm()">Clear Form</button>
            <button class="submit-btn" onclick="addScheme()">Save Scheme ✓</button>
          </div>
        </div>
      </div>

      <!-- MANAGE TAB -->
      <div class="tab-panel" id="tab-manage">
        <div class="manage-table-wrap">
          <table class="manage-table" id="manageTable">
            <thead><tr><th>#</th><th>Title</th><th>Category</th><th>Badge</th><th>Benefit</th><th>Action</th></tr></thead>
            <tbody id="manageBody"></tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

</div><!-- /overlay -->

<script>
// ══════════════════════════════════════════════
// CONFIG & CONSTANTS
// ══════════════════════════════════════════════
const API = 'api/api.php';  // path to PHP API

const CATS = [
  {id:"all",          label:"All Schemes",    icon:"📋"},
  {id:"student",      label:"Students",        icon:"🎓"},
  {id:"farmer",       label:"Farmers",         icon:"🌾"},
  {id:"worker",       label:"Workers",         icon:"🔨"},
  {id:"women",        label:"Women",           icon:"👩"},
  {id:"senior",       label:"Senior Citizens", icon:"🧓"},
  {id:"entrepreneur", label:"Entrepreneurs",   icon:"💼"},
  {id:"disabled",     label:"Disabled / PwD",  icon:"♿"},
  {id:"health",       label:"Health",          icon:"🏥"},
  {id:"housing",      label:"Housing",         icon:"🏠"},
];
const COLORS = {student:"#4a3f8c",farmer:"#0f6e56",worker:"#854f0b",women:"#8c2d4f",senior:"#185fa5",entrepreneur:"#993c1d",disabled:"#5a4a8c",health:"#0a7a6a",housing:"#7a5c1a"};
const BADGES = {student:"#eeedfe",farmer:"#e1f5ee",worker:"#faeeda",women:"#fbeaf0",senior:"#e6f1fb",entrepreneur:"#faece7",disabled:"#eeedfe",health:"#e1f5ee",housing:"#faeeda"};
const DL = {
  open:      {cls:"deadline-open",      icon:"🟢"},
  soon:      {cls:"deadline-soon",      icon:"🟡"},
  urgent:    {cls:"deadline-urgent",    icon:"🔴"},
  yearround: {cls:"deadline-yearround", icon:"🔵"},
};

// ── State ──────────────────────────────────────
let SCHEMES      = [];
let activeCat    = 'all';
let openDetails  = new Set();
let savedIds     = new Set();
let recentItems  = [];    // [{id,title,cat,badge,viewed_at}]
let adminCode    = '';
let userProfile  = {name:'',age:'',state:'',category:'',role:''};
let pwVisible    = false;
let searchTimer  = null;

// ══════════════════════════════════════════════
// API HELPERS
// ══════════════════════════════════════════════
async function apiFetch(action, params = {}, method = 'GET') {
  let url = `${API}?action=${action}`;
  const opts = { method };

  if (method === 'GET') {
    Object.entries(params).forEach(([k,v]) => url += `&${k}=${encodeURIComponent(v)}`);
  } else {
    opts.headers = {'Content-Type':'application/json'};
    opts.body    = JSON.stringify(params);
  }

  const res  = await fetch(url, opts);
  const data = await res.json();
  if (!data.success) throw new Error(data.error || 'API error');
  return data;
}

function showApiError(msg) {
  const el = document.getElementById('apiError');
  el.textContent = '⚠️ ' + msg;
  el.classList.add('show');
  setTimeout(() => el.classList.remove('show'), 5000);
}

// ══════════════════════════════════════════════
// BOOT
// ══════════════════════════════════════════════
async function boot() {
  try {
    renderCats();

    // Load in parallel
    const [schemesData, profileData, savedData, recentData] = await Promise.all([
      apiFetch('get_schemes', {cat:'all'}),
      apiFetch('get_profile'),
      apiFetch('get_saved'),
      apiFetch('get_recent'),
    ]);

    SCHEMES     = schemesData.schemes;
    savedIds    = new Set(savedData.saved_ids);
    recentItems = recentData.recent;

    if (profileData.profile) {
      userProfile = { ...userProfile, ...profileData.profile };
      updateProfileUI();
    }

    renderCats();
    render();
    renderRecentBar();

    document.getElementById('totalCount').textContent = SCHEMES.length;

    // Hide loader
    const loader = document.getElementById('appLoader');
    loader.classList.add('hide');
    setTimeout(() => loader.remove(), 500);

  } catch(e) {
    document.getElementById('appLoader').remove();
    showApiError('Could not load from database: ' + e.message + '. Make sure XAMPP is running and setup.sql has been imported.');
  }
}

window.addEventListener('DOMContentLoaded', boot);

// ══════════════════════════════════════════════
// SEARCH – debounced
// ══════════════════════════════════════════════
document.getElementById('searchInput').addEventListener('input', () => {
  clearTimeout(searchTimer);
  searchTimer = setTimeout(async () => {
    const q = document.getElementById('searchInput').value.trim();
    try {
      const data = await apiFetch('get_schemes', {cat: activeCat, q});
      SCHEMES = data.schemes;
      render();
      document.getElementById('totalCount').textContent = SCHEMES.length;
    } catch(e) {
      showApiError(e.message);
    }
  }, 300);
});

// ══════════════════════════════════════════════
// CATEGORY SELECTION
// ══════════════════════════════════════════════
async function selectCat(id) {
  activeCat = id;
  openDetails.clear();
  document.getElementById('searchInput').value = '';
  renderCats();

  try {
    const data = await apiFetch('get_schemes', {cat: id});
    SCHEMES = data.schemes;
    render();
  } catch(e) {
    showApiError(e.message);
  }
}

function renderCats() {
  document.getElementById('catList').innerHTML = CATS.map(c => {
    const count = c.id === 'all'
      ? SCHEMES.length
      : SCHEMES.filter(s => s.cat === c.id).length;
    return `<li class="cat-item">
      <button class="cat-btn${activeCat===c.id?' active':''}" onclick="selectCat('${c.id}')">
        <span class="cat-icon" style="background:${c.id==='all'?'#f0ede4':BADGES[c.id]||'#f0ede4'}">${c.icon}</span>
        <span class="cat-label">${c.label}</span>
        <span class="cat-count">${count}</span>
      </button></li>`;
  }).join('');
}

// ══════════════════════════════════════════════
// RENDER CARDS
// ══════════════════════════════════════════════
function render() {
  const grid = document.getElementById('schemesGrid');
  document.getElementById('countBadge').textContent = SCHEMES.length + ' Schemes';

  const catObj = CATS.find(c => c.id === activeCat);
  document.getElementById('contentTitle').textContent =
    activeCat === 'all' ? 'All Schemes' : (catObj?.label + ' Schemes');

  if (!SCHEMES.length) {
    grid.innerHTML = `<div class="no-results">
      <svg width="48" height="48" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/><line x1="8" y1="11" x2="14" y2="11"/></svg>
      <p>No schemes found. Try a different search or category.</p></div>`;
    return;
  }

  grid.innerHTML = SCHEMES.map(s => {
    const ac = COLORS[s.cat] || '#1a4f3a';
    const bg = BADGES[s.cat] || '#f0ede4';
    const dl = DL[s.deadlineType] || DL.yearround;
    const isOpen  = openDetails.has(s.id);
    const isSaved = savedIds.has(s.id);

    return `<div class="scheme-card" style="--card-accent:${ac}" id="card-${s.id}">
      <div class="card-header-row">
        <div>
          <p class="card-title">${esc(s.title)}${s.is_custom?'<span class="custom-tag">New</span>':''}</p>
          <span class="badge" style="background:${bg};color:${ac}">${esc(s.badge)}</span>
        </div>
        <span class="deadline-badge ${dl.cls}">${dl.icon} ${esc(s.deadline)}</span>
      </div>
      <div class="elig-tags">${(s.eligibility||[]).map(e=>`<span class="elig-tag">${esc(e)}</span>`).join('')}</div>
      <p class="card-desc">${esc(s.desc)}</p>
      <div class="card-footer">
        <span class="benefit-pill">
          <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M12 8v4l3 3"/></svg>
          ${esc(s.benefit)}
        </span>
        <div class="footer-actions">
          <button class="save-btn${isSaved?' saved':''}" onclick="toggleSave(${s.id})" title="${isSaved?'Remove from saved':'Save scheme'}">
            ${isSaved?'★ Saved':'☆ Save'}
          </button>
          <button class="details-btn${isOpen?' open':''}" onclick="toggleDetails(${s.id})">
            ${isOpen?'Hide':'View'} Details
            <svg class="chev" width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="6 9 12 15 18 9"/></svg>
          </button>
          <a href="${esc(s.link)}" target="_blank" rel="noopener noreferrer" class="visit-link">
            Apply
            <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
          </a>
        </div>
      </div>
      <div class="details-section${isOpen?' open':''}">
        <div class="deadline-info">📅 <span><strong>Application Deadline:</strong> ${esc(s.deadline)}</span></div>
        <div class="details-grid">
          <div class="details-block">
            <h4>📄 Documents Required</h4>
            <ul class="doc-list">${(s.documents||[]).map(d=>`<li>${esc(d)}</li>`).join('')}</ul>
          </div>
          <div class="details-block">
            <h4>📝 How to Apply</h4>
            <ol class="steps-list">${(s.steps||[]).map(st=>`<li>${esc(st)}</li>`).join('')}</ol>
          </div>
        </div>
      </div>
    </div>`;
  }).join('');
}

function esc(str) {
  return String(str ?? '')
    .replace(/&/g,'&amp;')
    .replace(/</g,'&lt;')
    .replace(/>/g,'&gt;')
    .replace(/"/g,'&quot;');
}

// ══════════════════════════════════════════════
// TOGGLE DETAILS
// ══════════════════════════════════════════════
async function toggleDetails(id) {
  if (openDetails.has(id)) {
    openDetails.delete(id);
  } else {
    openDetails.add(id);
    // Record view in DB (fire and forget)
    apiFetch('record_view', {scheme_id: id}, 'POST')
      .then(() => fetchAndRenderRecent())
      .catch(() => {});
  }
  render();
}

// ══════════════════════════════════════════════
// SAVED SCHEMES
// ══════════════════════════════════════════════
async function toggleSave(id) {
  try {
    const data = await apiFetch('toggle_save', {scheme_id: id}, 'POST');
    if (data.saved) savedIds.add(id);
    else            savedIds.delete(id);
    render();
    renderSavedList();
  } catch(e) {
    showApiError('Could not update saved schemes: ' + e.message);
  }
}

function renderSavedList() {
  const el = document.getElementById('savedSchemesList');
  document.getElementById('savedCountBadge').textContent = savedIds.size;
  const items = SCHEMES.filter(s => savedIds.has(s.id));
  if (!items.length) {
    el.innerHTML = `<p class="recent-empty">No saved schemes yet. Click ☆ on any scheme to save it.</p>`;
    return;
  }
  el.innerHTML = items.map(s => {
    const col = COLORS[s.cat] || '#1a4f3a';
    return `<div class="recent-item" onclick="jumpToScheme(${s.id})">
      <span class="recent-item-dot" style="background:${col}"></span>
      <div class="recent-item-info">
        <div class="recent-item-title">${esc(s.title)}</div>
        <div class="recent-item-meta">${CATS.find(c=>c.id===s.cat)?.icon||''} ${s.cat} · ${esc(s.benefit)}</div>
      </div>
      <button onclick="event.stopPropagation();toggleSave(${s.id})" style="background:#fde0d8;border:none;border-radius:6px;padding:4px 8px;cursor:pointer;color:var(--danger);font-size:11px;flex-shrink:0">Remove</button>
    </div>`;
  }).join('');
}

// ══════════════════════════════════════════════
// RECENTLY VIEWED
// ══════════════════════════════════════════════
async function fetchAndRenderRecent() {
  try {
    const data = await apiFetch('get_recent');
    recentItems = data.recent;
    renderRecentBar();
    renderProfileRecentList();
  } catch(e) {}
}

function renderRecentBar() {
  const bar   = document.getElementById('recentlyBar');
  const chips = document.getElementById('recentlyChips');
  if (!recentItems.length) { bar.style.display = 'none'; return; }
  bar.style.display = '';
  chips.innerHTML = recentItems.map(r => {
    const col = COLORS[r.cat] || '#1a4f3a';
    const title = r.title.length > 28 ? r.title.slice(0,28)+'…' : r.title;
    return `<span class="recent-chip" onclick="jumpToScheme(${r.id})">
      <span class="chip-dot" style="background:${col}"></span>${esc(title)}</span>`;
  }).join('');
  document.getElementById('recentCountBadge').textContent = recentItems.length;
}

function renderProfileRecentList() {
  const el = document.getElementById('recentSchemesList');
  document.getElementById('recentCountBadge').textContent = recentItems.length;
  if (!recentItems.length) {
    el.innerHTML = `<p class="recent-empty">No schemes viewed yet.</p>`;
    return;
  }
  el.innerHTML = recentItems.map(r => {
    const col = COLORS[r.cat] || '#1a4f3a';
    return `<div class="recent-item" onclick="jumpToScheme(${r.id})">
      <span class="recent-item-dot" style="background:${col}"></span>
      <div class="recent-item-info">
        <div class="recent-item-title">${esc(r.title)}</div>
        <div class="recent-item-meta">${CATS.find(c=>c.id===r.cat)?.icon||''} ${r.cat} · ${esc(r.badge)}</div>
      </div>
      <span class="recent-item-time">${timeAgo(r.viewed_at)}</span>
    </div>`;
  }).join('');
}

async function clearRecent() {
  try {
    await apiFetch('clear_recent', {}, 'POST');
    recentItems = [];
    renderRecentBar();
    renderProfileRecentList();
  } catch(e) {
    showApiError(e.message);
  }
}

function timeAgo(ts) {
  // ts is MySQL DATETIME string
  const d = new Date(ts);
  const s = Math.floor((Date.now() - d.getTime()) / 1000);
  if (s < 60)    return 'just now';
  if (s < 3600)  return Math.floor(s/60) + 'm ago';
  if (s < 86400) return Math.floor(s/3600) + 'h ago';
  return Math.floor(s/86400) + 'd ago';
}

function jumpToScheme(id) {
  closeModal();
  setTimeout(() => {
    const card = document.getElementById('card-' + id);
    if (card) {
      card.scrollIntoView({behavior:'smooth', block:'center'});
      card.style.outline = '2px solid var(--accent)';
      setTimeout(() => card.style.outline = '', 1800);
    }
  }, 100);
}

// ══════════════════════════════════════════════
// PROFILE
// ══════════════════════════════════════════════
async function saveProfile() {
  userProfile.name     = document.getElementById('pf-name').value.trim();
  userProfile.age      = document.getElementById('pf-age').value.trim();
  userProfile.state    = document.getElementById('pf-state').value;
  userProfile.category = document.getElementById('pf-category').value;
  userProfile.role     = document.getElementById('pf-role').value;

  try {
    await apiFetch('save_profile', userProfile, 'POST');
    updateProfileUI();
    const t = document.getElementById('pfSaveToast');
    t.classList.add('show');
    setTimeout(() => t.classList.remove('show'), 2800);
  } catch(e) {
    showApiError('Profile save failed: ' + e.message);
  }
}

function updateProfileUI() {
  const name = userProfile.name || 'Guest User';
  const initials = name.split(' ').map(w=>w[0]).join('').toUpperCase().slice(0,2) || '👤';

  document.getElementById('avatarCircle').textContent = userProfile.name ? initials : '👤';
  document.getElementById('profileNameDisplay').textContent = name;
  document.getElementById('profileAvatarBig').textContent = userProfile.name ? initials : '👤';

  const subs = [];
  if (userProfile.age)      subs.push('Age ' + userProfile.age);
  if (userProfile.state)    subs.push(userProfile.state);
  if (userProfile.category) subs.push(userProfile.category);
  document.getElementById('profileSubDisplay').textContent = subs.length ? subs.join(' · ') : 'Set up your profile →';

  if (userProfile.name) {
    const hour  = new Date().getHours();
    const greet = hour < 12 ? 'Good morning' : hour < 17 ? 'Good afternoon' : 'Good evening';
    document.getElementById('greetingText').textContent = `${greet}, ${userProfile.name.split(' ')[0]} 👋`;
    document.getElementById('heroGreeting').style.display = '';
  } else {
    document.getElementById('heroGreeting').style.display = 'none';
  }
}

function loadProfileToForm() {
  document.getElementById('pf-name').value     = userProfile.name || '';
  document.getElementById('pf-age').value      = userProfile.age  || '';
  document.getElementById('pf-state').value    = userProfile.state || '';
  document.getElementById('pf-category').value = userProfile.category || '';
  document.getElementById('pf-role').value     = userProfile.role || '';
}

// ══════════════════════════════════════════════
// ADMIN
// ══════════════════════════════════════════════
async function verifyCode() {
  const code = document.getElementById('lockInput').value.trim();
  try {
    await apiFetch('verify_admin', {code}, 'POST');
    adminCode = code;
    showOnly('adminPanel');
    await loadManageTab();
  } catch(e) {
    const inp = document.getElementById('lockInput');
    inp.classList.add('shake');
    document.getElementById('lockError').textContent = '❌ Incorrect code. Try again.';
    inp.value = '';
    setTimeout(() => inp.classList.remove('shake'), 450);
    inp.focus();
  }
}

function switchTab(name, btn) {
  document.querySelectorAll('.tab-panel').forEach(p  => p.classList.remove('active'));
  document.querySelectorAll('.admin-tab').forEach(b  => b.classList.remove('active'));
  document.getElementById('tab-' + name).classList.add('active');
  btn.classList.add('active');
  if (name === 'manage') loadManageTab();
}

async function loadManageTab() {
  try {
    const data = await apiFetch('get_schemes', {cat:'all'});
    SCHEMES = data.schemes;
    renderManageTable();
  } catch(e) {
    showApiError(e.message);
  }
}

function renderManageTable() {
  document.getElementById('manageBody').innerHTML = SCHEMES.map((s,i) => `
    <tr>
      <td style="color:var(--muted);font-size:12px">${i+1}</td>
      <td class="tbl-title">${esc(s.title)}${s.is_custom?'<span class="custom-tag">Custom</span>':''}</td>
      <td><span class="tbl-cat-badge">${CATS.find(c=>c.id===s.cat)?.icon||''} ${s.cat}</span></td>
      <td style="color:var(--muted);font-size:12px">${esc(s.badge)}</td>
      <td style="font-size:12px;color:var(--accent);font-weight:500">${esc(s.benefit)}</td>
      <td><button class="delete-row-btn" onclick="deleteScheme(${s.id})">🗑 Delete</button></td>
    </tr>`).join('');
}

async function addScheme() {
  const title        = document.getElementById('f-title').value.trim();
  const cat          = document.getElementById('f-cat').value;
  const badge        = document.getElementById('f-badge').value.trim();
  const benefit      = document.getElementById('f-benefit').value.trim();
  const desc         = document.getElementById('f-desc').value.trim();
  const deadline     = document.getElementById('f-deadline').value.trim();
  const deadlineType = document.getElementById('f-deadlineType').value;
  const link         = document.getElementById('f-link').value.trim();

  if (!title||!cat||!badge||!benefit||!desc||!deadline||!link) {
    alert('Please fill in all required (*) fields.'); return;
  }

  const payload = {
    title, cat, badge, benefit, desc, deadline, deadlineType, link,
    admin_code:  adminCode,
    eligibility: getListValues('elig-list'),
    documents:   getListValues('docs-list'),
    steps:       getListValues('steps-list'),
  };

  try {
    await apiFetch('add_scheme', payload, 'POST');
    const t = document.getElementById('addSuccessToast');
    document.getElementById('addSuccessMsg').textContent = `"${title}" added successfully!`;
    t.classList.add('show');
    setTimeout(() => t.classList.remove('show'), 3500);
    resetForm();

    // Reload schemes
    const data = await apiFetch('get_schemes', {cat:'all'});
    SCHEMES = data.schemes;
    document.getElementById('totalCount').textContent = SCHEMES.length;
    renderCats();
    render();
  } catch(e) {
    showApiError('Failed to add scheme: ' + e.message);
  }
}

async function deleteScheme(id) {
  const s = SCHEMES.find(x => x.id === id);
  if (!s || !confirm(`Delete "${s.title}"? This cannot be undone.`)) return;
  try {
    await apiFetch('delete_scheme', {id, admin_code: adminCode}, 'POST');
    const data = await apiFetch('get_schemes', {cat: activeCat});
    SCHEMES = data.schemes;
    document.getElementById('totalCount').textContent = SCHEMES.length;
    openDetails.delete(id);
    savedIds.delete(id);
    recentItems = recentItems.filter(r => r.id !== id);
    renderCats(); render(); renderRecentBar(); renderManageTable();
  } catch(e) {
    showApiError('Delete failed: ' + e.message);
  }
}

function resetForm() {
  ['f-title','f-cat','f-badge','f-benefit','f-desc','f-deadline','f-link'].forEach(id => {
    document.getElementById(id).value = '';
  });
  document.getElementById('f-deadlineType').value = 'open';
  ['elig-list','docs-list','steps-list'].forEach(id => {
    document.getElementById(id).innerHTML =
      `<div class="dynamic-row"><input placeholder="Enter value…"/><button class="remove-row" onclick="removeRow(this)">×</button></div>`;
  });
}

function addRow(listId, ph) {
  const list = document.getElementById(listId);
  const row  = document.createElement('div');
  row.className = 'dynamic-row';
  row.innerHTML = `<input placeholder="${ph}"/><button class="remove-row" onclick="removeRow(this)">×</button>`;
  list.appendChild(row);
  row.querySelector('input').focus();
}

function removeRow(btn) {
  const row  = btn.parentElement;
  const list = row.parentElement;
  if (list.children.length > 1) row.remove();
}

function getListValues(listId) {
  return Array.from(document.querySelectorAll(`#${listId} input`))
    .map(i => i.value.trim()).filter(Boolean);
}

// ══════════════════════════════════════════════
// MODAL MANAGEMENT
// ══════════════════════════════════════════════
function showOnly(id) {
  ['lockBox','profileModal','adminPanel'].forEach(m => {
    document.getElementById(m).style.display = m === id ? '' : 'none';
  });
  document.getElementById('modalOverlay').classList.add('active');
}

function openLock() {
  document.getElementById('lockInput').value = '';
  document.getElementById('lockError').textContent = '';
  showOnly('lockBox');
  setTimeout(() => document.getElementById('lockInput').focus(), 100);
}

function openProfile() {
  loadProfileToForm();
  renderProfileRecentList();
  renderSavedList();
  showOnly('profileModal');
}

function closeModal() {
  document.getElementById('modalOverlay').classList.remove('active');
}

function overlayClick(e) {
  if (e.target === document.getElementById('modalOverlay')) closeModal();
}

function togglePw() {
  pwVisible = !pwVisible;
  document.getElementById('lockInput').type = pwVisible ? 'text' : 'password';
}
</script>
</body>
</html>