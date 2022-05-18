<?php
echo '<script type="text/javascript">realtimeClock();</script>';
echo '<script type="text/javascript">initClock();</script>';
    ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE-edge">
	    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Home Page</title>
        <script src="clock.js"></script>
        <link rel="stylesheet" type="text/css" href="hstyle.css">
    </head>
        <body onload="realtimeClock();initClock();">
         <div class="thome"> 
          <nav class="navbar">
            <div class="nav_links">
              <img src="/images/finallogo.png" alt="logo">
                <ul class="list">
                  <li><a href="home.php"`>Home</a></li>
                  <li><a href="/admin/admin.php">Admin Panel</a></li>
                  <li><a href="/student/student.php">Student Profile</a></li>
                </ul>
                <a href="#" class="btn"><button>Logout</button></a>
            </div>
          </nav>
          <div class="content">
            <div class="caption">
              <span class="text-1">Monitor</span><br>
              <span class="text-2">the entry of students</span><br>
              <a href="/entryrecord/entry.php" class="entry"><button>Live Entry Record</button></a>
            </div>
            <div class="date">
              <span id="dayname">Day</span>,
              <span id="month">Month</span>
              <span id="daynum">00</span>,
              <span id="year">Year</span>
            </div>
            <div class="clock" id="clock"></div>
         </div>
        </body>
</html>