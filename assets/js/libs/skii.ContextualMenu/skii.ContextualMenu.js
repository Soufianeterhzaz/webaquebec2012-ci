/**
 * @class       Skii.ContextualMenu
 * @version     0.1
 * @author      Charles Demers - @charles_demers
 *
 * @requires    [core.js, jquery-1.5+]
 */

// Set the Skii.SCROLLBAR_WIDTH constant
$(function() {
	var $div = $('<div style="width:100px; height:100px; overflow:hidden; position:absolute; top:-999px; left:-999px;"><p style="border:width:50px; height:25px;"></p></div>'),
		$p = $div.find('p');

	$('body').append($div);

	var isIE7 = !!($.browser.msie && $.browser.version < 8);

	var w1 = (!isIE7) ? $p.innerWidth() : $div.get(0).scrollWidth;

	$div.css('overflow', 'auto');
	$p.height(200);

	// IE7 hack -> this one is really strange, the first execution returns the same value as w1,
	// the second execution seems to update the value, so it's the right one
	var w2 = (!isIE7) ? $p.innerWidth() : $div.get(0).scrollWidth && $div.get(0).scrollWidth;
	$div.remove();
	Skii.SCROLLBAR_WIDTH = w1 - w2;
});

Skii.ContextualMenu = function(opts) {
	
	// Props
	this.classPrefix = 'skii-contextualmenu';
	this.selectableOptionSelector = 'li:not(.' + this.classPrefix + '-non-selectable)';
	this.keyDownThreshold = 50;
	this.keyDownTimeout;
	this.keyDownRepeat = false;
	
	this.canSelect = true;
	this.selectionThreshold = 300;
	
	// Metrics
	this.currentOffsetX = 0;
	this.currentOffsetY = 0;
	this.initialWidth = 0;
	this.totalWidth = 0;
	this.totalHeight = 0;
	
	// Option
	this.shouldFitInViewport = (typeof opts.shouldFitInViewport) ? opts.shouldFitInViewport : true;
	this.isFixed = (typeof opts.isFixed == 'boolean') ? opts.isFixed : true;
	this.canHaveScrollbar = opts.canHaveScrollbar || false;
	this.canBeOnTop = opts.canBeOnTop || false;
	
	this.isAnimated = opts.isAnimated || false;
	
	// States
	this.isVisible = false;
	this.hasScrollbar = false;
	this.shouldUpdateOptionList = true;
	this.shouldUpdateBrowserMetrics = true;
	
	// Elements
	this.$selectedOption;
	this.lastFocusedElement;
	
	this.$list = $('<ul>', {
		'class': this.classPrefix,
		css: {
			width: opts.width || 'auto'
		}
	});
	this.$list.appendTo('body');
	this.rebuildOptions(opts.options);
	
	this._$options = this.getSelectableOptions();
	
	$(Skii.ContextualMenu.Notifier).trigger('skii.contextualmenu.creation', [this]);
};

// Only use internally
// This is just an observer that notifies the instances
// that they should update their browser metrics
(function() {

	Skii.ContextualMenu.Notifier = {
		instances: [],
		notify: function() {
			var instances = Skii.ContextualMenu.Notifier.instances;
			for (var i=0, l=instances.length; i<l; i++) {
				instances[i].shouldUpdateBrowserMetrics = true;
			}
		}
	};
	
	$(Skii.ContextualMenu.Notifier).bind('skii.contextualmenu.creation', function(e, instance) {
		Skii.ContextualMenu.Notifier.instances.push(instance);
	});
	
	// Check for viewport resize and scroll to notify instances 
	$(window).bind('resize', Skii.ContextualMenu.Notifier.notify);
	$(document).bind('scroll', Skii.ContextualMenu.Notifier.notify);
	
})();


