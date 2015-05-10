<?php
	require('db/connect.php');
	
	$biz_name = $_POST['biz_name'];
	$phone = $_POST['phone'];
	$website = $_POST['website'];
	$hours = $_POST['hours'];
	$address = $_POST['address'];
	$address2 = $_POST['address2'];
	$city = $_POST['city'];
	$zipcode = $_POST['zipcode'];


?>


<!DOCTYPE html>
<html>
<body>
<div>View Business Information<br><br>
</div>

<!--Displayed business info here in a table (includes id, name)-->
<div>
	<table>
		
<?php
//displays the business information based upon the id that the user has selected
if(!($stmt = $mysqli->prepare("
SELECT B.biz_id, B.biz_name, B.address, B.address2, B.city, B.zipcode, B.phone, B.website, B.hours, S.service_type
FROM business B
INNER JOIN service S ON B.service_id=S.service_id
WHERE B.biz_id = ?"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!($stmt->bind_param("i",$_GET['biz_id']))){
echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!($stmt->execute())){
	echo "execute failed: .";
}
if(!($stmt->bind_result($biz_id, $biz_name, $address, $address2, $city, $zipcode, $phone, $website, $hours, $service_type))){
	echo "bind failed: .";
}
while ($stmt->fetch()){
	echo "Business ID:&emsp;" . $biz_id . "<br>Business Name:&emsp;" . $biz_name . "<br>Address:&emsp;" . $address . "<br>Address2:&emsp;" . 
			$address2 . "<br>City:&emsp;" . $city . "<br>Zip Code:&emsp;" . $zipcode . "<br>Phone Number:&emsp;" . $phone . "<br>Website:&emsp;" . 
			$website . "<br>Business Hours:&emsp;" . $hours . "<br>Service Type:&emsp;" . $service_type;
	}
$stmt->close();
?>
	</table>
</div>



<div>





<!--links back to homepage-->
<div>
<br /><br />
<a href="index.php">Go back home</a>
</div>

</body>
</html>