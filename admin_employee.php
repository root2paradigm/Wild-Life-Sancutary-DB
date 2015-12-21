<!DOCTYPE html>

<html>
  <head>
     <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
    <title>WildLife Reserve Login</title>


    <script type="text/javascript" src="js/employee_main_js.js"></script>
    <fnk href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="css/employee_animals_style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  </head>
  <body>
    
    <nav class="red darken-1" role="navigation">
        <div class="nav-wrapper container"><a id="logo-container" href="#" class="brand-logo">Manage Employees</a>
            
            <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
         </div>
         
      </nav>
      <ul id="nav-mobile" class="side-nav fixed" style="width: 240px;">
        <li class="green darken-3"><img id="logo" src="resource/logo2.png" style="margin-left:auto"></li>
        <li class="bold"><a href="admin_employee.php" class="waves-effect waves-green">Manage Employee</a></li>
        
      </ul>
      <script type="text/javascript">
        function validatenew(){

        var form = document.forms["newemp"];
        var eid = form["eid"].value;
        var name = form["name"].value;
        var zone = form["zone"].value;
        var salary = form["salary"].value;
        var job = form["job"].value;
        
        if(eid==""||eid==null)
        {
          alert("Please Enter Employee ID");
          return false;
        }
          if(name==null||name=='')
        {
          alert("Please Enter Name");
          return false;
        }
         if(zone==null||zone=='')
        {
          alert("Please Selete Zone");
          return false;
        }
         if(salary==null||zone=='')
        {
          alert("Please Enter Salary");
          return false;
        }
        if(salary<1)
        {
          alert("Please Valid Salary");
          return false;
        }
         if(job==null||job=='')
        {
          alert("Please Enter Job");
          return false;
        }
          if(age==null||age=='')
        {
          alert("Please Enter Age");
          return false;
        }
           if(age=<15||age>70)
        {
          alert("Please Valid Age");
          return false;
        }

          if(password==null||password=='')
        {
          alert("Please Enter Job");
          return false;
        }
        alert("All good!");
        return true;
      }
      </script>
      <?php
      session_start();
      $current_user=$_SESSION['login_user'];
      $connection = mysql_connect("localhost", "root", "");
      $db = mysql_select_db("wildlife", $connection);
      if(isset($_POST["new_emp"]))
      {
        $eid = $_POST["eid"];
         $name = $_POST["name"];
          $salary = $_POST["salary"];
           $job = $_POST["job"];
            $zone= $_POST["zone"];
              $age = $_POST["age"];
              $password =$_POST["password"];
              $result = mysql_query("SELECT * FROM employee WHERE employee.eid = '$eid'");
              $num_rows = mysql_num_rows($result);

              if($num_rows)
              {
                echo "<script>alert('Entry Already Exists');</script>";
              }
              else{
       $result = mysql_query("INSERT INTO `employee`(`EID`, `Age`, `Salary`, `Name`, `Job_profile`, `Zone`, `Password`) VALUES ('$eid',$age,'$salary','$name','$job','$zone','$password')", $connection);
        }
      }
      

     if(isset($_POST["edit_emp"]))
      {
          $current_user = $_POST["eid"];
         $name = $_POST["name"];
          $salary = $_POST["salary"];
           $job = $_POST["job"];
            if(!empty($name))
          {
            mysql_query("UPDATE `employee` SET Name='$name' WHERE EID = '$current_user'  ", $connection);
          }
          if(!empty($salary))
          {
            mysql_query("UPDATE `employee` SET Salary='$salary' WHERE EID = '$current_user'  ", $connection);
          }
          if(!empty($salary))
          {
            mysql_query("UPDATE `employee` SET Job_profile='$job' WHERE EID = '$current_user'  ", $connection);
          }
          if(!empty($salary))
          {
            mysql_query("UPDATE `employee` SET Zone='$zone' WHERE EID = '$current_user'  ", $connection);
          }
        
      }
      if(isset($_POST["job_delete"]))
      {
        $dumpjob = $_POST["jid"];
       
        mysql_query("DELETE FROM current_job WHERE Job_ID='$dumpjob'", $connection);
      }
      if(isset($_POST["filter"]))
      {
        $min =  $_POST["minsal"];
        $max =  $_POST["maxsal"];
        $result = mysql_query("SELECT * FROM employee WHERE employee.salary>$min AND employee.salary<$max", $connection);
      }
      else{
      $result = mysql_query("SELECT * FROM employee", $connection);
    }
      $emparray = array();
        while($row =mysql_fetch_assoc($result))
        {
            $emparray[] = $row;
        }

      $resultjson = json_encode($emparray);


       $zoneresult = mysql_query("SELECT * FROM zone", $connection);
      $zonearray = array();
        while($row =mysql_fetch_assoc($zoneresult))
        {
            $zonearray[] = $row;
        }

      $zonejson = json_encode($zonearray);
      echo "<script> var animals = JSON.parse('$resultjson') </script>";
    ?>
  <br><br>
    <div class="container">
      <div class="section">
      <h1 class="green-text darken-2">Employees</h1>
       <ul class="collection">
      <li class="collection-header">
       <div class="row">
        <div></div>
       </div>
      </li>
      <li class="collection-item">
        <div class="row">
          <div class="col s1 green-text darken-2">
            <b>Emp ID</b>
          </div>
          <div class="col s1 green-text darken-2">
            <b>Name</b>
          </div>
          <div class="col s1 green-text darken-2">
            <b>Age</b>
          </div>
          <div class="col s1 green-text darken-2">
            <b>Zone</b>
          </div>
          <div class="col s1 green-text darken-2">
            <b>Salary</b>
          </div>
          <div class="col s1 green-text darken-2">
            <b>Job Profile</b>
          </div>
          <form action='admin_employee.php' method='post'>
              <div class='col s1 offset-s3' >
               <a class='waves-effect waves-light red btn modal-trigger' href='#newmodal'>New</a>
              </div>

          </form>
          <form action='admin_employee.php' method='post'>
              <div class='col s1 ' >
               <a class='waves-effect waves-light red btn modal-trigger' href='#filtermodal'>Filter</a>
              </div>

          </form>
          
        </div>
      </li>
      <?php
        $temp=0;
        foreach($emparray as $row){
            $eid = $row["EID"];
            $name = $row["Name"];
            $age = $row["Age"];
            $zone = $row["Zone"];
            $salary = $row["Salary"];
            $job = $row["Job_profile"];
            $temp2 = "";
            foreach ($zonearray as $key) {
                            $lol = $key['ZID'];
                            $temp2 =$temp2."<option value='$lol'>$lol</option>";
                          }

            echo "<li class='collection-item'>
            <div class='row'>
              <div class='col s1 darken-2'>
                <b>$eid</b>
              </div>
              <div class='col s1 darken-2'>
                <b>$name</b>
              </div>
              <div class='col s1 darken-2'>
                <b>$age</b>
              </div>
               <div class='col s1 darken-2'>
                <b>$zone</b>
              </div>
               <div class='col s1 darken-2'>
                <b>$salary</b>
              </div>
              
               <div class='col s1 darken-2'>
                <b>$job</b>
              </div>
              <form action='employee_jobprofile.php' method='post'>
              <div class='col s1 offset-s3' >
               <a class='waves-effect waves-light red btn modal-trigger' href='#editmodal$temp'>Edit</a>
               <input name='eid' value='$eid' type='hidden'/>
              </div>

          </form>
          <div class='col s1' >
               <a class='waves-effect waves-light red btn modal-trigger' href='#jobmodal$temp'>Add Job</a>
               <input name='eid' value='$eid' type='hidden'/>
              </div>

          </form>

          
              
            </div>

          </li>
            <div id='editmodal$temp' class='modal'>
              <div class='modal-content'>
                <h4>Edit Employee</h4>
                <form name='editemp$temp' action='admin_employee.php' onsubmit='return validateedit()' method='post'>
                      <input name='eid' value='$eid' type='hidden'/>
                      <div class='row'>
                          <span class='col s6'><h5>Name</h5></span>
                           <div class='input-field col s6 ' >
                              <input id='name' type='text'  name='name'>
                              <label for='name'>$name</label>
                          </div>
                      </div>
                      <div class='row'>
                          <span class='col s6'><h5>Zone</h5></span>
                          <div class='col s6'>
                  
                   <div class='input-field col s12'>
                      <select  name='zone'>
                        <option value='0' disabled selected>Choose your option</option>
                        $temp2
                      </select>
                      <label class='black-text safari'>Select Zone</label>
                    </div>
                </div>
                      </div>
                      <div class='row'>
                          <span class='col s6'><h5>Salary</h5></span>
                          <div class='input-field col s6 ' >
                              <input id='salary' type='text'  name='salary'>
                              <label for='salary'>Rs.$salary</label>
                          </div>
                      </div>
                      <div class='row'>
                          <span class='col s6'><h5>Job</h5></span>
                          <div class='input-field col s6 ' >
                              <input id='job' type='text'  name='job'>
                              <label for='job'>$job</label>
                          </div>
                      </div>

                       <div class='row'>
                        <div class='col offset-s8'>
                        <button class='waves-effect green darken-2 center waves-light btn' type='submit' name='edit_emp'><span class='white-text'>Save changes</span></button>
                        </div>
                      </div>

                      </form>
              </div>
            </div>
             <div id='jobmodal$temp' class='modal'>
              <div class='modal-content'>
                <h4>Add job</h4>
                <form name='job$temp' action='admin_employee.php' onsubmit='return validateedit()' method='post'>
                      <input name='eid' value='$eid' type='hidden'/>
                      <div class='row'>
                          <span class='col s6'><h5>Job ID</h5></span>
                           <div class='input-field col s6 ' >
                              <input id='jobid' type='text'  name='jobid'>
                              <label for='name'>Eg. JOBNC45</label>
                          </div>
                      </div>
                      <div class='row'>
                          <span class='col s6'><h5>Job Description</h5></span>
                          <div class='input-field col s6 ' >
                              <input id='jobdes' type='text'  name='jobdes'>
                              <label for='salary'>Eg. Put of fire</label>
                          </div>
                      </div>
                      <div class='row'>
                          <span class='col s6'><h5>JDuratio</h5></span>
                          <div class='input-field col s6 ' >
                              <input id='duration' type='text'  name='duration'>
                              <label for='job'>Eg. 4 (Hours)</label>
                          </div>
                      </div>

                       <div class='row'>
                        <div class='col offset-s8'>
                        <button class='waves-effect green darken-2 center waves-light btn' type='submit' name='newjob'><span class='white-text'>Save changes</span></button>
                        </div>
                      </div>
                      </form>
              </div>
            </div>

            ";
            $temp=$temp+1;}
      ?>
    </ul>
    <!-- Modal Structure -->
    </div>
    </div>



            <div id='newmodal' class='modal'>
              <div class='modal-content'>
                <h4>New Employee</h4>
                <form name='newemp' action='admin_employee.php' onsubmit='return validatenew()' method='post'>
                      <div class='row'>
                          <span class=' col s6'><h5 style='margin= 5px'>Employee ID</h5></span>
                          <div class='input-field col s6 ' >
                              <input  type='text'  name='eid'>
                              <label for='eid'>Eg. 1JC1001</label>
                          </div>
                      </div>
                      <div class='row'>
                          <span class='col s6'><h5>Name</h5></span>
                           <div class='input-field col s6 ' >
                              <input id='name' type='text'  name='name'>
                              <label for='name'>Eg. John Smith</label>
                          </div>
                      </div>
                      <div class='row'>
                          <span class='col s6'><h5>Zone</h5></span>
                          <div class="col s6">
                  
                   <div class="input-field col s12">
                      <select  name="zone">
                        <option value="0" disabled selected>Choose your option</option>
                        <?php 
                          foreach ($zonearray as $key) {
                            $lol = $key["ZID"];
                            echo "<option value='$lol'>$lol</option>";
                          }
                        ?>
                      </select>
                      <label class="black-text safari">Select Zone</label>
                    </div>
                </div>
                      </div>
                      <div class='row'>
                          <span class='col s6'><h5>Salary</h5></span>
                          <div class='input-field col s6 ' >
                              <input id='salary' type='text'  name='salary'>
                              <label for='salary'>Rs.</label>
                          </div>
                      </div>
                      <div class='row'>
                          <span class='col s6'><h5>Age</h5></span>
                          <div class='input-field col s6 ' >
                              <input id='age' type='text'  name='age'>
                              <label for='age'>46</label>
                          </div>
                      </div>
                      <div class='row'>
                          <span class='col s6'><h5>Password</h5></span>
                          <div class='input-field col s6 ' >
                              <input id='password' type='text'  name='password'>
                              <label for='password'>Eg. chocolate123</label>
                          </div>
                      </div>
                      <div class='row'>
                          <span class='col s6'><h5>Job</h5></span>
                          <div class='input-field col s6 ' >
                              <input id='job' type='text'  name='job'>
                              <label for='job'>Eg. Feeder</label>
                          </div>
                      </div>

                       <div class='row'>
                        <div class='col offset-s8'>
                        <button class='waves-effect green darken-2 center waves-light btn' type='submit' name='new_emp'><span class='white-text'>Create</span></button>
                        </div>
                      </div>
                      </form>
              </div>
            </div>

            <div id='filtermodal' class='modal'>
              <div class='modal-content'>
                <h4>New Employee</h4>
                <form name='filter' action='admin_employee.php' onsubmit='return validatenew()' method='post'>
                      <div class='row'>
                          <span class=' col s6'><h5 style='margin= 5px'>Min Salary</h5></span>
                          <div class='input-field col s6 ' >
                              <input  type='text'  name='minsal'>
                              <label for='minsal'></label>
                          </div>
                      </div>
                      <div class='row'>
                          <span class='col s6'><h5>Max Salary</h5></span>
                           <div class='input-field col s6 ' >
                              <input id='maxsal' type='text'  name='maxsal'>
                              <label for='maxsal'></label>
                          </div>
                      </div>
                  
                        <div class='row'>
                        <div class='col offset-s8'>
                        <button class='waves-effect green darken-2 center waves-light btn' type='submit' name='filter'><span class='white-text'>Filter</span></button>
                        </div>
                      </div>
                      </form>
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
  <script type="text/javascript">
       $(document).ready(function() {
    $('select').material_select();
  });
    </script>
  </body>
</html>





           
