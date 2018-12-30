GetAllCampaign();
//LinkPreview('http://google.com');
var objCampaign;
var objCategory;
var globalCampaign;
var arr = {};
var Page  = 1;

GetAllPostCategory();
AllChangeFunction();

function AllChangeFunction()
{
    $('.ddlPostCategory').change(function () {
		var PostCategoryId = $(this).val();
		  objCategory = objCampaign.filter(x=>x.PostCategoryId == PostCategoryId);
		 $('.Bind').html('');
		 if(PostCategoryId==0)
		 {
		     
		     objCampaign = globalCampaign;
		     onGetAllCampaign(Pagination(Page , objCampaign, 12));
		 }
		 else
		 {
		     onGetAllCampaign(Pagination(Page , objCategory, 12));
		     objCampaign = objCategory;
		 }
		DisableButton();
	});
}

function GetAllCampaign()
{
    
    var request = $.ajax({
        method: "POST",
        url:    "../DatabaseFiles/FbCampaign.php?action=GetAllCampaign",
        data: {}
    });
    request.done(function(data) {
    objCampaign = data;
    globalCampaign = objCampaign;
    onGetAllCampaign(Pagination(Page , objCampaign, 12));
    DisableButton();
       // onGetAllCampaign(data);
        
    });
    request.fail(function(jqXHR, textStatus) {
        console.log(textStatus);

    });
}

function GetAllPostCategory()
{
	var request = $.ajax({
		method: "POST",
		url:    "../DatabaseFiles/FbCampaign.php?action=GetAllPostCategory",
		data: {}
	});
	request.done(function(data) {

		onGetAllPostCategory(data);
		
	});
	request.fail(function(jqXHR, textStatus) {
		console.log(textStatus);

	});
}

function onGetAllPostCategory(data)
{
	var res = data;
	
	FillDropDownByReference('.ddlPostCategory',res);
	FillDropDownByReference('.ddlPostCategory_upd',res);
}

function copyThis (URL)
{
    copyToClipboard(URL+getCookie('UTM'));

}

function onGetAllCampaign(data)
{ try 
{
        
        var res = data;
        var html ='';
        $.each(res, function(key, value) {
            //LinkPreview(value.URL);
            
            html+="<div class='DivBind'>";
            html+="<div class='col-md-4'>";
            html+="<div class='ibox'>";
            html+="<div class='ibox-content product-box'>";
            html+="<div class='product-desc'>";
            html+="<p><span class='badge badge-primary'>"+value.CampaignType+"</span></p>";
            html+="<a href='#' class='product-name'>"+value.Title+"</a>";
            html+="<div class='col-lg-12' style='padding:10px;'>";
            //	html+="<img alt='image' class='img-responsive'	src='../upload/"+value.TitleImagePath+"'>";
        	html+="<img alt='image' class='img-responsive'	src='"+value.TitleImagePath+"'>";
            html+=" </div>";
/*          html+= "<div class='small m-t-xs'>";
            html+= 'Many desktop publishing packages and web page editors now.';
            html+='</div>';*/
            html+="<div class='m-t text-righ'>";
            html+="<a href='#' style='margin-top: 20px;' class='btn btn-xs btn-outline btn-primary' onclick=copyThis('"+value.URL+"') >Copy <i class='fa fa-copy'></i> </a>";
            html+="<a href='"+value.URL+getCookie('UTM')+"' target='_blank' style='margin-top: 20px;' class='btn btn-xs btn-outline btn-primary pull-right'>Preview <i class='fa fa-eye'></i> </a>";
            html+=" </div>";
            html+=" </div>";
            html+=" </div>";
            html+=" </div>";
            html+=" </div>";
        //  html+=" </div>";


        });

        $(".Bind").append(html);
      
   }
   catch (Err) {
    console.log(Err);
   }

}

function sortCamapign(selector)

{
    objCampaign = globalCampaign;
    var obj = $(selector).closest('button');
    var CampaignType = obj.attr('campaigntype');
    $(".DivBind").html('');
    if(CampaignType==0)
    {
    var JsonObj = objCampaign;
    
    onGetAllCampaign(objCampaign);
    }
    else
    {    
    var JsonObj = objCampaign.filter(x=>x.CampaignTypeId == CampaignType);
    objCampaign = JsonObj;
    onGetAllCampaign(objCampaign);
        
    }
DisableButton();
    $('.btn-group button').removeClass('active');
    $(selector).addClass('active');
}

function PaginateCampaign(order)
{
    
    if(order=='Next')
    {
        Page++;
      //  Pagination(Page , objCampaign, 12);
      $('.Bind').html('');
        DisableButton();
        onGetAllCampaign(Pagination(Page , objCampaign, 12));
    }
    else
    {
        Page--;
        DisableButton();
        $('.Bind').html('');
         onGetAllCampaign(Pagination(Page , objCampaign, 12));
        
        
    }
}

function DisableButton()
{
	if(Page==1)
	{

		if(Page==Math.ceil(objCampaign.length/12))
		{
			$("#btnNext").attr("disabled", true);
		}
		else
		{
			$("#btnPrevious").attr("disabled", true);
			$("#btnNext").attr("disabled", false);
		}
	}
	else if(Page>1)
	{
		$("#btnPrevious").attr("disabled", false);
		if(Page==Math.ceil(objCampaign.length/12))
		{
			$("#btnNext").attr("disabled", true);
		}
		else
		{
			$("#btnNext").attr("disabled", false);
		}
	}

	else
	{
		$("#btnPrevious").attr("disabled", false);
		$("#btnNext").attr("disabled", false);

	}
}

