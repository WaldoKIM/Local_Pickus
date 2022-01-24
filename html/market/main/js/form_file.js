function fileInput(fi_container_class, fi_button_class, fi_filename_class, fi_button_text) {

	fi_container_class	=	fi_container_class	||	'fileUpload'; // Classname of the wrapper that contains the button & filename.
	fi_button_class		=	fi_button_class		||	'fileBtn'; // Classname for the button
	fi_filename_class	=	fi_filename_class	||	'fileName'; // Name of the text element's class
	fi_button_text		=	fi_button_text		||	'파일첨부'; // Text inside the button

	var fi_file = $('input[type=file]'); // Type of input to look for

	fi_file.css('display', 'none');
	
	var fi_str = '<div class="'+fi_container_class+'"><div class="'+fi_button_class+'">'+fi_button_text+'<i class="fa-download" style="padding-left:5px;"></i></div><div class="'+fi_filename_class+'"></div></div>';
	fi_file.after(fi_str);

	var fi_count = fi_file.length;
	for (var i = 1; i <= fi_count; i++) {
		var fi_file_name = fi_file.eq(i-1).attr('name');
		$('.'+fi_container_class).eq(i-1).attr('data-name', fi_file_name);
	}

	$('.'+fi_button_class).on('click', function() {
		var fi_active_input = $(this).parent().data('name');
		$('input[name='+fi_active_input+']').trigger('click');
	});

	fi_file.on('change', function() {
		var fi_file_name = $(this).val(); // Get the name and path of the chosen file
		var fi_real_name = $(this).attr('name'); // Get the name of changed input

		var fi_array = fi_file_name.split('\\'); // Split on backslash (and escape it)
		var fi_last_row = fi_array.length - 1; // Deduct 1 due to 0-based index
			fi_file_name = fi_array[fi_last_row]; // 

		$('.'+fi_container_class).each(function() {
			var fi_fake_name = $(this).data('name');
			if(fi_real_name == fi_fake_name) {
				$('.'+fi_container_class+'[data-name='+fi_real_name+'] .'+fi_filename_class).html(fi_file_name);
			}
		});
	});
}




