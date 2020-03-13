<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
| DATABASE CONNECTIVITY SETTINGS
| -------------------------------------------------------------------
| This file will contain the settings needed to access your database.
|
| For complete instructions please consult the 'Database Connection'
| page of the User Guide.
|
| -------------------------------------------------------------------
| EXPLANATION OF VARIABLES
| -------------------------------------------------------------------
|
|	['hostname'] The hostname of your database server.
|	['username'] The username used to connect to the database
|	['password'] The password used to connect to the database
|	['database'] The name of the database you want to connect to
|	['dbdriver'] The database type. ie: mysql.  Currently supported:
				 mysql, mysqli, postgre, odbc, mssql, sqlite, oci8
|	['dbprefix'] You can add an optional prefix, which will be added
|				 to the table name when using the  Active Record class
|	['pconnect'] TRUE/FALSE - Whether to use a persistent connection
|	['db_debug'] TRUE/FALSE - Whether database errors should be displayed.
|	['cache_on'] TRUE/FALSE - Enables/disables query caching
|	['cachedir'] The path to the folder where cache files should be stored
|	['char_set'] The character set used in communicating with the database
|	['dbcollat'] The character collation used in communicating with the database
|				 NOTE: For MySQL and MySQLi databases, this setting is only used
| 				 as a backup if your server is running PHP < 5.2.3 or MySQL < 5.0.7
|				 (and in table creation queries made with DB Forge).
| 				 There is an incompatibility in PHP with mysql_real_escape_string() which
| 				 can make your site vulnerable to SQL injection if you are using a
| 				 multi-byte character set and are running versions lower than these.
| 				 Sites using Latin-1 or UTF-8 database character set and collation are unaffected.
|	['swap_pre'] A default table prefix that should be swapped with the dbprefix
|	['autoinit'] Whether or not to automatically initialize the database.
|	['stricton'] TRUE/FALSE - forces 'Strict Mode' connections
|							- good for ensuring strict SQL while developing
|
| The $active_group variable lets you choose which connection group to
| make active.  By default there is only one group (the 'default' group).
|
| The $active_record variables lets you determine whether or not to load
| the active record class
*/

$active_group = 'default';
$active_record = TRUE;

$db['default']['hostname'] = '192.168.10.21';
$db['default']['username'] = 'root';
$db['default']['password'] = 'SfcmUxj7';
$db['default']['database'] = 'db_leave';
$db['default']['dbdriver'] = 'mysql';
$db['default']['dbprefix'] = '';
$db['default']['pconnect'] = TRUE;
$db['default']['db_debug'] = TRUE;
$db['default']['cache_on'] = FALSE;
$db['default']['cachedir'] = '';
$db['default']['char_set'] = 'utf8';
$db['default']['dbcollat'] = 'utf8_general_ci';
$db['default']['swap_pre'] = '';
$db['default']['autoinit'] = TRUE;
$db['default']['stricton'] = FALSE;



// $db['db_a1']['hostname'] = '192.168.20.4';
// $db['db_a1']['username'] = 'MDI';
// $db['db_a1']['password'] = 'gvH,fuwv';
// $db['db_a1']['database'] = 'a1';
// $db['db_a1']['dbdriver'] = 'mssql';
// $db['db_a1']['dbprefix'] = '';
// $db['db_a1']['pconnect'] = TRUE;
// $db['db_a1']['db_debug'] = TRUE;
// $db['db_a1']['cache_on'] = FALSE;
// $db['db_a1']['cachedir'] = '';
// $db['db_a1']['char_set'] = 'utf8';
// $db['db_a1']['dbcollat'] = 'utf8_general_ci';
// $db['db_a1']['swap_pre'] = '';
// $db['db_a1']['autoinit'] = TRUE;
// $db['db_a1']['stricton'] = FALSE;

$clearancename = '(DESCRIPTION = (ADDRESS = (PROTOCOL = TCP)(HOST = 192.168.20.4)(PORT = 1433))
        (CONNECT_DATA = (SERVER = DEDICATED) (SERVICE_NAME = MEIKODATABASE)))';

$db['clearance']['hostname'] = '192.168.20.4';
$db['clearance']['username'] = 'MDI';
$db['clearance']['password'] = 'gvH,fuwv';
$db['clearance']['database'] = 'a1';
$db['clearance']['dbdriver'] = 'mssql';
$db['clearance']['dbprefix'] = '';
$db['clearance']['pconnect'] = TRUE;
$db['clearance']['db_debug'] = TRUE;
$db['clearance']['cache_on'] = FALSE;
$db['clearance']['cachedir'] = '';
$db['clearance']['char_set'] = 'utf8';
$db['clearance']['dbcollat'] = 'utf8_general_ci';
$db['clearance']['swap_pre'] = '';
$db['clearance']['autoinit'] = TRUE;
$db['clearance']['stricton'] = FALSE;



$db['db_p']['hostname'] = '192.168.10.21';
$db['db_p']['username'] = 'root';
$db['db_p']['password'] = 'SfcmUxj7';
$db['db_p']['database'] = 'mform';
$db['db_p']['dbdriver'] = 'mysql';
$db['db_p']['dbprefix'] = '';
$db['db_p']['pconnect'] = TRUE;
$db['db_p']['db_debug'] = TRUE;
$db['db_p']['cache_on'] = FALSE;
$db['db_p']['cachedir'] = '';
$db['db_p']['char_set'] = 'utf8';
$db['db_p']['dbcollat'] = 'utf8_general_ci';
$db['db_p']['swap_pre'] = '';
$db['db_p']['autoinit'] = TRUE;
$db['db_p']['stricton'] = FALSE;

/* End of file database.php */
/* Location: ./application/config/database.php */