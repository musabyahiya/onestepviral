
AllClickFunction();
GetAllPaymentStatus();
GetAllPayout();
GetAllUsers();
//CalculateOnFocus();
HideControl();
var objEditRow;
var PayoutId;
var PayoutList;

function AllClickFunction() {

	$('.btnSaveChanges').click(function () {

		var UserId = $('.ddlUsers').val();
		var PaymentStatusId = $('.ddlPaymentStatus').val();
		var Duration = $('.txtDuration').val();
		var Amount = $('.txtAmount').val();
		var Comments = $('.txtComments').val();
		var ConversionRate = $('.txtConversionRate').val();
		var Revenue = $('.txtRevenue').val();
		var FilePath = FileUpload('#txtFile');
		CreateNewPayout(UserId,PaymentStatusId, Duration,Amount,Comments, ConversionRate,Revenue,FilePath);
		

	});

	$('.btnUpdatesChanges').click(function () {
		
		
		var UserId = $('.ddlUsers_upd').val();
		var PaymentStatusId = $('.ddlPaymentStatus_upd').val();
		var Duration = $('.txtDuration_upd').val();
		var Amount = $('.txtAmount_upd').val();
		var Comments = $('.txtComments_upd').val();
		var ConversionRate = $('.txtConversionRate_upd').val();
		var Revenue = $('.txtRevenue_upd').val();
		var FilePath = FileUpload('#txtFile_upd');
		UpdatePayout(UserId,PaymentStatusId, Duration,Amount,Comments, ConversionRate,Revenue,FilePath);
	});

	$('.btnDelete').click(function () {

		DeletePayout(PayoutId);
	});

     $('.btnRetreive').click(function () {
        $('#myTable  tr:not(:first)').remove();
		var temp = PayoutList.filter(x=> formatDate2(x.CreatedDate) >= formatDate2($('.txtFrom').val()) && formatDate2(x.CreatedDate) <= formatDate2($('.txtTo').val()))
		var divTbodyGoalFund = $('.PayoutListing').html('');
        $('#PayoutListing').tmpl(temp).appendTo(divTbodyGoalFund);
        
	});
}


