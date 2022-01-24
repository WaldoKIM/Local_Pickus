(function($){
$(document).ready(function(){

$('#cssmenu li.active').addClass('open').children('ul').show();
	$('#cssmenu li.has-sub>a').on('click', function(){
		$(this).removeAttr('href');
		var element = $(this).parent('li');
		if (element.hasClass('open')) {
			element.removeClass('open');
			element.find('li').removeClass('open');
			element.find('ul').slideUp(200);
		}
		else {
			element.addClass('open');
			element.children('ul').slideDown(200);
			element.siblings('li').children('ul').slideUp(200);
			element.siblings('li').removeClass('open');
			element.siblings('li').find('li').removeClass('open');
			element.siblings('li').find('ul').slideUp(200);
		}
	});

});
})(jQuery);


/*첨부파일박스*/

(function ($) {

	var defaultOptions = {
		theme: 'cyan',
		value: '',
		icon : '',
		text : 'File'
	};

	var availableThemes = [
		'red',
	];

	$.fn.custominputfile = function(options) {
		this.each(function() {
			var cif = $(this);
			
			// Settings
			settings = $.extend(defaultOptions, options);
			
			// Use the DOM data attributs (those are used in priority)
			var setting = null;
			for(setting in settings)
				settings[setting] = (cif.data(setting)) ? cif.data(setting) : settings[setting];
			
			// Check theme availability
			if (availableThemes.indexOf(settings.theme) === -1)
				throw new Error('The theme "' + settings.theme + '" is not available.');

			// Create the custom input file
			createCustomInputFile.call(cif, settings);
		});
	};
	
	/**
	 * Create the CustomInputFile HTML
	 */
	var createCustomInputFile = function(settings) {
		var inputFile = this;
		
		/*----------------------------------------------
			HTML
		----------------------------------------------*/
		
		// Wrapper
		var wrapper = $('<div />', {
			class: 'cif-wrapper cif-theme-' + settings.theme
		});
		
		// Input
		var customInput = $('<input />', {
			type: 'text',
			class: 'cif-text',
			readonly: 'readonly',
			value: settings.value
		});

		// Browse button
		var customBrowseBtn = $('<a />', {
			class: 'cif-btn'
		});
		if(settings.icon !== '') {
			customBrowseBtn.append($('<span />', {
				class: settings.icon,
			}));
		}
		customBrowseBtn.append(((settings.icon !== '') ? '&nbsp;&nbsp;' : '') + settings.text);

		/*----------------------------------------------
			Events
		----------------------------------------------*/
	
		// Hide cursor
		customInput.on('focus', function() { this.blur(); });
		
		// Trigger input file
		customInput.on('click', function() { inputFile.trigger('click'); });
		customBrowseBtn.on('click', function() { inputFile.trigger('click'); });
		
		// Change value
		inputFile.on('change', function() {
			customInput.val($(this).val());
		});
		
		/*----------------------------------------------
			Display
		----------------------------------------------*/
	
		inputFile.addClass('hide').wrap(wrapper);
		inputFile.parent().append($('<div />', {
			class: 'cif-group'
		}).append(customInput).append(customBrowseBtn));
	};

}(jQuery));
