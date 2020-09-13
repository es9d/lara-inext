/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 25);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./node_modules/@babel/runtime/helpers/classCallCheck.js":
/*!***************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/classCallCheck.js ***!
  \***************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

function _classCallCheck(instance, Constructor) {
  if (!(instance instanceof Constructor)) {
    throw new TypeError("Cannot call a class as a function");
  }
}

module.exports = _classCallCheck;

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/createClass.js":
/*!************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/createClass.js ***!
  \************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

function _defineProperties(target, props) {
  for (var i = 0; i < props.length; i++) {
    var descriptor = props[i];
    descriptor.enumerable = descriptor.enumerable || false;
    descriptor.configurable = true;
    if ("value" in descriptor) descriptor.writable = true;
    Object.defineProperty(target, descriptor.key, descriptor);
  }
}

function _createClass(Constructor, protoProps, staticProps) {
  if (protoProps) _defineProperties(Constructor.prototype, protoProps);
  if (staticProps) _defineProperties(Constructor, staticProps);
  return Constructor;
}

module.exports = _createClass;

/***/ }),

/***/ "./src/js/settings/dropdown-dismissable.js":
/*!*************************************************!*\
  !*** ./src/js/settings/dropdown-dismissable.js ***!
  \*************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _babel_runtime_helpers_classCallCheck__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/helpers/classCallCheck */ "./node_modules/@babel/runtime/helpers/classCallCheck.js");
/* harmony import */ var _babel_runtime_helpers_classCallCheck__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_helpers_classCallCheck__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _babel_runtime_helpers_createClass__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @babel/runtime/helpers/createClass */ "./node_modules/@babel/runtime/helpers/createClass.js");
/* harmony import */ var _babel_runtime_helpers_createClass__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_helpers_createClass__WEBPACK_IMPORTED_MODULE_1__);

 // import $ from 'jquery'

var DropdownDismissable = function () {
  var NAME = 'dropdownDismissable';
  var DATA_KEY = 'bs.dropdown-dismissable';
  var JQUERY_NO_CONFLICT = $.fn[NAME];

  var DropdownDismissable =
  /*#__PURE__*/
  function () {
    function DropdownDismissable(element) {
      _babel_runtime_helpers_classCallCheck__WEBPACK_IMPORTED_MODULE_0___default()(this, DropdownDismissable);

      Object.defineProperty(element, NAME, {
        configurable: true,
        writable: false,
        value: this
      });
      this._element = element;
      this._dismiss = element.querySelector('[data-dismiss="dropdown"]');
      this._toggle = element.querySelector('[data-toggle="dropdown"]');

      this._init();

      this._addEventListeners();
    }

    _babel_runtime_helpers_createClass__WEBPACK_IMPORTED_MODULE_1___default()(DropdownDismissable, [{
      key: "_init",
      value: function _init() {
        $('.dropdown-menu', this._element).removeClass('show').removeAttr('style');

        if ($(this._element).hasClass('show')) {
          $(this._element).removeClass('show');
          $(this._toggle).dropdown('toggle');
        }

        this._element._closable = false;
      }
    }, {
      key: "_addEventListeners",
      value: function _addEventListeners() {
        this._dismiss.addEventListener('click', this.dismiss.bind(this));
      }
    }, {
      key: "_removeEventListeners",
      value: function _removeEventListeners() {
        this._dismiss.removeEventListener('click', this.dismiss.bind(this));
      } // Static jQuery Interface

    }, {
      key: "dismiss",
      // Public
      value: function dismiss(event) {
        this._element._closable = true;

        if (!event) {
          $(this._toggle).dropdown('toggle');
        }
      }
    }, {
      key: "destroy",
      value: function destroy() {
        this._removeEventListeners();

        $.removeData(this._element, DATA_KEY);
        $(this._element).dropdown('dispose');
        this._element = null;
      }
    }], [{
      key: "_jQueryInterface",
      value: function _jQueryInterface(config) {
        return this.each(function () {
          var data = $(this).data(DATA_KEY);

          if (!data) {
            data = new DropdownDismissable(this);
            $(this).data(DATA_KEY, data);
          }

          if (typeof config === 'string') {
            if (typeof data[config] === 'undefined') {
              throw new Error("No method named \"".concat(config, "\""));
            }

            data[config]();
          }
        });
      }
    }]);

    return DropdownDismissable;
  }();

  $(document).on({
    'show.bs.dropdown': function showBsDropdown() {
      this._closable = false;
    },
    'hide.bs.dropdown': function hideBsDropdown() {
      return this._closable === undefined || this._closable !== false;
    }
  }, '[data-dropdown-dismissable]'); ////////////
  // jQuery //
  ////////////

  $.fn[NAME] = DropdownDismissable._jQueryInterface;
  $.fn[NAME].Constructor = DropdownDismissable;

  $.fn[NAME].noConflict = function () {
    $.fn[NAME] = JQUERY_NO_CONFLICT;
    return DropdownDismissable._jQueryInterface;
  }; ////////////////
  // Initialize //
  ////////////////


  $('[data-dropdown-dismissable]').dropdownDismissable();
  return DropdownDismissable;
}($);

