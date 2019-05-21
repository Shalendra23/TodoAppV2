<?php
session_start();

	include_once('connection.php');

	$output = array('error' => false);

	$database = new Connection();
	$db = $database->open();
	try{
		//make use of prepared statement to prevent sql injection

		$stmt = $db->prepare("INSERT INTO tasks (task_desc, task_created, task_due, users_id) VALUES (:task_desc, :task_created, :task_due, :users_id)");

		//if-else statement in executing our prepared statement
		if ($stmt->execute(array(':task_desc' => $_POST['task_desc'] , ':task_created' => $_POST['task_created'] , ':task_due' => $_POST['task_due'], ':users_id' => $_SESSION['user_session'])) ){
			$output['message'] = 'Task added successfully';
		}
		else{
			$output['error'] = true;
			$output['message'] = 'Something went wrong. Cannot add Task';
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