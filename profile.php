<?
	session_start(); 
	if (isset($_REQUEST['update']) && $_REQUEST['update'] == $_SESSION['user_id']) {
		require_once("./db_connect.inc");
		$query = "SELECT * FROM users INNER JOIN user_information ON users.user_id=user_information.user_id WHERE users.user_id='".$_SESSION['user_id']."'";
		$results = $db->query($query);
		$results = $results->fetch_assoc();
		$error = "";
		// some flags
		$emailChange = $_REQUEST['email'] != $results['email'];
		$newPassword = $_REQUEST['change'] != "";
		$firstChange = $_REQUEST['fname'] != $results['first_name'];
		$lastChange = $_REQUEST['lname'] != $results['last_name'];
		$genderChange = $_REQUEST['gender'] != $results['gender'];
		if(!$emailChange && !$newPassword && !$firstChange && !$lastChange && !$genderChange) {
			header("location:./index.php?profile&id=".$_SESSION['user_id']);
		} else {
			function _hash($text1,$text2) {
				$str = "";
				$str .= sha1($text1).md5($text2).sha1(md5($text1).md5($text2));
				return $str;
			}
			$correctPassword = _hash($results['email'],$_REQUEST['oldpassword']) == $results['password'];
			if ($emailChange && preg_match("/^\s*[\w\-\+_]+(\.[\w\-\+_]+)*\@[\w\-\+_]+\.[\w\-\+_]+(\.[\w\-\+_]+)*\s*$/", 
					$_REQUEST['email']) !== 1) {
				$error .= "Incorrect email format.<br/>";
			}
			if ($emailChange) {
				$query = "SELECT * FROM users WHERE email='".$_REQUEST['email']."'";
				$colisions = $db->query($query);
				if($colisions->num_rows > 0) {
					$error .= "Email already taken.<br/>";
				}
			}
			if ($newPassword && $_REQUEST['change'] != $_REQUEST['confirm']) {
				$error .= "Passwords don't match.<br/>";
			}
			if (!$correctPassword) {
				$error .= "Incorrect current password.<br/>";
			}

			if($correctPassword && $error == "") {
				//echo $emailChange."|".$newPassword."|".$firstChange."|".$lastChange."|".$genderChange;
				$where = "WHERE user_id='".$_SESSION['user_id']."'";
				if($emailChange || $newPassword) {
					$query = "UPDATE users SET";
					if($emailChange && $newPassword) {
						$password = _hash($_REQUEST['email'],$_REQUEST['change']);
						$query .= " email='".$_REQUEST['email']."', password='".$password."' ";
						$_SESSION['user'] = $_REQUEST['email'];
					} else if($emailChange) {
						$password = _hash($_REQUEST['email'],$_REQUEST['oldpassword']);
						$query .= " email='".$_REQUEST['email']."', password='".$password."' ";
						$_SESSION['user'] = $_REQUEST['email'];
					} else {
						$password = _hash($results['email'],$_REQUEST['change']);
						$query .= " password='".$password."' ";
					}
					echo $query;
					$db->query($query.$where);
				}
				if($firstChange || $lastChange || $genderChange){
					$numCommas = $firstChange + $lastChange + $genderChange - 1;
					$query = "UPDATE user_information SET";
					if($firstChange) {
						$query .= " first_name='".$_REQUEST['fname']."' ";			
					}
					if ($numCommas > 0) {
						$query .= ", ";
						$numCommas-=1;
					}
					if($lastChange) {
						$query .= " last_name='".$_REQUEST['lname']."' ";
					}
					if ($numCommas > 0) {
						$query .= ", ";
						$numCommas-=1;
					}
					if($genderChange) {
						if ($_REQUEST['gender'] != "Male" && $_REQUEST['gender'] != "Female") {
							$_REQUEST['gender'] = "NULL";
						} else {
							$_REQUEST['gender'] = "'".$_REQUEST['gender']."'";
						} 
						$query .= " gender='".$_REQUEST['gender']."' ";
					}
					echo $query;
					$db->query($query.$where);
				}
				header("location:./index.php?profile&id=".$_SESSION['user_id']);
			} else {
				header("location:./index.php?profile&id=".$_SESSION['user_id']."&edit=1&error=".$error);
			}
			//$db->query($user_update_query." email='".$_REQUEST['email']."', password='"._hash($_REQUEST['email'],$_REQUEST['change'])."' ".$where);
		}
	} else {
		$query = "SELECT * FROM user_information WHERE user_id='".$_REQUEST['id']."'";
		$personal = $db->query($query);
		$personal = $personal->fetch_assoc();
		if(isset($_REQUEST['edit']) && $_REQUEST['id'] == $_SESSION['user_id']) { ?>
			<span id="edit">
				<div class="error">
					<? if(isset($_REQUEST['error'])) echo $_REQUEST['error']; ?>	
				</div>
				<label class="header">Edit Profile</label>
				<form action="profile.php" method="post" accept-charset="utf-8">
					<div class="edit" id="changeEmail"><label for="email">Email</label><input type="text" name="email" value="<? echo $_SESSION['user']; ?>" id="email"><br/></div>
					<div class="edit" id="currentPassword"><label for="oldpassword">Old Password (required)</label><input type="password" name="oldpassword" value=""></div>
					<div class="edit" id="changePassword"><label for="change">New Password</label><input type="password" name="change" value="" id="change"><br/></div>
					<div class="edit" id="changePassword2"><label for="confirm">Confirm</label><input type="password" name="confirm" value="" id="confirm"><br/><br/></div>
						
					<div class="edit" id="changeName"><label for="First Name">First Name</label><input type="text" name="fname" value="<? echo $personal['first_name']; ?>" id="fname"><br/></div>
					<div class="edit" id="changeLastName"><label for="Last Name">Last Name</label><input type="text" name="lname" value="<? echo $personal['last_name']; ?>" id="lname"><br/></div>
					<div id="changeGender"><label for="Gender">Gender</label>
					<span id="genders"><input type="radio" class="gender" name="gender" id="Male" value="Male" <? if($personal['gender'] == "Male") echo "checked"; ?>/>Male
					<input type="radio" class="gender" name="gender" id="Female" value="Female" <? if($personal['gender'] == "Female") echo "checked"; ?>/> Female
					</span><br/><br/>
					<input type="hidden" name="update" value="<? echo $_SESSION['user_id']; ?>">
					<input id="editSubmit" type="submit" value="Submit Changes">
				</form>
			</span>
		<? } else { ?>
			<div id="buffer"></div>
			<div id="personal"><label id="name">
				<? echo $personal['first_name']; ?> <? echo $personal['last_name']; ?><br/></label>
				<? if(isset($personal['gender'])) echo $personal['gender']."<br/>"; ?> 
			</div>
			<?	include_once("home.inc");
			}
		} ?>
