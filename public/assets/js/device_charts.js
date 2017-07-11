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
/******/ 	return __webpack_require__(__webpack_require__.s = 25);
/******/ })
/************************************************************************/
/******/ ({

/***/ 25:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(6);


/***/ }),

/***/ 6:
/***/ (function(module, exports) {

/**
 * Created by amac on 7/10/17.
 */

$(document).ready(function () {
    $.ajax({
        type: "GET",
        url: '/getChartDeviceCostPerCallAvg',
        success: function success(result) {

            var labels = result.labels;

            var data = result.data;

            var devicecallcostavg = document.getElementById("devicecallcostavg").getContext('2d');

            var myChart = new Chart(devicecallcostavg, {
                type: 'line',
                data: {
                    datasets: [{
                        data: data,
                        backgroundColor: ['rgba(230, 71, 89, .2)', 'rgba(27, 201, 142, .2)', 'rgba(159, 134, 255, .2)', 'rgba(228, 216, 54, .2)', 'rgba(28, 168, 221, .21)', 'rgba(28, 168, 221, .21)', 'rgba(28, 168, 221, .21)'],
                        borderColor: ['rgba(230, 71, 89, 1)', 'rgba(27, 201, 142, 1)', 'rgba(159, 134, 255, 1)', 'rgba(228, 216, 54, 1)', 'rgba(28, 168, 221, 1)', 'rgba(28, 168, 221, 1)', 'rgba(28, 168, 221, 1)']
                    }],
                    labels: labels
                },
                options: {
                    responsive: true,
                    title: {
                        display: true,
                        text: 'Device Cost Per Call Average',
                        fontColor: 'rgba(255,255,255,1)',
                        fontSize: 24
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                callback: function callback(value, index, values) {
                                    return value.toLocaleString("en-US", { style: "currency", currency: "USD" });
                                }
                            }
                        }]
                    }
                }
            });
        }
    });
});

/***/ })

/******/ });