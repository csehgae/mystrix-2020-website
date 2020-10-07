<?php
    include('session.php');
    
    global $error;
    $error = "  ";
    
    # Total Registration
    $sql = "SELECT COUNT(*) as cntusr FROM registration";
    $result = mysqli_query($db,$sql) or die("ERROR : " . mysqli_error($db));
    $row = mysqli_fetch_array($result);
    $reg_count = $row['cntusr'];
    
    # Attendance
    $sql = "SELECT COUNT(*) as cntusr FROM registration WHERE attendance=1";
    $result = mysqli_query($db,$sql) or die("ERROR : " . mysqli_error($db));
    $row = mysqli_fetch_array($result);
    $atnd_count = $row['cntusr'];
   
?>

<!DOCTYPE html>
<html lang="en">
	<head>
        <title>MYSTRIX Home | <?php echo $login_session; ?></title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
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
			  <li class="active"><a href="">Home</a></li>
			  <li><a href="./registration.php">Registration</a></li>
			  <li><a href="./stats.php">Statistics</a></li>
			  <li><a href="./certificate.php">Certificates</a></li>
			  <li><a href="#"></a></li>
			  
			</ul>
			<ul class="nav navbar-nav navbar-right">
			  <li><a><span class="glyphicon glyphicon-user"></span><b> Welcome <?php echo $login_session; ?></b></a></li> 
			  <li><a href="./logout.php"><span class="glyphicon glyphicon-log-out"></span>Log Out</a></li>
			</ul>
		  </div>
		</nav>
	
	
	
		<div class="container">
		  <h2><b>MYSTRIX</b> Home</h2>
		  </br>
		  <table class="table">
			<tbody>
				<tr class="success">
					<td>Server Status</td>
					<td>Online</td>
				</tr>
				<tr class="active">
					<td>Total Registration</td>
					<td><?php echo $reg_count ?></td>
				</tr>
				<tr class="info">
					<td>Attendance</td>
					<td><?php echo $atnd_count ?></td>
					
				</tr>	  
			</tbody>
		  </table>
		</div>
        
        
	
	
	</body>
</html>