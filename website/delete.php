<?php

    // connects to the database
    include('db/connect.php');
	
	// confirms that biz_id is set
	if (isset($_GET['biz_id']) && is_numeric($_GET['biz_id'])){
		// get biz_id form the URL
		$biz_id = $_GET['biz_id'];
		
		// delete the record from database
		if ($stmt = $mysqli->prepare("DELETE FROM business WHERE biz_id = ? LIMIT 1")){
			$stmt->bind_param("i",$biz_id);	
			$stmt->execute();
			$stmt->close();
		}
		// An error message is shown if there is a problem with the query
		else{
			echo "ERROR: could not prepare SQL statement.";
		}
		$mysqli->close();
		
		// redirect user to the view page after delete is successful
		header("Location: view.php");
	}
	else{
	// Redirects the user if biz_id isn't set
		header("Location: view.php");
	}

?>