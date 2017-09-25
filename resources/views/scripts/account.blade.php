<link href="{{asset('assets/amcharts/plugins/export/export.css')}}" rel="stylesheet" media="all">
<link href="https://cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css" rel="stylesheet"/>


<script src="https://cdn.rawgit.com/kimmobrunfeldt/progressbar.js/0.5.6/dist/progressbar.js"></script>
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js"></script>--}}
<script src="{{asset('assets/amcharts/amcharts.js')}}"></script>
<script src="{{asset('assets/amcharts/serial.js')}}"></script>
<script src="{{asset('assets/amcharts/pie.js')}}"></script>
<script src="{{asset('assets/amcharts/plugins/export/export.js')}}"></script>
<script src="{{asset('assets/amcharts/plugins/dataloader/dataloader.js')}}"></script>
<script src="{{asset('assets/amcharts/themes/dark.js')}}"></script>
<script src="https://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script src="{{asset('assets/js/jquery.validate.js')}}"></script>
<script src="{{asset('assets/js/additional-methods.js')}}"></script>
<script src="https://www.amcharts.com/lib/3/plugins/export/examples/export.config.default.js"></script>


@stack('custom_tabs')
@stack('account_scripts')
@stack('transaction_data_table')
@stack('account_devicebytype_chart')
@stack('account_deviceupstatus_chart')
@stack('account_deviceupstatuspercent_chart')
@stack('account_totalcallminutes_chart')
@stack('account_averagecallduration_chart')
@stack('account_casesopened_chart')
@stack('account_protocolbreakout_chart')
@stack('account_cases_chart')
@stack('account_ping_line_chart')
@stack('account_contacts')
