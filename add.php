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
	</head>
	<body>
		<div class="container">
			<h2>Add a Contact</h2>
			<form action="" method="post" id="ContactDetails">
				<div class="form-row">
					<div class="form-group col-md-6">
						<label for="pFirstname">First Name:</label>
						<div class="input-group">
							<input type="text" class="form-control" id="pFirstname" name="pFirstname" required autocomplete="off"/>
						</div>
					</div>
					<div class="form-group col-md-6">
						<label for="pLastname">Last Name:</label>
						<div class="input-group">
							<input type="text" class="form-control" id="pLastname" name="pLastname" required autocomplete="off"/>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="p-phoneNumbers">
						<div class="p-AddPhoneNumber">
							<label for="pPhoneNumber">Phone Number:</label>
							<div class="input-group">
								<input type="text" class="form-control" name="pPhoneNumber" id="pPhoneNumber" autocomplete="off">
							</div>
						</div>
					</div>
					<button type="button" class="btn btn-primary btn-sm btn-block p-add-phone-number">Add Phone Number</button>
				</div>
				<div class="form-group">
					<div class="p-emailAddresses">
						<div class="p-AddEmailAddress">
							<label for="pEmailAddress">Email Address:</label>
							<div class="input-group">
								<input type="text" class="form-control" name="pEmailAddress" id="pEmailAddress" autocomplete="off">
							</div>
						</div>
					</div>
					<button type="button" class="btn btn-primary btn-sm btn-block p-add-email-address">Add Email Address</button>
				</div>
				<div id="p-phoneNumbers"></div>
				<button type="submit" id="btnAddContact" class="btn btn-success">Add Contact</button>
				<a href="index.php" class="btn btn-info" >View Address Book</a>
			</form>
		</div>
	</body>
	<script>
		var phoneNumbers = [];
		var emailAddresses = [];
		var pNID = 0;
		var eAID = 0;
		/*function validatePhone(txtPhone) {
			var a = document.getElementById(txtPhone).value;
			var filter = /\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/;
			if (filter.test(a)) {
				return true;
			}
			else {
				return false;
			}
		}*/
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
                url: 'addContact.php',
                type: 'post',
                data: "firstname="+$("#pFirstname").val()+"&lastname="+$("#pLastname").val()+"&phoneNumbers="+json_arr_pN+"&emailAddresses="+json_arr_eA,
                success: function(data){
					window.location.href = 'index.php';
                }
            });
            e.preventDefault();
		});
	</script>
</html>