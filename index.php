
<?php

   include("config.php");
   session_start();
   
   global $error;
   $error = "  ";
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
       
      // Data send from registration form
      $uname = mysqli_real_escape_string($db,$_POST['name']);           // Full Name
      $ubranch = mysqli_real_escape_string($db,$_POST['branch']);       // Branch
      $uyear = mysqli_real_escape_string($db,$_POST['year']);           // Year
      $ucollege = mysqli_real_escape_string($db,$_POST['college']);     // College Name
      $umailid = mysqli_real_escape_string($db,$_POST['mailid']);       // Email ID
      $ucontactno = mysqli_real_escape_string($db,$_POST['contactno']);     // Phone Number
      
      // Checking for registration duplication
      $sql = "SELECT COUNT(*) as cntusr FROM registration WHERE mail_id = '".$umailid."' and full_name = '".$uname."'";
      $result = mysqli_query($db,$sql) or die("ERROR @sql-check : " . mysqli_error($db));
      $row = mysqli_fetch_array($result);
      $count = $row['cntusr'];
      // If result matched $umailid and $uname, $count>0
      if($count > 0) { 
         $error = "Already Registered!";
         $error_out= "<script> alert('".$error."'); </script>"; # Show alerrt if already registered.
      }
      else {
          
          // Register
        $sql = "INSERT INTO registration (`full_name`, `branch`, `year`, `college`, `mail_id`, `contact_no`) VALUES ('".$uname."', '".$ubranch."', '".$uyear."', '".$ucollege."', '".$umailid."', '".$ucontactno."')";
        $result = mysqli_query($db,$sql) or die("Error @sql-insert : " . mysqli_error($db));
        
         // Fetching Registration ID 
        $sql = "SELECT reg_id FROM registration WHERE full_name = '".$uname."' AND mail_id = '".$umailid."'";
        $result = mysqli_query($db,$sql) or die("ERROR @sql-reg_id : " . mysqli_error($db));
        $row = mysqli_fetch_array($result);      
        $uregid = $row['reg_id'];  
          // Check whether registration successfull or not  
        if($uregid) {
            $_SESSION['reg_id'] = $uregid;
            header("location: ./registrationsuccess.php");
        }else {
            $error = "Registration Failed ";
        }
      }
   }
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
        <meta name="author" content="MYSTRIX">
        
        <link href="./images/icons/apple-touch-icon.png" rel="apple-touch-icon">
        <link href="./images/icons/android-chrome-192x192.png" rel="icon" sizes="192x192" type="image/png">
        <link href="./images/icons/favicon-32x32.png" rel="icon" sizes="32x32" type="image/png">
        <link href="./images/icons/favicon-16x16.png" rel="icon" sizes="16x16" type="image/png">
        <link href="./images/icons/favicon.png" rel="icon" type="image/png">
        <link href="./images/icons/favicon.ico" rel="icon" type="image/x-icon">
        <link href="./images/icons/favicon.png" rel="shortcut icon" type="image/png">
        <link href="./images/icons/favicon.ico" rel="shortcut icon" type="image/x-icon">
        <link href="./manifest.json" rel="manifest">
        
        <title>MYSTRIX</title>
        
        <script src="TweenMax.min.js" type="text/javascript"></script>
        <script src="ScrollMagic.js" type="text/javascript"></script>
        <script src="animation.gsap.js" type="text/javascript"></script>
        <!--Uncomment this for Debug mode (DevTip)-->
        <!--Dev Tools
                    <script type="text/javascript" src="debug.addIndicators.js"></script>
                    <style>
                         {
                            box-shadow:0 0 0px 1px rgba(255,255,255,.913);
                        }
                        body{background-color:#000 !important;}
                        canvas{display:none;}
                    </style>-->
        <!--Uncomment this for Debug mode (DevTip)-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.lazyload/1.9.1/jquery.lazyload.min.js"></script>
        <script type="text/javascript">
            $(function() {
                $("img.lazy").lazyload({
                    effect: "fadeIn"
                });
            });
        </script>
        <script type="text/javascript">
            function ChangeUrl(title, url) {
                if (typeof (history.pushState) != "undefined") {
                    var obj = {
                        Title: title,
                        Url: url
                    };
                    history.pushState(obj, obj.Title, obj.Url);
                } else {
                    alert("Browser does not support HTML5.");
                }
            }
        </script>
        <script type="text/javascript">
            window.onpopstate = function(event) {
                if ($("#ticket_check").prop('checked')) {
                    $("#home_check").prop('checked', true);
                }
                ;if ($("#schedule_check").prop('checked')) {
                    $("#home_check").prop('checked', true);
                }
                ;

            }
            ;
        </script>
        <script>
            $(function() {
                var news = [];
                $.getJSON('json_do_no_alter/events.json', function(data) {
                    $.each(data.big, function(i, f) {
                        var tblRow = "<div class='banner_text'>" + f.heading + "</div>" + "<div class='banner_text_tip'>" + f.tooltip + "</div>" + "<div class='banner_pic' style=background-image:url('" + f.pic + "')></div>"
                        $(tblRow).appendTo(".banner_temp_mob");
                    });

                    $.each(data.small, function(i, f) {
                        var tblRow = "<div class='event_date'>" + f.date + "</div>" + "<div class='banner_news'>" + "<div class='tag'>" + f.heading + "</div>" + "<div class='discription'>" + f.tooltip + "</div>" + "</div>"
                        $(tblRow).appendTo(".dnoties");
                    });
                });
            });
        </script>
        <!--The fonts (DevTip)-->
        <link rel="stylesheet" href="./style.css">
        <style>
            body {
                margin: 0;
                padding: 0;
                font-family: extralight;
                height: auto;
                color: #fff;
                background-color: #000;
                overflow-x: hidden;
                width: 100vw;
            }

            .main {
                top: 0;
                background-color: transparent;
                position: fixed;
                height: 100vh;
                width: 100vw;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
            }

            .content {
                padding: 0px 20px;
                opacity: 1;
                position: relative;
                top: 100vh;
                transform: translatey(20vh);display: flex;
    flex-wrap: wrap;
    flex-direction: column;}

            .hello {
                font-size: 37px;
                letter-spacing: 7px;
            }

            .welcome {
                display: block;
                opacity: 1;
                transform: translateY(20vh);
                font-size: 17px;
                height: auto;text-align: left;
                letter-spacing: normal;
            }
            .register_home .big_logo{background-image: url(images/mystrix_outline_black_fill.svg);}
            .big_logo {
                background-image: url(images/mystrix_outline.svg);
                height: 42vh;
                width: 53vw;
                background-size: contain;
                background-repeat: no-repeat;
                background-position: 50%;
            }

            .font_bb {
                font-family: bb;
            }
            .mystr{
                filter:invert(1);}

            .logo_tip {
                text-align: center;
                font-size: 40px;
            }

            #aa:checked~.tho {
                background-color: red;
                font-size: 100px;
            }

            .nav {
                height: 10.1vh;
                width: 100vw;
                position: fixed;
                bottom: 0px;
                transition: all .3s;
                backdrop-filter: blur(12px);
                background-color: rgba(0,0,0,.47);
                transform: translateY(10vh);
                z-index: 30;
                display: flex;
                border-top: 1px solid rgba(255,255,255,.103);
                justify-content: space-around;
            }
