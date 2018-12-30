GetAllCampaign();
var objCampaign;



function GetAllCampaign()
{
	
	var request = $.ajax({
		method: "POST",
		url:    "../DatabaseFiles/Campaign.php?action=GetAllCampaign",
		data: {}
	});
	request.done(function(data) {
	objCampaign = data;
		onGetAllCampaign(data);
		
	});
	request.fail(function(jqXHR, textStatus) {
		console.log(textStatus);

	});
}

function copyThis (URL)
{
	copyToClipboard(URL+getCookie('SocialUTM'));

}

function onGetAllCampaign(data)
{ try {
        
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
        	//html+="<a href='#' class='product-name'>"+value.Title+"</a>";
        	html+= "<div class='small m-t-xs'>";
        	html+= value.Title;
        	html+='</div>';
        	html+="<div class='col-lg-12' style='padding:10px;'>";
        //	html+="<img alt='image' class='img-responsive'	src='../upload/"+value.TitleImagePath+"'>";
        	html+="<img alt='image' class='img-responsive'	src='"+value.TitleImagePath+"' style='max-width: 250px;max-height: 150px;min-width: 250px;min-height: 150px;'>";
        	html+=" </div>";
        /*	html+= "<div class='small m-t-xs'>";
        	html+= 'Many desktop publishing packages and web page editors now.';
        	html+='</div>';*/
        	html+="<div class='m-t text-righ'>";
        	html+="<a href='#' style='margin-top: 20px;' class='btn btn-xs btn-outline btn-primary' onclick=copyThis('"+value.URL+"') >Copy <i class='fa fa-copy'></i> </a>";
        	html+="<a href='"+value.URL+getCookie('SocialUTM')+"' target='_blank' style='margin-top: 20px;' class='btn btn-xs btn-outline btn-primary pull-right'>Preview <i class='fa fa-eye'></i> </a>";
        	html+=" </div>";
        	html+=" </div>";
        	html+=" </div>";
        	html+=" </div>";
        	html+=" </div>";
		//	html+=" </div>";


        });

        $(".Bind").append(html);
       // $(".imgAttr").attr("src", arr.image);
   }
   catch (Err) {
   	console.log(Err);
   }

}

function sortCamapign(selector)

{
    var obj = $(selector).closest('button');
    var CampaignType = obj.attr('campaigntype');
    $(".DivBind").html('');
    if(CampaignType==0)
    {
    var JsonObj = objCampaign;
    onGetAllCampaign(JsonObj);
    }
    else
    {    
    var JsonObj = objCampaign.filter(x=>x.CampaignTypeId == CampaignType);
    onGetAllCampaign(JsonObj);
        
    }

    $('.btn-group button').removeClass('active');
    $(selector).addClass('active');
}




