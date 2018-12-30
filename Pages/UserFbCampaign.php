<?php
require '../DatabaseFiles/database_connections.php';
if(!isset($_SESSION['UserId'])){
    header("location: ../Login.php");
    echo '<script type="text/javascript"> window.location.href = "../Login.php" </script>';
    die();
    
}
?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>OneStepViral - Fb Campaign</title>
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
         <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-8">
                <div class="col-lg-8">
                <h2>Fb Campign</h2>
                 <div class="btn-group">
                                        <button type="button" onclick="sortCamapign(this)" campaignType="0"  class="btn btn-xs btn-white ">All</button>
                                        <button type="button" onclick="sortCamapign(this)" campaignType="1"  class="btn btn-xs btn-white ">Latest</button>
                                        <button type="button" onclick="sortCamapign(this)" campaignType="2" class="btn btn-xs btn-white">Trending</button>
                                        <button type="button" onclick="sortCamapign(this)" campaignType="3" class="btn btn-xs btn-white">Top Post</button>
                                    </div>
            </div>
              
            </div>
            <div class="col-lg-4">
                <div class="col-lg-12" style="margin-top: 20px;margin-bottom: 10px;">
                        <label>Category:</label>
                        <select class="form-control ddlPostCategory">
                            </select>
                    </div>
                </div>

        </div>

        <!-- page start -->
        <div class="row Bind">
               <!--  <img src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs%3D" data-url="https://incrediblenat.com/10-beautiful-photos-maine-coon-cats-see-love-cats/" alt="Google"> -->
    <!--         <div class="col-md-3">
                <div class="ibox">
                    <div class="ibox-content product-box">
                        <div class="product-desc">
                            <p><span class="badge badge-primary">Latest</span></p>
                            <a href="#" class="product-name">Title</a>
                            <div class="col-lg-12">
                                <img alt="image" class="img-responsive" src="http://localhost:81/osv/img/p_big3.jpg">
                            </div>
                            <div class="m-t text-righ" >
                                <a href="#" style="margin-top: 20px;" class="btn btn-xs btn-outline btn-primary">Copy <i class="fa fa-copy"></i> </a>
                                <a href="#" style="margin-top: 20px;" class="btn btn-xs btn-outline btn-primary pull-right">Preview <i class="fa fa-eye"></i> </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  -->     
      
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="../js/url2img.js"></script>
    <script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36251023-1']);
  _gaq.push(['_setDomainName', 'jqueryscript.net']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
    <script src="../js/url2img.js"></script>
<script type="text/x-jQuery-tmpl" id="CampaignListing">
    <tr class="trUsers">
        <input type="hidden" class="hdnCampaignId" value="${CampaignId}" />
        <input type="hidden" class="hdnCampaignTypeId" value="${CampaignTypeId}" />
        <td class="project-title tdTitle">${Title}</td>
        <td class="project-title tdURL">${URL}</td>
        <td class="project-title ">N/A</td>
        <td class="project-title tdPageViews">${CampaignType}</td>

        <td class="project-title">
            <input type="button" data-toggle="modal" data-target="#EditCampaign" onclick="editCampaign(this)" value="Edit" class="btn btn-group btn-xs btn-primary"   />
        </td>

    </tr>
</script>
<script src="../PagesJS/UserFbCampaign.js"></script>
</body>
</html>
