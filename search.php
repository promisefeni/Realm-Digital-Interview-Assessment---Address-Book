<?php
require('connection.php');
if(isset($_REQUEST["term"])){
	$param_term = $_REQUEST["term"];
	if($param_term != "")
	{
		// Prepare a select statement
		$query = "SELECT * FROM contact WHERE firstname LIKE '%$param_term%' OR lastname LIKE '%$param_term%'ORDER BY id DESC";
		$result = mysqli_query($con, $query) or die(mysqli_error($con));
		if(mysqli_num_rows($result) > 0){
			// Fetch result rows as an associative array
			while($row = mysqli_fetch_assoc($result)){
				$id = $row['id'];
				$firstname = $row['firstname'];
				$lastname = $row['lastname'];
				echo '<a class="" href="index.php?contact='.$id.'" >'. $firstname.' '.$lastname.'</a>';
			}
		}
	}
	else
	{
		$query = "SELECT * FROM contact ORDER BY id DESC";
		$result = mysqli_query($con, $query) or die(mysqli_error($con));
		if(mysqli_num_rows($result) > 0){
			// Fetch result rows as an associative array
			while($row = mysqli_fetch_assoc($result)){
				$id = $row['id'];
				$firstname = $row['firstname'];
				$lastname = $row['lastname'];
				echo '<a class="" href="index.php?contact='.$id.'" >'. $firstname.' '.$lastname.'</a>';
			}
		}
	}
}
?>