; + function($) {
    "use strict";
    var defaults = {
        width: null, 
        wrapClass: '', 
        dataKey: 'ui-select',
        onChange: null,
        onClick: null
    };
    $.fn.ui_select = function(options) {
        var _this = $(this),
            _num = _this.length;

        if (_num === 1) {
            return new UI_select(_this, options);
        };
        if (_num > 1) {
            _this.each(function(index, el) {
                new UI_select($(el), options);
            })
        }
    };

    function UI_select(el, opt) {
        this.el = el;
        this.items = this.el.find('option');
        this._opt = $.extend({}, defaults, opt);
        this._doc = $(document);
        this._win = $(window);
        return this._init();
    }

    UI_select.prototype = {
        _isIE: !!window.ActiveXObject || "ActiveXObject" in window,


        _init: function() {
            var _data = this.el.data(this._opt.dataKey);

            if (_data)
                return _data;
            else
                this.el.data(this._opt.dataKey, this);
            this._setHtml();
            this._bindEvent(); 
        },


        _setHtml: function() {
            this.el.addClass('ui-select');
            var _isHide = (this.el.css('display') == 'none');
            if (_isHide) {
                this.el.show().css('visibility', 'hidden');
            }
            var _w = this._opt.width ? this._opt.width - 17 : this.el.outerWidth() - 17;
            this.el.wrap('<div tabindex="0" class="ui-select-wrap ' + this._opt.wrapClass + '"></div>')
                .after('<div class="ui-select-input"></div><i class="ui-select-arrow"></i><ul class="ui-select-list"></ul>');
            this._wrap = this.el.parent('.ui-select-wrap').css('width', _w);
            this._input = this.el.next('.ui-select-input');
            this._list = this._wrap.children('.ui-select-list');
            this.el.prop('disabled') ? this.disable() : null;
            if (_isHide) {
                this.el.add(this._wrap).hide();
                this.el.css('visibility', null);
            }
            var _ohtml = '';
            this.el.find('option').each(function(index, el) {
                var _this = $(el),
                    _text = _this.text(),
                    _value = _this.prop('value'),
                    _selected = _this.prop('selected') ? 'selected' : '',
                    _disabled = _this.prop('disabled') ? ' disabled' : '';
                _ohtml += '<li title="' + _text + '" data-value="' + _value + '" class="' + _selected + _disabled + '">' + _text + '</li> ';
            });
            this._list.html(_ohtml);
            this._items = this._list.children('li');
            this.val(this.el.val());

            var _txt = this._list.children('li.selected').text();
            this._input.text(_txt).attr('title', _txt);
        },

        _bindEvent: function() {
            var _this = this;
            _this._wrap.on({
                'click': function(e) {
                    if (_this._disabled)
                        return;
                    if (e.target.tagName == 'LI') {
                        var _self = $(e.target),
                            _val = _self.attr('data-value');
                        if (_self.hasClass('disabled'))
                            return _this._isIE ? e.stopPropagation() : null;
                        _this.val(_val);
                        _this._triggerClick(_val, _this.items.eq(_self.index()));
                    }

                    if (_this._isIE) {
                        e.stopPropagation();
                        _this._allWrap = _this._allWrap || $('.ui-select-wrap');
                        _this._allWrap.not(_this._wrap).removeClass('focus');
                        _this._doc.one('click', function() {
                            _this._allWrap.removeClass('focus');
                        });
                    }
                    _this._wrap.toggleClass('focus');
                    _this._setListCss();
                },
                'blur': function(e) {
                    _this._wrap.removeClass('focus');
                },
                'keydown': function(e) {
                    var code = e.keyCode;
                    if (code == 40 || code == 38) {
                        var _els = code == 40 ? _this._list.find('li.selected').nextAll('li') : _this._list.find('li.selected').prevAll('li');
                        var _val = _els.not('.disabled').eq(0).attr('data-value');
                        if (_val !== undefined) {
                            _this.val(_val);
                        }
                        return false;
                    }
                }
            });
            return _this;
        },

        _setListCss: function() {
            var _toWinTop = this._wrap.offset().top - this._win.scrollTop();
            var _toWinBottom = this._win.height() - _toWinTop - this._wrap.outerHeight();
            var _listH = this._list.outerHeight();
            if (_listH > _toWinBottom && _toWinTop > _toWinBottom) {
                this._wrap.addClass('up');
                if (_listH > _toWinTop)
                    this._list.css('maxHeight', _toWinTop - 1 + 'px');
                else
                    this._list.removeAttr('style');
            } else if (_listH > _toWinBottom && _toWinTop < _toWinBottom) {
                this._wrap.removeClass('up');
                this._list.css('maxHeight', _toWinBottom - 1 + 'px');
            } else {
                this._list.removeAttr('style');
                this._wrap.removeClass('up');
            }
        },

        _triggerChange: function(value, item) {
            this.el.change();
            this.onChange(value, item);
            if (typeof this._opt.onChange == 'function')
                this._opt.onChange.call(this, value, item);
        },

        _triggerClick: function(value, item) {
            this.onClick(value, item);
            if (typeof this._opt.onClick == 'function')
                this._opt.onClick.call(this, value, item);
        },

        val: function(value) {
            var _val = this.el.val();
            if (value === undefined)
                return _val;
            this.el.val(value);
            var _selectedLi = this._list.children('li[data-value="' + value + '"]');
            _selectedLi.addClass('selected').siblings('li').removeClass('selected');
            this._input.html(_selectedLi.text()).attr('title', _selectedLi.text());
            if (_val != value) {
                return this._triggerChange(value, this.items.eq(_selectedLi.index()));
            }
        },

        onChange: function(value, item) {},

        onClick: function(value, item) {},

        disable: function() {
            this._disabled = true;
            this.el.prop('disabled', true);
            this._wrap.addClass('disabled').removeAttr('tabindex');
            return this;
        },

        enable: function() {
            this._disabled = false;
            this.el.prop('disabled', false);
            this._wrap.removeClass('disabled').attr('tabindex', '0');
            return this;
        },

        hide: function() {
            this._wrap.hide();
            return this;
        },

        show: function() {
            this._wrap.show();
            return this;
        },

        toggle: function() {
            this._wrap.toggle();
            return this;
        },

        visible: function(visible) {
            visible = !visible ? 'hidden' : 'visible';
            this._wrap.css('visibility', visible);
            return this;
        }

    };
}(jQuery);
