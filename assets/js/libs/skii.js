/**
 * @namespace   Skii
 * @version     0.1
 *
 * @author      Charles Demers
 */

var Skii = {
	
	KeyCodes: {
		ALT: 18,
		ARROW_DOWN: 40,
		ARROW_LEFT: 37,
		ARROW_RIGHT: 39,
		ARROW_UP: 38,
		BACK_SPACE: 8,
		CAPS_LOCK: 20,
		CTRL: 17,
		DELETE: 46,
		ENTER: 13,
		ESCAPE: 27,
		PAGE_DOWN: 34,
		PAGE_UP: 33,
		SHIFT: 16,
		SPACE: 32,
		TAB: 9
	},
	
	typeOf: function(obj){
		if(obj === undefined) { return 'undefined'; }
		if(obj === null) { return 'null'; }
		var stringType = Object.prototype.toString.call(obj);
		if(stringType == '[object Array]') { return 'array'; }
		if(stringType == '[object Date]') { return 'date'; }
		if(stringType == '[object RegExp]') { return 'regexp'; }
		if(typeof obj == 'number' && !isFinite(obj)) { return 'nan'; }
		if(obj.callee) { return 'arguments'; }
		if(obj.item) { return 'collection'; }
		if(obj.nodeName) {
			switch(obj.nodeType) {
				case 1: return 'element';
				case 3: return (/\S/).test(obj.nodeValue) ? 'textnode' : 'whitespace';
			}
		}
		return (typeof obj);
	},
	
	Object: {
		get: function(object, key) {
			var ret = null;
			if(object) {
				if (key.indexOf('.') != -1 || key.indexOf('[') != -1) {
					var keys = key.match(/[^.\[\]]+/gi);
					ret = object;

					for (var i=0, l=keys.length; i<l; i++) {
						if (keys[i] in ret){
							ret = ret[keys[i]];
						} else {
							return null;
						}
					}

				} else {
					ret = object[key];
				}
			}
			return ret;
		},
		merge: function(obj, obj2) {
			for(var p in obj2){
				if(obj.hasOwnProperty(p) === false){
					obj[p] = obj2[p];
				}
			}
			return obj;
		}
	},
	
	Array: {
		sortNumerical: function(array) {
			return array.sort(function(a, b) {
				return a - b;
			});
		}
	},
	
	String: {
		padLeft: function(string, stringLength, paddingCharacter) {
			paddingCharacter = paddingCharacter || '0';
			string = String(string);
			while (string.length < stringLength) {
				string = paddingCharacter + string;
			}
			return string;
		}
	}
	
};


/* is-type helper functions */
(function(Skii) {
	
	var types = ['undefined', 'null', 'array', 'date', 'regexp', 'nan', 'number', 'arguments', 'collection', 'element', 'textnode', 'whitespace', 'string', 'object', 'boolean'];
	
	for(var i=types.length; i--; ) {
		Skii["is" + types[i].charAt(0).toUpperCase() + types[i].slice(1)] = (function(i) {
			return function(obj) {
				return (Skii.typeOf(obj) == types[i]);
			};
		})(i);
	}
	
}(Skii));


/* Built-ins extensions from the Mozilla Developper Center */
if(!Object.keys) {
	Object.keys = function(o) {
		if (o !== Object(o)) {
			throw new TypeError('Object.keys called on non-object');
		}
		var ret = [];
		for (var p in o) {
			if (o.hasOwnProperty(p)) {
				ret.push(p);
			}
		}
		return ret;
	};
}

if (!Array.prototype.indexOf) {
  	Array.prototype.indexOf = function(searchElement /*, fromIndex */) {
		"use strict";

		if (this === void 0 || this === null) {
			throw new TypeError();
		}

		var t = Object(this);
		var len = t.length >>> 0;
		if (len === 0) {
			return -1;
		}

		var n = 0;
		if (arguments.length > 0) {
			n = Number(arguments[1]);
			// shortcut for verifying if it's NaN
			if (n !== n) {
				n = 0;
			} else if (n !== 0 && n !== (1 / 0) && n !== -(1 / 0)) {
				n = (n > 0 || -1) * Math.floor(Math.abs(n));
			}
		}

		if (n >= len) {
			return -1;
		}

		var k = (n >= 0) ? n : Math.max(len - Math.abs(n), 0);

		for (; k < len; k++) {
			if (k in t && t[k] === searchElement) {
				return k;
			}
		}
		return -1;
	};
}

if (!Array.prototype.lastIndexOf) {
	Array.prototype.lastIndexOf = function(searchElement /*, fromIndex*/) {
		"use strict";
		
		if (this === void 0 || this === null) {
			throw new TypeError();
		}
		
		var t = Object(this);
		var len = t.length >>> 0;
		if (len === 0) {
			return -1;
		}
		
		var n = len;
		if (arguments.length > 1) {
			n = Number(arguments[1]);
			if (n !== n) {
				n = 0;
			} else if (n !== 0 && n !== (1 / 0) && n !== -(1 / 0)) {
				n = (n > 0 || -1) * Math.floor(Math.abs(n));
			}
		}

		var k = (n >= 0) ? Math.min(n, len - 1) : len - Math.abs(n);

		for (; k >= 0; k--) {
			if (k in t && t[k] === searchElement) {
				return k;
			}
		}
		return -1;
	};
}

