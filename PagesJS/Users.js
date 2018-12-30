
AllClickFunction();
GetAllUsers();

var objEditRow;
var CityList															
 //AllChangeFunctions()
var UserId;

function AllClickFunction() {
	$('.btnSaveChanges').click(function () {
		var duplicationEmail = false;
		
		if($('.txtBankName').val()=='')
 		{
 			$('.txtBankName').val('N/A');
 		}
 		if($('.txtAccountTitle').val()=='')
 		{
 			$('.txtAccountTitle').val('N/A');
 		}
 		if($('.txtPayEmail').val()=='')
 		{
 			$('.txtPayEmail').val('N/A');
 		}
 		if($('.txtAccountNumber').val()=='')
 		{
 			$('.txtAccountNumber').val('N/A');
 		}
 		if($('.txtUTM').val()=='')
 		{
 			$('.txtUTM').val('N/A');
 		}
		
		if (!validateForm('.frmUsers'))
			return;

		var Email = $('.txtEmail').val().toLowerCase();
		var FirstName = $('.txtFirstName').val();
		var LastName = $('.txtLastName').val();
		var Password = $('.txtPassword').val();
		var Phone = $('.txtPhone').val();
		var BankName = $('.txtBankName').val();
		var AccountTitle = $('.txtAccountTitle').val();
		var AccountNumber = $('.txtAccountNumber').val();
		var PayEmail = $('.txtPayEmail').val();
		var UTM = $('.txtUTM').val();
		var SocialUTM = $('.txtSocialUTM').val();
	//	var Pages = $('.txtPages').val();
		var Pages = '';

		if (!isValidEmailAddress(Email)) {
			showError("Email Id is Incorrect!");
			return;
		}

		$('.tdEmail').each(function () {
			var em = $(this).text().trim().toLowerCase();
			if (Email == em)
				duplicationEmail = true;
		});

		if (duplicationEmail) {
			showError("Email already exists");
			return;
		}

		CreateNewUsers(Email, FirstName, LastName, Password, 
			Phone, BankName,AccountTitle,AccountNumber,PayEmail,UTM,SocialUTM,Pages);


	});

	$('.btnUpdatesChanges').click(function () {
		
		if($('.txtBankName_upd').val()=='')
		{
			$('.txtBankName_upd').val('N/A');
		}
		if($('.txtAccountTitle_upd').val()=='')
		{
			$('.txtAccountTitle_upd').val('N/A');
		}
		if($('.txtPayEmail_upd').val()=='')
		{
			$('.txtPayEmail_upd').val('N/A');
		}
		if($('.txtAccountNumber_upd').val()=='')
		{
			$('.txtAccountNumber_upd').val('N/A');
		}
		if($('.txtUTM_upd').val()=='')
		{
			$('.txtUTM_upd').val('N/A');
		}
		if (!validateForm('.frmUsers_upd'))
			return;

		
		var Email = $('.txtEmail_upd').val().toLowerCase();
		var FirstName = $('.txtFirstName_upd').val();
		var LastName = $('.txtLastName_upd').val();
		var Password = $('.txtPassword_upd').val();
		var Phone = $('.txtPhone_upd').val();
		var BankName = $('.txtBankName_upd').val();
		var AccountTitle = $('.txtAccountTitle_upd').val();
		var PayEmail = $('.txtPayEmail_upd').val();
		var AccountNumber = $('.txtAccountNumber_upd').val();
		var UTM = $('.txtUTM_upd').val();
		var SocialUTM = $('.txtSocialUTM_upd').val();
		var Pages = $('.txtPages_upd').val();


		UpdateUsers(Email,FirstName, LastName, Password, 
			Phone, BankName,AccountTitle,PayEmail,AccountNumber,UTM,SocialUTM,Pages);
	});

	$('.btnDelete').click(function () {

		DeleteUsers(UserId);
	});

}

function DeleteUsers(UserId)
{
	var request = $.ajax({
		method: "POST",
		url:    "../DatabaseFiles/Users.php?action=DeleteUsers",
		data: {"UserId":UserId}
	});
	request.done(function(data) {

		if( data==1)
			{	GetAllUsers();
				$('#EditUsers').modal('hide');
				showSuccess('Successfully Deleted!');
			}

		});
	request.fail(function(jqXHR, textStatus) {
		console.log(textStatus);

	});

}

