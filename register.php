<?
	if(isset($_REQUEST['registering'])) {
		require_once("./db_connect.inc");
		//Check information...

		$error = "";
		if($_REQUEST['fname'] == null) $error .= "First name required.<br/>";
		if($_REQUEST['lname'] == null) $error .= "Last name required.<br/>";
		if($_REQUEST['password'] != $_REQUEST['confirm']) $error .= "Passwords don't match.<br/>";
		if($_REQUEST['password'] == null) $error .= "Password can't be blank.<br/>";
		// Check email
		if($_REQUEST['email'] == null) $error .= "Email can't be left blank.<br/>";
		else if(preg_match("/^\s*[\w\-\+_]+(\.[\w\-\+_]+)*\@[\w\-\+_]+\.[\w\-\+_]+(\.[\w\-\+_]+)*\s*$/",
				$_REQUEST['email']) !== 1) $error .= "Inproper Email format.<br/>";
		else {
			$query = "SELECT email FROM users WHERE email='".$_REQUEST['email']."'";
			$result = $db->query($query);
			if($result->num_rows >= 1) $error .= "Email already exists in system.<br/>";
		}
		//Assuming everything works
		if($error == null) {
			if (!isset($_REQUEST['gender']) || ($_REQUEST['gender'] != "Male" && $_REQUEST['gender'] != "Female")) {
				$_REQUEST['gender'] = "NULL";
			} else {
				$_REQUEST['gender'] = "'".$_REQUEST['gender']."'";
			} 
			function _hash($text1,$text2) {
				$str = "";
				$str .= sha1($text1).md5($text2).sha1(md5($text1).md5($text2));
				return $str;
			}
			//NULL will auto-increment for the user_id
			$query = "INSERT INTO users (email,password,user_id) VALUES ('".$_REQUEST['email']."','"._hash($_REQUEST['email'],$_REQUEST['password'])."',NULL)";
			$db->query($query);
			$query = "SELECT user_id FROM users WHERE email='".$_REQUEST['email']."'";
			$result = $db->query($query);
			$result = $result->fetch_assoc();
			$query = "INSERT INTO user_information (user_id, first_name, last_name, gender) VALUES ('".$result['user_id']."','".$_REQUEST['fname']."','".$_REQUEST['lname']."',".$_REQUEST['gender'].")";
			$db->query($query);
			header('location:./index.php');
		} else {
			header('location:./index.php?register&error='.$error);
		}
	}
?>
<span id="reg">
<div class="error">
	<? if(isset($_REQUEST['error'])) echo $_REQUEST['error']; ?>	
</div>
<div id='register'>
	<form action="./register.php" method="post" accept-charset="utf-8">
		<label id="register" class="header">Register</label>
		<div class="edit" id="regFirstName"><label for="fname">First Name</label><input class="register" type="text" name="fname" value="<? if($_REQUEST['fname']!=null) echo $_REQUEST['fname']; ?>" id="fname"></div>
		<div class="edit" id="regLastName"><label for="lname">Last Name</label><input type="text" class="register" name="lname" value="<? if($_REQUEST['lname']!=null) echo $_REQUEST['lname']; ?>" id="lname"></div>
		<div class="edit" id="regEmail"><label for="email">Email</label><input type="text" name="email" class="register" value="<? if($_REQUEST['email']!=null) echo $_REQUEST['email']; ?>" id="email"></div>
		<div class="edit" id="regPassword"><label for="password">Password:</label><input type="password" name="password" class="register" value="" id="password"></div>
		<div class="edit" id="regPassword2"><label for="Confirm Password">Confirm Password</label><input type="password" name="confirm" class="register" value="" id="Confirm Password"></div>
		<div class="edit" id="regGender"><label for="gender">Gender (Optional)</label>
		<span id="maleRadio"><input type="radio" name="gender" value="Male" <? if($_REQUEST['gender'] == "male") echo "checked"; ?>> Male</span>
		<span id="femaleRadio"><input type="radio" name="gender" value="Female"<? if($_REQUEST['gender'] == "female") echo "checked"; ?>> Female</span></div>
		<input type="hidden" name="registering" value="1">
		<input id="submitReg" type="submit" value="Continue">
	</form>
</div>
</span>
