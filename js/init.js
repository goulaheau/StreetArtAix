(function ($) {
    $(function () {
        $('.button-collapse').sideNav();
        $('.parallax').parallax();
        $('.slider').slider({
            full_width: true
        });
        $('.dropdown-button').dropdown({
            inDuration: 0,
            outDuration: 0,
            hover: false,
            belowOrigin: true
        });
        $('.datepicker').pickadate({
            selectMonths: false, // Creates a dropdown to control month
            selectYears: 0 // Creates a dropdown of 15 years to control year
        });
    }); // end of document ready
})(jQuery); // end of jQuery name space