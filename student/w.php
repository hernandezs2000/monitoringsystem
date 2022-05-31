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
                  <li><a href="student.php">User Profile</a></li>
                </ul>
                <a href="/logout/logout.php" class="btn"><button>Logout</button></a>
            </div>
          </nav>
          
          <div class="container">
            <form action="" method="POST">
              <input type="text" placeholder="search" name="q"></input>
              <button type="submit" name="submit"><img src="/images/search.png"></button>
            </form>
          </div>
          <table class = "table">
          <?php
          $jsonD = file_get_contents("http://gatesystemapi.herokuapp.com/users/"); // json ito
          $stringD = json_decode($jsonD);
          $stringUser = $stringid = $stringemail = array();
          //get number of users
          $count = $stringD -> count;
          $count = intval($count);
          $x=0;

          foreach($stringD -> results as $arr) {
            $username0 = $arr -> username;
            $email0 = $arr -> email;
            $id0 = $arr -> id;
            $user[] = $username0;
            $id[] = $id0;
            $email[] = $email0;
          }


          // pag nag post
          if ($_SERVER["REQUEST_METHOD"] == "POST"){
            if(isset($_POST['submit'])){ 


              if(!empty($_POST['q'])){ // pag may laman ang post
                $post  = $_POST['q'];
                  if(in_array($post, $user)){ // tingnan kung nandun yung user    WOOOW
                    $place = array_search($post, $user); //int na pangilan yung user
                    echo "<thead><tr><th>ID</th><th>Registered User</th><th>E-mail</th</tr></thead>";
                    if(!empty($user) && !empty($id) && !empty($email)){
                       echo "<tr><td><a href = 'w.php?id={$id[$place]}'>".$id[$place]."</a></td><td>".$user[$place]."</td><td>".$email[$place]."</td></tr>";  
                       echo "</table>";
                   }                  
                  } else{ // paghindi nageexist
                    echo "<thead><tr><th>ID</th><th>Registered User</th><th>E-mail</th</tr></thead>";
                    echo "<tr><td>-</td><td>empty</td><td>empty</td</tr>";
                    echo "</table>";

                  }


              } else{ //pag wala laman ang post WOOOW
                    $row = 0; 
                    echo "<thead><tr><th>ID</th><th>Registered User</th><th>E-mail</th</tr></thead>";
                   if(!empty($user) && !empty($id) && !empty($email)){
                    while(($count - $row - 1) >= 0){
                      echo "<tr><td><a href = 'w.php?id={$id[$count -$row - 1]}'>".$id[$count -$row - 1]."</a></td><td>".$user[$count -$row - 1]."</td><td>".$email[$count -$row - 1]."</td></tr>";
                      $row++;
                    }
                      echo "</table>";
                  }
              }
            }


          } else{ //pag walang post WOOOWL
            $row = 0; 
            echo "<thead><tr><th>ID</th><th>Registered User</th><th>E-mail</th</tr></thead>";
           if(!empty($user) && !empty($id) && !empty($email)){
            while(($count - $row - 1) >= 0){
              echo "<tr><td><a href = 'w.php?id={$id[$count -$row - 1]}'>".$id[$count -$row - 1]."</a></td><td>".$user[$count -$row - 1]."</td><td>".$email[$count -$row - 1]."</td></tr>";
              $row++;
            }
              echo "</table>";
          }
          }
         
          ?>
</table>
         </div>
        </body>
</html>