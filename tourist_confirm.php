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

      $safari="";
      $quan=1;
      if(isset($_POST["booking"]))
      {
        $safari=$_POST["safari"];
        $quan=$_POST["quan"];
      }
      $_SESSION["tou"]=$safari;
      $_SESSION["quan"]=$quan;
      $connection = mysql_connect("localhost", "root", "");
      $db = mysql_select_db("wildlife", $connection);
      if(isset($_POST["confirm"]))
      {

        $temp1=$_SESSION["tou"];
        $temp2=$_SESSION["quan"];
        $temp3=$_SESSION["price"];
        $bookid = "BOOK".rand(0,100000);
         $temp = mysql_query("INSERT INTO `wildlife`.`safari booking` (`Booking_ID`, `Safari_booked_for`, `Tourist_interest_in`, `People_Count`) VALUES ('$bookid', '$temp1', '$temp2', '$temp3')",$connection);
         if($temp==false)
         echo "<script>alert('eoor');</script>";
      }
      $result = mysql_query("SELECT * FROM safari WHERE Ride_name='$safari'", $connection);
      $emparray = array();
        while($row =mysql_fetch_assoc($result))
        {
            $emparray[] = $row;
        }
      $price = $quan * $emparray[0]["Fee"];
      $resultjson = json_encode($emparray);
      $_SESSION["price"]=$price;
      echo "<script> var origins = JSON.parse('$resultjson') </script>";
    
  ?>
    <div class="container">
    <div class="section">
      <h1 class="green-text">Safary Summary</h1>
      <div class="row">
        <div class="col s7">
          <div class="card blue darken-3">
            <div class="card-content white-text">
              <form action="tourist_confirm.php" method="post">
              <div class="row">
                <div class="col s6">
                  <span class="card-title bold">Safari</span>
                </div>
                 <div class="col s6">
                  <h5><?php echo "$safari"?></h5>
                </div>
              </div>
              <div class="row">
                <div class="col s6">
                  <span class="card-title bold">Quantiy</span>
                </div>
                 <div class="col s6">
                  <h5><?php echo "$quan"?></h5>
                </div>
              </div>
              <div class="row">
                <div class="col s6">
                  <span class="card-title bold">Total Price</span>
                </div>
                 <div class="col s6">
                  <h5><?php echo "$price"?></h5>
                </div>
              </div>
              <div class="row">
                <button class="white btn col s3 offset-s1 blue-text" name="confirm" type="submit">Confirm Booking!</button>
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