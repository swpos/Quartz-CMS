$('#select_all').click(function () {
    var checkboxes = $(this).closest('form').find(':checkbox');
    if ($(this).is(':checked')) {
        checkboxes.prop("checked", true);
    } else {
        checkboxes.prop("checked", false);
    }
});

$( document ).ready(function() {
	$('input[type="text"]').addClass('form-control');
	$('input[type="password"]').addClass('form-control');
	$('select').addClass('form-control');
	$('input[type="search"]').addClass('form-control');
	$('.dataTables_wrapper input[type="text"]').css('font-size','13px');
	$('.dataTables_wrapper input[type="text"]').css('font-weight','lighter');
	$('button').addClass('btn');
	$('input[type="submit"]').addClass('btn');
	$('button').addClass('btn-primary');
	$('input[type="submit"]').addClass('btn-primary');
});

function popup(mylink, windowname, w, h){
    if (! window.focus)return true;
    var href;
    if (typeof(mylink) == 'string')
       href=mylink;
    else
       href=mylink.href;
    window.open(href, windowname, "width="+w+",height="+h+",scrollbars=yes,toolbar=no" );
    return false;
}

function returnData(_value, field_id){
    document.getElementById(field_id).value = _value;
}