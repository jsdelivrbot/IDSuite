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


// $(function() {
//     $.ajax({
//         url: 'c',
//         type: "GET",
//         success: function(data){
//             // console.log(data);
//
//             $.each(data, function (key, value) {
//                 $('#customer-table-body').append('<tr><td>' + value.id + '</td><td>' + value.name + '</td></tr>');
//             })
//         }
//     });
// });


(function($, window, document) {

    $(function () {
        getUser();
    });


    function getUser() {
        $(function () {
            $.ajax({
                url: 'user/current',
                type: "GET",
                success: function (data) {
                    console.log(data);

                    user = data;

                    console.log(user.id);

                    getCustomers(user.id);

                }
            });
        });
    }


    // function getCustomers(id) {
    //     $(function () {
    //         $.ajax({
    //             url: 'customer/all',
    //             type: "GET",
    //             data: {id: id},
    //             success: function (data) {
    //                 console.log(data);
    //
    //                 $.each(data, function (key, value) {
    //
    //                     // console.log(key);
    //                     // console.log(value.id);
    //
    //                     $('#customer-table-body').append('<tr><td><a href="customer/' + value.id + '">' + value.id + '</a></td><td>' + value.name + '</td></tr>');
    //                 })
    //             }
    //         });
    //     });
    // }

    function getCustomers() {
        $('#customer-table').dataTable({
            "bPaginate": false,
            ajax: {
                url: "customer/all",
                type: "GET",
                dataSrc: ""
            },
            columns: [
                {
                    data: "id",
                    render: function (data, type) {
                        return "<a href='/customer/"+ data + "'>" + data + "</a>";
                    }

                },
                {
                    data: "name"
                }
            ]
        });
    }
}(window.jQuery, window, document));