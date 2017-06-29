/**
 * Created by amac on 6/29/17.
 */
/**
 * Created by amac on 6/28/17.
 */
/**
 * Created by amac on 6/24/17.
 */


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

                if($('#note-default').length === 0){
                    $('#note-default').hide();
                }

                $('#notes-title').after('<div class="card-text text-white"><div>' + data.text + '</div><small>created - '+ data.created_at +'</small></div><hr class="mb-4" style="border-color: #E4D836">')

            }
        });

    });





    $('#note-cancel').click(function(){
        $('#noteModal').modal('hide');
    });
