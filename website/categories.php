<?php

require 'db/connect.php';

?>

<style>
td{
    border-style:solid;
    border-width:1px;
    padding:5px 5px 2px;
}
</style>


<!DOCTYPE html>

<html>
<head>
	<title>Administration Page</title>
</head>
<body>

<b>Administration Page</b>

<div>
	<table><br>
		<tr>List of Categories<br><br>
		</tr>
		<tr>
			<td>Subcategory ID</td>
			<td>Subcategory Name</td>
			<td>Category ID</td>
			<td>Category Name</td>
		</tr>
		
<!--Display subcategory and category info here in a table (includes subcategory ID, subcategory name, category ID, and category name)-->
<?php
if(!($stmt = $mysqli->prepare("
SELECT SC.scat_id, SC.scat_name, C.cat_id, C.cat_name
FROM subcategory SC
INNER JOIN category C ON SC.cat_id=C.cat_id
ORDER BY scat_id
"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!($stmt->execute())){
	echo "execute failed: .";
}
if(!($stmt->bind_result($scat_id, $scat_name, $cat_id, $cat_name))){
	echo "bind failed: .";
}
while ($stmt->fetch()){
	echo "<tr>\n<td>\n" . $scat_id . "\n</td>\n<td>\n" . $scat_name . "\n</td>\n<td>\n" . $cat_id . "\n</td>\n<td>\n" . $cat_name;
	}
$stmt->close();
?>
	</table><br>
</div>

</body>
</html>
