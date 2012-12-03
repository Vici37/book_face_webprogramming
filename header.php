<? //Define some global functions here...
	// This function will return a hash of the given text (for passwords)
	function _hash($text1,$text2) {
		$str = "";
		$str .= sha1($text1).md5($text2).sha1(md5($text1).md5($text2));
		return $str;
	}
?>
<div id="header">
<!--	<a href="./index.php" ref="home">
		<img src="images/BookFace2.jpg" alt="logo" />
	</a><br/>--!>
	<div id="menu">
		<? 
			session_start();
			// Display these links only if not logged in
			if(!isset($_SESSION['user']) || !isset($_SESSION['user_id'])) {
		?>
			<a href="./index.php?register" ref="register">Register</a> |
		<? }
		// Display these links only if logged in
		else { ?>
			<a href="./index.php?members" ref="members">Members</a> |
			<a href="./index.php?friends" ref="friends">My Friends</a> |
			<a href="./index.php?profile&id=<? echo $_SESSION['user_id']?>" ref="profile">My Profile</a> |
			<a href="./logout.php" ref="logout">Logout</a> |
			<? if($_REQUEST['id'] == $_SESSION['user_id']) { ?>
				<a href="./index.php?profile&id=<? echo $_REQUEST['id']; ?>&edit=1" ref="edit">Edit</a> |
			<? } ?>
		<? }//Always display these links ?>
		<a href="./index.php?about" ref="about">About</a>
	</div>
</div>
