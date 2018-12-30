<?php
session_start();
if(!isset($_SESSION['UserId'])){
    header("location: ../Login.php");
    echo '<script type="text/javascript"> window.location.href = "../Login.php" </script>';
}
?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>OneStepViral - Html Code</title>
    <?php include("head.html"); ?>
</head>

<body>
    <div id="wrapper">

        <nav class="navbar-default navbar-static-side" role="navigation">
            <?php include("nav.html"); ?>
        </nav>
        <div id="page-wrapper" class="gray-bg dashbard-1">
            <div class="row border-bottom BindAfter">
             <?php include("TopHeader.html"); ?>
         </div>
         <div class="panel panel-primary" style="margin-top: 20px;">
            <div class="panel-heading">
                Html Code
            </div>
            <div class="panel-body">

                <div class="ibox-content no-padding">

                        <div class="summernote">
                           
                        </div>

                    </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                       
                                        <button class="btn btn-success pull-right btnUpdateCode" type="button">Save changes</button>
                                    </div>
                                </div>
        </div>
    </div>


    <script src="../PagesJS/HtmlCode.js"></script>
</body>
</html>
