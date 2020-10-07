<?php
   include('config.php');
   session_start();
   
   $user_check = $_SESSION['username'];
   
   $ses_sql = mysqli_query($db,"SELECT username FROM login_data where username = '$user_check' ") or die("Error: " . mysqli_error($db));
   
   $row = mysqli_fetch_array($ses_sql);
   
   $login_session = $row['username'];
   
   if(!isset($_SESSION['username'])){
      header("location:login.php");
   }
?>