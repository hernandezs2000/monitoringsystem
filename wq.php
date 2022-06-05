<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST['submit'])){
        $yes = $_POST['complete'];
       echo $yes;
    }
}
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE-edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body class="login">
    <form class = "chck-box" method = "POST">
                        
                        <div class = "q">
                            <?php
                            $vacstat ="";
                            ?>
                          <h4>Q1: vaccinated</h4>
                          <input type="radio" name="complete" value="true" <?php echo ($vacstat == 1) ? 'checked="checked"' : ''; ?> id="1"/>
                            <label for="1">Yes</label><br>
                            <input type ="radio" name="complete" value="false"<?php echo ($vacstat == "") ? 'checked="checked"' : ''; ?>  id="11"/>
                            <label for="11">No</label>
                        </div>

                        <button type = "submit" name = "submit">Save changes</button>
                      </form>
    </body>
</html>

