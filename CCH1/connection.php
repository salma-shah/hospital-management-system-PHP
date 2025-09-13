<?php

    $databaseHostName = 'localhost';
    $databaseUsername='root'; 
    $databasePassword= '';
  
   $connection = mysqli_connect($databaseHostName, $databaseUsername, $databasePassword);
       if(!$connection ) 
       { 
        die('There was an error in connecting: ' . mysqli_error($connection));
       } 

	
	$database= mysqli_select_db($connection,'care_compass_hospital');
	
	if(!$database)
    {	
	 die('You need to select the database first.');
	}
		
	  // mysqli_close($conn);
      
?>
