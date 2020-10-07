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
    # %
    $percent= ($atnd_count/$reg_count)*100;
    
    
    # Workshop : 3D Printing
    # Registration
    $sql = "SELECT COUNT(*) as cntusr FROM workshop WHERE w_name='3dp'";
    $result = mysqli_query($db,$sql) or die("ERROR : " . mysqli_error($db));
    $row = mysqli_fetch_array($result);
    $d3_reg = $row['cntusr'];
    # Attendance
    $sql = "SELECT COUNT(*) as cntusr FROM workshop WHERE attendance=1 AND w_name='3dp'";
    $result = mysqli_query($db,$sql) or die("ERROR : " . mysqli_error($db));
    $row = mysqli_fetch_array($result);
    $d3_attend = $row['cntusr'];
    # %
    $d3_percent= ($d3_attend/$d3_reg)*100;
    
    # Workshop : IoT & Arduino
    # Registration
    $sql = "SELECT COUNT(*) as cntusr FROM workshop WHERE w_name='iot'";
    $result = mysqli_query($db,$sql) or die("ERROR : " . mysqli_error($db));
    $row = mysqli_fetch_array($result);
    $iot_reg = $row['cntusr'];
    # Attendance
    $sql = "SELECT COUNT(*) as cntusr FROM workshop WHERE attendance=1 AND w_name='iot'";
    $result = mysqli_query($db,$sql) or die("ERROR : " . mysqli_error($db));
    $row = mysqli_fetch_array($result);
    $iot_attend = $row['cntusr'];
    # %
    $iot_percent= ($iot_attend/$iot_reg)*100;
    
    # Workshop : Machine Learning
    # Registration
    $sql = "SELECT COUNT(*) as cntusr FROM workshop WHERE w_name='ml'";
    $result = mysqli_query($db,$sql) or die("ERROR : " . mysqli_error($db));
    $row = mysqli_fetch_array($result);
    $ml_reg = $row['cntusr'];
    # Attendance
    $sql = "SELECT COUNT(*) as cntusr FROM workshop WHERE attendance=1 AND w_name='ml'";
    $result = mysqli_query($db,$sql) or die("ERROR : " . mysqli_error($db));
    $row = mysqli_fetch_array($result);
    $ml_attend = $row['cntusr'];
    # %
    $ml_percent= ($ml_attend/$ml_reg)*100;
    
    # Workshop : Robotics
    # Registration
    $sql = "SELECT COUNT(*) as cntusr FROM workshop WHERE w_name='rbt'";
    $result = mysqli_query($db,$sql) or die("ERROR : " . mysqli_error($db));
    $row = mysqli_fetch_array($result);
    $rbt_reg = $row['cntusr'];
    # Attendance
    $sql = "SELECT COUNT(*) as cntusr FROM workshop WHERE attendance=1 AND w_name='rbt'";
    $result = mysqli_query($db,$sql) or die("ERROR : " . mysqli_error($db));
    $row = mysqli_fetch_array($result);
    $rbt_attend = $row['cntusr'];
    # %
    $rbt_percent= ($rbt_attend/$rbt_reg)*100;
    
    # Workshop : Project Management
    # Registration
    $sql = "SELECT COUNT(*) as cntusr FROM workshop WHERE w_name='pm'";
    $result = mysqli_query($db,$sql) or die("ERROR : " . mysqli_error($db));
    $row = mysqli_fetch_array($result);
    $pm_reg = $row['cntusr'];
    # Attendance
    $sql = "SELECT COUNT(*) as cntusr FROM workshop WHERE attendance=1 AND w_name='pm'";
    $result = mysqli_query($db,$sql) or die("ERROR : " . mysqli_error($db));
    $row = mysqli_fetch_array($result);
    $pm_attend = $row['cntusr'];
    # %
    $pm_percent= ($rbt_attend/$rbt_reg)*100;
    
    
    
    
    
    
    
   
?>

