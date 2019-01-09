--
-- CREATE DATABASE IF NOT EXISTS daib17;
USE ramverk1;


--
-- Create a database user for the test database
--
-- GRANT ALL ON ramverk1.* TO user@localhost IDENTIFIED BY 'pass';


-- Ensure UTF8 on the database connection
SET NAMES utf8;


--
-- Table Comment
--
DROP TABLE IF EXISTS Comment;
CREATE TABLE Comment (
    `id` INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `body` TEXT NOT NULL,
    `questionid` INTEGER DEFAULT NULL,
    `answerid` INTEGER DEFAULT NULL,
    `userid` INTEGER NOT NULL,
    `created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE INNODB CHARACTER SET utf8 COLLATE utf8_swedish_ci;
