
AllClickFunction();

GetAllHtmlCode();





function GetAllHtmlCode()
{
	
	var request = $.ajax({
		method: "POST",
		url:    "../DatabaseFiles/HtmlCode.php?action=GetAllHtmlCode",
		data: {}
	});
	request.done(function(data) {

		onGetAllHtmlCode(data);
		
	});
	request.fail(function(jqXHR, textStatus) {
		console.log(textStatus);

	});
}
function onGetAllHtmlCode(data)
{  try {
        
        var res = (data);
       // BindTextToSelector('.lblUserName',res[0].FirstName);

        $(".note-editable").html(res[0].HtmlCode);
        
    }
    catch (Err) {
    	console.log(Err);
    }

}
function AllClickFunction() {
	$('.btnUpdateCode').click(function () {
	    var HtmlCode = $('.note-editable').html(); //$('.txtHtmlCode').val();
       
		UpdateCode(HtmlCode);

	});

	
	

}
function UpdateCode(HtmlCode)
{
	var request = $.ajax({
		method: "POST",
		url:    "../DatabaseFiles/HtmlCode.php?action=UpdateCode",
		data: {"HtmlCode":HtmlCode}
	});
	request.done(function(data) {

		if( data==1)
			{	
				showSuccess('Successfully Updated!');
			}

		});
	request.fail(function(jqXHR, textStatus) {
		console.log(textStatus);

	});

}

function GetAllCity()
{
	var request = $.ajax({
		method: "POST",
		url:    "../DatabaseFiles/Users.php?action=GetAllCity",
		data: {}
	});
	request.done(function(data) {

		CityList = data;
		onGetAllCity(data);
		
	});
	request.fail(function(jqXHR, textStatus) {
		console.log(textStatus);

	});
}

function onGetAllCity(data)
{
	var res = data;
	FillDropDownByReference('.ddlCity',res);
	//FillDropDownByReference('.ddlCity_upd',res);
}

function AllChangeFunctions() {
	$('.ddlCountry').change(function () {
		var CountryId = $(this).val();
		var obj = CityList.filter(x=>x.CountryId == CountryId);
		onGetAllCity(obj);
	});

	
}

function GetUserInfo()
{
	var request = $.ajax({
		method: "POST",
		url:    "../DatabaseFiles/Users.php?action=GetUserInfo",
		data: {}
	});
	request.done(function(data) {

		onGetUserInfo(data);

	});
	request.fail(function(jqXHR, textStatus) {
		console.log(textStatus);

	});

}

function onGetUserInfo(data)
{
	var res = data;
	$('.txtFirstName').val(res[0].FirstName);
	$('.txtLastName').val(res[0].LastName);
	$('.txtPhone').val(res[0].Phone);
	$('.txtPassword').val(res[0].Password);
	$('.txtCountry').val(res[0].CountryId);
	$('.txtCity').val(res[0].CityId);
	$('.txtBankName').val(res[0].BankName);
	$('.txtAccountTitle').val(res[0].AccountTitle);
	$('.txtAccountNumber').val(res[0].AccountNumber);
	$('.txtPayEmail').val(res[0].PayEmail);
    $('.txtPayPalEmail').val(res[0].PayPalEmail);
    $('.txtFbURL').val(res[0].FbURL);
    
    
    // for Multiple Pages field
    res[0].Pages = res[0].Pages.substring(0, res[0].Pages.length - 1);
    arr = res[0].Pages.split('|');
 

}

$(document).ready(function() { 
    if(arr.length>0)
    {
         for(var i =0;i<arr.length-1;i++)
    {
        $(".pages-fields").append("<input type='text' class='form-control txtPages' placeholder='https://web.facebook.com/abc' />");
        
    }
    for(var i =0;i<arr.length;i++)
    {
        $('.txtPages')[i].value = arr[i];
    }
    
    }
  
   
    
    
});

