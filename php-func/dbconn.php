<?php
	//Server Information
      $server = "localhost";
      $username = "root";
      $password = "";
      $database = "qhouse";

      
    //Connection MySQL Database
   	$conn = mysqli_connect($server, $username, $password, $database);

   	//Check
   	if($conn){
   		return true;
   	} else{
   		echo "Database does not connect";
   	}
?>