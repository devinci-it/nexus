USE vdetorre_project;

CREATE TABLE IF NOT EXISTS de_torres_vincent_session_tokens
(
    id            INT AUTO_INCREMENT PRIMARY KEY,
    user_id       INT NOT NULL,
    session_token VARCHAR(255) NOT NULL,
    expiration    DATETIME,
    status        ENUM('active', 'expired') DEFAULT 'active' NOT NULL,
    CONSTRAINT de_torres_vincent_session_tokens_ibfk_1
        FOREIGN KEY (user_id) REFERENCES de_torres_vincent_users (id)
            ON DELETE CASCADE
);

CREATE INDEX IF NOT EXISTS user_id
    ON de_torres_vincent_session_tokens (user_id);
