<?php
echo '<script type="text/javascript">realtimeClock();</script>';
echo '<script type="text/javascript">initClock();</script>';


    $url= "http://gatesystemapi.herokuapp.com/api/login/"; // lagay dito si Noel
    //get data from signup form


     // $optional_headers = null;
      //Check for invalid shit 

      // Create a new cURL resource
      $ch = curl_init($url);

      // Setup request to send json via POST`
      $payload = json_encode( 
        array(
          'username' => "apo",
          'password' => "123"
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
        
      echo $status;
        exit();
      }

      if ( $status == 200 ) {
        //$response = json_decode($result, true);
        //print_r($response);
        exit();

      } 

      // Close cURL resource
      curl_close($ch);

      // if you need to process the response from the API further
      

  

?>