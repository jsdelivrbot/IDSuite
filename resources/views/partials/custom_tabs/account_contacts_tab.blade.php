<div class="tab-pane card-block active-outline-card-block-color-{{$tab_count}}" id="card-block-tab-{{$tab_count}}" role="tabpanel">
    @if(count($persons) === 0)
        <div class="row mt-2 mb-3">
            <div class="col-lg-6">
                <h4 class="card-title text-white">Hrm...</h4>
           </div>
            <div class="col-lg-6">
                <a id="account-card-block-a" href="#" class="btn btn-nav-blue float-right">Add Contact</a>
            </div>
        </div>

        <p class="card-text text-white">We currently do not have any contacts associated with this account.</p>

    @endif

    @foreach($persons as $p)

        // TODO add logic

    @endforeach
</div>