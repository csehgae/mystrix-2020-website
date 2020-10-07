<?php
include('session.php');
session_start();

if($_SERVER["REQUEST_METHOD"] == "GET") {
	$w_name = mysqli_real_escape_string($db,htmlspecialchars($_GET['w']));

    # Workshop
    # Registration
    $sql = "SELECT COUNT(*) as cntusr FROM workshop WHERE w_name='".$w_name."'";
    $result = mysqli_query($db,$sql) or die("ERROR : " . mysqli_error($db));
    $row = mysqli_fetch_array($result);
    $w_reg = $row['cntusr'];
    # Attendance
    $sql = "SELECT COUNT(*) as cntusr FROM workshop WHERE attendance=1 AND w_name='".$w_name."'";
    $result = mysqli_query($db,$sql) or die("ERROR : " . mysqli_error($db));
    $row = mysqli_fetch_array($result);
    $w_attend = $row['cntusr'];
    # %
    $w_percent= ($w_attend/$w_reg)*100;
    
}

?>





