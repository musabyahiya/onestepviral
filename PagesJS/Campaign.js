GetAllPostCategory();
GetAllCampaignType();
GetAllCampaign();
//EnableDeleteButton();
AllClickFunction();
var Page = 1;
var objEditRow;
var CampaignId;

function AllClickFunction() {
    $('.btnSaveChanges').click(function () {
        
        var PostCategoryId = $('.ddlPostCategory').val();
        var CampaignTypeId = $('.ddlCampaignType').val();
        var Title = $('.txtTitle').val();
        var URL = $('.txtURL').val();
        var TitleImagePath = $('.txtTitleImagePath').val();
    

        CreateNewCampaign(PostCategoryId,CampaignTypeId, Title, URL,TitleImagePath);
    });
    
   /* $('.btnSearch').click(function () {
       var search = $('.txtSearch').val();
        // Show only matching TR, hide rest of them
        $.each($(".myTable tbody tr"), function () {
        	if ($(this).text().toLowerCase().indexOf(search.toLowerCase()) === -1) {
        		$(this).hide();
        	}
        	else {
        		$(this).show();
        	}
        });
    });*/
    $('.btnSearch').click(function () {
	var Search = $('.txtSearch').val();
	SearchTable(Search);
    });
    $('.btnUpdatesChanges').click(function () {
        
        var PostCategoryId = $('.ddlPostCategory_upd').val();
        var CampaignTypeId = $('.ddlCampaignType_upd').val();
        var Title = $('.txtTitle_upd').val();
        var URL = $('.txtURL_upd').val();
       var TitleImagePath = $('.txtTitleImagePath_upd').val();
        
        UpdateCampaign(CampaignId,PostCategoryId, CampaignTypeId, Title, URL,TitleImagePath);
    });

        $('.btnDelete').click(function () {
    
        DeleteCampaign(CampaignId);
    });
    
    $('.checkBoxSelect').click(function () {
        if ($(this).is(':checked')) {
            $( ".DeleteCampaign" ).prop("checked", true)
        } else {
            $( ".DeleteCampaign" ).prop("checked", false)
        }
        
    });
    
   
}

function SearchTable(Search)
{
	var request = $.ajax({
		method: "POST",
		url:    "../DatabaseFiles/FbCampaign.php?action=GetAllSearchResult",
		data: {"Search":Search}
	});
	request.done(function(data) {

		objCampaign = data;
		onGetAllCampaign(Pagination(Page , objCampaign, 12));
		DisableButton();
});
	request.fail(function(jqXHR, textStatus) {
		console.log(textStatus);

	});
}
function CreateNewCampaign(PostCategoryId,CampaignTypeId, Title, URL,TitleImagePath)
{



    var request = $.ajax({
        method: "POST",
        url:    "../DatabaseFiles/Campaign.php?action=CreateNewCampaign",
        data: {"PostCategoryId":PostCategoryId,"CampaignTypeId":CampaignTypeId, "Title":Title,"URL":URL,"TitleImagePath":TitleImagePath}
    });
    request.done(function(data) {

        if( data==1)
            {   GetAllCampaign();
                showSuccess('Successfully Created!');
            }

        });
    request.fail(function(jqXHR, textStatus) {
        console.log(textStatus);

    });

}

function UpdateCampaign(CampaignId,PostCategoryId, CampaignTypeId, Title, URL,TitleImagePath)
{
    var request = $.ajax({
        method: "POST",
        url:    "../DatabaseFiles/Campaign.php?action=UpdateCampaign",
        data: {"CampaignId":CampaignId,"PostCategoryId":PostCategoryId,"CampaignTypeId":CampaignTypeId,
         "Title":Title,"URL":URL,"TitleImagePath":TitleImagePath}
    });
    request.done(function(data) {

        if( data==1)
            {   GetAllCampaign();
                showSuccess('Successfully Updated!');
            }

        });
    request.fail(function(jqXHR, textStatus) {
        console.log(textStatus);

    });

}

function DeleteCampaign(CampaignId)
{
    var request = $.ajax({
        method: "POST",
        url:    "../DatabaseFiles/Campaign.php?action=DeleteCampaign",
        data: {"CampaignId":CampaignId}
    });
    request.done(function(data) {

        if( data==1)
            {   GetAllCampaign();
                $('#EditCampaign').modal('hide');
                showSuccess('Successfully Deleted!');
            }

        });
    request.fail(function(jqXHR, textStatus) {
        console.log(textStatus);

    });

}

