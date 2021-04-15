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
	$post->rowstamp = $data->rowstamp;
	$post->moveTo 	= $data->moveTo;
	$post->deadline = $data->deadline;
	
	//create post
	if($post->moveTask()){
		echo json_encode(
			array('message' => 'Task move successfully.')
			);
	}else{
		echo json_encode(
			array('message' => 'Task move failed.')
			);
	}
	include_once('listTask.php');
?>