/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId])
/******/ 			return installedModules[moduleId].exports;
/******/
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
/******/ 	// identity function for calling harmony imports with the correct context
/******/ 	__webpack_require__.i = function(value) { return value; };
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
/******/ 	return __webpack_require__(__webpack_require__.s = 19);
/******/ })
/************************************************************************/
/******/ ({

/***/ 19:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(4);


/***/ }),

/***/ 4:
/***/ (function(module, exports) {

/**
 * Created by amac on 6/24/17.
 */

$("#insights").click(function () {

    $('#contacts-a').addClass('blue');
    $('#contacts-a').removeClass('active active-outline-tab-blue text-white');

    $('#locations-a').addClass('teal');
    $('#locations-a').removeClass('active active-outline-tab-teal text-white');

    $('#notes-a').addClass('yellow');
    $('#notes-a').removeClass('active active-outline-tab-yellow text-white');

    $("#insights-a").addClass('active active-outline-tab-pink text-white');

    $('#account-card-header').removeClass('active-outline-card-header-teal');
    $('#account-card-header').removeClass('active-outline-card-header-blue');
    $('#account-card-header').removeClass('active-outline-card-header-yellow');

    $('#account-card-header').addClass('active-outline-card-header-pink');

    $('#account-card-block-locations-tab').removeClass('active');
    $('#account-card-block-contacts-tab').removeClass('active');
    $('#account-card-block-notes-tab').removeClass('active');

    $('#account-card-block-insights-tab').addClass('active');

    $('#account-card-block-a').removeClass('btn-nav-blue');
    $('#account-card-block-a').removeClass('btn-nav-teal');
    $('#account-card-block-a').removeClass('btn-nav-yellow');

    $('#account-card-block-a').addClass('btn-nav-pink');

    bar_one.set(0);

    bar_two.set(0);

    bar_one.animate(1.0, { to: { color: '#E64759' } }); // Number from 0.0 to 1.0
    bar_two.animate(-1.0, { to: { color: '#E64759' } }); // Number from 0.0 to 1.0
});

$("#contacts").click(function () {

    $('#insights-a').addClass('pink');
    $('#insights-a').removeClass('active active-outline-tab-pink text-white');

    $('#locations-a').addClass('teal');
    $('#locations-a').removeClass('active active-outline-tab-teal text-white');

    $('#notes-a').addClass('yellow');
    $('#notes-a').removeClass('active active-outline-tab-yellow text-white');

    $("#contacts-a").addClass('active active-outline-tab-blue text-white');

    $('#account-card-header').removeClass('active-outline-card-header-teal');
    $('#account-card-header').removeClass('active-outline-card-header-pink');
    $('#account-card-header').removeClass('active-outline-card-header-yellow');

    $('#account-card-header').addClass('active-outline-card-header-blue');

    $('#account-card-block-locations-tab').removeClass('active');
    $('#account-card-block-insights-tab').removeClass('active');
    $('#account-card-block-notes-tab').removeClass('active');

    $('#account-card-block-contacts-tab').addClass('active');

    $('#account-card-block-a').removeClass('btn-nav-pink');
    $('#account-card-block-a').removeClass('btn-nav-teal');
    $('#account-card-block-a').removeClass('btn-nav-yellow');

    $('#account-card-block-a').addClass('btn-nav-blue');

    bar_one.set(0);

    bar_two.set(0);

    bar_one.animate(1.0, { to: { color: '#1ca8dd' } }); // Number from 0.0 to 1.0
    bar_two.animate(-1.0, { to: { color: '#1ca8dd' } }); // Number from 0.0 to 1.0
});

$("#locations").click(function () {

    $('#insights-a').addClass('pink');
    $('#insights-a').removeClass('active active-outline-tab-pink text-white');

    $('#contacts-a').addClass('blue');
    $('#contacts-a').removeClass('active active-outline-tab-blue text-white');

    $('#notes-a').addClass('yellow');
    $('#notes-a').removeClass('active active-outline-tab-yellow text-white');

    $("#locations-a").addClass('active active-outline-tab-teal text-white');

    $('#account-card-header').removeClass('active-outline-card-header-pink');
    $('#account-card-header').removeClass('active-outline-card-header-blue');
    $('#account-card-header').removeClass('active-outline-card-header-yellow');

    $('#account-card-header').addClass('active-outline-card-header-teal');

    $('#account-card-block-insights-tab').removeClass('active');
    $('#account-card-block-contacts-tab').removeClass('active');
    $('#account-card-block-notes-tab').removeClass('active');

    $('#account-card-block-locations-tab').addClass('active');

    $('#account-card-block-a').removeClass('btn-nav-pink');
    $('#account-card-block-a').removeClass('btn-nav-blue');
    $('#account-card-block-a').removeClass('btn-nav-yellow');

    $('#account-card-block-a').addClass('btn-nav-teal');

    bar_one.set(0);
    // bar_one.to({color: '#1BC98E'});

    bar_two.set(0);
    // bar_two.to({color: '#1BC98E'});

    bar_one.animate(1.0, { to: { color: '#1BC98E' } }); // Number from 0.0 to 1.0
    bar_two.animate(-1.0, { to: { color: '#1BC98E' } }); // Number from 0.0 to 1.0
});

$("#notes").click(function () {

    $('#insights-a').addClass('pink');
    $('#insights-a').removeClass('active active-outline-tab-pink text-white');

    $('#contacts-a').addClass('blue');
    $('#contacts-a').removeClass('active active-outline-tab-blue text-white');

    $('#locations-a').addClass('teal');
    $('#locations-a').removeClass('active active-outline-tab-teal text-white');

    $("#notes-a").addClass('active active-outline-tab-yellow text-white');

    $('#account-card-header').removeClass('active-outline-card-header-pink');
    $('#account-card-header').removeClass('active-outline-card-header-blue');
    $('#account-card-header').removeClass('active-outline-card-header-teal');

    $('#account-card-header').addClass('active-outline-card-header-yellow');

    $('#account-card-block-insights-tab').removeClass('active');
    $('#account-card-block-contacts-tab').removeClass('active');
    $('#account-card-block-locations-tab').removeClass('active');

    $('#account-card-block-notes-tab').addClass('active');

    $('#account-card-block-a').removeClass('btn-nav-pink');
    $('#account-card-block-a').removeClass('btn-nav-blue');
    $('#account-card-block-a').removeClass('btn-nav-teal');

    $('#account-card-block-a').addClass('btn-nav-yellow');

    bar_one.set(0);
    // bar_one.to({color: '#1BC98E'});

    bar_two.set(0);
    // bar_two.to({color: '#1BC98E'});

    bar_one.animate(1.0, { to: { color: '#E4D836' } }); // Number from 0.0 to 1.0
    bar_two.animate(-1.0, { to: { color: '#E4D836' } }); // Number from 0.0 to 1.0
});

var bar_one = new ProgressBar.Line(container_one, {
    strokeWidth: 1,
    easing: 'easeInOut',
    duration: 1400,
    color: '#fff',
    trailColor: 'transparent',
    trailWidth: 1,
    svgStyle: { width: '100%', height: '100%' },
    from: { color: '#fff' },
    to: { color: '#E64759' },
    step: function step(state, bar) {
        bar.path.setAttribute('stroke', state.color);
    }
});

var bar_two = new ProgressBar.Line(container_two, {
    strokeWidth: 1,
    easing: 'easeInOut',
    duration: 1400,
    color: '#fff',
    trailColor: 'transparent',
    trailWidth: 1,
    svgStyle: { width: '100%', height: '100%' },
    from: { color: '#fff' },
    to: { color: '#E64759' },
    step: function step(state, bar) {
        bar.path.setAttribute('stroke', state.color);
    }
});

bar_one.animate(1.0); // Number from 0.0 to 1.0
bar_two.animate(-1.0); // Number from 0.0 to 1.0

/***/ })

/******/ });