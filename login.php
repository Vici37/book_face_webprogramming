	<span id='login'>
	<form id='login' action="#" method="post">
		<div><label id='user'>Email:</label><input id="user"  type="text" name="user" /></div>
		<div><label id='pass'>Password:</label><input id="pass" type="password" name="pass" /></div>
		<?if(isset($_REQUEST['dud'])) echo "<div class=\"error\" id='dud'>Bad username or password!</div>";?>
		<input class="login" id="signin" type="submit" value="Sign-In"/>
		<a id="register" href="./index.php?register" ref="register">Register</a> 
	</form>
	</span>
	</div>
