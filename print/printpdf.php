<?php
include('config.php');
use setasign\Fpdi\Fpdi; # PDF Library



if($_SERVER["REQUEST_METHOD"] == "GET") {
	$uregid = mysqli_real_escape_string($db,htmlspecialchars($_GET['regid']));

	// Checking for registration
	$sql = "SELECT COUNT(*) as cntusr FROM registration_beta WHERE reg_id = '".$uregid."'";
	$result = mysqli_query($db,$sql) or die("ERROR : " . mysqli_error($db));
	$row = mysqli_fetch_array($result);
	$count = $row['cntusr'];

	// If result matched $umailid and $uname, $count>0
	if($count > 0) {
		$sql_data = mysqli_query($db,"SELECT reg_id, full_name FROM registration_beta WHERE reg_id = '".$uregid."'") or die("ERROR : " . mysqli_error($db));
		$row_data = mysqli_fetch_array($sql_data);
		//Parse data
		$uregid = $row_data['reg_id'];
		$uname = $row_data['full_name'];

        # PDF START
        
        require_once('fpdf181/fpdf.php'); 
        require_once('fpdi2/src/autoload.php'); 
        
        $pdf = new FPDI();
        $pdf->AddFont('bb','','bb.php');
        $pdf->AddFont('o','','o.php');
        $pdf->AddPage(); 
        $pdf->setSourceFile('template.pdf'); 
        $tplIdx = $pdf->importPage(1); 
        $pdf->useTemplate($tplIdx); 
        
        $pdf->SetFont('bb', '', '20'); 
        $pdf->SetXY(73,175);
        $pdf->Write(20,$uname,'');
        
        $pdf->SetXY(73,185);
        $pdf->SetFont('o', '', '13.5');
        $pdf->Write(20,$uregid,'');
        
        $pdf->Image('https://chart.googleapis.com/chart?chs=500x500&cht=qr&chld=L|0&chl='.$uregid.'',73,204,45,0,'PNG');
        
        $pdf->Output('ticket.pdf', 'D');
        
        # PDF END
         
	    }
 
	else {
		header('Location: ./error.html');
		}

}
 ?>