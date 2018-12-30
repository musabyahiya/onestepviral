
AllClickFunction();
GetAllUsers();
GetAllStatistics();
DatePicker();
HideControl();
CalculateOnFocus();
var objEditRow;
var StatsId;
var StatsList;

function HideControl()
{
	var html = " <div class='panel panel-primary ToHide' style='margin-top: 20px;'> <div class='panel-heading'> Fb Stats </div><div class='panel-body'> <input type='button' data-toggle='modal' data-target='#CreateStatistics' class='btn btn-primary' value='Create New Fb Stats'/> </div></div>";
	if(getCookie('RoleId')=="1")
	{
		$(html).insertAfter($(".BindAfter"));
	}
}
function CalculateOnFocus()
{
	$(".txtRevenue").focus(function(){

		var PageViews = $(".txtPageViews").val();
		var RPM = $(".txtRPM").val();
		if(PageViews!= "" && RPM !="")
		$(".txtRevenue").val((moneyFormat(parseFloat(PageViews/1000)*RPM)));
});

	$(".txtRevenue_upd").focus(function(){

	//update
		
		var PageViews_upd = $(".txtPageViews_upd").val();
		var RPM_upd = $(".txtRPM_upd").val();
		if(PageViews_upd!= "" && RPM_upd !="")
		$(".txtRevenue_upd").val((moneyFormat(parseFloat(PageViews_upd/1000)*RPM_upd)));
});
        
}

function AllClickFunction() {
	$('.btnSaveChanges').click(function () {
		var duplicationEmail = false;
		/*if (!validateForm('.frmStatistics'))
		//return;*/

		var UserId = $('.ddlUsers').val();
		var PageViews = $('.txtPageViews').val();
		var RPM = $('.txtRPM').val();
		var Revenue = $('.txtRevenue').val();
		var StatsDate = formatDate($('.txtStatsDate').val());
		CreateNewStatistics(UserId, PageViews, RPM, Revenue, StatsDate);
	});

	$('.btnUpdatesChanges').click(function () {
		
		if (!validateForm('.frmUsers_upd'))
			return;

		var UserId = $('.ddlUsers_upd').val();
		var PageViews = $('.txtPageViews_upd').val();
		var RPM = $('.txtRPM_upd').val();
		var Revenue = $('.txtRevenue_upd').val();
		var StatsDate = formatDate($('.txtStatsDate_upd').val());
		UpdateStatistics(StatsId, UserId, PageViews, RPM, Revenue, StatsDate);
	});

	$('.btnDelete').click(function () {

		DeleteStatistics(StatsId);
	});
	
    $('.btnRetreive').click(function () {
        $('#myTable  tr:not(:first)').remove();
		var temp = StatsList.filter(x=> formatDate2(x.StatsDate) >= formatDate2($('.txtFrom').val()) && formatDate2(x.StatsDate) <= formatDate2($('.txtTo').val()))
		var divTbodyGoalFund = $('.StatisticsListing').html('');
        $('#StatisticsListing').tmpl(temp).appendTo(divTbodyGoalFund);
        
        
         var PageViews = 0;
    var RPM = 0;
    var Revenue = 0;
    $.each(temp, function (i, item) {
        PageViews += parseFloat(item.PageViews);
        Revenue += parseFloat(item.Revenue);
        RPM += parseFloat(item.RPM);
    });
       $('#myTable tr:last').after('<tr style=" background-color: #d4e7ef;"><td class="ToHide"></td><td class="ToHide"></td><td class="ToHide"></td><td></td><td><strong>Total '+PageViews+'</strong></td><td><strong>Avg '+(RPM/temp.length).toFixed(2)+'</strong></td><td><strong>Total '+Revenue.toFixed(2)+'</strong></td><td class="ToHide"></td></tr>');
 HideDivRoleWise();
	});
}

function CreateNewStatistics(UserId, PageViews, RPM, Revenue, StatsDate)
{
	var request = $.ajax({
		method: "POST",
		url:    "../DatabaseFiles/FbStats.php?action=CreateNewStatistics",
		data: {"UserId":UserId, "PageViews":PageViews,"RPM":RPM,
		"Revenue":Revenue,"StatsDate":StatsDate}
	});
	request.done(function(data) {

		if( data==1)
			{	GetAllStatistics();
				showSuccess('Successfully Created!');
			}

		});
	request.fail(function(jqXHR, textStatus) {
		console.log(textStatus);

	});

}

function UpdateStatistics(StatsId,UserId, PageViews, RPM, Revenue, StatsDate)
{
	var request = $.ajax({
		method: "POST",
		url:    "../DatabaseFiles/FbStats.php?action=UpdateStatistics",
		data: {"StatsId":StatsId,"UserId":UserId, "PageViews":PageViews,"RPM":RPM,
		"Revenue":Revenue,"StatsDate":StatsDate}
	});
	request.done(function(data) {

		if( data==1)
			{	GetAllStatistics();
				showSuccess('Successfully Updated!');
			}

		});
	request.fail(function(jqXHR, textStatus) {
		console.log(textStatus);

	});

}

function DeleteStatistics(StatsId)
{
	var request = $.ajax({
		method: "POST",
		url:    "../DatabaseFiles/FbStats.php?action=DeleteStatistics",
		data: {"StatsId":StatsId}
	});
	request.done(function(data) {

		if( data==1)
			{	GetAllStatistics();
				$('#EditStat').modal('hide');
				showSuccess('Successfully Deleted!');
			}

		});
	request.fail(function(jqXHR, textStatus) {
		console.log(textStatus);

	});

}

function GetAllUsers()
{
	var request = $.ajax({
		method: "POST",
		url:    "../DatabaseFiles/FbStats.php?action=GetAllUsers",
		data: {}
	});
	request.done(function(data) {

		onGetAllUsers(data);
		
	});
	request.fail(function(jqXHR, textStatus) {
		console.log(textStatus);

	});
}

