
@if(strpos(request()->getQueryString(), 'page' ) !== false)
<div class="tab-pane card-block active-outline-card-block-color-{{$tab_count}}" id="card-block-tab-{{$tab_count}}" role="tabpanel">
@else
<div class="tab-pane card-block active active-outline-card-block-color-{{$tab_count}}" id="card-block-tab-{{$tab_count}}" role="tabpanel">
@endif
    <div class="card-deck">
        <div class="card" style="box-shadow: 0 10px 40px 0 rgba(0, 0, 0, 0.6), 0 2px 10px 0 rgba(0, 0, 0, 0.12); border-color: rgba(255, 255, 255, 0.2); background-color: transparent !important; border-width: 3px">
            <div class="card-img-top">
                @include('measure.partials.charts.account_devicebytype_pie_chart')
            </div>
        </div>
        <div class="card" style="box-shadow: 0 10px 40px 0 rgba(0, 0, 0, 0.6), 0 2px 10px 0 rgba(0, 0, 0, 0.12); border-color: rgba(255, 255, 255, 0.2);background-color: transparent !important; border-width: 3px">
            <div class="card-img-top">
                @include('measure.partials.charts.account_deviceupstatus_bar_chart')
            </div>
        </div>
    </div>
    <div class="card-deck mt-4">
        <div class="card" style="box-shadow: 0 10px 40px 0 rgba(0, 0, 0, 0.6), 0 2px 10px 0 rgba(0, 0, 0, 0.12); border-color: rgba(255, 255, 255, 0.2);background-color: transparent !important; border-width: 3px">
            <div class="card-img-top">
                @include('measure.partials.charts.account_deviceupstatuspercent_doughnut_chart')
            </div>
        </div>


        <div class="card" style="box-shadow: 0 10px 40px 0 rgba(0, 0, 0, 0.6), 0 2px 10px 0 rgba(0, 0, 0, 0.12); border-color: rgba(255, 255, 255, 0.2);background-color: transparent !important; border-width: 3px">
            <div class="card-img-top">
                @include('measure.partials.charts.account_totalminutes_bar')
            </div>
        </div>
    </div>

    <div class="card-deck mt-4">
        <div class="card" style="box-shadow: 0 10px 40px 0 rgba(0, 0, 0, 0.6), 0 2px 10px 0 rgba(0, 0, 0, 0.12); border-color: rgba(255, 255, 255, 0.2);background-color: transparent !important; border-width: 3px">
            <div class="card-img-top">
                @include('measure.partials.charts.account_averagecallduration_bar')
            </div>
        </div>


        <div class="card" style="box-shadow: 0 10px 40px 0 rgba(0, 0, 0, 0.6), 0 2px 10px 0 rgba(0, 0, 0, 0.12); border-color: rgba(255, 255, 255, 0.2);background-color: transparent !important; border-width: 3px">
            <div class="card-img-top">
                @include('measure.partials.charts.account_casestatusnotclosed_bar')
            </div>
        </div>
    </div>

    <div class="card-deck mt-4">
        <div class="card" style="box-shadow: 0 10px 40px 0 rgba(0, 0, 0, 0.6), 0 2px 10px 0 rgba(0, 0, 0, 0.12); border-color: rgba(255, 255, 255, 0.2);background-color: transparent !important; border-width: 3px">
            <div class="card-img-top">
                @include('measure.partials.charts.account_casesopened')
            </div>
        </div>


        <div class="card" style="box-shadow: 0 10px 40px 0 rgba(0, 0, 0, 0.6), 0 2px 10px 0 rgba(0, 0, 0, 0.12); border-color: rgba(255, 255, 255, 0.2);background-color: transparent !important; border-width: 3px">
            <div class="card-img-top">
                @include('measure.partials.charts.account_protocolbreakout_piebreakout')
            </div>
        </div>
    </div>
    <div class="card-deck mt-4">
        <div class="card" style="height: 200px; box-shadow: 0 10px 40px 0 rgba(0, 0, 0, 0.6), 0 2px 10px 0 rgba(0, 0, 0, 0.12); border-color: rgba(255, 255, 255, 0.2);background-color: transparent !important; border-width: 3px">
            <div class="row m-1">
                <div class="col-lg-12 mt-2 text-white">
                    <h5>Count of HMS devices</h5>
                </div>
            </div>
            <div class="row h-100">
                <div class="col-lg-12 my-auto">
                    <div class="text-center" id="hms-count-endpoints"></div>
                </div>
            </div>
        </div>

        <div class="card" style="box-shadow: 0 10px 40px 0 rgba(0, 0, 0, 0.6), 0 2px 10px 0 rgba(0, 0, 0, 0.12); border-color: rgba(255, 255, 255, 0.2);background-color: transparent !important; border-width: 3px">
            <div class="card-img-top">
                <div class="row m-1">
                    <div class="col-lg-12 mt-2 text-white">
                        <h5>Average Device Utilization Per Month</h5>
                    </div>
                </div>
                <div class="row ">
                    <div class="col-lg-12">
                        <div id="hms-avg-device-utilization" class=""></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>