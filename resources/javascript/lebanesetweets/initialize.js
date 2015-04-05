$(function(){
	if ( typeof ltApp != 'object'){
          ltApp = {};
          ltApp.updating = false;
          ltApp.$container = $('.cards');
          ltApp.tweetsLoaded = 20; // initial count;
    }
});