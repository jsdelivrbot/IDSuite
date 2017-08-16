
@if(strpos(request()->getQueryString(), 'page' ) !== false)
    <div class="tab-pane card-block active-outline-card-block-color-{{$tab_count}}" id="card-block-tab-{{$tab_count}}" role="tabpanel">
@else
    <div class="tab-pane card-block active active-outline-card-block-color-{{$tab_count}}" id="card-block-tab-{{$tab_count}}" role="tabpanel">
@endif
    <div class="card-deck">
        <div class="card" style="box-shadow: 0 10px 40px 0 rgba(0, 0, 0, 0.6), 0 2px 10px 0 rgba(0, 0, 0, 0.12); border-color: rgba(255, 255, 255, 0.2); background-color: transparent !important; border-width: 3px">
            <div class="card-img-top">
                @include('partials.charts.account_devicebytype_pie_chart')
            </div>
        </div>
        <div class="card" style="box-shadow: 0 10px 40px 0 rgba(0, 0, 0, 0.6), 0 2px 10px 0 rgba(0, 0, 0, 0.12); border-color: rgba(255, 255, 255, 0.2);background-color: transparent !important; border-width: 3px">
            <div class="card-img-top">
                @include('partials.charts.account_deviceupstatus_bar_chart')
            </div>
        </div>
    <div class="card" style="box-shadow: 0 10px 40px 0 rgba(0, 0, 0, 0.6), 0 2px 10px 0 rgba(0, 0, 0, 0.12); border-color: rgba(255, 255, 255, 0.2);background-color: transparent !important; border-width: 3px">
            <div class="card-img-top">
                {{--@include('partials.charts.account_deviceupstatuspercent_doughnut_chart')--}}
            </div>
        </div>
    </div>
</div>
