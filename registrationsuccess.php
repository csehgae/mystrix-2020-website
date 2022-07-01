
<?php
   include('session.php');
   
   $reg_id_check = $_SESSION['reg_id'];
   
   $ses_sql = mysqli_query($db,"SELECT reg_id, full_name, mail_id FROM registration WHERE reg_id = '".$reg_id_check."'") or die("ERROR : " . mysqli_error($db));
   
   $row = mysqli_fetch_array($ses_sql);
   
   $uregid = $row['reg_id'];
   $uname = $row['full_name'];
   $umailid = $row['mail_id'];
   
      // Send registration success as mail
    
    $to = $umailid;
    $subject = "Welcome to MYSTRIX 2020 || Registration Successful";
    
    $message = '<html>
                <head><title>Welcome to MYSTRIX 2020</title>
                <head>
                <body>
                <h1><a href="https://www.mystrix.in" target="_blank"><img alt="mystrix.in" src="https://www.mystrix.in/mail/mystrix_mail_img.png" style="outline:none;text-decoration:none;width:auto;max-width:100%;clear:both;display:block;text-align:center;margin:0 auto;border:none;height:90px;" align="none" class="mystrix"/></a>
                </h1>
                <p> You have successfully registered for participating in Mystrix 2020 scheduled for 03rd, 04th, 05th February
                 2020. <br/> Your Registeration ID is '."$uregid".'. Click the button for your Admit Pass.
                </p>
                <!--Button-->
                <center>
                 <table align="center" cellspacing="0" cellpadding="0" width="100%">
                   <tr>
                     <td align="center" style="padding: 10px;">
                       <table border="0" class="mobile-button" cellspacing="0" cellpadding="0">
                         <tr>
                           <td align="center" bgcolor="#000000" style="background-color: #000000; margin: auto; max-width: 600px; -webkit-border-radius: 0px; -moz-border-radius: 0px; border-radius: 0px; padding: 15px 20px; " width="100%">
                           <!--[if mso]>&nbsp;<![endif]-->
                               <a href="https://www.mystrix.in/mail/ticket.php?regid='."$uregid".'" target="_blank" style="16px; font-family: Verdana, Geneva, sans-serif; color: #ffffff; font-weight:normal; text-align:center; background-color: #000000; text-decoration: none; border: none; -webkit-border-radius: 0px; -moz-border-radius: 0px; border-radius: 0px; display: inline-block;">
                                   <span style="font-size: 16px; font-family: Verdana, Geneva, sans-serif; color: #ffffff; font-weight:normal; line-height:1.5em; text-align:center;">Get Admit Pass</span>
                             </a>
                           <!--[if mso]>&nbsp;<![endif]-->
                           </td>
                         </tr>
                       </table>
                     </td>
                   </tr>
                 </table>
                </center>
                <p> Or, fllow this link: <a href="https://www.mystrix.in/mail/ticket.php?regid='."$uregid".'" target="_blank">
                https://www.mystrix.in/mail/ticket.php?regid='."$uregid".'
                </a>
                </p>
                
                
                </body>
                </html>
    
    ';
    
    // Always set content-type when sending HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    
    // More headers
    $headers .= 'From: <donotreply@mystrix.in>' . "\r\n";
    
    mail($to,$subject,$message,$headers);
        
    
   
   if(!isset($_SESSION['reg_id'])){ 
      header("location:close.php");
   }
   
   //session_destroy(); // Don't uncomment : will cause oops.php when reload - SESSION DESTROYED
   // Don't HOST HAS BUGS SESSION_START : Under Development Purposes.. 
   
?>



