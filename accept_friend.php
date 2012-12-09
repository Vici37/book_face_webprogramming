<?
	require_once('./db_connect.inc');
	session_start();
	$query = "SELECT * FROM friends_relations WHERE user_id='".$_SESSION['user_id']."' AND friend_user_id='".$_REQUEST['id']."'";
	$result = $db->query($query);
	if($result->num_rows == 0) {
		$query = "INSERT INTO friends_relations (user_id, friend_user_id) VALUES (".$_SESSION['user_id'].", ".$_REQUEST['id'].")";
		$db->query($query);
		$query = "DELETE * FROM friends_requests WHERE user_id='".$_SESSION['user_id']."' AND requesting_user_id='".$_REQUEST['id']."'";
		$db->query($query);
		header('location:./index.php?friends');
	} else {
		header('location:./index.php?members');
	}
?>
