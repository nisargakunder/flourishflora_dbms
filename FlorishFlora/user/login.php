<?php 
include('../includes/connect.php');
include('../functions/common_function.php');
@session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <!--bootsrap css-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<style>
   body
   
        {   margin: 0;
  padding: 0;
  overflow:hidden;
  background-size: cover;
  background-position: center;
  background-attachment: fixed;
            background-image:url('../images/admin_login.jpg') ;
            opacity:75%;
        } 
    
</style>

<body>
<div class="container-fluid my-3">
    <h2 class="text-center"><b>User Login</b></h2>
    <div class="row d-flex align-items-centre justify-content-center">
        <div class="col-lg-12 col-xl-6">
<form action="" method="post">
    <div class="form-outline mb-4">
        <label for="email" class="form-label"><b>Email</b></label>
        <input type="email" id="email" class="form-control" placeholder="Enter your email" autocomplete="off" required="required" 
        name="email"/>
    </div>
    <div class="form-outline mb-4">
        <label for="password" class="form-label"><b>Password</b></label>
        <input type="password" id="password" class="form-control" placeholder="Enter your password" autocomplete="off" required="required" 
        name="password"/>
    </div>
    <div class="mt-4 pt-2">
        <input type="submit" value="Login" class="bg-success py-2 px-3 border=0" name="login"/>
        <p class="small fw-bold mt-2 pt-1 mb-0"><b><i>Don't have an account?</i></b><a href="registration.php">Register</a></p>
    </div>
</form>
        </div>
    </div>
</div>   
    
</body>
</html>

<?php

if(isset($_POST['login']))
{
    $email=$_POST['email'];
    $password=$_POST['password'];

    $select_query="select * from `user_table` where email='$email'";
    $result=mysqli_query($con,$select_query);
    $row_count=mysqli_num_rows($result);
    
    if($row_data=mysqli_fetch_assoc($result)){
    $cust_id=$row_data['cust_id'];
    $fname=$row_data['fname'];
    }
    $user_ip=$_SERVER['REMOTE_ADDR'];
    
///////////cart item
$select_query_cart="select * from `cart_details` where ip_address='$user_ip'";
$select_cart=mysqli_query($con,$select_query_cart);
$row_count_cart=mysqli_num_rows($select_cart);
    if($row_count>0){
        $_SESSION['email']=$email;
        if(password_verify($password,$row_data['password'])){
            if($row_count==1 and $row_count_cart==0){
                $_SESSION['email']=$email;
                echo "<script>alert('Logged in successfully!🤩')</script>";
                echo "<script>window.open('profile.php','_self')</script>";
            }
            else{
                $_SESSION['email']=$email;
                echo "<script>alert('Logged in successfully!🥳')</script>";
                echo "<script>alert('You have items in your cart🤗')</script>";
                echo "<script>window.open('payment.php','_self')</script>";
            }
        }else{
            echo "<script>alert('Invalid Credentials😥')</script>";
        }}
    else{
        echo "<script>alert('Invalid Credentials😥')</script>";
    }
}

?>