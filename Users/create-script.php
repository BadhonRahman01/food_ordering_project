<?php
include('database.php');
if(isset($_POST['create'])){
   
      $msg=insert_data($connection);
      
}
// insert query
function insert_data($connection){
   
      
      $full_name= legal_input($_POST['full_name']);
      $phone = legal_input($_POST['phone']);
      $email = legal_input($_POST['email']);
      $query="INSERT INTO users (full_name,phone,email) VALUES ('$full_name','$phone','$email')";
      $exec= mysqli_query($connection,$query);
      if($exec){
        $msg="User Added Successfully";
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