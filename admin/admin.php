<?php


 /*    $url= "http://gatesystemapi.herokuapp.com/api/admins/register/"; // lagay dito si Noel
    //get data from signup form


      //Check for invalid shit 

      // Create a new cURL resource
      $ch = curl_init($url);

      // Setup request to send json via POST`
      $payload = json_encode( 
        array(
          'username' => "bebs",
          'password' => "hello",
          'email' => "sophiag@gmail.com"
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

      // If header status is not Created or not OK, return error message
      if ( $status != 200 ) {
        die("Error: call to URL $url failed with status $status, response $result, curl_error " . curl_error($ch) . ", curl_errno " . curl_errno($ch));
      }

      if ( $status == 200 ) {
        echo "success";
      } 

      // Close cURL resource
      curl_close($ch);

      // if you need to process the response from the API further
      $response = json_decode($result, true);
 */
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE-edge">
	    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Time-in Record</title>
        <link rel="stylesheet" type="text/css" href="h3style.css">
    </head>
        <body>
          <div class="thome"> 
            <nav class="navbar">
              <div class="nav_links">
                <img src="/images/finallogo.png" alt="logo">
                <ul class="list">
                  <li><a href="/main/home.php"`>Home</a></li>
                  <li><a href="admin.php">Admin Panel</a></li>
                  <li><a href="/user/user.php">User Profile</a></li>
                </ul>
                <a href="/logout/logout.php" class="btn"><button>Logout</button></a>
              </div>
            </nav>
            <div class="adminp">
              <div class = "content">

                <div class = btn-card>
                  <div class = "cont"> <!-- center -->
                    <form method = "POST">
                      <button  class="register" name="but" id="show-login" value=1>add authorize users</button>      
                    </form>
                    </div>
                </div>

                <div class="table">  <!-- dito labas yung mga profile card -->
            
                  <div class="user u1">
                    <div class = "upper">
                    </div>
                    <div class = "lower">    
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>
<!-- -----------------------------------------THIS IS MY POPUP FORM------------------- -->
  <?php if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST['but'])){ echo"?>
          <div class ='popup' id='popup'>
            <form class='close' method='POST'>
             <button class='close-btn' name='close'>&times;</button>
            </form>
            <div class='form'>
              <h2>Sign Up</h2>
              <form class='reg' method='POST'>
                <div class='form-element'>
                  <label for='username'>Username</label>
                  <input type='text' id='username' name='username' placeholder='Enter username'>  
                </div>
                <div class='form-element'>
                  <label for='email'>Email</label>
                  <input type='text' id='email' name='email' placeholder='Enter email'>  
                </div>
                <div class='form-element'>
                  <label for='password'>Password</label>
                  <input type='password' id='password' name='password' placeholder='Enter password'>
                </div>
                <div class='form-element'>
                  <button>Register</button>
              </form>
              </div>
            </div>
          </div>
    <?php ";}} ?>
    <?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
      if(isset($_POST['close'])){
        echo "<style>.popup .close-btn{ display: none;}</style>";
      }
    }
    ?>
        </body>
</html>
<script>
    </script>