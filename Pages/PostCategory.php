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

    <title>OneStepViral - PostCategory</title>
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
                 Post Category
            </div>
            <div class="panel-body">
                <input type="button" data-toggle="modal" data-target="#CreatePostCategory" class="btn btn-primary" value="Create New Post Category" />

            </div>
        </div>
        <div class="panel panel-primary">
            <div class="panel-heading">
                Post Category
            </div>
               <div class="panel-body">
                <table class="table table-responsive table-hover">
                    <thead>
                        <tr class="success">
                            <th>Post Category</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody class="PostCategoryListing" style="background-color: white">
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
<div id="EditPostCategory" class="modal fade" role="dialog">
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4>Edit Post Category</h4>
            </div>
            <div class="modal-body">
                <div class="frmPostCategory">
                    <div class="row">
                       <div class="col-lg-12">
                        <label>Post Category</label>
                        <input type="text" class="form-control txtPostCategory_upd" placeholder="Enter Post Category"/>
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
</div>
<div id="CreatePostCategory" class="modal fade" role="dialog">
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4>Create Post Category</h4>

            </div>
            <div class="modal-body">
                <div class="frmPostCategory">
                    <div class="row">
                       <div class="col-lg-12">
                        <label>PostCategory</label>
                        <input type="text" class="form-control txtPostCategory" placeholder="Enter Post Category" />
                    </div>
                 
                </div>
             

            </div>
        </div>
        <div class="modal-footer">
            <input type="button" class="btn btn-primary btnSaveChanges" value="Save Changes" />
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>
    </div>
</div>
        <script type="text/x-jQuery-tmpl" id="PostCategoryListing">
        <tr class="trUsers">
            <input type="hidden" class="hdnPostCategoryId" value="${PostCategoryId}" />
          
            <td class="project-title tdPostCategory">${PostCategory}</td>
   
            <td class="project-title">
                <input type="button" data-toggle="modal" data-target="#EditPostCategory" onclick="editPostCategory(this)" value="Edit" class="btn btn-group btn-xs btn-primary"   />
            </td>

        </tr>
    </script>
    <script src="../PagesJS/PostCategory.js"></script>
</body>
</html>
