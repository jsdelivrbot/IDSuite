<div class="card card-square mb-lg-5" style="background-color: transparent; border: none;">
    <ul id="account-card-header" class="nav nav-tabs active-outline-card-header-color-1" role="tablist">

        @if($viewname === 'account')

            @include('partials.custom_tabs.account_tab_headers')

        @elseif($viewname === 'device')

            @include('partials.custom_tabs.device_tab_headers')

        @elseif($viewname === 'case')

            @include('partials.custom_tabs.device_tab_headers')

        @endif

    </ul>

    <!-- Tab panes -->
    <div class="tab-content">

        @php
            $tab_count = 1;
        @endphp

        @if($viewname === 'account')

            @include('partials.custom_tabs.account_insights_tab')
            @php
                $tab_count++;
            @endphp
            @include('partials.custom_tabs.account_locations_tab')
            @php
                $tab_count++;
            @endphp
            @include('partials.custom_tabs.account_contacts_tab')
            @php
                $tab_count++;
            @endphp
            @include('partials.custom_tabs.account_notes_tab')
            @php
                $tab_count++;
            @endphp
            @include('partials.custom_tabs.account_cases_tab')
            @php
                $tab_count++;
            @endphp

        @elseif($viewname === 'device')

            @include('partials.custom_tabs.device_insights_tab')
            @php
                $tab_count++;
            @endphp
            @include('partials.custom_tabs.device_locations_tab')
            @php
                $tab_count++;
            @endphp
            @include('partials.custom_tabs.device_contacts_tab')
            @php
                $tab_count++;
            @endphp
            @include('partials.custom_tabs.device_notes_tab')

        @elseif($viewname === 'case')

            @include('partials.custom_tabs.device_insights_tab')
            @php
                $tab_count++;
            @endphp
            @include('partials.custom_tabs.device_locations_tab')
            @php
                $tab_count++;
            @endphp
            @include('partials.custom_tabs.device_contacts_tab')
            @php
                $tab_count++;
            @endphp
            @include('partials.custom_tabs.device_notes_tab')

        @endif




    </div>
</div>



@push('custom_tabs')

<script>
/**
* Created by amac on 6/24/17.
*/

let tabcount = {{$tab_count}}


$(function() {

    customTabs(tabcount);

    function customTabs(tabcount) {

        console.log("customTabs fired!!");
        console.log('tabcount : ' + tabcount);

        for (let itemcount = 1; itemcount <= tabcount; itemcount++) {

            $('#tab-a-' + itemcount).click(function () {

                let cardHeader = $('#account-card-header');

                for (let count = 1; count <= tabcount; count++) {
                    if (count !== itemcount) {
                        $('#tab-a-' + count).addClass('color-' + count)
                            .removeClass('active text-white active-outline-tab-color-' + count);
                    } else {
                        $('#tab-a-' + count).addClass('active text-white active-outline-tab-color-' + count);
                    }

                    if (count !== itemcount) {
                        if (cardHeader.hasClass('active-outline-card-header-color-' + count)) {
                            cardHeader.removeClass('active-outline-card-header-color-' + count)
                        }
                    } else {
                        cardHeader.addClass('active-outline-card-header-color-' + count)
                    }


                    if (count !== itemcount) {

                        console.log("$('#card-block-tab-" + count + "').hasClass('active') : " +  $('#active-outline-card-block-' + count).hasClass('active'));

                        if ($('#card-block-tab-' + count).hasClass('active')) {
                            $('#card-block-tab-' + count).removeClass('active');
                        }
                    } else {
                        $('#card-block-tab-' + count).addClass('active')
                    }

                    if (count !== itemcount) {
                        $('#account-card-block-a').removeClass('btn-nav-color-' + count);
                    } else {
                        $('#account-card-block-a').addClass('btn-nav-color-' + count);
                    }

                }

                bar_one.set(0);

                bar_two.set(0);

                let color = $('#tab-a-' + itemcount).css("color");

                console.log("$('tab-a-"+ itemcount +"').css('color')");


                console.log(color);

                console.log('itemcount : ' + itemcount );

                bar_one.animate(1.0, {to: {color: color}});  // Number from 0.0 to 1.0
                bar_two.animate(-1.0, {to: {color: color}});  // Number from 0.0 to 1.0
            });
        }
    };
});

let bar_one = new ProgressBar.Line(container_one, {
strokeWidth: 1,
easing: 'easeInOut',
duration: 1400,
color: '#fff',
trailColor: 'transparent',
trailWidth: 1,
svgStyle: { width: '100%', height: '100%' },
from: { color: '#fff' },
to: { color: '#E64759' },
step: function step(state, bar) {
bar.path.setAttribute('stroke', state.color);
}
});

let bar_two = new ProgressBar.Line(container_two, {
strokeWidth: 1,
easing: 'easeInOut',
duration: 1400,
color: '#fff',
trailColor: 'transparent',
trailWidth: 1,
svgStyle: { width: '100%', height: '100%' },
from: { color: '#fff' },
to: { color: '#E64759' },
step: function step(state, bar) {
bar.path.setAttribute('stroke', state.color);
}
});

bar_one.animate(1.0); // Number from 0.0 to 1.0
bar_two.animate(-1.0); // Number from 0.0 to 1.0

</script>

@endpush