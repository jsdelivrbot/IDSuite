<div class="tab-pane card-block active-outline-card-block-color-{{$tab_count}}" id="card-block-tab-{{$tab_count}}" role="tabpanel">
    @if(session('trans_count') === 0)

        <h4 class="card-title text-white">Hrm...</h4>

        <p class="card-text text-white">We currently do not have any transaction data associated with this account.</p>
        <a id="account-card-block-a" href="#" class="btn btn-nav-color-{{$tab_count}} ">Add one.</a>

    @else

        <h4 class="card-title color-{{$tab_count}}">Transactions</h4>

        <div class="mt-4">
            @include('measure.partials.datatables.recordtable')
        </div>
    @endif

</div>