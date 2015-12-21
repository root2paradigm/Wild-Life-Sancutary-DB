<!DOCTYPE html>

<html>
  <head>
     <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
    <title>WildLife Reserve Login</title>


    <script type="text/javascript" src="js/employee_main_js.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
      <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  </head>
  <body>
    <nav class="grey darken-2" role="navigation">
        <div class="nav-wrapper container"><a id="logo-container" href="#" class="brand-logo">My Profile</a>
            
            <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
         </div>
         
      </nav>
      <ul id="nav-mobile" class="side-nav fixed" style="width: 240px;">
        <li class="green darken-3"><img id="logo" src="resource/logo2.png" style="margin-left:auto"></li>
        <li class="bold"><a href="vet_profile.php" class="waves-effect waves-green">My Profile</a></li>
        <li class="bold"><a href="vet_sickanimals.php" class="waves-effect waves-green">Sick Animals</a></li>
      </ul>

  <br><br>
  <?php
      session_start();
      $current_user=$_SESSION['login_user'];
      $connection = mysql_connect("localhost", "root", "");
      $db = mysql_select_db("wildlife", $connection);
      
      
      $result = mysql_query("SELECT * FROM `veterinarian` WHERE VID = '$current_user'", $connection);
      if (mysql_num_rows($result) > 0) { 
        while($row = mysql_fetch_assoc($result)) {
          $vid = $row["VID"];
          $name = $row["Name"];
          $zone = $row["Works_in_zone"];
          $spec = $row["Species_specialisation"];
      }
      } else {
        echo "<script>alert('error       SELECT * FROM `employee` WHERE EID = '$current_user'') </script>";
      }
    
  ?>
    <div class="container">
    <div class="section">
      <h1 class="green-text">My Details</h1>
      <div class="row">
        <div class="col s4">
          <div class="card green darken-2">
            <div class="card-content white-text">
            <div class="row">
                <span class=" white-text bold col s6"><h5>General Details</h5></span>
              
            </div>
            <div class="row">
                <span class="card-title white-text  col s6">Vet ID</span>
                <span class="card-title white-text bold col s6"><h5><?php echo "$vid"?></h5></span>
                
            </div>
            <div class="row">
                <span class="card-title white-text bold col s6">Name</span>
                <span class=" white-text bold col s6"><h5><?php echo "$name"?></h5></span>
            </div>
            <div class="row">
                <span class="card-title white-text bold col s6">Zone</span>
                <span class=" white-text bold col s6"><h5>Rs.<?php echo "$zone"?><h5></span>
            </div>
            <div class="row">
                <span class="card-title white-text bold col s6">Specialization</span>
                <span class=" white-text bold col s6"><h5><?php echo "$spec"?></h5></span>
            </div>

            </div>
          </div>
        </div>
      </div>

      </div>
  
    </div>
    <script type="text/javascript">
      function validate()
      {
        var form = document.forms["updateDetails"];
        var name = form["name"].value;
        var age = form["age"].value;
        var address = form["address"].value;
        if(age!=null&&age<0||age>99)
        {
          alert("Please Enter valid age");
          return false;
        }
        return true;
        
      }
      
    </script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
  </body>
</html>