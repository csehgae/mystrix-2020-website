<?php
    include('session.php');
    
    global $error;
    $error = "  ";
    
	$qregid = NULL;
	$qname = " ";
	$qmailid = " ";
	$qcontactno = " ";
	$qbranch = " ";
	$qyear = " ";
	$qcollege = " ";
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
	   
      // Data send from attendance form
      $uregid = mysqli_real_escape_string($db,$_POST['regid']);           // Full Name
      
	  // Checking for registration
	  $sql = "SELECT COUNT(*) as cntusr FROM registration WHERE reg_id = '".$uregid."'";
	  $result = mysqli_query($db,$sql) or die("ERROR : " . mysqli_error($db));
      $row = mysqli_fetch_array($result);
      $count = $row['cntusr'];
      // If result matched $umailid and $uname, $count>0
      if($count > 0) { 
		
		$sql_data = mysqli_query($db,"SELECT reg_id, full_name, mail_id, contact_no, branch, year, college FROM registration WHERE reg_id = '".$uregid."'") or die("ERROR @extract_data : " . mysqli_error($db));
		$row_data = mysqli_fetch_array($sql_data);
		//Parse data
		$qregid = $row_data['reg_id'];
		$qname = $row_data['full_name'];
		$qmailid = $row_data['mail_id'];
		$qcontactno = $row_data['contact_no'];
		$qbranch = $row_data['branch'];
		$qyear = $row_data['year'];
		$qcollege = $row_data['college'];
	  }
	  else {
		  $error = "Registration not found";
	  }
   }
   
   
   
   
?>

<!DOCTYPE html>
<html lang="en">
	<head>
        <title>MYSTRIX Registration | <?php echo $login_session; ?></title>
		
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="icon" href="./assets/images/mystrix_fill_black.svg" type="image/svg">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    </head>
	<body>
		<nav class="navbar navbar-inverse">
		  <div class="container-fluid">
			<div class="navbar-header">
			  <img class="navbar-brand" src="./assets/images/mystrix_fill_white.svg"><img>
			  <a class="navbar-brand" onclick="window.location.reload();" href=""><b>MYSTRIX</b></a>
			</div>
			<ul class="nav navbar-nav">
			  <li><a href="./home.php">Home</a></li>
			  <li class="active"><a href="">Registration</a></li>
			  <li><a href="./stats.php">Statistics</a></li>
			  <li><a href="./certificate.php">Certificates</a></li>
			  <li><a href="#"></a></li>
			  
			</ul>
			<ul class="nav navbar-nav navbar-right">
			  <li><a href="#user"><span class="glyphicon glyphicon-user"></span><b> Welcome <?php echo $login_session; ?></b></a></li>
			  <li><a href="./logout.php"><span class="glyphicon glyphicon-log-out"></span>Log Out</a></li>
			</ul>
		  </div>
		</nav>

		<div class="container">
		  <h2><b>MYSTRIX</b> Registration</h2>
		  </br>

		<div>
	        <form action="#" method="post" id="regid-submit" accept-charset="UTF-8">
	            <div>Reg ID :  <input id="regid" name="regid" type="text" size="18" required>
	           <button type="submit" value = "Submit" name="Submit">Submit</button>  	</div>
	        </form>
            <br>
            <br>
	        <p>Your Registration ID : <?php echo $qregid; ?>     </p>
	        <p>Name                 : <?php echo $qname; ?>      </p>
	        <p>Mail ID              : <?php echo $qmailid; ?>    </p>
	        <p>Contact No.          : <?php echo $qcontactno; ?> </p>
	        <p>Branch               : <?php echo $qbranch; ?>    </p>
	        <p>Year                 : <?php echo $qyear; ?>      </p>
	        <p>College              : <?php echo $qcollege; ?>   </p> 
        </div>
        <br>
        <br>
        <form action="attendance.php" method="post" id="atnd-confirm" method="post" accept-charset="UTF-8">
        <button type="atnd_confirm" value = "Confirm" name="Confirm">Confrim Attendance</button>
        </form>

        </div>

	
	
	
	
	
	</body>
</html>