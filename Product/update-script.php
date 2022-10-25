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
 $query= "SELECT * FROM menus WHERE id= $id";
 $exec = mysqli_query($connection, $query);
 //$row= mysqli_fecth_assoc($exec);
 return $row;
}
// update data query
function update_data($connection, $id){
  $product_id= legal_input($_POST['product_id']);
  $name= legal_input($_POST['name']);
  $short_details = legal_input($_POST['short_details']);
  $price = legal_input($_POST['price']);
  $image_url = legal_input($_POST['image_url']);
  $tag_name = legal_input($_POST['tag_name']);
  $category_id = legal_input($_POST['category_id']);
      $query="UPDATE products
            SET product_id='$product_id',
            name= '$name',
            short_details='$short_details',
            price= '$price',
            image_url='$image_url',
            category_id= '$category_id',
            tag_name='$tag_name',
            category_id= '$category_id'
             WHERE id=$id";
      $exec= mysqli_query($connection,$query);
  
      if($exec){
         header('location: product-table.php');
      
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