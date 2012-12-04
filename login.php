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
	<span id='login'>
	<form id='login' action="#" method="post">
		<label id='user'>Email:</label><input id="user"  type="text" name="user" /><br />
		<label id='pass'>Password:</label><input id="pass" type="password" name="pass" /><br />
		<?if(isset($_REQUEST['dud'])) echo "<div id='dud'>Bad username or password!</div>";?>
		<button type="submit">Sign-In</button>
	</form>
	</span>
	</div>
	<?
		include_once("./footer.php");
	?>
</body>
</html>
