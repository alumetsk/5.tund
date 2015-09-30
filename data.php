<?php
	require_once("functions.php")
	/*data.php
	Siia pääseb ligi sisse loginud kasutaja
	Kui kasutaja ei ole sisse loginud, siis suunan
	data.php lehele */
	
	if(!isset($_SESSION[logged_in_user_id])){
		header("Location: login.php");
	}
	
	
	
	
?>
<p>
	Tere, <?=$_SESSION["logged_in_user_email"];?>
	<a href="?logout=1"> Logi välja <a>
	