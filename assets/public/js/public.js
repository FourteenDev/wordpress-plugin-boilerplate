(function($)
{
	'use strict';

	$(document).ready(function()
	{
		// Ensure required data and elements are present before attaching event handlers
		if (typeof fdwpbpData === 'undefined' || typeof fdwpbpData.ajaxUrl === 'undefined' || typeof fdwpbpData.nonce === 'undefined') return;

		// TODO: Uncomment this and modify values
		// FDWPBP.init();
	});

	var FDWPBP = {
		// Options
		option1: 1,
		option2: 2,

		// Strings
		stringOne: '', stringTwo: '',

		init()
		{
			this.initializeStrings();
			this.bindEvents();
		},

		/**
		 * Initializes strings from the fdwpbpData object.
		 *
		 * @returns	{void}
		 */
		initializeStrings()
		{
			if (typeof fdwpbpData.strings !== 'undefined')
			{
				this.stringOne = typeof fdwpbpData.strings.stringOne !== 'undefined' ? fdwpbpData.strings.stringOne : '';
				this.stringTwo = typeof fdwpbpData.strings.stringTwo !== 'undefined' ? fdwpbpData.strings.stringTwo : '';
			}
			this.stringOne = this.stringOne || 'String 1';
			this.stringTwo = this.stringTwo || 'String 2';
		},

		/**
		 * Binds events to elements.
		 *
		 * @returns	{void}
		 */
		bindEvents()
		{
			$(document).on('click', '.fdwpbp-button', function(e)
			{
				e.preventDefault();
				e.stopPropagation();
				e.stopImmediatePropagation();

				// Some functionality
			});
		}
	};
})(jQuery);
