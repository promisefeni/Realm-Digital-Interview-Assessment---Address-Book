<?php
	require('connection.php');
	if(isset($_POST["firstname"]) && isset($_POST["lastname"]) && isset($_POST["phoneNumbers"]) && isset($_POST["emailAddresses"]))
	{
		$firstName = mysqli_real_escape_string($con,$_POST["firstname"]);
		$lastName = mysqli_real_escape_string($con,$_POST["lastname"]);
		$phoneNumbers = json_decode($_POST['phoneNumbers']);
		$emailAddresses = json_decode($_POST['emailAddresses']);
		
		$query = "INSERT INTO contact(firstname,lastname) VALUES('$firstName','$lastName')";
		$result = mysqli_query($con, $query) or die(mysqli_error($con));
		$contactID = mysqli_insert_id($con);
		
		if(!empty($phoneNumbers))
		{
			foreach($phoneNumbers as $value){
				$value = mysqli_real_escape_string($con,$value);
				$query = "INSERT INTO contactdetails(contactID,type,detail) VALUES($contactID,'phone','$value')";
				$result = mysqli_query($con, $query) or die(mysqli_error($con));
			}			
		}
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