.come #kbutton_events{box-shadow: 0 0 0 1px #fff;
    background-color: transparent;
    color: #fff;
    backdrop-filter: blur(12px);}
            .navdiv {
                display: block;
                width: 30%;
            }

            #trigger5 {
                top: 200vh;
                position: relative;
            }

            #canvas {
                position: fixed;
                z-index: -1;
                height: 110vh;
                top: 0;
            }

            .lazy {
                background-color: #fff;
                display: block;
            }

            .welcome_pic_holy {
                float: left;
                opacity: 1;
                margin-top: 7vh;
                transform: translatey(12vh) rotate(6deg);
                height: 150px;
                width: 70vw;
                background-color: #fd2828;
                background-image: url('./images/home_welcome_1.webp');
                background-size: cover;
                box-shadow: -2px -2px 17px 3px rgba(0, 0, 0, 0.74);
            }

            .welcome_pic_holyi {
                float: right;
                opacity: 1;
                box-shadow: -2px -2px 17px 3px rgba(0, 0, 0, 0.74);
                margin-top: 0vh;
                transform: translatey(12vh) rotate(-6deg);
                height: 150px;
                width: 70vw;
                background-color: #fd2828;
                background-image: url('./images/home_welcome_2.webp');
                background-size: cover;
            }

            .icon {
                height: 100%;
                width: 99%;
                border-right: 1px solid rgba(255,255,255,.073);
                opacity: .9;
            }

            .home {
                background: url(./images/home.svg);
                background-repeat: no-repeat;
                background-position: 50%;
                background-size: 30%;
            }

            .schedule {
                background: url(./images/calendar.svg);
                background-repeat: no-repeat;
                background-position: 50%;
                background-size: 30%;
            }

            .ticket {
                background: url(./images/ticket.svg);
                background-repeat: no-repeat;
                background-position: 50%;
                background-size: 30%;
                border-right: none;
            }

            .nav_input {
                display: none;
            }

            /*----------------------------------------------------------------*/
            .demon {
                height: 202vh;
            }

            /*---------------------------------------------------------------*/
            .tho {
                height: auto;
                font-size: 40px;
            }

            .nav_padding {
                height: 11vh;
            }

            .register_home {
                width: 100vw;
                background: #000;
                font-size: 100px;
                position: absolute;
                top: 0;
            }

            #home_check:checked~.register_home {
                z-index: -2;
            }

            #schedule_check:checked~.register_home {
                z-index: -2;
            }

            #ticket_check:checked~.register_home {
                z-index: 2;
            }

            #home_check:checked~.demon {
                z-index: 2;
            }

            #schedule_check:checked~.demon {
                z-index: -2;
            }

            #ticket_check:checked~.demon,#ticket_check:checked~.sketch, #home_check:checked~.sketch,#home_check:checked~.register_home {
                z-index: 2;
                display: none;
            }

            .register_home {
                min-height: 100vh;
                height: auto;
            }

            .second_block {
                margin-top: 105vh;
                height: 100vh;
                display: flex;
                flex-wrap: wrap;
                padding: 10px;
            }

            .second_head {
                font-size: 30px;
                font-size: 37px;
                letter-spacing: 7px;
                transform: translatey(30vh);
                margin-bottom: 80px;
            }

            .gal_item {
                background-size: cover;
                height: 15ch;
                width: 30vw;
                background-color: transparent;
                margin-top: 4px;
                transform: translatey(60vh) rotate(-12deg);
            }

            .gallery_block {
                display: flex;
                flex-wrap: wrap;
                justify-content: space-between;
                width:100%;
            }

            .gal_item_1 {
                background-image: url('./images/home_gal_1.webp');
                width: 66%;
            }

            .gal_item_2 {
                background-image: url('./images/home_gal_2.webp');    width: 32%;
            }

            .gal_item_3 {
                background-image: url('./images/home_gal_3.webp');
                    width: 46%;
            }

            .gal_item_4 {
                background-image: url('./images/home_gal_4.webp');
                width: 52%;
            }

            .gal_item_5 {
                background-image: url('./images/home_gal_5.webp');
            }

            .gal_item_6 {
                background-image: url('./images/home_gal_6.webp');width: 31%;
            }

            .gal_item_7 {
                background-image: url('./images/home_gal_7.webp');    width: 28%;
            }

            .third_block {
                padding: 0 3vw;
            }

            .footer {
                height: 41vh;
                padding: 6vh 7vw 11vh 8vw;
                background: linear-gradient(0deg, #006026 -31%, transparent 79%);
                display: flex;
                justify-content: space-evenly;
                align-items: center;
                flex-wrap: wrap;
                flex-direction: column;
            }

            .register_home .footer {
                background: linear-gradient(0deg, #006026 -39%, transparent 79%);
            }

            .footer_tip {
                font-size: 15px;
                text-align: center;
                font-family: o;
            }

            .footer .big_logo {
                height: 18vh;
                width: 24vw;
            }

            .second_block .kbutton {
                margin-top: 3vh;
            }

            .logo_tip .kbutton {
                margin-top: 3vh;
                transform: translatey(0vh);
                height: 35px;
                width: 40vw;
                line-height: 38px;
                font-size: 14px;
            }

            .third_tip {
                transform: translatey(30vh);
                margin-bottom: 3vh;
            }

            .third_block .second_head {
                margin-bottom: 10px;
            }

            .come_head {
                font-size: 37px;
                margin-top: 15vh;
                margin-bottom: 5vh;
                background-color: transparent;
                display: inline-block;
                padding: 0px 7px 0px 6px;text-shadow: 4px 5px 6px #000;
            }

            .come {
                padding: 10px;
                transform: translatey(28vh);
                background-color: transparent;
                background-position: center;
                background-image: url('./images/home_large.webp');
                background-size: cover;
            }

            .come .kbutton {
                transform: translatey(0vh);
                margin-bottom: 25vh;
            }
        </style>
        <!--REGSTERATION TAB CASCADE-->
        <style>
            .register_home {
                overflow: hidden;
            }

            .container {
                font-size: 20px;
                padding: 5vw;
                background: linear-gradient(180deg, #1e58fa -23%, transparent 35%);
            }

            .reg_head {
                font-size: 38px;
                margin-top: 6vh;
            }

            .reg_tip {
                margin: 3vh 0vw;
                font-size: 15px;
            }

            .fields {
                margin: 4vh 0vw;
            }

            .fields input {
                display: block;
                height: 42px;
                width: 90vw;
                display: block;
                margin-top: 4px;
                font-family: o;
                font-size: 20px;
                transition: all .2s;
                padding: 8px;
                box-sizing: border-box;
            }

            .fields input:focus {
                border: none;
                box-shadow: -3px 4px 0 0px #008dc9;
                outline: none;
            }

            #ticket_check:checked~.demon,#home_check:checked~.register_home {
                display: none;
                height: 0;
                overflow: hidden;
            }

            .register_home #big_logo_reg {
                height: 95px;
                width: 95px;
                filter: none;
                background-color: #51e5ff;
                border-radius: 100%;
                background-size: 54%;
                margin: 8vh 0 2vh 2vw;
                box-shadow: 0 0 0 10px #2c89ff2e, 0 0 0 35px #31d9851c, 0 0 0 235px #cd2a2a38;
            }

            .register_home .kbutton {
                height: 48px;
                background: #33ff84;
                line-height: 50px;
                font-size: 18px;
                text-align: center;
                color: #000;
                width: 60vw;
                transform: translatey(0vh);
                outline: none;
                border: none;
                font-family: bb;
                margin: 2vh 0vw;
            }

            .register_home .kbutton:hover {
                background-color: transparent;
                color: #fff;
            }

            .sketch {
                height: 300vh;
                width: 100vw;
                background-color: #000;
                position: absolute;
                z-index: -2;
                top: 0;
            }

            #schedule_check:checked~.sketch {
                z-index: 2;
            }

            #schedule_check:checked~.demon, #schedule_check:checked~.register_home {
                display: none;
            }
            .custom-select {
  position: relative;
}

