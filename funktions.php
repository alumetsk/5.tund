<?php
	//funktions.php
	//siia tulevad funktsioonid, k�ik mis seaotud AB'ga
	//muutujad ei ole numbritega, ja ei ole eesti keelsed
	
	//loon andmebaasi �hendused
	require_once("../configglobal.php");
	$database = "if15_kadri";
	
	//tekitatakse sessioon, mida hoitakse serveris
	//k�ik session muutujad on k�ttesaadavad kuni viimase brauseriakna sulgemiseni
	session_start();
	
	//kui kasutaja on sisse loginud, suunan data.php lehele
	if(isset($_SESSION[logged_in_user_id])){
		header("Location: data.php");
	}
	
	
	//v�tab andmed ja sisestab ab'i
	//v�tan vastu 2 muutujat
	function createUser($create_email, $hash){
		$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
		$stmt = $mysqli->prepare("INSERT INTO user_sample (email, password) VALUES (?,?)");
		// asendame ?-m�rgiud ss-s on string email, s on string passwd
		$stmt->bind_param("ss", $create_email, $hash);
		$stmt->execute();
		$stmt->close();
		
		$mysqli->close();
	}
	
	function loginUser($email, $hash){
		$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
		$stmt = $mysqli->prepare("SELECT id, email FROM user_sample WHERE email=? AND password=?");
		$stmt->bind_param("ss", $email, $hash);
		//muutujad tulemustele
		$stmt->bind_result($id_from_db, $email_from_db);				
		$stmt->execute();
		//kontrollin kas tulemusi leiti
		if($stmt->fetch()){
		//andmebaasis oli midagi
			echo"Email ja parool �iged, kasutaja id=".$id_from_db;
			
			//tekitan sessiooni muutujad
			$_SESSION["logged_in_user_id"] = $id_from_db;
			$_SESSION["logged_in_user_email"] = $email_from_db;
			
			//suunan data.php lehele
			header("Location: data.php");
			
			
		}else{
			//ei leidnud
			echo "Wrong credentials!";					
		}
				
		$stmt->close();
		
		$mysqli->close();
	}
   
	



?>