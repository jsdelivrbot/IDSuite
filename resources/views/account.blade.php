@extends('layouts.app')

@section('content')

    <div class="container p-lg-1">
        <div class="row">
            <div class="col-lg-12 col-md-12 offset-md-2 offset-lg-0">
                @if($number === 1)

                    <div class="card card-inverse card-square border-bottom-pink border-right-pink" style="border-top: none; border-left: none; background-color: transparent;">
                        <div class="card-block">
                            <h4 class="card-title pink">{{$name}}</h4>
                            <p class="card-text text-white">This is customer {{$name}}</p>

                            <div class="col-md-10 offset-1">
                                <button type="button" class="btn btn-outline-info mb-3" onclick="createReport();" >Generate PDF Report</button>
                                <div id="chart1" style="width: 100%; height: 400px;"></div>
                            </div>

                        </div>
                    </div>

                @elseif($number === 2)

                    <div class="card card-inverse card-square border-bottom-teal border-right-teal" style="border-top: none; border-left: none; background-color: transparent; ">
                        <div class="card-block">
                            <h4 class="card-title teal">{{$name}}</h4>
                            <p class="card-text text-white">This is customer {{$name}}</p>

                            <div class="col-md-10 offset-1">
                                <button type="button" class="btn btn-outline-info mb-3" onclick="createReport();" >Generate PDF Report</button>
                                <div class="chart-container">
                                    <div id="chart1" style="width: 100%; height: 400px;"></div>
                                </div>
                            </div>

                        </div>
                    </div>

                @elseif($number === 3)

                    <div class="card card-inverse card-square border-bottom-purple border-right-purple" style="border-top: none; border-left: none; background-color: transparent;">
                        <div class="card-block">
                            <h4 class="card-title purple">{{$name}}</h4>
                            <p class="card-text text-white">This is customer {{$name}}</p>

                            <div class="col-md-10 offset-1">
                                <button type="button" class="btn btn-outline-info mb-3" onclick="createReport();" >Generate PDF Report</button>
                                <div class="chart-container">
                                    <div id="chart1" style="width: 100%; height: 400px;"></div>
                                </div>
                            </div>

                        </div>
                    </div>

                @elseif($number === 4)

                    <div class="card card-inverse card-square border-bottom-yellow border-right-yellow" style="border-top: none; border-left: none; background-color: transparent;">
                        <div class="card-block">
                            <h4 class="card-title yellow">{{$name}}</h4>
                            <p class="card-text text-white">This is customer {{$name}}</p>

                            <div class="col-md-10 offset-1">
                                <button type="button" class="btn btn-outline-info mb-3" onclick="createReport();" >Generate PDF Report</button>
                                <div class="chart-container">
                                    <div id="chart1" style="width: 100%; height: 400px;"></div>
                                </div>
                            </div>

                        </div>
                    </div>

                @else

                    <div class="card card-inverse card-square border-bottom-blue border-right-blue" style="border-top: none; border-left: none; background-color: transparent;">
                        <div class="card-block">
                            <h4 class="card-title blue">{{$name}}</h4>
                            <p class="card-text text-white">This is customer {{$name}}</p>

                            <div class="col-md-10 offset-1">
                                <button type="button" class="btn btn-outline-info mb-3" onclick="createReport();" >Generate PDF Report</button>
                                <div class="chart-container">
                                    <div id="chart1" style="width: 100%; height: 400px;"></div>
                                </div>
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

        @include('partials.custom_tabs.custom_tabs');

    </div>

@endsection


@push('account_scripts')


