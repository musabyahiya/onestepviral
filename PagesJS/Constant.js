

ProgressBarHide();
DatePicker();
DatePickerMonth();
DatePickerMonthComplete();
DatePickerComplete();
DatePickerYear();
DatePickerMulti();
stopKeyPress();

var HCM_SetupMaster = {
    Vehicle: 10,
    Manufacturer: 11,
    ArrearType: 13,
    LoanType: 6,
    OverTimeRate: 14,
    SalaryStandard: 18,
    FuelType: 22,
    VehicleVariant: 23,
    YearSlabs: 34,
    IncrementType: 33

};

var Setup_EmployeeMatser_DesignationId =
{
    SPO: 1,
    RSM: 2
};

var HCM_SetupDetail =
{
    BasicInterest: 78,
    PFLoanTypeId: 97
}

var HCM_TaxLaw =
{
    TaxLaw34: 8
}

var HudsonReportConstants = {
    SSR: 1,
    BWS: 2
};


var Hudson_ReportTypes = [
{
    Id: 1,
    Value: 'SSR'
},
{
    Id: 2,
    Value: 'BWS'
}
];

var HCM_UploadType =
[{
    Id: 'Overtime',
    Value: 'Overtime'
}, {
    Id: 'AbsentLog',
    Value: 'AbsentLog'
}, {
    Id: 'Separation',
    Value: 'Separation'
}, {
    Id: 'ContractRenewal',
    Value: 'ContractRenewal'
}, {
    Id: 'Allowance',
    Value: 'Allowance'
}, {
    Id: 'BankAccount',
    Value: 'BankAccount'
}
];

function toggleDiv(div) {
    $(div).toggle();
}

function formatDate(_date) {
    if (_date == null)
        return;

    if (_date.indexOf('/') != -1) {
        var retDate = _date.substr(6, 4) + '-' + _date.substr(0, 2) + '-' + _date.substr(3, 2);
        return retDate;
    }
    else {
        if (_date == '' || _date == null || _date == undefined)
            return "";

        var d = new Date(_date);
        var month = (d.getMonth() + 1);
        var date = d.getDate();

        if (month >= 1 && month <= 9)
            month = '0' + month;

        if (date >= 1 && date <= 9)
            date = '0' + date;

        //return d.getFullYear() + '-' + month + '-' + date;
        return date + '-' + month + '-' + d.getFullYear();
    }
}

function formatDate2(_date) {
    if (_date == null)
        return;

    if (_date.indexOf('/') != -1) {
        var retDate = _date.substr(6, 4) + '-' + _date.substr(0, 2) + '-' + _date.substr(3, 2);
        return retDate;
    }
    else {
        if (_date == '' || _date == null || _date == undefined)
            return "";

        var d = new Date(_date);
        var month = (d.getMonth() + 1);
        var date = d.getDate();

        if (month >= 1 && month <= 9)
            month = '0' + month;

        if (date >= 1 && date <= 9)
            date = '0' + date;

        //return d.getFullYear() + '-' + month + '-' + date;
       return  month + '/' + date + '/' + d.getFullYear();
    }
}
function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function HideDivRoleWise()
{
    if(getCookie('RoleId')!="1")
    $('.ToHide').css({"display":"none"});
}
function copyToClipboard(text){
    var dummy = document.createElement("input");
    document.body.appendChild(dummy);
    dummy.setAttribute('value', text);
    dummy.select();
    document.execCommand("copy");
    document.body.removeChild(dummy);
}
function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}
function BindTextToSelector(Selector, Text)
{

    $( Selector ).html(Text);
}
function serializeData(selector) {
    data = "";
    $(selector).find('input, select, textarea').each(function () {
        data += $(this).attr("name") + "=" + $(this).val() + "&";
    });
    return data.replace(/&$/g, "");
}

