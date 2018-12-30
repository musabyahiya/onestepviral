<?php
session_start();
?>
<!DOCTYPE html>
<html>


<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>OneStepViral - Login</title>
    <link rel="shortcut icon" type="image/png" href="img/favicon.png"/>
    <link href="css/bootstrap.min.css" rel="stylesheet" />

    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <!--Sweet Alert-->
    <link href="css/plugins/sweetalert/sweetalert.css" rel="stylesheet" />
    <script src="js/plugins/sweetalert/sweetalert.min.js"></script>

    <!--End Sweet Alert-->

</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>

                <img class="img img-responsive" width="500px" style="margin-top: 5%" src="img/logoOsv3.png">

            </div>
            <h3>Welcome to OneStepViral</h3>

            <p>Login in. To see it in action.</p>
            <form class="m-t" role="form" action="">
                <div class="form-group">
                    <input type="text" class="form-control txtEmail" placeholder="Username" required="">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control txtPassword" placeholder="Password" required="">
                </div>
                <button type="button" class="btn btn-primary block full-width m-b btnLogin">Login</button>

                
            </form>
            <a class="btn btn-sm btn-white btn-block" href="Signup.php">Sign up</a>
            <p class="m-t"> <small><b>OneStepViral</b> &copy; 2018</small> </p>
            <p class="m-t" > <a class="" target="_blank" href="https://onestepviral.com/terms-condition/"><strong>Terms & Condition</strong></a> </p>
  
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.tmpl.min.js"></script>
    <script src="PagesJS/Constant.js"></script>
    <script src="PagesJS/Login.js"></script>
    
<!-- Load Facebook SDK for JavaScript -->
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js#xfbml=1&version=v2.12&autoLogAppEvents=1';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<!-- Your customer chat code -->
<div class="fb-customerchat"
  attribution=setup_tool
  page_id="275303413224016"
  theme_color="#33bcf2">
</div>
</body>

</html>
