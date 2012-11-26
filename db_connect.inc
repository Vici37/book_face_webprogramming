<?
	// Script for connecting to the database...
	include("./constants.inc");
	$db = new mysqli($host, $user, $password, $database);
	if(mysqli_connect_errno()){
		echo $host." ".$database." ".$password." ".$user;
		echo "<strong>Could not connect to database!</strong>";
	}
?>
