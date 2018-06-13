$(document).ready(function() { 
	$("input[type=text], textarea, select").attr('class', 'form-control');
	$("label, td, p").attr('class', 'control-label');
	$("button, input[type=submit], input[type=button]").attr('class', 'btn btn-primary');
	$("[bsmall]").attr('class', 'btn btn-primary btn-xs');
	$("[sformat]").attr('class', '');
	$("[ctotal]").css('width', '25%');
	$("[scampo]").css('width', '45%');
	$("#dtable").attr('class', 'table table-striped table-bordered');
	$(".dtable").attr('class', 'table table-striped table-bordered dtable');
	$("#dtable").DataTable();
});