function CSS_BorderAndColor(selector, color) {
    $(selector).css("border-style", "solid");
    $(selector).css("border-weight", "5px");
    $(selector).css("border-color", color);
    $(selector).css("border-width", "1px");
}
//function getUrlVars() {
//    var vars = [], hash;
//    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
//    for (var i = 0; i < hashes.length; i++) {
//        hash = hashes[i].split('=');
//        vars.push(hash[0]);
//        vars[hash[0]] = hash[1];
//    }
//    return vars;
//}
function getUrlVars() {
    var vars = [], hash;
    var url = window.location.href;
    var check = url.includes('%20');
    if (check == true) {
        url = url.replace(/%20/g, '');
    }
    var hashes = url.slice(url.indexOf('?') + 1).split('&');
    for (var i = 0; i < hashes.length; i++) {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
}
function validateForm(selector) {
    check = true;
    $(selector).find('select').each(function () {
        if ($(this).val() == 0 || $(this).val() == null) {
            CSS_BorderAndColor(this, 'red');
            showError('Check All Mandotary Fields');
            check = false;
        }
        else
            CSS_BorderAndColor(this, 'green');
    });

    $(selector).find('input, textarea').each(function () {
        if ($(this).val() == "") {
            CSS_BorderAndColor(this, 'red');
            showError('Check All Mandotary Fields');
            check = false;
        }
        else
            CSS_BorderAndColor(this, 'green');
    });
    return check;
}
function moneyFormat(Value)
{
    //Value = Value.toFixed(1).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
      Value = Value.toString().match(/^-?\d+(?:\.\d{0,2})?/)[0].replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"); //musab
  
    return Value;

}
function FillDropDownByReference(DropDownReference, res) {
    $(DropDownReference).empty().append('<option selected="selected" value="0">--Select--</option>');
    $(res).each(function () {
        $(DropDownReference).append($("<option></option>").val(this.Id).html(this.Value));
    });
}

function FillDropDownByReferenceSearch(DropDownReference, res) {
    $(DropDownReference).empty().append('<option selected="selected" value="0">--Select--</option>');
    $(res).each(function () {
        $(DropDownReference).append($("<option></option>").val(this.Id).html(this.Value));
    });
}
function ProgressBarShow() {
    $('#waitProgressBar').show();
    $('.loader').show();
}


function ProgressBarHide() {
    $('#waitProgressBar').hide();
    $('.loader').hide();
}

function cloneDiv(divToClone, divToAppend) {
    if (!validateForm(divToAppend))
        return;
    var cloned = $(divToClone).last().clone();
    resetControls(cloned);
    cloned.appendTo(divToAppend)
    DatePicker();
}

function showError(message) {
    AlertBox('Error!', message, 'error');
}

function showSuccess(message) {
    AlertBox('Success!', message, 'success');
}

function AlertBox(title, Message, type) {
    swal(title, Message, type);
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
function DatePickerMulti() {
    $('.DatePickerMulti').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true,
        multidate: true,
        onSelect: function (date) {
            // Your CSS changes, just in case you still need them
            alert(date);
        }
    });

}
function DatePickerComplete() {
    $('.DatePickerComplete').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true
    });
}


function DatePickerMonth() {
    $('.DatePickerMonth').datepicker({
        minViewMode: 1,
        keyboardNavigation: false,
        forceParse: false,
        autoclose: true,
        startDate: '2d+',
        todayHighlight: true
    });
}

function DatePickerYear() {
    $('.DatePickerYear').datepicker({
        minViewMode: 'years',
        keyboardNavigation: false,
        forceParse: false,
        autoclose: true,
        startDate: '2d+',
        todayHighlight: true,
        format: 'yyyy'
    });
}


function DatePickerMonthComplete() {
    $('.DatePickerMonthComplete').datepicker({
        minViewMode: 1,
        keyboardNavigation: false,
        forceParse: false,
        autoclose: true,
        todayHighlight: true
    });
}

function removeCloneDivs(div) {
    $(div).not(':first').remove();
}

function removeSelectedDiv(child, div) {
    if ($(child).closest(div).siblings().size() != 0)
        $(child).closest(div).remove();
}

function resetControls(selector) {
    $(selector).find('input, textarea').each(function () {
        $(this).val('');
    });
    $(selector).find('select').each(function () {
        $(this).val(0).change();
    });
}

function getCommaSeparatedValues(selector) {
    returnString = "";
    $(selector).each(function () {
        if ($(this).val() != null)
            returnString += $(this).val() + ','
    });
    return returnString + "0";

}


function getCommaSeparatedValues_CheckedBoxes(selector) {
    returnString = "";
    $(selector).each(function () {
        if ($(this).prop('checked')) {
            if ($(this).val() != null)
                returnString += $(this).val() + ','
        }
    });
    return returnString + "0";
}


function validateNumeric() {
    $('.numericOnly').keydown(function (e) {
        if (e.keyCode != 8) {
            if ($(this).val().indexOf(".") > 0 && e.keyCode == 110)
                return false;

            if (!((e.keyCode >= 48 && e.keyCode <= 57) || (e.keyCode >= 96 && e.keyCode <= 105) || (e.keyCode == 110) || (e.keyCode == 190))) {
                return false;
            }
        }
    });
}


