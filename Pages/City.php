<?php
require_once '../DatabaseFiles/database_connections.php';
if(!isset($_SESSION['UserId'])){
    header("location: ../Login.php");
}
?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>OneStepViral - City</title>
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
           <!-- page start -->
         <div class="panel panel-primary ToHide" style="margin-top: 20px;">
            <div class="panel-heading">
                City
            </div>
            <div class="panel-body">
                <input type="button" data-toggle="modal" data-target="#CreateCity" class="btn btn-primary" value="Create New City" />

            </div>
        </div>
        <div class="panel panel-primary" style="margin-bottom: 50px;">
            <div class="panel-heading">
                City Listing
            </div>
            <div class="panel-body" style="overflow: overlay;max-width: 1200px;height: 800px;">
                <table class="table table-responsive table-hover">
                    <thead>
                        <tr class="success">
                            <th>Country</th>
                            <th>City</th>
                            <th class="">Action</th>

                        </tr>
                    </thead>
                    <tbody class="CityListing" style="background-color: white">
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
<div id="EditCity" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width: 70%">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4>Edit City</h4>
            </div>
            <div class="modal-body">
                <div class="frmCity_upd">
                    <div class="row">
                        <div class="col-lg-6">
                            <label>Select Country</label>
                            <select class="form-control  ddlCountry_upd" >
                            </select>
                        </div>
                        
                        <div class="col-lg-6">
                            <label>City</label>
                            <input type="text" class="form-control txtCity_upd" />
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
<div id="CreateCity" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width: 70%">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4>Create City</h4>

            </div>
            <div class="modal-body">
                <div class="frmCity">
                    <div class="row">
                       <div class="col-lg-6">
                        <label>Select Country</label>
                        <select class="form-control ddlCountry" >
                        </select>
                    </div>

                    <div class="col-lg-6">
                        <label>City</label>
                        <input type="text" class="form-control txtCity" />
                    </div>

                </div>

            </div>
        </div>
        <div class="modal-footer">
            <input type="button" class="btn btn-primary btnSaveChanges" value="Save Changes" />
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>


    <script type="text/x-jQuery-tmpl" id="CityListing">
        <tr class="trCity">
            <input type="hidden" class="hdnCityId" value="${CityId}" />

            <td class="project-title tdEmail">${Country}</td>
            <td class="project-title tdFirstName">${City}</td>
            <td class="project-title ToHide">
                <input type="button" data-toggle="modal" data-target="#EditCity" onclick="editCity(this)" value="Edit" class="btn btn-group btn-xs btn-primary"   />
            </td>

        </tr>
    </script>
    <script src="../PagesJS/City.js"></script>
</body>
</html>