<script>
    /**
     * Created by amac on 6/24/17.
     */

    $( document ).ready(function() {


        $.ajax({
            type: "GET",
            url: '/getRandomNumber',
            success: function (number) {

                let bgcolor;
                let bordercolor;

                switch(number){
                    case '1' :
                        bgcolor = 'rgba(230, 71, 89, .2)';
                        bordercolor = 'rgba(230, 71, 89, 1)';
                        break;

                    case '2' :
                        bgcolor = 'rgba(27, 201, 142, .2)';
                        bordercolor = 'rgba(27, 201, 142, 1)';
                        break;

                    case '3' :
                        bgcolor = 'rgba(159, 134, 255, .2)';
                        bordercolor = 'rgba(159, 134, 255, 1)';
                        break;

                    case '4' :
                        bgcolor = 'rgba(228, 216, 54, .2)';
                        bordercolor = 'rgba(228, 216, 54, 1)';
                        break;

                    case '5' :
                        bgcolor = 'rgba(28, 168, 221, .2)';
                        bordercolor = 'rgba(28, 168, 221, 1)';
                        break;
                }
            }
        });



        $.ajax({
            type: "GET",
            url: '/api/callVolumeOverTime',
            dataType: 'json',
            success: function (data) {

                 let chart = AmCharts.makeChart("chart1", {
                    "type": "serial",
                    "theme": "dark",
                    "pathToImages": "/assets/amcharts/images/",
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
                     "chartScrollbarSettings":{
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

            }
        });


//        chart.addListener("rendered", zoomChart);
//        if(chart.zoomChart){
//            chart.zoomChart();
//        }
//
//        function zoomChart(){
//            chart.zoomToIndexes(Math.round(chart.dataProvider.length * 0.4), Math.round(chart.dataProvider.length * 0.55));
//        }


    });

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

    function generateLayout(header, footer, topbar, bottombar, charts, chartobject, callback){


        let layout = {
            pageMargins: [ 40, 100, 40, 40 ],

            /*
             ** Header; Shown on every page
             */
            header: function( currentPage, totalPage ) {
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
                    style: ["header","safetyDistance"],
                    alignment: "center"
                }, {
                    text: "Generation Detail: by IDSolutions",
                    style: "safetyDistance",
                    alignment: "center"
                }, {
                    columnGap: 40,
                    columns: [ {
                        stack: [ {
                            text: "Call Volume Over Time",
                            style: "subheader"
                        }, {
                            image: "chart1",
                            fit: [ ( 595.28 / 2 ) - 60, ( 595.28 / 2 ) - 60 ] // 1 column width incl. margins
                        } ]
                    }, {
                        stack: [ {
                            text: "Device Count by Type",
                            style: "subheader"
                        },{
                            image: "chart2",
                            fit: [ ( 595.28 / 2 ) - 60, ( 595.28 / 2 ) - 60 ] // 1 column width incl. margins
                        } ]
                    } ],
                    style: "safetyDistance"
                },{
                    columnGap: 40,
                    columns: [ {
                        stack: [ {
                            text: "Count of Online/Offline Device",
                            style: "subheader"
                        },{
                            image: "chart3",
                            fit: [ ( 595.28 / 2 ) - 60, ( 595.28 / 2 ) - 60 ] // 1 column width incl. margins
                        } ]
                    }, {
                        stack: [ {
                            text: "Count of Online/Offline Device",
                            style: "subheader"
                        }, {
                            image: "chart4",
                            fit: [ ( 595.28 / 2 ) - 60, ( 595.28 / 2 ) - 60 ] // 1 column width incl. margins
                        } ]
                    } ],
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
            footer: function( currentPage, totalPage ) {
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
                    margin: [ 0, 5, 0, 10 ]
                },
                safetyDistance: {
                    margin: [ 0, 0, 0, 20 ]
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

    let charts = [];

    let header = "/img/global_presence_heading.png";
    let topbar = "/img/global_presence_top_bar.png";
    let bottombar = "/img/global_presence_bottom_bar.png";
    let footer = "/img/customer_care_heading.png";

    let layout_1;

    getDataUri(header, function(dataurl) {
        header = dataurl;
        getDataUri(topbar, function(dataurl){
            topbar = dataurl;
            getDataUri(bottombar, function(dataurl){
                bottombar = dataurl;
                getDataUri(footer, function(dataurl){
                    footer = dataurl;

                })
            })
        })
    });

    
    function createReport() {


        let pdf_images = 0;
        let pdf_layout = layout_1; // loaded from another JS file


//        let chartids = ['devicebytype', 'chart1'];

        let chartids = ['chart1', 'devicebytype', 'deviceupstatus', 'deviceupstatuspercentall'];

        let charts = {};

        let charts_remaining = chartids.length;

        console.log(AmCharts.charts);

        for (let i = 0; i < chartids.length; i++){

            for (let x = 0; x < AmCharts.charts.length; x++){

                if (AmCharts.charts[x].div.id === chartids[i]){
                    charts[chartids[i]] = AmCharts.charts[x];
                }

            }

        }
        let charters = [];

        for (let x in charts){

            if(charts.hasOwnProperty(x)){

                let chart = charts[x];

                chart["export"].capture({}, function(){
                    this.toPNG({}, function(data){

                        this.setup.chart.exportedImage = data;

                        charters.push(data);

                        console.log(charters);

                        charts_remaining--;


                        if(charts_remaining === 0){

                            console.log(charters);

                            generateLayout(header, footer, topbar, bottombar, charters, this, generatePdf);

                        }

                    })

                })

            }

        }

    }


    function generatePdf(chartobject, layout){

        console.log(layout);

        chartobject.toPDF( layout, function( data ) {
            chartobject.download( data, this.defaults.formats.PDF.mimeType, "amcharts.pdf" );
        } );

    }



</script>

@endpush