function paginateTable(cls, lengthPerPage) {

    var totalRows = $(cls).find('tbody tr:has(td)').length;
    var recordPerPage = lengthPerPage;
    var totalPages = Math.ceil(totalRows / recordPerPage);

    var $pages = $(cls).find('tfoot');

    $pages.html('');

    var $select = $('<tr  ><td colspan="2"><select  class="form-control" id="tableSelect"><select></td><td><button type="button" id="prevv" class="btn btn-white"><i class="fa fa-chevron-left"></i> </button><button id="nextt" type="button" class="btn btn-white"><i class="fa fa-chevron-right"></i> </button></td>  </tr>').appendTo($pages);


    for (i = 0; i < totalPages; i++) {
        $('<option value = "' + (i + 1) + '">' + 'Page: ' + (i + 1) + '</option>').appendTo('#tableSelect');
    }



    $(cls).find('tbody tr:has(td)').hide();
    var tr = $('table tbody tr:has(td)');

    for (var i = 0; i <= recordPerPage - 1; i++) {
        $(tr[i]).show();
    }


    $('#prevv').click(function () {
        if (parseInt($('#tableSelect').val()) != 1)
            $('#tableSelect').val($('#tableSelect').val() - 1).change();
    });


    $('#nextt').click(function () {
        if (!(parseInt($('#tableSelect').val()) + 1 > totalPages))
            $('#tableSelect').val(parseInt($('#tableSelect').val()) + 1).change();
    });

    $('#tableSelect').change(function (event) {
        $(cls).find('tbody tr:has(td)').hide();
        var nBegin = ($(this).val() - 1) * recordPerPage;
        var nEnd = $(this).val() * recordPerPage - 1;
        $('#recordDisp').text(nBegin + ' ' + nEnd);
        for (var i = nBegin; i <= nEnd; i++) {
            $(tr[i]).show();
        }
    });



}


function removeBlankandNulls(val) {
    if (val == '' || val == null || val == undefined)
        return '----';
    else
        return val;
}


function stopKeyPress() {
    $('.keylock').keypress(function (event) {
        event.preventDefault();
    })
}

function FileUpload(fileselector) {
   // ProgressBarShow();
   var fileUpload = $(fileselector).get(0);
   var files = fileUpload.files;
   var data = new FormData();
   if (files.length <= 0) {
    showError('No File Uploaded!');
    ProgressBarHide();
    return '';
}

var filename = '';
var isError = false;
for (var i = 0; i < files.length; i++) {
    data.append('file', files[i]);
}
$.ajax({
    url: "../DatabaseFiles/FileUpload.php?action=FileUpload",
    type: "POST",
    data: data,
    async: false,
    contentType: false,
    processData: false,
    success: function (result) { filename = result },
    error: function (err) { showError("File Upload Failure"); isError = true; }
});

ProgressBarHide();
return filename;
}
function FileUploadHandler(fileselector) {
   // ProgressBarShow();
   var fileUpload = $(fileselector).get(0);
   var files = fileUpload.files;
   var data = new FormData();
   if (files.length <= 0) {
    showError('No File Uploaded!');
    ProgressBarHide();
    return '';
}

var filename = '';
var isError = false;
for (var i = 0; i < files.length; i++) {
    data.append(files[i].name, files[i]);
}
$.ajax({
    url: "UploadHandler.ashx",
    type: "POST",
    data: data,
    async: false,
    contentType: false,
    processData: false,
    success: function (result) { filename = result },
    error: function (err) { showError("File Upload Failure"); isError = true; }
});

ProgressBarHide();
return filename;
}


function excelOut(selector) {
    $(selector).table2excel({
        name: "Data",
        filename: "myFileName",
        fileext: ".xls"
    });
}
function exportTableToExcel(tableID, filename ){
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
    
    // Specify file name
    filename = filename?filename+'.xls':'excel_data.xls';
    
    // Create download link element
    downloadLink = document.createElement("a");
    
    document.body.appendChild(downloadLink);
    
    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['\ufeff', tableHTML], {
            type: dataType
        });
        navigator.msSaveOrOpenBlob( blob, filename);
    }else{
        // Create a link to the file
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;

        // Setting the file name
        downloadLink.download = filename;
        
        //triggering the function
        downloadLink.click();
    }
}
function sendPrint(selector) {
    $(selector).printThis();
}

function BindGroupByDDL() {
    //alert(HCM_ArrGroupBy.length);
    FillDropDownByReference('.ddlGroupBy', HCM_ArrGroupBy);
}

function isValidEmailAddress(emailAddress) {
    var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
    return pattern.test(emailAddress);
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
    });
}
function InitiateDatatable()
{
     $(document).ready(function(){
            $('.dataTables-example').DataTable({
                destroy: true,
                pageLength: 25,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    { extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'ExampleFile'},
                    {extend: 'pdf', title: 'ExampleFile'},

                    {extend: 'print',
                     customize: function (win){
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');

                            $(win.document.body).find('table')
                                    .addClass('compact')
                                    .css('font-size', 'inherit');
                    }
                    }
                ]

            });

        });

}
function Pagination(page , json, perpage)
{
    
    var recPerPage = perpage;
    // Use Math.max to ensure that we at least start from record 0
   var  startRec = Math.max(page - 1, 0) * recPerPage;
    // The end index of Array.splice doesn't have to be within boundaries,
    // But if you want to ensure that it does, then use
    // Math.min(startRec + recPerPage, json.table.length)
  var  endRec = startRec + perpage;
  var  recordsToShow = json.slice(startRec, endRec);
  return recordsToShow;
}
