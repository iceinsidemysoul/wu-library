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
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
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
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 48);
/******/ })
/************************************************************************/
/******/ ({

/***/ 48:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(49);


/***/ }),

/***/ 49:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony default export */ __webpack_exports__["default"] = ((function () {

	$(document).ready(function () {

		// for pointer movement
		var current_year = $('.year:eq(0)');
		var year_lists = $('.year');
		var years_position = [];
		var pointer = $('.pointer');
		// ***************

		// for page scrolled
		var page_top_position = 0;
		var first_post_for_each_year = [];
		// ********************

		getYearsPosition();
		setCurrentYearStyle();

		$('#draggable').draggable({
			axis: 'y',
			containment: '.timeline',
			start: function start() {
				getYearsPosition();
				var pointer_position = getPositionOfCenter(pointer);
			},
			drag: function drag() {
				findClosestYear();
				$(pointer).text($(current_year).prop('title'));
			},
			stop: function stop() {
				setPointerToClosestYear();
				// set style for current year
				setCurrentYearStyle();
				// TODO:: then scroll to the point of first post of current year
			}
		});

		// when user scroll the page
		// detect height and 

		function getYearsPosition() {
			$.each(year_lists, function (k, v) {
				years_position[k] = getPositionOfCenter(v);
			});
		}

		function getPositionOfCenter(obj) {
			var h = $(obj).outerHeight();
			var top = $(obj).offset().top;

			return top + h / 2;
		}

		function findClosestYear() {
			var current_pointer_position = getPositionOfCenter(pointer);
			getYearsPosition();
			if (current_pointer_position < years_position[0]) return 0;else if (current_pointer_position > years_position[years_position.length - 1]) return years_position.length - 1;
			for (var i = 0; i < years_position.length - 1; i++) {
				if (current_pointer_position > years_position[i] && current_pointer_position < years_position[i + 1]) {
					if (current_pointer_position - years_position[i] < years_position[i + 1] - current_pointer_position) {
						current_year = $('.year:eq(' + i + ')');
					} else {
						current_year = $('.year:eq(' + (i + 1) + ')');
					}
					break;
				}
			}
		}

		function setPointerToClosestYear() {
			var x = $(pointer).offset().left;
			var h = $(pointer).outerHeight();
			var t = getPositionOfCenter($(current_year));
			$(pointer).offset({ left: x, top: t - h / 2 });
		}

		function setCurrentYearStyle() {
			$('.year').removeClass('current');
			$(current_year).addClass('current');
			setPointerToClosestYear();
		}

		function scrollToCurrentYearPost() {}
	});
})());

/***/ })

/******/ });