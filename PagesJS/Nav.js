

GetAllMenus();
GetUserInfo();
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
        
        $(".BindHtmlCode").html(res[0].HtmlCode);
        
    }
    catch (Err) {
    	console.log(Err);
    }

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
{  try {
        
        var res = data;
        BindTextToSelector('.lblUserName',res[0].FirstName);
        
    }
    catch (Err) {
    	console.log(Err);
    }

}
function GetAllMenus()
{
	
	var request = $.ajax({
		method: "POST",
		url:    "../DatabaseFiles/Users.php?action=GetAllMenus",
		data: {}
	});
	request.done(function(data) {

		onGetAllMenus(data);
		
	});
	request.fail(function(jqXHR, textStatus) {
		console.log(textStatus);

	});
}

function onGetAllMenus(data)
{  try {
        //var res = jQuery.parseJSON(data);
        var res = data;
        if(res.length== 0)
        {
            //window.location.href = "../Login.php";
        }

        var html ='';
        $.each(res, function(key, value) {
        	html+="<li>";
        	
        	html+="<a href='"+value.MenuItemURL+"' data-toggle='tooltip' data-placement='right' title='"+value.MenuItemName+"'><i class='"+value.Icon+"'></i> <span class='nav-label'> "+value.MenuItemName+"</span> ";
        	html+="</a>";
        	html+="</li>";

        });
        $(html).insertAfter($(".AppendAfter"));
    }
    catch (Err) {
    	console.log(Err);
    }

}