function GetAllPostCategory()
{
    
    var request = $.ajax({
        method: "POST",
        url:    "../DatabaseFiles/Campaign.php?action=GetAllPostCategory",
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

function GetAllCampaignType()
{
    
    var request = $.ajax({
        method: "POST",
        url:    "../DatabaseFiles/Campaign.php?action=GetAllCampaignType",
        data: {}
    });
    request.done(function(data) {

        onGetAllCampaignType(data);
        
    });
    request.fail(function(jqXHR, textStatus) {
        console.log(textStatus);

    });
}

function onGetAllCampaignType(data)
{
    var res = data;
    FillDropDownByReference('.ddlCampaignType',res);
    FillDropDownByReference('.ddlCampaignType_upd',res);
    

}
function GetAllCampaign()
{
    
    var request = $.ajax({
        method: "POST",
        url:    "../DatabaseFiles/Campaign.php?action=GetAllCampaign",
        data: {}
    });
    request.done(function(data) {

    objCampaign = data;
        onGetAllCampaign(Pagination(Page , objCampaign, 12));
        DisableButton();
       // onGetAllCampaign(data);
        
    });
    request.fail(function(jqXHR, textStatus) {
        console.log(textStatus);

    });
}

function onGetAllCampaign(data)
{ try {
        //var res = jQuery.parseJSON(data);
        var res = data;
        
        var divTbodyGoalFund = $('.CampaignListing').html('');
        $('#CampaignListing').tmpl(res).appendTo(divTbodyGoalFund);
        //  InitiateDatatable();
        EnableDeleteButton();
    }
    catch (Err) {
        console.log(Err);
    }

}

function editCampaign(selector) {
    objEditRow = $(selector).closest('tr');
     CampaignId = objEditRow.find('.hdnCampaignId').val();
    var CampaignTypeId = objEditRow.find('.hdnCampaignTypeId').val();

    $('.ddlPostCategory_upd').val(objEditRow.find('.hdnPostCategoryId').val());
    $('.ddlCampaignType_upd').val(objEditRow.find('.hdnCampaignTypeId').val());
    $('.txtTitle_upd').val(objEditRow.find('.tdTitle').text());
    $('.txtURL_upd').val(objEditRow.find('.tdURL').text());
    $('.txtTitleImagePath_upd').val(objEditRow.find('.hdnTitleImagePath').val());




}
function DatePicker() {
    $('.DatePicker').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        startDate: '2d+',
        autoclose: true
    });

}
function EditStatus(selector)
{
    objEditRow = $(selector).closest('tr');
    UserId = objEditRow.find('.hdnUserId').val();
    var UserStatus =objEditRow.find('.hdnUserStatus').val();

    var request = $.ajax({
        method: "POST",
        url:    "../DatabaseFiles/Campaign.php?action=EditStatus",
        data: {"UserId":UserId,"UserStatus":UserStatus}
    });
    request.done(function(data) {

        if( data==1)
            {   GetAllCampaign();
                showSuccess('Successfully Updated!');
            }

        });
    request.fail(function(jqXHR, textStatus) {
        console.log(textStatus);

    });
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

function  DeleteSelectedCampaign() {
    var Ids = '';
    $.each($('.DeleteCampaign:checkbox:checked'), function (key, val) {
       Ids += this.value+',';
   });

    var request = $.ajax({
        method: "POST",
        url:    "../DatabaseFiles/Campaign.php?action=DeleteSelectedCampaign",
        data: {"Ids":Ids.substring(0,Ids.length - 1)}
    });
    request.done(function(data) {

        if( data==1)
            {   GetAllCampaign();
                
                showSuccess('Successfully Deleted!');
                
                $( ".checkBoxSelect" ).prop("checked", false)
                
            }

        });
    request.fail(function(jqXHR, textStatus) {
        console.log(textStatus);

    });
}

function EnableDeleteButton()
{
    $( ".btnDeleteSelect" ).attr("disabled", true);
   /* $(".btnDeleteSelect").attr("disabled", true);
    var i = 0;
    var check = 0;
      $.each($('.DeleteCampaign'), function (key, val) {
        if($('.DeleteCampaign').eq(i).prop("checked")==true)
        {
            $(".DeleteCampaign").attr("disabled", false);
        }
        i++;
      });
        */
          $('.DeleteCampaign').click(function() {
        if (!$('.DeleteCampaign').is(':checked')) {
         $( ".btnDeleteSelect" ).attr("disabled", true);
         }
         else
         {
             $( ".btnDeleteSelect" ).attr("disabled", false);
         }
        });

  
}