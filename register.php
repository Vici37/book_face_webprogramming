<!DOCTYPE HTML>
<html>
<head>
	<meta content="text/html; charset=iso-8859-1" http-equiv="content-type" />
	<title>Create Account</title>
	
</head>
<body>
	<?
		include_once("./header.php");
		require_once("./db_connect.inc");
		if(isset($_REQUEST['registering'])) {
			//Check information...

			//Assuming everything works
			$query = "INSERT INTO users (email,password,user_id) VALUES ('".$_REQUEST['email']."','"._hash($_REQUEST['email'],$_REQUEST['password'])."',NULL)";
			$db->query($query);
			header('location:/');
		}
	?>
	<form action="" method="post" accept-charset="utf-8">
		<label for="fname">First Name</label><input type="text" name="fname" value="" id="fname"><br/>
		<label for="lname">Last Name</label><input type="text" name="lname" value="" id="lname"><br/>
		<label for="email">Email</label><input type="text" name="email" value="" id="email"><br/>
		<label for="password">Password:</label><input type="text" name="password" value="" id="password"><br/>
		<label for="Confirm Password">Confirm Password</label><input type="text" name="confirm" value="" id="Confirm Password"><br/>
		<label for="gender">Gender</label><input type="radio" name="gender" value="male" id="gender"> Male
		<input type="radio" name="gender" value="female"> Female <br/>
		<input type="hidden" name="registering" value="1">
	<p><input type="submit" value="Continue &rarr;"></p>
	</form>
	<?
		include_once("./footer.php");
	?>
</body>
</html>
