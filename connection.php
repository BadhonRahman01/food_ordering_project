
<?php
 
 $conn = "";
   
 try {
     $servername = "localhost:3306";
     $dbname = "food_ordering_project";
     $username = "root";
     $password = "";
   
     $conn = new PDO(
         "mysql:host=$servername; dbname=food_ordering_project",
         $username, $password
     );
      
    $conn->setAttribute(PDO::ATTR_ERRMODE,
                     PDO::ERRMODE_EXCEPTION);
 }
 catch(PDOException $e) {
     echo "Connection failed: " . $e->getMessage();
 }
  
 ?>