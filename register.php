<?
	if(isset($_REQUEST['registering'])) {
		//Check information...

		$error = "";
		if($_REQUEST['fname'] == null) $error .= "First name required.<br/>";
		if($_REQUEST['lname'] == null) $error .= "Last name required.<br/>";
		if($_REQUEST['password'] != $_REQUEST['confirm']) $error .= "Passwords don't match.<br/>";
		if($_REQUEST['password'] == null) $error .= "Password can't be blank.<br/>";
		// Check email
		if($_REQUEST['email'] == null) $error .= "Email can't be left blank.<br/>";
		else if(!(preg_match("/^\s*[\w\-\+_]+(\.[\w\-\+_]+)*\@[\w\-\+_]+\.[\w\-\+_]+(\.[\w\-\+_]+)*\s*$/",
				$_REQUEST['email']) === 1)) $error .= "Inproper Email format.<br/>";
		else {
			$query = "SELECT email FROM users WHERE email='".$_REQUEST['email']."'";
			$result = $db->query($query);
			if($result->num_rows >= 1) $error .= "Email already exists in system.<br/>";
		}
		//Assuming everything works
		if($error == null) {
			if (!isset($_REQUEST['gender']) || $_REQUEST['gender'] == "male" || $_REQUEST['gender'] == "female") {
				$_REQUEST['gender'] = "NULL";
			} else {
				$_REQUEST['gender'] = "'".$_REQUEST['gender']."'";
			} 
			//NULL will auto-increment for the user_id
			$query = "INSERT INTO users (email,password,user_id) VALUES ('".$_REQUEST['email']."','"._hash($_REQUEST['email'],$_REQUEST['password'])."',NULL)";
			$db->query($query);
			$query = "SELECT user_id FROM users WHERE email='".$_REQUEST['email']."'";
			$result = $db->query($query);
			$result = $result->fetch_assoc();
			$query = "INSERT INTO user_information (user_id, first_name, last_name, gender) VALUES ('".$result['user_id']."','".$_REQUEST['fname']."','".$_REQUEST['lname']."',".$_REQUEST['gender'].")";
			$db->query($query);
			header('location:/');
		}
	}
?>
<div id="error">
	<? echo $error; ?>	
</div>
<div id='register'>
	<form action="" method="post" accept-charset="utf-8">
		<label for="fname">First Name</label><input type="text" name="fname" value="<? if($_REQUEST['fname']!=null) echo $_REQUEST['fname']; ?>" id="fname"><br/>
		<label for="lname">Last Name</label><input type="text" name="lname" value="<? if($_REQUEST['lname']!=null) echo $_REQUEST['lname']; ?>" id="lname"><br/>
		<label for="email">Email</label><input type="text" name="email" value="<? if($_REQUEST['email']!=null) echo $_REQUEST['email']; ?>" id="email"><br/>
		<label for="password">Password:</label><input type="password" name="password" value="" id="password"><br/>
		<label for="Confirm Password">Confirm Password</label><input type="password" name="confirm" value="" id="Confirm Password"><br/>
		<? echo $_REQUEST['gender']."<br/>"; ?>
		<label for="gender">Gender (Optional)</label>
		<input type="radio" name="gender" value="male" <? if($_REQUEST['gender'] == "male") echo "checked"; ?>> Male
		<input type="radio" name="gender" value="female"<? if($_REQUEST['gender'] == "female") echo "checked"; ?>> Female <br/>
		<input type="hidden" name="registering" value="1">
		<input type="submit" value="Continue &rarr;">
	</form>
</div>
