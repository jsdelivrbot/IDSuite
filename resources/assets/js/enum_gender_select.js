/**
 * Created by amac on 6/9/17.
 */
$( document ).ready(function() {
    $.ajax({
        type: "GET",
        url: '/genderEnum',
        success: function (data) {
            data = data.data;
            $.each(data, function (key, value) {
                $('#gender').append('<option value=' + value + '>' + value + '</option>');
            });
        }
    });
});
