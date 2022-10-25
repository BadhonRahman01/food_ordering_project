
<?php
include('create-script.php');
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Services Crud Operation</title>
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
    <h2>Create Service</h2>
    
    
    </div>
 
<p style="color:red"><?php if(!empty($msg)){echo $msg; }?></p>
<button >  <a href="http://localhost/Food_Ordering_Project/Sercices/Service-table.php">Service List</a></button>
    <form method="post" action="">
          <label>Service ID</label>
          <input type="number" placeholder="Enter service ID" name="service_id" required>
          <label>Service Name</label>
          <input type="text" placeholder="Name of the service" name="name" required>
          <label>Status</label>
          <input type="text" placeholder="Enter Service Status" name="status" required>

          <button type="submit" name="create">Submit</button>
    </form>
        </div>
</div>
<!--====form section start====-->
</body>
</html>




