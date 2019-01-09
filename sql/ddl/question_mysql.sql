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
-- Table Question
--
DROP TABLE IF EXISTS Question;
CREATE TABLE Question (
    `id` INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `title` VARCHAR(120) NOT NULL,
    `body` TEXT NOT NULL,
    `tags` VARCHAR(120) NOT NULL,
    `userid` INTEGER NOT NULL,
    `created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE INNODB CHARACTER SET utf8 COLLATE utf8_swedish_ci;
