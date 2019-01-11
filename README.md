All About MotoGP
==================================

[![Build Status](https://travis-ci.com/daib17/ramverk1-proj.svg?branch=master)](https://travis-ci.com/daib17/ramverk1-proj)



Installation
==================================
This is how you install All About MotoGP.

## Clone GitHub repository
```
git clone https://github.com/daib17/ramverk1-proj.git
```

## Run Composer update
```
composer update
```

## Create database
Run sql/setup.sql to create the database and user, sql/ddl/create_tables.sql to create the tables and sql/dml/insert_data.sql to insert data in the database.

Make a copy of the config/database_sample.php file, rename it as config/database.php and modify details for dsn, user and password.
