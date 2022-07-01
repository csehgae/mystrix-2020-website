<?php
   include('config.php');
   session_start();
   
   $user_check = $_SESSION['reg_id'];
   
   $ses_sql = mysqli_query($db,"SELECT reg_id FROM registration where reg_id = '$user_check' ") or die("Error: " . mysqli_error($db));
   
   $row = mysqli_fetch_array($ses_sql);
   
   $login_session = $row['reg_id'];
   
   if(!isset($_SESSION['reg_id'])){
      header("location: oops.html");
   }
?>