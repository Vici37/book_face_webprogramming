<?
	$query = "SELECT * FROM friend_requests INNER JOIN user_information ON friend_requests.requesting_user_id=user_information.user_id WHERE friend_requests.user_id='".$_SESSION['user_id']."'";
	$results = $db->query($query);
	$friends_requests = array();
	for ($i = 0; $i < $results->num_rows; $i++) {
		 $row = $results->fetch_assoc();
		 array_push($friends_requests,$row);
	}
	echo "<span class=\"onFriendsPage\" id=\"friend_requests\"><label class=\"header\">Friend Requests</label><br/>";
	for ($i = 0; $i < sizeof($friends_requests); $i++) {
		$row = $friends_requests[$i]; ?>
		
		<a class="accept" href="./accept_friend.php?id=<? echo $row['user_id']; ?>" rel="accept friend">Accept</a>
		<a href="./index.php?profile&id=<? echo $row['requesting_user_id']; ?>" ref="profile"><? echo $row['first_name']." ".$row['last_name']; ?></a><br/> 
	<? } 
	$query = "SELECT * FROM friends_relations WHERE user_id='".$_SESSION['user_id']."'";
	$results = $db->query($query);
	if($results->num_rows > 0) {
		$row = $results->fetch_assoc();
		$query = "SELECT * FROM user_information WHERE user_id='".$row['friend_user_id']."' ";
		for ($i = 1; $i < $results->num_rows; ++$i) {
			$row = $results->fetch_assoc();
			$query .= "OR user_id='".$row['friend_user_id']."' ";
		}
		$results = $db->query($query);
		echo "<span class=\"onFriendsPage\" id=\"friends\"><label class=\"header\">Friends</label><br/>";
		for ($i = 0; $i < $results->num_rows; ++$i) { 
			$row = $results->fetch_assoc(); 
		?>
			<a class="delete" href="./delete_friend.php?id=<? echo $row['user_id']; ?>" rel="delete friend">Delete</a>
			<a href="./index.php?profile&id=<? echo $row['user_id']; ?>" ref="profile"><? echo $row['first_name']." ".$row['last_name']; ?></a><br/>
	<? 	} echo "</span>";
	} else { ?>
		<span id="no_friends">
			<a id=\"noFriends\" href=\"./index.php?members\" ref=\"members\">You have no friends. Make some now!</a>
		</span>
	<? } ?>
