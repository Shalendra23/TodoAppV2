<?php

/* 
Copyright 2019 Shalendra Singh
Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:
The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE. 
*/


/*  DB SCHEMA

DATABASE name: mydatabase

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(60) NOT NULL,
  `user_email` varchar(60) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `task_desc` varchar(255) NOT NULL,
  `task_created` date NOT NULL,
  `task_due` date NOT NULL,
  `users_id` char(60) DEFAULT NULL,
  `task_complete` char(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1

*/


// Include necessary file
require_once('./includes/db.inc.php');

// Check if user is already logged in
if ($user->is_logged_in()) {
    // Redirect logged in user to their home page
    $user->redirect('home.php');
}

// Check if log-in form is submitted
if (isset($_POST['log_in'])) {
    // Retrieve form input
    $user_name = trim($_POST['user_name_email']);
    $user_email = trim($_POST['user_name_email']);
    $user_password = trim($_POST['user_password']);

    // Check for empty and invalid inputs
    if (empty($user_name) || empty($user_email)) {
        array_push($errors, "Please enter a valid username or e-mail address");
    } elseif (empty($user_password)) {
        array_push($errors, "Please enter a valid password.");
    } else {
        // Check if the user may be logged in
        if ($user->login($user_name, $user_email, $user_password)) {
            // Redirect if logged in successfully
            $user->redirect('home.php');
        } else {
            array_push($errors, "Incorrect log-in credentials.");
        }
    }
}

// Check if register form is submitted
if (isset($_POST['register'])) {
    // Retrieve form input
    $user_name = trim($_POST['user_name']);
    $user_email = trim($_POST['user_email']);
    $user_password = trim($_POST['user_password']);

    // Check for empty and invalid inputs
    if (empty($user_name)) {
        array_push($errors, "Please enter a valid username.");
    } elseif (empty($user_email)) {
        array_push($errors, "Please enter a valid e-mail address.");
    } elseif (empty($user_password)) {
        array_push($errors, "Please enter a valid password.");
    } elseif (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Please enter a valid e-mail address.");
    } else {
        try {
            // Define query to select matching values
            $sql = "SELECT user_name, user_email FROM users WHERE user_name=:user_name OR user_email=:user_email";

            // Prepare the statement
            $query = $db_conn->prepare($sql);

            // Bind parameters
            $query->bindParam(':user_name', $user_name);
            $query->bindParam(':user_email', $user_email);

            // Execute the query
            $query->execute();

            // Return clashes row as an array indexed by both column name
            $returned_clashes_row = $query->fetch(PDO::FETCH_ASSOC);

            // Check for usernames or e-mail addresses that have already been used
            if ($returned_clashes_row['user_name'] == $user_name) {
                array_push($errors, "That username is taken. Please choose something different.");
            } elseif ($returned_clashes_row['user_email'] == $user_email) {
                array_push($errors, "That e-mail address is taken. Please choose something different.");
            } else {
                // Check if the user may be registered
                if ($user->register($user_name, $user_email, $user_password)) {
                    echo "Registered";
                }
            }
        } catch (PDOException $e) {
            array_push($errors, $e->getMessage());
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>OOP PHP - Login and Register</title>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

</head>
<body class="bg-dark">
  
  <style>
    
.jumbotron{
     text-align: center;
     padding: 1em inherit;
     background-color: #F6F6F6;
     background-image: url(images/elephant-never-forgets-clipart.png);
     background-repeat: no-repeat;
}

.jumbotron hr{
    width: 450px;
}
      
.alert{
    margin: 0 auto;
    width: 450px;
    text-align: center;
}    
      
ul{
   list-style: none;
   padding: 0;
}
      
.container{
   padding: 0;
}
      
      
@media only screen and (max-width: 1060px) {
.jumbotron{
   background-image: url();
}
}

</style>
  
<div class="jumbotron jumbotron-fluid">
  <div class="container">
  <h1 class="display-4">CodeSpace Keep</h1>
  <p class="lead">The only task list manager app you will ever need</p>
  <hr class="my-4">
  <p>PHP , AJAX , MYSQL , CRUD </p>

</div>
    </div>
  
 <?php if (count($errors > 0)): ?>
         <ul>
        <?php foreach ($errors as $error): ?>
           <div class="alert alert-danger">
               <li><?= $error ?></li>
            </div>
        
        <?php endforeach ?>
    </ul>
    <?php endif ?> 

    <!-- Log in -->
    
  <div class="container">
    <div class="row">
      <div class="col-md-6 mx-auto">
        <div class="card card-body bg-light mt-5">
        
    <h2>Log in</h2>
    <form action="index.php" method="POST">
       
              <div class="form-group">
              
        <label for="user_name_email">Username or E-mail Address:</label>
        <input type="text" name="user_name_email" id="user_name_email" required class="form-control form-control-lg">
           <span class="invalid-feedback"><?php echo $email_err; ?></span>
</div>
        <div class="form-group">
       
        <label for="user_password_log_in">Password:</label>
        <input type="password" name="user_password" id="user_password_log_in" required class="form-control form-control-lg">

    </div>

        <input type="submit" name="log_in" value="Log in" class="btn btn-success btn-block">
       <input id="myButton" type="button" name="answer" value=" No Account? Click here to Register" class="btn btn-light btn-block"/>

    </form>
    <br>

    <!-- Register -->

   
           <div id="myDiv" style="display:none;">
           
               <h2>Register</h2>
    <form action="index.php" method="POST">
     <div class="form-row" >
    
              <div class="col">
        <label for="user_name">Username:</label>
        <input type="text" name="user_name" id="user_name" required class="form-control form-control-lg">

        <label for="user_email">E-mail Address:</label>
        <input type="email" name="user_email" id="user_email" required class="form-control form-control-lg">

        <label for="user_password">Password:</label>
        <input type="password" name="user_password" id="user_password" required class="form-control form-control-lg">
        <br>
                      </div>


        <input type="submit" name="register" value="Register"  class="btn btn-primary btn-block">
        
        </div>
        </div>
        
        
    </form>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript">  
        
        $('#myButton').click(function() {
              $('#myDiv').toggle('slow', function() {
                // Animation complete.
              });
            });
        
        
        </script>
    
    
</body>
</html>



