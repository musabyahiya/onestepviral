GetAllCountry();
AllClickFunction();
GetAllCity();
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
	var res = data;;
	FillDropDownByReference('.ddlCountry',res);
	FillDropDownByReference('.ddlCountry_upd',res);
}

function GetAllCity()
{
	var request = $.ajax({
		method: "POST",
		url:    "../DatabaseFiles/City.php?action=GetAllCity",
		data: {}
	});
	request.done(function(data) {

		onGetAllCity(data);
		
	});
	request.fail(function(jqXHR, textStatus) {
		console.log(textStatus);

	});
}
function onGetAllCity(data)
{
	var res = data;;
	var divTbodyGoalFund = $('.CityListing').html('');
	$('#CityListing').tmpl(res).appendTo(divTbodyGoalFund);
}


function AllClickFunction() {
	$('.btnSaveChanges').click(function () {

		if (!validateForm('.frmCity'))
			return;

		var CountryId = $('.ddlCountry').val();
		var City = $('.txtCity').val();
		CreateNewCity(CountryId, City);


	});

}

function CreateNewCity(CountryId, City)
{	
	var request = $.ajax({
		method: "POST",
		url:    "../DatabaseFiles/City.php?action=CreateNewCity",
		data: {"CountryId":CountryId,"City":City}
	
});
	request.done(function(data) {

		if( data==1)
			{	GetAllCity();
				showSuccess('Successfully Created!');
			}

		});
	request.fail(function(jqXHR, textStatus) {
		console.log(textStatus);

	});

}
