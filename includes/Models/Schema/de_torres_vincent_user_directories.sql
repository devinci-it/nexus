USE vdetorre_project;

CREATE TABLE IF NOT EXISTS de_torres_vincent_user_directories
(
    id             INT AUTO_INCREMENT PRIMARY KEY,
    user_id        INT NOT NULL,
    directory_id   VARCHAR(32) NOT NULL,
    directory_name VARCHAR(255) NOT NULL,
    date_added     TIMESTAMP DEFAULT CURRENT_TIMESTAMP() NOT NULL,
    last_modified  TIMESTAMP DEFAULT CURRENT_TIMESTAMP() ON UPDATE CURRENT_TIMESTAMP() NOT NULL,
    last_accessed  TIMESTAMP,
    directory_path VARCHAR(255) NOT NULL,
    username       VARCHAR(50),
    CONSTRAINT de_torres_vincent_user_directories_ibfk_1
        FOREIGN KEY (user_id) REFERENCES de_torres_vincent_users (id)
            ON DELETE CASCADE
);

CREATE INDEX IF NOT EXISTS user_id
    ON de_torres_vincent_user_directories (user_id);
