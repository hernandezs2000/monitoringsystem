<?php
/* -------------------------------------GET EMAIL,USERNAME DECLARATION, PROFILE PICTURE---------------------------------------------- */
    //result ng id number for new url
      $query = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);
      parse_str($query, $result);
    //gets the id number (string)
      $idnum = $result["id"];
    
    //get info from url such as count and results
      $url = file_get_contents("http://gatesystemapi.herokuapp.com/users/");
      $stringD = json_decode($url);
      $count = $stringD -> count;
      $count = intval($count);
      $results = $stringD -> results;

     for($ctr = 0; $ctr <= $count-1; $ctr++){
       $id = $results[$ctr] -> id;
       if($id == $idnum){ //condition that shows that gotten value id is equal to the object id        
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
      }
     }
/* ---------------------------------------------------------GET FIRST,MID, AND LAST NAME && AGE, VACCINATED, DATEOFENTRY------------------------------------ */
                 //url for declaration
                 $urldec = file_get_contents($declaration); 
                 $urldecr = json_decode($urldec);

                //display first, midn, lastn, age, vacstat, and date of entry
                $firstn = $urldecr -> first_name; 
                $midn = $urldecr -> middle_name;
                $lastn = $urldecr -> last_name;
                $age =  $urldecr -> age;
                $vacstat = $urldecr -> vaccinated;
                $dateoe = $urldecr -> dateOfEntry;
                //change vaccination status to not boolean
                  if($vacstat == 1){
                    $vacstats = "'vaccinated'";
                  } else{
                    if($vacstat== 0){
                      $vacstats = "'not vaccinated'";
                    }
                  }
                //change date format
                $newDate = date("m-d-Y", strtotime($dateoe));  
