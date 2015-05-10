<?php
require('db/connect.php');

?>
<!DOCTYPE html>
<html>
<body>

<div>
<?php
//deletes the business that the user has selected from the business table

$biz_id = $_GET['biz_id'];  


if(!($stmt = $mysqli->prepare("DELETE FROM business WHERE business.biz_id = $biz_id LIMIT 1"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!($stmt->execute())){
	echo "Could not delete business "  . $stmt->errno . " " . $stmt->error;
}
else{
	echo "Business deleted";
}

?>

</div>

<div>
<br /><br />
<a href="index.php">Go back to home</a>
</div>

</body>
</html>