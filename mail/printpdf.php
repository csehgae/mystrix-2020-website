<?php

include('session.php');
    use setasign\Fpdi\Fpdi; # PDF Library
   
    $reg_id_check = $_SESSION['reg_id'];
   
    $ses_sql = mysqli_query($db,"SELECT reg_id, full_name, mail_id FROM registration WHERE reg_id = '".$reg_id_check."'") or die("ERROR : " . mysqli_error($db));
   
    $row = mysqli_fetch_array($ses_sql);
    
    $uregid = $row['reg_id'];
    $uname = $row['full_name'];
    $umailid = $row['mail_id'];
   
 
        # PDF START
        
        require_once('../print/fpdf181/fpdf.php'); 
        require_once('../print/fpdi2/src/autoload.php'); 
        
        $pdf = new FPDI();
        $pdf->AddFont('bb','','bb.php');
        $pdf->AddFont('o','','o.php');
        $pdf->AddPage(); 
        $pdf->setSourceFile('../print/template.pdf'); 
        $tplIdx = $pdf->importPage(1); 
        $pdf->useTemplate($tplIdx); 
        
        $pdf->SetFont('bb', '', '20'); 
        $pdf->SetXY(73,175);
        $pdf->Write(20,$uname,'');
        
        $pdf->SetXY(73,185);
        $pdf->SetFont('o', '', '13.5');
        $pdf->Write(20,$uregid,'');
        
        $pdf->Image('https://chart.googleapis.com/chart?chs=500x500&cht=qr&chld=L|0&chl='.$uregid.'',73,204,45,0,'PNG');
        
        $pdf->Output('MYSTRIX2020 - '.$uregid.'.pdf', 'D');
        
        # PDF END

   
    if(!isset($_SESSION['reg_id'])){ 
        header("location:./not-found.html");
    }


?>  