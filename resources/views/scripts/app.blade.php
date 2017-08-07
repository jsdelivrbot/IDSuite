@include('scripts.static_scripts')

@if($viewname === 'account')
    @include('scripts.account')
@elseif($viewname === 'device')
    @include('scripts.device')
@elseif($viewname === 'Transactions' || $viewname === 'DataTables')
    @include('scripts.transaction')
@elseif($viewname === 'case')
    @include('scripts.ticket')
@elseif($viewname === 'webrtc')
    @include('scripts.webrtc')
@endif

