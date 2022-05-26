<?php
?>

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
                  <li><a href="student.php">Student Profile</a></li>
                </ul>
                <a href="/logout/logout.php" class="btn"><button>Logout</button></a>
            </div>
          </nav>
          <div class="container">
            <form action="">
              <input type="text" placeholder="search user" name="q"></input>
              <button type="submit"><img src="/images/search.png"></button>
            </form>
          </div>
          <?php
          $stringD = file_get_contents("http://gatesystemapi.herokuapp.com/users/"); // lagay dito si Noel, as of now di pa
          $jsonData = json_decode($stringD, true); //ginawa json to string

          $jsonEmail = $jsonData['results'][0]['email'];;
          echo $jsonData;
          //for login talaga na code

          ?>
          </div>
        </div>

        </body>
</html>