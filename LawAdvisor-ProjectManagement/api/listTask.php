<?php
	//headers
	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json');

	include_once('../core/initialize.php');
	//initialize post
	$post = new Post($db);

	$result = $post->listTask();
	$num = $result->rowCount();

	if($num>0){
	
		$post_arr = array();
		$post_arr['data'] = array();
	
		while($row = $result->fetch(PDO::FETCH_ASSOC)){
			extract($row);
			$post_item = array(
				'taskid' => $taskid,
				'task' => $task,
				'details' => html_entity_decode($details),
				'deadline' => $deadline,
				'movecount' => $movecount
			);
			array_push($post_arr['data'],$post_item);
		}
		//json output
		echo json_encode($post_arr);

	}else{
		echo json_encode(array('message' => 'No task found.'));
	}
?>