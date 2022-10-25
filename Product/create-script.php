<?php
include('database.php');
if(isset($_POST['create'])){
   
      $msg=insert_data($connection);
      
}
// insert query
function insert_data($connection){
   
      
      $product_id= legal_input($_POST['product_id']);
      $name= legal_input($_POST['name']);
      $short_details = legal_input($_POST['short_details']);
      $price = legal_input($_POST['price']);
      $image_url = legal_input($_POST['image_url']);
      $tag_name = legal_input($_POST['tag_name']);
      $category_id = legal_input($_POST['category_id']);
      $query="INSERT INTO products (product_id,name,short_details,category_id,price,image_url,tag_name) VALUES ('$product_id','$name','$short_details','$price','$image_url','$tag_name','$category_id')";
      $exec= mysqli_query($connection,$query);
      if($exec){
        $msg="Product Added Successfully";
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