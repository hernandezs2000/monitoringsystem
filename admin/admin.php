<?php
    $url= "http://gatesystemapi.herokuapp.com/api/register/"; // lagay dito si Noel
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
            <button name="register">Add</button>      
          </div>
        </div>

        </body>
</html>