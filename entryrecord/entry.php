<?php
/* display yung mga values */

$jsonD = file_get_contents("http://gatesystemapi.herokuapp.com/entrance/"); // json ito
$stringD = json_decode($jsonD);
$stringUser = $stringid = $stringemail = array();
//get number of users
$count = $stringD -> count;
$count = intval($count-1);
$results=$stringD -> results;

for($ctr = $count; $ctr <= 0; $ctr--){
  $id = $results[$ctr];  
  print_r($id);
}



?>
<!-- if($id == $idnum){ //condition that shows that gotten value id is equal to the object id        
     $username = $results[$ctr] -> username; // display username
   //ifelse statements that make sure that dec, email, profpic are not null 
   if(!empty($results[$ctr] -> declaration[0])){
     $declaration = $results[$ctr] -> declaration[0]; //url of declaration
   } else{
     echo "no declaration status";
   }
   if(!empty($results[$ctr] -> email)){
     $email = $results[$ctr] -> email; // display email
   } else{
     echo "no email";
   }
 } -->
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE-edge">
	    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Time-in Record</title>
        <link rel="stylesheet" type="text/css" href="h1style.css">
    </head>
        <body>
         <div class="thome"> 
          <nav class="navbar">
            <div class="nav_links">
              <img src="/images/finallogo.png" alt="logo">
                <ul class="list">
                  <li><a href="/main/home.php"`>Home</a></li>
                  <li><a href="/admin/admin.php">Admin Panel</a></li>
                  <li><a href="/user/user.php">User Profile</a></li>
                </ul>
                <a href="/logout/logout.php" class="btn"><button>Logout</button></a>
            </div>
          </nav>
          <div class="recordbg">
          <table class="entrant">
            <tr>
              <th>Name</th>
              <th>Vaccination Status</th>
              <th>Health Declaration</th>
              <th>Temperature, <span>&#176;</span>C</th>
              <th>Date</th>
              <th>Entry</th>
              <th>Denied</th>
            </tr>
            <?php
            
            ?>
          </table>
          </div>
        </div>
        </body>
</html>