<?php
include('update-script.php');
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Update Menu</title>
<style>
    
body{
    overflow-x: hidden;
}
* {
  box-sizing: border-box;}
.user-detail form {
    height: 100vh;
    border: 2px solid #f1f1f1;
    padding: 16px;
    background-color: white;
    }
    .user-detail{
      width: 30%;
    float: left;
    }
input{
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  display: inline-block;
  border: none;
  background: #f1f1f1;}
input[type=text]:focus, input[type=password]:focus {
    background-color: #ddd;
    outline: none;}
button[type=submit] {
    background-color: #434140;
    color: #ffffff;
    padding: 10px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
    opacity: 0.9;
    font-size: 20px;}
label{
  font-size: 18px;;}
button[type=submit]:hover {
  background-color:#3d3c3c;}
  .form-title a, .form-title h2{
   display: inline-block;
   
  }
  .form-title a{
      text-decoration: none;
      font-size: 20px;
      background-color: green;
      color: honeydew;
      padding: 2px 10px;
  }
 
</style>
</head>
<body>
<!--====form section start====-->
<div class="user-detail">
    <div class="form-title">
    <h2>Update Product </h2>
    
    
    </div>
 
    <p style="color:red">
    
<?php if(!empty($msg)){echo $msg; }?>
</p>
    <form method="post" action="">
    <label>Product ID</label>
<input type="number" placeholder="Enter Product ID" name="product_id"  value="<?php echo isset($editData) ? $editData['product_id'] : '' ?>">
          <label>Product Name</label>
<input type="text" placeholder="Enter Product Name" name="name" required value="<?php echo isset($editData) ? $editData['name'] : '' ?>">
<label>Product Short Details</label>
<input type="text" placeholder="Enter Product Short Details" name="short_details" required value="<?php echo isset($editData) ? $editData['short_details'] : '' ?>">

<label>Product Price</label>
<input type="number" placeholder="Enter Product Price" name="price"  value="<?php echo isset($editData) ? $editData['price'] : '' ?>">
          <label>Image URL</label>
<input type="url" placeholder="Enter Product Image" name="image_url"  value="<?php echo isset($editData) ? $editData['image_url'] : '' ?>">
<label>Product Tag Name</label>
<input type="text" placeholder="Enter Product Tag Name" name="tag_name"  value="<?php echo isset($editData) ? $editData['tag_name'] : '' ?>">
          <label>Category ID</label>
<input type="number" placeholder="Enter Category ID" name="category_id"  value="<?php echo isset($editData) ? $editData['category_id'] : '' ?>">
          <button type="submit" name="update">Update Product</button>
    </form>
        </div>
</div>
<!--====form section start====-->
</body>
</html>