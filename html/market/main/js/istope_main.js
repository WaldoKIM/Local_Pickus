$(function(){

	var $container = $('#imglistBox');

	$container.isotope({
		masonry: {
			columnWidth: 2
		},
		sortBy: 'original-order',
		getSortData: {
			number: function( $elem ) {
					var number = $elem.hasClass('element') ? 
					$elem.find('.number').text() :
					$elem.attr('data-number');
					return parseInt( number, 10 );
				},
			alphabetical: function( $elem ) {
				var name = $elem.find('.name'),
				itemText = name.length ? name : $elem;
				return itemText.text();
			}
		}
	});

	var $optionSets = $('#options .option-set'),
	$optionLinks = $optionSets.find('a');

	$optionLinks.click(function(){
		var $this = $(this);
		// don't proceed if already selected
		if ( $this.hasClass('selected') ) {
		return false;
	}
	var $optionSet = $this.parents('.option-set');
	$optionSet.find('.selected').removeClass('selected');
	$this.addClass('selected');

	// make option object dynamically, i.e. { filter: '.my-filter-class' }
	var options = {},
	key = $optionSet.attr('data-option-key'),
	value = $this.attr('data-option-value');
	// parse 'false' as false boolean
	value = value === 'false' ? false : value;
	options[ key ] = value;
	if ( key === 'layoutMode' && typeof changeLayoutMode === 'function' ) {
		// changes in layout modes need extra logic
		changeLayoutMode( $this, options )
		} else {
		// otherwise, apply new options
		$container.isotope( options );
	}
	return false;
	});

	var ajaxError = function(){
		$sitesTitle.removeClass('loading').addClass('error')
		.text('Could not load sites using Isotope :(');
	};
/*
	// dynamically load sites using Isotope from Zootool
	$.getJSON('http://zootool.com/api/users/items/?username=desandro' +
	'&apikey=8b604e5d4841c2cd976241dd90d319d7' +
	'&tag=bestofisotope&callback=?')
	.error( ajaxError )
	.success(function( data ){

	// proceed only if we have data
	if ( !data || !data.length ) {
		ajaxError();
		return;
	}
	var items = [],
	item, datum;

	for ( var i=0, len = data.length; i < len; i++ ) {
		datum = data[i];
		item = '<li><a href="' + datum.url + '">'
		+ '<img src="' + datum.image.replace('/l.', '/m.') + '" />'
		+ '<b>' + datum.title + '</b>'
		+ '</a></li>';
		items.push( item );
	}

	var $items = $( items.join('') )
	.addClass('example');

	// set random number for each item
	$items.each(function(){
		$(this).attr('data-number', ~~( Math.random() * 100 + 15 ));
	});

	});
*/	
});



/* 자주하는질문과답변*/
var contentCollapse = {

    config: {
        fireSelector: '[data-toggle]',
        contentSelector: '.content_sens',
        openClass: '.open_sens',
        animate: true,
        duration: 300,
        easing: 'swing'
    },

    init: function(config) {

        $.extend(contentCollapse.config, config);

        $(contentCollapse.config.fireSelector).on('click', function(e) {

            var $activeTarget = $(this).parent();

            if ($activeTarget.hasClass(contentCollapse.config.openClass)) {
                contentCollapse.close($activeTarget);
                return;
            }

            contentCollapse.open($activeTarget);
        });
    },

    open: function($openSelector) {

        if(contentCollapse.config.animate){

            var $content = $openSelector.children(contentCollapse.config.contentSelector);
                
            $content.slideDown({
                'duration': contentCollapse.config.duration,
                'easing': contentCollapse.config.easing
            });
            $openSelector.addClass(contentCollapse.config.openClass);  

            return;
        }
        
        $openSelector.toggleClass('open');    
    },

    close: function($closeSelector) {

        if(contentCollapse.config.animate){

            var $content = $closeSelector.children(contentCollapse.config.contentSelector);

            $content.slideUp({
                'duration': contentCollapse.config.duration,
                'easing': contentCollapse.config.easing
            });
            $closeSelector.removeClass(contentCollapse.config.openClass);

            return;
        }
        
       $closeSelector.toggleClass('open');    
    }
}
