<?php
session_start();
if(!isset($_SESSION['UserId'])){
    //header("location: ../Login.php");
    echo '<script type="text/javascript"> window.location.href = "../Login.php" </script>';
}

//echo $_SESSION['UserId'];
?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>OneStepViral - Dashboard</title>
    <?php include("head.html"); ?>
</head>

<body>
    <div id="wrapper">

        <nav class="navbar-default navbar-static-side" role="navigation">
            <?php include("nav.html"); ?>
        </nav>
        <div id="page-wrapper" class="gray-bg dashbard-1">
            <div class="row border-bottom">
             <?php include("TopHeader.html"); ?>
         </div>
        <div class="BindHtmlCode" style="padding:10px;">
            
        </div>
         <?php include("footer.html"); ?>
     </div>


 </div>


</body>
</html>
