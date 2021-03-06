<? 
 	//Define some global functions here...
	// This function will return a hash of the given text (for passwords)
	function _hash($text1,$text2) {
		$str = "";
		$str .= sha1($text1).md5($text2).sha1(md5($text1).md5($text2));
		return $str;
	}
	require_once("./db_connect.inc");
	session_start(); 
	if(!isset($_SESSION['user']) || !isset($_SESSION['user_id'])){
		if (isset($_REQUEST["user"],$_REQUEST["pass"])) {
			$hash = _hash($_REQUEST['user'],$_REQUEST['pass']);
			$query = "SELECT email, user_id FROM users WHERE email='".$_REQUEST['user']."' AND password='".$hash."'";
			$results = $db->query($query);
			if ($results->num_rows == 1) {
				$_SESSION['user']=$_REQUEST['user'];
				$userid=$results->fetch_assoc();
				$_SESSION['user_id']=$userid['user_id'];
				header('location:./index.php');
			} else {
				header('location:?dud=1');
			}
		} 
	} 
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta content="text/html; charset=iso-8859-1" http-equiv="content-type" />
		<title>My Book Face</title>
		<link rel="stylesheet" href="styles/register.css" type="text/css" />
		<link rel="stylesheet" href="styles/comments.css" type="text/css" />
		<link rel="stylesheet" href="styles/login.css" type="text/css" />
		<link rel="stylesheet" href="styles/header.css" type="text/css" />
		<link rel="stylesheet" href="styles/friends.css" type="text/css" />
		<link rel="stylesheet" href="styles/about.css" type="text/css" />
		<link rel="stylesheet" href="styles/master.css" type="text/css" />
		<link rel="stylesheet" href="styles/edit.css" type="text/css" />
		<link rel="stylesheet" href="styles/home.css" type="text/css" />
		<link rel="stylesheet" href="styles/footer.css" type="text/css" />
		<link rel="stylesheet" href="styles/members.css" type="text/css" />
		<link rel="stylesheet" href="styles/profile.css" type="text/css" />
		<link rel="shortcut icon" href="images/book_face.png" type="image/x-icon" />
	</head>
	<body>
	<? 
		include_once("./header.php");
		// $location will eventually contain the information of what page
		// we're on.
		$location = explode('?', $_SERVER['REQUEST_URI'], 2);
		$pos = stripos($location[1],'&');
		if($pos) {
			$location = substr($location[1],0,$pos);
		} else {
			$location = $location[1];
		}

		// Start the session
		session_start();

		// First block of if statements for things that don't care if 
		// you're logged in or not

		// about page
		if ($location == "about") {
			include_once("./about.php");
		} 

		// Next block for if not logged in (login or register pages)
		else if(!isset($_SESSION['user']) || !isset($_SESSION['user_id'])){
			// register page
			if($location == "register"){
				include_once("./register.php");
			} else { 
				include_once("./login.php");
			}
		} 
		// This block for logged in. Either at home or profile page
		else {
			// Display normal page
			?>
			<div id="content">
				<?
					switch ($location) {
						// Profile page
						case 'profile':
							include_once("./profile.php");
							break;
						// Members page
						case 'members':
							include_once("./member.inc");
							break;
						// Home page
						case 'friends':
							include_once("./friends.inc");
							break;
						case 'comments':
							include_once("./comments.php");
							break;
						default:
							include_once("./home.inc");
							break;
					}
				?>
			</div>
		<? }
	?>
	<?
		include_once("./footer.php");
	?>
	</body>
</html>
