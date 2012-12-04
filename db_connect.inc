<?
	// Script for connecting to the database...
	include("./db_login_constants.inc");
	$db = new mysqli($host, $user, $password, $database);
	if(mysqli_connect_errno()){
		echo "<strong>Could not connect to database!</strong>";
	}
?>
