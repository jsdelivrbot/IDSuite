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
/******/ 	return __webpack_require__(__webpack_require__.s = 21);
/******/ })
/************************************************************************/
/******/ ({

/***/ 2:
/***/ (function(module, exports) {

/**
 * Created by amac on 6/29/17.
 */
/**
 * Created by amac on 6/28/17.
 */
/**
 * Created by amac on 6/24/17.
 */

$('#note-submit').click(function () {

    var text = $('#note-text').val();

    $.ajax({
        type: "POST",
        url: '/notes',
        data: {
            text: text
        },
        success: function success(data) {
            // add note dynamically to note list //

            $('#noteModal').modal('hide');

            console.log($('#note-default').length);

            if ($('#note-default').length === 1) {
                $('#note-default').hide();
                $('#note-last-hr').hide();
                $('#notes-title').after('<div class="card-text text-white"><div>' + data.text + '</div><small>created - ' + data.created_at + '</small></div><hr class="mb-4" style="border-color: #E4D836">');
            } else {
                $('#notes-title').after('<div class="card-text text-white"><div>' + data.text + '</div><small>created - ' + data.created_at + '</small></div><hr class="mb-4" style="border-color: #E4D836">');
            }
        }
    });
});

$('#note-cancel').click(function () {
    $('#noteModal').modal('hide');
});

/***/ }),

/***/ 21:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(2);


/***/ })

/******/ });