<DOCTYPE html>
<html>
<head>
	<title>My Book Face</title>
</head>
<body>
	<?
		include_once("./header.php");
		require_once("./db_connect.inc");
	?>
	<form action="#" method="post">
		<div id="login">
		<label>Username:</label><input type="text" name="user" /><br />
		<label>Password:</label><input type="password" name="pass" /><br />
		<button type="submit">Sign-In</button>
	</form>
	</div>
</body>
</html>