function CreateNewPayout(UserId,PaymentStatusId, Duration,Amount,Comments, ConversionRate,Revenue, FilePath)
{
	var request = $.ajax({
		method: "POST",
		url:    "../DatabaseFiles/Payout.php?action=CreateNewPayout",
		data: {"UserId":UserId,"PaymentStatusId":PaymentStatusId, "Duration":Duration,"Amount":Amount,"Comments":Comments,"ConversionRate":ConversionRate,"Revenue":Revenue,
		"FilePath":FilePath
	}
});
	request.done(function(data) {

		if( data==1)
			{	GetAllPayout();
				showSuccess('Successfully Created!');
			}

		});
	request.fail(function(jqXHR, textStatus) {
		console.log(textStatus);

	});

}
function selectUser(selector)
{
    objEditRow = $(selector).closest('tr');
	var UserId = objEditRow.find('.hdnUserId').val();
	$('.ddlUsers').val(UserId).change();
	$('#SearchUser').modal('hide');
}
function HideControl()
{
	var html = " <div class='panel panel-primary ToHide' style='margin-top: 20px;'> <div class='panel-heading'> Payout </div><div class='panel-body'> <input type='button' data-toggle='modal' data-target='#CreatePayout' class='btn btn-primary' value='Create New Payout'/> </div></div>";
	if(getCookie('RoleId')=="1")
	{
		$(html).insertAfter($(".BindAfter"));
	}
}
function GetAllUsers()
{
	var request = $.ajax({
		method: "POST",
		url:    "../DatabaseFiles/Payout.php?action=GetAllUsers",
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

function UpdatePayout(UserId ,PaymentStatusId, Duration,Amount,Comments, ConversionRate,Revenue,FilePath)
{
	var request = $.ajax({
		method: "POST",
		url:    "../DatabaseFiles/Payout.php?action=UpdatePayout",
		data: {"PayoutId":PayoutId,"UserId":UserId,"PaymentStatusId":PaymentStatusId,
		"Duration":Duration,"Amount":Amount,"Comments":Comments,"ConversionRate":ConversionRate,"Revenue":Revenue,"FilePath":FilePath}
	});
	request.done(function(data) {

		if( data==1)
			{	GetAllPayout();
				showSuccess('Successfully Updated!');
			}

		});
	request.fail(function(jqXHR, textStatus) {
		console.log(textStatus);

	});

}

function DeletePayout(PayoutId)
{
	var request = $.ajax({
		method: "POST",
		url:    "../DatabaseFiles/Payout.php?action=DeletePayout",
		data: {"PayoutId":PayoutId}
	});
	request.done(function(data) {

		if( data==1)
			{	GetAllPayout();
				$('#EditPayout').modal('hide');
				showSuccess('Successfully Deleted!');
			}

		});
	request.fail(function(jqXHR, textStatus) {
		console.log(textStatus);

	});

}

function GetAllPaymentStatus()
{	
	var request = $.ajax({
		method: "POST",
		url:    "../DatabaseFiles/Payout.php?action=GetAllPaymentStatus",
		data: {}
	});
	request.done(function(data) {

		onGetAllPaymentStatus(data);
		
	});
	request.fail(function(jqXHR, textStatus) {
		console.log(textStatus);

	});
}

function onGetAllPaymentStatus(data)
{
	var res = data;
	FillDropDownByReference('.ddlPaymentStatus',res);
	FillDropDownByReference('.ddlPaymentStatus_upd',res);
	

}
function GetAllPayout()
{
	
	var request = $.ajax({
		method: "POST",
		url:    "../DatabaseFiles/Payout.php?action=GetAllPayout",
		data: {}
	});
	request.done(function(data) {

		onGetAllPayout(data);
		searchTable ();
		
	});
	request.fail(function(jqXHR, textStatus) {
		console.log(textStatus);

	});
}

function onGetAllPayout(data)
{ try {
        //var res = jQuery.parseJSON(data);
        var res = data;
        PayoutList = res;
        var d = new Date();
        var n = d.getMonth()+1;
         var year = d.getFullYear();
    
        var ListCurMonth = PayoutList.filter(x=> x.Month == n && x.Year ==year);
        var divTbodyGoalFund = $('.PayoutListing').html('');
        $('#PayoutListing').tmpl(ListCurMonth).appendTo(divTbodyGoalFund);
        HideDivRoleWise();
        // InitiateDatatable();
    }
    catch (Err) {
    	console.log(Err);
    }

}

function CalculateOnFocus()
{
	$(".txtAmount").focus(function(){
		var ConversionRate = $(".txtConversionRate").val();
		var Revenue = $(".txtRevenue").val();
		if(ConversionRate!= "" && Revenue !="")
		$(".txtAmount").val(parseFloat(ConversionRate*Revenue));
});

	$(".txtAmount_upd").focus(function(){
		var ConversionRate_upd = $(".txtConversionRate").val();
		var Revenue_upd = $(".txtRevenue_upd").val();
		if(ConversionRate_upd!= "" && Revenue_upd !="")
		$(".txtAmount_upd").val(parseFloat(ConversionRate_upd*Revenue_upd));
});

}

function editPayout(selector) {
	objEditRow = $(selector).closest('tr');
	PayoutId = objEditRow.find('.hdnPayoutId').val();
	var UserId = objEditRow.find('.hdnUserId').val();
	var PaymentStatusId = objEditRow.find('.hdnPaymentStatusId').val();
	$('.ddlUsers_upd').val(objEditRow.find('.hdnUserId').val()).change();;
	$('.ddlPaymentStatus_upd').val(objEditRow.find('.hdnPaymentStatusId').val());
	$('.txtDuration_upd').val(objEditRow.find('.tdDuration').text());
	$('.txtAmount_upd').val(objEditRow.find('.tdAmount').text());
	$('.txtComments_upd').val(objEditRow.find('.tdComments').text());
	$('.txtConversionRate_upd').val(objEditRow.find('.tdConversionRate').text());
    $('.txtRevenue_upd').val(objEditRow.find('.tdRevenue').text());


}


