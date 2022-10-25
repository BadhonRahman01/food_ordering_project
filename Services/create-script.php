<?php
include('database.php');
if(isset($_POST['create'])){
   
      $msg=insert_data($connection);
      
}
// insert query
function insert_data($connection){
   
      
      $service_id= legal_input($_POST['service_id']);
      $name = legal_input($_POST['name']);
      $status = legal_input($_POST['status']);
      $query="INSERT INTO services (service_id,name,status) VALUES ('$service_id','$name','$status')";
      $exec= mysqli_query($connection,$query);
      if($exec){
        $msg="Service Added Successfully";
        return $msg;
      
      }else{
        $msg= "Error: " . $query . "<br>" . mysqli_error($connection);
      }
}
// convert illegal input to legal input
function legal_input($value) {
  $value = trim($value);
  $value = stripslashes($value);
  $value = htmlspecialchars($value);
  return $value;
}
?>