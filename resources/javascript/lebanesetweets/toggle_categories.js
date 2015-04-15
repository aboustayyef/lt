$(function(){
	$('#categorySwitch').change(function(){
		$('#curtain').show();
		window.location = ltApp.webRoot + $('#categorySwitch option:selected').data('target');
	});
});