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

    <title>OneStepViral - Payout</title>
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
                Search
            </div>
           <div class="panel-body">

                <div class="col-lg-6">
                <input type="text" id="txtSearch" placeholder="Type for search...." class="form-control txtSearch">
            </div>
             <div class="col-lg-6 form-inline">
                    <input type="date" class="form-control col-lg-4 txtFrom">
                    <input type="date" class="form-control col-lg-4 txtTo">
                    <input type="button" class="btn btn-warning btnRetreive" value="Update">
                </div>

        </div>
    </div>
    <!-- page start -->
     <!--     <div class="panel panel-primary ToHide" style="margin-top: 20px;">
            <div class="panel-heading">
                Payout
            </div>
            <div class="panel-body">
                <input type="button" data-toggle="modal" data-target="#CreatePayout" class="btn btn-primary" value="Create New Payout" />

            </div>
        </div> -->

        <div class="panel panel-primary" style="margin-bottom: 50px;">
            <div class="panel-heading">
                Payout Listing
            </div>
            <div class="panel-body" style="overflow: overlay;max-width: 1200px;height: 800px;">
                <table id="myTable"  class="myTable table table-responsive table-hover  dataTables-example">
                    <thead>
                        <tr class="success">
                            <th class="ToHide">Email</th>
                            <th class="ToHide">First Name</th>
                            <th class="ToHide">Last Name</th>
                            <th>Duration</th>
                            <th>Revenue</th>
                            <th>Conversion Rate</th>
                            <th>Amount</th>
                            <th>Comments</th>
                            <th>File</th>
                            <th>Status</th>
                            <th class="ToHide">Action</th>

                        </tr>
                    </thead>
                    <tbody class="PayoutListing" style="background-color: white">
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
<div id="EditPayout" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width: 70%">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4>Edit Payout</h4>
            </div>
            <div class="modal-body">
                <div class="frmPayout">
                    <div class="row">
                        <div class="col-lg-4">
                            <label>Select User</label>
                            <select class="form-control  ddlUsers_upd" data-show-subtext="true" data-live-search="true">
                            </select>
                        </div>
                        <div class="col-lg-4">
                            <label>Payment Status:</label>
                            <select class="form-control ddlPaymentStatus_upd"></select>
                        </div>
                        <div class="col-lg-4">
                            <label>Duration</label>
                            <input type="text" class="form-control txtDuration_upd" />
                        </div>
                        <div class="col-lg-4">
                            <label>Revenue</label>
                            <input type="text" class="form-control txtRevenue_upd" />
                        </div>
                        <div class="col-lg-4">
                            <label>Conversion Rate</label>
                            <input type="text" class="form-control txtConversionRate_upd" />
                        </div>
                        <div class="col-lg-4">
                            <label>Amount</label>
                            <input type="text" class="form-control txtAmount_upd" />
                        </div>
                        <div class="col-lg-4">
                            <label>Comments</label>
                            <input type="text" class="form-control txtComments_upd" />
                        </div>
                        <div class="col-lg-4">
                            <label>Upload File</label>
                            <input type="file"  id="txtFile_upd" name="file" accept=".pdf,.png,.jpeg,.jpg" class="form-control txtFile_upd" />
                        </div>
                    </div>







                </div>
            </div>
            <div class="modal-footer">
                <input type="button" style="float:left" class="btn btn-danger btnDelete" value="Delete">
                <input type="button" class="btn btn-primary btnUpdatesChanges" value="Save Changes" />
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div id="CreatePayout" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width: 70%">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4>Create Payout</h4>

            </div>
            <div class="modal-body">
                <div class="frmPayout">
                    <div class="row">
                     <div class="col-lg-4">
                        <label>Select User</label>
                         <a href="#" data-toggle='modal' data-target='#SearchUser'>Search User</a>
                        <select class="form-control   ddlUsers" data-show-subtext="true" data-live-search="true">
                        </select>
                    </div>
                    <div class="col-lg-4">
                        <label>Payment Status:</label>
                        <select class="form-control  ddlPaymentStatus" ></select>
                    </div>
                    <div class="col-lg-4">
                        <label>Duration</label>
                        <input type="text" class="form-control txtDuration" />
                    </div>
                    <div class="col-lg-4">
                            <label>Revenue</label>
                            <input type="text" class="form-control txtRevenue" />
                        </div>
                    
                    <div class="col-lg-4">
                        <label>Conversion Rate</label>
                        <input type="text" class="form-control txtConversionRate" />
                    </div>
                    <div class="col-lg-4">
                        <label>Amount</label>
                        <input type="text" class="form-control txtAmount" />
                    </div>
                     <div class="col-lg-4">
                            <label>Comments</label>
                            <input type="text" class="form-control txtComments" />
                        </div>
                    <div class="col-lg-4">
                        <label>Upload File</label>
                        <input type="file" name="file" accept=".pdf,.png,.jpeg,.jpg"  id="txtFile" class="form-control txtFile" />
                    </div>
                </div>







            </div>
        </div>
        <div class="modal-footer">
            <input type="button" class="btn btn-primary btnSaveChanges" value="Save Changes" />
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>
<div id="SearchUser" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width: 90%;height:80%">
        <div class="modal-content">
            <div class="modal-header">
                
                <h4>Search User</h4>

            </div>
            <div class="modal-body">
                <div class="row">
                <input type="text" id="txtSearch" placeholder="Type for search...." class="form-control txtSearch">
            </div>
              <table  class=" myTable table table-responsive table-hover" style="margin-top:20px;">
                    <thead>
                        <tr class="success">
                            <th>User</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody class="SearchUserListing" style="background-color: white">
                    </tbody>
                </table>
        </div>
        <div class="modal-footer">
       
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>

    <script type="text/x-jQuery-tmpl" id="PayoutListing">
        <tr class="trPayout">
            <input type="hidden" class="hdnPayoutId" value="${PayoutId}" />
            <input type="hidden" class="hdnPaymentStatusId" value="${PaymentStatusId}" />
            <input type="hidden" class="hdnUserId" value="${UserId}" />
            <td class="project-title tdEmail ToHide">${Email}</td>
            <td class="project-title tdFirstName ToHide">${FirstName}</td>
            <td class="project-title tdLastName ToHide">${LastName}</td>
            <td class="project-title tdDuration">${Duration}</td>
            <td class="project-title tdRevenue">${Revenue}</td>
            <td class="project-title tdConversionRate">${ConversionRate}</td>
            <td class="project-title tdAmount">${Amount}</td>
            <td class="project-title tdComments">${Comments}</td>
            <td class="project-title "><a href="../upload/${(FilePath).replace('\n','').replace(' ','')}" download>${(FilePath).replace('\n','').replace(' ','')}&nbsp;&nbsp;<i class="fa fa-download" aria-hidden="true"></i></a></td>
            <td class="project-title ">${PaymentStatus}</td>
            
            <td class="project-title ToHide">
                <input type="button" data-toggle="modal" data-target="#EditPayout" onclick="editPayout(this)" value="Edit" class="btn btn-group btn-xs btn-primary"   />
            </td>

        </tr>
    </script>
     <script type="text/x-jQuery-tmpl" id="SearchUserListing">
        <tr class="trUsers">
            <input type="hidden" class="hdnUserId" value="${Id}" />
            <td class="project-title">${Value}</td>
            
            <td class="project-title ToHide">
                <input type="button"   onclick="selectUser(this)" value="Select" class="btn btn-group btn-xs btn-primary"   />
            </td>

        </tr>
    </script>
    <script src="../PagesJS/Payout.js"></script>
</body>
</html>
