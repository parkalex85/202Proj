<?php

function getConnection(){
	$host = "localhost";
	$dbName = "ProjectTables";
	$username = "root";
	$password = "password";

	try{
		$dbConn = new PDO("mysql:host=$host;dbname=$dbName", $username, $password);

		$dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		return $dbConn;
	}

	catch(Exception $e){
		return $e;
	}
}


?>
