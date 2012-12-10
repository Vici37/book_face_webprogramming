<?
	include_once("./status_box.php");
	if($_REQUEST['id']) { 
		$query = "SELECT * FROM statuses WHERE user_id = ".$_REQUEST['id']." ORDER BY time DESC LIMIT 5";
	} else {
		$query = "SELECT * FROM statuses WHERE user_id IN (SELECT friend_user_id from friends_relations where user_id = ".$_SESSION['user_id'].") OR user_id = ".$_SESSION['user_id']." ORDER BY time DESC LIMIT 20";
	} 
	$result = $db->query($query);
	?>
	<span id="statuses">
	<label class="header">What's New</label><br />
	<?
	for ($i = 0; $i < $result->num_rows; ++$i) {
		$row = $result->fetch_assoc(); 
		$isOdd = $i % 2 == 1;
		echo "<span id='$i' class='posted odd$isOdd'>" ?>
		<a href="./index.php?profile&id=<? echo $row['user_id']; ?>" ref="name"><? echo $row['first_name']." ".$row['last_name']; ?></a><br/>
		<? echo $row['status'];?><br/>
		<? echo $row['time'];?><br/>
		<? $query = "SELECT * FROM comments WHERE status_id='".$row['status_id']."'";
			$comments = $db->query($query);?>
		<a href="./index.php?comments&id=<? echo $row['status_id']; ?>" ref="comments"><? 
		$s = "";
		if($comments->num_rows != 1) {
			$s = "s";
		}
		echo $comments->num_rows." Comment$s";?>
		</span></a><br/>
	<? }
?>
	</span>
