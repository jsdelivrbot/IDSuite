@extends('layouts.app')

@section('content')

    <div class="container p-lg-1">
        <div class="row">
            <div class="col-lg-12 col-md-12 offset-md-2 offset-lg-0">

                @php
                    $number = rand(1,5);
                @endphp

                <style>
                    .demo {
                        position: relative;
                        margin: 120px auto;
                        width: 150px;
                    }

                    .loader {
                        position: absolute;
                        opacity: .7;
                    }

                    .loader circle {
                        animation: draw 4s infinite ease-in-out;
                        transform-origin: center;
                        transform: rotate(-90deg);
                    }

                    .loader-2 circle,
                    .loader-6 circle {
                        animation-delay: 1s;
                    }

                    .loader-7 circle {
                        animation-delay: 2s;
                    }

                    .loader-4 circle,
                    .loader-8 circle {
                        animation-delay: 3s;
                    }

                    .loader-3 {
                        left: -150px;
                        transform: rotateY(180deg);
                    }

                    .loader-6,
                    .loader-7,
                    .loader-8 {
                        left: -150px;
                        transform: rotateX(180deg) rotateY(180deg);
                    }

                    .loader-5 circle {
                        opacity: .2;
                    }

                    @keyframes draw {
                        50% {
                            stroke-dashoffset: 0;
                            transform: scale(.5);
                        }
                    }

                </style>

                @if($number === 1)



                    <div class="card card-inverse card-square border-bottom-pink border-right-pink"
                         style="border-top: none; border-left: none; background-color: transparent;">
                        <div class="card-block">
                            <h4 id="header-title" class="card-title pink"></h4>

                            <p id="header-title-description" class="card-text text-white"></p>

                            <div class="col-md-10 offset-1">
                                <input type="button" value="Export charts to PDF" onclick="createReport();"/>
                                <div  class="chart-container">
                                    <div id="chart1" style="width: 100%; height: 400px;"></div>
                                </div>


                                {{--<div class="demo">--}}
                                    {{--<svg class="loader">--}}
                                        {{--<filter id="blur">--}}
                                            {{--<fegaussianblur in="SourceGraphic" stddeviation="2"></fegaussianblur>--}}
                                        {{--</filter>--}}
                                        {{--<circle cx="75" cy="75" r="60" fill="transparent" stroke="#F4F519" stroke-width="6" stroke-linecap="round" stroke-dasharray="385" stroke-dashoffset="385" filter="url(#blur)"></circle>--}}
                                    {{--</svg>--}}
                                    {{--<svg class="loader loader-2">--}}
                                        {{--<circle cx="75" cy="75" r="60" fill="transparent" stroke="#DE2FFF" stroke-width="6" stroke-linecap="round" stroke-dasharray="385" stroke-dashoffset="385" filter="url(#blur)"></circle>--}}
                                    {{--</svg>--}}
                                    {{--<svg class="loader loader-3">--}}
                                        {{--<circle cx="75" cy="75" r="60" fill="transparent" stroke="#FF5932" stroke-width="6" stroke-linecap="round" stroke-dasharray="385" stroke-dashoffset="385" filter="url(#blur)"></circle>--}}
                                    {{--</svg>--}}
                                    {{--<svg class="loader loader-4">--}}
                                        {{--<circle cx="75" cy="75" r="60" fill="transparent" stroke="#E97E42" stroke-width="6" stroke-linecap="round" stroke-dasharray="385" stroke-dashoffset="385" filter="url(#blur)"></circle>--}}
                                    {{--</svg>--}}
                                    {{--<svg class="loader loader-5">--}}
                                        {{--<circle cx="75" cy="75" r="60" fill="transparent" stroke="white" stroke-width="6" stroke-linecap="round" filter="url(#blur)"></circle>--}}
                                    {{--</svg>--}}
                                    {{--<svg class="loader loader-6">--}}
                                        {{--<circle cx="75" cy="75" r="60" fill="transparent" stroke="#00DCA3" stroke-width="6" stroke-linecap="round" stroke-dasharray="385" stroke-dashoffset="385" filter="url(#blur)"></circle>--}}
                                    {{--</svg>--}}
                                    {{--<svg class="loader loader-7">--}}
                                        {{--<circle cx="75" cy="75" r="60" fill="transparent" stroke="purple" stroke-width="6" stroke-linecap="round" stroke-dasharray="385" stroke-dashoffset="385" filter="url(#blur)"></circle>--}}
                                    {{--</svg>--}}
                                    {{--<svg class="loader loader-8">--}}
                                        {{--<circle cx="75" cy="75" r="60" fill="transparent" stroke="#AAEA33" stroke-width="6" stroke-linecap="round" stroke-dasharray="385" stroke-dashoffset="385" filter="url(#blur)"></circle>--}}
                                    {{--</svg>--}}
                                {{--</div>--}}

                            </div>

                        </div>
                    </div>

                @elseif($number === 2)

                    <div class="card card-inverse card-square border-bottom-teal border-right-teal"
                         style="border-top: none; border-left: none; background-color: transparent; ">
                        <div class="card-block">
                            <h4 id="header-title" class="card-title teal"></h4>
                            <p id="header-title-description" class="card-text text-white"></p>

                            <div class="col-md-10 offset-1">
                                <input type="button" value="Export charts to PDF" onclick="createReport();"/>
                                <div class="chart-container">
                                    <div id="chart1" style="width: 100%; height: 400px;"></div>
                                </div>


                                {{--<div class="demo">--}}
                                    {{--<svg class="loader">--}}
                                        {{--<filter id="blur">--}}
                                            {{--<fegaussianblur in="SourceGraphic" stddeviation="2"></fegaussianblur>--}}
                                        {{--</filter>--}}
                                        {{--<circle cx="75" cy="75" r="60" fill="transparent" stroke="#F4F519" stroke-width="6" stroke-linecap="round" stroke-dasharray="385" stroke-dashoffset="385" filter="url(#blur)"></circle>--}}
                                    {{--</svg>--}}
                                    {{--<svg class="loader loader-2">--}}
                                        {{--<circle cx="75" cy="75" r="60" fill="transparent" stroke="#DE2FFF" stroke-width="6" stroke-linecap="round" stroke-dasharray="385" stroke-dashoffset="385" filter="url(#blur)"></circle>--}}
                                    {{--</svg>--}}
                                    {{--<svg class="loader loader-3">--}}
                                        {{--<circle cx="75" cy="75" r="60" fill="transparent" stroke="#FF5932" stroke-width="6" stroke-linecap="round" stroke-dasharray="385" stroke-dashoffset="385" filter="url(#blur)"></circle>--}}
                                    {{--</svg>--}}
                                    {{--<svg class="loader loader-4">--}}
                                        {{--<circle cx="75" cy="75" r="60" fill="transparent" stroke="#E97E42" stroke-width="6" stroke-linecap="round" stroke-dasharray="385" stroke-dashoffset="385" filter="url(#blur)"></circle>--}}
                                    {{--</svg>--}}
                                    {{--<svg class="loader loader-5">--}}
                                        {{--<circle cx="75" cy="75" r="60" fill="transparent" stroke="white" stroke-width="6" stroke-linecap="round" filter="url(#blur)"></circle>--}}
                                    {{--</svg>--}}
                                    {{--<svg class="loader loader-6">--}}
                                        {{--<circle cx="75" cy="75" r="60" fill="transparent" stroke="#00DCA3" stroke-width="6" stroke-linecap="round" stroke-dasharray="385" stroke-dashoffset="385" filter="url(#blur)"></circle>--}}
                                    {{--</svg>--}}
                                    {{--<svg class="loader loader-7">--}}
                                        {{--<circle cx="75" cy="75" r="60" fill="transparent" stroke="purple" stroke-width="6" stroke-linecap="round" stroke-dasharray="385" stroke-dashoffset="385" filter="url(#blur)"></circle>--}}
                                    {{--</svg>--}}
                                    {{--<svg class="loader loader-8">--}}
                                        {{--<circle cx="75" cy="75" r="60" fill="transparent" stroke="#AAEA33" stroke-width="6" stroke-linecap="round" stroke-dasharray="385" stroke-dashoffset="385" filter="url(#blur)"></circle>--}}
                                    {{--</svg>--}}
                                {{--</div>--}}

                            </div>

                        </div>
                    </div>

                @elseif($number === 3)

                    <div class="card card-inverse card-square border-bottom-purple border-right-purple"
                         style="border-top: none; border-left: none; background-color: transparent;">
                        <div class="card-block">
                            <h4 id="header-title" class="card-title purple"></h4>
                            <p id="header-title-description" class="card-text text-white"></p>

                            <div class="col-md-10 offset-1">
                                <input type="button" value="Export charts to PDF" onclick="createReport();"/>
                                <div class="chart-container">
                                    <div id="chart1" style="width: 100%; height: 400px;"></div>
                                </div>


                                {{--<div class="demo">--}}
                                    {{--<svg class="loader">--}}
                                        {{--<filter id="blur">--}}
                                            {{--<fegaussianblur in="SourceGraphic" stddeviation="2"></fegaussianblur>--}}
                                        {{--</filter>--}}
                                        {{--<circle cx="75" cy="75" r="60" fill="transparent" stroke="#F4F519" stroke-width="6" stroke-linecap="round" stroke-dasharray="385" stroke-dashoffset="385" filter="url(#blur)"></circle>--}}
                                    {{--</svg>--}}
                                    {{--<svg class="loader loader-2">--}}
                                        {{--<circle cx="75" cy="75" r="60" fill="transparent" stroke="#DE2FFF" stroke-width="6" stroke-linecap="round" stroke-dasharray="385" stroke-dashoffset="385" filter="url(#blur)"></circle>--}}
                                    {{--</svg>--}}
                                    {{--<svg class="loader loader-3">--}}
                                        {{--<circle cx="75" cy="75" r="60" fill="transparent" stroke="#FF5932" stroke-width="6" stroke-linecap="round" stroke-dasharray="385" stroke-dashoffset="385" filter="url(#blur)"></circle>--}}
                                    {{--</svg>--}}
                                    {{--<svg class="loader loader-4">--}}
                                        {{--<circle cx="75" cy="75" r="60" fill="transparent" stroke="#E97E42" stroke-width="6" stroke-linecap="round" stroke-dasharray="385" stroke-dashoffset="385" filter="url(#blur)"></circle>--}}
                                    {{--</svg>--}}
                                    {{--<svg class="loader loader-5">--}}
                                        {{--<circle cx="75" cy="75" r="60" fill="transparent" stroke="white" stroke-width="6" stroke-linecap="round" filter="url(#blur)"></circle>--}}
                                    {{--</svg>--}}
                                    {{--<svg class="loader loader-6">--}}
                                        {{--<circle cx="75" cy="75" r="60" fill="transparent" stroke="#00DCA3" stroke-width="6" stroke-linecap="round" stroke-dasharray="385" stroke-dashoffset="385" filter="url(#blur)"></circle>--}}
                                    {{--</svg>--}}
                                    {{--<svg class="loader loader-7">--}}
                                        {{--<circle cx="75" cy="75" r="60" fill="transparent" stroke="purple" stroke-width="6" stroke-linecap="round" stroke-dasharray="385" stroke-dashoffset="385" filter="url(#blur)"></circle>--}}
                                    {{--</svg>--}}
                                    {{--<svg class="loader loader-8">--}}
                                        {{--<circle cx="75" cy="75" r="60" fill="transparent" stroke="#AAEA33" stroke-width="6" stroke-linecap="round" stroke-dasharray="385" stroke-dashoffset="385" filter="url(#blur)"></circle>--}}
                                    {{--</svg>--}}
                                {{--</div>--}}

                            </div>

                        </div>
                    </div>

                @elseif($number === 4)

                    <div class="card card-inverse card-square border-bottom-yellow border-right-yellow"
                         style="border-top: none; border-left: none; background-color: transparent;">
                        <div class="card-block">
                            <h4 id="header-title" class="card-title yellow"></h4>
                            <p id="header-title-description" class="card-text text-white"></p>

                            <div class="col-md-10 offset-1">
                                <input type="button" value="Export charts to PDF" onclick="createReport();"/>
                                <div class="chart-container">
                                    <div id="chart1" style="width: 100%; height: 400px;"></div>
                                </div>


                                {{--<div class="demo">--}}
                                    {{--<svg class="loader">--}}
                                        {{--<filter id="blur">--}}
                                            {{--<fegaussianblur in="SourceGraphic" stddeviation="2"></fegaussianblur>--}}
                                        {{--</filter>--}}
                                        {{--<circle cx="75" cy="75" r="60" fill="transparent" stroke="#F4F519" stroke-width="6" stroke-linecap="round" stroke-dasharray="385" stroke-dashoffset="385" filter="url(#blur)"></circle>--}}
                                    {{--</svg>--}}
                                    {{--<svg class="loader loader-2">--}}
                                        {{--<circle cx="75" cy="75" r="60" fill="transparent" stroke="#DE2FFF" stroke-width="6" stroke-linecap="round" stroke-dasharray="385" stroke-dashoffset="385" filter="url(#blur)"></circle>--}}
                                    {{--</svg>--}}
                                    {{--<svg class="loader loader-3">--}}
                                        {{--<circle cx="75" cy="75" r="60" fill="transparent" stroke="#FF5932" stroke-width="6" stroke-linecap="round" stroke-dasharray="385" stroke-dashoffset="385" filter="url(#blur)"></circle>--}}
                                    {{--</svg>--}}
                                    {{--<svg class="loader loader-4">--}}
                                        {{--<circle cx="75" cy="75" r="60" fill="transparent" stroke="#E97E42" stroke-width="6" stroke-linecap="round" stroke-dasharray="385" stroke-dashoffset="385" filter="url(#blur)"></circle>--}}
                                    {{--</svg>--}}
                                    {{--<svg class="loader loader-5">--}}
                                        {{--<circle cx="75" cy="75" r="60" fill="transparent" stroke="white" stroke-width="6" stroke-linecap="round" filter="url(#blur)"></circle>--}}
                                    {{--</svg>--}}
                                    {{--<svg class="loader loader-6">--}}
                                        {{--<circle cx="75" cy="75" r="60" fill="transparent" stroke="#00DCA3" stroke-width="6" stroke-linecap="round" stroke-dasharray="385" stroke-dashoffset="385" filter="url(#blur)"></circle>--}}
                                    {{--</svg>--}}
                                    {{--<svg class="loader loader-7">--}}
                                        {{--<circle cx="75" cy="75" r="60" fill="transparent" stroke="purple" stroke-width="6" stroke-linecap="round" stroke-dasharray="385" stroke-dashoffset="385" filter="url(#blur)"></circle>--}}
                                    {{--</svg>--}}
                                    {{--<svg class="loader loader-8">--}}
                                        {{--<circle cx="75" cy="75" r="60" fill="transparent" stroke="#AAEA33" stroke-width="6" stroke-linecap="round" stroke-dasharray="385" stroke-dashoffset="385" filter="url(#blur)"></circle>--}}
                                    {{--</svg>--}}
                                {{--</div>--}}

                            </div>

                        </div>
                    </div>

                @else

                    <div class="card card-inverse card-square border-bottom-blue border-right-blue"
                         style="border-top: none; border-left: none; background-color: transparent;">
                        <div class="card-block">
                            <h4 id="header-title" class="card-title blue"></h4>
                            <p id="header-title-description" class="card-text text-white"></p>

                            <div class="col-md-10 offset-1">
                                <input type="button" value="Export charts to PDF" onclick="createReport();"/>
                                <div class="chart-container">
                                    <div id="chart1" style="width: 100%; height: 400px;"></div>
                                </div>


                                {{--<div class="demo">--}}
                                    {{--<svg class="loader">--}}
                                        {{--<filter id="blur">--}}
                                            {{--<fegaussianblur in="SourceGraphic" stddeviation="2"></fegaussianblur>--}}
                                        {{--</filter>--}}
                                        {{--<circle cx="75" cy="75" r="60" fill="transparent" stroke="#F4F519" stroke-width="6" stroke-linecap="round" stroke-dasharray="385" stroke-dashoffset="385" filter="url(#blur)"></circle>--}}
                                    {{--</svg>--}}
                                    {{--<svg class="loader loader-2">--}}
                                        {{--<circle cx="75" cy="75" r="60" fill="transparent" stroke="#DE2FFF" stroke-width="6" stroke-linecap="round" stroke-dasharray="385" stroke-dashoffset="385" filter="url(#blur)"></circle>--}}
                                    {{--</svg>--}}
                                    {{--<svg class="loader loader-3">--}}
                                        {{--<circle cx="75" cy="75" r="60" fill="transparent" stroke="#FF5932" stroke-width="6" stroke-linecap="round" stroke-dasharray="385" stroke-dashoffset="385" filter="url(#blur)"></circle>--}}
                                    {{--</svg>--}}
                                    {{--<svg class="loader loader-4">--}}
                                        {{--<circle cx="75" cy="75" r="60" fill="transparent" stroke="#E97E42" stroke-width="6" stroke-linecap="round" stroke-dasharray="385" stroke-dashoffset="385" filter="url(#blur)"></circle>--}}
                                    {{--</svg>--}}
                                    {{--<svg class="loader loader-5">--}}
                                        {{--<circle cx="75" cy="75" r="60" fill="transparent" stroke="white" stroke-width="6" stroke-linecap="round" filter="url(#blur)"></circle>--}}
                                    {{--</svg>--}}
                                    {{--<svg class="loader loader-6">--}}
                                        {{--<circle cx="75" cy="75" r="60" fill="transparent" stroke="#00DCA3" stroke-width="6" stroke-linecap="round" stroke-dasharray="385" stroke-dashoffset="385" filter="url(#blur)"></circle>--}}
                                    {{--</svg>--}}
                                    {{--<svg class="loader loader-7">--}}
                                        {{--<circle cx="75" cy="75" r="60" fill="transparent" stroke="purple" stroke-width="6" stroke-linecap="round" stroke-dasharray="385" stroke-dashoffset="385" filter="url(#blur)"></circle>--}}
                                    {{--</svg>--}}
                                    {{--<svg class="loader loader-8">--}}
                                        {{--<circle cx="75" cy="75" r="60" fill="transparent" stroke="#AAEA33" stroke-width="6" stroke-linecap="round" stroke-dasharray="385" stroke-dashoffset="385" filter="url(#blur)"></circle>--}}
                                    {{--</svg>--}}
                                {{--</div>--}}

                            </div>

                        </div>
                    </div>

                @endif

            </div>
        </div>


        <div class="col-lg-12 mt-5 mb-4" style="padding: 0;">
            <div class="row no-gutters">
                <div class="col-lg-6">
                    <div id="container_two"></div>
                </div>

                <div class="col-lg-6">
                    <div id="container_one"></div>
                </div>
            </div>
        </div>

        @include('measure.partials.custom_tabs.custom_tabs');

    </div>

