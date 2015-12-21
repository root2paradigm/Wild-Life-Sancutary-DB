<!DOCTYPE html>

<html>
  <head>
     <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
    <title>WildLife Reserve Login</title>
     <style type="text/css">
    #logo {
     display: block;
      width: 220px;
    

   }
    </style>

    <script type="text/javascript" src="js/tourist_main_js.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  </head>
  <body>
    <nav class="blue darken-3" role="navigation">
        <div class="nav-wrapper container"><a id="logo-container" href="#" class="brand-logo">My Profile</a>
            <ul class="right hide-on-med-and-down">
              <li><a href="#">Settings</a></li>
            </ul>

            <ul id="nav-mobile" class="side-nav">
              <li><a href="#">Settings</a></li>
            </ul>
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
      $result = mysql_query("SELECT * FROM safari", $connection);
      $emparray = array();
        while($row =mysql_fetch_assoc($result))
        {
            $emparray[] = $row;
        }

      $resultjson = json_encode($emparray);
      echo "<script> var origins = JSON.parse('$resultjson') </script>";
      if(isset($_POST["booking"]))
      {
        $safari=$_POST["safari"];
        $quan=$_POST["quan"];
        $price=$quan*$emparray[0]["Fee"];
        $bookingid = "BOOK".rand(0,10000);
        $temp = mysql_query("INSERT INTO `wildlife`.`safari_booking` (`Booking_ID`, `Safari_booked_for`, `Tourist_interest_in`, `People_count`) VALUES ('$bookingid', '$safari', '$current_user', '$quan')",$connection);
         if($temp==false)
         echo "<script>alert('eoor $safari $quan $price $bookingid');</script>";
        else
          echo "<script>alert('Booked Total price: Rs.$price');</script>";


      }
      
    
  ?>
    <div class="container">
    <div class="section">
      <h1 class="green-text">Book a Safari!</h1>
      <div class="row">
        <div class="col s7">
          <div class="card blue darken-3">
            <div class="card-content white-text">
              <form action="tourist_safari.php" method="post" >
              <div class="row">
                <div class="col s6">
                  <span class="card-title bold">Safari</span>
                </div>
                 <div class="col s6">
                  
                   <div class="input-field col s12">
                      <select  name="safari">
                        <option value="0" disabled selected>Choose your option</option>
                        <?php 
                          foreach ($emparray as $key) {
                            $lol = $key["Ride_name"];
                            echo "<option value='$lol'>$lol</option>";
                          }
                        ?>
                      </select>
                      <label class="white-text safari">Select Safari</label>
                    </div>
                </div>
              </div>
              <div class="row">
                <div class="col s6">
                  <span class="card-title bold">No of people</span>
                </div>
                 
                  <div class="input-field col s6">
                  <input id="quan" type="text" name="quan">
                  <label for="quan" class="white-text">Enter</label>
                </div>
                
              </div>
              <div class="row">
                <br>
                <br>
                <br>
              </div>
              <div class="row">
                <br>
                <br>
                <br>
              </div>
              <div class="row">
                <button class="white btn col s2 offset-s1 blue-text" type="submit" name="booking">Book!</button>
              </div>

            </form>
            </div>
          </div>
        </div>
        <div class="col s5">
          <ul class="collection">
      <li class="collection-header">
       <div class="row">
        <div></div>
       </div>
      </li>
      <li class="collection-item">
        <div class="row">
          <div class="col s4 green-text darken-2">
            <b>Ride Name</b>
          </div>
          <div class="col s4 green-text darken-2">
            <b>Fee</b>
          </div>
          <div class="col s4 green-text darken-2">
            <b>Zone</b>
          </div>
     
        </div>
      </li>
      <?php
        $temp=0;
        foreach($emparray as $row){
            $jid = $row["Ride_name"];
            $dur = $row["Fee"];
            $des = $row["Happens_in"];
            echo "<li class='collection-item'>
            <div class='row'>
              <div class='col s4 darken-2'>
                <b>$jid</b>
              </div>
              <div class='col s4 darken-2'>
                <b>$dur</b>
              </div>
              <div class='col s4 darken-2'>
                <b>$des</b>
              </div>
              <form action='employee_jobprofile.php' method='post'>
              
          </form>
          
            
                  
            </div>
          </li>


            ";}
      ?>
    </ul>
        </div>
        
      </div>

      </div>
  
    </div>
    <script type="text/javascript">
      function validate()
      {
        var form = document.forms["book"];
        var name = form["name"].value;
        var quan = form["quan"].value;
        if(quan<1||quan>10)
        {
          alert("Please Enter valid Quantity");
          return false;
        }
        return true;
        
      }
      
    </script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <script type="text/javascript">
       $(document).ready(function() {
    $('select').material_select();
  });
    </script>
  </body>
</html>