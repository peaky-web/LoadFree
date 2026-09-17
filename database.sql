CREATE DATABASE IF NOT EXISTS loadfree CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE loadfree;

CREATE TABLE IF NOT EXISTS users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(30) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS claims (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT UNSIGNED NOT NULL,
    reward_name VARCHAR(100) NOT NULL,
    reward_value VARCHAR(50) NOT NULL,
    reward_type VARCHAR(20) NOT NULL,
    status VARCHAR(30) NOT NULL DEFAULT 'RECORDED',
    claimed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_claim_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Passwords are stored as plain text for this version.
UPDATE claims SET status = 'RECORDED' WHERE status <> 'RECORDED';
DELETE FROM users WHERE username = 'demo';
