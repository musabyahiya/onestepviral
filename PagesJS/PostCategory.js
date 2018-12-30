
AllClickFunction();

GetAllPostCategory();
var Page = 1;
var objEditRow;
var PostCategoryId;
var objPostCategory;

function AllClickFunction() {
	 $('.btnSaveChanges').click(function () {
        
        
        var PostCategory = $('.txtPostCategory').val();


        CreateNewPostCategory(PostCategory);
    });

    $('.btnUpdatesChanges').click(function () {
        
      
        var PostCategory = $('.txtPostCategory_upd').val();

        
        UpdatePostCategory(PostCategoryId, PostCategory);
    });

		$('.btnDelete').click(function () {
	
		DeletePostCategory(PostCategoryId);
	});

}


function CreateNewPostCategory(PostCategory)
{



	var request = $.ajax({
		method: "POST",
		url:    "../DatabaseFiles/PostCategory.php?action=CreateNewPostCategory",
		data: {"PostCategory":PostCategory}
	});
	request.done(function(data) {

		if( data==1)
			{	GetAllPostCategory();
				showSuccess('Successfully Created!');
			}

		});
	request.fail(function(jqXHR, textStatus) {
		console.log(textStatus);

	});

}

function UpdatePostCategory(PostCategoryId, PostCategory)
{
	var request = $.ajax({
		method: "POST",
		url:    "../DatabaseFiles/PostCategory.php?action=UpdatePostCategory",
		data: {"PostCategoryId":PostCategoryId,"PostCategory":PostCategory}
	});
	request.done(function(data) {

		if( data==1)
			{	GetAllPostCategory();
				showSuccess('Successfully Updated!');
			}

		});
	request.fail(function(jqXHR, textStatus) {
		console.log(textStatus);

	});

}

function DeletePostCategory(PostCategoryId)
{
	var request = $.ajax({
		method: "POST",
		url:    "../DatabaseFiles/PostCategory.php?action=DeletePostCategory",
		data: {"PostCategoryId":PostCategoryId}
	});
	request.done(function(data) {

		if( data==1)
			{	GetAllPostCategory();
				$('#EditPostCategory').modal('hide');
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
		url:    "../DatabaseFiles/PostCategory.php?action=GetAllPostCategory",
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
function GetAllPostCategory()
{
	
	var request = $.ajax({
		method: "POST",
		url:    "../DatabaseFiles/PostCategory.php?action=GetAllPostCategory",
		data: {}
	});
	request.done(function(data) {
         objPostCategory = data;
        //onGetAllPostCategory(Pagination(Page , objPostCategory, 12));
        onGetAllPostCategory(data);
        
		
	});
	request.fail(function(jqXHR, textStatus) {
		console.log(textStatus);

	});
}

function onGetAllPostCategory(data)
{ try {
        var res = jQuery.parseJSON(data);
       // var res = data;

        var divTbodyGoalFund = $('.PostCategoryListing').html('');
        $('#PostCategoryListing').tmpl(res).appendTo(divTbodyGoalFund);
    }
    catch (Err) {
    	console.log(Err);
    }

}


function editPostCategory(selector) {
	objEditRow = $(selector).closest('tr');
	 PostCategoryId = objEditRow.find('.hdnPostCategoryId').val();


	$('.txtPostCategory_upd').val(objEditRow.find('.tdPostCategory').text());




}
