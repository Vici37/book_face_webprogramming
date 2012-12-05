<div id="header">
	<div id="menu">
		<? 
			// Display these links only if not logged in
			if(!isset($_SESSION['user']) || !isset($_SESSION['user_id'])) {
		?>
			<a href="./index.php" ref="login">Login</a> |
			<a href="./index.php?about" ref="about">About</a>
		<? }
		// Display these links only if logged in
		else { ?>
		<div id="loggedInMenu" >
			<a href="./index.php" ref="home">Home</a> |
			<a href="./index.php?members" ref="members">Members</a> |
			<a href="./index.php?friends" ref="friends">My Friends</a> |
			<a href="./index.php?profile&id=<? echo $_SESSION['user_id']?>" ref="profile">My Profile</a> |
			<a href="./logout.php" ref="logout">Logout</a> |
			<? if($_REQUEST['id'] == $_SESSION['user_id']) { ?>
				<a href="./index.php?profile&id=<? echo $_REQUEST['id']; ?>&edit=1" ref="edit">Edit</a> |
			<? } ?>
		<a href="./index.php?about" ref="about">About</a>
		</div>
		<? } ?>
	</div>
</div>
