/**
 * Created by fbreidi on 6/12/2017.
 */


function renderGetCust (customers_selected, start_date, end_date, interval, canvas_id_name, config) {

    if(typeof myLine !== 'undefined')
        myLine.destroy();

    var ctx = document.getElementById(canvas_id_name).getContext("2d");
    window.myLine = new Chart(ctx, config);

    if(customers_selected.length > 1)
        config.type = "line";
    else
        config.type = "bar";


    var chart_colors = ["#3366CC", "#DC3912", "#FF9900", "#109618", "#990099", "#3B3EAC", "#0099C6", "#DD4477", "#66AA00",
        "#B82E2E", "#316395", "#994499", "#22AA99", "#AAAA11", "#6633CC", "#E67300", "#8B0707", "#329262", "#5574A6", "#3B3EAC"];



    function fill_data (label, chart_color, data) {

        console.log("labellll :   "+label)
        return {
            label: label,
            backgroundColor: chart_color,
            borderColor: chart_color,
            data: data,
            fill: false,
        };

    }

    // loop through each customer_id

    var promises = [];

    for (var i_counter=0; i_counter < customers_selected.length; i_counter++) {

        // grab data for customer_id
        customer = customers_selected[i_counter];
        var request = $.ajax({

            async: false,

            url: "api.php?cust="+customer.id,
            type: "POST",
            data :  {start_date: start_date, end_date: end_date, interval: interval},

            success: function(result) {
                var parsed_json = $.parseJSON(result);

                updated_label = [];
                updated_data = [];

                max = 0;
                $.each(parsed_json, function(k, v) {
                    updated_label.push(v.start_time );
                    updated_data.push(Math.ceil(v.duration_total/60));

                    if(v.duration_total > max)
                        max = v.duration_total;
                    console.log("current max: "+max/60)
                });

                // update canvas data
                if(updated_label.length > config.data.labels)
                    config.data.labels = updated_label;


                if(config.data.labels.length < 13)
                    config.type = "bar";

                console.log("customers_selected");



                config.data['datasets'].push(fill_data(customer.text, chart_colors[i_counter], updated_data));

            }});
        promises.push(request);

    }


    $.when.apply(null, promises).done(function() {
        console.log("all calls done, let's render");
        console.log(config);
        window.myLine.update();

    })





}


function renderEndpoint(customer_id, start_date, end_date, canvas_id_name, config) {

    if(typeof myLine !== 'undefined')
        myLine.destroy();

    var ctx = document.getElementById(canvas_id_name).getContext("2d");
    window.myLine = new Chart(ctx, config);



    // grab data
    $.ajax({
        url: "api.php?endpoint",
        type: "POST",
        data :  {start_date: start_date, end_date: end_date, customer_id: customer_id},

        success: function(result) {
            var parsed_json = $.parseJSON(result);

            updated_label = [];
            updated_data = [];
            backgroundColor = [];


            var counter_id = 0
            $.each(parsed_json, function(k, v) {
                updated_label.push(v.endpoint_name);
                updated_data.push(v.endpoint_count);
                backgroundColor.push(getRandomColor());


              //  if(v.customer_id )



            });


            // update canvas data
            config.data.labels = updated_label;
            config.data['datasets'][0].data = updated_data;
            config.data['datasets'][0].backgroundColor = backgroundColor;

            window.myLine.update();
            console.log(updated_label);

        }});





}


function getCustomerList(callback) {

    $.ajax({
        url: "api.php?getcustomers",
        success: function (result) {

            var parsed_json = $.parseJSON(result);
            console.log("parsed_json");

            console.log(parsed_json);
            callback(parsed_json);

        }, fail:  function () {
            callback(false);
        }
    });

}