<?php
	require_once("functions.php")
	/*data.php
	Siia p��seb ligi sisse loginud kasutaja
	Kui kasutaja ei ole sisse loginud, siis suunan
	data.php lehele */
	
	if(!isset($_SESSION[logged_in_user_id])){
		header("Location: login.php");
	}
	 //kasutaja tahab v�lja logida
	 if(isset($_GET["logout"])){
		 //aadressireal on olemas muutuja logout
		 
		 //Kustutame k�ik session muutujad ja peatame sessiooni
		 session_destroy();
		 
		 header("Location: login.php");
	 }
	
	
	
?>
<p>
	Tere, <?=$_SESSION["logged_in_user_email"];?>
	<a href="?logout=1"> Logi v�lja <a>
	