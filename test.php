<?php
//needed values Name	Vaccination Status	Health Declaration	Temperature, °C	Date	Entry	Denied
// /entrance/ - temp,allowed,time,date, userid



$id = "5";
$url1 = file_get_contents("https://gatesystemapi.herokuapp.com/entrance/?page=".$id."");
//print_r($url1); //this shows the content in json, not yet in string.






/* this is  */
$url = "https://gatesystemapi.herokuapp.com/entrance/?page=5";
$word = basename($url,"?page=");
//$random = $word[6]; /* This shows the number 5 */





//check if the url exist

/* $file = 'https://gatesystemapi.herokuapp.com/entrance/?page=5';
$file_headers = @get_headers($file);
print_r($file_headers);
$header = $file_headers[0];
if($header == "HTTP/1.1 404 Not Found"){
    $exists = "doesnt exist";
    echo $exists;
} else{
    if($header == "HTTP/1.1 200 OK"){
    /* shows na  HTTP/1.1 200*/
/*     $exists = "exist";
    echo $exists; */
/*     }
} */ 

/* -----------------------------------------------------CODE PARA MAKUHA YUNG MGA END PAGE */

  $count=8;

for ($ctr = 1; $ctr <= $count; $ctr++){
    $id = $ctr;
    $url1 = "https://gatesystemapi.herokuapp.com/entrance/?page=".$id."";
    $file_headers1 = @get_headers($url1);
    $header = $file_headers1[0];
        if($header == "HTTP/1.1 404 Not Found"){
            $key = $ctr;
            break;
        }
        
}
echo "page:".$key.""; // set as counter ng page 7(-1) to 1



/* ----------------------next is extract naman yung info from one url or page --------------------- */

$file = file_get_contents('https://gatesystemapi.herokuapp.com/entrance/?page=6');
$filer = json_decode($file);
$content = $filer -> results;
$array =  count($content) ; // lumabas na yung number of {} churba, which is 6 from the time of last code bilang starts sa 0
$array1 = $array - 1;
$temp = $allowed = $time = $date = $usrid = array();

   foreach($filer -> results as $arr) { //pabalik because yung last na array is always the latest sa page
        $temp0 = $arr -> temp;
        $allowed0 = $arr -> allowed;
        $time0 = $arr -> time;
        $date0 = $arr -> date;
        $usrid0 = $arr -> usrid;
        $temp[] = $temp0;
        $allowed[] = $allowed0;
        $time[] = $time0;
        $date[] = $date0;
        $usrid[] = $usrid0;
    } 

print_r($usrid); // FINALLY


/* -------Get ko naman yung username, declaration -------------- */

$idcount = count($usrid);
$rlidc = $idcount - 1; /* number of user sa array -1 nung usrid*/
$username = $vacstat = array();
    for ($ctr0 = 0; $ctr0 <= $rlidc; $ctr0++){
        $file1 = file_get_contents("https://gatesystemapi.herokuapp.com/users/".$usrid[$ctr0]."/");
        $filer1 = json_decode($file1);
        $getdec = $filer1 -> declaration[0]; /* NAKUHA KO URL NA NEED KO TALAGA TO GET INFO  ABOUT EMAIL AND DECLARATION*/
        $file2 = file_get_contents($getdec);
        $filer2 = json_decode($file2);
        $username0 = $filer2 -> owner;
        $vacstat0 = $filer2 -> vaccinated; /* naka true, boolean */
        $username[] = $username0;
        $vacstat[] = $vacstat0; 
    }

    print_r($vacstat);
/* ---------------------------------CODE FOR GETTING THE INFO PER EXISTING PAGES-------------- */
/* for($ctr2 = $key; $ctr2 >= 1; $ctr2--){
    $file = file_get_contents('https://gatesystemapi.herokuapp.com/entrance/?page='.$ctr2.'');
} */








/* ----------------------FINAL CODE--------------------------- */
/*  $file = 'https://gatesystemapi.herokuapp.com/entrance/?page=1';
$file_headers = @get_headers($file);
print_r($file_headers);
$header = $file_headers[0];
if($header == "HTTP/1.1 200 OK"){
 */
/* ------------------- insert dito na pwede ka mag extract from page 7 to 1. tas separate extract doon sa /entrance*/


/* } else{ */
    /* ------------------- insert dito na pwede ka mag extract from the file https://gatesystemapi.herokuapp.com/entrance/ ONLY*/
/* }  */
?>




<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE-edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
        <link rel="stylesheet" type="text/css" href="tstyle.css">
    </head>
    <body>

    </body>
</html>


