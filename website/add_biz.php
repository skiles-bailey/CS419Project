<?php
	require('db/connect.php');

	
if (isset($_POST['submitted'])){
	if (empty($_POST["biz_name"])) {
     echo "<font color='red'>* Business name is required</font>";
	 echo "<br>";
	} 
	else {
		$biz_name = $_POST['biz_name'];
	}

	$phone = $_POST['phone'];
	$website = $_POST['website'];
	$hours = $_POST['hours'];
	
	if (empty($_POST["service_id"])) {
     echo "<font color='red'>* Service type is required</font>";
	 echo "<br>";
	} 
	else {
		$service_id = $_POST['service_id'];
	}
	
	$sqlinsert = "INSERT INTO business (biz_name, phone, website, hours, service_id) VALUES ('$biz_name', '$phone', '$website', '$hours', $service_id)";
	
	$address = $_POST['address'];
	$address2 = $_POST['address2'];
	$city = $_POST['city'];
	$zipcode = $_POST['zipcode'];
	
	$sqlinsert2 = "INSERT INTO address (address, address2, city, zipcode) VALUES ('$address', '$address2', '$city', '$zipcode')";
	
	if(!mysqli_query($mysqli, $sqlinsert)){
		echo "<br>";
		echo "<b>Error inserting new business</b>";
		echo "<br><br>";
	 }
	else{
		echo "<b>One business added successfully!</b>";
		echo "<br><br>";
	}
}
?>

<!DOCTYPE html>
<html>
<body>

<div>

<!--Add a new business here-->
<form method="post" action="add_biz.php">
<input type="hidden" name="submitted" value="true" />
<fieldset>
	<legend>Add a new business</legend>
	<label>Business Name <input type="text" name="biz_name" /></label><br><br>
	<label>Address <input type="text" name="address" /></label><br><br>
	<label>Address2 <input type="text" name="address2" /></label><br><br>
	<label>City <input type="text" name="city" /></label><br><br>
	<label>Zip Code <input type="text" name="zipcode" /></label><br><br>
	<label>Phone <input type="text" name="phone" /></label><br><br>
	<label>Website <input type="text" name="website" /></label><br><br>
	<label>Hours <input type="text" name="hours" /></label><br>
	
	<p>Type of Service:
	<select name="service_id">
	<option value="" selected="selected">Select one</option>
<?php
if(!($stmt = $mysqli->prepare("SELECT service_id, service_type
FROM service S"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!($stmt->execute())){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!($stmt->bind_result($service_id, $service_type))){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while ($stmt->fetch()){
	echo '<option value=" '. $service_id . ' "> ' . $service_type . '</option>\n';
}
echo '\n';
$stmt->close();
?>
	</select><br><br>
	
<!--Category list-->
	<p>Categories:
	<select name="categories">
	<option value="" selected="selected">Select:</option>
<?php
if(!($stmt = $mysqli->prepare("SELECT scat_id, scat_name
FROM subcategory SC"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!($stmt->execute())){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!($stmt->bind_result($scat_id, $scat_name))){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while ($stmt->fetch()){
	echo '<option value=" '. $scat_id . ' "> ' . $scat_name . '</option>\n';
}
echo '\n';
$stmt->close();
?>
	</select><br><br>

<input type="submit"  value="Add Business"/>
</fieldset>
</div>
</form>

</div>

<div>
<br /><br />
<a href="index.php">Go back to home</a>
</div>

</body>
</html>