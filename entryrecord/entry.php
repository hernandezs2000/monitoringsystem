<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE-edge">
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
                /* display yung mga values */
                $jsonD = file_get_contents("http://gatesystemapi.herokuapp.com/tenentrance/"); // json ito
                $stringD = json_decode($jsonD);
                $allowed = $temp = $usrid = $datetime = $date = $time = array();
                //get number of users
                $count = count($stringD);
                $countr = $count - 1;

                for($ctr = 0; $ctr <= $countr; $ctr++){
                    $temp0 = $stringD[$ctr] -> temp;
                    $allowed0 = $stringD[$ctr] -> allowed;
                    $datetime0 = $stringD[$ctr] -> datetime;
                    $usrid0 = $stringD[$ctr] -> usrid;
                    $temp[] = $temp0; //temperature FINAL 
                    $allowed[] = $allowed0; 
                    $date0 = substr($datetime0,0,10); // DATE FINAL
                    $time0 = substr($datetime0,11,-13); // TIME FINAL
                    $date[] = $date0;
                    $time[] =$time0;
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
                        $stat[] = $stat0; // HEALTH DEC FINAL
                    }
                $allowcount = count($stat);
                $rlallow = $allowcount - 1; /* number of user sa array -1 nung usrid*/
                $entry = $denied = array();
                    for ($ctr0 = 0; $ctr0 <= $rlallow; $ctr0++){
                        if($allowed[$ctr0] == 1){ //I HAVE ALLOWED NA FINAL
                            $entry[] = $time[$ctr0];
                            $denied[] = ""; 
                        } else {
                            $entry[] = "";
                            $denied[] = $time[$ctr0]; 
                    }
                    }
                    
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
                    echo "<thead><tr><th>ID</th><th>Username</th><th>Vaccination status</th><th>Health Declaration</th><th>Temperature, °C</th><th>Date</th><th>Entry</th><th>Denied</th></tr></thead>";
                        while(($countr - $row - 1) >= 0){
                            echo "<tr><td>".$usrid[$countr -$row - 1]."</td><td name='username'>".$username[$countr -$row - 1]."</td><td name='vacstat'>".$vacstat2[$countr -$row - 1]."</td><td>".$stat3[$countr -$row - 1]."</td><td>".$temp[$countr -$row - 1]."</td><td>".$date[$countr -$row - 1]."</td><td>".$entry[$countr -$row - 1]."</td><td>".$denied[$countr -$row - 1]."<td></tr>";
                            $row++;
                        }
                            echo "</table>"; 
header("Refresh:3");
                ?>
            </table>
          </div>
        </body>
</html>

