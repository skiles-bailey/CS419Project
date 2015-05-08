<?php
require 'db/connect.php';
?>

<?php
echo "<input type=hidden name=biz_id value=" . $_GET['biz_id'] . ">";

?>


<!DOCTYPE html>
<html>
<body>
<div>Update Business Information<br><br>
</div>

<!--Displayed business info here in a table (includes id, name)-->
<div>
	<table>
		
<?php
//displays the business information based upon the id that the user has selected
if(!($stmt = $mysqli->prepare("
SELECT B.biz_id, B.biz_name, A.address, A.address2, A.city, A.zipcode, B.phone, B.website, B.hours, S.service_type
FROM business B
INNER JOIN address A ON B.address_id=A.address_id
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
	echo $biz_name . "<br>" . $address . "<br>" . $address2 . "<br>" . $city . "<br>" . $zipcode . "<br>" . $phone . "<br>" . $website . "<br>" . $hours . "<br>" . $service_type;
	}
$stmt->close();
?>
	</table>
</div>





<!--links back to homepage-->
<div>
<br /><br />
<a href="index.php">Go back home</a>
</div>

</body>
</html>