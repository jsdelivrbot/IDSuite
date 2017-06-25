/**
 * Created by amac on 6/9/17.
 */
$( document ).ready(function() {
    $.ajax({
        type: "GET",
        url: '/genderEnum',
        success: function (data) {
            data = data.data;

            console.log(data);

            $.each(data, function (key, value) {
                $('#gender').append('<option value=' + value + '>' + value + '</option>');
            });
        }
    });
});

/**
 * Created by amac on 6/9/17.
 */
$( document ).ready(function() {
    $.ajax({
        type: "GET",
        url: '/titleEnum',
        success: function (data) {
            data = data.data;

            console.log(data);

            $.each(data, function (key, value) {
                $('#title').append('<option value=' + value + '>' + value + '</option>');
            });
        }
    });
});

