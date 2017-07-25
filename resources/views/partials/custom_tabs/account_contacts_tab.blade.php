<div class="tab-pane card-block active-outline-card-block-color-{{$tab_count}}" id="card-block-tab-{{$tab_count}}" role="tabpanel">
    @if(count($persons) === 0)

        <h4 class="card-title text-white">Hrm...</h4>

        <p class="card-text text-white">We currently do not have any contacts associated with this account.</p>
        <a id="account-card-block-a" href="#" class="btn btn-nav-blue ">Add one.</a>

    @endif

    @foreach($persons as $p)

        // TODO add logic

    @endforeach
</div>