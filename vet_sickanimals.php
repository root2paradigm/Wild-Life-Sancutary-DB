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
    
    <nav class="grey darken-2" role="navigation">
        <div class="nav-wrapper container"><a id="logo-container" href="#" class="brand-logo">Animals</a>
            
            <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
         </div>
         
      </nav>
      <ul id="nav-mobile" class="side-nav fixed" style="width: 240px;">
        <li class="green darken-3"><img id="logo" src="resource/logo2.png" style="margin-left:auto"></li>
        <li class="bold"><a href="vet_profile.php" class="waves-effect waves-green">My Profile</a></li>
        <li class="bold"><a href="vet_sickanimals.php" class="waves-effect waves-green">Sick Animals</a></li>
       
      </ul>

      <?php
      session_start();
      $current_user=$_SESSION['login_user'];
      $connection = mysql_connect("localhost", "root", "");
      $db = mysql_select_db("wildlife", $connection);
      if(isset($_POST["job_delete"]))
      {
        $dumpjob = $_POST["jid"];
       
        mysql_query("DELETE FROM sick_animals WHERE Sick_animal_ID='$dumpjob'", $connection);
      }

      $result = mysql_query("SELECT * FROM sick_animals WHERE Vet_in_charge='$current_user'", $connection);
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
      <h1 class="green-text darken-2">My Jobs</h1>
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
          <div class="col s1 green-text darken-2">
            <b>Illness</b>
          </div>
          <div class="col s3 green-text darken-2">
            <b>Duration</b>
          </div>
     
        </div>
      </li>
      <?php
        $temp=0;
        foreach($emparray as $row){
            $jid = $row["Sick_animal_ID"];
            $dur = $row["Duration_of_illness"];
            $ill = $row["Illness"];
            echo "<li class='collection-item'>
            <div class='row'>
              <div class='col s2 darken-2'>
                <b>$jid</b>
              </div>
              <div class='col s1 darken-2'>
                <b>$dur</b>
              </div>
              <div class='col s3 darken-2'>
                <b>$dur</b>
              </div>
              <form action='vet_sickanimals.php' method='post'>
              <div class='col s1 offset-s3' >
               <button class='waves-effect center waves-light btn' name='job_delete' type='submit' >Treated</button>
               <input name='jid' value='$jid' type='hidden'/>
              </div>
          </form>
          
            
                  
            </div>
          </li>


            ";}
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