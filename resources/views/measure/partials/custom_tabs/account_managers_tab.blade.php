<div class="tab-pane card-block active-outline-card-block-color-{{$tab_count}} manager-tab" id="card-block-tab-{{$tab_count}}" role="tabpanel">
    <div id="managers-title" class="row mt-2 mb-3">
        <div class="col-lg-6">
            <h5 class="card-title text-white">Managers</h5>
        </div>
        {{--<div class="col-lg-6">--}}
            {{--<a id="manager-modal-btn" href="#" class="btn btn-nav-color-{{$tab_count}} float-right" data-toggle="modal" data-target="#managerModal"><i class="fa fa-plus"></i> Add Manager</a>--}}
        {{--</div>--}}
    </div>

    <div id="header-managers" class="card-block text-white">
    </div>

    <!-- Modal -->
    <div class="modal" id="managerModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Manager</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="color: white;">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="manager-input">Manager</label>
                            {{--<textarea class="form-control" id="note-text" rows="4"--}}
                                      {{--placeholder="Type your note here..."></textarea>--}}
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <a id="manager-cancel" class="btn btn-nav-pink" data-dismiss="modal"
                       style="cursor: pointer !important;">Close</a>
                    <a id="manager-submit" class="btn btn-nav-purple" style="cursor: pointer !important;"><i
                                class="fa fa-plus"></i> Add Manager</a>
                </div>
            </div>
        </div>
    </div>
</div>

@push('account_scripts')

    <script>

        /**
         *
         * getEntityManagers
         *
         * gets the entity object's managers (users) and validates it
         *
         * @param entity_id
         */
        function getEntityManagers(entity_id, el) {

            let options = JSON.stringify({
                id: entity_id
            });

            return axios.get('/api/entity/managers/' + options)
                .then(function (data) {
                    let managers = data.data;

                    if(!validate(managers)){
                        return false;
                    }

                    $.each(managers, function(key, value){

                        el.append(
                            '<div class="row">' +
                            '<div class="col-lg-3">' +
                            '<span>'+value.name+' : </span>' +
                            '</div>' +
                            '<div class="col-lg-3">' +
                            '<span>'+value.email+'</span>' +
                            '</div>' +
                            '</div>'
                        )

                    });

                    console.log(managers);
                });
        }

        $(document).ready(function () {

            axiosrequests.push = getEntityManagers('{{$entity->id}}', $('#header-managers'));

        });
    </script>

@endpush