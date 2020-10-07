<?php
	if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
		header('Location: login.php');
	} else {
		header('Location: https-error.html');
	}
	exit;
?>
OOPS!
Something went wrong..
Please contact administrator
csehgae@gmail.com
