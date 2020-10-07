<?php
    include('session.php');
    
    global $error;
    $error = "  ";
    use setasign\Fpdi\Fpdi;

   if($_SERVER["REQUEST_METHOD"] == "POST") {
	   
      // Data send from attendance form
      $name = mysqli_real_escape_string($db,$_POST['certname']);           // Full Name
      $role = mysqli_real_escape_string($db,$_POST['role']);
      
	    # PDF START
	    
		require_once('../print/fpdf181/fpdf.php'); 
        require_once('../print/fpdi2/src/autoload.php');
        
		$pdf = new FPDI();
		$pdf->AddFont('abd','','arialbd.php');
		$pdf->AddPage('L');
		if($role == "coordinator")
		{ $pdf->setSourceFile('./certificate/template_coordinator.pdf'); }
		else if($role == "volunteer")
		{ $pdf->setSourceFile('./certificate/template_volunteer.pdf'); }
		else
		{ $error = "Role not selected"; 
		  $pdf->setSourceFile('./certificate/template_error.pdf');
		}
		$tplIdx = $pdf->importPage(1); 
		$pdf->useTemplate($tplIdx); 

		$pdf->SetFont('abd', '', '20'); 
		$pdf->SetXY(155,90);
		$pdf->Write(20,$name,'');
		
		$pdf->Output(''.$name.'.pdf', 'D');

        # PDF END
        
        # LOG START
        
        $myfile = fopen("./certificate/certificate.log", "a") or die("Unable to open file!");
        $txt = "".$name."\t:\t".$role."\t:\t".date("Y/m/d")."\n";
        fwrite($myfile, $txt);
        fclose($myfile);
        
        # LOG END
	  	  
	  
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
			  <li><a href="./registration.php">Registration</a></li>
			  <li><a href="./stats.php">Statistics</a></li>			  
			  <li class="active"><a href="">Certificates</a></li>
			  <li><a href="#"></a></li>
			  
			</ul>
			<ul class="nav navbar-nav navbar-right">
			  <li><a href="#user"><span class="glyphicon glyphicon-user"></span><b> Welcome <?php echo $login_session; ?></b></a></li>
			  <li><a href="./logout.php"><span class="glyphicon glyphicon-log-out"></span>Log Out</a></li>
			</ul>
		  </div>
		</nav>

		<div class="container">
		  <h2><b>MYSTRIX</b> Certificates</h2>
		  </br>

		<div>
	        <form action="#" method="post" id="certname-submit" accept-charset="UTF-8">
	            <div>Name :  <input id="certname" name="certname" type="text" size="18" required>
	            <br><br>Role<br>
	             &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	            <input type="radio" id="coordinator" name="role" value="coordinator">
                <label for="coordinator">Coordinator</label><br>
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="radio" id="volunteer" name="role" value="volunteer"checked="checked">
                <label for="volunteer">Volunteer</label><br>
                <br>
	            <button type="submit" value = "Submit" name="Submit">Submit</button>  	</div>
	            <br>
	            <?php echo $error ?> 
	        </form>
        </div>
        
        
        <div>
        <button onclick="window.open('./certificate/certificate.log')">Certificate Log</button>
        </div>
        
        </div>

	
	
	
	
	
	</body>
</html>