<?php
error_reporting(-1);
ini_set('display_errors', 'On');
set_error_handler("var_dump");
DEFINE('DATABASE_USER', 'root');
DEFINE('DATABASE_PASSWORD', '');
DEFINE('DATABASE_HOST','localhost');
DEFINE('DATABASE_NAME','users');

date_default_timezone_set('Europe/Bucharest');



define('EMAIL', 'localhost');

DEFINE('WEBSITE_URL','http://localhost');

$dbc = @mysqli_connect(DATABASE_HOST,DATABASE_USER,DATABASE_PASSWORD,DATABASE_NAME);
/**$sql = "CREATE TABLE if NOT EXISTS 'users' (
 'Userid' int(10) NOT NULL AUTO_INCREMENT,
  'username' varchar(20) NOT NULL,
  'email' varchar(20) NOT NULL,
  'password' varchar(10) NOT NULL,
  'activation' varchar(40) DEFAULT NULL,
  PRIMARY KEY('Userid'),
)ENGINE = MyISAM DEFAULT CHARSET = latin1 AUTO_INCREMENT = 22";
mysql_query($sql);*/
if(!$dbc){
	trigger_error('Could not connect to MySQL: ' . mysql_error());
}


?>
