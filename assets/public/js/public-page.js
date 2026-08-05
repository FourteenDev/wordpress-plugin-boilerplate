(function($)
{
	'use strict';

	$(document).ready(function()
	{
		// This file will run on the front-end side of the website and ONLY on the single pages (when the post type = 'page')
		// You can create a similar file for other post types (just change the file name's postfix)
		// You can also use the fdwpbpData object in these files
		if (typeof fdwpbpData === 'undefined' || typeof fdwpbpData.postId === 'undefined' || typeof fdwpbpData.postType === 'undefined') return;

		// console.log(`Post ID: ${fdwpbpData.postId} - Post type: ${fdwpbpData.postType}`);
	});
})(jQuery);
