# sl
Personal nutrition and meal plan electronic record tool

To set up development enviroment:

1. Create mysql database:
mysql> create database sl charset="UTF8"
2. Import database schema and data
cmd> mysql -u <db-user-name> - p sl<sl.sql
3. Change application/config files:
config.php
database.php
to match your configuration
