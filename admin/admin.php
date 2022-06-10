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
                  <table class="user">
                    <?php
                        $url0 = file_get_contents("http://gatesystemapi.herokuapp.com/api/admin/");
                        $file = json_decode($url0);
                        $count = $file -> count;
                        $rlcount = intval($count);

                      foreach($file -> results as $arr) {
                        $username0 = $arr -> username;
                        $email0 = $arr -> email;
                        $id0 = $arr -> id;
                        $user[] = $username0;
                        $id[] = $id0;
                        $email[] = $email0;
                      }

                      $row = 0; 
                      echo "<thead><tr><th>ID</th><th>Admins' username</th><th>E-mail</th><th>Operation</th></tr></thead>";
                        if(!empty($user) && !empty($id) && !empty($email)){
                          while(($rlcount - $row - 1) >= 0){
                            echo "<tr><form method='POST'><td name ='id'>".$id[$count -$row - 1]."</td><td name='users'>".$user[$count -$row - 1]."</td><td name='users'>".$email[$count -$row - 1]."</td><td><button name='submit' value='".$id[$count -$row - 1]."'>Delete</button></td></form></tr>";
                            $row++;
                          }
                            echo "</table>";
                        }

                        if($_SERVER["REQUEST_METHOD"] == "POST"){
                          if(isset($_POST['submit'])){

                            $url = "https://gatesystemapi.herokuapp.com/users/". $_POST['submit']."/";
                            $ch = curl_init();
                            $json = '';
                            curl_setopt($ch, CURLOPT_URL, $url);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
                            curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            $result = curl_exec($ch);
                            $result = json_decode($result);
      
                            // Get the POST request header status
                            $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                            
                            if ( $status != 204 ) {
                              header("Location:../admin/admin.php?delete=error");
                            }
                      
                            if ( $status == 204 ) {
                              //include ikaw ng command para magrefresh yung page.
                              echo "<script type='text/javascript'>
                              window.location.reload(true);
                              </script>";
                            } 
                            curl_close($ch);
                          }
                        }
                        ?>
                  </table>
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
                  <button name='regreg'>Register</button>
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

    /* ----------------------------------------------REGISTER OF USERS------------------------------- */
    if($_SERVER["REQUEST_METHOD"] == "POST"){
      if(isset($_POST['regreg'])){
        $url= "http://gatesystemapi.herokuapp.com/api/admin/register/";
        $user0 = $_POST['username']; /* labas nito is false or true*/
        $email0 =  $_POST['email'];
        $pass = $_POST['password'];

          //Check for invalid shit 
        if(!empty($email0) && !empty($pass) && !empty($email0)){
          // Create a new cURL resource
          $ch = curl_init($url);
    
          // Setup request to send json via POST`
          $payload = json_encode( 
            array(
              'username' => $user0,
              'password' => $pass,
              'email' => $email0
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
            echo "<script type='text/javascript'>
            window.location.reload(true);
            </script>";
            //header("Location:../admin/admin.php");
          } 
    
          // Close cURL resource
          curl_close($ch);
        }
      }
    } 


    ?>
        </body>
</html>
