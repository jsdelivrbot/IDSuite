
@if(strpos(request()->getQueryString(), 'page' ) !== false)
<div class="tab-pane card-block active-outline-card-block-color-{{$tab_count}}" id="card-block-tab-{{$tab_count}}" role="tabpanel">
    <div class="row">
        <button class="btn btn-nav-blue m-3" onclick="createReport();">Generate Report</button>
    </div>
@else
<div class="tab-pane card-block active active-outline-card-block-color-{{$tab_count}}" id="card-block-tab-{{$tab_count}}" role="tabpanel">
    <div class="row">
        <div class="col-lg-12">
            <div class="float-left">
                <span class="h3 pink">Insights</span>
            </div>
            <div class="float-right">
                <button class="btn btn-nav-blue m-3" onclick="createReport();">Generate Report</button>
            </div>
        </div>
    </div>
@endif
    <div class="card-deck">

        <div class="card card-custom">
            <div class="card-img-top">
                @include('measure.partials.charts.account_devicebytype_pie_chart')
            </div>
        </div>

        <div class="card card-custom">
            <div class="card-img-top">
                @include('measure.partials.charts.account_deviceupstatus_bar_chart')
            </div>
        </div>

        <div class="card card-custom">
            <div class="card-img-top">
                @include('measure.partials.charts.account_deviceupstatuspercent_doughnut_chart')
            </div>
        </div>

    </div>
    <div class="card-deck mt-4">

        <div class="card card-custom">
            <div class="card-img-top">
                @include('measure.partials.charts.account_totalminutes_bar')
            </div>
        </div>

        <div class="card card-custom">
            <div class="card-img-top">
                @include('measure.partials.charts.account_averagecallduration_bar')
            </div>
        </div>


        <div class="card card-custom">
            <div class="card-img-top">
                @include('measure.partials.charts.account_casestatusnotclosed_bar')
            </div>
        </div>

    </div>

    <div class="card-deck mt-4">

        <div class="card card-custom">
            <div class="card-img-top">
                @include('measure.partials.charts.account_casesopened')
            </div>
        </div>

        <div class="card card-custom">
            <div class="card-img-top">
                @include('measure.partials.charts.account_protocolbreakout_piebreakout')
            </div>
        </div>

        <div class="card card-custom">
            <div class="row m-1">
                <div class="col-lg-12 mt-2 text-white">
                    <h5>Count of HMS devices</h5>
                </div>
            </div>
            <div class="row" style="height: 200px;">
                <div class="col-lg-12 text-center my-auto text-white">
                    <img id="hms-count-endpoints-loader" src="/img/bars.svg" height="70px"/>
                    <div class="text-center" id="hms-count-endpoints" style="display: none;"></div>
                </div>
            </div>
        </div>
    </div>


    <div class="card-deck mt-4">

        <div class="card card-custom">
            <div class="row m-1">
                <div class="col-lg-12 mt-2 text-white">
                    <h5>Monthly Device Utilization</h5>
                </div>
            </div>
            <div class="row" style="height: 200px;">
                <div class="col-lg-12 text-center my-auto text-white">
                    {{--<img id="monthly-device-utilization-loader" src="/img/bars.svg" height="70px"/>--}}
                    {{--<div class="text-center" id="monthly-device-utilization" style="display: none;"></div>--}}
                    {{--<img id="monthly-device-utilization-loader" src="/img/bars.svg" height="70px"/>--}}
                    <div class="text-center text-white" id="monthly-device-utilization">
                        Data unavailable or not relevant for this account
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-custom">
            <div class="row m-1">
                <div class="col-lg-12 mt-2 text-white">
                    <h5>Cpu Usage Hourly Average</h5>
                </div>
            </div>
            <div class="row" style="height: 200px;">
                <div class="col-lg-12 text-center my-auto text-white">
                    <img id="cpu-usage-hourly-loader" src="/img/bars.svg" height="70px"/>
                    <div class="chart-custom text-white" id="cpu-usage-hourly" style="display: none;"></div>
                </div>
            </div>
        </div>

        <div class="card card-custom">
            <div class="row m-1">
                <div class="col-lg-12 mt-2 text-white">
                    <h5>Cpu Usage Daily Average</h5>
                </div>
            </div>
            <div class="row" style="height: 200px;">
                <div class="col-lg-12 text-center my-auto text-white">
                    <img id="cpu-usage-daily-loader" src="/img/bars.svg" height="70px"/>
                    <div class="chart-custom text-white" id="cpu-usage-daily" style="display: none;"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="card-deck mt-4">

        <div class="card card-custom">
            <div class="row m-1">
                <div class="col-lg-12 mt-2 text-white">
                    <h5>HD Free Capacity Hourly Average</h5>
                </div>
            </div>
            <div class="row" style="height: 200px;">
                <div class="col-lg-12 text-center my-auto text-white">
                    <img id="hd-cap-hourly-loader" src="/img/bars.svg" height="70px"/>
                    <div class="chart-custom text-white" id="hd-cap-hourly" style="display: none;"></div>
                </div>
            </div>
        </div>


        <div class="card card-custom">
            <div class="row m-1">
                <div class="col-lg-12 mt-2 text-white">
                    <h5>HD Free Capacity Daily Average</h5>
                </div>
            </div>
            <div class="row" style="height: 200px;">
                <div class="col-lg-12 text-center my-auto text-white">
                    <img id="hd-cap-daily-loader" src="/img/bars.svg" height="70px"/>
                    <div class="chart-custom text-white" id="hd-cap-daily" style="display: none;"></div>
                </div>
            </div>
        </div>


        <div class="card card-custom">
            <div class="row m-1">
                <div class="col-lg-12 mt-2 text-white">
                    <h5>RAM Utilization Hourly Average</h5>
                </div>
            </div>
            <div class="row" style="height: 200px;">
                <div class="col-lg-12 text-center my-auto text-white">
                    <img id="ram-util-hourly-loader" src="/img/bars.svg" height="70px"/>
                    <div class="chart-custom text-white" id="ram-util-hourly" style="display: none;"></div>
                </div>
            </div>
        </div>

    </div>

    <div class="card-deck mt-4">
        <div class="card card-custom">
            <div class="row m-1">
                <div class="col-lg-12 mt-2 text-white">
                    <h5>RAM Utilization Daily Average</h5>
                </div>
            </div>
            <div class="row" style="height: 200px;">
                <div class="col-lg-12 text-center my-auto text-white">
                    <img id="ram-util-daily-loader" src="/img/bars.svg" height="70px"/>
                    <div class="chart-custom text-white" id="ram-util-daily" style="display: none;"></div>
                </div>
            </div>
        </div>

        <div class="card card-custom">
            <div class="row m-1">
                <div class="col-lg-12 mt-2 text-white">
                    <h5>CPU Temp Hourly Average</h5>
                </div>
            </div>
            <div class="row" style="height: 200px;">
                <div class="col-lg-12 text-center my-auto text-white">
                    <img id="cpu-temp-hourly-loader" src="/img/bars.svg" height="70px"/>
                    <div class="chart-custom text-white" id="cpu-temp-hourly" style="display: none;"></div>
                </div>
            </div>
        </div>

        <div class="card card-custom">
            <div class="row m-1">
                <div class="col-lg-12 mt-2 text-white">
                    <h5>CPU Temp Daily Average</h5>
                </div>
            </div>
            <div class="row" style="height: 200px;">
                <div class="col-lg-12 text-center my-auto text-white">
                    <img id="cpu-temp-daily-loader" src="/img/bars.svg" height="70px"/>
                    <div class="chart-custom text-white" id="cpu-temp-daily" style="display: none;"></div>
                </div>
            </div>
        </div>
    </div>
        {{--<div class="card card-custom">--}}
            {{--<div class="row no-gutters mt-5">--}}
                {{--<div class="col-lg-4 text-center">--}}
                    {{--<i class="fa fa-3x fa-video-camera" style="color: rgb(255, 102, 0);"></i>--}}
                {{--</div>--}}
                {{--<div class="col-lg-4 text-center">--}}
                    {{--<img id="monthly-device-utilization-loader" src="/img/bars.svg" height="70px"/>--}}
                {{--</div>--}}
                {{--<div class="col-lg-4 text-center">--}}
                    {{--<img id="monthly-device-utilization-loader" src="/img/bars.svg" height="70px"/>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="row no-gutters mt-5">--}}
                {{--<div class="col-lg-4 text-center">--}}
                    {{--<i class="fa fa-3x fa-table" style="color: rgb(255, 102, 0);"></i>--}}
                {{--</div>--}}
                {{--<div class="col-lg-4 text-center">--}}
                    {{--<img id="monthly-device-utilization-loader" src="/img/bars.svg" height="70px"/>--}}
                {{--</div>--}}
                {{--<div class="col-lg-4 text-center">--}}
                    {{--<img id="monthly-device-utilization-loader" src="/img/bars.svg" height="70px"/>--}}
                {{--</div>--}}
            {{--</div>--}}

        {{--</div>--}}




</div>