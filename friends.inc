<?
	$query = "SELECT * FROM friends_requests INNER JOIN user_information ON friends_requests.user_id=user_information.user_id WHERE requesting_user_id='".$_SESSION['user_id']."'";
	$results = $db->query($query);
	for ($i = 0; $i < $results->num_rows; $i++) {
		 $row = $results->fetch_assoc();
	}
	echo "People requesting to be your friend:"
	for ($i = 0; $i < count; $i++) {
		 // code...
	}
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
		echo "Your friends:<br/>";
		for ($i = 0; $i < $results->num_rows; ++$i) { 
			$row = $results->fetch_assoc(); 
		?>
			<a href="./index.php?profile&id=<? echo $row['user_id']; ?>" ref="profile"><? echo $row['first_name']." ".$row['last_name']; ?></a><br/>
	<? 	}
	} else {
		echo "You have no friends. Make some now!";
		include_once("./member.inc");
	}
?>
