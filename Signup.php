<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>OneStepViral - Signup</title>
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

 <div class="middle-box  loginscreen animated fadeInDown">
    <div>
        <div>

            <img class="img img-responsive" width="500px" style="margin-top: 5%" src="img/logoOsv3.png">

        </div>
        <h3>Welcome to OneStepViral</h3>

        <form class="m-t frmSignup" role="form" action="">
            <div class="form-group">
                <label>First Name</label>
                <input type="text" class="form-control txtFirstName" placeholder="First Name" >
            </div>
            <div class="form-group">
                 <label>Last Name</label>
                <input type="text" class="form-control txtLastName" placeholder="Last Name">
            </div>
            <div class="form-group">
                 <label>Email</label>
                <input type="email" class="form-control txtEmail" placeholder="Email" >
            </div>
            <div class="form-group">
                 <label>Phone</label>
                <input type="text" class="form-control txtPhone" placeholder="Phone" >
            </div>
            <div class="form-group">
                 <label>Password</label>
                <input type="password" class="form-control txtPassword" placeholder="Password" >
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" class="form-control txtPasswordConfirm" placeholder="Confirm Password" >
            </div>
            <div class="form-group">
                <label>Country</label>
                <input type="text" class="form-control txtCountry" placeholder="Country">
               
            </div>
            <div class="form-group">
                <label>City</label>
                <input type="text" class="form-control txtCity" placeholder="City">
            </div>
            <div class="form-group">
            <label>Facebook Profile URL</label>
            <input type="text" class="form-control txtFbURL" placeholder="https://web.facebook.com/abc" />
            </div>
            <div class="form-group pages-fields">
            <label>Social Pages <i class="fa fa-plus-square-o" onclick="AddField()"> Add More</i>
            <i class="fa fa-minus-square-o btnRemove" onclick="RemoveField()" style="display:none"> Remove</i>
            </label>
            <input type="text" class="form-control txtPages" placeholder="https://www.twitter.com/abc" />
           
            </div>
            
            <button type="button" class="btn btn-primary block full-width m-b btnRegister">Sign Up</button>

            
            <a class="btn btn-sm btn-white btn-block" href="Login.php">Login</a>
        </form>
        <p class="m-t" style="text-align: center"> <small><b>OneStepViral</b> &copy; 2018</small> </p>
        <p class="m-t" style="text-align: center"> <a class="" target="_blank" href="https://onestepviral.com/terms-condition/"><strong>Terms & Condition</strong></a> </p>
    </div>
</div>

<!-- Mainly scripts -->
<script src="js/jquery-3.1.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.tmpl.min.js"></script>
<script src="PagesJS/Constant.js"></script>
<script src="PagesJS/Signup.js"></script>

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
