/*! RiModal - A flexible and good looking modal window plugin for jQuery
* https://github.com/kensnyder/jQuery-RiModal
* Copyright (c) 2015 Ken Snyder; Licensed MIT */
(function($, window, document, undefined) {
	
	/**
	 * @class RiModal
	 * @constructor
	 * @param {Object} [options]  Modal settings
	 *   @param {String|Function} [options.title]  The title text to put on the dialog header
	 *   @param {String|Function|Object} [options.ajax]  A URL from which to download HTML for the content area  
	 *   @param {String|Function|Object} [options.iframe]  The iframe src to inject into the content area
	 *   @param {selector|HTMLElement|jQuery|Function|Object|String} [options.element]  A selector, element, or HTML string to inject into the content area
	 *   @param {String|Function} [options.text]  Text content to inject into the content area
	 *   @param {selector} [options.delegate]  A selector to which to delegate clicks (jQuery usage only)
	 *   @param {Number} [options.width=400]  The width of the content area. Use "full" for full width
	 *   @param {Number} [options.height=300]  The height of the content area. Use "full" for full height
	 *   @param {Number} [options.animation_duration=400]  The number of milliseconds over which to animate opening and closing
	 *   @param {Boolean} [options.draggable=false]  If true, allow dragging the dialog box
	 *   @param {String} [options.drag_handle=".ri-modal-title"]  The selector for the drag handle
	 *   @param {Boolean} [options.ghost_while_dragging=true]  If true, set modal contents opacity to 0 while dragging. If false, always show modal contents
	 *   @param {Boolean} [options.cover=true]  If true, cover the page with a gray div
	 *   @param {Boolean} [options.cover_closes=true]  If true, close the dialog when the cover is clicked
	 *   @param {String} [options.ease_open=riEaseOutQuart]  The jQuery easing to use for opening the dialog
	 *   @param {String} [options.ease_close=riEaseInQuart]  The jQuery easing to use for closing the dialog
	 *   @param {String} [options.destroy_on_close=true]  If true, remove DOM elements from document after closing
	 *   @param {Object} [options.html]  The html templates to use
	 *   @param {String} [options.html.cover]  The html for the cover
	 *   @param {String} [options.html.dialog]  The html for the dialog
	 *   @param {String} [options.iframe_query_suffix="hexmodal=1"]  A query parameter to add to the end of iframe URLs
	 *	 @param {String} [options.iframe_poll_interval=50]  Number of milliseconds between polls for iframe document ready and navigation
	 *   @param {Function} [options.onInit]  A function to call after modal is initialized but nothing has happened
	 *   @param {Function} [options.onRendered]  A function to call after dialog html has been constructed
	 *   @param {Function} [options.onCalculated]  A function to call after size and position is calculated
	 *   @param {Function} [options.onOpening]  A function to call just before opening the dialog
	 *   @param {Function} [options.onOpened]  A function to call just after opening the dialog
	 *   @param {Function} [options.onLoading]  A function to call before content is loaded
	 *   @param {Function} [options.onLoaded]  A function to call after content is loaded
	 *   @param {Function} [options.onFrameDocumentReady]  A function to call when framed document has fired DOMDocumentLoaded (if on same domain)
	 *   @param {Function} [options.onFrameNavigateStart]  A function to call when framed document begins to navigate to another page (if on same domain)
	 *   @param {Function} [options.onFrameNavigateReady]  A function to call when framed document has fired DOMDocumentLoaded after one or more navigations (if on same domain)
	 *   @param {Function} [options.onFrameNavigateLoaded]  A function to call when framed document has loaded after one or more navigations
	 *   @param {Function} [options.onDragging]  A function to call before dragging begins
	 *   @param {Function} [options.onDragged]  A function to call after dragging stops
	 *   @param {Function} [options.onResizing]  A function to call before modal is resized
	 *   @param {Function} [options.onResized]  A function to call after modal is resized
	 *   @param {Function} [options.onClosing]  A function to call just before closing the dialog
	 *   @param {Function} [options.onClosed]  A function to call just after closing the dialog
	 *   @param {Function} [options.onDestroying]  A function to call just before destroying a dialog
	 *   @param {Function} [options.onDestroyed]  A function to call just after destroying a dialog
	 * @example

	<!-- Using the $.RiModal constructor -->

	var modal = new $.RiModal({
		title: 'Dialog Title',
		iframe: '/dialog/content'
	}).open();
	
	<!-- Using data-modal-* attributes to set options -->
	
	<a href="#" 
		data-modal-title="Title" 
		data-modal-width="400" 
		data-modal-height="200" 
		data-modal-ajax="/more/info"
	>Click for modal</a>
	<script>$('a').riModal()</script>
	
	<!-- Note that content defaults to iframe equalling href -->
	
	<a href="/some/fullscreen/iframe" 
		data-modal-title="Title" 
		data-modal-width="full" 
		data-modal-height="full" 
	>Click for modal</a>
	<script>$('a').riModal()</script>
	
	<!-- ajax, iframe, content, element can be pulled from the given attribute -->
	
	<a href="/some/autoheight/ajax" 
		data-modal-title="Title" 
		data-modal-width="500" 
		data-modal-height="auto" 
	>Click for modal</a>
	<script>$('a').riModal({ ajax:{attribute:'href'} })</script>
	
	<!-- Using delegate to listen for a click on the given selector.
		 The modal title defaults to the origin element's text contents. 
		 Or title can be a function. -->
	
	<div id="movies">
		<a href="#" data-modal-ajax="/movie/101">A Christmas Story (PG, 1983)</a>
		<a href="#" data-modal-ajax="/movie/102">The Princess Bride (PG, 1987)</a>
	</div>
	<script>
	$('#movies').riModal({
		delegate: 'a',
		width: 600,
		height: 400,
		title: function() {
			return this.$origin.text().replace(/\(.+\)/, '');
		}
	});
	</script>
	
	<!-- Appending an existing element within the modal -->
	
	<div style="display:none">
		<div id="content">Modal Content</div>
	</div>
	<a href="#" data-modal-title="Modal Title!" data-modal-element="#content">Click to open modal</a>
	<script>
	$('a').riModal();
	</script>
	
	<!-- Closing a modal from within the modal's iframe -->
	
	<script>
	$.RiModal.get('self').close();
	</script>

	 */
	function RiModal(options) {
		this.initialize.apply(this, [].slice.call(arguments));
	}
	
	/**
	 * Options for new instances. See constructor for more information
	 * @property {Object} defaultOptions
	 * @static
	 */
	RiModal.defaultOptions = {
		title: '',
		width: 400,
		height: 300,
		animation_duration: 400,
		draggable: false,
		drag_handle: '.ri-modal-title',
		ghost_while_dragging: true,
		cover: true,
		cover_closes: true,
		ease_open: 'riEaseOutQuart',
		ease_close: 'riEaseInQuart',
		destroy_on_close: true,
		ajax: false,
		iframe: false,
		element: false,
		text: false,
		ajax_query_suffix: '',
		position: 'center-middle',
		offset: {x: 0, y: 0},
		iframe_query_suffix: 'hexmodal=1',
		iframe_poll_interval: 50,
		html: {
			cover: '<div class="ri-modal-cover"></div>',
			dialog: 
			'<div class="ri-modal-dialog">' +
				'<div class="ri-modal-inner">' +
					'<div class="ri-modal-header">' +
						'<h1 class="ri-modal-title"></h1>' +
						'<a class="ri-modal-close"><span>&times;</span></a>' +
					'</div>' +
					'<div class="ri-modal-content"></div>' +
				'</div>' +
			'</div>',
			message: '<div class="ri-modal-message"><div class="ri-modal-content"></div></div>'
		}
	};
	
	RiModal.nextZIndex = 10001;

	/**
	 * An array of active modals with the most recent on top
	 * @property {Object} activeModals
	 * @static
	 */
	RiModal.activeModals = [];

	/**
	 * Close the most recently created modals
	 * @method closeTop
	 * @static
	 * @returns {undefined}
	 */
	RiModal.closeTop = function() {
		var modal = this.get('top');
		if (modal) {
			modal.close();
		}
	};
	
	/**
	 * Get a particular modal
	 * @method get
	 * @static
	 * @param {String|Number} idx  A numeric index where the highest number is on top. OR one of "self", "top", "bottom". When "self" is given, we check for a parent frame or return the top-most window
	 * @returns {RiModal|undefined}  The RiModal instance or undefined if none match that specification
	 */
	RiModal.get = function(idx) {
		if (idx == 'self') {
			var top;
			if (window.parent && window.parent.jQuery && window.jQuery.RiModal) {
				top = window.parent.jQuery.RiModal.get('top');
				if (top && top.getContentType() == 'iframe') {
					return top;
				}
			}
			else {
				top = RiModal.get('top');
				if (top && !top.getContentType() == 'iframe') {
					return top;
				}
			}			
		}
		else if (idx == 'bottom') {
			idx = 0;
		}
		else if (idx == 'top' || arguments.length === 0) {
			idx = RiModal.activeModals.length - 1;
		}
		return RiModal.activeModals[idx];
	};

	/**
	 * Close all the created modals
	 * @method closeAll
	 * @static
	 * @returns {undefined}
	 */
	RiModal.closeAll = function() {
		while (RiModal.activeModals.length) {
			RiModal.closeTop();
		}
	};
	
	/**
	 * Cover the screen and show a message
	 * @method showMessage
	 * @param {String} [message]  A message to show alongside the spinner
	 * @param {Object} [options]  Additional options to send to RiModal constructor. See constructor for available options
	 * @param {Boolean} [options.reload]  Additional option: If true, reload page after opened
	 * @param {String} [options.redirect]  Additional option: If given, redirect to new page after opened
	 * @returns {RiModal}  The newly opened modal instance so it can be closed or manipulated
	 */
	RiModal.showMessage = function(message, options) {
		options = $.extend(true, {
			text: message || 'Loading...',
			html: {
				cover: RiModal.defaultOptions.html.cover,
				dialog: RiModal.defaultOptions.html.message
			},
			origin: false,
			width: 500,
			height: 'auto',
			draggable: false,
			cover_closes: false
		}, options || {});
		var modal = new RiModal(options);
		if (options.reload === true) {
			modal.one('Opened', function() {
				window.location.reload();
			});
		}
		if (options.redirect) {
			modal.one('Opened', function() {
				window.location.href = options.redirect;
			});
		}
		modal.open();
		return modal;
	};
	
	/**
	 * Remove the given instance from the list of active modals
	 * @method _removeFromActiveList
	 * @private
	 * @param {RiModal} toRemove
	 * @returns {undefined}
	 */
	RiModal._removeFromActiveList = function(toRemove) {
		var newList = [], i = 0, modal;
		while ((modal = RiModal.activeModals[i++])) {
			if (modal !== toRemove) {
				newList.push(modal);
			}
		}
		RiModal.activeModals = newList;	
	};
	
	/**
	 * The jQuery object for the cover element
	 * @property {jQuery} $cover
	 */
	/**
	 * The jQuery object for the outer modal element
	 * @property {jQuery} $dialog
	 */
	/**
	 * The jQuery object for the content element within the dialog
	 * @property {jQuery} $content
	 */	
	/**
	 * The options passed on instantiation or changed later (see constructor for descriptions)
	 * @property {Object} options
	 */
	/**
	 * The id for this instance - used to determine the next z-index to use
	 * @property {Number} id
	 */
	/**
	 * The type of content loaded: element, text, ajax, iframe
	 * @property {String} type
	 */
	/**
	 * The origin element
	 * @property {HTMLElement} origin
	 */	
	/**
	 * The origin jQuery object
	 * @property {jQuery} $origin
	 */	
	/**
	 * True if content has started to load
	 * @property {Boolean} isLoading
	 */		
	/**
	 * True if content is already loaded
	 * @property {Boolean} isLoaded
	 */		
	/**
	 * True if the opening animation is in progress
	 * @property {Boolean} isOpening
	 */		
	/**
	 * True if the modal is open
	 * @property {Boolean} isOpened
	 */		
	/**
	 * True if the closing animation is in progress
	 * @property {Boolean} isClosing
	 */		
	/**
	 * True if the modal is currently being dragged
	 * @property {Boolean} isDragging
	 */		
	/**
	 * True if the modal has ever been dragged
	 * @property {Boolean} wasDragged
	 */		
	/**
	 * True if the resizing animation is in progress
	 * @property {Boolean} isResizing
	 */	
	/**
	 * True if drag handlers have been attached to the modal title bar
	 * @property {Boolean} isDraggable
	 */	
	
	RiModal.prototype = {
		/**
		 * Initial setup
		 * @method initialize
		 * @param {Object} [options]  See constructor for available options
		 * @returns {undefined}
		 * 
		 */
		initialize: function(options) {
			var self = this;
			self.options = $.extend(true, {}, RiModal.defaultOptions);
			self.setOptions(options || {});
			self.id = uid++;
			self._setupEvents();
			/** 
			 * Fired after instantiation
			 * @event Init
			 * @example

	modal.on('Init', function(event) {
		setSomeMoreOptions(this);
	});

			 */				
			self.publish('Init');
			if (self.options.origin) {
				self.setOrigin(self.options.origin);
			}
		},
		setOptions: function(options) {
			var self = this;
			$.extend(true, self.options, options);
			self.options.draggable = booleanize(self.options.draggable);
			self.options.ghost_while_dragging = booleanize(self.options.ghost_while_dragging);
			self.options.cover = booleanize(self.options.cover);
			self.options.cover_closes = booleanize(self.options.cover_closes);
			self.options.destroy_on_close = booleanize(self.options.destroy_on_close);
			return self;
		},
		/**
		 * Setup events on the pubsub system
		 * @method _setupEvents
		 * @private
		 * @returns {undefined}
		 */
		_setupEvents: function() {
			var self = this;
			self._setupPubsub();
			self._attachStateListeners();
			// bind listeners passed in the options (e.g. onInitialize)
			for (var name in self.options) {
				if (name.match(/^on[A-Z0-9]/) && typeof self.options[name] == 'function') {
					self.on(name.slice(2), self.options[name]);
				}
			}			
		},	
		/**
		 * Attach events that set variables representing the current state
		 * @method _attachStateListeners
		 * @private
		 * @returns {undefined}
		 */
		_attachStateListeners: function() {
			var self = this;
			self.isLoading = false;
			self.isLoaded = false;
			self.isOpening = false;
			self.isOpened = false;
			self.isClosing = false;
			self.wasDragged = false;
			self.isDragging = false;			
			self.isResizing = false;			
			self.on('Loading', function() {
				self.isLoaded = false;
				self.isLoading = true;
			});
			self.on('Loaded', function() {
				self.isLoaded = true;
				self.isLoading = false;
			});
			self.on('Opening', function() {
				self.isOpened = false;
				self.isOpening = true;
			});
			self.on('Opened', function() {
				self.isOpened = true;
				self.isOpening = false;
			});
			self.on('Closing', function() {
				self.isClosing = true;
			});
			self.on('Closed', function() {
				self.isClosing = false;
				self.isOpened = false;
			});
			self.one('Dragging', function() {
				self.isDragging = true;
			});
			self.one('Dragged', function() {
				self.isDragging = false;
			});
			self.one('Dragged', function() {
				self.wasDragged = true;
			});
			self.on('Resizing', function() {
				self.isResizing = true;
			});
			self.on('Resized', function() {
				self.isResizing = false;
			});			
		},
		/**
		 * Setup publish/subscribe system that uses jQuery's event system. Allows subscribing this way: instance.bind('AfterFilter', myhandler)
		 * @method _setupPubsub
		 * @private
		 */
		_setupPubsub: function() {
			var self = this;
			self.pubsub = $(self);
			self.on = $.proxy(self.pubsub, 'on');
			self.off = $.proxy(self.pubsub, 'off');
			self.one = $.proxy(self.pubsub, 'one');
			self.trigger = $.proxy(self.pubsub, 'trigger');
			self.triggerHandler = $.proxy(self.pubsub, 'triggerHandler');
		},	
		/**
		 * Publish the given event name and send the given data
		 * @method publish
		 * @param {String} type  The name of the event to publish
		 * @param {Object} data  Additional data to attach to the event object
		 * @return {jQuery.Event}  The event object which behaves much like a DOM event object
		 */
		publish: function(type, data) {
			var self = this;
			var evt = $.Event(type);
			evt.target = self;
			if (data) {
				$.extend(evt, data);
			}
			self.trigger(evt);
			return evt;
		},
		/**
		 * Add the ri-modal-loading class to the dialog to enable showing a loading image
		 * @method showLoader
		 * @returns {RiModal}
		 */
		showLoader: function() {
			var self = this;
			self.$dialog.addClass('ri-modal-loading');
			return self;
		},
		/**
		 * Remove the ri-modal-loading class to the dialog to hide loading image
		 * @method hideLoader
		 * @returns {RiModal}
		 */		
		hideLoader: function() {
			var self = this;
			self.$dialog.removeClass('ri-modal-loading');
			return self;
		},
		/**
		 * Open and load the modal, including animation
		 * @method open
		 * @returns {RiModal}
		 */
		open: function() {
			var self = this;
			/** 
			 * Fired before opening animation
			 * @event Opening
			 * @ifprevented  Modal will not open
			 * @example

	modal.on('Opening', function(event) {
		if (somethingsNotRight()) {
			event.preventDefault();
		}
	});

			 */				
			var pubevt = self.publish('Opening');
			if (pubevt.isDefaultPrevented()) {
				self.isOpening = false;
				return;
			}
			RiModal.activeModals.push(self);
			// get size specifications
			if (self.options.cover) {
				// set overflow so our centering will ignore scroll bars
				$docEl.css('overflow-x', 'hidden');
				$docEl.css('overflow-y', 'hidden');
			}
			var size = self.calcSize();
			// render elements
			self.renderCover(size);			
			self.renderDialog(size);
			// set the modal title
			var title = '';
			if ('title' in self.options) {
				title = (typeof self.options.title == 'function' ? self.options.title.call(this) : String(self.options.title));
			}
			else if (this.origin && this.origin.tagName && this.origin.tagName.match(/^(a|button)$/i)) {
				title = this.$origin.text();
			}
			else if (this.origin && this.origin.tagName == 'INPUT' && this.origin.type && this.origin.type.match(/^(submit|button)$/i)) {
				title = this.$origin.val();
			}
			title = $.trim(title);
			if (title) {
                            self.setTitle(title);
			}
			$window.on('resize.rimodal' + self.id, debounce( 25, $.proxy(self, 'resize') ) );	
			// After opening is complete, hide loader or enable dragging or both
			self.one('Opened', function() {
				if (!self.isLoaded) {
					self.showLoader();
					self.one('Loaded', function() {
						self.hideLoader();
					});
				}
				if (self.options.draggable) {
					self.enableDragging();
				}
			});
			if (!self.isLoading && !self.isLoaded) {
				self.load();
			}
			return self;
		},
		/**
		 * Process options for content loaded from element, text, ajax, or iframe.
		 * Within this.options, if type is a function, the function will be run and the result will be used.
		 * Each option may also be an object such as {attribute:"href"} or {attribute:"data-url"} where this.origin.getAttribute(property) is used to get the value.
		 * If no specs exists in this.options, look for an href within the origin element.
		 * @method getContentSpecs
		 * @return {Object} specs  Specs used by load
		 * @return {selector|HTMLElement|jQuery|Function|Object|String|undefined} specs.element  The element to append to this.$content
		 * @return {String|Function|undefined} specs.text  The plain text to set this.$content
		 * @return {String|ObjectFunction||undefined} specs.ajax  URL or $.ajax options based on which to set this.$content
		 * @return {String|Function|undefined} specs.iframe  URL to use in iframe element within this.$content
		 */		
		getContentSpecs: function() {
			var self = this;
			var specs = {};
			$.each(['element','text','ajax','iframe'], function() {
				var type = typeof self.options[this];
				if (type == 'function') {					
					specs[this] = self.options[this].call(self, self.origin);
				}
				else if (type == 'object' && self.options[this].attribute && self.origin && self.origin.tagName) {
					specs[this] = self.origin.getAttribute(self.options[this].attribute);
				}
				else if (type != 'undefined') {
					specs[this] = self.options[this];
				}
			});
			if (specs.element) {
				specs.element = $(specs.element);
			}
			if (!specs.element && !specs.text && !specs.ajax && !specs.iframe) {
				var href = self.origin.getAttribute('href');
				if (href.slice(0, 1) == '#') {
					specs.iframe = href;
				}
				else {
					specs.element = href;
				}
			}
			return specs;
		},
		/**
		 * Get the type of content that is currently loaded. Either "element", "text", "ajax" or "iframe"
		 * @method getContentType
		 * @returns {String|undefined}
		 */
		getContentType: function() {
			return this.type;
		},
		/**
		 * Load content into this.$content according to this.options
		 * @method load
		 * @returns {RiModal}
		 * @chainable
		 */
		load: function() {
			var self = this;
			var url;
			var times;
			var poll;
			self.$content.removeClass('ri-modal-element ri-modal-text ri-modal-html ri-modal-ajax ri-modal-iframe ri-modal-empty');
			/** 
			 * Fired before content is loaded into this.$content
			 * @event Loading
			 * @ifprevented  No content will load inside this.$content
			 * @example

	modal.on('Loading', function(event) {
		if (contentNotAvailable()) {
			event.preventDefault();
			this.$content.html(alternateContent);
		}
	});

			 */		
			var pubevt = self.publish('Loading');
			if (pubevt.isDefaultPrevented()) {
				this.isLoading = false;
				return self;
			}
			var specs = self.getContentSpecs();
			if (specs.element) {
				self.type = 'element';
				if (typeof specs.element == 'string') {
					specs.element = $(specs.element);
				}
				self.$content.addClass('ri-modal-element').append(specs.element);
				self.handleAutoSizing();
				/** 
				 * Fired when modal content is loaded.
				 * For `element` or `text`, it is fired immediately after content is injected.
				 * For `ajax` it is fired after html is injected.
				 * For `iframe` it is fired after the window inside the iframe is completely loaded (images and all).
				 * @event Loaded
				 * @example

	modal.on('Loaded', function(event) {
		attachSomeEventsToContent(this.$content);
	});

				 */					
				self.publish('Loaded');
			}
			else if (specs.text) {
				self.type = 'text';
				self.$content.addClass('ri-modal-text').text(specs.text);
				self.publish('Loaded');
			}
			else if (typeof specs.ajax == 'object') {				
				self.type = 'ajax';
				self.$content.addClass('ri-modal-ajax');
				if (specs.ajax.url) {
					specs.ajax.url += (specs.ajax.url.match(/\?/) ? '&' : '?') + self.options.ajax_query_suffix;
				}
				$.ajax(specs.ajax)
					.done(function(html) {
						self.$content.html(html);
						self.handleAutoSizing();
					})
					.always(function() {
						self.publish('Loaded');
					})
				;
			}
			else if (typeof specs.ajax == 'string') {				
				self.type = 'ajax';
				url = specs.ajax + (specs.ajax.match(/\?/) ? '&' : '?') + self.options.ajax_query_suffix;
				self.$content.addClass('ri-modal-ajax').load(url, function() {
					self.handleAutoSizing();
					self.publish('Loaded');
				});
			}
			else if (specs.iframe) {
				times = 0;
				self.type = 'iframe';
				url = specs.iframe + (specs.iframe.match(/\?/) ? '&' : '?') + self.options.iframe_query_suffix;
				self.$iframe = $(document.createElement('iframe')).attr({
					frameborder: '0',
					name: 'mailform_mir',
					width: '100%',
					height: '100%',
					src: url
				}).one('load', function() {
					// first frame load is "onLoaded" event
					self.publish('Loaded');
				}).on('load', function() {
					/** 
					 * Fired (after navigation) when the window inside the iframe has fired the load event (only works with iframes in same domain)
					 * @event FrameNavigateLoad
					 * @example

	modal.on('FrameNavigateLoad', function(event) {
		$('a', event.document).each(highlightLink);
	});

					*/					
					if (++times > 1) {
						self.publish('FrameNavigateLoad');
					}
				});
				self.$content.addClass('ri-modal-iframe').append(self.$iframe);
				var poll = function() {
					// catch document ready and frame navigation on iframes if domain is same
					var frame, win, doc;
					try {
						if (
							(frame = self.$iframe[0]) &&
							(win = frame.contentWindow) &&
							(doc = win.document) &&
							doc.location != 'about:blank' &&
							doc.readyState.match(/^(interactive|complete)$/)
						) {
							/** 
							 * Fired when the document inside the iframe has fired DOMDocumentReady (only works with iframes in same domain)
							 * @event FrameDocumentReady
							 * @param {Window} window  The window object of the frame
							 * @param {Document} document  The document of the window of the frame
							 * @example

	modal.on('FrameDocumentReady', function(event) {
		$('a', event.document).each(highlightLink);
	});

							*/	
						   /** 
							* Fired (after navigation) when the document inside the iframe has fired DOMDocumentReady (only works with iframes in same domain)
							* @event FrameNavigateReady
							* @param {Window} window  The window object of the frame
							* @param {Document} document  The document of the window of the frame
							* @example

	modal.on('FrameNavigateReady', function(event) {
		$('.nav a', event.document).each(disableNavLink);
	});

							*/						
							self.publish(times === 0 ? 'FrameDocumentReady' : 'FrameNavigateReady', {
								window: win,
								document: doc
							});
							$(win).on('unload', function () {
								self.publish('FrameNavigateStart', {
									window: win,
									document: doc
								});
								setTimeout(poll, self.iframe_poll_interval);
							});
						}
						else {
							setTimeout(poll, self.iframe_poll_interval);
						}
					}
					catch (e) {
						// modal is closing or iframe domain is different
					}
				};
				setTimeout(poll, self.iframe_poll_interval);				
			}
			else {
				self.$content.addClass('ri-modal-empty');
				self.publish('Loaded');
			}
			return self;
		},
		/**
		 * Enable dragging the modal by the title bar (if not already enabled)
		 * @method enableDragging
		 * @returns {RiModal}
		 * @chainable
		 */
		enableDragging: function() {
			var self = this;
			if (self.isDraggable) {
				return;
			}
			self.isDraggable = true;
			self.$dialog.addClass('ri-modal-draggable');
			var $header = self.$dialog.find(self.options.drag_handle);
			var startOffset;
			var startDrag = function(evt) {
				/** 
				 * Fired before the modal is moved due to dragging TODO: rename to BeforeDrag
				 * @event Dragging
				 * @params {Event} mousedown  The mousedown event
				 * @ifprevented  Modal will not move
				 * @example

	modal.on('Dragging', function(event) {
		if (somethingsNotRight()) {
			event.preventDefault();
		}
	});

				*/				
				var pubevt = self.publish('Dragging', {mousedown:evt});
				if (pubevt.isDefaultPrevented()) {
					self.isDragging = false;
					return;
				}
				var draggableOffset = self.$dialog.offset();
				startOffset = {
					left: evt.pageX - draggableOffset.left,
					top: evt.pageY - draggableOffset.top
				};
				$document.on('mousemove', onMove);
				$document.on('mouseup', endDrag);
				// we must do opacity instead of display:none
				// because the page visibility api will cause
				// YouTube videos in iframes to restart the video
				if (self.options.ghost_while_dragging) {
					self.$content.css('opacity', 0.0);
				}
			};
			var endDrag = function(evt) {
				$document.unbind('mousemove', onMove);
				$document.unbind('mouseup', endDrag);
				if (self.options.ghost_while_dragging) {
					self.$content.css('opacity', 1);
				}
				/** 
				 * Fired after the modal is moved due to dragging
				 * @event Dragged
				 * @params {Event} mouseup  The mouseup event
				 * @example

	modal.on('Dragged', function(event) {
		provideSomeFeedback();
	});

				*/				
				self.publish('Dragged', {mouseup:evt});
			};
			var onMove = function(evt) {
				var newPosition = {
					left: evt.pageX - startOffset.left,
					top: Math.max(-18, evt.pageY - startOffset.top)
				};
				/** 
				 * Fired during a drag event
				 * @event Moving
				 * @params {Event} mousemove  The mousemove event
				 * @params {Object} newPosition  The new left and top of the modal
				 * @example

	modal.on('Moving', function(event) {
		updateCoordinatesText(event.mousemove);
	});

				*/					
				self.publish('Moving', {
					mousemove: evt,
					newPosition: newPosition
				});
				self.$dialog.offset(newPosition);
			};
			$header.on('mousedown.draggable', startDrag);			
			return self;
		},
		/**
		 * Disable dragging the modal by the title bar (if not currently disabled)
		 * @method disableDragging
		 * @returns {RiModal}
		 * @chainable
		 */		
		disableDragging: function() {
			var self = this;
			if (!self.isDraggable) {
				return;
			}
			self.isDraggable = false;
			self.$dialog.removeClass('ri-modal-draggable');
			var $header = self.$dialog.find(self.options.drag_handle);
			$header.off('mousedown.draggable');
			if (parseFloat(self.$content.css('opacity') || 0) < 1) {
				self.$content.css('opacity', 1);
			}
			return self;
		},
		/**
		 * Render the cover element (this.$cover) according to the given size specs (as generated by calcSize)
		 * @method renderCover
		 * @param {Object} size  See calcSize for expected values
		 * @returns {RiModal}
		 * @chainable
		 */
		renderCover: function(size) {
			var self = this;
			if (self.options.cover) {
				// get overflow specs
				var overflow = self.calcOverflow();
				// minimize window jitter by adding scrollbars to body if needed
				var $body = $('body');
				if (overflow.hasScrollbarX) {
					$body.css('overflow-x', 'scroll');
					self.one('Closed', function() {
						$body.css('overflow-x', '');
					});
				}
				if (overflow.hasScrollbarY) {
					$body.css('overflow-y', 'scroll');
					self.one('Closed', function() {
						$body.css('overflow-y', '');
					});
				}
				// add cover
				self.$cover = $(self.options.html.cover)
					.css({
						position: 'absolute',
						top: size.scrollTop + 'px',
						left: '0',
						width: size.viewportWidth + 'px',
						height: size.viewportHeight + 'px',
						// browser bug: chrome fails to render cover if opacity begins at 0 
						// (but if you inspect element it magically appears)
						opacity: '0.001',
						zIndex: RiModal.nextZIndex++
					})
					.appendTo(document.body)
					.animate({
						opacity: '1'
					}, self.options.animation_duration / 2)
				;
				if (self.options.cover_closes) {
					self.$cover.on( 'click', $.proxy(self, 'close') );
				}
			}
			else {
				self.$cover = $();
			}
			return self;
		},
		/**
		 * Render the dialog element (this.$dialog) according to the given size specs (as generated by calcSize)
		 * @param {Object} size
		 * @returns {RiModal}
		 * @chainable
		 */
		renderDialog: function(size) {
			var self = this;
			// add dialog
			self.$dialog = $(self.options.html.dialog)
				.css({
					position: 'absolute',
					top: size.originTop + 'px',
					left: size.originLeft + 'px',
					width: size.originWidth + 'px',
					height: size.originHeight + 'px',
					opacity: '0',
					zIndex: RiModal.nextZIndex++
				})
			;
			/** 
			 * Fired after modal elements are rendered and before they are appended to the DOM
			 * @event Rendered
			 * @example

	modal.on('Rendered', function(event) {
		addSomeCssClass(this);
	});

			 */				
			self.publish('Rendered');
			self.$dialog
				.appendTo(document.body)
				.animate({
					top: size.top + 'px',
					left: size.left + 'px',
					width: size.width + 'px',
					height: (size.height + 34) + 'px',
					opacity: '1'
				}, self.options.animation_duration, self.options.ease_close, function() {
					/** 
					 * Fired after modal is completely open (after animation)
					 * @event Opened
					 * @example

	modal.on('Opened', function(event) {
		setupSomething(this);
	});

					*/						
					self.publish('Opened');
				});
			self.$close = self.$dialog.find('.ri-modal-close').on( 'click', $.proxy(self, 'close') );
			self.$content = self.$dialog.find('.ri-modal-content')
				.css({
					width: size.width + 'px',
					height: size.height + 'px'
				})
			;
			return self;
		},
		/**
		 * Resize the modal according to this.options
		 * @method resize
		 * @returns {RiModal}
		 */
		resize: function(width, height) {
			var self = this;
			if (arguments.length == 2) {
				self.options.width = width;
				self.options.height = height;
			}
			var size = self.calcSize();
			/** 
			 * Fired before resizing begins, e.g. after window is resized
			 * @event Resizing
			 * @param {Object} size  Size specifications that will be used to resize. See calcSize for details
			 * @ifprevented  Resize is aborted
			 * @example

	modal.on('Rendered', function(event) {
		addSomeCssClass(this);
	});

			 */			
			var pubevt = self.publish('Resizing', {size:size});
			if (pubevt.isDefaultPrevented()) {
				self.isResizing = false;
				return self;
			}
			self.$cover.css({
				top: size.scrollTop + 'px',
				width: size.viewportWidth + 'px',
				height: size.viewportHeight + 'px'
			});
			if (self.options.draggable && self.wasDragged) {
				/** 
				 * Fired after resize animation completed
				 * @event Resized
				 * @param {Object} size  Size specifications that was used to resize. See calcSize for details
				 * @example

	modal.on('Resized', function(event) {
		tellUserSomething(this);
	});

				 */				
				// a draggable was dragged, so don't move or change size
				self.publish('Resized', {size:size});
			}
			else {
				// center then resize if needed
				self.$dialog.animate({
					top: size.top + 'px',
					left: size.left + 'px',
					width: size.width + 'px',
					height: (size.height + 34) + 'px'			
				}, self.options.animation_duration / 2, self.options.ease_open, function() {					
					self.publish('Resized', {size:size});
				});
				self.$content.animate({
					width: size.width + 'px',
					height: size.height + 'px'			
				}, self.options.animation_duration / 2, self.options.ease_open);
			}
			return self;
		},
		handleAutoSizing: function() {
			var self = this;
			if (self.options.height != 'auto') {
				return self;
			}
			// find old height
			var oldDialogHeight = self.$dialog.height();
			var oldContentHeight = self.$content.height();
			// let it loose for height
			self.$dialog.css('height', '');
			self.$content.css('height', '');
			// set our height
			self.options.height = self.$content.height() + 40;
			// set height back
			self.$dialog.css('height', oldDialogHeight);
			self.$content.css('height', oldContentHeight);
			// trigger resize animation
			self.resize();
			return self;
		},
		/**
		 * Calculate and return information about the horizontal and vertical scrollbars on the document element
		 * @method calcOverflow
		 * @returns {Object}
		 */
		calcOverflow: function() {
			var overflow = {};
			overflow.x = $docEl.css('overflow-x');
			overflow.y = $docEl.css('overflow-y');
			overflow.hasScrollbarX = overflow.x == 'scroll' || (overflow.x == 'auto' && docEl.scrollWidth > docEl.clientWidth);
			overflow.hasScrollbarY = overflow.y == 'scroll' || (overflow.y == 'auto' && docEl.scrollHeight > docEl.clientHeight);
			return overflow;
		},
		/**
		 * Calculate the dimensions for modal size and position
		 * @method calcSize
		 * @return {Number} size  The size specifications
		 * @return {Number} size.viewportWidth  The number of pixels horizontally available in the browser window
		 * @return {Number} size.viewportHeight  The number of pixels vertically available in the browser window
		 * @return {Number} size.scrollTop  The Y-coordinate of the top of the screen
		 * @return {Number} size.maxWidth  The maximum available width within the viewport after subtracting paddings and margins
		 * @return {Number} size.maxHeight  The maximum available height within the viewport after subtracting paddings and margins
		 * @return {Number} size.left  The left coordinate of the modal after animating
		 * @return {Number} size.top  The top coordinate of the modal after animating
		 * @return {Number} size.width  The width the modal will be after animating
		 * @return {Number} size.height  The height the modal will be after animating
		 * @return {Number} size.originWidth  The width of the origin element
		 * @return {Number} size.originHeight  The height of the origin element
		 * @return {Number} size.originTop  The top coordinate of the origin element
		 * @return {Number} size.originLeft  The left coordinate of the origin element
		 * @return {Number} size.timestamp  The Date timestamp of when the size was calculated		
		*/
		calcSize: function() {
			var self = this;
			// calculate size and position
			var size = {};
			var offset;
			// viewport
			size.viewportWidth = $window.width();
			size.viewportHeight = $window.height();
			size.scrollTop = window.pageYOffset || docEl.scrollTop;
			size.maxHeight = size.viewportHeight - 48 - 34;
			size.maxWidth = size.viewportWidth - 48;
			// width and height
			if (self.options.width == 'full') {
				size.width = size.maxWidth;
				size.left = 12;
			}
			else {
				size.width = Math.min(parseFloat(self.options.width), size.maxWidth);
				size.left = (self.options.left == undefined ? 
					Math.max(5, Math.floor( (size.viewportWidth - size.width - 30) / 2 )) :
					self.options.left
				);
			}
			if (self.options.height == 'full') {
				size.height = size.maxHeight;
				size.top = 12 + size.scrollTop;
			}
			else if (self.options.height == 'auto') {
				// TODO auto for elements/ajax
				// maybe set size to max, if loading, add handler for Loaded which calls .stop() and new animation
				size.height = Math.floor( size.maxHeight / 2 );
				size.top = (self.options.top == undefined ?
					Math.max(5, Math.floor( (size.viewportHeight - size.height - 60) / 2 )) :
					self.options.top
				) + size.scrollTop;
			}
			else {
				size.height = Math.min(parseFloat(self.options.height), size.maxHeight);
				size.top = (self.options.top == undefined ?
					Math.max(5, Math.floor( (size.viewportHeight - size.height - 60) / 2 )) :
					self.options.top
				) + size.scrollTop;
			}
			// top and left
			if (self.$origin) {
				offset = self.$origin.offset();
			}
			if (offset) {
				size.originWidth = self.$origin.outerWidth();
				size.originHeight = self.$origin.outerHeight();
				size.originTop = offset.top;
				size.originLeft = offset.left;
			}
			else {
				size.originWidth = 40;
				size.originHeight = 40;
				size.originTop = Math.floor( (size.viewportHeight / 2) - size.originHeight ) + size.scrollTop;
				size.originLeft = Math.floor( (size.viewportWidth / 2) - size.originWidth );
			}
			this.handlePositionOption(size);
			size.timestamp = + new Date();
			/** 
			 * Fired after size and dimensions are recalculated
			 * @event Calculated
			 * @param {Object} size  Size specifications that will be used to resize. See calcSize for details. Edit this property to cahnge the size that will be used.
			 * @example

	modal.on('Calculated', function(event) {
		tweakSomeDimensions(event.size);
	});

			 */				
			self.publish('Calculated', {size:size});
			return size;
		},
		/**
		 * Set the element used to grow from or shrink to
		 * @method setOrigin
		 * @param {HTMLElement|jQuery|String} origin
		 * @returns {RiModal}
		 */
		setOrigin: function(origin) {
			var self = this;
			self.$origin = $(origin);
			self.origin = self.$origin.get(0);
			return self;
		},
		/**
		 * Close and animate the modal
		 * @method close
		 * @returns {RiModal}
		 */
		close: function() {
			var self = this;
			/** 
			 * Fired before modal begins closing animation
			 * @event Closing
			 * @ifprevented  Modal will stay open
			 * @example

	modal.on('Closing', function(event) {
		if (somethingsNotRight()) {
			event.preventDefault();
		}
	});

			 */				
			var pubevt = self.publish('Closing');
			if (pubevt.isDefaultPrevented()) {
				self.isClosing = false;
				return self;
			}
			$window.off('resize.rimodal' + self.id);
			var size = self.calcSize();			
			self.$dialog.stop().animate({
				top: size.originTop + 'px',
				left: size.originLeft + 'px',
				width: size.originWidth + 'px',
				height: size.originHeight + 'px',
				opacity: '0'
			}, self.options.animation_duration, self.options.ease_close, function() {
				if (self.$cover.length === 0) {
					self.publish('Closed');
					if (self.options.destroy_on_close) {
						self.destroy();
					}
				}
			});
			self.$cover.stop().animate({
				opacity: '0'
			}, self.options.animation_duration * 1.5, self.options.ease_close, function() {
				/** 
				 * Fired after closing animation
				 * @event Closed
				 * @example

	modal.on('Closed', function(event) {
		updateSomething();
	});

				 */					
				$docEl.css('overflow-x', '');
				$docEl.css('overflow-y', '');				
				self.publish('Closed');
				if (self.options.destroy_on_close) {
					self.destroy();
				}
			});
			RiModal._removeFromActiveList(self);
			return self;
		},
		/**
		 * Remove all DOM elements from the document
		 * @returns {RiModal}
		 * @chainable
		 */
		destroy: function() {
			var self = this;
			/** 
			 * Fired before modal elements are removed from document
			 * @event Destroying
			 * @ifprevented  Modal will remain
			 * @example

	modal.on('Destroying', function(event) {
		if (userIsntSure()) {
			event.preventDefault();
		}
	});

			 */				
			var pubevt = self.publish('Destroying');
			if (pubevt.isDefaultPrevented()) {
				return self;
			}
			self.$content = undefined;
			self.$cover.empty().remove();
			self.$dialog.empty().remove();
			self.$cover = undefined;
			self.$dialog = undefined;
			/** 
			 * Fired after modal elements are removed from document
			 * @event Destroyed
			 * @example

	modal.on('Destroyed', function(event) {
		cleanUpSomething();
	});

			 */				
			self.publish('Destroyed');
			return self;
		},
		/**
		 * Hide the dialog and cover
		 * @method hide
		 * @returns {RiModal}
		 * @chainable
		 */
		hide: function() {
			var self = this;
			self.$dialog && self.$dialog.hide();
			self.$cover && self.$cover.hide();
			return self;
		},
		/**
		 * Show the dialog and cover if hidden
		 * @method show
		 * @returns {RiModal}
		 * @chainable
		 */		
		show: function() {
			var self = this;
			self.$dialog && self.$dialog.show();
			self.$cover && self.$cover.show();
			return self;
		},
		/**
		 * Set the title of the modal
		 * @method setTitle
		 * @param {String} title
		 * @returns {RiModal}
		 * @chainable
		 */
		setTitle: function(title) {
			var self = this;
			self.$dialog.find('.ri-modal-title').text(title);
			return self;
		},
		/**
		 * Handle the options for position and offset by updating the size object
		 * @method handlePosition
		 * @see calcSize() for size object specs
		 * @param {Object} size  The size object from calcSize()
		 * @return {undefined}
		 */
		handlePositionOption: function(size) {
			this.options.position.toLowerCase().split('-').forEach(function(p) {
				if (p == 'left') {
					size.left = 12;
				}
				else if (p == 'center') {
					// already centered
				}
				else if (p == 'right') {
					size.left = size.viewportWidth - 40 - size.width;
				}
				else if (p == 'top') {
					size.top = 12;
				}
				else if (p == 'middle') {
					// already centered
				}
				else if (p == 'bottom') {
					size.top = size.viewportHeight - 72 - size.height;
				}			
			});
			size.left += this.options.offset.x || 0;
			size.top += this.options.offset.y || 0;
		}
	};
	
	// Export to jQuery namespace
	$.RiModal = RiModal;

	/**
	 * 
	 * @param {Object} [options]  Same options as $.RiModal constructor plus
	 * @param {String} [options.event=click]  The event (or space separated list of events) that should open the modal
	 * @param {String} [options.delegate]  If given, clicks on any child matching this selector should open the modal
	 * @returns {jQuery}
	 */
	$.fn.riModal = function(options) {
		options = options || {};
		// todo support delegation
		var open = function(evt) {
			evt.preventDefault();
			var dataOptions = {};
			var attr;
			for (var option in RiModal.defaultOptions) {
				if (!RiModal.defaultOptions.hasOwnProperty(option)) {
					continue;
				}
				attr = 'data-modal-' + option.replace(/_/g, '-');
				if (this.hasAttribute(attr)) {
					dataOptions[option] = this.getAttribute(attr);		
				}
			}
			var modal = new RiModal( $.extend(true, dataOptions, {origin:this}, options) );
			modal.open();
		};
		if (options.delegate) {
			return this.on(options.event || 'click', options.delegate, open);
		}
		return this.on(options.event || 'click', open);
	};
	
	//
	// some common local variables
	//
	
	// copy of easeInQuart
	$.easing.riEaseInQuart = function (x, t, b, c, d) {
		return c*(t/=d)*t*t*t + b;
	};
	// copy of easeOutQuart
	$.easing.riEaseOutQuart = function (x, t, b, c, d) {
		return -c * ((t=t/d-1)*t*t*t - 1) + b;
	};
	
	// commonly used elements
	var $window = $(window);
	var $document = $(document);
	var docEl = document.documentElement;
	var $docEl = $(docEl); // same as $('html')
		
	// internal increment to generate id for each modal instance
	var uid = 1;	
	
	// helper to prevent resize handler firing in rapid succession
	function debounce(ms, callback) {
		var handle;
		return function() {			
			clearTimeout(handle);
			handle = setTimeout(callback, ms);
		};
	}
	
	// helper to interpret "true", "false", "t", "f", "1", "0", 1, 0, true, false
	function booleanize(value) {
		if (typeof value === 'string') {
			return value.match(/^(true|t|1)$/i);
		}
		return !!value;
	}
	
})(jQuery, window, document);