function onGetAllUsers(data)
{
	var res = data;
	
	var divTbodyGoalFund = $('.SearchUserListing').html('');
    $('#SearchUserListing').tmpl(res).appendTo(divTbodyGoalFund);
	FillDropDownByReference('.ddlUsers',res);
	FillDropDownByReference('.ddlUsers_upd',res);
}
function GetAllStatistics()
{
	
	var request = $.ajax({
		method: "POST",
		url:    "../DatabaseFiles/FbStats.php?action=GetAllStatistics",
		data: {}
	});
	request.done(function(data) {

		onGetAllStatistics(data);
		searchTable ();
		
	});
	request.fail(function(jqXHR, textStatus) {
		console.log(textStatus);

	});
}

function onGetAllStatistics(data)
{ try {
        //var res = jQuery.parseJSON(data);
        var d = new Date(); 
        var res = data;
        StatsList = res;
        
        var d = new Date();
        var n = d.getMonth()+1;
         var year = d.getFullYear();
       // var ListCurMonth = StatsList.filter(x=> d.getMonth(x.StatsDate) == d.getMonth());
        var ListCurMonth = StatsList.filter(x=> x.Month == n && x.Year ==year);
        var divTbodyGoalFund = $('.StatisticsListing').html('');
        $('#StatisticsListing').tmpl(ListCurMonth).appendTo(divTbodyGoalFund);
        
        
    var PageViews = 0;
    var RPM = 0;
    var Revenue = 0;
    $.each(ListCurMonth, function (i, item) {
        PageViews += parseFloat(item.PageViews);
        Revenue += parseFloat(item.Revenue);
        RPM += parseFloat(item.RPM);
    });
    if(res.length>0)
    {
    $('#myTable tr:last').after('<tr style=" background-color: #d4e7ef;"><td class="ToHide"></td><td class="ToHide"></td><td class="ToHide"></td><td></td><td><strong>Total '+PageViews+'</strong></td><td><strong>Avg '+(RPM/res.length).toFixed(2)+'</strong></td><td><strong>Total '+Revenue.toFixed(2)+'</strong></td><td class="ToHide"></td></tr>');

    }
    
    
 HideDivRoleWise();
    //InitiateDatatable();
}
    catch (Err) {
    	console.log(Err);
    }

}



function searchTable ()
{
    $(".txtSearch").keyup(function () {
        
        _this = this;
        // Show only matching TR, hide rest of them
        $.each($(".myTable tbody tr"), function () {
            if ($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1) {
                $(this).hide();
            }
            else {
                $(this).show();
            }
        });
        //total tr
     SearchCalculation();
        //total tr
    });
}

function SearchCalculation()
{
var SumPageViews = 0;
var SumRPM = 0;
var SumRevenue = 0;

$('.trUsers:visible').each(function() {

    var value = $(this).find('.tdPageViews').text();
    // add only if the value is number
    if(!isNaN(value) && value.length != 0) {
        SumPageViews += parseFloat(value);
    }
 var value = $(this).find('.tdRPM').text();
    // add only if the value is number
	value = value.replace('$','');
    if(!isNaN(value) && value.length != 0) {
        SumRPM += parseFloat(value);
    }
 var value = $(this).find('.tdRevenue').text();
value = value.replace('$','');
    // add only if the value is number
    if(!isNaN(value) && value.length != 0) {
        SumRevenue += parseFloat(value);
    }
    
    if($('.trUsers:visible').length>0)
     {
    $('.CalculateRow').remove();
    $('#myTable tr:last').after('<tr class="CalculateRow" style=" background-color: #d4e7ef;"><td class="tr  ToHide"></td><td class="ToHide"></td><td class="ToHide"></td><td></td><td><strong>Total '+SumPageViews+'</strong></td><td><strong>Avg '+(SumRPM/$('.trUsers:visible').length).toFixed(2)+'</strong></td><td><strong>Total '+SumRevenue.toFixed(2)+'</strong></td><td class="ToHide"></td></tr>');
  
     }
});
}
function editStatistics(selector) {
	objEditRow = $(selector).closest('tr');
	var UserId = objEditRow.find('.hdnUserId').val();
	StatsId = objEditRow.find('.hdnStatsId').val();

	$('.ddlUsers_upd').val(objEditRow.find('.hdnUserId').val()).change();
	$('.txtEmail_upd').val(objEditRow.find('.tdEmail').text());
	$('.txtFirstName_upd').val(objEditRow.find('.tdFirstName').text());
	$('.txtLastName_upd').val(objEditRow.find('.tdLastName').text());
	$('.txtPageViews_upd').val(objEditRow.find('.tdPageViews').text());
	$('.txtRPM_upd').val(objEditRow.find('.tdRPM').text().replace('$','').replace(',',''));
	$('.txtRevenue_upd').val(objEditRow.find('.tdRevenue').text().replace('$','').replace(',',''));
	$('.txtStatsDate_upd').val(objEditRow.find('.hdnStatsDate').val());




}

function selectUser(selector)
{
    objEditRow = $(selector).closest('tr');
	var UserId = objEditRow.find('.hdnUserId').val();
	$('.ddlUsers').val(UserId).change();
	$('#SearchUser').modal('hide');
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
		url:    "../DatabaseFiles/FbStats.php?action=EditStatus",
		data: {"UserId":UserId,"UserStatus":UserStatus}
	});
	request.done(function(data) {

		if( data==1)
			{	GetAllStatistics();
				showSuccess('Successfully Updated!');
			}

		});
	request.fail(function(jqXHR, textStatus) {
		console.log(textStatus);
	});
}