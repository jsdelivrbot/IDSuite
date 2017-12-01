{{--Must have tabs in the same order that you have panes in account_<tabnames>_tab--}}


@if(strpos(request()->getQueryString(), 'page' ) !== false)

    <li id="li-tab-1" class="nav-item">
        <a id="tab-a-1" class="nav-link color-1" data-toggle="tab" href="#card-block-tab-1" role="tab">Insights</a>
    </li>
    <li id="li-tab-2" class="nav-item">
        <a id="tab-a-2" class="nav-link color-2" data-toggle="tab" href="#card-block-tab-2" role="tab">Location(s)</a>
    </li>
    <li id="li-tab-3" class="nav-item">
        <a id="tab-a-3" class="nav-link color-3" data-toggle="tab" href="#card-block-tab-3" role="tab">Contacts</a>
    </li>
    <li id="li-tab-4" class="nav-item">
        <a id="tab-a-4" class="nav-link text-white active-outline-tab-color-4" data-toggle="tab" href="#card-block-tab-4" role="tab">Cases</a>
    </li>
    <li id="li-tab-5" class="nav-item">
        <a id="tab-a-5" class="nav-link color-5" data-toggle="tab" href="#card-block-tab-5" role="tab">Transactions</a>
    </li>
    <li id="li-tab-6" class="nav-item">
        <a id="tab-a-6" class="nav-link color-6" data-toggle="tab" href="#card-block-tab-6" role="tab">Notes</a>
    </li>
    <li id="li-tab-7" class="nav-item">
        <a id="tab-a-7" class="nav-link color-7" data-toggle="tab" href="#card-block-tab-7" role="tab">Account Manager(s)</a>
    </li>

@else


    <li id="li-tab-1" class="nav-item">
        <a id="tab-a-1" class="nav-link text-white active-outline-tab-color-1" data-toggle="tab" href="#card-block-tab-1" role="tab">Insights</a>
    </li>
    <li id="li-tab-2" class="nav-item">
        <a id="tab-a-2" class="nav-link color-2" data-toggle="tab" href="#card-block-tab-2" role="tab">Location(s)</a>
    </li>
    <li id="li-tab-3" class="nav-item">
        <a id="tab-a-3" class="nav-link color-3" data-toggle="tab" href="#card-block-tab-3" role="tab">Contacts</a>
    </li>
    <li id="li-tab-4" class="nav-item">
        <a id="tab-a-4" class="nav-link color-4" data-toggle="tab" href="#card-block-tab-4" role="tab">Cases</a>
    </li>
    <li id="li-tab-5" class="nav-item">
        <a id="tab-a-5" class="nav-link color-5" data-toggle="tab" href="#card-block-tab-5" role="tab">Transactions</a>
    </li>
    <li id="li-tab-6" class="nav-item">
        <a id="tab-a-6" class="nav-link color-6" data-toggle="tab" href="#card-block-tab-6" role="tab">Notes</a>
    </li>
    <li id="li-tab-7" class="nav-item">
        <a id="tab-a-7" class="nav-link color-7" data-toggle="tab" href="#card-block-tab-7" role="tab">Account Manager(s)</a>
    </li>
@endif