<?php
ini_set('display_errors', 'On');
header("Content-Type: text/plain");

if (!isset($_POST['username']) || !isset($_POST['password'])) {
    header("Location: login.php");
} else if ($_POST['username'] == NULL) {
    header("Location: login.php");
} else if ($_POST['password'] == NULL) {
    header("Location: login.php");
} else {
    include 'storedInfo.php';
    
    $mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
  
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL:(" . $mysqli->connect-errno .
             ") " . $mysqli->connect_error;
    }
    
    if (!($stmt = $mysqli->prepare("SELECT username, password FROM 
                                    Accounts WHERE username=?"))) {
        echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
    }
    
    if (!$stmt->bind_param("s", $_POST['username'])) {
        echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
    }
    
    if (!$stmt->execute()) {
        echo "Execute failed: (" . $mysqli->errno . ") " . $mysqli->error;
    }
    
    $outName = NULL;
    $outPassword = NULL;
    if (!$stmt->bind_result($outName, $outPassword)) {
        echo "Binding output parameters failed: (" . $stmt->errno . ") " 
              . $stmt->error;
    }
    
    if ($stmt->fetch()) {
        if ($_POST['password'] === $outPassword) {
            session_start();
            $_SESSION['username'] = $_POST['username'];
            $_SESSION['logged_in'] = 'yes';
            header("Location: index.php");
        } else {
            header("Location: login.php");
        }
    } else {
        header("Location: login.php");
    }
    
    $stmt->close();
}
?>