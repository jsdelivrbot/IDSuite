<div class="tab-pane card-block active-outline-card-block-color-{{$tab_count}}" id="card-block-tab-{{$tab_count}}" role="tabpanel">
    <div id="notes-title" class="row mt-2 mb-3">
        <div class="col-lg-6">
            <h5 class="card-title text-white">Notes</h5>
        </div>
        <div class="col-lg-6">
            <a id="note-modal-btn" href="#" class="btn btn-nav-color-{{$tab_count}} float-right" data-toggle="modal" data-target="#noteModal"><i class="fa fa-plus"></i> Add Note</a>
        </div>
    </div>
    @if(count($notes) > 0)

        @foreach($notes as $n)


            <div class="card-text text-white">

                <div>
                    {{$n->text}}
                </div>

                <small>created - {{$n->created}}</small>
            </div>


            @if(!$loop->last)
                <hr id="note-last-hr" class="mb-4" style="border-color: #9F86FF">
            @endif

        @endforeach

    @else

        <div id="note-default">
            <h4 class="card-title text-white">Hrm...</h4>
            <p class="card-text text-white">We currently do not have any notes associated with this account.</p>
        </div>

    @endif



    <!-- Modal -->
    <div class="modal" id="noteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Note</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="color: white;">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="note-text">Text</label>
                            <textarea class="form-control" id="note-text" rows="4" placeholder="Type your note here..."></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <a id="note-cancel" class="btn btn-nav-pink" data-dismiss="modal" style="cursor: pointer !important;">Close</a>
                    <a id="note-submit" class="btn btn-nav-purple" style="cursor: pointer !important;"><i class="fa fa-plus"></i> Add Note</a>
                </div>
            </div>
        </div>
    </div>
</div>

@push('account_scripts')

<script>

    $('#note-modal-btn').click(function(){

        $('#note-text').val('');

    });

    $('#note-submit').click(function(){

        let text = $('#note-text').val();

        $.ajax({
            type: "POST",
            url: '/notes',
            data: {
                text: text
            },
            success: function (data) {
                // add note dynamically to note list //

                $('#noteModal').modal('hide');

                console.log($('#note-default').length);

                if($('#note-default').length === 1){
                    $('#note-default').hide();
                    $('#note-last-hr').hide();
                    $('#notes-title').after('<div class="card-text text-white"><div>' + data.text + '</div><small>created - '+ data.created_at +'</small></div><hr class="mb-4" style="border-color: #9F86FF">')
                } else {
                    $('#notes-title').after('<div class="card-text text-white"><div>' + data.text + '</div><small>created - '+ data.created_at +'</small></div><hr class="mb-4" style="border-color: #9F86FF">')
                }
            }
        });

    });


    $('#note-cancel').click(function(){
        $('#noteModal').modal('hide');
    });

</script>

@endpush