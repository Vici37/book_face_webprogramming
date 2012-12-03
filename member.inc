<?
	$query = "SELECT * FROM user_information WHERE user_id!='".$_SESSION['user_id']."'";
	$results = $db->query($query);
	$query = "SELECT * FROM friends_relations WHERE user_id='".$_SESSION['user_id']."'";
	$friends = $db->query($query);
	$already_friends = array();
	for ($i = 0; $i < $friends->num_rows; ++$i) {
		$row = $friends->fetch_assoc();
		array_push($already_friends,$row['friend_user_id']);
	}
	?> <div id="friends"> <?
	for ($i = 0; $i < $results->num_rows; ++$i) { 
		$row = $results->fetch_assoc();
		if(array_search($row['user_id'],$already_friends) === false) { ?>
		<a href="./add_friend.php?id=<? echo $row['user_id']; ?>" ref="add friend">Add as a friend</a>
		<? } ?>
		<a href="./index.php?profile&id=<? echo $row['user_id']; ?>" ref="profile"><? echo $row['first_name']." ".$row['last_name']; ?></a><br/>
<?	} ?>
	</div>
	<?
?>
