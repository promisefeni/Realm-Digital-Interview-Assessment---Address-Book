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
	<?php require('connection.php'); ?>
		<div class="container">
			<h2>Address Book</h2>
			<div class="row">
				<div class="col-4">
				<div class="input-group mb-3">
					<div class="input-group-prepend">
						<span class="input-group-text" id="basic-addon1">Search</span>
					</div>
					<input id="searchContact" type="text" autocomplete="off" class="form-control" placeholder="Contacts">
				</div>
				<div class="p-ListContacts">	
					<?php
						$idMain = 0;
						if(isset($_GET["contact"]))
						{
							$idMain = $_GET["contact"];
						}
						$query = "SELECT * FROM contact ORDER BY id DESC";
						$result = mysqli_query($con, $query);
						if (mysqli_num_rows($result) > 0) {
							while($row = mysqli_fetch_assoc($result)) {
								$firstname = $row["firstname"];
								$lastname = $row["lastname"];
								$id = $row["id"];
								if($idMain == $id)
								{
									?>
										<a class="p-active" href="index.php?contact=<?php echo $id;?>" ><?php echo $firstname;?> <?php echo $lastname;?></a>
									<?php
								}
								else
								{
									?>
										<a class="" href="index.php?contact=<?php echo $id;?>" ><?php echo $firstname;?> <?php echo $lastname;?></a>
									<?php
								}
							}
						}
					?>
				</div>
				<a class="btn btn-primary btn-sm btn-block p-add-phone-number" href="add.php">Add Contact</a>
				</div>
				<div class="col-8">
					<div class="tab-content" id="nav-tabContent">
						<?php
							if(isset($_GET["contact"]))
							{
								if($_GET["contact"] != "")
								{
									$idMain = $_GET["contact"];
									$query = "SELECT * FROM contact WHERE id='$idMain'";
									$result = mysqli_query($con, $query) or die(mysqli_error($con));
									$row = mysqli_fetch_assoc($result);
									if(mysqli_num_rows($result) > 0)
									{
										$phoneNumbers = [];
										$emailAddresses = [];
										$pNIDNumber = 0;
										$eAIDNumber = 0;
										?>
										<h2>Edit Contact</h2>
										<form action="" method="post" id="ContactDetails">
											<div class="form-row">
												<div class="form-group col-md-6">
													<label for="pFirstname">First Name:</label>
													<div class="input-group">
														<input type="text" class="form-control" id="pFirstname" name="pFirstname" required autocomplete="off" value="<?php echo $row["firstname"];?>"/>
													</div>
												</div>
												<div class="form-group col-md-6">
													<label for="pLastname">Last Name:</label>
													<div class="input-group">
														<input type="text" class="form-control" id="pLastname" name="pLastname" required autocomplete="off" value="<?php echo $row["lastname"];?>"/>
													</div>
												</div>
											</div>
											<div class="form-group">
												<div class="p-phoneNumbers">
													<?php
													$query = "SELECT * FROM contactdetails WHERE contactID=$idMain AND type='phone' ORDER BY id ASC";
													$result = mysqli_query($con, $query);
													$row = mysqli_fetch_assoc($result);
													$excludeNumber = $row["detail"];
													?>
													<div class="p-AddPhoneNumber">
														<label for="pPhoneNumber">Phone Number:</label>
														<div class="input-group">
															<input type="text" class="form-control" name="pPhoneNumber" id="pPhoneNumber" autocomplete="off" value="<?php echo $row["detail"];?>">
														</div>
													</div>
													<?php
													$query = "SELECT * FROM contactdetails WHERE contactID=$idMain AND type='phone'";
													$result = mysqli_query($con, $query);
													$countPhone = mysqli_num_rows($result);
													if ($countPhone > 1) {
														$i = 0;
														while($row = mysqli_fetch_assoc($result)) {
															if($row["detail"] != $excludeNumber)
															{
																$i = $i+1;
																$pNIDNumber = $i;
																$pNID = "pN".$i;
																array_push($phoneNumbers,$pNID);
													?>
															<div class="p-AddPhoneNumber">
																<div class="input-group">
																	<input type="text" pNID="<?php echo $pNID;?>" class="form-control" placeholder="Phone Number" autocomplete="off" value="<?php echo $row["detail"];?>">
																	<div class="input-group-append">
																		<button class="btn btn-outline-secondary p-delete-phone-number" type="button">Delete</button>
																	</div>
																</div>
															</div>
													<?php
															}
														}
													}
													?>
												</div>
												<button type="button" class="btn btn-primary btn-sm btn-block p-add-phone-number">Add Phone Number</button>
											</div>
											<div class="form-group">
												<div class="p-emailAddresses">
													<?php
													$query = "SELECT * FROM contactdetails WHERE contactID=$idMain AND type='email' ORDER BY id ASC";
													$result = mysqli_query($con, $query);
													$row = mysqli_fetch_assoc($result);
													$excludeEmail = $row["detail"];
													?>
													<div class="p-AddEmailAddress">
														<label for="pEmailAddress">Email Address:</label>
														<div class="input-group">
															<input type="text" class="form-control" name="pEmailAddress" id="pEmailAddress" autocomplete="off" value="<?php echo $row["detail"];?>">
														</div>
													</div>
													<?php
													$query = "SELECT * FROM contactdetails WHERE contactID=$idMain AND type='email'";
													$result = mysqli_query($con, $query);
													$countEmail = mysqli_num_rows($result);
													if ($countEmail > 1) {
														$i = 0;
														while($row = mysqli_fetch_assoc($result)) {
															if($row["detail"] != $excludeEmail)
															{
																$i = $i+1;
																$eAIDNumber = $i;
																$eAID = "eA".$i;
																array_push($emailAddresses,$eAID);
													?>
																<div class="p-AddEmailAddress">
																	<div class="input-group">
																		<input type="text" class="form-control" eAID="<?php echo $eAID;?>" placeholder="Email Address" autocomplete="off" value="<?php echo $row["detail"];?>">
																		<div class="input-group-append">
																			<button class="btn btn-outline-secondary p-delete-email-address" type="button">Delete</button>
																		</div>
																	</div>
																</div>
													<?php
															}
														}
													}
													?>
												</div>
												<button type="button" class="btn btn-primary btn-sm btn-block p-add-email-address">Add Email Address</button>
											</div>
											<div id="p-phoneNumbers"></div>
											<button type="submit" id="btnSaveContact" class="btn btn-success">Save Contact Details</button>
											<a href="delete.php?contact=<?php echo $idMain;?>" class="btn btn-danger">Delete Contact Details</a>
										</form>
										<script type="text/javascript">
										var phoneNumbers = <?php echo json_encode($phoneNumbers); ?>;
										var emailAddresses = <?php echo json_encode($emailAddresses); ?>;
										var pNID = <?php echo $pNIDNumber; ?>;
										var eAID = <?php echo $eAIDNumber; ?>;
										var contactID = <?php echo $idMain; ?>;
										</script>
										<?php
									}
								}
							}
						?>
						
					</div>
				</div>
			</div>
		</div>
		<script>
		$(document).ready(function(){
			$('#searchContact').on("keyup input", function(){
				/* Get input value on change */
				var inputVal = $(this).val();
				var resultDropdown = $(".p-ListContacts");
				$.get("search.php", {term: inputVal}).done(function(data){
					// Display the returned data in browser
					resultDropdown.html(data);
				});
			});
		});
		$(".p-add-phone-number").click(function(){
			pNID = pNID + 1;
			var pNAttr = "pN"+pNID;
			phoneNumbers.push(pNAttr);
			$(".p-phoneNumbers").append('<div class="p-AddPhoneNumber"><div class="input-group"><input type="text" pNID="'+pNAttr+'" class="form-control" placeholder="Phone Number" autocomplete="off"><div class="input-group-append"><button class="btn btn-outline-secondary p-delete-phone-number" type="button">Delete</button></div></div></div>');
		});
		$(document).on('click', '.p-delete-phone-number', function(){
			$(this).parents('.p-AddPhoneNumber').remove();
			var id = $(this).parents('.p-AddPhoneNumber').find('.form-control').attr("pNID");
			phoneNumbers.splice($.inArray(id ,phoneNumbers),1);
		});
		$(".p-add-email-address").click(function(){
			eAID = eAID + 1;
			var eAAttr = "eA"+eAID;
			emailAddresses.push(eAAttr);
			$(".p-emailAddresses").append('<div class="p-AddEmailAddress"><div class="input-group"><input type="text" class="form-control" eAID="'+eAAttr+'" placeholder="Email Address" autocomplete="off"><div class="input-group-append"><button class="btn btn-outline-secondary p-delete-email-address" type="button">Delete</button></div></div></div>');
		});
		$(document).on('click', '.p-delete-email-address', function(){
			$(this).parents('.p-AddEmailAddress').remove();
			var id = $(this).parents('.p-AddEmailAddress').find('.form-control').attr("eAID");
			emailAddresses.splice($.inArray(id ,emailAddresses),1);
		});
		
		$(document).on("submit", "#ContactDetails", function(e){
			var removeItem = "";
			if(phoneNumbers.length > 0)
			{
				var pNTool = "";
				var pNData = "";
				for (i = 0; i < phoneNumbers.length; i++) {
					pNTool = phoneNumbers[i];
					pNData = $(".p-AddPhoneNumber").find(".form-control[pNID='" + pNTool + "']").val();
					phoneNumbers[i] = pNData;
				}
			}
			phoneNumbers.unshift($("#pPhoneNumber").val());
			phoneNumbers = jQuery.grep(phoneNumbers, function(value) {
			  return value != removeItem;
			});
			
			if(emailAddresses.length > 0)
			{
				var eATool = "";
				var eAData = "";
				for (i = 0; i < emailAddresses.length; i++) {
					eATool = emailAddresses[i];
					eAData = $(".p-AddEmailAddress").find(".form-control[eAID='" + eATool + "']").val();
					emailAddresses[i] = eAData;
				}
			}
			emailAddresses.unshift($("#pEmailAddress").val());
			emailAddresses = jQuery.grep(emailAddresses, function(value) {
			  return value != removeItem;
			});
			
			var json_arr_pN = JSON.stringify(phoneNumbers);
			var json_arr_eA = JSON.stringify(emailAddresses);
			
			$.ajax({
                url: 'saveContact.php',
                type: 'post',
                data: "contactID="+contactID+"&firstname="+$("#pFirstname").val()+"&lastname="+$("#pLastname").val()+"&phoneNumbers="+json_arr_pN+"&emailAddresses="+json_arr_eA,
                success: function(data){
					location.reload();
                }
            });
            e.preventDefault();
		});
		</script>
	</body>
</html>