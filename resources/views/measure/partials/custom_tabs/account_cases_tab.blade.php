<div class="tab-pane card-block active-outline-card-block-color-{{$tab_count}} ticket-tab" id="card-block-tab-{{$tab_count}}" role="tabpanel">

    <h4 class="card-title color-{{$tab_count}}">Cases<span id="ticket-count" class="float-right">Qty: </span></h4>


</div>

@push('account_scripts')

    <script>

        function getTickets(entity_id, el) {

            let options = JSON.stringify({
                id: entity_id
            });

            return axios.get('/api/measure/tickets/' + options)
                .then(function (data) {

                    if (!validate(data.data)) {
                        return false;
                    }

                    $('#ticket-count').text(data.data.length);

                    let rowkey;

                    let tickets = data.data;

                    if (tickets.length > 0) {

                        $.each(tickets, function (key, value) {

                            if (key % 3 === 0 || key === tickets.length) {
                                rowkey = key;

                                el.append('<div class="row" id="row-' + key + '">');

                                $('#row-' + key).prepend(
                                    '<div class="col-lg-4 p-lg-3">' +
                                        '<div class="card mb-3 text-center" style="background-color: #1BC98E;color: #252830 !important; border: 6px solid rgba(255, 255, 255, 0.2);">' +
                                            '<div class="card-block">' +
                                                '<h4 class="card-title text-truncate"></h4>' +
                                                '<div class="row mt-3">' +
                                                    '<div class="col-lg-12">' +
                                                        '<p class="card-text text-capitalize font-weight-bold">' + value.subject + '</p>' +
                                                    '</div>' +
                                                '</div>' +
                                                '<div class="row mt-2">' +
                                                    '<div class="col-lg-12">' +
                                                        '<p class="card-text">' + value.duration + ' Day(s)</p>' +
                                                    '</div>' +
                                                '</div>' +
                                                '<div class="row mt-2">' +
                                                    '<div class="col-lg-12">' +
                                                        '<p class="card-text">' + value.status_type + '</p>' +
                                                    '</div>' +
                                                '</div>' +
                                                '<div class="row mt-2">' +
                                                    '<div class="col-lg-12">' +
                                                        '<a href="/tickets/' + value.id + '" class="btn btn-outline-secondary" style="color: white !important; border-color: white !important;">View Case</a>' +
                                                    '</div>' +
                                                '</div>' +
                                            '</div>' +
                                        '</div>' +
                                    '</div>'
                                );
                            } else {
                                $('#row-' + rowkey).append(
                                    '<div class="col-lg-4 p-lg-3">' +
                                    '<div class="card mb-3 text-center" style="background-color: #1BC98E;color: #252830 !important; border: 6px solid rgba(255, 255, 255, 0.2);">' +
                                    '<div class="card-block">' +
                                    '<h4 class="card-title text-truncate"></h4>' +
                                    '<div class="row mt-3">' +
                                    '<div class="col-lg-12">' +
                                    '<p class="card-text text-capitalize font-weight-bold">' + value.subject + '</p>' +
                                    '</div>' +
                                    '</div>' +
                                    '<div class="row mt-2">' +
                                    '<div class="col-lg-12">' +
                                    '<p class="card-text">' + value.duration + ' Day(s)</p>' +
                                    '</div>' +
                                    '</div>' +
                                    '<div class="row mt-2">' +
                                    '<div class="col-lg-12">' +
                                    '<p class="card-text">' + value.status_type + '</p>' +
                                    '</div>' +
                                    '</div>' +
                                    '<div class="row mt-2">' +
                                    '<div class="col-lg-12">' +
                                    '<a href="/tickets/' + value.id + '" class="btn btn-outline-secondary" style="color: white !important; border-color: white !important;">View Case</a>' +
                                    '</div>' +
                                    '</div>' +
                                    '</div>' +
                                    '</div>' +
                                    '</div>'
                                );
                            }
                        });
                    } else {
                        el.append(
                            '<div id="ticket-default">' +
                            '<h4 class="card-title text-white">Hrm...</h4>' +
                            '<p class="card-text text-white">We currently do not have any tickets associated with this account.</p>' +
                            '</div>'
                        );
                    }
                });
        }

        $(document).ready(function () {

            axiosrequests.push = getTickets('{{$entity->id}}', $('.ticket-tab'))

        });


    </script>

@endpush