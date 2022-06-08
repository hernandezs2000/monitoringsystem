<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE-edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
        <link rel="stylesheet" type="text/css" href="tstyle.css">
    </head>
    <body>
    <table class = "table">
    <?php
        /* display yung mga values */

        $jsonD = file_get_contents("http://gatesystemapi.herokuapp.com/entrance/"); // json ito
        $stringD = json_decode($jsonD);
        $stringUser = $stringid = $stringemail = array();
        //get number of users
        $count = count($stringD);
        $countr = $count -1;


        for($ctr = $countr; $ctr >= 0; $ctr--){
            $temp0 = $stringD[$ctr] -> temp;
            $allowed0 = $stringD[$ctr] -> allowed;
            $datetime0 = $stringD[$ctr] -> date;
            $usrid0 = $stringD[$ctr] -> usrid;
            $temp[] = $temp0; //temperature FINAL 
            $allowed[] = $allowed0; //
            $datetime[] = $datetime0; 
            $date[] = substr($datetime[$ctr0],0,10); // DATE FINAL
            $time[] = substr($datetime[$ctr0],11,19); // TIME FINAL
            $usrid[] = $usrid0; // id number FINAL
        }

        $idcount = count($usrid);
        $rlidc = $idcount - 1; /* number of user sa array -1 nung usrid*/
        $username = $vacstat = $stat = array();
            for ($ctr0 = 0; $ctr0 <= $rlidc; $ctr0++){
                $file1 = file_get_contents("https://gatesystemapi.herokuapp.com/users/".$usrid[$ctr0]."/");
                $filer1 = json_decode($file1);
                $getdec = $filer1 -> declaration[0]; /* NAKUHA KO URL NA NEED KO TALAGA TO GET INFO  ABOUT EMAIL AND DECLARATION*/
                $file2 = file_get_contents($getdec);
                $filer2 = json_decode($file2);
                $username0 = $filer2 -> owner;
                $vacstat0 = $filer2 -> vaccinated; /* naka true, boolean */
                $stat0 = $filer2 -> stat;
                $username[] = $username0; //username FINAL
                $vacstat[] = $vacstat0;  // Vaccination status FINAL
                $stat[] = $vacstat0; // HEALTH DEC FINAL
            }
        //needed values Name	Vaccination Status	Health Declaration	Temperature, °C	Date	Entry	Denied
        // /entrance/ - temp,allowed,time,date, userid

        $allowcount = count($stat);
        $rlallow = $allowcount - 1; /* number of user sa array -1 nung usrid*/
        $entry = $denied = array();
            for ($ctr0 = 0; $ctr0 <= $rlallow; $ctr0++){
                if($allowed[$ctr0] = true){ //I HAVE ALLOWED NA FINAL
                    $entry[] = $allowed[$ctr0];
                    $denied[] = ""; 
                } else {
                    if($allowed[$ctr0] = false){
                        $entry[] = "";
                        $denied[] = $allowed[$ctr0]; 
                }
                }
            }
        $row = 0; 
            echo "<thead><tr><th>ID</th><th>Username</th><th>Vaccination status</th><th>Health Declaration</th><th>Temperature, °C</th><th>Date</th><th>Entry</th><th>Denied</th></tr></thead>";
                while(($countr - $row - 1) >= 0){
                echo "<tr><td><a href = '/user/profile.php?id={$usrid[$countr -$row - 1]}'  name ='usrid'>".$usrid[$countr -$row - 1]."</a></td><td name='username'>".$username[$countr -$row - 1]."</td><td name='vacstat'>".$vacstat[$countr -$row - 1]."</td><td>".$stat[$countr -$row - 1]."</td><td>".$temp[$countr -$row - 1]."</td><td>".$date[$countr -$row - 1]."</td><td>".$time[$countr -$row - 1]."</td><td>".$entry[$countr -$row - 1]."</td><td>".$denied[$countr -$row - 1]."<td></tr>";
                $row++;
                }
            echo "</table>"; 

        ?>
    </table>
    </body>
</html>


//----------------------------------------REGISTER POST REQUEST----------------------------------------------------------
if ($_SERVER["REQUEST_METHOD"] == "POST"){
  if(isset($_POST['submit'])){
    $url= "http://gatesystemapi.herokuapp.com/api/register/"; // lagay dito si Noel
    //get data from signup form
    $emUs = $_POST['email'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    $data =array (
      'username' => $emUs,
      'password' => $password,
      'email' => $email
    );
     // $optional_headers = null;
      //Check for invalid shit 
    if(!empty($emUs) && !empty($password) && !empty($email)){
      // Create a new cURL resource
      $ch = curl_init($url);

      // Setup request to send json via POST`
      $payload = json_encode( 
        array(
          'username' => $emUs,
          'password' => $password,
          'email' => $email
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
        //include ikaw ng command para magrefresh yung page.

        header("Location:../admin/admin.php");
      } 

      // Close cURL resource
      curl_close($ch);

      // if you need to process the response from the API further
      $response = json_decode($result, true);

    }  else{
      header("Location:../index.php?login=incomplete");
      exit();
    }      
                  
  } else{
  }       
}

//----------------------------------------USER DELETE REQUEST----------------------------------------------------------

if ($_SERVER["REQUEST_METHOD"] == "DELETE"){
  if(isset($_POST['Delete'])){
    $url= `http://gatesystemapi.herokuapp.com/users/${id}`; // lagay dito si Noel
    
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

      // If header status is not Created or not OK, return error message
      if ( $status != 204 ) {
        die("Error: call to URL $url failed with status $status, response $result, curl_error " . curl_error($ch) . ", curl_errno " . curl_errno($ch));
      }

      if ( $status == 204 ) {
        die("User deleted.");
      } 

      // Close cURL resource
      curl_close($ch);

      // if you need to process the response from the API further
      $response = json_decode($result, true);
  }      
}

//----------------------------------------USER PATCH REQUEST----------------------------------------------------------
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

      // If header status is not Created or not OK, return error message
      if ( $status != 200 ) {
        die("Error: call to URL $url failed with status $status, response $result, curl_error " . curl_error($ch) . ", curl_errno " . curl_errno($ch));
      }

      if ( $status == 200 ) {
        header("Location:../main/home.php");
      } 

      // Close cURL resource
      curl_close($ch);

      // if you need to process the response from the API further
      $response = json_decode($result, true);

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
  }      
}