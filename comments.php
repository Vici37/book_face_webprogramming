<?
	if (isset($_REQUEST['post_comment'])) {
		if($_REQUEST['comment_text'] != ""){
			require_once("./db_connect.inc");
			session_start();
			$datetime = strftime("%F %T");
			$query = "INSERT INTO comments (status_id, user_id, comment, time) VALUES ('".$_REQUEST['comment_status_id']."', '".$_SESSION['user_id']."', '".addslashes($_REQUEST['comment_text'])."', '".$datetime."')";
			$db->query($query);
		}	
		header('location:./index.php?comments&id='.$_REQUEST['comment_status_id']);
	} else {
		$query = "SELECT * FROM statuses INNER JOIN user_information ON statuses.user_id=user_information.user_id WHERE status_id='".$_REQUEST['id']."' ORDER BY time DESC";
		$status = $db->query($query);
		$status = $status->fetch_assoc();
		echo "<label id=\"statusComment\" class=\"header\">Status</label><br/>";
		echo "<span class=\"posted\" id=\"statusInQuestion\">".$status['status']."<br/>";
		echo $status['first_name']." ".$status['last_name']."<br/>";
		echo $status['time']."</span><br/><br/>";
		$query = "SELECT * FROM comments INNER JOIN user_information ON comments.user_id=user_information.user_id WHERE comments.status_id='".$_REQUEST['id']."' ORDER BY comments.time ASC";
		//echo $query;
		$results = $db->query($query);
		echo "<label class=\"header\">Comments</label><br/>";
		if($results->num_rows > 0) {
			for ($i = 0; $i < $results->num_rows; ++$i) {
				$row = $results->fetch_assoc();
				$odd = $i % 2 == 1;
				echo "<span id=\"$i\" class=\"posted odd$odd\">".$row['comment']."<br/>";?>
				<a href="./index.php?profile&id=<? echo $row['user_id']; ?>" ref="profile"><? echo $row['first_name']." ".$row['last_name']; ?></a><br/>
				<? echo $row['time']."</span><br/><br/>";
			}
		} ?>
	<div class="posting" id="comments">
		<form action="comments.php" method="post" accept-charset="utf-8">
			<input type="hidden" name="post_comment" value="1">
			<input type="hidden" name="comment_status_id" value="<? echo $_REQUEST['id'];?>">
			<label class="header">Comment</label><br/>
			<textarea name="comment_text" rows="8" cols="40"></textarea>
		<input id="comment" type="submit" value="Submit">
		</form>
	</div>
<? } ?>