/* harmony default export */ __webpack_exports__["default"] = (DropdownDismissable);

/***/ }),

/***/ 25:
/*!*******************************************************!*\
  !*** multi ./src/js/settings/dropdown-dismissable.js ***!
  \*******************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Users/demi/Documents/GitHub/stack/src/js/settings/dropdown-dismissable.js */"./src/js/settings/dropdown-dismissable.js");


/***/ })

/******/ });
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vd2VicGFjay9ib290c3RyYXAiLCJ3ZWJwYWNrOi8vLy4vbm9kZV9tb2R1bGVzL0BiYWJlbC9ydW50aW1lL2hlbHBlcnMvY2xhc3NDYWxsQ2hlY2suanMiLCJ3ZWJwYWNrOi8vLy4vbm9kZV9tb2R1bGVzL0BiYWJlbC9ydW50aW1lL2hlbHBlcnMvY3JlYXRlQ2xhc3MuanMiLCJ3ZWJwYWNrOi8vLy4vc3JjL2pzL3NldHRpbmdzL2Ryb3Bkb3duLWRpc21pc3NhYmxlLmpzIl0sIm5hbWVzIjpbIkRyb3Bkb3duRGlzbWlzc2FibGUiLCJOQU1FIiwiREFUQV9LRVkiLCJKUVVFUllfTk9fQ09ORkxJQ1QiLCIkIiwiT2JqZWN0IiwiY29uZmlndXJhYmxlIiwid3JpdGFibGUiLCJ2YWx1ZSIsImVsZW1lbnQiLCJkYXRhIl0sIm1hcHBpbmdzIjoiO0FBQUE7QUFDQTs7QUFFQTtBQUNBOztBQUVBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBOztBQUVBO0FBQ0E7O0FBRUE7QUFDQTs7QUFFQTtBQUNBO0FBQ0E7OztBQUdBO0FBQ0E7O0FBRUE7QUFDQTs7QUFFQTtBQUNBO0FBQ0E7QUFDQSxrREFBMEMsZ0NBQWdDO0FBQzFFO0FBQ0E7O0FBRUE7QUFDQTtBQUNBO0FBQ0EsZ0VBQXdELGtCQUFrQjtBQUMxRTtBQUNBLHlEQUFpRCxjQUFjO0FBQy9EOztBQUVBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQSxpREFBeUMsaUNBQWlDO0FBQzFFLHdIQUFnSCxtQkFBbUIsRUFBRTtBQUNySTtBQUNBOztBQUVBO0FBQ0E7QUFDQTtBQUNBLG1DQUEyQiwwQkFBMEIsRUFBRTtBQUN2RCx5Q0FBaUMsZUFBZTtBQUNoRDtBQUNBO0FBQ0E7O0FBRUE7QUFDQSw4REFBc0QsK0RBQStEOztBQUVySDtBQUNBOzs7QUFHQTtBQUNBOzs7Ozs7Ozs7Ozs7QUNsRkE7QUFDQTtBQUNBO0FB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RUE7QUFwRzBCLENBQUMsQ0FBN0IsQ0FBNkIsQ0FBN0I7O0FBd0dBLG9GIiwiZmlsZSI6Ii9kaXN0L2Fzc2V0cy9qcy9kcm9wZG93bi1kaXNtaXNzYWJsZS5qcyIsInNvdXJjZXNDb250ZW50IjpbIiBcdC8vIFRoZSBtb2R1bGUgY2FjaGVcbiBcdHZhciBpbnN0YWxsZWRNb2R1bGVzID0ge307XG5cbiBcdC8vIFRoZSByZXF1aXJlIGZ1bmN0aW9uXG4gXHRmdW5jdGlvbiBfX3dlYnBhY2tfcmVxdWlyZV9fKG1vZHVsZUlkKSB7XG5cbiBcdFx0Ly8gQ2hlY2sgaWYgbW9kdWxlIGlzIGluIGNhY2hlXG4gXHRcdGlmKGluc3RhbGxlZE1vZHVsZXNbbW9kdWxlSWRdKSB7XG4gXHRcdFx0cmV0dXJuIGluc3RhbGxlZE1vZHVsZXNbbW9kdWxlSWRdLmV4cG9ydHM7XG4gXHRcdH1cbiBcdFx0Ly8gQ3JlYXRlIGEgbmV3IG1vZHVsZSAoYW5kIHB1dCBpdCBpbnRvIHRoZSBjYWNoZSlcbiBcdFx0dmFyIG1vZHVsZSA9IGluc3RhbGxlZE1vZHVsZXNbbW9kdWxlSWRdID0ge1xuIFx0XHRcdGk6IG1vZHVsZUlkLFxuIFx0XHRcdGw6IGZhbHNlLFxuIFx0XHRcdGV4cG9ydHM6IHt9XG4gXHRcdH07XG5cbiBcdFx0Ly8gRXhlY3V0ZSB0aGUgbW9kdWxlIGZ1bmN0aW9uXG4gXHRcdG1vZHVsZXNbbW9kdWxlSWRdLmNhbGwobW9kdWxlLmV4cG9ydHMsIG1vZHVsZSwgbW9kdWxlLmV4cG9ydHMsIF9fd2VicGFja19yZXF1aXJlX18pO1xuXG4gXHRcdC8vIEZsYWcgdGhlIG1vZHVsZSBhcyBsb2FkZWRcbiBcdFx0bW9kdWxlLmwgPSB0cnVlO1xuXG4gXHRcdC8vIFJldHVybiB0aGUgZXhwb3J0cyBvZiB0aGUgbW9kdWxlXG4gXHRcdHJldHVybiBtb2R1bGUuZXhwb3J0cztcbiBcdH1cblxuXG4gXHQvLyBleHBvc2UgdGhlIG1vZHVsZXMgb2JqZWN0IChfX3dlYnBhY2tfbW9kdWxlc19fKVxuIFx0X193ZWJwYWNrX3JlcXVpcmVfXy5tID0gbW9kdWxlcztcblxuIFx0Ly8gZXhwb3NlIHRoZSBtb2R1bGUgY2FjaGVcbiBcdF9fd2VicGFja19yZXF1aXJlX18uYyA9IGluc3RhbGxlZE1vZHVsZXM7XG5cbiBcdC8vIGRlZmluZSBnZXR0ZXIgZnVuY3Rpb24gZm9yIGhhcm1vbnkgZXhwb3J0c1xuIFx0X193ZWJwYWNrX3JlcXVpcmVfXy5kID0gZnVuY3Rpb24oZXhwb3J0cywgbmFtZSwgZ2V0dGVyKSB7XG4gXHRcdGlmKCFfX3dlYnBhY2tfcmVxdWlyZV9fLm8oZXhwb3J0cywgbmFtZSkpIHtcbiBcdFx0XHRPYmplY3QuZGVmaW5lUHJvcGVydHkoZXhwb3J0cywgbmFtZSwgeyBlbnVtZXJhYmxlOiB0cnVlLCBnZXQ6IGdldHRlciB9KTtcbiBcdFx0fVxuIFx0fTtcblxuIFx0Ly8gZGVmaW5lIF9fZXNNb2R1bGUgb24gZXhwb3J0c1xuIFx0X193ZWJwYWNrX3JlcXVpcmVfXy5yID0gZnVuY3Rpb24oZXhwb3J0cykge1xuIFx0XHRpZih0eXBlb2YgU3ltYm9sICE9PSAndW5kZWZpbmVkJyAmJiBTeW1ib2wudG9TdHJpbmdUYWcpIHtcbiBcdFx0XHRPYmplY3QuZGVmaW5lUHJvcGVydHkoZXhwb3J0cywgU3ltYm9sLnRvU3RyaW5nVGFnLCB7IHZhbHVlOiAnTW9kdWxlJyB9KTtcbiBcdFx0fVxuIFx0XHRPYmplY3QuZGVmaW5lUHJvcGVydHkoZXhwb3J0cywgJ19fZXNNb2R1bGUnLCB7IHZhbHVlOiB0cnVlIH0pO1xuIFx0fTtcblxuIFx0Ly8gY3JlYXRlIGEgZmFrZSBuYW1lc3BhY2Ugb2JqZWN0XG4gXHQvLyBtb2RlICYgMTogdmFsdWUgaXMgYSBtb2R1bGUgaWQsIHJlcXVpcmUgaXRcbiBcdC8vIG1vZGUgJiAyOiBtZXJnZSBhbGwgcHJvcGVydGllcyBvZiB2YWx1ZSBpbnRvIHRoZSBuc1xuIFx0Ly8gbW9kZSAmIDQ6IHJldHVybiB2YWx1ZSB3aGVuIGFscmVhZHkgbnMgb2JqZWN0XG4gXHQvLyBtb2RlICYgOHwxOiBiZWhhdmUgbGlrZSByZXF1aXJlXG4gXHRfX3dlYnBhY2tfcmVxdWlyZV9fLnQgPSBmdW5jdGlvbih2YWx1ZSwgbW9kZSkge1xuIFx0XHRpZihtb2RlICYgMSkgdmFsdWUgPSBfX3dlYnBhY2tfcmVxdWlyZV9fKHZhbHVlKTtcbiBcdFx0aWYobW9kZSAmIDgpIHJldHVybiB2YWx1ZTtcbiBcdFx0aWYoKG1vZGUgJiA0KSAmJiB0eXBlb2YgdmFsdWUgPT09ICdvYmplY3QnICYmIHZhbHVlICYmIHZhbHVlLl9fZXNNb2R1bGUpIHJldHVybiB2YWx1ZTtcbiBcdFx0dmFyIG5zID0gT2JqZWN0LmNyZWF0ZShudWxsKTtcbiBcdFx0X193ZWJwYWNrX3JlcXVpcmVfXy5yKG5zKTtcbiBcdFx0T2JqZWN0LmRlZmluZVByb3BlcnR5KG5zLCAnZGVmYXVsdCcsIHsgZW51bWVyYWJsZTogdHJ1ZSwgdmFsdWU6IHZhbHVlIH0pO1xuIFx0XHRpZihtb2RlICYgMiAmJiB0eXBlb2YgdmFsdWUgIT0gJ3N0cmluZycpIGZvcih2YXIga2V5IGluIHZhbHVlKSBfX3dlYnBhY2tfcmVxdWlyZV9fLmQobnMsIGtleSwgZnVuY3Rpb24oa2V5KSB7IHJldHVybiB2YWx1ZVtrZXldOyB9LmJpbmQobnVsbCwga2V5KSk7XG4gXHRcdHJldHVybiBucztcbiBcdH07XG5cbiBcdC8vIGdldERlZmF1bHRFeHBvcnQgZnVuY3Rpb24gZm9yIGNvbXBhdGliaWxpdHkgd2l0aCBub24taGFybW9ueSBtb2R1bGVzXG4gXHRfX3dlYnBhY2tfcmVxdWlyZV9fLm4gPSBmdW5jdGlvbihtb2R1bGUpIHtcbiBcdFx0dmFyIGdldHRlciA9IG1vZHVsZSAmJiBtb2R1bGUuX19lc01vZHVsZSA/XG4gXHRcdFx0ZnVuY3Rpb24gZ2V0RGVmYXVsdCgpIHsgcmV0dXJuIG1vZHVsZVsnZGVmYXVsdCddOyB9IDpcbiBcdFx0XHRmdW5jdGlvbiBnZXRNb2R1bGVFeHBvcnRzKCkgeyByZXR1cm4gbW9kdWxlOyB9O1xuIFx0XHRfX3dlYnBhY2tfcmVxdWlyZV9fLmQoZ2V0dGVyLCAnYScsIGdldHRlcik7XG4gXHRcdHJldHVybiBnZXR0ZXI7XG4gXHR9O1xuXG4gXHQvLyBPYmplY3QucHJvdG90eXBlLmhhc093blByb3BlcnR5LmNhbGxcbiBcdF9fd2VicGFja19yZXF1aXJlX18ubyA9IGZ1bmN0aW9uKG9iamVjdCwgcHJvcGVydHkpIHsgcmV0dXJuIE9iamVjdC5wcm90b3R5cGUuaGFzT3duUHJvcGVydHkuY2FsbChvYmplY3QsIHByb3BlcnR5KTsgfTtcblxuIFx0Ly8gX193ZWJwYWNrX3B1YmxpY19wYXRoX19cbiBcdF9fd2VicGFja19yZXF1aXJlX18ucCA9IFwiL1wiO1xuXG5cbiBcdC8vIExvYWQgZW50cnkgbW9kdWxlIGFuZCByZXR1cm4gZXhwb3J0c1xuIFx0cmV0dXJuIF9fd2VicGFja19yZXF1aXJlX18oX193ZWJwYWNrX3JlcXVpcmVfXy5zID0gMjUpO1xuIiwiZnVuY3Rpb24gX2NsYXNzQ2FsbENoZWNrKGluc3RhbmNlLCBDb25zdHJ1Y3Rvcikge1xuICBpZiAoIShpbnN0YW5jZSBpbnN0YW5jZW9mIENvbnN0cnVjdG9yKSkge1xuICAgIHRocm93IG5ldyBUeXBlRXJyb3IoXCJDYW5ub3QgY2FsbCBhIGNsYXNzIGFzIGEgZnVuY3Rpb25cIik7XG4gIH1cbn1cblxubW9kdWxlLmV4cG9ydHMgPSBfY2xhc3NDYWxsQ2hlY2s7IiwiZnVuY3Rpb24gX2RlZmluZVByb3BlcnRpZXModGFyZ2V0LCBwcm9wcykge1xuICBmb3IgKHZhciBpID0gMDsgaSA8IHByb3BzLmxlbmd0aDsgaSsrKSB7XG4gICAgdmFyIGRlc2NyaXB0b3IgPSBwcm9wc1tpXTtcbiAgICBkZXNjcmlwdG9yLmVudW1lcmFibGUgPSBkZXNjcmlwdG9yLmVudW1lcmFibGUgfHwgZmFsc2U7XG4gICAgZGVzY3JpcHRvci5jb25maWd1cmFibGUgPSB0cnVlO1xuICAgIGlmIChcInZhbHVlXCIgaW4gZGVzY3JpcHRvcikgZGVzY3JpcHRvci53cml0YWJsZSA9IHRydWU7XG4gICAgT2JqZWN0LmRlZmluZVByb3BlcnR5KHRhcmdldCwgZGVzY3JpcHRvci5rZXksIGRlc2NyaXB0b3IpO1xuICB9XG59XG5cbmZ1bmN0aW9uIF9jcmVhdGVDbGFzcyhDb25zdHJ1Y3RvciwgcHJvdG9Qcm9wcywgc3RhdGljUHJvcHMpIHtcbiAgaWYgKHByb3RvUHJvcHMpIF9kZWZpbmVQcm9wZXJ0aWVzKENvbnN0cnVjdG9yLnByb3RvdHlwZSwgcHJvdG9Qcm9wcyk7XG4gIGlmIChzdGF0aWNQcm9wcykgX2RlZmluZVByb3BlcnRpZXMoQ29uc3RydWN0b3IsIHN0YXRpY1Byb3BzKTtcbiAgcmV0dXJuIENvbnN0cnVjdG9yO1xufVxuXG5tb2R1bGUuZXhwb3J0cyA9IF9jcmVhdGVDbGFzczsiLCIvLyBpbXBvcnQgJCBmcm9tICdqcXVlcnknXG5cbmNvbnN0IERyb3Bkb3duRGlzbWlzc2FibGUgPSAoKCkgPT4ge1xuICBjb25zdCBOQU1FICAgICAgICAgICAgICAgPSAnZHJvcGRvd25EaXNtaXNzYWJsZSdcbiAgY29uc3QgREFUQV9LRVkgICAgICAgICAgID0gJ2JzLmRyb3Bkb3duLWRpc21pc3NhYmxlJ1xuICBjb25zdCBKUVVFUllfTk9fQ09ORkxJQ1QgPSAkLmZuW05BTUVdXG5cbiAgY2xhc3MgRHJvcGRvd25EaXNtaXNzYWJsZSB7XG4gICAgY29uc3RydWN0b3IoZWxlbWVudCkge1xuICAgICAgT2JqZWN0LmRlZmluZVByb3BlcnR5KGVsZW1lbnQsIE5BTUUsIHtcbiAgICAgICAgY29uZmlndXJhYmxlOiB0cnVlLFxuICAgICAgICB3cml0YWJsZTogZmFsc2UsXG4gICAgICAgIHZhbHVlOiB0aGlzXG4gICAgICB9KVxuXG4gICAgICB0aGlzLl9lbGVtZW50ID0gZWxlbWVudFxuICAgICAgdGhpcy5fZGlzbWlzcyA9IGVsZW1lbnQucXVlcnlTZWxlY3RvcignW2RhdGEtZGlzbWlzcz1cImRyb3Bkb3duXCJdJylcbiAgICAgIHRoaXMuX3RvZ2dsZSA9IGVsZW1lbnQucXVlcnlTZWxlY3RvcignW2RhdGEtdG9nZ2xlPVwiZHJvcGRvd25cIl0nKVxuICAgICAgdGhpcy5faW5pdCgpXG4gICAgICB0aGlzLl9hZGRFdmVudExpc3RlbmVycygpXG4gICAgfVxuXG4gICAgX2luaXQoKSB7XG4gICAgICAkKCcuZHJvcGRvd24tbWVudScsIHRoaXMuX2VsZW1lbnQpLnJlbW92ZUNsYXNzKCdzaG93JykucmVtb3ZlQXR0cignc3R5bGUnKVxuICAgICAgaWYgKCQodGhpcy5fZWxlbWVudCkuaGFzQ2xhc3MoJ3Nob3cnKSkge1xuICAgICAgICAkKHRoaXMuX2VsZW1lbnQpLnJlbW92ZUNsYXNzKCdzaG93JylcbiAgICAgICAgJCh0aGlzLl90b2dnbGUpLmRyb3Bkb3duKCd0b2dnbGUnKVxuICAgICAgfVxuICAgICAgdGhpcy5fZWxlbWVudC5fY2xvc2FibGUgPSBmYWxzZVxuICAgIH1cblxuICAgIF9hZGRFdmVudExpc3RlbmVycygpIHtcbiAgICAgIHRoaXMuX2Rpc21pc3MuYWRkRXZlbnRMaXN0ZW5lcignY2xpY2snLCB0aGlzLmRpc21pc3MuYmluZCh0aGlzKSlcbiAgICB9XG5cbiAgICBfcmVtb3ZlRXZlbnRMaXN0ZW5lcnMoKSB7XG4gICAgICB0aGlzLl9kaXNtaXNzLnJlbW92ZUV2ZW50TGlzdGVuZXIoJ2NsaWNrJywgdGhpcy5kaXNtaXNzLmJpbmQodGhpcykpXG4gICAgfVxuXG4gICAgLy8gU3RhdGljIGpRdWVyeSBJbnRlcmZhY2VcblxuICAgIHN0YXRpYyBfalF1ZXJ5SW50ZXJmYWNlKGNvbmZpZykge1xuICAgICAgcmV0dXJuIHRoaXMuZWFjaChmdW5jdGlvbiAoKSB7XG4gICAgICAgIGxldCBkYXRhID0gJCh0aGlzKS5kYXRhKERBVEFfS0VZKVxuICAgICAgICBpZiAoIWRhdGEpIHtcbiAgICAgICAgICBkYXRhID0gbmV3IERyb3Bkb3duRGlzbWlzc2FibGUodGhpcylcbiAgICAgICAgICAkKHRoaXMpLmRhdGEoREFUQV9LRVksIGRhdGEpXG4gICAgICAgIH1cblxuICAgICAgICBpZiAodHlwZW9mIGNvbmZpZyA9PT0gJ3N0cmluZycpIHtcbiAgICAgICAgICBpZiAodHlwZW9mIGRhdGFbY29uZmlnXSA9PT0gJ3VuZGVmaW5lZCcpIHtcbiAgICAgICAgICAgIHRocm93IG5ldyBFcnJvcihgTm8gbWV0aG9kIG5hbWVkIFwiJHtjb25maWd9XCJgKVxuICAgICAgICAgIH1cbiAgICAgICAgICBkYXRhW2NvbmZpZ10oKVxuICAgICAgICB9XG4gICAgICB9KVxuICAgIH1cblxuICAgIC8vIFB1YmxpY1xuXG4gICAgZGlzbWlzcyhldmVudCkge1xuICAgICAgdGhpcy5fZWxlbWVudC5fY2xvc2FibGUgPSB0cnVlXG4gICAgICBpZiAoIWV2ZW50KSB7XG4gICAgICAgICQodGhpcy5fdG9nZ2xlKS5kcm9wZG93bigndG9nZ2xlJylcbiAgICAgIH1cbiAgICB9XG5cbiAgICBkZXN0cm95KCkge1xuICAgICAgdGhpcy5fcmVtb3ZlRXZlbnRMaXN0ZW5lcnMoKVxuXG4gICAgICAkLnJlbW92ZURhdGEodGhpcy5fZWxlbWVudCwgREFUQV9LRVkpXG4gICAgICAkKHRoaXMuX2VsZW1lbnQpLmRyb3Bkb3duKCdkaXNwb3NlJylcbiAgICAgIHRoaXMuX2VsZW1lbnQgPSBudWxsXG4gICAgfVxuICB9XG5cbiAgJChkb2N1bWVudCkub24oe1xuICAgICdzaG93LmJzLmRyb3Bkb3duJzogZnVuY3Rpb24oKSB7XG4gICAgICB0aGlzLl9jbG9zYWJsZSA9IGZhbHNlXG4gICAgfSxcbiAgICAnaGlkZS5icy5kcm9wZG93bic6IGZ1bmN0aW9uKCkge1xuICAgICAgcmV0dXJuIHRoaXMuX2Nsb3NhYmxlID09PSB1bmRlZmluZWQgfHwgdGhpcy5fY2xvc2FibGUgIT09IGZhbHNlXG4gICAgfVxuICB9LCAnW2RhdGEtZHJvcGRvd24tZGlzbWlzc2FibGVdJylcblxuICAvLy8vLy8vLy8vLy9cbiAgLy8galF1ZXJ5IC8vXG4gIC8vLy8vLy8vLy8vL1xuXG4gICQuZm5bTkFNRV0gICAgICAgICAgICAgPSBEcm9wZG93bkRpc21pc3NhYmxlLl9qUXVlcnlJbnRlcmZhY2VcbiAgJC5mbltOQU1FXS5Db25zdHJ1Y3RvciA9IERyb3Bkb3duRGlzbWlzc2FibGVcbiAgJC5mbltOQU1FXS5ub0NvbmZsaWN0ICA9IGZ1bmN0aW9uICgpIHtcbiAgICAkLmZuW05BTUVdID0gSlFVRVJZX05PX0NPTkZMSUNUXG4gICAgcmV0dXJuIERyb3Bkb3duRGlzbWlzc2FibGUuX2pRdWVyeUludGVyZmFjZVxuICB9XG5cbiAgLy8vLy8vLy8vLy8vLy8vL1xuICAvLyBJbml0aWFsaXplIC8vXG4gIC8vLy8vLy8vLy8vLy8vLy9cbiAgXG4gICQoJ1tkYXRhLWRyb3Bkb3duLWRpc21pc3NhYmxlXScpLmRyb3Bkb3duRGlzbWlzc2FibGUoKVxuXG4gIHJldHVybiBEcm9wZG93bkRpc21pc3NhYmxlXG5cbn0pKCQpXG5cbmV4cG9ydCBkZWZhdWx0IERyb3Bkb3duRGlzbWlzc2FibGUiXSwic291cmNlUm9vdCI6IiJ9