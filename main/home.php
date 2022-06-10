<?php
echo '<script type="text/javascript">realtimeClock();</script>';
echo '<script type="text/javascript">initClock();</script>';

//----------------------------------------LOGIN POST REQUEST----------------------------------------------------------
if ($_SERVER["REQUEST_METHOD"] == "POST"){
  if(isset($_POST['submit'])){
    $url= "http://gatesystemapi.herokuapp.com/api/admin/login/"; // lagay dito si Noel
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
      // Create a new cURL resource
      $ch = curl_init($url);

      // Setup request to send json via POST`
      $payload = json_encode( 
        array(
          'username' => $emUs,
          'password' => $password
        )
      );

      // Attach encoded JSON string to the POST fields
      curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

      // Set the content type to application/json
      curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json'));

      // Return response instead of outputting
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

      // Execute the POST request
      $result = curl_exec($ch);

      // Get the POST request header status
      $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

      // if you need to process the response from the API further
      $response = json_decode($result, true);

      // If header status is not Created or not OK, return error message
      if ( $status != 200 ) {
        header("Location:../index.php?login=error");
        exit();
      }

      if ( $status == 200 ) {
        header("Location:../main/home.php");
        exit();
      } 

      // Close cURL resource
      curl_close($ch);



    }  else{
      header("Location:../index.php?login=incomplete");
      exit();
    }      
                  
  } 
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
                  <li><a href="/user/user.php">User Profile</a></li>
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


