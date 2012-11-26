<!DOCTYPE HTML>
<html>
	<head>
		<meta content="text/html; charset=iso-8859-1" http-equiv="content-type" />
		<title>My Book Face</title>
	</head>
	<body>
	<? 
		include_once("./header.php");
		require_once("./db_connect.inc");
		session_start();
		//If user isn't logged in, display login
		if(!isset($_SESSION['user']) || !isset($_SESSION['user_id'])){
			if (isset($_REQUEST["user"],$_REQUEST["pass"])) {
				// TODO: check if credentials work
				$hash = _hash($_REQUEST['pass']);
				$query = "SELECT name, user_id FROM users WHERE name='".$_REQUEST['user']."' AND password='".$hash."'";
				$results = $db->query($query);
				if ($results->num_rows == 1) {
					$_SESSION['user']=$_REQUEST['user'];
					$userid=$results->fetch_assoc();
					$_SESSION['user_id']=$userid['user_id'];
					header('location:');
				}
				header('location:?dud=1');
			} else { 
				if(isset($_REQUEST['dud'])) echo "<div id='dud'>Bad username or password!</div>";
				?>
				<div id="login">
					<form action="" method="post">
						<label>Username:</label><input type="text" name="user" /><br />
						<label>Password:</label><input type="password" name="pass" /><br />
						<button type="submit">Sign-In</button>
					</form>
				</div>	<?
			}
		} else {
			// Display normal page
			echo "logged in";
		}
	?>
	<?
		include_once("./footer.php");
	?>
	</body>
</html>
