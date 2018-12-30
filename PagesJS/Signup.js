
AllClickFunction();
KeyEnter();
//GetAllCountry();
//GetAllCity();
//AllChangeFunctions();
var objEditRow;
var UserId;
var PagesText ='';
var PagesArr = [];
function KeyEnter()
{
    $(document).keypress(function(e) {
    if(e.which == 13) {
        $(".btnRegister").click();
    }
});
}

function AddField()
{
    var a = $(".txtPages:last-child")[0].outerHTML;
         $(".pages-fields").append(a);
         if( $(".txtPages:last-child").index()>1)
         {
         $(".btnRemove").css("display","-webkit-inline-box");
         }
}

function RemoveField()
{
    
     if( $(".txtPages:last-child").index()>0)
        {
            $(".txtPages:last-child").remove();
            PagesArr.pop();
        }
        if( $(".txtPages:last-child").index()<2)
         {
         $(".btnRemove").css("display","none");
         }
}

function BindAllPagesText()
{
    for(var i =0;i<$(".txtPages").length;i++)
    {
        PagesArr.push({Pages:$(".txtPages")[i].value});
       // PagesText += $(".txtPages")[i].value+'|';
    }
    
}
function AllClickFunction() {
	$('.btnRegister').click(function () {
		var duplicationEmail = false;
		if (!validateForm('.frmSignup'))
			return;
        BindAllPagesText();
		var Email = $('.txtEmail').val().toLowerCase();

		var FirstName = $('.txtFirstName').val();
		var LastName = $('.txtLastName').val();
		var Password = $('.txtPassword').val();
		var PasswordConfirm = $('.txtPasswordConfirm').val();
		var Phone = $('.txtPhone').val();
		var CountryId  = $('.txtCountry').val();
		var CityId  = $('.txtCity').val();
		var FbURL  = $('.txtFbURL').val();
		//var Pages  = PagesText;
		var Pages = JSON.stringify(PagesArr);
		

		if(Password!=PasswordConfirm)
		{
			showError("Password does not match!");
			return;
		}
		if (!isValidEmailAddress(Email)) {
			showError("Email Id is Incorrect!");
			return;
		}
		CheckUserEmail (Email,FirstName, LastName, Password, Phone, CountryId, CityId,FbURL,Pages);

		
		


	});

	

}

function GetAllCity()
{
	var request = $.ajax({
		method: "POST",
		url:    "DatabaseFiles/Users.php?action=GetAllCity",
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
	var res = data;;
	FillDropDownByReference('.txtCity',res);
	//FillDropDownByReference('.txtCity_upd',res);
}

function AllChangeFunctions() {
	$('.txtCountry').change(function () {
		var CountryId = $(this).val();
		var obj = CityList.filter(x=>x.CountryId == CountryId);
		onGetAllCity(obj);
	});

	
}
function GetAllCountry()
{
	var request = $.ajax({
		method: "POST",
		url:    "DatabaseFiles/Users.php?action=GetAllCountry",
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
	FillDropDownByReference('.txtCountry',res);
	
}

function CreateNewUsers(Email, FirstName, LastName, Password, Phone, CountryId, CityId, FbURL,Pages)
{
	var request = $.ajax({
		method: "POST",
		url:    "DatabaseFiles/Users.php?action=CreateNewUsersSignup",
		data: {"Email":Email, "FirstName":FirstName,"LastName":LastName,
		"Password":Password,"Phone":Phone, "CountryId":CountryId, "CityId":CityId,"FbURL":FbURL,"Pages":Pages}
	});
	request.done(function(data) {

		if( data==1)
		{	
			showSuccess('Successfully Created!, Now you have to wait for Admin Approval.');
			//window.location = "Login.php";
		}

	});
	request.fail(function(jqXHR, textStatus) {
		console.log(textStatus);

	});

}

function CheckUserEmail (Email,FirstName, LastName, Password, 
	Phone, CountryId, CityId,FbURL,Pages)
{	var request = $.ajax({
	method: "POST",
	url:    "DatabaseFiles/Users.php?action=CheckUserEmail",
	data: {"Email":Email}
});
request.done(function(data) {

	if( data==1)
	{	
		showError('Email already Exist!');
	}
	else

	{
		CreateNewUsers(Email, FirstName, LastName, Password, Phone, CountryId, CityId,FbURL,Pages);
	}

});
request.fail(function(jqXHR, textStatus) {
	console.log(textStatus);

});

}