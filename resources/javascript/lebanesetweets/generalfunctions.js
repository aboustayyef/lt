$(function(){
	ltApp.getGroup = function(){
		// inspired from: https://gist.github.com/jlong/2428561
		var url = document.createElement('a');
		url.href = window.location.href;
		var parts = url.pathname.split('/');
		var parameters = url.search;
		if (parts[1] == "") {
			parts[1] = 'all';
		};
		var object = {group: parts[1], search: parameters};
		return object;
	};
});