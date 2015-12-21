<!DOCTYPE html>
<html>
	<head>
		 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
		<title>WildLife Reserve Login</title>



		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  		<link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  		<link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
	</head>
	<body>
		<nav class="light-green lighten-1" role="navigation">
    		<div class="nav-wrapper container"><a id="logo-container" href="#" class="brand-logo">Wildlife Reserve</a>
      			<ul class="right hide-on-med-and-down">
        			<li><a href="admin_employee.php">Admin</a></li>
      			</ul>

      			<ul id="nav-mobile" class="side-nav">
        			<li><a href="#">Admin </a></li>
      			</ul>
      			<a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
   			 </div>
  		</nav>
  		 <div class="section no-pad-bot" id="index-banner">
    		<div class="container">
      			<br><br>
      			<h2 class="header center dark green-text">Welcome to Wildlife Reserve Database</h1>
      			<br><br>
      			<div class="row center">
        			<h3 class="header center dark green-text"><b>Please Choose user type</b></h3>
      			</div>
      			<br><br>
			</div>
  		</div>


  		<div class="container">
    <div class="section">

      <!--   Icon Section   -->
      <div class="row">
        <div class="col s12 m4" >
        	<a href="employee_login.php">
          <div class="icon-block" >
            <h2 class="center light-green-text"><i class="large material-icons">person_pin</i></h2>
            <h5 class="center">Employee</h5>

            <p class="light">Employees can View database on animals present and get data specific to their zones. They have the ability to make informed desicions on matters like food consumption feeding hole health and general Environmental Health</p>
          </div>
         </a>
      
        </div>
        <a href="tourist_login.php">
        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center light-green-text"><i class="large material-icons">visibility</i></h2>
            <h5 class="center">Tourist</h5>

            <p class="light">This reserve contains a wealth of flora and fauna which is accessible to tourist. A tourist can get information of the animals in different zones of the Reserve and tailor a journey specific to their needs.</p>
          </div>
        </div>
        </a>

        <a href="vet_login.php">
        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center light-green-text"><i class="large material-icons">assignment_ind</i></h2>
            <h5 class="center">Veterinarian</h5>

            <p class="light">The health and well being are of upmost importance to the Reserve.As a veterinarian you get the latest and most relevant data to make benefical choices with respect to the health of the animals</p>
          </div>
        </div>
        </a>
      </div>
      <br><br>
      <footer class="page-footer dark green">
    <div class="container">
      <div class="row">
        <div class="col l6 s12">
          <h5 class="white-text">Created By:</h5>
          <p class="grey-text text-lighten-4">Vivek R Chettiar (USN:1RV13CS185) <br> Visruth Nair (USN:1RV13CS184)</p>


        </div>
        
      </div>
    </div>
  </footer>






		<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  		<script src="../../bin/materialize.js"></script>
  		<script src="js/init.js"></script>
	</body>
</html>