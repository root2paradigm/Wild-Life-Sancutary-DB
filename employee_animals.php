<!DOCTYPE html>

<html>
  <head>
     <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
    <title>WildLife Reserve Login</title>


    <script type="text/javascript" src="js/employee_main_js.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="css/employee_animals_style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  </head>
  <body>
    
    <nav class="red darken-1" role="navigation">
        <div class="nav-wrapper container"><a id="logo-container" href="#" class="brand-logo">Animals</a>
            
            <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
         </div>
         
      </nav>
      <ul id="nav-mobile" class="side-nav fixed" style="width: 240px;">
        <li class="green darken-3"><img id="logo" src="resource/logo2.png" style="margin-left:auto"></li>
        <li class="bold"><a href="employee_profile.php" class="waves-effect waves-green">My Profile</a></li>
        <li class="bold"><a href="employee_jobprofile.php" class="waves-effect waves-green">Jobs</a></li>
        <li class="bold"><a href="employee_animals.php" class="waves-effect waves-green">Animals</a></li>
        <li class="bold"><a href="employee_zone.php" class="waves-effect waves-green">Zone Info</a></li>
      </ul>

      <?php
      session_start();
      $current_user=$_SESSION['login_user'];
      $connection = mysql_connect("localhost", "root", "");
      $db = mysql_select_db("wildlife", $connection);
      if(isset($_POST["animal_delete"]))
      {
        $dumpanimal = $_POST["animal"];
       
        mysql_query("DELETE FROM `animals` WHERE animals.Animal_ID='$dumpanimal'", $connection);
      }
      if(isset($_POST["animal_edit"]))
      {
          $dumpanimal = $_POST["animal"];
          $aid = $_POST["aid"];
          $agee = $_POST["age"];
          $species = $_POST["species"];
          if(!empty($name))
          {
            mysql_query("UPDATE `animals` SET Animal_ID='$aid' WHERE Animal_ID = '$dumpanimal'  ", $connection);
          }
          if(!empty($agee))
          {
            mysql_query("UPDATE `animals` SET Age='$agee' WHERE Animal_ID = '$dumpanimal'   ", $connection);
          }
          if(!empty($address))
          {
            mysql_query("UPDATE `animals` SET Species='$species' WHERE Animal_ID = '$dumpanimal'   ", $connection);
          }
      }
      $result = mysql_query("SELECT animals.Age,animals.Animal_ID,animals.Sex,animals.Species FROM animals,employee WHERE employee.EID='$current_user' AND animals.Zone=employee.ZONE", $connection);
      $emparray = array();
        while($row =mysql_fetch_assoc($result))
        {
            $emparray[] = $row;
        }

      $resultjson = json_encode($emparray);
      echo "<script> var animals = JSON.parse('$resultjson') </script>";
    ?>
  <br><br>
    <div class="container">
      <div class="section">
      <h1 class="green-text darken-2">Animals in My Zone</h1>
       <ul class="collection">
      <li class="collection-header">
       <div class="row">
        <div></div>
       </div>
      </li>
      <li class="collection-item">
        <div class="row">
          <div class="col s2 green-text darken-2">
            <b>Animal ID</b>
          </div>
          <div class="col s2 green-text darken-2">
            <b>Sex</b>
          </div>
          <div class="col s1 green-text darken-2">
            <b>Age</b>
          </div>
          <div class="col s2 green-text darken-2">
            <b>Species</b>
          </div>
     
        </div>
      </li>
      <?php
        $temp=0;
        foreach($emparray as $row){
            $aid = $row["Animal_ID"];
            $sex = $row["Sex"];
            $age = $row["Age"];
            $species = $row["Species"];
            $modal = "model".$temp;
            $temp=$temp+1;
            echo "<li class='collection-item'>
            <div class='row'>
              <div class='col s2 darken-2'>
                <b>$aid</b>
              </div>
              <div class='col s2 darken-2'>
                <b>$sex</b>
              </div>
              <div class='col s2 darken-2'>
                <b>$age</b>
              </div>
              <div class='col s2 darken-2'>
                <b>$species</b>
              </div>
              <form action='employee_animals.php' method='post'>
              <div class='col s1 offset-s1' >
               <button class='waves-effect center waves-light btn' name='animal_delete' type='submit' >Delete</button>
               <input name='animal' value='$aid' type='hidden'/>
              </div>
          </form>
          
              <div class='col s1 offset-s1' >
               <a class='waves-effect waves-light btn modal-trigger' href='#$modal'>Edit</a>
              
              </div>
          
                  
            </div>
          </li>


            <div id='$modal' class='modal'>
    <div class='modal-content'>
      <h4>Update Details</h4>
      <form name='updateDetails' action='employee_animals.php' onsubmit='return validate()' method='post'>
            <input name='animal' value='$aid' type='hidden'/>
            <div class='row'>
                <span class=' col s6'><h5 style='margin= 5px'>Animal ID</h5></span>
                <div class='input-field col s6 ' >
                    <input id='aid' type='text'  name='aid'>
                    <label for='aid'>$aid</label>
                </div>
            </div>
            <div class='row'>
                <span class='col s6'><h5>Age</h5></span>
                 <div class='input-field col s6 ' >
                    <input id='$age' type='text'  name='age'>
                    <label for='age'>$age</label>
                </div>
            </div>
            <div class='row'>
                <span class='col s6'><h5>Species</h5></span>
                <div class='input-field col s6 ' >
                    <input id='species' type='text'  name='species'>
                    <label for='species'>$species</label>
                </div>
            </div>
             <div class='row'>
              <div class='col offset-s8'>
              <button class='waves-effect green darken-2 center waves-light btn' type='submit' name='animal_edit'><span class='white-text'>Save Changes</span></button>
              </div>
            </div>
            </form>
    </div>
  </div>


          ";
        }
      ?>
    </ul>
    <!-- Modal Structure -->
    </div>
    </div>
    
    <script type="text/javascript">

      function delete()
      {
        Materialize.toast('Deleted', 4000
      }
    </script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <script> $(document).ready(function(){
    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    $('.modal-trigger').leanModal();
  });</script>
  </body>
</html>