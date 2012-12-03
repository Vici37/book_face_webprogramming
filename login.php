<DOCTYPE html>
<html>
<head>
	<title>My Book Face</title>
	<link rel="stylesheet" href="styles/login.css" type="text/css" />
</head>
<body>
	<?
		include_once("./header.php");
		require_once("./db_connect.inc");
	?>
	<div id='login'>
	<form action="#" method="post">
		<label>Email:</label><input type="text" name="user" /><br />
		<label>Password:</label><input type="password" name="pass" /><br />
		<button type="submit">Sign-In</button>
	</form>
	</div>
	<?
		include_once("./footer.php");
	?>
</body>
</html>
