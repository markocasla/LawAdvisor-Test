<?php
	//headers
	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json');

	include_once('../core/initialize.php');

	//initialize post

	$post = new Post($db);
	$post->taskid = isset($_GET['taskid']) ? $_GET['taskid']:die();
	$post->searchTask();

	$post_arr = array(
		'taskid' => $post->taskid,
		'task' => $post->task,
		'details' => $post->details,
		'status' => $post->status,
		'deadline' => $post->deadline,
		'movecount' => $post->movecount
		);	
	
	//to json
	print_r(json_encode($post_arr));
?>