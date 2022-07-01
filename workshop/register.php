<?php
include('config.php');

if($_SERVER["REQUEST_METHOD"] == "GET") {
	$wname = mysqli_real_escape_string($db,htmlspecialchars($_GET['workshop']));

	if(($wname!="3dp")||($wname!="iot")||($wname!="ml")||($wname!="rbt")||($wname!="pm"))
	{$error; }
	else
	{
	    if($_SERVER["REQUEST_METHOD"] == "POST") {
	        $pname = mysqli_real_escape_string($db,$_POST['name']);
	        $pmailid = mysqli_real_escape_string($db,$_POST['mailid']);
	        $pphone = mysqli_real_escape_string($db,$_POST['phone']);
	        
	        
        	# Checking for registration
        	$sql = "SELECT COUNT(*) as cntusr FROM workshop WHERE p_name = '".$pname."' AND p_mailid = '".$pmailid."'";
        	$result = mysqli_query($db,$sql) or die("ERROR : " . mysqli_error($db));
        	$row = mysqli_fetch_array($result);
        	$count = $row['cntusr'];
        
        	# Check Aleardy REgistered or not.
        	if($count < 0) {
        		$sql_data = mysqli_query($db,"INSERT INTO workshop ('p_name', 'p_mailid', 'p_phone') VALUES ('".$pname."','".$pmailid."','".$pphone."')") or die("ERROR : " . mysqli_error($db));
        		$row_data = mysqli_fetch_array($sql_data);
        		//Parse data
        		$uregid = $row_data['reg_id'];
        		$uname = $row_data['full_name'];
        		
        		#registration success
        	
        		
        		}
        	else {
        		header("Location: ./register.php?workshop='".$wname."'");
        		}
    
        }
	}
}
?>