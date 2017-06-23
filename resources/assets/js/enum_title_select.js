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

bar_one.animate(1.0);  // Number from 0.0 to 1.0


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

bar_two.animate(-1.0);  // Number from 0.0 to 1.0