<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" http-equiv="encoding" lang='en'>
        <!--<meta content="public" http-equiv="Cache-control">-->
        <meta http-equiv="Content-Type" content="text/html" charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="description" content="MYSTRIX | Holy Grace Academy, Mala">
        <meta name="keywords" content="MYSTRIX, mystrix.in, Holy Grace Academy, Mala, TECHFEST, 2020, Holy Grace Academy of Engineering, startup, iedc, kerala, KTU, B.Tech, Engineering, College, Technology, Polytechnic, School, Robotics, Workshop, Registration, HTML, CSS, php, innovation, CSE, Mech, Civil, ECE, EEE, Games, Science, students, Exhibition, NSS, Information Technology, website, University, Programming, Competitions, Activity Points, best techfest of 2020, techfest in kerala, thrissur, kochi, hostinger, India, PDF, tickets, facebook, instagram/mystrix, ketcon, Machine Learning, Techtalk, hgae, hgw, MBA, CBSE, *">
        <meta name="theme-color" content="#000">
        <meta name="application-name" content="mystrix.in">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
        <meta name="apple-mobile-web-app-title" content="MYSTRIX">
        <meta name="msapplication-TileColor" content="#1E88E5">
        <meta name="msapplication-TileImage" content="./images/icons/mstile-150x150.png">
        <meta name="author"content="MYSTRIX">
        
        <link href="./images/icons/apple-touch-icon.png" rel="apple-touch-icon">
        <link href="./images/icons/android-chrome-192x192.png" rel="icon" sizes="192x192" type="image/png">
        <link href="./images/icons/favicon-32x32.png" rel="icon" sizes="32x32" type="image/png">
        <link href="./images/icons/favicon-16x16.png" rel="icon" sizes="16x16" type="image/png">
        <link href="./images/icons/favicon.png" rel="icon" type="image/png">
        <link href="./images/icons/favicon.ico" rel="icon" type="image/x-icon">
        <link href="./images/icons/favicon.png" rel="shortcut icon" type="image/png">
        <link href="./images/icons/favicon.ico" rel="shortcut icon" type="image/x-icon">
        <link href="./manifest.json" rel="manifest">
        
        <title>MYSTRIX | Registration Successful</title>
        
        <!--Uncomment this for Debug mode (DevTip)-->
                    <!--Dev Tools
                    <script type="text/javascript" src="debug.addIndicators.js"></script>
                    <style>
                         {
                            box-shadow: 0 0 0px 3px green,0 0 0px 9px rgba(255,255,255,.13);
                        }
                        body{background-color: #000 !important;}
                        canvas{display: none;}
                    </style>-->
        <!--Uncomment this for Debug mode (DevTip)-->
        <!--The fonts (DevTip)-->
        <link rel="stylesheet" href="./style.css">
        
   <style>
            body {
                margin: 0;
                padding: 0;
                font-family: extralight;
                height: auto;background:linear-gradient(#f90000a6 0%, transparent 41%);
                overflow-x: hidden;width: 100vw;
                font-family: o;
    display: flex;
    flex-direction: column;    align-items: center;
            }
.main{}
            .ticket {background-image:url('./images/reg_tick.svg');
             height: 510px;
    width: 342px;}

.ticket p{font-size: 12px;font-weight: bolder;font-family: extralight;}

.qr{ height: 135px;
    width: 135px;
    position: relative;
    top: 35%;
    left: 22%;mix-blend-mode: multiply;
    margin: 12px 0 0 0px;
    display: block;}
.gethim{    font-size: 17px;
    position: relative;font-family: bb;
    top: 36%;
    margin: 10px 0px;
    left: 22%;}
.gether{    font-size: 10px;
    position: relative;font-weight: bolder;font-family: extralight;
    margin: 0px 0px;
    top: 35%;
    left: 23%;}
    .ticket p{    font-size: 10px;
    position: relative;
    top: 36%;
    left: 22%;
    width: 60%;}
    .ti{    margin: 20px 24px 0 22px;
    font-size: 18px;}
    .ti span{font-size: 13px;display: block;margin-top: 5px;}
    a{text-decoration: none;font-family: bb;}
    .kbutton{transform: none;margin:10px 0px;    background: #fc0000;max-width:200px;
    color: #fff;}
    .kbutton:hover {
                box-shadow: 0 0 0 3px #000;
                background-color: transparent;
                color: #000;
            }
            
   </style>
   </head>

   
   <body>
<div class='ti'> Registration was successfull. <br>
<span>Screenshot or Download the PDF of your ticket.</span></div>
<div class='main'>
      <div class='ticket'>
            <h2 class='gethim'><?php echo $uname; ?></h2> 
      	  <h2 class='gether'><?php echo $uregid; ?></h2>
      	  <img class='qr' src="https://chart.googleapis.com/chart?chs=500x500&cht=qr&chl=<?php echo $uregid ?>" alt="QR_code">
      	  <p>Please present this QR Code at registration of the event. Screenshot or save a PDF of this ticket.</p>
	  </div>
   </div>
	  <a href = "./printpdf.php"><div class='kbutton'> Download PDF</div></a>


	  <a href = "close.php"><div class='kbutton'>Close</div></a>
   </body>
 </html>