function CreateNewUsers(Email, FirstName, LastName, Password, 
	Phone, BankName,AccountTitle,AccountNumber,PayEmail,UTM,SocialUTM,Pages)
{
	var request = $.ajax({
		method: "POST",
		url:    "../DatabaseFiles/Users.php?action=CreateNewUsers",
		data: {"Email":Email, "FirstName":FirstName,"LastName":LastName,
		"Password":Password,"Phone":Phone,"BankName":BankName,"AccountTitle":AccountTitle,
		"AccountNumber":AccountNumber,
		"PayEmail":PayEmail,"UTM":UTM,"SocialUTM":SocialUTM,"Pages":Pages}
	});
	request.done(function(data) {

		if( data==1)
			{	GetAllUsers();
				showSuccess('Successfully Created!');
			}

		});
	request.fail(function(jqXHR, textStatus) {
		console.log(textStatus);

	});

}

function UpdateUsers(Email,FirstName, LastName, Password, Phone, BankName,AccountTitle,PayEmail,AccountNumber,UTM,SocialUTM,Pages)
{
	var request = $.ajax({
		method: "POST",
		url:    "../DatabaseFiles/Users.php?action=UpdateUsers",
		data: {"Email":Email,"UserId":UserId,"FirstName":FirstName,"LastName":LastName,
		"Password":Password,"Phone":Phone,"BankName":BankName,"AccountTitle":AccountTitle,
		"AccountNumber":AccountNumber,"PayEmail":PayEmail,"UTM":UTM,"SocialUTM":SocialUTM,"Pages":Pages}
	});
	request.done(function(data) {

		if( data==1)
			{	GetAllUsers();
				showSuccess('Successfully Updated!');
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
		url:    "../DatabaseFiles/Users.php?action=GetAllUsers",
		data: {}
	});
	request.done(function(data) {

		onGetAllUsers(data);
		searchTable ();
		
	});
	request.fail(function(jqXHR, textStatus) {
		console.log(textStatus);

	});
}

function onGetAllUsers(data)
{  try {
        //var res = jQuery.parseJSON(data);
        var res = data;

        var divTbodyGoalFund = $('.UsersListing').html('');
        $('#UsersListing').tmpl(res).appendTo(divTbodyGoalFund);
        HideDivRoleWise();
        //InitiateDatatable();
    }
    catch (Err) {
    	console.log(Err);
    }

}

function editUsers(selector) {
	objEditRow = $(selector).closest('tr');
	UserId = objEditRow.find('.hdnUserId').val();
	var UserStatus = objEditRow.find('.hdnUserStatus').val();

	$('.ddlUserStatus_upd').val(objEditRow.find('.hdnUserStatus').val()).change();
	$('.txtEmail_upd').val(objEditRow.find('.tdEmail').text());
	$('.txtFirstName_upd').val(objEditRow.find('.tdFirstName').text());
	$('.txtLastName_upd').val(objEditRow.find('.tdLastName').text());
	$('.txtPassword_upd').val(objEditRow.find('.tdPassword').text());
	$('.txtPhone_upd').val(objEditRow.find('.tdPhone').text());
	$('.txtBankName_upd').val(objEditRow.find('.tdBankName').text());
	$('.txtAccountTitle_upd').val(objEditRow.find('.tdAccountTitle').text());
	$('.txtAccountNumber_upd').val(objEditRow.find('.tdAccountNumber').text());
	$('.txtPayEmail_upd').val(objEditRow.find('.tdPayEmail').text());
	$('.txtUTM_upd').val(objEditRow.find('.tdUTM').text());
	$('.txtSocialUTM_upd').val(objEditRow.find('.tdSocialUTM').text());
	$('.txtPages_upd').val(objEditRow.find('.hdnPages').val());


}

function EditStatus(selector)
{
	objEditRow = $(selector).closest('tr');
	UserId = objEditRow.find('.hdnUserId').val();
	var UserStatus =objEditRow.find('.hdnUserStatus').val();

	var request = $.ajax({
		method: "POST",
		url:    "../DatabaseFiles/Users.php?action=EditStatus",
		data: {"UserId":UserId,"UserStatus":UserStatus}
	});
	request.done(function(data) {

		if( data==1)
			{	GetAllUsers();
				showSuccess('Successfully Updated!');
			}

		});
	request.fail(function(jqXHR, textStatus) {
		console.log(textStatus);

	});
}

function htmlBr( Json)
{
    Json = JSON.parse(Json);
var b = '';
$.each(Json, function(i, item) {
    if(i==Json.length)
    {
        b += Json[i].Pages;
    }
    else
    {
   b += Json[i].Pages +'<br>';
    }
});
return b;
}



