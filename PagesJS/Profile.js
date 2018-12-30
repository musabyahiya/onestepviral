//GetAllCountry();
//GetAllCity();
GetUserInfo();
AllClickFunction();
var PagesText='';
var arr =[] ;
var PagesArr = [];
//AllChangeFunctions();

function AddField()
{
    var a = $(".txtPages:last-child")[0].outerHTML;
         $(".pages-fields").append(a);
         if( $(".txtPages").length>1)
         {
         $(".btnRemove").css("display","-webkit-inline-box");
         }
}

function RemoveField()
{
    
     if( $(".txtPages").length>1)
        {
            $(".txtPages").last().remove();
            PagesArr.pop();
        }
        if( $(".txtPages").length==1)
         {
         $(".btnRemove").css("display","none");
         }
}

function BindAllPagesText()
{
    for(var i =0;i<$(".txtPages").length;i++)
    {   PagesArr.push({Pages:$(".txtPages")[i].value});
        //PagesText += $(".txtPages")[i].value+'|';
    }
    
}
function GetAllCountry()
{
	var request = $.ajax({
		method: "POST",
		url:    "../DatabaseFiles/Users.php?action=GetAllCountry",
		data: {}
	});
	request.done(function(data) {

		onGetAllCountry(data);
		
	});
	request.fail(function(jqXHR, textStatus) {
		console.log(textStatus);

	});
}
function onGetAllCountry(data)
{
	var res = data;
	FillDropDownByReference('.ddlCountry',res);
	
}

function AllClickFunction() {
	$('.btnSaveChanges').click(function () {
        if($('.txtPayEmail').val()=='')
 		{
 			$('.txtPayEmail').val('N/A');
 		}
 		if($('.txtPayPalEmail').val()=='')
 		{
 			$('.txtPayPalEmail').val('N/A');
 		}
 		
 		if($('.txtBankName').val()=='')
 		{
 			$('.txtBankName').val('N/A');
 		}
 		if($('.txtAccountTitle').val()=='')
 		{
 			$('.txtAccountTitle').val('N/A');
 		}
 		if($('.txtAccountNumber').val()=='')
 		{
 			$('.txtAccountNumber').val('N/A');
 		}
 	/*	if($('.txtFbURL').val()=='')
 		{
 			$('.txtFbURL').val('N/A');
 		}*/
		if (!validateForm('.frmUsers'))
			return;

        BindAllPagesText();
		var FirstName = $('.txtFirstName').val();
		var LastName = $('.txtLastName').val();
		var Password = $('.txtPassword').val();
		var Phone = $('.txtPhone').val();
		var BankName = $('.txtBankName').val();
		var AccountTitle = $('.txtAccountTitle').val();
		var AccountNumber = $('.txtAccountNumber').val();
		var PayEmail = $('.txtPayEmail').val();
		var PayPalEmail = $('.txtPayPalEmail').val();
		var CountryId  = $('.txtCountry').val();
		var CityId  = $('.txtCity').val();
		var FbURL  = $('.txtFbURL').val();
		var Pages = JSON.stringify(PagesArr);

		UpdateProfileUsers(FirstName, LastName, Password, Phone, BankName,AccountTitle,AccountNumber,PayEmail,PayPalEmail,CountryId,CityId,FbURL,Pages);


	});

	
	

}
function UpdateProfileUsers(FirstName, LastName, Password, Phone, BankName,AccountTitle,AccountNumber,PayEmail,PayPalEmail,CountryId,CityId,FbURL,Pages)
{
	var request = $.ajax({
		method: "POST",
		url:    "../DatabaseFiles/Users.php?action=UpdateProfileUsers",
		data: {"FirstName":FirstName,"LastName":LastName,
		"Password":Password,"Phone":Phone,"BankName":BankName,"AccountTitle":AccountTitle,
		"AccountNumber":AccountNumber,"PayEmail":PayEmail,"PayPalEmail":PayPalEmail,"CountryId":CountryId,"CityId":CityId,"FbURL":FbURL,"Pages":Pages}
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
     var divTbodyGoalFund = $('.InputListing').html('');
    $('#InputListing').tmpl(JSON.parse(res[0].Pages)).appendTo(divTbodyGoalFund);
    if(JSON.parse(res[0].Pages).length>1)
    {
        $(".btnRemove").css("display","-webkit-inline-box");
        
    }
   // res[0].Pages = res[0].Pages.substring(0, res[0].Pages.length - 1);
    //arr = res[0].Pages.split('|');
 

}
/*
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
*/
