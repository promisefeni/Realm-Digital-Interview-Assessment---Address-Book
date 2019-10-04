<?php
	require('connection.php');
	if(isset($_POST["contactID"]) && isset($_POST["firstname"]) && isset($_POST["lastname"]) && isset($_POST["phoneNumbers"]) && isset($_POST["emailAddresses"]))
	{
		$contactID = mysqli_real_escape_string($con,$_POST["contactID"]);
		$firstName = mysqli_real_escape_string($con,$_POST["firstname"]);
		$lastName = mysqli_real_escape_string($con,$_POST["lastname"]);
		$phoneNumbers = json_decode($_POST['phoneNumbers']);
		$emailAddresses = json_decode($_POST['emailAddresses']);
		
		$query = "UPDATE contact SET firstname='$firstName',lastname='$lastName' WHERE id=$contactID";
		$result = mysqli_query($con, $query) or die(mysqli_error($con));
		
		$query = "DELETE FROM contactdetails WHERE contactID='$contactID' AND type='phone'";
		$result = mysqli_query($con, $query) or die(mysqli_error($con));
		
		if(!empty($phoneNumbers))
		{
			foreach($phoneNumbers as $value){
				$value = mysqli_real_escape_string($con,$value);
				$query = "INSERT INTO contactdetails(contactID,type,detail) VALUES($contactID,'phone','$value')";
				$result = mysqli_query($con, $query) or die(mysqli_error($con));
			}			
		}
		
		$query = "DELETE FROM contactdetails WHERE contactID='$contactID' AND type='email'";
		$result = mysqli_query($con, $query) or die(mysqli_error($con));
		
		if(!empty($emailAddresses))
		{
			foreach($emailAddresses as $value){
				$value = mysqli_real_escape_string($con,$value);
				$query = "INSERT INTO contactdetails(contactID,type,detail) VALUES($contactID,'email','$value')";
				$result = mysqli_query($con, $query) or die(mysqli_error($con));
			}			
		}
		echo "Success!!";
	}
	else
	{
		echo "nothing";
	}
?>