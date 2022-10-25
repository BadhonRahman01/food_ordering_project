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
 $query= "SELECT * FROM banner_ad WHERE id= $id";
 $exec = mysqli_query($connection, $query);
 //$row= mysqli_fecth_assoc($exec);
 return $row;
}
// update data query
function update_data($connection, $id){
  $service_id= legal_input($_POST['service_id']);
  $name = legal_input($_POST['name']);
  $status = legal_input($_POST['status']);
      $query="UPDATE services
            SET service_id='$service_id',
            name= '$name',
            status='$status'
             WHERE id=$id";
      $exec= mysqli_query($connection,$query);
  
      if($exec){
         header('location: Service-table.php');
      
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