-- =============================================
-- YojanaSamachar Database Setup
-- =============================================

CREATE DATABASE IF NOT EXISTS yojanasamachar;
USE yojanasamachar;

-- SCHEMES TABLE
CREATE TABLE schemes (
 id INT AUTO_INCREMENT PRIMARY KEY,
 cat VARCHAR(30) NOT NULL,
 title VARCHAR(255) NOT NULL,
 description TEXT NOT NULL,
 benefit VARCHAR(150) NOT NULL,
 badge VARCHAR(100) NOT NULL,
 deadline VARCHAR(100) NOT NULL,
 deadline_type ENUM('open','soon','urgent','yearround') DEFAULT 'open',
 link VARCHAR(500) NOT NULL,
 is_custom TINYINT(1) DEFAULT 0,
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ELIGIBILITY TABLE
CREATE TABLE eligibility(
 id INT AUTO_INCREMENT PRIMARY KEY,
 scheme_id INT,
 item VARCHAR(255),
 FOREIGN KEY(scheme_id) REFERENCES schemes(id)
 ON DELETE CASCADE
);

-- DOCUMENTS TABLE
CREATE TABLE documents(
 id INT AUTO_INCREMENT PRIMARY KEY,
 scheme_id INT,
 item VARCHAR(255),
 FOREIGN KEY(scheme_id) REFERENCES schemes(id)
 ON DELETE CASCADE
);

-- STEPS TABLE
CREATE TABLE steps(
 id INT AUTO_INCREMENT PRIMARY KEY,
 scheme_id INT,
 step_no INT,
 item TEXT,
 FOREIGN KEY(scheme_id) REFERENCES schemes(id)
 ON DELETE CASCADE
);

-- USERS TABLE
CREATE TABLE users(
 id INT AUTO_INCREMENT PRIMARY KEY,
 session_id VARCHAR(128) UNIQUE,
 name VARCHAR(100),
 age INT,
 state VARCHAR(60),
 category VARCHAR(20),
 role VARCHAR(30)
);

-- SAVED SCHEMES TABLE
CREATE TABLE saved_schemes(
 id INT AUTO_INCREMENT PRIMARY KEY,
 session_id VARCHAR(128),
 scheme_id INT,
 saved_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 UNIQUE(session_id,scheme_id),
 FOREIGN KEY(scheme_id) REFERENCES schemes(id)
 ON DELETE CASCADE
);

-- RECENTLY VIEWED TABLE
CREATE TABLE recently_viewed(
 id INT AUTO_INCREMENT PRIMARY KEY,
 session_id VARCHAR(128),
 scheme_id INT,
 viewed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 UNIQUE(session_id,scheme_id),
 FOREIGN KEY(scheme_id) REFERENCES schemes(id)
 ON DELETE CASCADE
);

-- =============================================
-- SCHEMES DATA
-- =============================================

INSERT INTO schemes
(cat,title,description,benefit,badge,deadline,deadline_type,link)
VALUES

('student',
'National Scholarship Portal',
'Scholarships for students from Class 1 to PhD',
'Rs 1000-20000 per month',
'Scholarship',
'31 October 2025',
'soon',
'https://scholarships.gov.in'),

('student',
'PM Scholarship Scheme',
'Scholarships for ex-servicemen children',
'Rs 36000 per year',
'Scholarship',
'30 November 2025',
'soon',
'https://ksb.gov.in'),

('student',
'Pragati Scholarship',
'Scholarship for girl students',
'Rs 50000 per year',
'Scholarship',
'31 December 2025',
'open',
'https://www.aicte-india.org'),

('farmer',
'PM Kisan Samman Nidhi',
'Income support for farmers',
'Rs 6000 per year',
'Income Support',
'Open',
'yearround',
'https://pmkisan.gov.in'),

('health',
'Ayushman Bharat',
'Health insurance scheme',
'Rs 5 lakh yearly',
'Insurance',
'Open',
'yearround',
'https://pmjay.gov.in');



-- =============================================
-- ELIGIBILITY DATA
-- =============================================

INSERT INTO eligibility (scheme_id,item) VALUES
(1,'Class 1 to PhD'),
(1,'SC/ST/OBC'),
(2,'Ex-servicemen children'),
(3,'Girl students'),
(4,'Small farmers'),
(5,'Income below 5 lakh');



-- =============================================
-- DOCUMENTS DATA
-- =============================================

INSERT INTO documents (scheme_id,item) VALUES
(1,'Aadhaar Card'),
(1,'Income Certificate'),
(1,'Caste Certificate'),
(2,'Identity Card'),
(2,'Marksheet'),
(3,'Aadhaar Card'),
(4,'Land Records'),
(5,'Ration Card');



-- =============================================
-- STEPS DATA
-- =============================================

INSERT INTO steps (scheme_id,step_no,item) VALUES

(1,1,'Visit scholarship portal'),
(1,2,'Register account'),
(1,3,'Fill application'),
(1,4,'Upload documents'),

(2,1,'Visit KSB website'),
(2,2,'Fill details'),

(3,1,'Register online'),
(3,2,'Upload documents'),

(4,1,'Register with Aadhaar'),
(4,2,'Verify bank account'),

(5,1,'Check eligibility'),
(5,2,'Get Ayushman card');