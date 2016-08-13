jQuery(window).load(function(){'use strict';

	// Home Content Height
	var slideHeight = $(window).height();
	$('#content.registration-page').css('height',slideHeight);

	$(window).resize(function(){'use strict',
		$('#content.registration-page').css('height',slideHeight);
	});

});