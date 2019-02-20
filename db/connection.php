 <?php
// $mysql_hostname = "localhost";
// $mysql_user = "root";
// $mysql_password = "masterzuzumymw";
// $mysql_database = "dealers";
// $prefix = "";
// $bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) or die("Could not connect database");
// mysql_select_db($mysql_database, $bd) or die("Could not select database");

//
	$DbHostName = "localhost";
	$DbUsername = "root";
	$dbPassword = "";
	$dbName     = "dealers";
	$dbConn     = null;

	try {
		$dbConn = new PDO("mysql:host={$DbHostName};dbname={$dbName};", $DbUsername, $dbPassword);
	
	} catch (Exception $e) {
		die("Error: ". $e->getMessage());
	}

 ?>