<script src="https://cdn.rawgit.com/kimmobrunfeldt/progressbar.js/0.5.6/dist/progressbar.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js"></script>

@push('device_scripts')
<script src="{{ asset('assets/js/device_status.js') }}"></script>
@endpush

@stack('custom_tabs')
@stack('device_devicecostperavg_chart')
@stack('device_ping_line_chart')