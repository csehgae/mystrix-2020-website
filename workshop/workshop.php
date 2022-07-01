
<?php
include('config.php');

if($_SERVER["REQUEST_METHOD"] == "GET") {
	$wname = mysqli_real_escape_string($db,htmlspecialchars($_GET['w_name']));

	// Checking for registration
	$sql = "SELECT COUNT(*) as num FROM workshop_details WHERE w_name = '".$wname."'";
	$result = mysqli_query($db,$sql) or die("ERROR : " . mysqli_error($db));
	$row = mysqli_fetch_array($result);
	$count = $row['num'];

	// If result matched $umailid and $uname, $count>0
	if($count > 0) {
		$sql_data = mysqli_query($db,"SELECT workshopname, description, guidelines, reg_link, p1, p2 FROM workshop_details WHERE w_name = '".$wname."'") or die("ERROR : " . mysqli_error($db));
		$row_data = mysqli_fetch_array($sql_data);
		//Parse data
		$ws_name = $row_data['workshopname'];
		$ws_des = $row_data['description'];
		$ws_guide = $row_data['guidelines'];
		$ws_reg = $row_data['reg_link'];
		$ws_p1 = $row_data['p1'];
		$ws_p2 = $row_data['p2'];
		
		}
	else {
		header('Location: https://workshop.mystrix.in');
		}

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<title>MYSTRIX | <?php echo $ws_name ?> Workshop</title>
<style>
* {box-sizing: border-box}
body {font-family: Verdana, sans-serif; margin:0}
.mySlides {display: none}
img {vertical-align: middle;}

/* Slideshow container */
.slideshow-container {
  max-width: 100%;
  position: relative;
  margin: auto;
}

/* Next & previous buttons */
.prev, .next {
  cursor: pointer;
  position: absolute;
  top: 50%;
  width: auto;
  padding: 16px;
  margin-top: -22px;
  color: white;
  font-weight: bold;
  font-size: 18px;
  transition: 0.6s ease;
  border-radius: 0 3px 3px 0;
  user-select: none;
}

/* Position the "next button" to the right */
.next {
  right: 0;
  border-radius: 3px 0 0 3px;
}

/* On hover, add a black background color with a little bit see-through */
.prev:hover, .next:hover {
  background-color: rgba(0,0,0,0.8);
}



/* The dots/bullets/indicators */
.dot {
  cursor: pointer;
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbb;
  border-radius: 50%;
  display: inline-block;
  transition: background-color 0.6s ease;
}

.active, .dot:hover {
  background-color: #717171;
}

/* Fading animation */
.fade {
  -webkit-animation-name: fade;
  -webkit-animation-duration: 1.5s;
  animation-name: fade;
  animation-duration: 1.5s;
}

@-webkit-keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

@keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

/* On smaller screens, decrease text size */
@media only screen and (max-width: 300px) {
  .prev, .next,.text {font-size: 11px}
}
/** my codes */
*{
	margin: 0px;
}


.topnav {
  background-color:#79d29c;
  overflow: hidden;
}

.topnav {
  float: left;
  color: #000;
  text-align: center;
  padding: 6px 2px;
  padding-top:16px;
  text-decoration: none;
  width: 100%;
  line-height: 53px;
  font-size: 18px;

}

.wname{
	width: 100%;
	font-size: 20px;
	font-family: extralight;
	font-weight: bold;
	padding: 1px 2px 3px 4px;
}



.description{
  margin-top:auto;
  margin-left:12px;
  height: 60%;
  border: none;
  padding: 9px;
  align-content: center;
  border-radius: 8px;
  width: 80%;
  overflow: auto;
  font-size: 13px;
}


.btn {
  margin-top: 20px;
  background-color: #15bbe0;
  border: none;
  color: white;
  padding: 6px 8px;
  cursor: pointer;
 
  
}


.btn:hover {
  background-color: #073c4c;
}



.registerbtn {
  margin-top: -1px;
  background-color: #1233ad;
  color: white;
  padding: 16px 20px;
  margin: 8px 0;
  border:none;
  cursor: pointer;
  width: 90%;
  opacity: 0.9;
  font-size: 12px;
  margin-left:18px;
}

.registerbtn:hover {
  opacity: 1;
}

.end{
	background-color:#58c697;
	height: 70px;
	margin-top: auto;
	text-align: center;
	padding-top: 35px;
	font-family: Helvetica;

}
.main_w{background:#fff;}

 @media (min-width: 550px) {
body{background-color: #000;    padding: 0% 35%;}
.main_w,.end{width:100%;}
}

</style>
</head>
<body>
<div class='main_w'>
<div class="topnav">
<h1 style=" font-family:bb "> WORKSHOP </h1> 
</div>
<div class="wname">
<h3><?php echo $ws_name ?> </h3>
</div>
<div class="slideshow-container">
<div class="mySlides fade">
<img src="./posters/<?php echo $ws_p1; ?>" style="width:100%">
</div>
<div class="mySlides fade">
<img src="./posters/<?php echo $ws_p2; ?>" style="width:100%">
</div>
<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
<a class="next" onclick="plusSlides(1)">&#10095;</a>
</div>
<br>
<div class="description">
<p>
<?php echo $ws_des ?>
</p>  
</div>
<div>
<a href="./docs/<?php echo $ws_guide ?>" download="Guidelines">
<button class="btn"><i class="fa fa-download"></i> Download Guidelines </button>
</a>
</div>
<a href="<?php echo $ws_reg ?>">
<button type="submit" class="registerbtn">Register</button>
</a>
</div>
<div class="end">
<!--
<h5 style="font-size: 11px">contacts</h5>
<h6 style="font-size: 8px">name:holy grace </h6>
<h6 style="font-size: 8px">number:12345678900</h6>
-->
</div>
<script>
var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  if (n > slides.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";  
  }
  
  slides[slideIndex-1].style.display = "block";  
  
}
</script>
</div>
</body>
</html> 
