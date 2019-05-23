<?php
	include_once('connection.php');

	$output = array('error' => false);

	$database = new Connection();
	$db = $database->open();
	try{
	
		$id = $_POST['id'];

		$sql = "UPDATE `tasks` SET `task_complete`='Y' WHERE id = '$id'";
		

		//if-else statement in executing our query
		if($db->exec($sql)){
			$output['message'] = 'Task Completed Successfully';
		} 
		else{
			$output['error'] = true;
			$output['message'] = 'Something went wrong. Cannot complete Task';
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