DROP DATABASE IF EXISTS readme;
CREATE DATABASE IF NOT EXISTS readme
DEFAULT CHARACTER SET utf8mb4
DEFAULT COLLATE utf8mb4_general_ci;

USE readme;

CREATE TABLE IF NOT EXISTS users (
    id INT NOT NULL AUTO_INCREMENT,
    dt_add DATETIME DEFAULT CURRENT_TIMESTAMP,
    email VARCHAR(128) NOT NULL UNIQUE,
    login VARCHAR(128) NOT NULL UNIQUE, 
    password VARCHAR(255) NOT NULL,
    avatar TEXT,
    PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS hashtags (
    id INT NOT NULL AUTO_INCREMENT,
    hashtag_name VARCHAR(255) NOT NULL UNIQUE,
    PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS content_types (
    id INT NOT NULL AUTO_INCREMENT,
    title VARCHAR(64) UNIQUE,
    class_name VARCHAR(64) UNIQUE,
    PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS posts (
    id INT NOT NULL AUTO_INCREMENT,
    dt_add DATETIME DEFAULT CURRENT_TIMESTAMP,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    author VARCHAR(255),
    image TEXT,
    video TEXT,
    link TEXT,
    show_count INT,
    author_id INT NOT NULL,
    content_type TEXT NOT NULL,
    hashtags_id INT,
    user_id INT NOT NULL,
    content_type_id INT NOT NULL,
    PRIMARY KEY (id),
    CONSTRAINT fk_posts_user FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_posts_content_type FOREIGN KEY (content_type_id) REFERENCES content_types (id) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_posts_hashtags_id FOREIGN KEY (hashtags_id) REFERENCES hashtags (id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS comments (
    id INT NOT NULL AUTO_INCREMENT,
    dt_add DATETIME DEFAULT CURRENT_TIMESTAMP,
    content TEXT NOT NULL,
    user_id INT NOT NULL,
    post_id INT NOT NULL,
    PRIMARY KEY (id),
    CONSTRAINT fk_comments_user FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_comments_post FOREIGN KEY (post_id) REFERENCES posts (id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS likes (
    id INT NOT NULL AUTO_INCREMENT,
    user_id INT NOT NULL,
    post_id INT NOT NULL,
    PRIMARY KEY (id),
    CONSTRAINT fk_likes_user FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_likes_post FOREIGN KEY (post_id) REFERENCES posts (id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS subscribes (
    id INT NOT NULL AUTO_INCREMENT,
    user_id INT NOT NULL,
    subscribe_id INT NOT NULL,
    PRIMARY KEY (id),
    CONSTRAINT fk_subscribes_user FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_subscribes_subscriber FOREIGN KEY (subscribe_id) REFERENCES users (id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS messages (
    id INT NOT NULL AUTO_INCREMENT,
    dt_add DATETIME DEFAULT CURRENT_TIMESTAMP,
    content TEXT NOT NULL,
    author_id INT NOT NULL,
    recipient_id INT NOT NULL,
    PRIMARY KEY (id),
    CONSTRAINT fk_messages_author FOREIGN KEY (author_id) REFERENCES users (id) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_messages_recipient FOREIGN KEY (recipient_id) REFERENCES users (id) ON DELETE CASCADE ON UPDATE CASCADE
);