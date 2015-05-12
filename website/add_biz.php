<?php

    // connects to the database
    include('db/connect.php');
	
	function renderForm($biz_name = '', $address ='', $address2 ='', $city ='', $zipcode ='', $phone ='', $website ='', $hours ='', $service_id ='', $error = '', $biz_id = '')
	{ 
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
	<html>
	<head>	
		<title> Add New Business </title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	</head>
	
	
	<body>
		<h2>Add New Business</h2>
		<?php 
			if ($error != ''){
				echo "<div style='padding:4px; color:red'>" . $error. "</div><br/>";
			} 
		?>
		
		<!-- Add Business Form -->	
		<form action="" method="post">
		<div>
			<?php 
				if ($biz_id != ''){ 
			?>
			<input type="hidden" name="biz_id" value="" />
			<p><strong>Business ID:</strong></p>
			<?php } ?>
			
			<!-- Form Fields -->		
			<strong>Business Name: *</strong> <input type="text" name="biz_name" value=""/><br/><br/>
			<strong>Address: </strong> <input type="text" name="address" value=""/><br/><br/>
			<strong>Address2: </strong> <input type="text" name="address2" value=""/><br/><br/>
			<strong>City: </strong> <input type="text" name="city" value=""/><br/><br/>
			<strong>Zip Code: </strong> <input type="text" name="zipcode" value=""/><br/><br/>
			<strong>Phone: </strong> <input type="text" name="phone" value=""/><br/><br/>
			<strong>Website: </strong> <input type="text" name="website" value=""/><br/><br/>
			<strong>Hours: </strong> <input type="text" name="hours" value=""/><br/><br/>
			<strong>Type of Service: *</strong> 
				<input type="radio" name="service_id" value="1"/>Reuse 
				<input type="radio" name="service_id" value="2"/>Repair<br/>
			<p>* required</p>
			
			<!-- Submit and Reset Buttons -->	
			<input type="submit" name="submit" value="Submit" />
			<input type="reset" name="reset" value="Reset" />
		</div>
		</form>
		<br/>
		<a href="view.php">Back To View Business Records</a><br/>
		<a href="index.php">Back To Home</a>
	</body>
</html>
		
<?php }
	if (isset($_POST['submit'])){
	
		// gets the data from the form
		$biz_name = htmlentities($_POST['biz_name'], ENT_QUOTES);
		$address = htmlentities($_POST['address'], ENT_QUOTES);
		$address2 = htmlentities($_POST['address2'], ENT_QUOTES);
		$city = htmlentities($_POST['city'], ENT_QUOTES);
		$zipcode = htmlentities($_POST['zipcode'], ENT_QUOTES);
		$phone = htmlentities($_POST['phone'], ENT_QUOTES);
		$website = htmlentities($_POST['website'], ENT_QUOTES);
		$hours = htmlentities($_POST['hours'], ENT_QUOTES);
		$service_id = htmlentities($_POST['service_id'], ENT_QUOTES);
			
		// checks to see if biz_name and service_id is empty
		if ($biz_name == '' || $service_id == ''){
		
			// if it's empty an error message is shown
			$error = 'ERROR: Please fill in all required fields';
			renderForm($biz_name, $address, $address2, $city, $zipcode, $phone, $website, $hours, $service_id, $error);
		}
		else{
		
			// inserts the new record into the database
			if ($stmt = $mysqli->prepare("INSERT business (biz_name, address, address2, city, zipcode, phone, website, hours, service_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)")){
				$stmt->bind_param("ssssssssi", $biz_name, $address, $address2, $city, $zipcode, $phone, $website, $hours, $service_id);
				$stmt->execute();
				$stmt->close();
			}
			
			// an error message is shown if there is a problem with the query
			else{
				echo "ERROR: Could not prepare SQL statement.";
			}
					
			// redirects the user once a new record has been successfully entered into the database
			header("Location: view.php");
		}		
	}

	// show the form
	else{
		renderForm();
	}
	
	// close database connection
	$mysqli->close();
?>