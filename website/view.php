<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
        <head>  
                <title>View Business Records</title>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        </head>
        <body>
                
                <h2>View Business Records</h2>
                
                <p><b>View All</b> | <a href="view_pages.php">View 5 Per Page</a></p>
                
                <?php
                        // connects to the database
                        include('db/connect.php');
                        
                        // get data from the database
                        if ($result = $mysqli->query("SELECT * FROM business ORDER BY biz_id")){
                                // display data if available
                                if ($result->num_rows > 0){
                                        echo "<table border='1' cellpadding='10'>";
                                        
                                        // table headers
                                        echo "<tr><th>ID</th><th>Business Name</th><th>Edit</th><th>Delete</th></tr>";
                                        
                                        while ($row = $result->fetch_object()){
                                                // creates a row for each record
                                                echo "<tr>";
                                                echo "<td>" . $row->biz_id . "</td>";
                                                echo "<td>" . $row->biz_name . "</td>";
                                                echo "<td><a href='edit_biz.php?biz_id=" . $row->biz_id . "'>Edit</a></td>";
                                                echo "<td><a href='delete.php?biz_id=" . $row->biz_id . "'>Delete</a></td>";
                                                echo "</tr>";
                                        }
                                        
                                        echo "</table>";
                                }
                                else{
                                        echo "No results to display!";
                                }
                        }
                        // an error message is shown if there is a problem with the query
                        else{
                                echo "Error: " . $mysqli->error;
                        }
                        
                        // close database connection
                        $mysqli->close();
                
                ?>
                <br/>
				<a href="add_biz.php">Add New Business</a><br/><br/>
				<a href="index.php">Back To Home</a>
        </body>
</html>