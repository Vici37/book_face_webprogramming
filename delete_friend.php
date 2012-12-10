<?
	require_once('./db_connect.inc');
	session_start();
	$query = "SELECT * FROM friends_relations WHERE user_id='".$_SESSION['user_id']."' AND friend_user_id='".$_REQUEST['id']."'";
	$result = $db->query($query);
	if($result->num_rows > 0) {
		$query = "DELETE FROM friends_relations WHERE user_id='".$_SESSION['user_id']."' AND friend_user_id='".$_REQUEST['id']."'"; 
		$db->query($query);
		$query = "DELETE FROM friends_relations WHERE user_id='".$_REQUEST['id']."' AND friend_user_id='".$_SESSION['user_id']."'"; 
		$db->query($query);
		header('location:./index.php?friends');
	} else {
		header('location:./index.php?members');
	}
?>
