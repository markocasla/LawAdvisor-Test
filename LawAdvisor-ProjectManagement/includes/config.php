<?php
	//DB credentials
	$db_user	 = 'root';
	$db_password = '';
	$db_name 	 = 'projectmanagementdb';
	try {
		//DB CONNECTION
		$db = new PDO('mysql:host=127.0.0.1;dbname='.$db_name,$db_user,$db_password);
		//DB attributes
		$db->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		//echo "Connected successfully";
	}catch(PDOException $e){
		echo "Connected failed:". $e->getMessage();
	}
	define('APP_NAME','PROJECT MANAGEMENT API');

?>