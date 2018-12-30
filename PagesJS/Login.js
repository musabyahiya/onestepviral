AllClickFunction();
KeyEnter();
function AllClickFunction() {
	$('.btnLogin').click(function () {

		var Email = $('.txtEmail').val();
		var Password = $('.txtPassword').val();

		Login(Email,Password);
	});

	$('#btnLogout').click(function () {
		alert('click');
		Logout();
	});

}

function KeyEnter()
{
    $(document).keypress(function(e) {
    if(e.which == 13) {
        $(".btnLogin").click();
    }
});
}

function Login(Email, Password)
{
	var request = $.ajax({
		method: "POST",
		url:    "DatabaseFiles/Login.php?action=Login",
		data: {"Email":Email, "Password":Password}
	});
	request.done(function(data) {
	    data = data;
		data=data.split('|');

		if(data[0]=="Success")
		{
			setCookie('RoleId', data[1], 1);
			setCookie('UTM', data[2], 1);
			setCookie('SocialUTM', data[3], 1);
			window.location = "/osv/Pages/Dashboard.php";
		}
		else
		{
			showError('Incorrect Username or Password!');
		}
	});
	request.fail(function(jqXHR, textStatus) {
		console.log(textStatus);

	});
}