@endsection


@push('account_scripts')

    <script>

        let charts = [];
        let layout_1;

        /**
         *
         * setHeaderCard
         *
         * set headers in cards
         *
         **/
        function setHeaderCard(name) {
            $('#header-title').text(name);

            $('#header-title-description').text('This is customer ' + name);
        }

        /**
         *
         * setHeaderChart
         *
         * set header chart in cards
         *
         **/
        function setHeaderChart(data) {
            let chart = AmCharts.makeChart("chart1", {
                "type": "serial",
                "theme": "dark",
                "pathToImages": "/assets/js/amcharts/images/",
                "marginTop": 0,
                "color": "#000",
                "font": 18,
                "marginRight": 80,
                "dataProvider": data,
                "valueAxes": [{
                    "axisAlpha": 0,
                    "position": "left"
                }],
                "graphs": [{
                    "id": "g1",
                    "balloonText": "[[category]]<br><b><span style='font-size:14px;'>[[value]]</span></b>",
                    "bullet": "round",
                    "bulletSize": 8,
                    "lineColor": "#d1655d",
                    "lineThickness": 2,
                    "negativeLineColor": "#637bb6",
                    "type": "smoothedLine",
                    "valueField": "value"
                }],
                "chartScrollbar": {
                    "graph": "g1",
                    "gridAlpha": 0,
                    "color": "#888888",
                    "scrollbarHeight": 55,
                    "backgroundAlpha": 0,
                    "selectedBackgroundAlpha": 0.1,
                    "selectedBackgroundColor": "#888888",
                    "graphFillAlpha": 0,
                    "autoGridCount": true,
                    "selectedGraphFillAlpha": 0,
                    "graphLineAlpha": 0.2,
                    "graphLineColor": "#c2c2c2",
                    "selectedGraphLineColor": "#888888",
                    "selectedGraphLineAlpha": 1

                },
                "chartScrollbarSettings": {
                    fontSize: 2
                },
                "chartCursor": {
                    "cursorAlpha": 0,
                    "valueLineEnabled": true,
                    "valueLineBalloonEnabled": true,
                    "valueLineAlpha": 0.5,
                    "fullWidth": true
                },
                "categoryField": "date_string",
                "export": {
                    "enabled": true,
                    "menu": []
                }
            });
            charts.push(chart);


            renderChart(chart);
        }


        /**
         *
         * getDataUri
         *
         * converts image source uri to raw image data.
         *
         * @param url
         * @param callback
         */
        function getDataUri(url, callback) {
            let image = new Image();

            image.onload = function () {
                let canvas = document.createElement('canvas');
                canvas.width = this.naturalWidth; // or 'width' if you want a special/scaled size
                canvas.height = this.naturalHeight; // or 'height' if you want a special/scaled size

                canvas.getContext('2d').drawImage(this, 0, 0);
                // ... or get as Data URI
                callback(canvas.toDataURL('image/png'));
            };

            image.src = url;
        }

        /**
         *
         * generateLayout
         *
         * generates a layout for a report based on parameters.
         *
         * @param header
         * @param footer
         * @param topbar
         * @param bottombar
         * @param charts
         * @param chartobject
         * @param callback
         */
        function generateLayout(header, footer, topbar, bottombar, charts, chartobject, callback) {

            let layout = {
                pageMargins: [40, 100, 40, 40],

                /*
                 ** Header; Shown on every page
                 */
                header: function (currentPage, totalPage) {
                    return {
                        image: "header",
                        fit: [600, 70],
                        margin: 30
                    }
                },

                content: [

                    /*
                     ** PAGE 1
                     */
                    {
                        image: "topbar",
                        fit: [900, 70],
                        margin: [-40, 20, 20, 20]
                    },
                    {
                        text: "Monthly Report",
                        style: ["header", "safetyDistance"],
                        alignment: "center"
                    }, {
                        text: "Generation Detail: by IDSolutions",
                        style: "safetyDistance",
                        alignment: "center"
                    }, {
                        columnGap: 40,
                        columns: [{
                            stack: [{
                                text: "Call Volume Over Time",
                                style: "subheader"
                            }, {
                                image: "chart1",
                                fit: [( 595.28 / 2 ) - 60, ( 595.28 / 2 ) - 60] // 1 column width incl. margins
                            }]
                        }, {
                            stack: [{
                                text: "Device Count by Type",
                                style: "subheader"
                            }, {
                                image: "chart2",
                                fit: [( 595.28 / 2 ) - 60, ( 595.28 / 2 ) - 60] // 1 column width incl. margins
                            }]
                        }],
                        style: "safetyDistance"
                    }, {
                        columnGap: 40,
                        columns: [{
                            stack: [{
                                text: "Count of Online/Offline Device",
                                style: "subheader"
                            }, {
                                image: "chart3",
                                fit: [( 595.28 / 2 ) - 60, ( 595.28 / 2 ) - 60] // 1 column width incl. margins
                            }]
                        }, {
                            stack: [{
                                text: "Count of Online/Offline Device",
                                style: "subheader"
                            }, {
                                image: "chart4",
                                fit: [( 595.28 / 2 ) - 60, ( 595.28 / 2 ) - 60] // 1 column width incl. margins
                            }]
                        }],
                        style: "safetyDistance"
                    },
                    {
                        image: "bottombar",
                        fit: [900, 70],
                        margin: [-40, 185, 20, 20]
                    }

                ],

                /*
                 ** Footer; Shown on every page
                 */
                footer: function (currentPage, totalPage) {
                    return {
                        image: "footer",
                        fit: [150, 350],
                        alignment: "center"
                    }
                },

                /*
                 ** Predefined styles which can be applied through "style" on every content element
                 */
                styles: {
                    header: {
                        fontSize: 18,
                        bold: true
                    },
                    subheader: {
                        bold: true
                    },
                    description: {
                        fontSize: 10,
                        color: "#CCCCCC",
                        margin: [0, 5, 0, 10]
                    },
                    safetyDistance: {
                        margin: [0, 0, 0, 20]
                    }
                },

                /*
                 ** Predefined images
                 */
                images: {
                    header: header,
                    topbar: topbar,
                    bottombar: bottombar,
                    footer: footer,
                    chart1: charts[0],
                    chart2: charts[1],
                    chart3: charts[2],
                    chart4: charts[3]
                }
            };

            callback(chartobject, layout);
        }


        /**
         *
         * createReport
         *
         * creates a report that can be used to save to a format.
         *
         */
        function createReport() {

            let pdf_images = 0;
            let pdf_layout = layout_1; // loaded from another JS file

            let chartids = ['chart1', 'devicebytype', 'avergaecallduration', 'casesopened'];

            let charts = {};

            let charts_remaining = chartids.length;

            console.log(AmCharts.charts);

            for (let i = 0; i < chartids.length; i++) {

                for (let x = 0; x < AmCharts.charts.length; x++) {

                    if (AmCharts.charts[x].div.id === chartids[i]) {
                        charts[chartids[i]] = AmCharts.charts[x];
                    }

                }

            }
            let charters = [];

            for (let x in charts) {

                if (charts.hasOwnProperty(x)) {

                    let chart = charts[x];

                    chart["export"].capture({}, function () {
                        this.toPNG({}, function (data) {

                            this.setup.chart.exportedImage = data;

                            charters.push(data);

                            console.log(charters);

                            charts_remaining--;

                            console.log(charts_remaining);


                            if (charts_remaining === 0) {

                                console.log(charters);


                                generateLayout(header, footer, topbar, bottombar, charters, this, generatePdf);

                            }

                        })

                    })

                }

            }

        }


        /**
         *
         * generatePdf
         *
         * takes a layout and report to generate a savable pdf
         *
         * @param chartobject
         * @param layout
         */
        function generatePdf(chartobject, layout) {

            console.log(layout);

            chartobject.toPDF(layout, function (data) {
                console.log('chartObject');

                chartobject.download(data, this.defaults.formats.PDF.mimeType, "amcharts.pdf");


            });

        }


        /**
         *
         * callVolumeOverTime
         *
         * get amchart data and validates the data to create object to show call volume over time.
         *
         * @param entity_id
         * @param start_time
         */
        function callVolumeOverTime(entity_id, start_time = (new Date()).getFullYear()) {

            let options = JSON.stringify({
                id: entity_id,
                start_time: start_time
            });

            return axios.get('/api/chart/callVolumeOverTime/' + options)
                .then(function (data) {
                    let chartData = data.data;

                    if(!validate(chartData)){
                        return false;
                    }

                    setHeaderChart(chartData);
                });
        }

        function setHmsCount(entity, el) {

//            setChartHW(el,'500px', '200px');

            let hms_count = 0;

            $.each(entity.endpoints, function(key, value){
                if(value.type === 7){
                    hms_count++;
                }
            });


            el.append(
                '<span class="h1 yellow" >'+hms_count+'</span>'
            );

        }

        /**
         *
         * getEntity
         *
         * gets entity object and validates it
         *
         * @param entity_id
         */
        function getEntity(entity_id) {

            let options = JSON.stringify({
                id: entity_id
            });

            return axios.get('/api/entity/' + options)
                .then(function (data) {
                    let response = data.data;

                    if(!validate(response)){
                        return false;
                    }

                    let entity = data.data.entity;
                    let name = entity.name;

                    setHeaderCard(name);

                    setHmsCount(entity, $('#hms-count-endpoints'));

                    setLocationTab(entity.sites, $('.location-tab'));
                    setContactTab(entity.personnel, $('.contacts-tab'));
                });
        }



        let header = "/img/global_presence_heading.png";
        let topbar = "/img/global_presence_top_bar.png";
        let bottombar = "/img/global_presence_bottom_bar.png";
        let footer = "/img/customer_care_heading.png";

        $(document).ready(function () {

            console.log(axiosrequests);

            axiosrequests.push = getEntity('{{$entity->id}}');
            axiosrequests.push = callVolumeOverTime('{{$entity->id}}');
            axiosrequests.push = getEntityManagers('{{$entity->id}}', $('#header-managers'));


            getDataUri(header, function (dataurl) {
                header = dataurl;
                getDataUri(topbar, function (dataurl) {
                    topbar = dataurl;
                    getDataUri(bottombar, function (dataurl) {
                        bottombar = dataurl;
                        getDataUri(footer, function (dataurl) {
                            footer = dataurl;

                        })
                    })
                })
            });

        });


        function renderChart(chart) {
            chart.addListener("rendered", function (e) {

                // WAIT FOR FABRIC
                var interval = setInterval(function () {
                    if (window.fabric) {
                        clearTimeout(interval);

                        // CAPTURE CHART
                        e.chart.export.capture({}, function () {

                            // SAVE TO JPG
                            this.toJPG({}, function (base64) {

                                // LOG IMAGE DATA
                                console.log(base64);

                                // CREATE LINK TO OPEN BASE64 IMAGE IN NEW TAB
                                var a = document.createElement("a");
                                a.setAttribute("href", base64);
                                a.setAttribute("target", "_blank");
                                a.setAttribute("style", "display: block; margin-top: 150px;");
                                a.innerHTML = "Open embedded base64-image";

                                var div = document.createElement("div");
                                div.setAttribute("style", "position: absolute; width: 100%; top:0; bottom: 0; background-color: rgba(255,255,255,.9); z-index: 1337; display: block;text-align: center;");
                                div.appendChild(a);

                                this.setup.chart.div.appendChild(div);

                                axios.post('/api/twilio/mms',{
                                    number: '3173166329',
                                    message: 'Alert',
                                    imageUrl: base64
                                }).then(function(response){
                                    console.log(response);

                                    alert(response);
                                });

                            });

                        });
                    }
                }, 100);
            });
        }

    </script>

@endpush