.custom-select select {
  display: none; /*hide original SELECT element: */
}

.select-selected {
  background-color: #fff;
}

/* Style the arrow inside the select element: */
.select-selected:after {
  position: absolute;
  content: "";
  top: 14px;
  right: 10px;
  width: 0;
  height: 0;
  border: 6px solid transparent;
  border-color: #fff transparent transparent transparent;
}

/* Point the arrow upwards when the select box is open (active): */
.select-selected.select-arrow-active:after {
  border-color: transparent transparent #fff transparent;
  top: 7px;
}

/* style the items (options), including the selected item: */
.select-items div,.select-selected {
  color: #000;font-family: 'o';
  padding: 8px 16px;
  border: 1px solid transparent;
  border-color: transparent transparent rgba(0, 0, 0, 0.1) transparent;
  cursor: pointer;
}

/* Style items (options): */
.select-items {
  position: absolute;
  background-color: #fff;
  top: 100%;
  left: 0;
  right: 0;
  z-index: 99;
}

/* Hide the items when the select box is closed: */
.select-hide {
  display: none;
}

.select-items div:hover, .same-as-selected {
  background-color: rgba(0, 0, 0, 0.1);
}
.nav_desk{display: none;}
.wel_cen{display: flex;
    width: 30vw;
    justify-content: space-between;}
