/**
 * @class       Skii.SelectInput
 * @version     0.1
 * @author      Charles Demers - @charles_demers
 *
 * @requires    [core.js, Skii.ContextualMenu.js, jquery-1.5+.js]
 */

Skii.SelectInput = function(selectElement, opts) {
	
	var _this = this;
	opts = opts || {};
	

	// Elements
	var $realSelect = this.$realSelect = $(selectElement);
	var realSelect = this.realSelect = $realSelect.get(0);
	
	
	// Props
	this.classPrefix = 'skii-selectinput';

	// Build html
	
	// FIXME: i don't like this... is there a way to get all css properties in one shot ?!
	var selectPosition = $realSelect.css('position'),
		selectOptions = {
			'class': this.classPrefix,
			css: {
				position: (selectPosition == "static") ? "relative" : selectPosition,
				'float': $realSelect.css('float'),
				top: $realSelect.css('top'),
				right: $realSelect.css('right'),
				bottom: $realSelect.css('bottom'),
				left: $realSelect.css('left'),

				marginTop: $realSelect.css('margin-top'),
				marginRight: $realSelect.css('margin-right'),
				marginBottom: $realSelect.css('margin-bottom'),
				marginLeft: $realSelect.css('margin-left')
			},
			html: '<p class="' + this.classPrefix + '-selected"></p><div class="' + this.classPrefix + '-arrow"></div>'
		};
	
	selectOptions.css.minWidth = $realSelect.outerWidth();
	selectOptions.css.maxWidth = selectOptions.css.minWidth;
	
	if (opts.id) {
		selectOptions.id = opts.id;
	}
	
	this.$select = $('<div>', selectOptions);
	
	$realSelect.hide();
	this.$select.insertAfter($realSelect);
	
	var selectOffset = this.$select.offset();
	
	this.optionList = new Skii.ContextualMenu({
		options: this.rebuildOptions(true),
		shouldFitInViewport: true,
		canHaveScrollbar: true,
		isFixed: false,
		width: $realSelect.outerWidth()
	});
	
	$(this.optionList).one('skii.contextualmenu.selection', function(e, element, index, value) {
		
		$(_this.optionList).bind('skii.contextualmenu.selection', function(e, element, index, value) {
			_this._changeValue(_this.$realSelect.find('option:eq(' + index + ')'), false, true);
		});
		
		_this._changeValue(_this.$realSelect.find('option:eq(' + index + ')'), false, false);
	});
	
	// init with default value
	this._changeValue(this.$realSelect.find('option:eq(' + this.defaultIndex() + ')'), true, false);
	
	if (this.$realSelect.attr('disabled')) {
		this.disable();
	} else {
		this.enable();
	}
};


Skii.SelectInput.prototype = {
	
	enable: function() {
		var select = this.$select;
		select.attr('tabindex', '0');
		
		select.bind('mousedown', $.proxy(this, 'toggleOptionsVisibility'));
		
		select.bind('keydown', $.proxy(this, '_manageKeyDown'));
		
		select.bind('keyup', $.proxy(this, '_manageKeyUp'));

		$(document).bind('mouseup', $.proxy(this, '_manageClickOutside'));
		
		select.removeClass('disabled');
		
	},

	disable: function() {
		var select = this.$select;
		select.removeAttr('tabindex');
		
		select.unbind('click');
		select.unbind('keyup', this._manageKeyUp);
		select.unbind('keydown', this._manageKeyDown);
		
		$(document).unbind('click', this._manageClickOutside);
		
		select.addClass('disabled');
	},
	
	toggleOptionsVisibility: function(e) {
		e.preventDefault();
		this.optionList.toggleVisibility({
			x: this.$select.offset().left,
			y: this.$select.offset().top + this.$select.outerHeight()
		});
	},
	
	_changeValue: function($newSelection, notifyOptionList, triggerChange) {
		
		// make sure the index or value does exist
		if ($newSelection.length) {
			var index = $newSelection.get(0).index;
			
			this.$realSelect.find("option:selected").removeAttr('selected');
			
			$newSelection.attr('selected', 'selected');
			
			this.$select.find("." + this.classPrefix + "-selected").text($newSelection.text());
			
			$(this).trigger('skii.selectinput.change', [{
				index: index,
				value: $newSelection.attr('value')
			}]);
			
			if (triggerChange) {
				this.$realSelect.trigger('change');
			}
			
			if (notifyOptionList) {
				this.optionList.selectOption(this.optionList.getSelectableOptions().get(index));
			}
			this.optionList.hide();
		}
	},
	
	_manageClickOutside: function(e) {
		
		// prevent execution when we are clicking to open the select
		if (this.optionList.isVisible) {
			
			var $select = this.$select,
				$options = this.optionList.$list;
			
			// make sure we haven't clicked on the select or the options or elements inside of them
			if ($select.has(e.target).length === 0 && $select.get(0) != e.target && $options.has(e.target).length === 0 && $options.get(0) != e.target) {
				this.optionList.hide();
			}
		}
	},
	
	_manageKeyUp: function(e) {		
		switch (e.which) {
			case Skii.KeyCodes.SPACE:
			case Skii.KeyCodes.ARROW_UP:
			case Skii.KeyCodes.ARROW_DOWN:
				e.preventDefault();
				this.toggleOptionsVisibility(e);
				break;
		}
	},

	_manageKeyDown: function(e) {
		
		if (e == Skii.KeyCodes.TAB && this.optionList.isVisible === false) {
			return true;
		}
		
		switch (e.which) {
			case Skii.KeyCodes.SPACE:
			case Skii.KeyCodes.ESCAPE:
			case Skii.KeyCodes.PAGE_UP:
			case Skii.KeyCodes.PAGE_DOWN:
			case Skii.KeyCodes.ARROW_UP:
			case Skii.KeyCodes.ARROW_DOWN:
				e.preventDefault();
				this.optionList.focus();
				return false;
				break;
		}
	},
	
	rebuildOptions: function(returnStructure) {
		var _this = this,
			optionsMarkup = [],
			htmlText = "";
			mainOptionListChildren = this.$realSelect.children();

		var buildOptions = function(children) {
			
			var currentArrayInStruct = [];
			
			for (var i=0, l=children.length; i<l; i++) {
				if (children[i].nodeName.toLowerCase() == "optgroup") {
					
					var optgroupOptions = buildOptions($(children[i]).children());
					
					currentArrayInStruct.push({
						label: children[i].label,
						value: optgroupOptions,
						selectable: false
					});
					
				} else {
					currentArrayInStruct.push({
						label: children[i].text,
						value: children[i].value
					});
				}
			}
			return currentArrayInStruct;
		};
		
		var options = buildOptions(mainOptionListChildren);
		if (returnStructure) {
			return options;
		}
		this.optionList.rebuildOptions(options);
	},
	
	defaultIndex: function() {

		for (var i=0,l=this.realSelect.options.length; i<l; i++) {
			if (this.realSelect.options[i].defaultSelected) {
				return i;
			}
		}
		return 0;
	},

	defaultValue: function() {
		return this.realSelect.options[this.defaultIndex()].value;
	},
	
	index: function(index) {
		if (typeof index == 'undefined') {
			return this.realSelect.selectedIndex;
		} else {
			this._changeValue(this.$realSelect.find('option:eq(' + index + ')'), true, true);
		}
	},
	
	value: function(value) {
		if (typeof value == 'undefined') {
			return this.realSelect.value;
		} else {
			this._changeValue(this.$realSelect.find('option[value="' + value + '"]'), true, true);
		}
	}
};