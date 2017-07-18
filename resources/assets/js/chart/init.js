

// global initializations


$(document).ready(function () {


    $(function () {
        $("#start_date").datepicker({
            dateFormat: 'yy-mm-dd', changeMonth: true,
            changeYear: true, defaultDate: '-2m'
        });
    });
    $(function () {
        $("#end_date").datepicker({
            dateFormat: 'yy-mm-dd', changeMonth: true,
            changeYear: true, defaultDate: '+0m'

        });
    });

});