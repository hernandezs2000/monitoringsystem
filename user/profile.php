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
          <?php
         echo '<script type="text/javascript">idAuth();</script>';
         
         //result ng id number
         $query = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);
         parse_str($query, $result);
         $idnum = intval($result["id"]);
          if($idnum != null){
          
         }
          ?>
          </div>
        </div>

        </body>
</html>