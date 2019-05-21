<?php
session_start();

	include_once('connection.php');

	$database = new Connection();
	$db = $database->open();

    $session_id = $_SESSION['user_session'];

	//only returns specific user tasks

	try{	
	    $sql = "SELECT * FROM tasks WHERE users_id = '{$session_id}' ORDER BY task_desc ASC";
	    foreach ($db->query($sql) as $row) {
	    	?>
	    	<tr>
	    		<td><?php echo $row['id']; ?></td>
	    		<td><?php echo $row['task_desc']; ?></td>
	    		<td><?php echo $row['task_created']; ?></td>
	    		<td><?php echo $row['task_due']; ?></td>
	    		<td>
	    		    <button class="btn btn-warning btn-sm done" data-id="<?php echo $row['id']; ?>"><span class="glyphicon glyphicon-check"></span> Completed</button>
	    			<button class="btn btn-success btn-sm edit" data-id="<?php echo $row['id']; ?>"><span class="glyphicon glyphicon-edit"></span> Edit</button>
	    			<button class="btn btn-danger btn-sm delete" data-id="<?php echo $row['id']; ?>"><span class="glyphicon glyphicon-trash"></span> Delete</button>
	    		</td>
	    	</tr>
	    	<?php 
	    }
	}
	catch(PDOException $e){
		echo "There is some problem in connection: " . $e->getMessage();
	}

	//close connection
	$database->close();
	
?>