<!DOCTYPE html>
<html lang="en">
	<head>
        <title>MYSTRIX Statistics | <?php echo $login_session; ?></title>
		
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
			  <li><a href="./registration.php">Registration</a></li>
			  <li class="active"><a href="">Statistics</a></li>
			  <li><a href="./certificate.php">Certificates</a></li>
			  <li><a href="#"></a></li>
			  
			</ul>
			<ul class="nav navbar-nav navbar-right">
			  <li><a href="#user"><span class="glyphicon glyphicon-user"></span><b> Welcome <?php echo $login_session; ?></b></a></li>
			  <li><a href="./logout.php"><span class="glyphicon glyphicon-log-out"></span>Log Out</a></li>
			</ul>
		  </div>
		</nav>
		<nav class="navbar navbar-inverse">
		  <div class="container-fluid">
			<div class="navbar-header">
			  <img class="navbar-brand" src="./assets/images/mystrix_fill_white.svg"><img>
			  <a class="navbar-brand" onclick="window.location.reload();" href=""><b>MYSTRIX</b></a>
			</div>
			<ul class="nav navbar-nav">
			  <li><a href="./home.php">Home</a></li>
			  <li><a href="./registration.php">Registration</a></li>
			  <li class="active"><a href="">Statistics</a></li>
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
		  <h2><b>MYSTRIX</b> Statistics</h2>
		  </br>
            <div>
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
				<tr class="active">
					<td>Attendance</td>
					<td><?php echo $atnd_count ?></td>
				</tr>
				<tr class="info">
					<td>% of Participation</td>
					<td><?php echo $percent ?></td>
				</tr>
			</tbody>
		    </table>
		    </div>
		    
		    </br>
		    <div>
		      <h3>Workshops</h3>  
		        
              <table class="table">
                <thead>
                  <tr>
                    <th>Workshop Name</th>
                    <th>Registration</th>
                    <th>Attendance</th>
                    <th>Participation %</th>
                    <th> </th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>3D Printing</td>
                    <td><?php echo $d3_reg ?></td>
                    <td><?php echo $d3_attend ?></td>
                    <td><?php echo $d3_percent ?></td>
                    <td><a href="./workshop_details.php?w=3dp">
                        <button type="button" class="btn btn-link">Details</button></a>
                    </td>
                  </tr>
                  <tr>
                    <td>IoT</td>
                    <td><?php echo $iot_reg ?></td>
                    <td><?php echo $iot_attend ?></td>
                    <td><?php echo $iot_percent ?></td>
                    <td><a href="./workshop_details.php?w=iot">
                        <button type="button" class="btn btn-link">Details</button></a>
                    </td>
                  </tr> 
                  <tr>
                    <td>Machine Learning</td>
                    <td><?php echo $ml_reg ?></td>
                    <td><?php echo $ml_attend ?></td>
                    <td><?php echo $ml_percent ?></td>
                    <td><a href="./workshop_details.php?w=ml">
                        <button type="button" class="btn btn-link">Details</button></a>
                    </td>
                  </tr>      
                  <tr>
                    <td>Robotics</td>
                    <td><?php echo $rbt_reg ?></td>
                    <td><?php echo $rbt_attend ?></td>
                    <td><?php echo $rbt_percent ?></td>
                    <td><a href="./workshop_details.php?w=rbt">
                        <button type="button" class="btn btn-link">Details</button></a>
                    </td>
                  </tr> 
                  <tr>
                    <td>Project Management</td>
                    <td><?php echo $pm_reg ?></td>
                    <td><?php echo $pm_attend ?></td>
                    <td><?php echo $pm_percent ?></td>
                    <td><a href="./workshop_details.php?w=pm">
                        <button type="button" class="btn btn-link">Details</button></a>
                    </td>
                  </tr> 
                </tbody>
              </table>
			    <nav class="navbar navbar-inverse">
		  <div class="container-fluid">
			<div class="navbar-header">
			  <img class="navbar-brand" src="./assets/images/mystrix_fill_white.svg"><img>
			  <a class="navbar-brand" onclick="window.location.reload();" href=""><b>MYSTRIX</b></a>
			</div>
			<ul class="nav navbar-nav">
			  <li><a href="./home.php">Home</a></li>
			  <li><a href="./registration.php">Registration</a></li>
			  <li class="active"><a href="">Statistics</a></li>
			  <li><a href="./certificate.php">Certificates</a></li>
			  <li><a href="#"></a></li>
			  
			</ul>
			  <ul class="nav navbar-nav">
			  <li><a href="./home.php">Home</a></li>
			  <li><a href="./registration.php">Registration</a></li>
			  <li class="active"><a href="">Statistics</a></li>
			  <li><a href="./certificate.php">Certificates</a></li>
			  <li><a href="#"></a></li>
			  
			</ul>
			  <ul class="nav navbar-nav">
			  <li><a href="./home.php">Home</a></li>
			  <li><a href="./registration.php">Registration</a></li>
			  <li class="active"><a href="">Statistics</a></li>
			  <li><a href="./certificate.php">Certificates</a></li>
			  <li><a href="#"></a></li>
			  
			</ul>
			  <ul class="nav navbar-nav">
			  <li><a href="./home.php">Home</a></li>
			  <li><a href="./registration.php">Registration</a></li>
			  <li class="active"><a href="">Statistics</a></li>
			  <li><a href="./certificate.php">Certificates</a></li>
			  <li><a href="#"></a></li>
			  
			</ul>
			  <ul class="nav navbar-nav">
			  <li><a href="./home.php">Home</a></li>
			  <li><a href="./registration.php">Registration</a></li>
			  <li class="active"><a href="">Statistics</a></li>
			  <li><a href="./certificate.php">Certificates</a></li>
			  <li><a href="#"></a></li>
			  
			</ul>
			<ul class="nav navbar-nav navbar-right">
			  <li><a href="#user"><span class="glyphicon glyphicon-user"></span><b> Welcome <?php echo $login_session; ?></b></a></li>
			  <li><a href="./logout.php"><span class="glyphicon glyphicon-log-out"></span>Log Out</a></li>
			</ul>
		  </div>
		</nav>
		    </div>
		<nav class="navbar navbar-inverse">
		  <div class="container-fluid">
			<div class="navbar-header">
			  <img class="navbar-brand" src="./assets/images/mystrix_fill_white.svg"><img>
			  <a class="navbar-brand" onclick="window.location.reload();" href=""><b>MYSTRIX</b></a>
			</div>
			<ul class="nav navbar-nav">
			  <li><a href="./home.php">Home</a></li>
			  <li><a href="./registration.php">Registration</a></li>
			  <li class="active"><a href="">Statistics</a></li>
			  <li><a href="./certificate.php">Certificates</a></li>
			  <li><a href="#"></a></li>
			  
			</ul>
			<ul class="nav navbar-nav navbar-right">
			  <li><a href="#user"><span class="glyphicon glyphicon-user"></span><b> Welcome <?php echo $login_session; ?></b></a></li>
			  <li><a href="./logout.php"><span class="glyphicon glyphicon-log-out"></span>Log Out</a></li>
			</ul>
		  </div>
		</nav>
		</div>
	</body>
</html>
