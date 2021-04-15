<?php
	//headers
	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json');
	header('Access-Controll-Allow-Methods: POST');
	header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

	include_once('../core/initialize.php');
	
	//initialize post
	$post = new Post($db);
	
	//get post data
	$data = json_decode(file_get_contents("php://input"));
	$post->rowstamp 	= $data->rowstamp;
	$post->task 		= $data->task;
	$post->details 		= $data->details;
	$post->status 		= $data->status;
	
	//create post
	if($post->updateTask()){
		echo json_encode(
			array('message' => 'Task updated.')
			);
	}else{
		echo json_encode(
			array('message' => 'Task update failed.')
			);
	}

?>