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
-- Table Tag
--
DROP TABLE IF EXISTS Tag;
CREATE TABLE Tag (
    `id` INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `questionid` INTEGER NOT NULL,
    `name` VARCHAR(80) NOT NULL
) ENGINE INNODB CHARACTER SET utf8 COLLATE utf8_swedish_ci;
