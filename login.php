<div id='login'>
	<span id='login'>
	<form id='login' action="#" method="post">
		<label id='user'>Email:</label><input id="user"  type="text" name="user" /><br />
		<label id='pass'>Password:</label><input id="pass" type="password" name="pass" /><br />
		<?if(isset($_REQUEST['dud'])) echo "<div id='dud'>Bad username or password!</div>";?>
		<input class="login" id="signin" type="submit" value="Sign-In"/>
		<a id="register" href="./index.php?register" ref="register">Register</a> 
	</form>
	</span>
	</div>
