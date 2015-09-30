<?php
	//funktions.php
	//siia tulevad funktsioonid, kõik mis seaotud AB'ga
	//muutujad ei ole numbritega, ja ei ole eesti keelsed
	
	//loon andmebaasi ühendused
	require_once("../configglobal.php");
	$database = "if15_kadri";
	$mysqli = new mysqli($servername, $server_username, $server_password, $database);
	
	
	//võtab andmed ja sisestab ab'i
	function createUser(){
		$stmt = $mysqli->prepare("INSERT INTO user_sample (email, password) VALUES (?,?)");
		// asendame ?-märgiud ss-s on string email, s on string passwd
		$stmt->bind_param("ss", $create_email, $hash);
		$stmt->execute();
		$stmt->close();
		
	}
	
	function loginUser(){
		$stmt = $mysqli->prepare("SELECT id, email FROM user_sample WHERE email=? AND password=?");
		$stmt->bind_param("ss", $email, $hash);
		//muutujad tulemustele
		$stmt->bind_result($id_from_db, $email_from_db);				
		$stmt->execute();
		//kontrollin kas tulemusi leiti
		if($stmt->fetch()){
		//andmebaasis oli midagi
			echo"Email ja parool õiged, kasutaja id=".$id_from_db;
		}else{
			//ei leidnud
			echo "Wrong credentials!";					
		}
				
		$stmt->close();
		
		
	}
   //panen ühenduse kinni
	$mysqli->close();
	



?>