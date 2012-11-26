<? //Define some global functions here...
	// This function will return a hash of the given text (for passwords)
	function _hash($text1,$text2) {
		$str = "";

		return $str;
	}
?>
<div id="header">
	<a href="./index.php" ref="home">
		<img src="images/bookface1.jpg" alt="logo" />
	</a><br/>
	<div id="menu">
		<? 
			session_start();
			// Display these links only if not logged in
			if(!isset($_SESSION['user']) || !isset($_SESSION['user_id'])) {
		?>
			<a href="./register.php" ref="register">Register</a> |
		<? }
		// Display these links only if logged in
		else { ?>
			<a href="./profile.php?id=0" ref="profile">My Profile</a> |
			<a href="./logout.php" ref="logout">Logout</a> |
		<? }//Always display these links ?>
		<a href="./about.php" ref="about">About</a>
	</div>
</div>
