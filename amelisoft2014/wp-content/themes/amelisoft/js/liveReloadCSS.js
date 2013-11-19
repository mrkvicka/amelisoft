/* Document ready start */
$(document).ready(function() {
	/* Nette CSS Live Reload */
	var currentLink = $("head").find("link[media='screen']");
	function liveReloadCSS() {
		$.get(document.URL,{"do":"ReturnCSS"},function(data) {
			console.log(data);
			if(currentLink.attr("href") !== data) {
				currentLink.attr("href",data);
			}
		});
	}
    $(window).focus(liveReloadCSS);
    /*if($(window).width() < 768) {*/
    	setInterval(liveReloadCSS,1000);
    /*}*/
});
/* Document ready end */