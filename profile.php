<?
	if (isset($_REQUEST['update'])) {
		// TODO: Update everything
		header('location:./index.php?profile&id='.$_REQUEST['update']);
	}
	$query = "SELECT * FROM user_information WHERE user_id='".$_REQUEST['id']."'";
	$personal = $db->query($query);
	$personal = $personal->fetch_assoc();
	if(isset($_REQUEST['edit']) && $_REQUEST['id'] == $_SESSION['user_id']) { ?>
		Still under development, won't update anything yet.<br/>
		<div id="name">
			<form action="profile.php" method="post" accept-charset="utf-8">
				<label for="email">Email</label><input type="text" name="email" value="<? echo $_SESSION['user']; ?>" id="email"><br/>
				<label for="change">ChangPassword</label><input type="text" name="change" value="" id="change"><br/>
				<label for="confirm">Confirm</label><input type="text" name="confirm" value="" id="confirm"><br/><br/>
				<label for="First Name">First Name</label><input type="text" name="fname" value="<? echo $personal['first_name']; ?>" id="fname"><br/>
				<label for="Last Name">Last Name</label><input type="text" name="lname" value="<? echo $personal['last_name']; ?>" id="lname"><br/>
				<label for="Gender">Gender</label>
				<input type="radio" name="gender" value="Male" <? if($personal['gender'] == "Male") echo "checked"; ?>>Male
				<input type="radio" name="gender" value="Female" <? if($personal['gender'] == "Female") echo "checked"; ?>>Female
				<input type="hidden" name="update" value="<? echo $_SESSION['user_id']; ?>">
				<br/>
				<input type="submit" value="Submit Changes">
			</form>
		</div>
	<? } else { ?>
		<div id="personal">
			First name: <? echo $personal['first_name']; ?><br/>
			Last name: <? echo $personal['last_name']; ?><br/>
			<? if(isset($personal['gender'])) echo "Gender: ".$personal['gender']."<br/>"; ?> 
		</div>
		<?	include_once("home.inc");
		} ?>
