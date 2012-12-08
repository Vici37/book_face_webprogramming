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
	$friends = array();
	$notFriends = array();
	for ($i = 0; $i < $results->num_rows; ++$i) { 
		$row = $results->fetch_assoc();
		if(array_search($row['user_id'],$already_friends) === false) { 
			array_push($notFriends, $row);
		 } else {
			array_push($friends, $row);
		}
	} ?>
	<span id="friends" >
	<label class="header">Friends</label><br />
	<? for ($i = 0; $i < sizeof($friends); ++$i) { 
		$row = $friends[$i]; ?>
		<a class="friend" href="./index.php?profile&id=<? echo $row['user_id']; ?>" ref="profile"><? echo $row['first_name']." ".$row['last_name']; ?></a><br/>
	<? } ?>
	</span><span id="notFriends">
	<label class="header">Other Members</label><br />
		<? for ($i = 0; $i < sizeof($notFriends); ++$i) { 
		$row = $notFriends[$i]; ?>
		<a class="add" href="./add_friend.php?id=<? echo $row['user_id']; ?>" ref="add friend">Add</a>
		<a class="notFriend" href="./index.php?profile&id=<? echo $row['user_id']; ?>" ref="profile"><? echo $row['first_name']." ".$row['last_name']; ?></a><br/>
	<? } ?>
	</span>
	</div>
