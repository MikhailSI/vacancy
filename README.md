# vacancy
Vacancy application

Installation

Packages:
MySQL 5.5
php 5.5
nginx 1.4.6

Move file Dump/nginx-conf to nginx vhosts folder and change 'root' to 'docroot' application folder.
Create database 'vacancy' with user 'admin' password 'qwer', with all privileges/ or change db connection data in \Base\Config::db
Load database dump Dump/dumpfile.sql to selected database.
