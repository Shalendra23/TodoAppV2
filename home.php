<?php
// Include necessary file
include_once './includes/db.inc.php';

// Check if user is not logged in
if (!$user->is_logged_in()) {
    $user->redirect('index.php');
}

try {
    // Define query to select values from the users table
    $sql = "SELECT * FROM users WHERE user_id=:user_id";

    // Prepare the statement
    $query = $db_conn->prepare($sql);

    // Bind the parameters
    $query->bindParam(':user_id', $_SESSION['user_session']);

    // Execute the query
    $query->execute();

    // Return row as an array indexed by both column name
    $returned_row = $query->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    array_push($errors, $e->getMessage());
}

if (isset($_GET['logout']) && ($_GET['logout'] == 'true')) {
    $user->log_out();
    $user->redirect('index.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>OOP PHP - ToDo V2</title>
    
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
    
    
<style>

body{    
   background-color: #F6F6F6;   
    }
    
a{
   float: right;
    }
</style>
    
</head>

<body>
     <a href="?logout=true" class="btn btn-info">Log out</a></h2>

    <div class="container">
	<h1 class="page-header text-center">CodeSpace Keep for <?= $returned_row['user_name']; ?> </h1>
	<div class="row">
		<div class="col-sm-8 col-sm-offset-2">
			<button id="addnew" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> New</button>
            <div id="alert" class="alert alert-info text-center" style="margin-top:20px; display:none;">
            	<button class="close"><span aria-hidden="true">&times;</span></button>
                <span id="alert_message"></span>
            </div>  
			<table class="table table-bordered table-striped" style="margin-top:20px;">
				<thead>
					<th>ID</th>
					<th>Task Description</th>
					<th>Date Created</th>
					<th>Date Due</th>
					<th>Action</th>
				</thead>
				<tbody id="tbody"></tbody>
			</table>
		</div>
	</div>
</div>
<!-- Modals -->
<?php include('modal.html'); ?>
<script src="js/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="js/app.js"></script>

</body>
</html>