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


$( "#insights" ).click(function() {

    $('#contacts-a').removeClass('active active-outline-tab-blue text-white');
    $('#locations-a').removeClass('active active-outline-tab-teal text-white');

    $('#contacts-a').addClass('blue');
    $('#locations-a').addClass('teal');

    $('#account-card-header').removeClass('active-outline-card-header-teal');
    $('#account-card-header').removeClass('active-outline-card-header-blue');

    $('#account-card-header').addClass('active-outline-card-header-pink');

    $('#account-card-block').removeClass('active-outline-card-block-blue');
    $('#account-card-block').removeClass('active-outline-card-block-teal');

    $('#account-card-block').addClass('active-outline-card-block-pink');

    $('#account-card-block-a').removeClass('btn-nav-blue');
    $('#account-card-block-a').removeClass('btn-nav-teal');

    $('#account-card-block-a').addClass('btn-nav-pink');

    $("#insights-a").addClass('active active-outline-tab-pink text-white');

    bar_one.set(0);
    bar_two.set(0);
    bar_one.animate(1.0);  // Number from 0.0 to 1.0
    bar_two.animate(-1.0);  // Number from 0.0 to 1.0

});

$( "#contacts" ).click(function() {

    $('#insights-a').removeClass('active active-outline-tab-pink text-white');
    $('#locations-a').removeClass('active active-outline-tab-teal text-white');

    $('#insights-a').addClass('pink');
    $('#locations-a').addClass('teal');

    $('#account-card-header').removeClass('active-outline-card-header-teal');
    $('#account-card-header').removeClass('active-outline-card-header-pink');

    $('#account-card-header').addClass('active-outline-card-header-blue');

    $('#account-card-block').removeClass('active-outline-card-block-pink');
    $('#account-card-block').removeClass('active-outline-card-block-teal');

    $('#account-card-block').addClass('active-outline-card-block-blue');

    $('#account-card-block-a').removeClass('btn-nav-pink');
    $('#account-card-block-a').removeClass('btn-nav-teal');

    $('#account-card-block-a').addClass('btn-nav-blue');

    $("#contacts-a").addClass('active active-outline-tab-blue text-white');

    bar_one.set(0);
    bar_two.set(0);
    bar_one.animate(1.0);  // Number from 0.0 to 1.0
    bar_two.animate(-1.0);  // Number from 0.0 to 1.0

});

$( "#locations" ).click(function() {

    $('#insights-a').removeClass('active active-outline-tab-pink text-white');
    $('#contacts-a').removeClass('active active-outline-tab-blue text-white');

    $('#insights-a').addClass('pink');
    $('#contacts-a').addClass('blue');

    $('#account-card-header').removeClass('active-outline-card-header-pink');
    $('#account-card-header').removeClass('active-outline-card-header-blue');

    $('#account-card-header').addClass('active-outline-card-header-teal');

    $('#account-card-block').removeClass('active-outline-card-block-pink');
    $('#account-card-block').removeClass('active-outline-card-block-blue');

    $('#account-card-block').addClass('active-outline-card-block-teal');

    $('#account-card-block-a').removeClass('btn-nav-pink');
    $('#account-card-block-a').removeClass('btn-nav-blue');

    $('#account-card-block-a').addClass('btn-nav-teal');

    $("#locations-a").addClass('active active-outline-tab-teal text-white');

    bar_one.set(0);
    bar_two.set(0);
    bar_one.animate(1.0);  // Number from 0.0 to 1.0
    bar_two.animate(-1.0);  // Number from 0.0 to 1.0

});


var ctx = document.getElementById("myChart").getContext('2d');

var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
        datasets: [{
            label: '# of Votes',
            data: [12, 19, 3, 5, 2, 3],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
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



// progressbar.js@1.0.0 version is used
// Docs: http://progressbarjs.readthedocs.org/en/1.0.0/

var bar_one = new ProgressBar.Line(container_one, {
    strokeWidth: 1,
    easing: 'easeInOut',
    duration: 1400,
    color: '#E4D836',
    trailColor: 'transparent',
    trailWidth: 1,
    svgStyle: {width: '100%', height: '100%'},
    from: {color: '#E4D836'},
    to: {color: '#E64759'},
    step: (state, bar) => {
        bar.path.setAttribute('stroke', state.color);
    }
});




var bar_two = new ProgressBar.Line(container_two, {
    strokeWidth: 1,
    easing: 'easeInOut',
    duration: 1400,
    color: '#E4D836',
    trailColor: 'transparent',
    trailWidth: 1,
    svgStyle: {width: '100%', height: '100%'},
    from: {color: '#E4D836'},
    to: {color: '#E64759'},
    step: (state, bar) => {
        bar.path.setAttribute('stroke', state.color);
    }
});

bar_one.animate(1.0);  // Number from 0.0 to 1.0
bar_two.animate(-1.0);  // Number from 0.0 to 1.0