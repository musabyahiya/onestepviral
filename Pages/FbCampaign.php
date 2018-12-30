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

    <title>OneStepViral - Campaign</title>
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
         <div class="panel panel-primary" style="margin-top: 20px;">
            <div class="panel-heading">
                Fb Campaign
            </div>
            <div class="panel-body">
                <div class="col-lg-4"><input type="button" data-toggle="modal" data-target="#CreateCampaign" class="btn btn-primary" value="Create New Fb Campaign" /></div>
                 <div class="col-lg-6">
                     <div class="col-lg-8"><input type ="text" class="form-control txtSearch" id="txtSearch" placeholder="Enter text to search" /></div>
                     <div class="col-lg-4"><input type ="button" class="btnSearch btn btn-primary" value = "Search" /></div>
                 </div>
                  <div class="col-lg-2">
                      <div class="checkbox pull-right" >

                <input class="checkBoxSelect" type="checkbox">Select All
                    
                </div>
                  </div>
                
                
            </div>
        </div>
        <div class="panel panel-primary">
            <div class="panel-heading">
                Fb Campaign
            </div>
            <div class="panel-body">
                <table class="table table-responsive table-hover myTable  dataTables-example" id="myTable">
                    <thead>
                        <tr class="success">
                            <th>Category</th>
                            <th>Title</th>
                            <th>URL</th>
                            <th>Type</th>
                            <th>Image</th>
                            <th>Delete</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="CampaignListing" style="background-color: white">
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row "  style="margin-bottom:60px;">
            <div class="col-lg-10">
                <div class="col-lg-8">

                   <div class="btn-group">
                    <button type="button" id="btnPrevious" onclick="PaginateCampaign('Previous')"  class="btn btn-xs btn-white ">Previous</button>
                    <button type="button" id="btnNext" onclick="PaginateCampaign('Next')"  class="btn btn-xs btn-white ">Next</button>
                </div>
            </div>
        </div>
    </div>
    <!-- page end -->
    <!-- footer start -->
    <?php include("footer.html"); ?>
    <!-- footer end -->
</div>


</div>   
<div id="EditCampaign" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width: 70%">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4>Edit Fb  Campaign</h4>
            </div>
            <div class="modal-body">
                <div class="frmCampaign_upd">
                    <div class="row">
                        <div class="col-lg-4">
                        <label>Select Category:</label>
                        <select class="form-control ddlPostCategory_upd"></select>
                    </div>
                     <div class="col-lg-4">
                        <label>Select Type:</label>
                        <select class="form-control ddlCampaignType_upd"></select>
                    </div>
                    <div class="col-lg-4">
                        <label>Title</label>
                        <input type="text" placeholder="Enter title" class="form-control txtTitle_upd" />
                    </div>
                    

                    
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <label>URL</label>
                        <input type="text" placeholder="Enter url" class="form-control txtURL_upd" />
                    </div>
                    <div class="col-lg-4">
                        <label>Image URL</label>
                        <input type="text"  class="form-control txtTitleImagePath_upd">
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
<div id="CreateCampaign" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width: 70%">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4>Create Fb Campaign</h4>

            </div>
            <div class="modal-body">
                <div class="frmCampaign">
                    <div class="row">
                        <div class="col-lg-4">
                        <label>Select Category:</label>
                        <select class="form-control ddlPostCategory"></select>
                    </div>
                     <div class="col-lg-4">
                        <label>Select Type:</label>
                        <select class="form-control ddlCampaignType"></select>
                    </div>
                    <div class="col-lg-4">
                        <label>Title</label>
                        <input type="text" class="form-control txtTitle" />
                    </div>
                    
                    
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <label>URL</label>
                        <input type="text" class="form-control txtURL" />
                    </div>
                    <div class="col-lg-4">
                        <label>Image URL</label>
                        <input type="text"  class="form-control txtTitleImagePath">
                    </div>
                </div>


            </div>
        </div>
        <div class="modal-footer">
            <input type="button" class="btn btn-primary btnSaveChanges" value="Save Changes" />
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>


    <script type="text/x-jQuery-tmpl" id="CampaignListing">
        <tr class="trFbCampaign">
            <input type="hidden" class="hdnCampaignId" value="${CampaignId}" />
            <input type="hidden" class="hdnPostCategoryId" value="${PostCategoryId}" />
            <input type="hidden" class="hdnCampaignTypeId" value="${CampaignTypeId}" />
            <input type="hidden" class="hdnTitleImagePath" value="${TitleImagePath}" />
            
            <td class="project-title tdPostCategory">${PostCategory}</td>
            <td class="project-title tdTitle">${Title}</td>
            <td class="project-title tdURL">${URL}</td>

            <td class="project-title tdPageViews">${CampaignType}</td>
            <td class="project-title tdTitleImagePath">
              <img class="img-responsive" src="${TitleImagePath}" style="width:100px;">
          </td>
          <td class="CampaignCheckbox">
              <input class="DeleteCampaign" value="${CampaignId}" type="checkbox">
          </td>
          <td class="project-title">
            <input type="button" data-toggle="modal" data-target="#EditCampaign" onclick="editCampaign(this)" value="Edit" class="btn btn-group btn-xs btn-primary"   />
            <input type="button" onclick="DeleteSelectedCampaign()" value="Delete Selected" class="btn btn-group btn-xs btn-danger btnDeleteSelect"   />
        </td>

    </tr>
</script>
<script src="../PagesJS/FbCampaign.js"></script>
</body>
</html>