Skii.ContextualMenu.prototype = {
	
	_onKeyUp: function(e) {
		if (this.isVisible) {
			
			var direction;
			
			switch (e.which) {
				case Skii.KeyCodes.ENTER:
				case Skii.KeyCodes.SPACE:
					e.preventDefault();
					this.selectOption(e.currentTarget);
					break;

				case Skii.KeyCodes.ESCAPE:
					e.preventDefault();
					this.hide();
					break;

				case Skii.KeyCodes.ARROW_UP:
				case Skii.KeyCodes.ARROW_DOWN:
					e.preventDefault();
					clearTimeout(this.keyDownTimeout);
					this.keyDownRepeat = false;
					break;
					
				case Skii.KeyCodes.PAGE_UP:
				case Skii.KeyCodes.PAGE_DOWN:
					e.preventDefault();
					$(e.currentTarget).trigger('mouseout');
					direction = (e.which == Skii.KeyCodes.PAGE_UP) ? 'first' : 'last';
					this.moveFocus(direction);
					break;
			}
			
		}
	},
	
	_onKeyDown: function(e) {
		
		switch (e.which) {
			case Skii.KeyCodes.SPACE:
			case Skii.KeyCodes.TAB:
			case Skii.KeyCodes.ESCAPE:
			case Skii.KeyCodes.PAGE_UP:
			case Skii.KeyCodes.PAGE_DOWN:
				e.preventDefault();
				return false;
				break;
			case Skii.KeyCodes.ARROW_UP:
			case Skii.KeyCodes.ARROW_DOWN:
				e.preventDefault();
				
				var _this = this;
				
				if(!this.keyDownRepeat) {
					$(e.currentTarget).trigger('mouseout');

					if (!e.metaKey && !e.altKey) {
						direction = (e.which == Skii.KeyCodes.ARROW_UP) ? 'up' : 'down';
					} else {
						direction = (e.which == Skii.KeyCodes.ARROW_UP) ? 'first' : 'last';
					}
					this.moveFocus(direction, this.getSelectableOptions().index(e.currentTarget));
					
				}
				
				this.keyDownTimeout = setTimeout(function() {
					_this.keyDownRepeat = true;
					$(e.currentTarget).trigger('mouseout');
					var direction = (e.which == Skii.KeyCodes.ARROW_UP) ? 'up' : 'down';
					_this.moveFocus(direction, _this.getSelectableOptions().index(e.currentTarget));
				}, this.keyDownThreshold);
				
				break;
		}
	},
	
	_onOptionFocus: function(e) {
		e.preventDefault();
		var li = $(e.currentTarget),
			oldLi = $(this.getSelectableOptions()).filter('li.hover');

		li.attr('tabindex', '0').focus();
		
		if (li.get(0) != oldLi.get(0)) {
			li.addClass('hover');
			oldLi.removeClass('hover').removeAttr('tabindex');
		}
	},
	
	_onOptionSelect: function(e) {
		if (this.canSelect) {
			e.preventDefault();
			if (this.isVisible) {
				this.selectOption(e.currentTarget);
			}
			$(e.currentTarget).removeClass('hover');
		}
	},
	
	_cancelScroll: function(e) {
		if (this.isVisible) {
			e.preventDefault();
		}
	},
	
	getSelectableOptions: function() {
		if (this.shouldUpdateOptionList) {
			this.shouldUpdateOptionList = false;
			this._$options = this.$list.find(this.selectableOptionSelector);
		}
		return this._$options;
	},
	
	focus: function() {
		this.lastFocusedElement = document.activeElement;
		
		if (!this.$selectedOption) {
			this.$selectedOption = this.getSelectableOptions().first();
		}

		this.$selectedOption.trigger('mouseover');
	},
	
	blur: function() {
		if (this.$selectedOption) {
			this.$selectedOption.blur();
			this.$selectedOption.removeAttr('tabindex', '0');
		}
		$(this.lastFocusedElement).focus();
	},
	
	moveFocus: function(direction, currentIndex) {
		var	$options = this.getSelectableOptions();
		if (direction == 'up' || direction == 'down') {
			var newIndex = currentIndex + ((direction == 'up') ? -1 : 1);
			if (newIndex >= 0 && newIndex < $options.length) {
				$($options.get(newIndex)).trigger('mouseover');
			}
		} else if (direction == 'first' || direction == 'last') {
			$options[direction]().trigger('mouseover');
		}
	},
	
	selectOption: function(option) {
		option = $(option);
		
		if (option.length) {
			
			var currentSelected = this.$list.find("li.selected");
			currentSelected.removeClass("selected");
			option.addClass("selected");
			this.$selectedOption = option;
		}
		
		$(this).trigger('skii.contextualmenu.selection', [option, this.getSelectableOptions().index(option), option.data('value')]);
	},
	
	enable: function() {
		this.$list.delegate(this.selectableOptionSelector, 'mouseover', $.proxy(this, '_onOptionFocus'));
		this.$list.delegate(this.selectableOptionSelector, 'mouseup', $.proxy(this, '_onOptionSelect'));
		this.$list.delegate(this.selectableOptionSelector, 'keyup', $.proxy(this, '_onKeyUp'));
		this.$list.delegate(this.selectableOptionSelector, 'keydown', $.proxy(this, '_onKeyDown'));
		$(window).bind('resize', $.proxy(this, 'hide'));
		$(document).bind('scroll', $.proxy(this, '_cancelScroll'));
	},
	
	disable: function() {
		this.$list.undelegate(this.selectableOptionSelector, 'mouseover', this._onOptionFocus);
		this.$list.undelegate(this.selectableOptionSelector, 'click', this._onOptionSelect);
		this.$list.undelegate(this.selectableOptionSelector, 'keyup', this._onKeyUp);
		this.$list.undelegate(this.selectableOptionSelector, 'keydown', this._onKeyDown);
		$(window).unbind('resize', this.hide);
		$(document).unbind('scroll', this._cancelScroll);
	},

	rebuildOptions: function(optionsArray) {
		var _this = this;

		var buildOptions = function(optionsArray) {
			
			var optionsMarkup = [];
			
			for (var i=0, l=optionsArray.length; i<l; i++) {
				
				var currentOpt = optionsArray[i],
					data = '',
					classes = '';
				
				for (var prop in currentOpt) {
					if ((Skii.typeOf(currentOpt[prop]) == 'string' || Skii.typeOf(currentOpt[prop]) == 'number') && prop != 'label' && prop != 'selectable') {
						data = 'data-' + prop + '="' + currentOpt[prop] + '" ';
					}
				}
				
				if (currentOpt.selectable === false) {
					classes = _this.classPrefix + '-non-selectable';
				}
				
				if (Skii.typeOf(currentOpt.value) == 'array') {
					
					classes += ' ' + _this.classPrefix + '-group';
					optionsMarkup.push('<li class="' + classes + '" ' + data + '><p>' + currentOpt.label + '</p><ul>');
					optionsMarkup.push(buildOptions(currentOpt.value));
					optionsMarkup.push('</ul></li>');
					
				} else {
					optionsMarkup.push('<li class="' + classes + '" ' + data + '><span class="' + _this.classPrefix + '-check"></span>' + currentOpt.label + '</li>');
				}
			}
			return optionsMarkup.join('');
		};

		this.$list.html(buildOptions(optionsArray));
			
		this.initialWidth = this.$list.width();
		this.totalWidth = this.$list.outerWidth();
		this.totalHeight = this.$list.outerHeight();
		
		this.$selectedOption = null;
		this.shouldUpdateOptionList = true;
	},
	
	toggleVisibility: function(offset) {
		if (this.isVisible) {
			this.hide();
		} else {
			this.show(offset);
		}
	},
	
	show: function(offset) {
		var _this = this;
		
		this.canSelect = false;
		
		this.updatePosition(offset);
		
		if (!this.isAnimated) {
			this.$list.css('display', 'block');
		} else {
			this.$list.fadeIn(150);
		}
		this.isVisible = true;
		this.enable();
		
		setTimeout(function() {
			_this.canSelect = true;
		}, this.selectionThreshold);
	},
	
	hide: function() {
		this.isVisible = false;
		
		this.disable();
		this.blur();
		
		if (!this.isAnimated) {
			$(this.$list).css('display', 'none');
		} else {
			$(this.$list).fadeOut(150);
		}
	},
	
	updatePosition: function(offset) {
		
		if (this.shouldUpdateBrowserMetrics) {
			this.shouldUpdateBrowserMetrics = false;
			var doc = $(document),
				viewport = $(window);
				
			this.browserMetrics = {
				docWidth: doc.width(),
				docHeight: doc.height(),

				viewportWidth: viewport.width(),
				viewportHeight: viewport.height(),

				scrollTop: doc.scrollTop(),
				scrollLeft: doc.scrollLeft()
			};
		}
			
		var bounds,
			browserMetrics = this.browserMetrics;
		
		// if it must fit in viewport or that the document is smaller than the viewport
		if (this.shouldFitInViewport || (browserMetrics.docWidth < browserMetrics.viewportWidth || browserMetrics.docHeight < browserMetrics.viewportHeight)) {
				
			bounds = {
				topLeft: {
					x: browserMetrics.scrollLeft,
					y: browserMetrics.scrollTop
				},
				bottomRight: {
					x: browserMetrics.scrollLeft + browserMetrics.viewportWidth,
					y: browserMetrics.scrollTop + browserMetrics.viewportHeight
				}
			};
				
		// make it fit to document at least
		} else {
			
			bounds = {
				topLeft: {
					x: 0,
					y: 0
				},
				bottomRight: {
					x: browserMetrics.docWidth,
					y: browserMetrics.docHeight
				}
			};
		}
		
		this.fitToBounds(offset, bounds);
		
	},
	
	fitToBounds: function(offset, bounds) {
		
		var metrics = {},
			
			boundsPadding = 15,
			
			offsetX = (offset && offset.x) || this.currentOffsetX,
			offsetY = (offset && offset.y) || this.currentOffsetY,
			
			list = this.$list,
			listHeight = this.totalHeight,
			listWidth = this.totalWidth,
			
			availableDistanceToBottom = bounds.bottomRight.y - offsetY - boundsPadding,
			availableDistanceToRight = bounds.bottomRight.x - offsetX - boundsPadding,
			availableDistanceToTop = offsetY - boundsPadding,
		
			heightFitsInBounds = listHeight < (bounds.bottomRight.y - bounds.topLeft.y) - (2 * boundsPadding),
			widthFitsInBounds = listWidth < (bounds.bottomRight.x - bounds.topLeft.x) - (2 * boundsPadding);
			
		// does the list fit under the offset ?
		if (availableDistanceToBottom > listHeight) {
			
			// move it to offset
			metrics.top = offsetY;
			
		// it doesn't fit under
		} else {
			
			// can we put it on top ? does it fit on top ?
			if (this.canBeOnTop && listHeight < availableDistanceToTop) {
				
				// move it on top of the offset
				metrics.top = offsetY - listHeight;
				
				
			// it is not fixed, maybe we can fit it in the bounds
			} else if (!this.isFixed && heightFitsInBounds) {
				
				// stick it to bottom
				metrics.top = offsetY - (listHeight - availableDistanceToBottom);
				
				
			// we cannot put it on top, can we put it under with a scrollbar ? (also check if there is enough space)
			} else if (this.canHaveScrollbar && availableDistanceToBottom > (2 * boundsPadding)) {
				
				// move it to offset and make scrollbar
				metrics.top = offsetY;
				metrics.height = availableDistanceToBottom;
				
			// it doesn't fit anywhere, not even in the bounds
			} else {
				
				// force scrollbar and resize to bounds height
				metrics.top = bounds.topLeft.y + 15;
				metrics.height = (bounds.bottomRight.y - bounds.topLeft.y) - (2 * boundsPadding) - parseInt(this.$list.css('padding-top'), 10) - parseInt(this.$list.css('padding-bottom'), 10);
				
			}
				
		}
		
		// if it doesn't fit at the right of the offset, switch it to the left
		metrics.left = (availableDistanceToRight > listWidth) ? offsetX : offsetX - listWidth;
		
		this.$list.css(metrics);
		this.currentOffsetX = metrics.x;
		this.currentOffsetY = metrics.y;
		
		if (metrics.height) {
			this.addScrollbar();
		} else {
			this.removeScrollbar();
		}
		
	},
	
	addScrollbar: function() {

		if (!this.hasScrollbar) {
			this.hasScrollbar = true;
			this.$list.css({
				width: this.initialWidth + (Skii.SCROLLBAR_WIDTH),
				'overflow-y': 'auto',
				'overflow-x': 'hidden'
			});
		}
		
	},
	removeScrollbar: function() {

		if (this.hasScrollbar) {
			this.hasScrollbar = false;
			this.$list.css({
				width: this.initialWidth,
				height: 'auto',
				overflowY: 'hidden',
				overflowX: 'hidden'
			});
		}
	}
	
};