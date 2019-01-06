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
-- Table User
--
DROP TABLE IF EXISTS User;
CREATE TABLE User (
    `id` INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `acronym` VARCHAR(80) UNIQUE NOT NULL,
    `name` VARCHAR(80) NOT NULL,
    `email` VARCHAR(256) NOT NULL,
    `password` VARCHAR(256) NOT NULL,
    `gravatar` VARCHAR(256),
    `created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE INNODB CHARACTER SET utf8 COLLATE utf8_swedish_ci;