.mystr img {
    height: 40px;
}
.wel_cen{display: flex;    width: 270px;
    justify-content: space-between;}
    .logo_tip .kbutton{    width: 29vw;}
        </style>
        <!--Media queries-->
        <style>
            @media (min-width: 450px) {
                .head_list {display: flex;
    flex-wrap: wrap;
    flex-direction: row;justify-content: space-evenly;}
                .welcome_pic_holy {
                    width: 56vw;
                }

                .welcome_pic_holyi {
                    width: 56vw;
                }

                .second_block {
                    height: 123vh;
                }

                .gal_item {
                    height: 21ch;
                }

                .come {
                    margin-top: 50px;
                }

                .nav {
                    height: 8.7vh;
                }

                .home,.schedule,.ticket {
                    background-size: 22%;
                }
            }

            @media (min-width: 600px) {
                .head_list {display: flex;
    flex-wrap: wrap;
    flex-direction: row;justify-content: space-evenly;}
                .fields input {
                    width: 69vw;
                }
                .mystr img{height:43px;}
                .register_home .kbutton {
                    width: 19vw;
                }
                .logo_tip .kbutton {width: 11vw;}
                .home,.schedule,.ticket {
                    background-size: 19%;
                }
                .big_logo {height: 36vh;}
                .nav {
                    height: 9.7vh;
                }

                .welcome_pic_holy {
                    width: 46vw;
                    height: 200px;
                }

                .welcome_pic_holyi {
                    width: 46vw;
                    height: 200px;
                    margin-left: 20vw;
                }

                .second_block {    margin: 0px 8.4%;
                    margin-top: 105vh;
                    height: 153vh;    margin-bottom: 6vh;
                }

                .gal_item {
                    height: 28ch;
                }
                .content{    height: auto;
    width: 70vw;display: flex;
    flex-wrap: wrap;
    flex-direction: column;
    margin: 0% 12%;} 
    .wel_cen {    width: 340px;}
                .nav_desk{    
                    display: block;
                    position: fixed;
                    height: 50px;
                    background: rgba(0, 0, 0, 0.4);
                    width: 100vw;
                    top: 0;
                    backdrop-filter: blur(5px);
                    z-index: 12;display: flex;
    justify-content: center;border-bottom: 1px solid rgba(255,255,255,.04);
                    }
                    .nav_desk label{display: inline-block;
                        height: 100%;
                        display: flex;
                        width: 10%;
                        align-items: center;
                        flex-direction: column;
                        line-height: 47px;
                        }
                    .nav_anim {
                        display: none;}
#trigger1,#trigger2nd{position: absolute;top:0;}
            }

            @media (min-width: 800px) {

                .register_home .kbutton {
                    width: 25vw;
                }

                .fields input {
                    width: 49vw;
                }

                .home, .schedule, .ticket {
                    background-size: 11%;
                }

                .welcome_pic_holy {
                    width: 46vw;
                    height: 43vh;
                }

                .welcome_pic_holyi {
                    width: 46vw;
                    height: 43vh;
                }
                .come {
                    padding: 10px 20% 10px 12%;}
                .third_block {
                margin: 0px 11.4% 70px 11.4%;
                }
                .second_block {margin: 0px 11.4% 70px 11.4%;
                    margin-top: 105vh;
                    height: 120vh;
                    justify-content: center;
                    flex-flow: column;
                }

                .gallery_block {
                    justify-content: space-around;
                }

                
                .kbutton {
                    width: 31vw;
                }
            }

            .dash_title {
                font-size: 37px;
                letter-spacing: 7px;
            }

            .dnoties {
                padding: 1vh 6vw;
                margin-top: 7vh;
            }

            .banner_text {
                font-size: 20px;
                margin: 10px 0px 12px 0;
            }

            .banner_text_tip {
                padding: 0px 0px 12px 13px;
            }

            .tag {
                font-size: 20px;
                display: inline;
                /* background: linear-gradient(0deg, #ff020240, #ffffff); */
                /* border-radius: 3px; */
                color: #fcf9f9;
                /* box-shadow: 0px 0px 0px 2px #ffffff4a;*/
            }

            .banner_news {
                height: auto;
                width: 100%;
                padding: 7px 0px 7px 0px;
            }

            .sketch {
                box-shadow: inset 0px 108px 0 0px #ff06064a, inset 0px 236px 0 0px #a800004f, inset 0px 346px 0 0px #4e00004f;
                display: inline;
            }

            .event_date {
                font-size: 30px;
                box-shadow: 0px 8px 0 0px #ff06064a, 0px 26px 0 0px #a800004f, 0px 36px 0 0px #4e00004f;
                display: inline;
                animation: event 17s none 0s infinite alternate;
                background: linear-gradient(0deg, #930000e3, red);
            }

            @keyframes event {
                0% {
                    box-shadow: 0px 2px 0 0px #ff06064a, 0px 10px 0 0px #a800004f, 0px 15px 0 0px #4e00004f;
                }

                10% {
                    box-shadow: 0px 0px 0 0px #ff06064a, 0px 0px 0 0px #a800004f, 0px 0px 0 0px #4e00004f;
                }

                25% {
                    box-shadow: 0px 0px 0 0px #ff06064a, 0px 00px 0 0px #a800004f, 0px 0px 0 0px #4e00004f;
                }

                40% {
                    box-shadow: 0px 8px 0 0px #ff06064a, 0px 26px 0 0px #a800004f, 0px 36px 0 0px #4e00004f;
                }

                100% {
                    box-shadow: 0px 2px 0 0px #ff06064a, 0px 10px 0 0px #a800004f, 0px 15px 0 0px #4e00004f;
                }
            }
.workshops {
    margin-top: 6vh;
}
.work_head,.head_head{font-size: 37px;}
.work_tip {
    margin-top: 10px;
}
.workshop_table{    margin: 0% 9%;
    font-size: 20px;
    display: flex;
    flex-direction: column;
    flex-wrap: wrap-reverse;}
.workshop_table .kbutton {
    font-size: 13px;
    height: 38px;    display: inline-block;
    margin: 7px 0px 6px 5vw;
    width: 24vw;
    line-height: 40px;margin-right:2%;}
.work_list {
    display: flex;
    justify-content: space-between;
}
.heads{margin-top:6vh;margin:0 10%;}
.head_ball{height:30%;width:30%;background-color: red;}
 .head_ball {height: 100px;
    width: 100px;
    border-radius: 100px;
    margin-bottom: 11px;
    border: 2px solid #fff;
    background: #ffffff17;
    backdrop-filter: blur(4px);
    box-shadow: 1px 4px 18px 8px rgba(255, 255, 255, 0.16);
}
.head_list {display: flex;
    flex-wrap: wrap;
    flex-direction: row;justify-content: space-evenly;}
.head {padding: 14px 4% 5px 0px;
    display: flex;
    flex-direction: column;
    align-items: center;}
.head_tip{font-size: 13px;text-align:center;}
.head1 .head_ball{background: url('./images/head1.webp');
background-size:cover;}
.head2 .head_ball{background: url('./images/head2.webp');
background-size:cover;}
.head3 .head_ball{background: url('./images/head3.webp');
background-size:cover;}
.head4 .head_ball{background: url('./images/head4.webp');
background-size:cover;}
.head5 .head_ball{background: url('./images/head5.webp');
background-size:cover;}
.head6 .head_ball{background: url('./images/head6.webp');
background-size:cover;
    background-position: 62% 77%;}
.head7 .head_ball{background: url('./images/head7.webp');
background-size:cover;}
.work_head{transform: translatey(10vh);}
.work_tip{transform: translatey(20vh);}
.work_list{transform: translatey(10vh);    display: flex;
    align-items: center;overflow: hidden;}
.workk{transform: translatey(10vh) rotate(-20deg);}
.work_list{border-top:2px solid #fff;}
#worki5{border-bottom:2px solid #fff;}
.head_head{
    transform: translatey(10vh);
}
.head{
    transform: translatey(20vh);
}
.come{background-position: 0% 50%;}

.flogos{display: flex;    width: 100%;
    align-items: center;
    justify-content: space-evenly;}
.sponse{    width: auto;
    max-width: 32%;
    max-height: 90px;
    margin: 4% 1.7%;}       
.spons {
    display: flex;
    flex-flow: wrap;
    justify-content: space-between;
    align-items: center;
    margin: 2% 7%;
}
#spon_head {
    margin-top: 6vh;
}
.spon_more {max-width: 32%;
    max-height: 42px;
    margin: 4% 1.7%;
    background: #33ff84;
    line-height: 45px;
    font-size: 13px;
    text-align: center;
    color: #000;
    width: 62vw;
    border: none;
    text-decoration: none;}
.loader{    height: 100vh;
    width: 100vw;
    background: #000;
    animation: load1 1.6s none 0s 1 alternate;
    position: fixed;
    z-index: -36;
    opacity: 0;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;}
@keyframes load1{
    0%{top:0;left:0;z-index: 36;opacity: 1;}
    80%{opacity: 1;}
    99%{opacity: 0;}
    100%{top:0;left:0;z-index: 36;}
}
.load_line{background-color: #fff;height:1px;width: 100vw;    margin: 20px 0px;left: 0;transform-origin: left;animation: load_line .5s cubic-bezier(0.42, 0, 0.16, 0.99) 0s 1 alternate;}
.load_line:nth-child(3){animation: load_line 1.4s cubic-bezier(0.42, 0, 0.16, 0.99) 0s 1 alternate;}
@keyframes load_line{
    0%{transform: rotateY(90deg);}
    3%{transform: rotateY(86deg);}
    13%{transform: rotateY(86deg);}
    20%{transform: rotateY(80deg);}
    24%{transform: rotateY(80deg);}
    30%{transform: rotateY(60deg);}
    70%{transform: rotateY(60deg);}
    100%{transform: rotateY(0deg);}
}
.myst_l{filter: invert(1);height:40px;}
.load_mys{animation: opacityload .4s none 0s 1 alternate;}
@keyframes opacityload{
    0%{opacity: 0;transform: translateY(5px) scale(.9);}
    100%{opacity: 1;}
}
.main{animation: opacityload2 2.9s cubic-bezier(0.42, 0, 0.16, 0.99) 0s 1 alternate;}
#canvas{animation: opacityload2 2.4s cubic-bezier(0.42, 0, 0.16, 0.99) 0s 1 alternate;}
@keyframes opacityload2{
    0%{opacity: 0;transform: translateY(15px) scale(.9);}
   60%{opacity: 0;transform: translateY(15px) scale(.9);}
    100%{opacity: 1;}
}
.mystr{animation: opacityload3 1.9s none .6s 1 alternate;}
.wel_cen label:nth-child(1){animation: opacityload3 1.9s cubic-bezier(0.42, 0, 0.16, 0.99) .9s 1 alternate;}
.wel_cen label:nth-child(2){animation: opacityload3 1.9s cubic-bezier(0.42, 0, 0.16, 0.99) 1s 1 alternate;}
@keyframes opacityload3{
    0%{opacity: 0;}
    80%{opacity: 0;}
    100%{opacity: 1;}
}
</style>
    </head>
    <body>
        <!--The Navigation control. --Donot touch-- (DevTip) -->
        <input autocomplete="off" checked="true" class="nav_input" id="home_check" name="nav" type="radio"/>
        <input autocomplete="off" class="nav_input" id="schedule_check" name="nav" type="radio"/>
        <input autocomplete="off" class="nav_input" id="ticket_check" name="nav" type="radio"/>
        <div class="spacer s0" id="trigger1nav" style="color:black;"></div>
        <!--The tabs (DevTip) -->
        <div class='nav_desk' id='nav_desk'>
            <label for="home_check" onclick="ChangeUrl('Page1', '#home');">
                <div class="">Home</div>
            </label>
            <label for="schedule_check" onclick="ChangeUrl('Page1', '#events');">
                <div class="">Schedule</div>
            </label>
            <label for="ticket_check" onclick="ChangeUrl('Page1', '#register');">
                <div class="">Ticket</div>
            </label>
        </div>
        </div>
        <div class="nav" id="nav">
            <div class="homie navdiv">
                <!--Change '?' to any string for tab urls (DevTip)-->
                <label for="home_check" onclick="ChangeUrl('Page1', '#home');">
                    <div class="icon home"></div>
                </label>
            </div>
            <div class="events navdiv">
                <label for="schedule_check" onclick="ChangeUrl('Page1', '#events');">
                    <div class="icon schedule"></div>
                </label>
            </div>
            <div class="register navdiv">
                <label for="ticket_check" onclick="ChangeUrl('Page1', '#register');">
                    <div class="icon ticket"></div>
                </label>
            </div>
        </div>
        <!--The WebGL canvas (DevTip) -->
        <!-- partial:index.partial.html -->
        <div class="gradient" id="canvas"></div>
        <!-- partial -->
        <script>
            // init controller
            var controller = new ScrollMagic.Controller();
        </script>
        <section class="demon">
            <!--These styles are used for scroll transitions. These classes gets added
                as the element is within the viewport. (DevTip) -->
            <style type="text/css">

                .kish {
                    opacity: 1;
                    transform: translatey(-100vh);
                }

                .bish {
                    opacity: 1;
                    transform: translatey(10vh);
                }

                .welcome_note {
                    opacity: 1;
                    transform: translatey(2vh);
                }

                .big_logo_anim {
                    opacity: 0;
                    transform: translatey(-30vh);
                }

                .logo_tip_anim {
                    opacity: 0;
                    transform: translatey(-20vh) scale(.9);
                }

                .nav_anim {
                    transform: translateY(0vh);
                }
                .nav_desk_anim {
                    transform: translateY(0vh);
                }
                .welcome_pic_holy_anim {
                    opacity: 1;
                    transform: translatey(-0vh) translatex(3vh);
                }

                .welcome_pic_holy_animi {
                    opacity: 1;
                    transform: translatey(0vh) translatex(-3vh);
                }

                .gall {
                    opacity: 1;
                    transform: translatey(10vh);
                }

                .event_anim {
                    opacity: 1;
                    transform: translatey(0px);
                }

                .come_anim {background-position: 70% 50%;
                    opacity: 1;
                    transform: translatey(0vh);
                }

                .gall_item {
                    transform: translatey(0vh) rotate(0deg);
                }

                .kbutton_anim {
                    transform: translatey(0vh);
                }
                
            </style>
            <div class='loader font_bb'>
                <div class='load_line'></div>
            <div class='load_mys'><img class='myst_l' src='./images/txt.svg' alt='MYSTRIX'/>
                    </div><div class='load_line'></div></div>
            <div class="spacer s2"></div>
            <div class="spacer s0" id="trigger1" style="color:black;"></div>
            <div class="box2 main" id="animate1">
                <div class="big_logo" id="big_logo"></div>
                <div class="logo_tip" id="logo_tip">
                    <span class="font_bb mystr"><img src='./images/txt.svg' alt='MYSTRIX'/>
                    </span>
                    <center class='wel_cen'>
                        <label for="ticket_check" onclick="ChangeUrl('Page1', '?');">
                            <div class='kbutton font_bb'>Register</div>
                        </label>
                        <label for="schedule_check" onclick="ChangeUrl('Page1', '?');">
                                <div class='kbutton font_bb'>Events</div>
                            </label>
                    </center>
                </div>
            </div>
            <div id="trigger5"></div>
            <div class='cent'>
            <div class="hello content" id="welcome">
                <span class="font_bb">Welcome
                </span>
                <span class="welcome" id="welcome_note">
                    Welcome
Mystrix 2020 invites you to 3days tour into a plethora of technical abode displaying projects, arranging platform for potential entrepreneurs before Kerala startup mission, tie and other dignitaries. District level quiz competition being organised for school students. With technical advancements we are rooted to the social cause. Find an amalgam of brains with principles. Invitings students this Arcadia.  
                <div class="welcome_pic_holy" id="welcome_pic_holy"></div>
                    <div class="lazy welcome_pic_holyi" data-original="./images/home_welcome_2.webp" id="welcome_pic_holyi"></div>
                </span>
            </div></div>
</div>
<div class='second_block'>
    <div class='second_head font_bb' id='gallery'>Gallery</div>
    <div class='gallery_block'>
        <div class='gal_item gal_item_1' id='gallery_item'></div>
        <div class='gal_item gal_item_2' id='gallery_item1'></div>
        <div class='gal_item gal_item_3' id='gallery_item2'></div>
        <div class='gal_item gal_item_4' id='gallery_item3'></div>
        <div class='gal_item gal_item_5' id='gallery_item4'></div>
        <div class='gal_item gal_item_6' id='gallery_item5'></div>
        <div class='gal_item gal_item_7' id='gallery_item6'></div>
    </div>
    <div class='kbutton font_bb' id='kbutton'>See more</div>
</div>
<div class="spacer s0" id="trigger2nd" style="color:black;"></div>
<div class='third_block'>
    <div class='second_head font_bb' id='events'>Events</div>
    <div class='third_tip' id='events_tip'>Mystrix 2020 is a platform for technical and non technical events. 50+ events,20+ expo,tech talks, workshops and many more are being conducted.
    </div>
    <label for="schedule_check" onclick="ChangeUrl('Page1', '#events');"><div class='kbutton font_bb' id='kbutton_events'>See schedule</div></label>
    <div class='workshops'>
        <div class='work_head font_bb' id='workhead'>Workshops</div>
        <div class='work_tip' id='worktip'>Present yourself before new technologies and methodologies to enlighten your innser self.
            <div class='workshop_table'></br>
                <div class='work_list' id='worki1'><div class='work_item'>3D Printing</div> <a href='https://workshop.mystrix.in/workshop.php?w_name=3dp' class='kbutton font_bb workk' id='wkanim1'>Register</a></div>
                <div class='work_list' id='worki2'><div class='work_item'>IoT</div> <a href='https://workshop.mystrix.in/workshop.php?w_name=iot' class='kbutton font_bb workk' id='wkanim2'>Register</a></div>
                <div class='work_list' id='worki3'><div class='work_item'>Machine Learning</div> <a href='https://workshop.mystrix.in/workshop.php?w_name=ml' class='kbutton font_bb workk' id='wkanim3'>Register</a></div>
                <div class='work_list' id='worki4'><div class='work_item'>Robotics</div> <a href='https://workshop.mystrix.in/workshop.php?w_name=rbt' class='kbutton font_bb workk' id='wkanim4'>Register</a></div>
                <div class='work_list' id='worki5'><div class='work_item'>Project Management</div> <a href='https://workshop.mystrix.in/workshop.php?w_name=pm' class='kbutton font_bb workk' id='wkanim5'>Register</a></div></br>
            </div>
    </div>
    </div><div class='head_head font_bb' id='head_head'>Eminent Personalities</div>
    <div class='heads'> 

        <div class='head_list'>
            <div class='head head1' id='head1'><div class='head_ball'></div><div class='head_tip'>Prof. M.P. Poonia</div></div>
            <div class='head head2' id='head2'><div class='head_ball'></div><div class='head_tip'>Dr. <br>P V Venkitakrishnan</div></div>
            <div class='head head3' id='head3'><div class='head_ball'></div><div class='head_tip'>Dr Saji Gopinath</div></div>
            <div class='head head4' id='head4'><div class='head_ball'></div><div class='head_tip'>Nirmal Panicker </div></div>
            <div class='head head5' id='head5'><div class='head_ball'></div><div class='head_tip'>Prof. <br>M. Abdul Rahiman </div></div>
            <div class='head head6' id='head6'><div class='head_ball'></div><div class='head_tip'>Dr Rajasree</div></div>
            <div class='head head7' id='head7'><div class='head_ball'></div><div class='head_tip'>Shri A.V. Sathish</div></div>
        </div>
    </div>
</div>

<div class='come' id='come'>
    <div class='come_head'>Come, see the magic.</div>
    <label for="ticket_check" onclick="ChangeUrl('Page1', '?');">
        <div class='kbutton font_bb' id='kbutton_events'>Register Now</div>
    </label>
</div>
<div class='spon third_block'>
<div class='head_head font_bb' id='spon_head'>Our Sponsors</div>
<div class='spons'>
    <img src='./images/spon1.webp' class='sponse spon1'></img>
    <img src='./images/spon2.webp' class='sponse spon2'></img>
    <img src='./images/spon3.webp' class='sponse spon3'></img>
    <img src='./images/spon4.webp' class='sponse spon4'></img>
    <div class='spon_more font_bb'>See More</div>

</div>

    </div>
<div class='footer'>
    <div class='flogos'>
    <div class="big_logo"></div>
</div>
    <div class='footer_tip'>mystrix.in</div>
    <div class='footer_tip'>Made with love by our amazing students.</div>
</div>
</section>
<!--The registration tab.  (DevTip)-->
<div class="register_home">
    <div class="container">
        <form action="#" method="post" id="participant-reg-form" method="post" accept-charset="UTF-8">
            <div class="big_logo" id='big_logo_reg'></div>
            <div class="reg_head">Register
            </div>
            <div class="reg_tip">Register for the events by completing the registration form. Fields marked '*' are mandatory.
            </div>
            <!--The registertaion php fields (DevTip)-->
            <div class='fields'>
                Mail ID* <input autocomplete='email' autofocus id="mailid" name="mailid" type="email" size="18" x-autocomplete='email' required/>
            </div>
            <div class='fields'>
                Full Name* <input autocomplete='name' id="name" name="name" type="text" size="18" required>
            </div>
            <div class='fields'>
                Branch <input id="branch" name="branch" type="text" size="18">
            </div>
            <div class='fields'>
                Year <div class="custom-select" style="width:200px;">
  <select id='year' name="year" class='select_cus'>
    <option disabled selected > Select </option>
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5">5</option>
    <option value="7">Staff</option>
    <option value="8">Others</option>
  </select>
</div>
            </div>
            <div class='fields'>
                College* <input id="college" name="college" type="text" size="18" required>
            </div>
            <div class='fields'>
                Phone no.* <input autocomplete='tel' id="contactno" name="contactno" type="number" size="18" required>
            </div>
            
            <div>
                <button class='kbutton' type="submit" value="Submit" name="Submit" target="_blank">Submit</button>
            </div>
            <div id="form-login-err-msg" class="err-msg">
                <?php echo $error_out; ?>
            </div>
        </form>
    </div>
    <div class='footer'>
        <div class="big_logo"></div>
        <div class='footer_tip'>mystrix.in</div>
        <div class='footer_tip'>Made with love by our amazing students.</div>
    </div>
</div>
<div class='sketch'>
    <div class='dnoties'>
        <div class="dash_title font_bb">Events
                </div>
        <div class='main_banner'>
            <div class='banner_temp_mob'></div>
        </div>
    </div>
</div>
<!--
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
jp5zWZOFnrT47MpoN82MKmGfRNTAo1U=
=wY45
    -->
<div class="nav_padding"></div>
<!--The scrolling animations, for each elements (DevTip)-->
<script>
    // build tween for LOGO Main
    var scene = new ScrollMagic.Scene({
        triggerElement: "#trigger1nav",
        offset: 320
    })// trigger animation by adding a css class
    .setClassToggle("#nav_desk", "nav_desk_anim").addIndicators({
        name: "1 - add a class"
    })// add indicators (requires plugin)
    .addTo(controller);
    /*------------------------------------------*/

    // build tween for LOGO Main
    var scene = new ScrollMagic.Scene({
        triggerElement: "#trigger1nav",
        offset: 320
    })// trigger animation by adding a css class
    .setClassToggle("#nav", "nav_anim").addIndicators({
        name: "1 - add a class"
    })// add indicators (requires plugin)
    .addTo(controller);
    /*------------------------------------------*/

    // build tween for LOGO Main
    var tween = TweenMax.to("#animate1", 1, {
        className: "+=kish"
    });
    var scene = new ScrollMagic.Scene({
        triggerElement: "#trigger1",
        duration: 30,
        offset: 990
    }).setTween(tween).addIndicators({
        name: "tween css class"
    }).addTo(controller);
    /*------------------------------------------*/

    // build tween LOGO
    var tween = TweenMax.to("#big_logo", 1, {
        className: "+=big_logo_anim"
    });
    var scene = new ScrollMagic.Scene({
        triggerElement: "#trigger1",
        duration: 790,
        offset: 290
    }).setTween(tween).addIndicators({
        name: "tween cssdgftdfgjhbsd class"
    }).addTo(controller);
    /*------------------------------------------*/

    // build tween Logo_tip
    var tween = TweenMax.to("#logo_tip", 1, {
        className: "+=logo_tip_anim"
    });
    var scene = new ScrollMagic.Scene({
        triggerElement: "#trigger1",
        duration: 190,
        offset: 330
    }).setTween(tween).addIndicators({
        name: "tween css class"
    }).addTo(controller);
    /*------------------------------------------*/

    // build tween Welcome heading
    var tween = TweenMax.to("#welcome", 1, {
        className: "+=bish"
    });
    var scene = new ScrollMagic.Scene({
        triggerElement: "#trigger1",
        duration: 300,
        offset: 506
    }).setTween(tween).addIndicators({
        name: "tween css class"
    }).addTo(controller);
    /*------------------------------------------*/

    // build tween Welcome note
    var tween = TweenMax.to("#welcome_note", 1, {
        className: "+=welcome_note"
    });
    var scene = new ScrollMagic.Scene({
        triggerElement: "#trigger1",
        duration: 350,
        offset:690
    }).setTween(tween).addIndicators({
        name: "tween css class"
    }).addTo(controller);
    /*------------------------------------------*/
    // build tween Welcome pic 1
    var tween = TweenMax.to("#welcome_pic_holy", 1, {
        className: "+=welcome_pic_holy_anim"
    });
    var scene = new ScrollMagic.Scene({
        triggerElement: "#trigger1",
        duration: 150,
        offset: 756
    }).setTween(tween).addIndicators({
        name: "welcome pic css class"
    }).addTo(controller);
    /*------------------------------------------*/
    // build tween Welcome pic 2
    var tween = TweenMax.to("#welcome_pic_holyi", 1, {
        className: "+=welcome_pic_holy_animi"
    });
    var scene = new ScrollMagic.Scene({
        triggerElement: "#trigger1",
        duration: 350,
        offset: 870
    }).setTween(tween).addIndicators({
        name: "welcome pic css class"
    }).addTo(controller);
    /*------------------------------------------*/

    // build tween Gallery heading
    var tween = TweenMax.to("#gallery", 1, {
        className: "+=gall"
    });
    var scene = new ScrollMagic.Scene({
        triggerElement: "#trigger1",
        duration: 400,
        offset: 966
    }).setTween(tween).addIndicators({
        name: "tween css class"
    }).addTo(controller);
    /*------------------------------------------*/
    // build tween All The Gallery items(gallery_items,gall_item,gal_item)
    var tween = TweenMax.to("#gallery_item", 1, {
        className: "+=gall_item"
    });
    var scene = new ScrollMagic.Scene({
        triggerElement: "#trigger1",
        duration: 300,
        offset: 1100
    }).setTween(tween).addTo(controller);

    var tween = TweenMax.to("#gallery_item1", 1, {
        className: "+=gall_item"
    });
    var scene = new ScrollMagic.Scene({
        triggerElement: "#trigger1",
        duration: 300,
        offset: 1146
    }).setTween(tween).addTo(controller);
    var tween = TweenMax.to("#gallery_item2", 1, {
        className: "+=gall_item"
    });
    var scene = new ScrollMagic.Scene({
        triggerElement: "#trigger1",
        duration: 300,
        offset: 1196
    }).setTween(tween).addTo(controller);
    var tween = TweenMax.to("#gallery_item3", 1, {
        className: "+=gall_item"
    });
    var scene = new ScrollMagic.Scene({
        triggerElement: "#trigger1",
        duration: 300,
        offset: 1216
    }).setTween(tween).addTo(controller);
    var tween = TweenMax.to("#gallery_item4", 1, {
        className: "+=gall_item"
    });
    var scene = new ScrollMagic.Scene({
        triggerElement: "#trigger1",
        duration: 300,
        offset: 1296
    }).setTween(tween).addTo(controller);
    var tween = TweenMax.to("#gallery_item5", 1, {
        className: "+=gall_item"
    });
    var scene = new ScrollMagic.Scene({
        triggerElement: "#trigger1",
        duration: 300,
        offset: 1346
    }).setTween(tween).addTo(controller);
    var tween = TweenMax.to("#gallery_item6", 1, {
        className: "+=gall_item"
    });
    var scene = new ScrollMagic.Scene({
        triggerElement: "#trigger1",
        duration: 300,
        offset: 1396
    }).setTween(tween).addTo(controller);
    /*------------------------------------------*/
    var tween = TweenMax.to("#kbutton", 1, {
        className: "+=kbutton_anim"
    });
    var scene = new ScrollMagic.Scene({
        triggerElement: "#trigger1",
        duration: 500,
        offset: 1396
    }).setTween(tween).addTo(controller);
    /*------------------------------------------*/
    // build tween Event heading
    var tween = TweenMax.to("#events", 1, {
        className: "+=event_anim"
    });
    var scene = new ScrollMagic.Scene({
        triggerElement: "#trigger1",
        duration: 400,
        offset: 1566
    }).setTween(tween).addIndicators({
        name: "tween css class "
    }).addTo(controller);
    var tween = TweenMax.to("#events_tip", 1, {
        className: "+=event_anim"
    });
    var scene = new ScrollMagic.Scene({
        triggerElement: "#trigger1",
        duration: 240,
        offset: 1666
    }).setTween(tween).addIndicators({
        name: "tween css class "
    }).addTo(controller);
    /*------------------------------------------*/
    var tween = TweenMax.to("#kbutton_events", 1, {
        className: "+=kbutton_anim"
    });
    var scene = new ScrollMagic.Scene({
        triggerElement: "#trigger1",
        duration: 300,
        offset: 1776
    }).setTween(tween).addIndicators({
        name: "tween css class "
    }).addTo(controller);
    /*------------------------------------------*/
        /*------------------------------------------*/
    //Work heading
    var tween = TweenMax.to("#workhead", 1, {
        className: "+=event_anim"
    });
    var scene = new ScrollMagic.Scene({
        triggerElement: "#trigger2nd",
        duration: 200,
        offset: 76
    }).setTween(tween).addIndicators({
        name: "tween css class "
    }).addTo(controller);
    /*------------------------------------------*/
            /*------------------------------------------*/
    //Work tip
    var tween = TweenMax.to("#worktip", 1, {
        className: "+=event_anim"
    });
    var scene = new ScrollMagic.Scene({
        triggerElement: "#trigger2nd",
        duration: 400,
        offset: 176
    }).setTween(tween).addIndicators({
        name: "tween css class "
    }).addTo(controller);
    /*------------------------------------------*/
        //Work tip1
    var tween = TweenMax.to("#worki1", 1, {
        className: "+=event_anim"
    });
    var scene = new ScrollMagic.Scene({
        triggerElement: "#trigger2nd",
        duration: 200,
        offset: 206
    }).setTween(tween).addIndicators({
        name: "tween css class "
    }).addTo(controller);
//Work tip2
    var tween = TweenMax.to("#worki2", 1, {
        className: "+=event_anim"
    });
    var scene = new ScrollMagic.Scene({
        triggerElement: "#trigger2nd",
        duration: 200,
        offset: 336
    }).setTween(tween).addIndicators({
        name: "tween css class "
    }).addTo(controller);
    //Work tip3
    var tween = TweenMax.to("#worki3", 1, {
        className: "+=event_anim"
    });
    var scene = new ScrollMagic.Scene({
        triggerElement: "#trigger2nd",
        duration: 200,
        offset: 396
    }).setTween(tween).addIndicators({
        name: "tween css class "
    }).addTo(controller);
    //Work tip4
    var tween = TweenMax.to("#worki4", 1, {
        className: "+=event_anim"
    });
    var scene = new ScrollMagic.Scene({
        triggerElement: "#trigger2nd",
        duration: 200,
        offset: 466
    }).setTween(tween).addIndicators({
        name: "tween css class "
    }).addTo(controller);
    //Work tip5
    var tween = TweenMax.to("#worki5", 1, {
        className: "+=event_anim"
    });
    var scene = new ScrollMagic.Scene({
        triggerElement: "#trigger2nd",
        duration: 300,
        offset: 496
    }).setTween(tween).addIndicators({
        name: "tween css class "
    }).addTo(controller);
    /*------------------------------------------*/
    //Work kbutton tip1
    var tween = TweenMax.to("#wkanim1", 1, {
        className: "+=event_anim"
    });
    var scene = new ScrollMagic.Scene({
        triggerElement: "#trigger2nd",
        duration: 200,
        offset:296
    }).setTween(tween).addIndicators({
        name: "tween css class "
    }).addTo(controller);
//Work tip2 kbutton
    var tween = TweenMax.to("#wkanim2", 1, {
        className: "+=event_anim"
    });
    var scene = new ScrollMagic.Scene({
        triggerElement: "#trigger2nd",
        duration: 300,
        offset: 286
    }).setTween(tween).addIndicators({
        name: "tween css class "
    }).addTo(controller);
    //Work tip3 kbutton
    var tween = TweenMax.to("#wkanim3", 1, {
        className: "+=event_anim"
    });
    var scene = new ScrollMagic.Scene({
        triggerElement: "#trigger2nd",
        duration: 300,
        offset: 320
    }).setTween(tween).addIndicators({
        name: "tween css class "
    }).addTo(controller);
    //Work tip4 kbutton
    var tween = TweenMax.to("#wkanim4", 1, {
        className: "+=event_anim"
    });
    var scene = new ScrollMagic.Scene({
        triggerElement: "#trigger2nd",
        duration: 300,
        offset: 356
    }).setTween(tween).addIndicators({
        name: "tween css class "
    }).addTo(controller);
    //Work tip5 kbutton
    var tween = TweenMax.to("#wkanim5", 1, {
        className: "+=event_anim"
    });
    var scene = new ScrollMagic.Scene({
        triggerElement: "#trigger2nd",
        duration: 300,
        offset: 366
    }).setTween(tween).addIndicators({
        name: "tween css class "
    }).addTo(controller);
    /*------------------------------------------*/

    // build tween come
    var tween = TweenMax.to("#come", 1, {
        className: "+=come_anim"
    });
    var scene = new ScrollMagic.Scene({
        triggerElement: "#trigger2nd",
        duration: 1000,
        offset: 1206
    }).setTween(tween).addIndicators({
        name: "tween css class yoyooyoyoyooyoyoyoyo"
    }).addTo(controller);
    /*------------------------------------------*/
        // build tween Person heading
    var tween = TweenMax.to("#head_head", 1, {
        className: "+=come_anim"
    });
    var scene = new ScrollMagic.Scene({
        triggerElement: "#trigger2nd",
        duration: 400,
        offset: 606
    }).setTween(tween).addIndicators({
        name: "tween css class yoyooyoyoyooyoyoyoyo"
    }).addTo(controller);
    /*------------------------------------------*/
     // build tween Person heading
    var tween = TweenMax.to("#spon_head", 1, {
        className: "+=come_anim"
    });
    var scene = new ScrollMagic.Scene({
        triggerElement: "#trigger2nd",
        duration: 400,
        offset: 1660
    }).setTween(tween).addIndicators({
        name: "tween css class yoyooyoyoyooyoyoyoyo"
    }).addTo(controller);
        /*------------------------------------------*/
    // head 1
    var tween = TweenMax.to("#head1", 1, {
        className: "+=event_anim"
    });
    var scene = new ScrollMagic.Scene({
        triggerElement: "#trigger2nd",
        duration: 200,
        offset:696
    }).setTween(tween).addIndicators({
        name: "tween css class "
    }).addTo(controller);
//head2
    var tween = TweenMax.to("#head2", 1, {
        className: "+=event_anim"
    });
    var scene = new ScrollMagic.Scene({
        triggerElement: "#trigger2nd",
        duration: 400,
        offset: 686
    }).setTween(tween).addIndicators({
        name: "tween css class "
    }).addTo(controller);
    //head3
    var tween = TweenMax.to("#head3", 1, {
        className: "+=event_anim"
    });
    var scene = new ScrollMagic.Scene({
        triggerElement: "#trigger2nd",
        duration: 200,
        offset: 860
    }).setTween(tween).addIndicators({
        name: "tween css class "
    }).addTo(controller);
    //head4
    var tween = TweenMax.to("#head4", 1, {
        className: "+=event_anim"
    });
    var scene = new ScrollMagic.Scene({
        triggerElement: "#trigger2nd",
        duration: 400,
        offset: 886
    }).setTween(tween).addIndicators({
        name: "tween css class "
    }).addTo(controller);
    //head5
    var tween = TweenMax.to("#head5", 1, {
        className: "+=event_anim"
    });
    var scene = new ScrollMagic.Scene({
        triggerElement: "#trigger2nd",
        duration:200,
        offset: 976
    }).setTween(tween).addIndicators({
        name: "tween css class "
    }).addTo(controller);
    //head6
    var tween = TweenMax.to("#head6", 1, {
        className: "+=event_anim"
    });
    var scene = new ScrollMagic.Scene({
        triggerElement: "#trigger2nd",
        duration: 400,
        offset: 966
    }).setTween(tween).addIndicators({
        name: "tween css class "
    }).addTo(controller);
    //head7
    var tween = TweenMax.to("#head7", 1, {
        className: "+=event_anim"
    });
    var scene = new ScrollMagic.Scene({
        triggerElement: "#trigger2nd",
        duration: 400,
        offset: 1106
    }).setTween(tween).addIndicators({
        name: "tween css class "
    }).addTo(controller);
    /*------------------------------------------*/
    /*------------------------------------------*/
</script>
<!-- JS Files -->
<!--For service worker to work remove: _remove_this (DevTip)-->
<script type="text/javascript">
    // If service worker is supported, then register it.
    if ('serviceWorker'in navigator) {
        navigator.serviceWorker.register('./service-worker_remove_this.js', {
            scope: './'
        })//To set service worker scope
        .then(function(register) {
            if (register.installing) {
                console.log('Service worker is installing!');
            } else if (register.waiting) {
                console.log('Service worker is waiting!');
            } else if (register.active) {
                console.log('Service worker is active!');
            }
        }).catch(function(error) {
            console.log('Service worker registration failed ', error);
        });
    } else {
        console.log('Service worker is not supported.');
    }
</script>
<script>
var x, i, j, selElmnt, a, b, c;
/* Look for any elements with the class "custom-select": */
x = document.getElementsByClassName("custom-select");
for (i = 0; i < x.length; i++) {
  selElmnt = x[i].getElementsByTagName("select")[0];
  /* For each element, create a new DIV that will act as the selected item: */
  a = document.createElement("DIV");
  a.setAttribute("class", "select-selected");
  a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
  x[i].appendChild(a);
  /* For each element, create a new DIV that will contain the option list: */
  b = document.createElement("DIV");
  b.setAttribute("class", "select-items select-hide");
  for (j = 1; j < selElmnt.length; j++) {
    /* For each option in the original select element,
    create a new DIV that will act as an option item: */
    c = document.createElement("DIV");
    c.innerHTML = selElmnt.options[j].innerHTML;
    c.addEventListener("click", function(e) {
        /* When an item is clicked, update the original select box,
        and the selected item: */
        var y, i, k, s, h;
        s = this.parentNode.parentNode.getElementsByTagName("select")[0];
        h = this.parentNode.previousSibling;
        for (i = 0; i < s.length; i++) {
          if (s.options[i].innerHTML == this.innerHTML) {
            s.selectedIndex = i;
            h.innerHTML = this.innerHTML;
            y = this.parentNode.getElementsByClassName("same-as-selected");
            for (k = 0; k < y.length; k++) {
              y[k].removeAttribute("class");
            }
            this.setAttribute("class", "same-as-selected");
            break;
          }
        }
        h.click();
    });
    b.appendChild(c);
  }
  x[i].appendChild(b);
  a.addEventListener("click", function(e) {
    /* When the select box is clicked, close any other select boxes,
    and open/close the current select box: */
    e.stopPropagation();
    closeAllSelect(this);
    this.nextSibling.classList.toggle("select-hide");
    this.classList.toggle("select-arrow-active");
  });
}

function closeAllSelect(elmnt) {
  /* A function that will close all select boxes in the document,
  except the current select box: */
  var x, y, i, arrNo = [];
  x = document.getElementsByClassName("select-items");
  y = document.getElementsByClassName("select-selected");
  for (i = 0; i < y.length; i++) {
    if (elmnt == y[i]) {
      arrNo.push(i)
    } else {
      y[i].classList.remove("select-arrow-active");
    }
  }
  for (i = 0; i < x.length; i++) {
    if (arrNo.indexOf(i)) {
      x[i].classList.add("select-hide");
    }
  }
}

/* If the user clicks anywhere outside the select box,
then close all select boxes: */
document.addEventListener("click", closeAllSelect);

    </script>
<!--The background. WebGL donot touch (DevTip)-->
<script src="https://joanclaret.github.io/html5-canvas-animation/js/three.min.js"></script>
<script src="https://joanclaret.github.io/html5-canvas-animation/js/projector.js"></script>
<script src="https://joanclaret.github.io/html5-canvas-animation/js/canvas-renderer.js"></script>
<script src="./script.js" type="module"></script>

</body></html>
