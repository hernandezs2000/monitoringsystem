<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE-edge">
	    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Time-in Record</title>
        <link rel="stylesheet" type="text/css" href="h2style.css">
    </head>
        <body>
         <div class="thome"> 
          <nav class="navbar">
            <div class="nav_links">
              <img src="/images/finallogo.png" alt="logo">
                <ul class="list">
                  <li><a href="/main/home.php"`>Home</a></li>
                  <li><a href="/admin/admin.php">Admin Panel</a></li>
                  <li><a href="user.php">User Profile</a></li>
                </ul>
                <a href="/logout/logout.php" class="btn"><button>Logout</button></a>
            </div>
          </nav>
          <div class="cont2">
               <!-- ito for container ng profile -->

               <?php
              //result ng id number for new url
                 $query = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);
                 parse_str($query, $result);
                 //$idnum = intval($result["id"]);
                 $idnum = $result["id"];


                  $url = file_get_contents("http://gatesystemapi.herokuapp.com/users/");
                  $stringD = json_decode($url);
                  $count = $stringD -> count;
                  $count = intval($count);
                  $results = $stringD -> results;

                 for($ctr = 0; $ctr <= $count-1; $ctr++){
                   $id = $results[$ctr] -> id;
                   if($id == $idnum){
                    //get mo yung email, link for dec and profilepic
                    $email = $results[$ctr] -> email; // I GOT EMAIL NA ***
                    $declaration = $results[$ctr] -> declaration[0];
                    $profilepicture = $results[$ctr] -> profilepicture[0];
                  }
                 }

                 //pasok dec
                 $urldec = file_get_contents($declaration); 
                 $urldecr = json_decode($urldec);


                //got them all na *** 
                $firstn = $urldecr -> first_name; 
                $midn = $urldecr -> middle_name;
                $lastn = $urldecr -> last_name;
                $age =  $urldecr -> age;
                $vacstat = $urldecr -> vaccinated;

                //paso profpic
                $urlprofp = file_get_contents($profilepicture); 
                $urlprofpr = json_decode($urlprofp);
                $profpic = $urlprofpr -> image;

              ?>
            <div class="contpic">
              <!-- container ng prof and profinfo -->
              <div class="profile"></div>   <!-- profile -->
              <div class="profinfo"></div>   <!-- prof info--> 
            </div>
            <div class="vaccination">
            // <button class="save">Save edit</button> 
             <?php 
            

//---------------------------------------------------------------------------------------PATCH***********keri na
/*          
            $curl = curl_init($declaration);
            curl_setopt($curl, CURLOPT_URL, $declaration);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PATCH');
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            
            $headers = array(
               "Accept: application/json",
               "Content-Type: application/json",
            );
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            
            $data= json_encode( 
              array(
                'vaccinated' => false,
                'fever' => false,
              )
            );
            
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            
            //for debug only!
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            
            $resp = curl_exec($curl);
            curl_close($curl);
 */

             ?>
            </div>
          </div>
        </div>

        </body>
</html>