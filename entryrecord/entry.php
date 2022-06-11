<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE-edge">
        <meta http-equiv="refresh" content="2">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Time-in Record</title>
        <script src="clock.js"></script>
        <link rel="stylesheet" type="text/css" href="h1style.css">
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
            <table class = "table">
                <?php
                /* -------------------------------------------------DISPLAY YUNG NECESSARY VALUES IN A LOOP ---------------------------------------- */
                /* get the information in the tenentrance */
                $jsonD = file_get_contents("http://gatesystemapi.herokuapp.com/tenentrance/"); // json ito
                $stringD = json_decode($jsonD);
                $count = count($stringD);
                $countr = $count - 1;
                /* get all values in the tenentrance */
                $usrid = array();
                for($ctr = 0; $ctr <= $countr; $ctr++){
                    $temp0 = $stringD[$ctr] -> temp;
                    $allowed0 = $stringD[$ctr] -> allowed;
                    $datetime0 = $stringD[$ctr] -> datetime;
                    $usrid0 = $stringD[$ctr] -> usrid;
                    $temp[] = $temp0; //temperature 
                    $allowed[] = $allowed0; 
                    $date0 = substr($datetime0,0,10); // DATE 
                    $time0 = substr($datetime0,11,-13); // TIME 
                    $date[] = $date0;
                    $time[] =$time0;
                    $usrid0 = $stringD[$ctr] -> usrid;
                    $usrid[] = $usrid0; // id number displayed in tenentrance
                }
                /* get the information in admins */
                $jsonD0 = file_get_contents("https://gatesystemapi.herokuapp.com/api/admin/"); // json ito
                $stringD0 = json_decode($jsonD0);
                $results = $stringD0 -> results;              
                $count0 = count($results);
                $countr0 = $count0 - 1;
                $adminid = array();
                for($ctr = 0; $ctr <= $countr0; $ctr++){
                    $adid = $results[$ctr] -> id;
                    $adminid[] = $adid; // admin id are stored here
                }
                $num = count($adminid);
                /* Search for admin placement */
                for($ctr0 = 0; $ctr0 <= $num -1; $ctr0++){
                $key[] = array_search($adminid[$ctr0], $usrid);
                    if($key[$ctr0] == 1){
                        unset($temp[$ctr0]);
                        unset($allowed[$ctr0]);
                        unset($date[$ctr0]);
                        unset($time[$ctr0]);
                        $temp = array_values($temp);
                        $allowed = array_values($allowed);
                        $date = array_values($date);
                        $time = array_values($time);
                    }
                }   
                /* get ko yung id and neglect admin and non existing IDs */
                /* After, display mo yung mga information of the users only! */
                $idcount = count($usrid);
                $rlidc = $idcount - 1; /* number of user sa array -1 nung usrid*/
                $adminless =  array();
                for ($ctr0 = 0; $ctr0 <= $rlidc; $ctr0++){ 
                    if(!in_array($usrid[$ctr0], $adminid)){
                        $adminless[] = $usrid[$ctr0]; // id in tententrance that are doesn't include the admin
                    }
                }
                
                /* Get information from the /users/*/
                $jsonD1 = file_get_contents("https://gatesystemapi.herokuapp.com/users/"); // json ito
                $stringD1 = json_decode($jsonD1);
                $results0 = $stringD1 -> results;
                $count1 = count($results0);
                $countr1 = $count1 - 1;
                $userid = array();
                for($ctr = 0; $ctr <= $countr1; $ctr++){
                    $userid0 = $results0[$ctr] -> id;
                    $userid[] = $userid0; // user id are stored here
                }

                $num1 = count($adminless);
                /* Search for admin placement */
                for($ctr0 = 0; $ctr0 <= $num1 -1; $ctr0++){
                $key1[] = array_search($adminless[$ctr0], $userid);
                    if($key1[$ctr0] == 0){
                        unset($temp[$ctr0]);
                        unset($allowed[$ctr0]);
                        unset($date[$ctr0]);
                        unset($time[$ctr0]);
                        $temp = array_values($temp);
                        $allowed = array_values($allowed);
                        $date = array_values($date);
                        $time = array_values($time);
                    }  
                }


                /* Make a loop that makes sure that $adminless are all existing users through checking /users/ */
                $count2 = count($adminless);
                $countr2 = $count2 - 1;
                for ($ctr0 = 0; $ctr0 <= $countr2; $ctr0++){ 
                    if(in_array($adminless[$ctr0], $userid)){
                        $userless[] = $adminless[$ctr0]; // FINAL users to display in the entry record
                    }
                }

                /* Im gonna get the image from /users/ */
                $count3 = $stringD1 -> count;
                $count3 = intval($count3);
                $count4 = count($userless);
                $countr4 = $count4 - 1;

                for($ctr0 = 0; $ctr0 <= $countr4; $ctr0++){
                   // $id = $results0[$ctr0] -> id;
                    $key2[] = array_search($userless[$ctr0], $userid);
                            $i = array_search($userless[$ctr0], array_keys($userid));
                            $profilepicture = $results0[$i] -> profilepicture[0]; //url of profile picture
                            $urlprofpic = $profilepicture;
                            /* get the image inside*/
                            $urlprofp = file_get_contents($urlprofpic); 
                            $urlprofpr = json_decode($urlprofp);
                            $profpic = $urlprofpr -> image;// here is the image link
                            /* check if 404 */

                                $file_headers = @get_headers($profpic);
                                    if($file_headers and strpos( $file_headers[0], '404')){
                                        $picture[] = "<img src='/images/noimage.jpg'>";
                                    } else{
                                        $picture[] = "<img src= $profpic>";    //the pictures are showing na
                                    }
                                    $picture = array_values($picture);
                                                
                }
               

                /* Get the necessary information in the tenentrance using the $userlessa arrays */



                /* Get the other informations linked doon kay id  */
                $username = $vacstat = $stat = array();
                for($ctr = 0; $ctr <= $countr4; $ctr++){
                    $file1 = file_get_contents("https://gatesystemapi.herokuapp.com/users/".$userless[$ctr]."/");
                    $filer1 = json_decode($file1);
                    $getdec = $filer1 -> declaration[0]; /* NAKUHA KO URL NA NEED KO TALAGA TO GET INFO  ABOUT EMAIL AND DECLARATION*/
                    $file2 = file_get_contents($getdec);
                    $filer2 = json_decode($file2);
                    $username0 = $filer2 -> owner;
                    $vacstat0 = $filer2 -> vaccinated; /* naka true, boolean */
                    $stat0 = $filer2 -> stat;
                    $username[] = $username0; //username FINAL
                    $vacstat[] = $vacstat0;  // Vaccination status FINAL
                    $stat[] = $stat0; // HEALTH DEC FINAL
                }

                /* Im gonna display the entry and denied using ALLOWED */
                $allowcount = count($allowed); /* --------BALIKAN MO ITO KASI NAKA STAT ITO DATI------ */
                $rlallow = $allowcount - 1;
                $entry = $denied = array();
                    for ($ctr0 = 0; $ctr0 <= $rlallow; $ctr0++){
                        if($allowed[$ctr0] == 1){ 
                            $entry[] = $time[$ctr0];
                            $denied[] = ""; 
                        } else {
                            $entry[] = "";
                            $denied[] = $time[$ctr0]; 
                        }
                    }

                /* Im gonna display vaccinated or not using vacstat */
                $vaccount = count($vacstat);
                $rlvac = $vaccount - 1; /* number of user sa array -1 nung usrid*/
                $vacstat2 = array();
                    for ($ctr0 = 0; $ctr0 <= $rlvac; $ctr0++){
                        if($vacstat[$ctr0] == 1){
                            $vacstat[$ctr0] = "Vaccinated";
                        } else{
                            $vacstat[$ctr0] = "Not accinated";
                        }
                        $vacstat2[] = $vacstat[$ctr0];
                    }
                
                /* I'm gonna display the OK or NOT using stat */
                $statcount = count($stat);
                $rlstat = $statcount - 1; /* number of user sa array -1 nung usrid*/
                $stat3 = array();
                    for ($ctr0 = 0; $ctr0 <= $rlstat; $ctr0++){
                        if($stat[$ctr0] == 1){
                            $stat[$ctr0] = "OK";
                        } else{
                            $stat[$ctr0] = "NOT";
                        }
                        $stat3[] = $stat[$ctr0];
                    }

                    $row = 0; 
                    echo "<thead><tr><th>ID</th><th>Image</th><th>Username</th><th>Vaccination status</th><th>Health Declaration</th><th>Temperature, °C</th><th>Date</th><th>Entry</th><th>Denied</th></tr></thead>";
                        while($row <= $countr4){
                            echo "<tr><td>".$userless[$row]."</td><td><div name='pic'>".$picture[$row]."</div></td><td name='username'><a href = '/user/profile.php?id={$userless[$row]}'  name ='id'>".$username[$row]."</a></td><td name='vacstat'>".$vacstat2[$row]."</td><td>".$stat3[$row]."</td><td>".$temp[$row]."</td><td>".$date[$row]."</td><td>".$entry[$row]."</td><td>".$denied[$row]."<td></tr>";
                            $row++;
                        }
                            echo "</table>"; 
                ?>
            </table>
          </div>
        </body>
</html>


