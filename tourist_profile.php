<!DOCTYPE html>

<html>
  <head>
     <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
    <title>WildLife Reserve Login</title>


    <script type="text/javascript" src="js/tourist_main_js.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
      <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  </head>
  <body>
    <nav class="blue darken-3" role="navigation">
        <div class="nav-wrapper container"><a id="logo-container" href="#" class="brand-logo">My Profile</a>
            
            <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
         </div>
         
      </nav>
      <ul id="nav-mobile" class="side-nav fixed" style="width: 240px;">
        <li class="green darken-3"><img id="logo" src="resource/logo2.png" style="margin-left:auto"></li>
        <li class="bold"><a href="tourist_profile.php" class="waves-effect waves-green">My Profile</a></li>
        <li class="bold"><a href="tourist_safari.php" class="waves-effect waves-green">Safari Booking</a></li>
        <li class="bold"><a href="tourist_touristspots.php" class="waves-effect waves-green">Tourist Spot</a></li>
        
      </ul>

  <br><br>
  <?php
      session_start();
      $current_user=$_SESSION['login_user'];
      $user_type=$_SESSION['user_type'];
     
      $connection = mysql_connect("localhost", "root", "");
      $db = mysql_select_db("wildlife", $connection);
      if(isset($_POST["save"]))
      {
          $name = $_POST["name"];
          $age = $_POST["age"];
          $address = $_POST["address"];
          if(!empty($name))
          {
            mysql_query("UPDATE `tourist` SET Name='$name' WHERE TID = '$current_user'  ", $connection);
          }
          
          if(!empty($address))
          {
            mysql_query("UPDATE `tourist` SET Coming_from='$address' WHERE TID = '$current_user'  ", $connection);
          }
          
      } 
      
      
      $result = mysql_query("SELECT * FROM `tourist` WHERE TID = '$current_user'", $connection);
      if (mysql_num_rows($result) > 0) { 
        while($row = mysql_fetch_assoc($result)) {
          $tid = $row["TID"];
          $name = $row["Name"];
          $age = $row["Age"];
          $address = $row["Coming_from"];
          $visited = $row["Visited_on"];
      }
      } else {
        echo "<script>alert('error       SELECT * FROM `tourist` WHERE EID = '$current_user'') </script>";
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
                <span class="card-title white-text  col s6">Tourist ID</span>
                <span class="card-title white-text bold col s6"><h5><?php echo "$tid"?></h5></span>
                
            </div>
            <div class="row">
                <span class="card-title white-text  col s6">Age</span>
                <span class="card-title white-text bold col s6"><h5><?php echo "$age"?></h5></span>
                
            </div>
            
            <div class="row">
                <span class="card-title white-text bold col s6">Last Visited</span>
                <span class=" white-text bold col s6"><h5><?php echo "$visited"?></h5></span>
            </div>

            </div>
          </div>
        </div>
        <div class="col s8">
          <div class="card green darken-2">
            <div class="card-content white-text">
            <div class="row">
                <span class="card-title white-text bold col s12"><h5>Personal Details     (Click to Edit)</h5></span>
                
            </div>
            <form name="updateDetails" action="tourist_profile.php" onsubmit="return validate()" method="post">
            <div class="row">
                <span class=" white-text  col s6"><h5 style="margin= 5px">Name</h5></span>
                <div class="input-field col s6 white-text" >
                    <input id="name" type="text"  name="name">
                    <label for="name"><?php echo "$name"?></label>
                </div>
            </div>
            
            <div class="row">
                <span class=" white-text  col s5"><h5>Coming From</h5></span>
                <div class="input-field col s7 white-text" >
                    <input id="address" type="text"  name="address">
                    <label for="address"><?php echo "$address"?></label>
                </div>
            </div>
             <div class="row">
              <div class="col offset-s8">
              <button class="waves-effect white green-text center waves-light btn" type="submit" name="save">Save Changes</button>
              </div>
            </div>
            </form>
            

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
        
        return true;
        
      }
      
    </script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
  </body>
</html>