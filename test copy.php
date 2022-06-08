<?php
/* display yung mga values */

$jsonD = file_get_contents("http://gatesystemapi.herokuapp.com/entrance/"); // json ito
$stringD = json_decode($jsonD);
$stringUser = $stringid = $stringemail = array();
//get number of users
$count = $stringD -> count;
$count = intval($count-1);
$results=$stringD -> results;
echo "<pre>";
print_r($results);
echo "<pre>";
for($ctr = $count; $ctr <= 0; $ctr--){
  $id = $results[$ctr];  
  echo $id;
}



?>