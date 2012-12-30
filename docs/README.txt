1. Run the permissions.sh shell script from within the project root (cd to the project root first).
   Note: an error message of 'chmod: cannot access `\r`: No such file or directory' is normal. 
2. Execute the db_schema.sql file located in config/db_scripts/
3. Execute the db_inserts.sql file located in config/db_scripts/
4. Change FILE_ROOT and DOC_ROOT in lib/init.inc.php to reflect your local directory location. 
5. Change SQL constants in config/constants.config.php to work with your MySQL connection.
6. Navigate to the location of your install in your web browser of choice. 