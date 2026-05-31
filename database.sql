-- ============================================================
-- database.sql
-- ============================================================
-- Run this file in phpMyAdmin to create and populate the
-- hospital database from scratch.
-- ============================================================

CREATE DATABASE IF NOT EXISTS hospital;
USE hospital;

-- Drop in child-first order (foreign key constraint order)
DROP TABLE IF EXISTS appointmenttb;
DROP TABLE IF EXISTS doctb;
DROP TABLE IF EXISTS patreg;
DROP TABLE IF EXISTS specialtb;


-- ============================================================
-- TABLE 1: specialtb (Doctor Specializations)
-- ============================================================
CREATE TABLE specialtb (
    id             INT(11)      NOT NULL AUTO_INCREMENT,
    specialization VARCHAR(100) NOT NULL,
    PRIMARY KEY (id)
);

INSERT INTO specialtb (specialization) VALUES
('Cardiology'),
('Pediatrics'),
('Dermatology'),
('Neurology'),
('General Medicine');


-- ============================================================
-- TABLE 2: patreg (Patients)
-- NOTE: The password column is reserved for future login use
-- and is NOT used by the current system.
-- DEFAULT '' means inserts that omit it won't fail.
-- ============================================================
CREATE TABLE patreg (
    id         INT(11)                          NOT NULL AUTO_INCREMENT,
    fname      VARCHAR(50)                      NOT NULL,
    lname      VARCHAR(50)                      NOT NULL,
    email      VARCHAR(100)                     NOT NULL,
    password   VARCHAR(255)                     NOT NULL DEFAULT '',  -- unused, reserved
    contact    VARCHAR(15)                      NOT NULL,
    gender     ENUM('Male', 'Female', 'Other')  NOT NULL DEFAULT 'Other',
    created_at DATETIME                         NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
);

-- Password column is omitted from inserts — defaults to ''
INSERT INTO patreg (fname, lname, email, contact, gender) VALUES
('Alice', 'Reyes',  'alice@email.com', '09171234567', 'Female'),
('Ben',   'Torres', 'ben@email.com',   '09281234567', 'Male'),
('Clara', 'Santos', 'clara@email.com', '09391234567', 'Female'),
('Diego', 'Cruz',   'diego@email.com', '09401234567', 'Male');


-- ============================================================
-- TABLE 3: doctb (Doctors)
-- NOTE: Same as patreg — password column reserved, not in use.
-- ============================================================
CREATE TABLE doctb (
    id         INT(11)       NOT NULL AUTO_INCREMENT,
    name       VARCHAR(100)  NOT NULL,
    email      VARCHAR(100)  NOT NULL,
    password   VARCHAR(255)  NOT NULL DEFAULT '',  -- unused, reserved
    spec_id    INT(11)       NOT NULL,
    docFees    DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    created_at DATETIME      NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    FOREIGN KEY (spec_id) REFERENCES specialtb(id) ON DELETE RESTRICT
);

-- spec_id: 1=Cardiology 2=Pediatrics 3=Dermatology 4=Neurology 5=General Medicine
-- Password column omitted — defaults to ''
INSERT INTO doctb (name, email, spec_id, docFees) VALUES
('Dr. Juan Dela Cruz', 'juan@hospital.com',  1, 500.00),
('Dr. Maria Santos',   'maria@hospital.com', 2, 400.00),
('Dr. Pedro Reyes',    'pedro@hospital.com', 3, 450.00),
('Dr. Ana Gonzales',   'ana@hospital.com',   4, 600.00),
('Dr. Jose Bautista',  'jose@hospital.com',  5, 350.00);


-- ============================================================
-- TABLE 4: appointmenttb (Appointments)
-- ============================================================
-- STATUS: Only 'Pending' is used by the booking forms.
-- All new and edited appointments are saved as 'Pending'.
-- ============================================================
CREATE TABLE appointmenttb (
    id       INT(11)           NOT NULL AUTO_INCREMENT,
    pid      INT(11)           NOT NULL,
    did      INT(11)           NOT NULL,
    apdate   DATE              NOT NULL,
    aptime   TIME              NOT NULL,
    reason   TEXT              DEFAULT NULL,
    status   ENUM('Pending')   NOT NULL DEFAULT 'Pending',

    PRIMARY KEY (id),
    FOREIGN KEY (pid) REFERENCES patreg(id) ON DELETE CASCADE,
    FOREIGN KEY (did) REFERENCES doctb(id)  ON DELETE CASCADE
);

-- Sample appointments — all valid clinic times, all future dates
INSERT INTO appointmenttb (pid, did, apdate, aptime, reason, status) VALUES
(1, 1, '2026-06-01', '09:00:00', 'Chest pain',    'Pending'),
(2, 3, '2026-06-02', '10:30:00', 'Skin rash',      'Pending'),
(3, 2, '2026-06-03', '14:00:00', 'Child fever',    'Pending'),
(4, 5, '2026-06-04', '11:00:00', 'Annual checkup', 'Pending');