/* ----------------------------------------------------GET VALUES OF VACCINATION QUESTIONS------------------------------------------------------------------ */
                $fever = $urldecr -> fever;
                $cough = $urldecr -> cough;
                $sorethroat = $urldecr -> sore_throat;
                $headache = $urldecr -> headache;
                $diarrhea = $urldecr -> diarrhea;
                $lossOts = $urldecr -> loss_of_taste_or_smell;
                $dOb = $urldecr -> difficulty_of_breathing;
                $cwc = $urldecr -> contact_with_cvd;
                $top = $urldecr -> traveled_outside_ph;
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE-edge">
	    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Time-in Record</title>
        <link rel="stylesheet" type="text/css" href="h21style.css">
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
            <div class="contparent">
              <!-- ito for container ng profile -->
              <div class="profpic">
                <div class = "card">
                  <div class = "img-bx">
                    <?php
                         for($ctr = 0; $ctr <= $count-1; $ctr++){
                          $id = $results[$ctr] -> id;
                          if($id == $idnum){ //condition that shows that gotten value id is equal to the object id        
                             $username = $results[$ctr] -> username; // display username
                           //ifelse statements that make sure that profpic are not null 
                           if(!empty($results[$ctr] -> profilepicture[0])){
                             $profilepicture = $results[$ctr] -> profilepicture[0]; //url of profile picture
                           } else{
                            echo "<img src='/images/noimage.jpg'>";
                           }
                         }
                        }
                      /* display yung image of the chosen id page*/
                      $urlprofpic = $profilepicture;
                        if(!empty($urlprofpic)){
                          /* get the image inside*/
                          $urlprofp = file_get_contents($urlprofpic); 
                          $urlprofpr = json_decode($urlprofp);
                          $profpic = $urlprofpr -> image; // here is the image link
                          //check if 404
                          $file_headers = @get_headers($profpic);
                          if($file_headers and strpos( $file_headers[0], '404')){
                            echo "<img src='/images/noimage.jpg'>";
                          } else{
                            echo "<img src= $profpic>";    
                          }                          
                        } else{
                          echo "<img src='/images/noimage.jpg'>";
                        }
                    ?>
                  </div>
                  <div class = "content">
                    <div class = "detail">
                      <?php
                        echo "<h2>".$firstn." ".$midn." ".$lastn.", ".$age."<br><span>".$vacstats."</span></h2>"
                      ?>
                      <ul class = "sci">
                        <li><p>Username: </p><?php echo $username;?></li>
                        <li><p>Last entry date: </p><?php echo $newDate;?></li>                        
                        <li><p>Email: </p><?php echo $email;?></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <div class="vaccination">
                <div class = "vcard">
                  <div class = "vcontent">
                    <h3>Update Health Declaration Status</h3>
                      <?php
                      /* YOU'LL BE GETTING THE VALUES OF DEC SAGOT*/
                      ?>
                      <form class = "chck-box" method = "POST">
                        
                        <div class = "q">
                          <h4>Q1: vaccinated</h4>
                            <input type="radio" name="complete" value="true" <?php echo ($vacstat == 1) ? 'checked="checked"' : ''; ?> id="1"/>
                            <label for="1">Yes</label><br>
                            <input type ="radio" name="complete" value="false" <?php echo ($vacstat == "") ? 'checked="checked"' : ''; ?>  id="11"/>
                            <label for="11">No</label>
                        </div>

                        <div class = "q">
                          <h4>Q2: fever</h4>
                           <input type="radio" name="complete2" value="true" <?php echo ($fever == 1) ? 'checked="checked"' : ''; ?> id="2"/>
                            <label for="2">Yes</label><br>
                            <input type ="radio" name="complete2" value="false" <?php echo ($fever == "") ? 'checked="checked"' : ''; ?> id="22"/>
                            <label for="22">No</label>
                        </div>

                        <div class = "q">
                          <h4>Q3: cough</h4>
                            <input type="radio" name="complete3" value="true" <?php echo ($cough == 1) ? 'checked="checked"' : ''; ?>  id="3"/>
                            <label for="3">Yes</label><br>
                            <input type ="radio" name="complete3" value="false" <?php echo ($cough == "") ? 'checked="checked"' : ''; ?> id="33"/>
                            <label for="33">No</label>
                        </div>

                        <div class = "q">
                          <h4>Q4: sore throat</h4>
                           <input type="radio" name="complete4" value="true" <?php echo ($sorethroat == 1) ? 'checked="checked"' : ''; ?>  id="4"/>
                            <label for="4">Yes</label><br>
                            <input type ="radio" name="complete4" value="false" <?php echo ($sorethroat == "") ? 'checked="checked"' : ''; ?> id="44"/>
                            <label for="44">No</label>
                        </div>

                        <div class = "q">
                          <h4>Q5: headache</h4> 
                           <input type="radio" name="complete5" value="true" <?php echo ($headache == 1) ? 'checked="checked"' : ''; ?> id="5"/>
                            <label for="5">Yes</label><br>
                            <input type ="radio" name="complete5" value="false" <?php echo ($headache == "") ? 'checked="checked"' : ''; ?> id="55"/>
                            <label for="55">No</label>
                        </div>

                        <div class = "q">
                          <h4>Q6: diarrhea</h4>
                           <input type="radio" name="complete6" value="true" <?php echo ($diarrhea == 1) ? 'checked="checked"' : ''; ?> id="6"/>
                            <label for="6">Yes</label><br>
                            <input type ="radio" name="complete6" value="false" <?php echo ($diarrhea == "") ? 'checked="checked"' : ''; ?> id="66"/>
                            <label for="66">No</label>
                        </div>

                        <div class = "q">
                          <h4>Q7:  loss of taste or smell</h4>
                            <input type="radio" name="complete7" value="true" <?php echo ($lossOts == 1) ? 'checked="checked"' : ''; ?> id="7"/>
                            <label for="7">Yes</label><br>
                            <input type ="radio" name="complete7" value="false" <?php echo ($lossOts == "") ? 'checked="checked"' : ''; ?> id="77"/>
                            <label for="77">No</label>
                        </div>

                        <div class = "q">
                          <h4>Q8: difficulty of breathing</h4>
                            <input type="radio" name="complete8" value="true" <?php echo ($dOb == 1) ? 'checked="checked"' : ''; ?> id="8"/>
                            <label for="8">Yes</label><br>
                            <input type ="radio" name="complete8" value="false" <?php echo ($dOb == "") ? 'checked="checked"' : ''; ?> id="88"/>
                            <label for="88">No</label>
                        </div>

                        <div class = "q">
                          <h4>Q9: contact with covid</h4>
                            <input type="radio" name="complete9" value="true" <?php echo ($cwc == 1) ? 'checked="checked"' : ''; ?> id="9"/>
                            <label for="9">Yes</label><br>
                            <input type ="radio" name="complete9" value="false" <?php echo ($cwc == "") ? 'checked="checked"' : ''; ?> id="99"/>
                            <label for="99">No</label>
                        </div>

                        <div class = "q">
                          <h4>Q10: travelled outside ph</h4>
                          <input type="radio" name="complete10" value="true" <?php echo ($top == 1) ? 'checked="checked"' : ''; ?> id="10"/>
                            <label for="10">Yes</label><br>
                            <input type ="radio" name="complete10" value="false" <?php echo ($top == "") ? 'checked="checked"' : ''; ?> id="101"/>
                            <label for="101">No</label>
                        </div>

                        <button type = "submit">Save changes</button>
                      </form>
                            <?php
                             /* GET THE VALUES FROM THE FORM*/
                              if ($_SERVER["REQUEST_METHOD"] == "POST"){
                                if(isset($_POST['submit'])){
                                  $one = $_POST['complete'];
                                  $two =  $_POST['complete2'];
                                  $three = $_POST['complete3'];
                                  $four = $_POST['complete4'];
                                  $five = $_POST['complete5'];
                                  $six = $_POST['complete6'];
                                  $seven = $_POST['complete7'];
                                  $eight = $_POST['complete8'];
                                  $nine = $_POST['complete9'];
                                  $ten = $_POST['complete10'];
                                }
                                /* NOW YOU PUT THE PATCH REQUEST TO SEND THE VALUES*/
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
                                    'vaccinated' => $one,
                                    'fever' => $two,
                                    'cough' => $three,
                                    'sore_throat' => $four,
                                    'headache' => $five,
                                    'diarrhea' => $six,
                                    'loss_of_taste_or_smell' => $seven,
                                    'difficulty_of_breathing' => $eight,
                                    'contact_with_cvd' => $nine,
                                    'traveled_outside_ph' => $ten
                                  )
                                );
                                
                                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                                
                                //for debug only!
                                curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
                                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                                
                                $resp = curl_exec($curl);
                                curl_close($curl);

                              }
                            ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </body>
</html>