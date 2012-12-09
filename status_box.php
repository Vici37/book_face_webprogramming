<?
	if(isset($_REQUEST['update_status'])) {
		if ($_REQUEST['status_update'] != "") {
			require_once("./db_connect.inc");
			session_start();
			$datetime = strftime("%F %T");
			$query = "INSERT INTO statuses (status_id, user_id, status, time) VALUES (NULL, '".$_SESSION['user_id']."', '".addslashes($_REQUEST['status_update'])."', '".$datetime."')";
			$db->query($query);
		}
		header('location:./index.php?home');
	} 
?>
<div class="posting" id="status_update">
	<form action="status_box.php" method="post" accept-charset="utf-8">
		<input type="hidden" name="update_status" value="1">
	<label class="header">Update Status</label><br/>
		<textarea id="status_update" name="status_update" rows="8" cols="40"></textarea>
	<input id="submitStatus" type="submit" value="Submit">
	</form>
</div>
