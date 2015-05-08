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
		<tr>List of Businesses<br><br>
		</tr>
		<tr>
			<td>Business ID</td>
			<td>Business Name</td>
			<td>Update Business</td>
		</tr>
		
<!--Display business info here in a table (includes ID and business name)-->
<?php
if(!($stmt = $mysqli->prepare("
SELECT B.biz_id, B.biz_name
FROM business B
ORDER BY biz_id
"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!($stmt->execute())){
	echo "execute failed: .";
}
if(!($stmt->bind_result($biz_id, $biz_name))){
	echo "bind failed: .";
}
while ($stmt->fetch()){
	echo "<tr>\n<td>\n" . $biz_id . "\n</td>\n<td>\n" . $biz_name . "\n</td>\n<td>\n";
	echo "<a href=\"update.php?biz_id=" . $biz_id . "\">Update Business</a>\n";
	}
$stmt->close();
?>
	</table><br>
</div>

</body>
</html>
