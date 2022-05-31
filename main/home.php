<?php
echo '<script type="text/javascript">realtimeClock();</script>';
echo '<script type="text/javascript">initClock();</script>';

if ($_SERVER["REQUEST_METHOD"] == "POST"){
  if(isset($_POST['submit'])){
      $url= "http://gatesystemapi.herokuapp.com/api/login/"; // lagay dito si Noel
  //get data from signup form
      $emUs = $_POST['email'];
      $password = $_POST['password'];
      $data =array (
        'username' => $emUs,
        'password' => $password
      );
     // $optional_headers = null;

      //Check for invalid shit 
      if(!empty($emUs) && !empty($password)){
        $postdata = json_encode($data);
        
        $ch = curl_init($url); 
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        $result = curl_exec($ch);
        curl_close($ch);
      //  var_dump($result);
    //    consolelog($result);
      if($result == 200){


      } else{
   
      } 
        } elseif(empty($emUs) && empty($password)){
        header("Location:../index.php?login=incomplete");
        exit();          
      }  elseif(!empty($emUs) && empty($password)){  
        header("Location:../index.php?login=incomplete");
        exit();
      }  else{
          header("Location:../index.php?login=incomplete");
          exit();
             }      
                  
            } else{
           }       
        } else{
        }

      
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE-edge">
	    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Home Page</title>
        <script src="clock.js"></script>
        <link rel="stylesheet" type="text/css" href="hstyle.css">
    </head>
        <body onload="realtimeClock();initClock();">
         <div class="thome"> 
          <nav class="navbar">
            <div class="nav_links">
              <img src="/images/finallogo.png" alt="logo">
                <ul class="list">
                  <li><a href="home.php"`>Home</a></li>
                  <li><a href="/admin/admin.php">Admin Panel</a></li>
                  <li><a href="/student/student.php">User Profile</a></li>
                </ul>
                <a href="/logout/logout.php" class="btn"><button>Logout</button></a>
            </div>
          </nav>
          <div class="content">
            <div class="caption">
              <span class="text-1">Monitor</span><br>
              <span class="text-2">the entry of users</span><br>
              <a href="/entryrecord/entry.php" class="entry"><button>Entry Record</button></a>
            </div>
            <div class="date">
              <span id="dayname">Day</span>,
              <span id="month">Month</span>
              <span id="daynum">00</span>,
              <span id="year">Year</span>
            </div>
            <div class="clock" id="clock"></div>
         </div>
        </body>
</html>