if (!Array.prototype.filter) {
	Array.prototype.filter = function(fun /*, thisp */) {
		"use strict";

		if (this === void 0 || this === null) {
			throw new TypeError();
		}

		var t = Object(this);
		var len = t.length >>> 0;
		if (typeof fun !== "function") {
			throw new TypeError();
		}

		var res = [];
		var thisp = arguments[1];
		for (var i = 0; i < len; i++) {
			if (i in t) {
				var val = t[i]; // in case fun mutates this
				if (fun.call(thisp, val, i, t)) {
					res.push(val);
				}
			}
		}
		return res;
	};
}

if (!Array.prototype.forEach) {
	Array.prototype.forEach = function(fun /*, thisp */) {
		"use strict";

		if (this === void 0 || this === null) {
			throw new TypeError();
		}

		var t = Object(this);
		var len = t.length >>> 0;
		if (typeof fun !== "function") {
			throw new TypeError();
		}

		var thisp = arguments[1];
		for (var i = 0; i < len; i++) {
			if (i in t) {
				fun.call(thisp, t[i], i, t);
			}
		}
	};
}

if (!Array.prototype.every) {
	Array.prototype.every = function(fun /*, thisp */) {
		"use strict";

		if (this === void 0 || this === null) {
			throw new TypeError();
		}

		var t = Object(this);
		var len = t.length >>> 0;
		if (typeof fun !== "function") {
			throw new TypeError();
		}

		var thisp = arguments[1];
		for (var i = 0; i < len; i++) {
			if (i in t && !fun.call(thisp, t[i], i, t)) {
				return false;
			}
		}
		return true;
	};
}

if (!Array.prototype.map) {
	Array.prototype.map = function(fun /*, thisp */) {
		"use strict";

		if (this === void 0 || this === null) {
			throw new TypeError();
		}

		var t = Object(this);
		var len = t.length >>> 0;
		if (typeof fun !== "function") {
			throw new TypeError();
		}

		var res = new Array(len);
		var thisp = arguments[1];
		for (var i = 0; i < len; i++) {
			if (i in t) {
				res[i] = fun.call(thisp, t[i], i, t);
			}
		}
		return res;
	};
}

if (!Array.prototype.some) {
	Array.prototype.some = function(fun /*, thisp */) {
		"use strict";

		if (this === void 0 || this === null) {
			throw new TypeError();
		}

		var t = Object(this);
		var len = t.length >>> 0;
		if (typeof fun !== "function") {
			throw new TypeError();
		}

		var thisp = arguments[1];
		for (var i = 0; i < len; i++) {
			if (i in t && fun.call(thisp, t[i], i, t)) {
				return true;
			}
		}
		return false;
	};
}

if ( !Array.prototype.reduce ) {
	Array.prototype.reduce = function reduce(accumlator){
		var i, l = this.length, curr;

		// ES5 : "If IsCallable(callbackfn) is false, throw a TypeError exception."
		if (typeof accumlator !== "function") {
			throw new TypeError("First argument is not callable");
		}
		
		// == on purpose to test 0 and false.
		if ((l == 0 || l === null) && (arguments.length <= 1)) {
			throw new TypeError("Array length is 0 and no second argument");
		}
		
		if (arguments.length <= 1) {
			// empty array
			for (i=0 ; i=l; ) {
				throw new TypeError("Empty array and no second argument");
			}
				
			curr = this[i++]; // Increase i to start searching the secondly defined element in the array
		} else {
			curr = arguments[1];
		}
		
		for (i = i || 0 ; i < l ; i++) {
			if (i in this) {
				curr = accumlator.call(undefined, curr, this[i], i, this);
			}
		}
		return curr;
	};
}

if (!Array.prototype.reduceRight) {
	Array.prototype.reduceRight = function(callbackfn /*, initialValue */) {
		"use strict";

		if (this === void 0 || this === null) {
			throw new TypeError();
		}

		var t = Object(this);
		var len = t.length >>> 0;
		if (typeof callbackfn !== "function") {
			throw new TypeError();
		}

		// no value to return if no initial value, empty array
		if (len === 0 && arguments.length === 1) {
			throw new TypeError();
		}

		var k = len - 1;
		var accumulator;
		if (arguments.length >= 2) {
			accumulator = arguments[1];
		} else {
			do {
				if (k in this) {
					accumulator = this[k--];
					break;
				}

				// if array contains no values, no initial value to return
				if (--k < 0) {
					throw new TypeError();
				}
			}
			while (true);
		}

		while (k >= 0) {
			if (k in t) {
				accumulator = callbackfn.call(undefined, accumulator, t[k], k, t);
			}
			k--;
		}
		return accumulator;
	};
}

if (!Function.prototype.bind) {
	Function.prototype.bind = function( obj ) {
		// closest thing possible to the ECMAScript 5 internal IsCallable function
		if (typeof this !== 'function') {
			throw new TypeError('Function.prototype.bind - what is trying to be bound is not callable');
		}

		var slice = [].slice,
				args = slice.call(arguments, 1), 
				self = this, 
				nop = function () {}, 
				bound = function () {
					return self.apply((this instanceof nop ? this : (obj || {})), args.concat(slice.call(arguments))); 
				};

		bound.prototype = this.prototype;
		return bound;
	};
}

/* Steven Levithan: http://blog.stevenlevithan.com/archives/faster-trim-javascript */
if (!String.prototype.trim) {
	String.prototype.trim = (function() {
		var d = /^\s\s*/,
		    c = /\s\s*$/;
		return function() {
			return this.replace(d, '').replace(c, '');
		};
	})();
}