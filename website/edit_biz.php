<?php

    // connects to the database
    include('db/connect.php');
	
	function renderForm($biz_name = '', $address ='', $address2 ='', $city ='', $zipcode ='', $phone ='', $website ='', $hours ='', $service_id ='', $error = '', $biz_id = '')
	{ 
?>
		
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
	<html>
	<head>	
		<title> Edit Business </title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	</head>
	
	
	<body>
		<h2>Edit Business</h2>
		<?php 
			if ($error != ''){
				echo "<div style='padding:4px; color:red'>" . $error. "</div><br/>";
			} 
		?>
		
		<!-- Edit Business Form -->	
		<form action="" method="post">
		<div>
			<?php if ($biz_id != '') { 
			?>
			<input type="hidden" name="biz_id" value="<?php echo $biz_id; ?>" />
			<p><strong>Business ID: <?php echo $biz_id; ?></strong></p>
			<?php } ?>
			
			<!-- Form Fields -->
			<strong>Business Name: *</strong> <input type="text" name="biz_name" value="<?php echo $biz_name; ?>"/><br/><br/>
			<strong>Address: </strong> <input type="text" name="address" value="<?php echo $address; ?>"/><br/><br/>
			<strong>Address2: </strong> <input type="text" name="address2" value="<?php echo $address2; ?>"/><br/><br/>
			<strong>City: </strong> <input type="text" name="city" value="<?php echo $city; ?>"/><br/><br/>
			<strong>Zip Code: </strong> <input type="text" name="zipcode" value="<?php echo $zipcode; ?>"/><br/><br/>
			<strong>Phone: </strong> <input type="text" name="phone" value="<?php echo $phone; ?>"/><br/><br/>
			<strong>Website: </strong> <input type="text" name="website" value="<?php echo $website; ?>"/><br/><br/>
			<strong>Hours: </strong> <input type="text" name="hours" value="<?php echo $hours; ?>"/><br/><br/>
			<strong>Type of Service: *</strong> 
				<?php if ($service_id == "1"){
					echo "Currently: Reuse";}
				else{
					echo "Currently: Repair";
				}?><br/>
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
			
		// checks to see if the biz_id is valid
		if (is_numeric($_POST['biz_id'])){
			
			// gets the data from the database
			$biz_id = $_POST['biz_id'];
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
				renderForm($biz_name, $address, $address2, $city, $zipcode, $phone, $website, $hours, $service_id, $error, $biz_id);
			}
			else{
				// update the record in the database
				if ($stmt = $mysqli->prepare("UPDATE business SET biz_name = ?, address = ?, address2 = ?, city = ?, zipcode = ?, phone = ?, website = ?, hours = ?, service_id = ?
				WHERE biz_id=?")){
					$stmt->bind_param("ssssssssii", $biz_name, $address, $address2, $city, $zipcode, $phone, $website, $hours, $service_id, $biz_id);
					$stmt->execute();
					$stmt->close();
				}
				
				// an error message is shown if there is a problem with the query
				else{
					echo "ERROR: could not prepare SQL statement.";
				}
					
				//redirects the user once the record has been successfully updated into the database
				header("Location: view.php");
			}
		}
		
		// an error message is shown if biz_id is not valid
		else{
			echo "Error!";
		}
	}
		// show the form
	else{
		
		// checks to see if the biz_id is valid
		if (is_numeric($_GET['biz_id']) && $_GET['biz_id'] > 0){
				
			// gets biz_id from URL
			$biz_id = $_GET['biz_id'];
				
			// gets the data from the database
			if($stmt = $mysqli->prepare("SELECT * FROM business WHERE biz_id=?")){
				$stmt->bind_param("i", $biz_id);
				$stmt->execute();
				$stmt->bind_result($biz_id, $biz_name, $address, $address2, $city, $zipcode, $phone, $website, $hours, $service_id);
				$stmt->fetch();
					
				renderForm($biz_name, $address, $address2, $city, $zipcode, $phone, $website, $hours, $service_id, NULL, $biz_id);
					
				$stmt->close();
			}
				
			// an error message is shown if there is a problem with the query
			else{
				echo "Error: could not prepare SQL statement";
			}
		}
		// if biz_id value is not valid, redirect the user back to view.php
		else{
			header("Location: view.php");
		}
	}
	
	// close the database connection
	$mysqli->close();
?>