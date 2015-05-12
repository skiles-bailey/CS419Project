<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
        <head>  
                <title>View Business Records</title>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        </head>
        <body>
                
                <h2>View Business Records</h2>
                
                <?php
                        // connects to the database
                        include('db/connect.php');
                        
                        // number of results shown per page
				        $per_page = 5;
				        
				        // figures out the total pages in the database
				        if ($result = $mysqli->query("SELECT * FROM business ORDER BY biz_id")){
						
				        	if ($result->num_rows != 0){
				        		$total_results = $result->num_rows;
					        	$total_pages = ceil($total_results / $per_page);
					        	
						        if (isset($_GET['page']) && is_numeric($_GET['page'])){
						            $show_page = $_GET['page'];
						                
						            // make sure the $show_page value is valid
						            if ($show_page > 0 && $show_page <= $total_pages){
						                $start = ($show_page -1) * $per_page;
						                $end = $start + $per_page; 
						            }
						            else{
						                // error - show first set of results
						                $start = 0;
						                $end = $per_page; 
						            }               
						        }
						        else{
						            // if page isn't set, show first set of results
						            $start = 0;
						            $end = $per_page; 
						        }
						        
						        // displays the pages
						        echo "<p><a href='view.php'>View All</a> | <b>View Page:</b> ";
						        for ($i = 1; $i <= $total_pages; $i++){
						        	if (isset($_GET['page']) && $_GET['page'] == $i){
						        		echo $i . " ";
						        	}
						        	else{
						        		echo "<a href='view_pages.php?page=$i'>$i</a> ";
						        	}
						        }
						        echo "</p>";
						        
						        // displays the data in table
						        echo "<table border='1' cellpadding='10'>";
						        echo "<tr> <th>ID</th> <th>Business Name</th> <th>Edit</th> <th>Delete</th></tr>";
						
						        // loop through results of database query, displaying them in the table 
						        for ($i = $start; $i < $end; $i++){
					                if ($i == $total_results) { break; }
						        	$result->data_seek($i);
   	 								$row = $result->fetch_row();
   	 								
   	 								// echo out the contents of each row into a table
					                echo "<tr>";
					                echo '<td>' . $row[0] . '</td>';
					                echo '<td>' . $row[1] . '</td>';
					                echo '<td><a href="edit_biz.php?biz_id=' . $row[0] . '">Edit</a></td>';
					                echo '<td><a href="delete.php?biz_id=' . $row[0] . '">Delete</a></td>';
					                echo "</tr>";
						        }

						        // close table>
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
</html>
