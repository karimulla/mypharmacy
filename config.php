<?php

// Database server, username, password, and database name.

/*
define(M_DATABASE_SERVER, "mysql5017.smarterasp.net");
define(M_DATABASE_USER, "a0fdb5_mirakql");
define(M_DATABASE_PASSWORD, "mirakql1");
define(M_DATABASE_NAME, "db_a0fdb5_mirakql");
*/

define(M_DATABASE_SERVER, "SQL5031.SmarterASP.NET");
define(M_DATABASE_USER, "DB_A0FDB5_mirakql_admin");
define(M_DATABASE_PASSWORD, "mirakql1");
define(M_DATABASE_NAME, "DB_A0FDB5_mirakql");

mssql_connect('SQL5031.SmarterASP.NET', 'DB_A0FDB5_mirakql_admin', 'YOUR_DB_PASSWORD')
// Paths

define(M_ENV_SITE_ROOT, $_SERVER["DOCUMENT_ROOT"]);
define(M_ENV_SITE_URL, "http://".$_SERVER["HTTP_HOST"]);
//define(M_ENV_SITE_ROOT, SITE_ROOT_PLACEHOLDER);
//define(M_ENV_SITE_URL, SITE_URL_PLACEHOLDER);

// Autoload classes
function __autoload($classname)
{
	require(M_ENV_SITE_ROOT.'/include/'.$classname.'.class.php');
}

// An alternative
//array_walk(glob('./include/*.class.php'),create_function('$v,$i', 'return require_once($v);')); 

// Open database

$mysql_err = false;
$db = new sql();

if(!$db->connect(M_DATABASE_SERVER, M_DATABASE_USER, M_DATABASE_PASSWORD, M_DATABASE_NAME))
{
	$mysql_err = "Could not connect to database.";
}

// Represents all post and get variables

$post = new post($db);
$get = new get($db);

// Initialize current admin user

$user = new user($db);

// Initialize config object

$config = new config($db);

?>