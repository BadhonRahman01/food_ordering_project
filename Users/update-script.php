<?php
include('database.php');
if(isset($_GET['edit'])){
    $id= $_GET['edit'];
  $editData= edit_data($connection, $id);
}
if(isset($_POST['update']) && isset($_GET['edit'])){
  $id= $_GET['edit'];
    update_data($connection,$id);
    
    
} 
function edit_data($connection, $id)
{
 $query= "SELECT * FROM users WHERE id= $id";
 $exec = mysqli_query($connection, $query);
 //$row= mysqli_fecth_assoc($exec);
 return $row;
}
// update data query
function update_data($connection, $id){
  $full_name= legal_input($_POST['full_name']);
  $phone = legal_input($_POST['phone']);
  $email = legal_input($_POST['email']);
      $query="UPDATE users
            SET full_name='$full_name',
            phone= '$phone',
            email='$email'
             WHERE id=$id";
      $exec= mysqli_query($connection,$query);
  
      if($exec){
         header('location: user-table.php');
      
      }else{
         $msg= "Error: " . $query . "<br>" . mysqli_error($connection);
         echo $msg;  
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