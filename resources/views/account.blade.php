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
                                <input type="button" value="Export charts to PDF" onclick="createReport();" />
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
                                <input type="button" value="Export charts to PDF" onclick="createReport();" />
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
                                <input type="button" value="Export charts to PDF" onclick="createReport();" />
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
                                <input type="button" value="Export charts to PDF" onclick="createReport();" />
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
                                <input type="button" value="Export charts to PDF" onclick="createReport();" />
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
            {{--<hr class="mt-5" style="border-color: rgba(255, 255, 255, 0.2);">--}}
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

        let chart = AmCharts.makeChart("chart1", {
            "type": "serial",
            "theme": "dark",
            "pathToImages": "/assets/amcharts/images/",
            "marginTop":0,
            "color": "#000",
            "font" : 18,
            "marginRight": 80,
            "dataProvider": [{
                "year": "1950",
                "value": -0.307
            }, {
                "year": "1951",
                "value": -0.168
            }, {
                "year": "1952",
                "value": -0.073
            }, {
                "year": "1953",
                "value": -0.027
            }, {
                "year": "1954",
                "value": -0.251
            }, {
                "year": "1955",
                "value": -0.281
            }, {
                "year": "1956",
                "value": -0.348
            }, {
                "year": "1957",
                "value": -0.074
            }, {
                "year": "1958",
                "value": -0.011
            }, {
                "year": "1959",
                "value": -0.074
            }, {
                "year": "1960",
                "value": -0.124
            }, {
                "year": "1961",
                "value": -0.024
            }, {
                "year": "1962",
                "value": -0.022
            }, {
                "year": "1963",
                "value": 0
            }, {
                "year": "1964",
                "value": -0.296
            }, {
                "year": "1965",
                "value": -0.217
            }, {
                "year": "1966",
                "value": -0.147
            }, {
                "year": "1967",
                "value": -0.15
            }, {
                "year": "1968",
                "value": -0.16
            }, {
                "year": "1969",
                "value": -0.011
            }, {
                "year": "1970",
                "value": -0.068
            }, {
                "year": "1971",
                "value": -0.19
            }, {
                "year": "1972",
                "value": -0.056
            }, {
                "year": "1973",
                "value": 0.077
            }, {
                "year": "1974",
                "value": -0.213
            }, {
                "year": "1975",
                "value": -0.17
            }, {
                "year": "1976",
                "value": -0.254
            }, {
                "year": "1977",
                "value": 0.019
            }, {
                "year": "1978",
                "value": -0.063
            }, {
                "year": "1979",
                "value": 0.05
            }, {
                "year": "1980",
                "value": 0.077
            }, {
                "year": "1981",
                "value": 0.12
            }, {
                "year": "1982",
                "value": 0.011
            }, {
                "year": "1983",
                "value": 0.177
            }, {
                "year": "1984",
                "value": -0.021
            }, {
                "year": "1985",
                "value": -0.037
            }, {
                "year": "1986",
                "value": 0.03
            }, {
                "year": "1987",
                "value": 0.179
            }, {
                "year": "1988",
                "value": 0.18
            }, {
                "year": "1989",
                "value": 0.104
            }, {
                "year": "1990",
                "value": 0.255
            }, {
                "year": "1991",
                "value": 0.21
            }, {
                "year": "1992",
                "value": 0.065
            }, {
                "year": "1993",
                "value": 0.11
            }, {
                "year": "1994",
                "value": 0.172
            }, {
                "year": "1995",
                "value": 0.269
            }, {
                "year": "1996",
                "value": 0.141
            }, {
                "year": "1997",
                "value": 0.353
            }, {
                "year": "1998",
                "value": 0.548
            }, {
                "year": "1999",
                "value": 0.298
            }, {
                "year": "2000",
                "value": 0.267
            }, {
                "year": "2001",
                "value": 0.411
            }, {
                "year": "2002",
                "value": 0.462
            }, {
                "year": "2003",
                "value": 0.47
            }, {
                "year": "2004",
                "value": 0.445
            }, {
                "year": "2005",
                "value": 0.47
            }],
            "valueAxes": [{
                "axisAlpha": 0,
                "position": "left"
            }],
            "graphs": [{
                "id":"g1",
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
                "graph":"g1",
                "gridAlpha":0,
                "color":"#888888",
                "scrollbarHeight":55,
                "backgroundAlpha":0,
                "selectedBackgroundAlpha":0.1,
                "selectedBackgroundColor":"#888888",
                "graphFillAlpha":0,
                "autoGridCount":true,
                "selectedGraphFillAlpha":0,
                "graphLineAlpha":0.2,
                "graphLineColor":"#c2c2c2",
                "selectedGraphLineColor":"#888888",
                "selectedGraphLineAlpha":1

            },
            "chartCursor": {
                "categoryBalloonDateFormat": "YYYY",
                "cursorAlpha": 0,
                "valueLineEnabled":true,
                "valueLineBalloonEnabled":true,
                "valueLineAlpha":0.5,
                "fullWidth":true
            },
            "dataDateFormat": "YYYY",
            "categoryField": "year",
            "categoryAxis": {
                "minPeriod": "YYYY",
                "parseDates": true,
                "minorGridAlpha": 0.1,
                "minorGridEnabled": true
            },
            "export": {
                "enabled": true,
                "menu": []
            }
        });


        chart.addListener("rendered", zoomChart);
        if(chart.zoomChart){
            chart.zoomChart();
        }

        function zoomChart(){
            chart.zoomToIndexes(Math.round(chart.dataProvider.length * 0.4), Math.round(chart.dataProvider.length * 0.55));
        }

        charts.push(chart);

        console.log(charts);

    });

    let charts = [];

    let url = "/img/ids_logo.png";

    let logo;

    function getDataUri(url, callback) {
        let image = new Image();

        image.onload = function () {
            let canvas = document.createElement('canvas');
            canvas.width = this.naturalWidth; // or 'width' if you want a special/scaled size
            canvas.height = this.naturalHeight; // or 'height' if you want a special/scaled size

            canvas.getContext('2d').drawImage(this, 0, 0);

            // Get raw image data
//            callback(canvas.toDataURL('image/png').replace(/^data:image\/(png|jpg);base64,/, ''));

            // ... or get as Data URI
            callback(canvas.toDataURL('image/png'));
        };

        image.src = url;
    }

    let header_img;

    let layout_1;

    getDataUri(url, function(dataurl){

        header_img = dataurl;


         layout_1 = {
            pageMargins: [ 40, 100, 40, 40 ],

             background: function(currentPage) {
                 
             },


            /*
             ** Header; Shown on every page
             */
            header: function( currentPage, totalPage ) {
                return {
                    image: "logo",
                    fit: [ 900, 70 ],
                    margin: 20
                }
            },

            content: [

                /*
                 ** PAGE 1
                 */
                {
                    text: "This is our basic IDS header",
                    style: ["header","safetyDistance"]
                }, {
                    text: "This is just a paragraph to see if your actually reading it.",
                    style: "safetyDistance"
                }, {
                    columnGap: 40,
                    columns: [ {
                        stack: [ {
                            text: "Chart placeholder",
                            style: "subheader"
                        }, {
                            text: "This is the graph from the top of the account pag",
                            style: "description"
                        }, {
                            image: "image_1",
                            fit: [ ( 595.28 / 2 ) - 60, ( 595.28 / 2 ) - 60 ] // 1 column width incl. margins
                        } ]
                    }, {
                        stack: [ {
                            text: "Repeat Chart",
                            style: "subheader"
                        }, {
                            text: "This is the same darn thing",
                            style: "description"
                        }, {
                            image: "image_1",
                            fit: [ ( 595.28 / 2 ) - 60, ( 595.28 / 2 ) - 60 ] // 1 column width incl. margins
                        } ]
                    } ],
                    style: "safetyDistance"
                }, {
                    text: "Amac Owns....Amac Owns....Amac Owns....Amac Owns....Amac Owns....Amac Owns....Amac Owns....Amac Owns....Amac Owns....Amac Owns....Amac Owns....Amac Owns....Amac Owns....Amac Owns....Amac Owns....Amac Owns....Amac Owns....Amac Owns....Amac Owns....Amac Owns....Amac Owns....Amac Owns....Amac Owns....Amac Owns....",
                    pageBreak: "after"
                },


                /*
                 ** Page 2; Forced through "pageBreak"
                 */
                {
                    text: "This is a header, using header style",
                    style: ["header","safetyDistance"]
                }, {
                    columnGap: 40,
                    columns: [ {
                        stack: [ {
                            text: "Amac Owns Even More....Amac Owns Even More....Amac Owns Even More....Amac Owns Even More....Amac Owns Even More....Amac Owns Even More....Amac Owns Even More....Amac Owns Even More....Amac Owns Even More....Amac Owns Even More....Amac Owns Even More....Amac Owns Even More....Amac Owns Even More....Amac Owns Even More....Amac Owns Even More....Amac Owns Even More....Amac Owns Even More....Amac Owns Even More....Amac Owns Even More....Amac Owns Even More....Amac Owns Even More....Amac Owns Even More....",
                            style: "safetyDistance"
                        }, {
                            image: "image_1",
                            fit: [ ( 595.28 / 2 ) - 60, ( 595.28 / 2 ) - 60 ] // 1 column width incl. margins
                        } ]
                    }, {
                        stack: [ {
                            image: "image_1",
                            fit: [ ( 595.28 / 2 ) - 60, ( 595.28 / 2 ) - 60 ], // 1 column width incl. margins
                            style: "safetyDistance"
                        }]
                    } ]
                }
            ],

            /*
             ** Footer; Shown on every page
             */
            footer: function( currentPage, totalPage ) {
                return {
                    text: [ currentPage, "/", totalPage ].join( "" ),
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
                logo: header_img
            }
        };

    });


    function createReport() {
        let pdf_images = 0;
        let pdf_layout = layout_1; // loaded from another JS file

        console.log(charts);

        for ( index in charts ) {


            let chartobject = charts[index];

            console.log(chartobject);

            // Capture current state of the chart
            chartobject.AmExport.capture( {}, function() {

                // Export to PNG
                this.toPNG( {
                    multiplier: 2 // pretend to be lossless

                    // Add image to the layout reference
                }, function( data ) {
                    pdf_images++;
                    pdf_layout.images[ "image_" + pdf_images ] = data;

                    // Once all has been processed create the PDF
                    if ( pdf_images === AmCharts.charts.length ) {

                        // Save as single PDF and offer as download
                        this.toPDF( pdf_layout, function( data ) {
                            this.download( data, this.defaults.formats.PDF.mimeType, "amcharts.pdf" );
                        } );
                    }
                } );



            } );
        }
    }

</script>

@endpush