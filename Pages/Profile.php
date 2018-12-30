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

    <title>OneStepViral - Profile</title>
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
           <!-- page start -->

           <div class="panel panel-primary" style="margin-bottom: 50px;">
            <div class="panel-heading">
                Profile
            </div>
                <div class="middle-box loginscreen animated fadeInDown" style="padding-top: 0px">
                    <div>
                        <form class="m-t frmUsers" role="form" action="">
                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" class="form-control txtFirstName" placeholder="First Name" >
                            </div>
                            <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" class="form-control txtLastName" placeholder="Last Name">
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
                                <label>Country</label>
                                <input type="text" class="form-control txtCountry"/>
                            </div>
                            <div class="form-group">
                                <label>City</label>
                                 <input type="text" class="form-control txtCity"/>
                            </div>
                            <div class="form-group">
                              <label>Bank Name</label>
                              <input type="text" class="form-control  txtBankName" placeholder="Bank Name" />
                          </div>
                          <div class="form-group">
                            <label>Account Title</label>
                            <input type="text" class="form-control txtAccountTitle" />
                        </div>
                        <div class="form-group">

                            <label>Account Number</label>
                            <input type="text" class="form-control txtAccountNumber" />
                        </div>
                        <div class="form-group">
                            <label>Payoneer Email</label>
                            <input type="text" class="form-control txtPayEmail" />
                        </div>
                        <div class="form-group">
                            <label>PayPal Email</label>
                            <input type="text" class="form-control txtPayPalEmail" />
                        </div>
                        <div class="form-group">
                            <label>Facebook Profile URL</label>
                            <input type="text" class="form-control txtFbURL" />
                        </div>
                        <div class="form-group pages-fields">
            <label>Social Pages <i class="fa fa-plus-square-o" onclick="AddField()"> Add More</i>
            <i class="fa fa-minus-square-o btnRemove" onclick="RemoveField()" style="display:none"> Remove</i>
            </label>
            <div class="InputListing">
            
           </div>
            </div>
                        <button type="button" class="btn btn-primary block full-width m-b btnSaveChanges">Update</button>
                    </form>

                </div>
            </div>
    </div>

    <!-- page end -->
    <!-- footer start -->
    <?php include("footer.html"); ?>
    <!-- footer end -->
</div>


</div>   
<script type="text/x-jQuery-tmpl" id="InputListing">
        <input type="text" class="form-control txtPages" placeholder="https://web.facebook.com/abc" value="${Pages}" />
    </script>
    
<script src="../PagesJS/Profile.js"></script>
</body>
</html>
