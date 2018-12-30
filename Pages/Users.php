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

    <title>OneStepViral - Users</title>
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
           <div class="panel panel-primary ToHide" style="margin-top: 20px;">
            <div class="panel-heading">
                Users
            </div>
            <div class="panel-body">
                <div class="col-lg-3">
                 <input type="button" data-toggle="modal" data-target="#CreateUsers" class="btn btn-primary" value="Create New Users" />
             </div>
             <div class="col-lg-8">
                <input type="text" id="txtSearch" placeholder="Type for search...." class="form-control txtSearch" />
            </div>

        </div>
    </div>
    <div class="panel panel-primary" style="margin-bottom: 50px;">
        <div class="panel-heading">
            User Listing
        </div>
        <div class="panel-body" style="overflow: overlay;max-width: 1200px;height: 800px;">
            <table id="myTable" class="myTable table table-responsive table-hover tblUsers dataTables-example">
                <thead>
                    <tr class="success">
                        <th>Email</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Password</th>
                        <th>Phone</th>
                        <th>Bank Name</th>
                        <th>Account Title</th>
                        <th>Account Number</th>
                        <th>Payoneer</th>
                        <th>Paypal</th>
                        <th>FB UTM</th>
                        <th>Social UTM</th>
                         <th>Country</th>
                         <th>City</th>
                        <th>Pages</th>
                        <th class="ToHide">Status</th>
                        <th class="">Action</th>
                    </tr>
                </thead>
                <tbody class="UsersListing" style="background-color: white">
                </tbody>
            </table>
        </div>
    </div>

    <!-- page end -->
    <!-- footer start -->
    <?php include("footer.html"); ?>
    <!-- footer end -->
</div>


</div>   
<div id="EditUsers" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width: 70%">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4>Edit Users</h4>
            </div>
            <div class="modal-body">
                <div class="frmUsers_upd">
                    <div class="row">
                        <div class="col-lg-4">
                            <label>Email</label>
                            <input  type="email" class="form-control txtEmail_upd" />
                        </div>
                        <div class="col-lg-4">
                            <label>First Name</label>
                            <input type="text" class="form-control txtFirstName_upd" />
                        </div>
                        <div class="col-lg-4">
                            <label>Last Name</label>
                            <input type="text" class="form-control txtLastName_upd" />
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-lg-4">
                            <label>Password</label>
                            <input type="text" class="form-control txtPassword_upd" />
                        </div>
                        <div class="col-lg-4">
                            <label>Phone</label>
                            <input type="text" class="form-control txtPhone_upd" />
                        </div>
                        <div class="col-lg-4">
                            <label>Bank Name</label>
                            <input type="text" class="form-control txtBankName_upd" />
                        </div>
                    </div>

                    <div class="row">
                     <div class="col-lg-4">
                        <label>Account Title</label>
                        <input type="text" class="form-control txtAccountTitle_upd" />
                    </div>
                    <div class="col-lg-4">
                        <label>Account Number</label>
                        <input type="text" class="form-control txtAccountNumber_upd" />
                    </div>
                    <div class="col-lg-4">
                        <label>PayPal/Payoneer Email</label>
                        <input type="text" class="form-control txtPayEmail_upd" />
                    </div>
                </div>

                <div class="row">
                   <div class="col-lg-4">
                    <label>FB UTM</label>
                    <input type="text" class="form-control txtUTM_upd" />
                </div>
                <div class="col-lg-4">
                    <label>Social UTM</label>
                    <input type="text" class="form-control txtSocialUTM_upd" />
                </div>
                <div class="col-lg-4">
                    <label>Pages</label>
                    <textarea rows="1" disabled class="form-control txtPages_upd"></textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <input type="button" style="float:left" class="btn btn-danger btnDelete ToHide" 
        value="Delete">
        <input type="button" class="btn btn-primary btnUpdatesChanges" value="Save Changes" />
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
</div>
</div>
</div>
<div id="CreateUsers" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width: 70%">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4>Create Users</h4>
            </div>
            <div class="modal-body">
                <div class="frmUsers">
                    <div class="row">
                        <div class="col-lg-4">
                            <label>Email</label>
                            <input type="email" class="form-control txtEmail" />
                        </div>
                        <div class="col-lg-4">
                            <label>First Name</label>
                            <input type="text" class="form-control txtFirstName" />
                        </div>
                        <div class="col-lg-4">
                            <label>Last Name</label>
                            <input type="text" class="form-control txtLastName" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <label>Password</label>
                            <input type="text" class="form-control txtPassword" />
                        </div>
                        <div class="col-lg-4">
                            <label>Phone</label>
                            <input type="text" class="form-control txtPhone" />
                        </div>
                        <div class="col-lg-4">
                            <label>Bank Name</label>
                            <input type="text" class="form-control txtBankName" />
                        </div>
                    </div>
                    <div class="row">
                     <div class="col-lg-4">
                        <label>Account Title</label>
                        <input type="text" class="form-control txtAccountTitle" />
                    </div>
                    <div class="col-lg-4">
                        <label>Account Number</label>
                        <input type="text" class="form-control txtAccountNumber" />
                    </div>
                    <div class="col-lg-4">
                        <label>PayPal/Payoneer Email</label>
                        <input type="text" class="form-control txtPayEmail" />
                    </div>
                </div>
                <div class="row">
                   <div class="col-lg-4">
                    <label>FB UTM</label>
                    <input type="text" class="form-control txtUTM" />
                </div>
                <div class="col-lg-4">
                    <label>Social UTM</label>
                    <input type="text" class="form-control txtSocialUTM" />
                </div>

                <div class="col-lg-4">
                    <label>Pages</label>
                    <textarea rows="1" class="form-control txtPages"></textarea>
                </div>

            </div>
        </div>
    </div>
    <div class="modal-footer">
        <input type="button" class="btn btn-primary btnSaveChanges" value="Save Changes" />
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
</div>

