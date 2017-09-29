@include('scripts.static_scripts')

<link href="{{asset('assets/css/VidyoConnector.css')}}">

<script src="{{asset('assets/js/VidyoConnector.js')}}"></script>
{{--<script src="{{asset('assets/js/echo.ts')}}"></script>--}}

@stack('medsitter_patient')
@stack('medsitter_sitter')
@stack('medsitter_home')
@stack('medsitter_library')