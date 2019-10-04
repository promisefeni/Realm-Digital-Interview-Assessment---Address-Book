<?php
	require('connection.php');
	if(isset($_GET["contact"]) && isset($_GET["decision"]))
	{
		if($_GET["contact"] != "" && $_GET["decision"] == "yes")
		{
			$id = $_GET["contact"];
			$query = "SELECT * FROM contact WHERE id='$id'";
			$result = mysqli_query($con, $query) or die(mysqli_error($con));
			$row = mysqli_fetch_assoc($result);
			if(mysqli_num_rows($result) > 0)
			{
				$query = "SELECT * FROM contactdetails WHERE contactID='$id'";
				$result = mysqli_query($con, $query) or die(mysqli_error($con));
				$row = mysqli_fetch_assoc($result);
				if(mysqli_num_rows($result) > 0)
				{
					$query = "DELETE FROM contactdetails WHERE contactID='$id'";
					$result = mysqli_query($con, $query) or die(mysqli_error($con));
				}
				$query = "DELETE FROM contact WHERE id='$id'";
				$result = mysqli_query($con, $query) or die(mysqli_error($con));
				header("Location: index.php");
			}
		}
	}
?>
<html>
	<head>
		<title>Realm Digital Interview Assessment - Address Book By Promise Feni</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<!-- Bootstrap -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<style>
			.p-ListContacts a{
				display:block;
				margin-bottom:10px;
				border:1px solid #aaa;
				color:#111;
				border-radius:3px;
				padding:5px;
				text-decoration:none;
				text-align:left;
			}
			.p-ListContacts a:hover,.p-ListContacts a.p-active{
				background-color:#aaa;
				color:#fff;
			}
			
		</style>
	</head>
	<body>
		<?php
			$idMain = 0;
			if(isset($_GET["contact"]))
			{
				$idMain = $_GET["contact"];
			}
		?>
		<div class="container">
			<div class="alert alert-danger">
				Are you sure you want to delete <strong>Contact Details</strong>?
			</div>
			<a type="button" href="index.php" class="btn btn-outline-info">No</a>
			<a type="button" href="delete.php?contact=<?php echo $idMain;?>&decision=yes" class="btn btn-outline-danger">Yes</a>
		</div>
	</body>
</html>