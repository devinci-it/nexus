USE vdetorre_project;

CREATE TABLE IF NOT EXISTS de_torres_vincent_users
(
    id             INT AUTO_INCREMENT PRIMARY KEY,
    firstname      VARCHAR(50) NOT NULL,
    lastname       VARCHAR(50) NOT NULL,
    username       VARCHAR(50),
    email          VARCHAR(100) NOT NULL UNIQUE,
    password       VARCHAR(255) NOT NULL,
    contact_number VARCHAR(20),
    address        TEXT,
    access_level   ENUM('user', 'admin') DEFAULT 'user' NOT NULL,
    status         ENUM('pending', 'confirmed') DEFAULT 'pending' NOT NULL,
    access_code    VARCHAR(100),
    created_at     TIMESTAMP DEFAULT CURRENT_TIMESTAMP() NOT NULL,
    updated_at     TIMESTAMP DEFAULT CURRENT_TIMESTAMP() ON UPDATE CURRENT_TIMESTAMP() NOT NULL,
    session_token  VARCHAR(255),
    UNIQUE (email),
    UNIQUE (username)
);
