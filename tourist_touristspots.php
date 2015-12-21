<!DOCTYPE html>

<html>
  <head>
     <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
      <style type="text/css">
      html, body { height: 100%; margin: 0; padding: 0; }
      #map { height: 80%;
      width: 100% }
    </style>
    <meta charset="utf-8">
    
    <title>WildLife Reserve Login</title>
    <?php 
      $connection = mysql_connect("localhost", "root", "");
      $db = mysql_select_db("wildlife", $connection);
      $result = mysql_query("SELECT * from tourist_spots", $connection);
      $emparray = array();
        while($row =mysql_fetch_assoc($result))
        {
            $emparray[] = $row;
        }

      $resultjson = json_encode($emparray);
      echo "<script> var origins = JSON.parse('$resultjson') </script>";
    ?>

    <script type="text/javascript" src="js/employee_main_js.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
      <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  </head>
  <body>
    <nav class="blue darken-3" role="navigation">
        <div class="nav-wrapper container"><a id="logo-container" href="#" class="brand-logo">Tourist Spots</a>

            <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
         </div>
         
      </nav>
      <ul id="nav-mobile" class="side-nav fixed" style="width: 240px;">
        <li class="green darken-3"><img id="logo" src="resource/logo2.png" style="margin-left:auto"></li>
        <li class="bold"><a href="tourist_profile.php" class="waves-effect waves-green">My Profile</a></li>
        <li class="bold"><a href="tourist_safari.php" class="waves-effect waves-green">Safari Booking</a></li>
        <li class="bold"><a href="tourist_touristspots.php" class="waves-effect waves-green">Tousrist Spots</a></li>
      </ul>

    <br><br>
    <div class="container" style="height:100%">
      <div class="row" style="height:100%">
        <div class="col s8" style="height:100%">
        <div id="map"></div>
        </div>
        <div class="col s4" style="height:100%">
          <div class="card white-text green darken-2">
            <div class="card-content green darken-2">
              <h5 onclick="centerMap()">Places of Interest</h5>
              <div class=row>
              <?php 
                $temp=0;
                foreach ($emparray as $key) {
                  $name = $key["TSID"];
                  $lat = $key["Lat"];
                  $lng = $key["Lng"];
                  echo ("<div class=' col s6 waves-effect waves-green'>");
                  echo ("<div class='card-title s6' onclick='centerMapLoc($lat,$lng,$temp)'><h5> $name <h5></div>");
                  $temp=$temp+1;
                  echo ("</div>");
                }

              ?>
              </div>
              <div class="row">
              <div class="col s4 offset-s1 waves-effect white btn green-text" onclick="resetMap()"> Clear all</div>
              </div>
            </div>
            
          </div>
        </div>
      </div>
    <script type="text/javascript">
        var str = JSON.stringify(origins, null, 2);

        var map;
        function initMap() {
          map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: 29.5216, lng: 78.7736},
            zoom: 13
          });
        }
        function centerMap(){
          var myLatlng = new google.maps.LatLng(29.5216, 78.7736);
          map.setCenter(myLatlng);
          map.setZoom(13);
        }
        function centerMapLoc(Lat,Lng,no){


          var myLatlng = new google.maps.LatLng(parseFloat(Lat),parseFloat(Lng));
          map.setCenter(myLatlng);
          var sample="<b>"+origins[no]["Name"]+"</b> <br>"+"<b>Active hours:</b> "+origins[no]["Active_hours"]+"<br> <b>Capacity:</b> "+origins[no]["Capacity"];
          var infowindow = new google.maps.InfoWindow({
            content: sample
          });


          var latlng = {lat: Lat,lng: Lng};
          var marker = new google.maps.Marker({
          position: latlng,
          map: map,
          title: 'Zone'
        });

          marker.addListener('click', function() {
            infowindow.open(map, marker);
          });

        }
        function resetMap()
        {
          map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: 29.5216, lng: 78.7736},
            zoom: 13
          });
        }

        


    </script>
    <script async defer
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD9S3PbBcsiOjGkamUzLD4CbhBfLEE_IPI&callback=initMap">
    </script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
  </body>
</html>