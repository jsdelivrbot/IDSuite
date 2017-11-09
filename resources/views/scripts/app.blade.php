@include('scripts.static_scripts')



@if($viewname === 'account')
    @include('scripts.account')
@elseif($viewname === 'Accounts')
    @include('scripts.accounts')
@elseif($viewname === 'case')
    @include('scripts.ticket')
@elseif($viewname === 'Cases')
    @include('scripts.tickets')
@elseif($viewname === 'device')
    @include('scripts.device')
@elseif($viewname === 'Devices')
    @include('scripts.devices')
@elseif($viewname === 'Transactions' || $viewname === 'DataTables')
    @include('scripts.transaction')
@elseif($viewname === 'Trust')
    @include('scripts.trust')
@elseif($viewname === 'webrtc')
    @include('scripts.webrtc')
@endif


<script>


    axiosAll(axiosrequests);


</script>