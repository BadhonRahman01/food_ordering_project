<?php
include('update-script.php');
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Update User</title>
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
    <h2>Update User </h2>
    
    
    </div>
 
    <p style="color:red">
    
<?php if(!empty($msg)){echo $msg; }?>
</p>
    <form method="post" action="">
          
          <label>Full Name</label>
<input type="text" placeholder="Enter Full Name" name="full_name" required value="<?php echo isset($editData) ? $editData['full_name'] : '' ?>">
          <label>Phone</label>
<input type="tel" placeholder="Enter Phone Number" name="phone"  value="<?php echo isset($editData) ? $editData['phone'] : '' ?>">
          <label>Email</label>
<input type="text" placeholder="Enter Service Status" name="email"  value="<?php echo isset($editData) ? $editData['email'] : '' ?>">

          <button type="submit" name="update">Update User</button>
    </form>
        </div>
</div>
<!--====form section start====-->
</body>
</html>