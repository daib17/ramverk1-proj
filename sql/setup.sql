--
-- Create database ramverk1
--
CREATE DATABASE IF NOT EXISTS ramverk1;

--
USE ramverk1;

--
-- Create a database user for the database
--
GRANT ALL ON ramverk1.* TO user@localhost IDENTIFIED BY 'pass';

-- Ensure UTF8 on the database connection
SET NAMES utf8;
