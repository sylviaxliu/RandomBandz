# RandomBandz

## Package Installations

need to have npm

npm install sass

## Running Front End

cd frontEnd
npm run dev

will show up on localhost:3000

## Running Back End

Current method of running Local Database:

1. Download installer for your operating system here
https://dev.mysql.com/doc/mysql-getting-started/en/

2. Mostly follow the method outlined here. In essence install the "server-machine" option
and have a way to turn it off and on like on Windows it's a service.
https://docs.oracle.com/en/java/java-components/advanced-management-console/2.22/install-guide/mysql-database-installation-and-configuration-advanced-management-console.html#GUID-8A4D0768-3B2D-44CF-A232-5A237A5824D0

3. Create a user to test with. I recommend:
"create user 'test'@'localhost' identified by 'test'"

4. Create a database to test with. I recommend:
"create database RandomBandzDev"

5. Give all permissions on database to test
"grant all on <database>.* to '<user>'"

From there you can use that user to access the database. Use the file tables.sql
to load all the tables with primary keys into the project.
