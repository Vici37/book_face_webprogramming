<? //Define some global functions here...
	function _hash($text) {
		$str = "";

		return $str;
	}
?>
<div id="header">
	<img src="images/bookface1.jpg" alt="logo" /><br/>
	<div id="menu">
		<? 
			session_start();
			if(!isset($_SESSION['user']) || !isset($_SESSION['user_id'])){
		?>
		<a href="./register.php" ref="register">Register</a> |
		<? } else { ?>
		<a href="./profile.php?id=0" ref="profile">My Profile</a> |
		<a href="./logout.php" ref="logout">Logout</a> |
		<? }//Always display these links ?>
		<a href="./about.php" ref="about">About</a>
	</div>
</div>