<script type="text/x-jQuery-tmpl" id="UsersListing">
    <tr class="trUsers">
        <input type="hidden" class="hdnUserId" value="${UserId}" />
        <input type="hidden" class="hdnUserStatus" value="${UserStatus}" />
        <input type="hidden" class="hdnPages" value="${Pages}" />
        <td class="project-title tdEmail">${Email}</td>
        <td class="project-title tdFirstName">${FirstName}</td>
        <td class="project-title tdLastName">${LastName}</td>
        <td class="project-title tdPassword">${Password}</td>
        <td class="project-title tdPhone">${Phone}</td>
        <td class="project-title tdBankName">${BankName}</td>
        <td class="project-title tdAccountTitle">${AccountTitle}</td>
        <td class="project-title tdAccountNumber">${AccountNumber}</td>
        <td class="project-title tdPayEmail">${PayEmail}</td>
        <td class="project-title tdPayPalEmail">${PayPalEmail}</td>
        <td class="project-title tdUTM">${UTM}</td>
        <td class="project-title tdSocialUTM">${SocialUTM}</td>
        <td class="project-title tdCountry">${Country}</td>
        <td class="project-title tdCity">${City}</td>
        <td class="project-title tdPages">{{html htmlBr(Pages) }}</td>
        <td class="project-title ToHide">
            <input type="button" onclick="EditStatus(this)" value="${UserStatus == 1 ? 'Inactive' : 'Active' }" class="${UserStatus == 1 ? 'btn btn-xs btn-danger ' : 'btn btn-xs btn-warning'}" />
        </td>
        <td class="project-title">
            <input type="button" data-toggle="modal" data-target="#EditUsers" onclick="editUsers(this)" value="Edit" class="btn btn-group btn-xs btn-primary"   />
        </td>

    </tr>
</script>
<script src="../PagesJS/Users.js"></script>
</body>
</html>
