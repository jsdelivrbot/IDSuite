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
/******/ 	return __webpack_require__(__webpack_require__.s = 20);
/******/ })
/************************************************************************/
/******/ ({

/***/ 1:
/***/ (function(module, exports) {

/**
 * Created by amac on 6/28/17.
 */
/**
 * Created by amac on 6/24/17.
 */

$(document).ready(function () {
    $.ajax({
        type: "GET",
        url: '/getChartDeviceByType',
        success: function success(data) {

            var names = data.names;

            var values = data.values;

            console.log(names);
            console.log(values);

            var devicebytype = document.getElementById("devicebytype").getContext('2d');

            var myChart = new Chart(devicebytype, {
                type: 'pie',
                data: {
                    datasets: [{
                        data: values,
                        backgroundColor: ['rgba(230, 71, 89, .2)', 'rgba(27, 201, 142, .2)', 'rgba(159, 134, 255, .2)', 'rgba(228, 216, 54, .2)', 'rgba(28, 168, 221, .21)', 'rgba(28, 168, 221, .21)', 'rgba(28, 168, 221, .21)'],
                        borderColor: ['rgba(230, 71, 89, 1)', 'rgba(27, 201, 142, 1)', 'rgba(159, 134, 255, 1)', 'rgba(228, 216, 54, 1)', 'rgba(28, 168, 221, 1)', 'rgba(28, 168, 221, 1)', 'rgba(28, 168, 221, 1)']
                    }],
                    labels: names
                },
                options: {
                    responsive: true,
                    title: {
                        display: true,
                        text: 'Devices by Type',
                        fontColor: 'rgba(255,255,255,1)',
                        fontSize: 24
                    }
                }
            });
        }
    });

    $.ajax({
        type: "GET",
        url: '/getChartDeviceUpStatusAll',
        success: function success(data) {

            var status = data.status;

            var value = data.value;

            var devicebystatus = document.getElementById("deviceupstatus").getContext('2d');

            var myChart = new Chart(devicebystatus, {
                type: 'bar',
                data: {
                    datasets: [{
                        data: status,
                        backgroundColor: ['rgba(27, 201, 142, .2)', 'rgba(230, 71, 89, .2)'],
                        borderColor: ['rgba(27, 201, 142, 1)', 'rgba(230, 71, 89, 1)']
                    }],
                    labels: ["Devices Up", "Devices Down"]
                },
                options: {
                    responsive: true,
                    title: {
                        display: true,
                        text: 'Current Device Statuses',
                        fontColor: 'rgba(255,255,255,1)',
                        fontSize: 24
                    }
                }
            });
        }
    });

    $.ajax({
        type: "GET",
        url: '/getChartDeviceUpStatusPercentAll',
        success: function success(data) {

            var status = data.status;

            var deviceupstatuspercentall = document.getElementById("deviceupstatuspercentall").getContext('2d');

            var myChart = new Chart(deviceupstatuspercentall, {
                type: 'doughnut',
                data: {
                    datasets: [{
                        data: status,
                        backgroundColor: ['rgba(27, 201, 142, .2)', 'rgba(230, 71, 89, .2)'],
                        borderColor: ['rgba(27, 201, 142, 1)', 'rgba(230, 71, 89, 1)']
                    }],
                    labels: ["Devices Up", "Devices Down"]
                },
                options: {
                    responsive: true,
                    title: {
                        display: true,
                        text: 'Current Device Statuses',
                        fontColor: 'rgba(255,255,255,1)',
                        fontSize: 24
                    },
                    tooltips: {
                        callbacks: {
                            label: function label(tooltipItem, data) {
                                var dataset = data.datasets[tooltipItem.datasetIndex];

                                var dataitem = dataset.data[tooltipItem.index];

                                return dataitem + "%";
                            }
                        }
                    }
                }
            });
        }
    });
});

/***/ }),

/***/ 20:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(1);


/***/ })

/******/ });