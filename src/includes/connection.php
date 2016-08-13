<?php

// Connecting to the database
$db['db_host'] = "localhost";
$db['db_user'] = "root";
$db['db_pass'] = "";
$db['db_name'] = "social_network";

foreach ($db as $key => $value) {
	define ( strtoupper( $key ), $value );
}

$connection = mysqli_connect( DB_HOST, DB_USER, DB_PASS, DB_NAME ) or die( "Connection was not established" );

?>