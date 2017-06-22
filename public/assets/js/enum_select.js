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