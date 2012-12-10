<?
	require_once('./db_connect.inc');
	session_start();
	$query = "SELECT * FROM friends_requests WHERE user_id='".$_SESSION['user_id']."' AND requesting_user_id='".$_REQUEST['id']."'";
	$result = $db->query($query);
	$query = "SELECT * FROM friend_requests WHERE user_id='".$_REQUEST['id']."' AND requesting_user_id='".$_SESSION['user_id']."'";
	$check = $db->query($query);
	if(($result->num_rows == 0) and ($check->num_rows == 0)) {
		$query = "INSERT INTO friend_requests (user_id, requesting_user_id) VALUES (".$_REQUEST['id'].", ".$_SESSION['user_id'].")";
		$db->query($query);
		header('location:./index.php?friends');
	} else {
		header('location:./index.php?members');
	}
?>
