<?php
	//headers
	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json');
	header('Access-Controll-Allow-Methods: DELETE');
	header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

	include_once('../core/initialize.php');
	
	//initialize post
	$post = new Post($db);
	
	//get post data
	$data = json_decode(file_get_contents("php://input"));
	$post->rowstamp 	= $data->rowstamp;
	
	//create post
	if($post->removeTask()){
		echo json_encode(
			array('message' => 'Task successfully remove.')
			);
	}else{
		echo json_encode(
			array('message' => 'Task deletion failed.')
			);
	}

?>