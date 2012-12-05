<?
	include_once("./status_box.php");
	$query = "SELECT * FROM statuses INNER JOIN user_information ON statuses.user_id=user_information.user_id ORDER BY time DESC LIMIT 20";
	$result = $db->query($query);
	?>
	<span id="statuses">
	<label class="header">What's New</label><br />
	<?
	for ($i = 0; $i < $result->num_rows; ++$i) {
		$row = $result->fetch_assoc(); 
		$isOdd = $i % 2 == 1;
		echo "<span id='$i' class='status odd$isOdd'>" ?>
		<a href="./index.php?profile&id="<? echo $row['user_id']; ?> ref="name"><? echo $row['first_name']." ".$row['last_name']; ?></a><br/>
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
