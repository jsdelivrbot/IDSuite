<div class="tab-pane card-block active active-outline-card-block-color-{{$tab_count}}" id="card-block-tab-{{$tab_count}}" role="tabpanel">
    <div class="row">
        <div class="col-lg-6">
            @include('partials.charts.account_devicebytype_pie_chart')
        </div>
        <div class="col-lg-6">
            @include('partials.charts.account_deviceupstatus_bar_chart')
        </div>
        <div class="col-lg-6 mt-4">
            @include('partials.charts.account_deviceupstatuspercent_doughnut_chart')
        </div>
    </div>
</div>
