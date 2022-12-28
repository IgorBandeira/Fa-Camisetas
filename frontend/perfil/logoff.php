<?php
	session_start();
	session_destroy();
	header("location: ../vitrine/vitrine.php");
?>
