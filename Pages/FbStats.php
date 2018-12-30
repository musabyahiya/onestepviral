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

    <title>OneStepViral - Fb Stats</title>
   
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
           <div class="panel panel-primary " style="margin-top: 20px;">
            <div class="panel-heading">
                Search
            </div>
            <div class="panel-body">

             <div class="col-lg-6">
                <input type="text" id="txtSearch" placeholder="Type for search...." class="form-control txtSearch" />
            </div>
             <div class="col-lg-6 form-inline">
                    <input type="date" class="form-control col-lg-4 txtFrom" />
                    <input type="date" class="form-control col-lg-4 txtTo" />
                    <input type="button" class="btn btn-warning btnRetreive" value="Update">
                </div>

        </div>
    </div>
    <!-- page start -->
    <!--      <div class="panel panel-primary ToHide" style="margin-top: 20px;">
            <div class="panel-heading">
                Statistics
            </div>
            <div class="panel-body">
                <input type="button" data-toggle="modal" data-target="#CreateStatistics" class="btn btn-primary" value="Create New Statistics" />

            </div>
        </div> -->
        <div class="panel panel-primary"  style="margin-bottom: 50px;">
            <div class="panel-heading">
                Fb Stats Listing
            </div>
            <div class="panel-body" style="overflow: overlay;max-width: 1200px;height: 800px;">
                <table id="myTable" class="myTable table table-responsive table-hover ">
                    <thead>
                        <tr class="success">
                            <th>Date</th>
                            <th class="ToHide">Email</th>
                            <th class="ToHide">First Name</th>
                            <th class="ToHide">Last Name</th>
                            <th>Page Views</th>
                            <th>RPM</th>
                            <th>Revenue</th>
                            <th class="ToHide">Action</th>

                        </tr>
                    </thead>
                    <tbody class="StatisticsListing" style="background-color: white">
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
<div id="EditStat" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width: 70%">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4>Edit Fb Statistics</h4>
            </div>
            <div class="modal-body">
                <div class="frmStatistics_upd">
                    <div class="row">
                       <div class="col-lg-6">
                        <label>Select User:</label>
                        <select class="form-control  ddlUsers_upd" data-show-subtext="true" data-live-search="true"></select>
                    </div>
                    <div class="col-lg-6">
                        <label>Stats Date</label>
                        <input type="text" class="form-control DatePicker txtStatsDate_upd">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <label>Page Views</label>
                        <input type="text" class="form-control txtPageViews_upd" />
                    </div>
                    <div class="col-lg-4">
                        <label>RPM</label>
                        <input type="text" class="form-control txtRPM_upd" />
                    </div>
                    <div class="col-lg-4">
                        <label>Revenue</label>
                        <input type="text" class="form-control txtRevenue_upd" />
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
<div id="CreateStatistics" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width: 70%">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4>Create Fb Statistics</h4>

            </div>
            <div class="modal-body">
                <div class="frmStatistics">
                    <div class="row">
                        <div class="col-lg-6">
                            <label>Select User:</label>
                            <a href="#" data-toggle='modal' data-target='#SearchUser'>Search User</a>
                            <select class="form-control  ddlUsers"  data-live-search="true"></select>
                        </div>
                        <div class="col-lg-6">
                            <label>Stats Date</label>
                            <input type="text" class="form-control DatePicker txtStatsDate">
                        </div>

                    </div>
                    <div class="row">
                      <div class="col-lg-4">
                        <label>Page Views</label>
                        <input type="text" class="form-control txtPageViews" />
                    </div>
                    <div class="col-lg-4">
                        <label>RPM</label>
                        <input type="text" class="form-control txtRPM" />
                    </div>
                    <div class="col-lg-4">
                        <label>Revenue</label>
                        <input type="text" class="form-control txtRevenue" />
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
                <button type="button" class="close" data-dismiss="modal">&times;</button>
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

    <script type="text/x-jQuery-tmpl" id="StatisticsListing">
        <tr class="trUsers">
            <input type="hidden" class="hdnUserId" value="${UserId}" />
            <input type="hidden" class="hdnStatsId" value="${StatsId}" />
            <input type="hidden" class="hdnStatsDate" value="${formatDate2(StatsDate)}" />
            <td class="project-title  tdStatsDate">${formatDate(StatsDate)}</td>
            <td class="project-title tdEmail ToHide">${Email}</td>
            <td class="project-title tdFirstName ToHide">${FirstName}</td>
            <td class="project-title tdLastName ToHide">${LastName}</td>
            <td class="project-title tdPageViews">${PageViews}</td>
            <td class="project-title tdRPM">$${moneyFormat(parseFloat(RPM))}</td>
            <td class="project-title tdRevenue">$${moneyFormat(parseFloat(Revenue))}</td>
            
            <td class="project-title ToHide">
                <input type="button" data-toggle="modal" data-target="#EditStat" onclick="editStatistics(this)" value="Edit" class="btn btn-group btn-xs btn-primary"   />
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
    <script src="../PagesJS/FbStats.js"></script>
    <!-- Page-Level Scripts -->
    <script>
       
    </script>


</body>
</html>
