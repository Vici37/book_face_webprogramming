<?
	if (isset($_REQUEST['update'])) {
		// TODO: Update everything
		header('location:./index.php?profile&id='.$_REQUEST['update']);
	}
	$query = "SELECT * FROM user_information WHERE user_id='".$_REQUEST['id']."'";
	$personal = $db->query($query);
	$personal = $personal->fetch_assoc();
	if(isset($_REQUEST['edit']) && $_REQUEST['id'] == $_SESSION['user_id']) { ?>
		<span id="edit">
			Still under development, won't update anything yet.<br/>
			<label class="header">Edit Profile</label>
			<form action="profile.php" method="post" accept-charset="utf-8">
				<div class="edit" id="changeEmail"><label for="email">Email</label><input type="text" name="email" value="<? echo $_SESSION['user']; ?>" id="email"><br/></div>
				<div class="edit" id="changePassword"><label for="change">Change Password</label><input type="text" name="change" value="" id="change"><br/></div>
				<div class="edit" id="changePassword2"><label for="confirm">Confirm</label><input type="text" name="confirm" value="" id="confirm"><br/><br/></div>
				<div class="edit" id="changeName"><label for="First Name">First Name</label><input type="text" name="fname" value="<? echo $personal['first_name']; ?>" id="fname"><br/></div>
				<div class="edit" id="changeLastName"><label for="Last Name">Last Name</label><input type="text" name="lname" value="<? echo $personal['last_name']; ?>" id="lname"><br/></div>
				<div id="changeGender"><label for="Gender">Gender</label>
				<span id="genders"><input type="radio" class="gender" name="gender" id="Male" value="Male" <? if($personal['gender'] == "Male") echo "checked"; ?>/>Male
				<input type="radio" class="gender" name="gender" id="Female" value="Female" <? if($personal['gender'] == "Female") echo "checked"; ?>/> Female
				</span>
				<input type="hidden" name="update" value="<? echo $_SESSION['user_id']; ?>">
				<br/></div>
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
		} ?>
