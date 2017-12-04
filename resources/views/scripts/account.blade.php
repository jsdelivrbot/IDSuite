<link href="{{asset('assets/js/amcharts/plugins/export/export.css')}}" rel="stylesheet" media="all">



<script src="https://cdn.rawgit.com/kimmobrunfeldt/progressbar.js/0.5.6/dist/progressbar.js"></script>
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js"></script>--}}
<script src="{{asset('assets/js/amcharts/amcharts.js')}}"></script>
<script src="{{asset('assets/js/amcharts/serial.js')}}"></script>
<script src="{{asset('assets/js/amcharts/pie.js')}}"></script>
<script src="{{asset('assets/js/amcharts/plugins/export/export.js')}}"></script>
<script src="{{asset('assets/js/amcharts/plugins/dataloader/dataloader.js')}}"></script>
<script src="{{asset('assets/js/amcharts/themes/dark.js')}}"></script>
<script src="{{asset('assets/js/jquery.validate.js')}}"></script>
<script src="{{asset('assets/js/additional-methods.js')}}"></script>
<script src="https://cdn.amcharts.com/lib/3/plugins/export/export.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>

<style>
    .dataTables_wrapper .dataTables_processing{
        color: black !important;
    }
</style>



@stack('account_scripts')
@stack('custom_tabs')
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
