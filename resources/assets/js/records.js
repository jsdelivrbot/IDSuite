/**
 * Created by amac on 7/7/17.
 */



function getRecordDetails(id) {
    $.ajax({
        type: "GET",
        url: '/getRecordDetails',
        data: {
            id: id
        },
        success: function (data) {
            console.log(data)
        },
    })
}