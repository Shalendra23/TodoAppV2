<?php
	include_once('connection.php');

	$output = array('error' => false);

	$database = new Connection();
	$db = $database->open();
	try{

		$id = $_POST['id'];
		$task_desc = $_POST['task_desc'];
		$task_created = $_POST['task_created'];
		$task_due = $_POST['task_due'];

		$sql = "UPDATE tasks SET task_desc = '$task_desc', task_created = '$task_created', task_due = '$task_due' WHERE id = '$id'";

		//if-else statement in executing our query
		if($db->exec($sql)){
			$output['message'] = 'Task updated successfully';
		} 
		else{
			$output['error'] = true;
			$output['message'] = 'Something went wrong. Cannot update task';
		}

	}
	catch(PDOException $e){
		$output['error'] = true;
		$output['message'] = $e->getMessage();
	}

	//close connection
	$database->close();

	echo json_encode($output);
	
?>