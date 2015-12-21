<!DOCTYPE html>
<html>
	<head>
		 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
		<title>WildLife Reserve Login</title>



		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  		<link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  		
	</head>
	<body>
		<nav class="blue darken-3" role="navigation">
    		<div class="nav-wrapper container"><a id="logo-container" href="#" class="brand-logo">Wildlife Reserve </a>
      		
      			<a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
   			 </div>
   			 
  		</nav>

  		<br><br>
  		<div ="container">
  		 <div class="row">
        <div class="col s3 offset-s4">
          <div class="card white darken-1">
            <div class="card-content black-text">
              <span class="card-title black-text bold">Login</span>
               <form action="tourist_login.php" method="post">
              <div class="row">
              	<div class="input-field col s12">
          			<input id="username" type="text"  name="username">
          			<label for="username">Username</label>
        		</div>
              </div>
              <div class="row">
              	<div class="input-field col s12">
          			<input id="password" type="password" name="password">
          			<label for="password">Password</label>
        		</div>
              </div>
               	<div class="row">
               		<div class="col offset-s4">
      				<button class="waves-effect center waves-light btn" name="login_submit" type="submit">Login
      				</div>
      			</div>
          </form>
            </div>
            <div class="card-action">
            	
             
            </div>
            <div class="card-reveal">
      			<span class="card-title small grey-text text-darken-4">Sign Up<i class="material-icons right">close</i></span>
          
     				 <div class="row">
              			<div class="input-field col s12">
          					<input id="username" type="text">
          					<label for="username">Username</label>
        				</div>
              		</div>
              		<div class="row">
              			<div class="input-field col s12">
          					<input id="password" type="text" >
          					<label for="password">Password</label>
        			</div>
        	 </div>
              
        	 <div class="row">
               		<div class="col offset-s4">
      				<button class="waves-effect center waves-light btn" >Login</a>
      				</div>
      			</div>
          
            </div>
   			 </div>
          </div>
        </div>
      </div>
    </div>

    <?php
      session_start(); // Starting Session
      $error=''; // Variable To Store Error Message
      if (isset($_POST['login_submit'])) {
        if (empty($_POST['username']) || empty($_POST['password'])) {
          $error = "Username or Password is invalid";
          echo "<script> alert('$error');</script>";
        }
        else
        {
          $username=$_POST['username'];
          $password=$_POST['password'];
          $connection = mysql_connect("localhost", "root", "");
          $username = stripslashes($username);
          $password = stripslashes($password);
          $username = mysql_real_escape_string($username);
          $password = mysql_real_escape_string($password);
          $db = mysql_select_db("wildlife", $connection);
          $query = mysql_query("SELECT * FROM `tourist` WHERE TID = '$username' AND Password ='$password'", $connection);
          $rows = mysql_num_rows($query);
          if ($rows == 1) {
            $_SESSION['login_user']=$username; 
            header("location: tourist_profile.php"); 
          } else {
            $error = "Username or Password is invalid";
            echo "<script> alert('$error');</script>";
          }
          mysql_close($connection);
        }
      }
    ?>


  
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
	</body>
</html>