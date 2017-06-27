/**
 * Created by amac on 6/9/17.
 */
$( document ).ready(function() {
    $.ajax({
        type: "GET",
        url: '/titleEnum',
        success: function (data) {
            data = data.data;
            $.each(data, function (key, value) {
                $('#title').append('<option value=' + value + '>' + value + '</option>');
            });
        }
    });
});

