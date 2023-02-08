(function ($) {
    // use strict
    "use strict";
    var total_price = 0;
    
    // calculate_01 onchange send all form data to server
    $(document).ready(function() {
        $('select[name="levels"]').on('change', function() {
            var levels = $(this).find(':selected').attr('data-id');
            total_price = parseInt($(this).val());
            $('input[name="feature"]').each(function() {
                var feature = $(this).attr('data-type').split(',');
                if ($.inArray(levels, feature) !== -1) {
                    $(this).prop('checked', true);
                    total_price = total_price + parseInt($(this).val());
                } else {
                    $(this).prop('checked', false);
                    total_price = total_price + parseInt($(this).val());
                }
            });
            $('.cal__result').html(total_price);
        });

        $('input[name="feature"]').on('change', function() {
            if ($(this).prop('checked')) {
                total_price = total_price + parseInt($(this).val());
            } else {
                total_price = total_price - parseInt($(this).val());
            }
            $('.cal__result').html(total_price);
        });

        // on load page select first option of select box and calculate price and checked feature
        $('select[name="levels"]').trigger('change');

        // on change square_meters calculate price with total price
        $('input[name="square_meters"]').on('change', function() {
            // if square_meters is empty or less than 20 then alert message with error class
            if ($(this).val() == '' || $(this).val() < 20) {
                $('input[name="square_meters"]').addClass('error');
                alert('Please enter square meters more than 20');
            } else {
                total_price = total_price * parseInt($(this).val());
                $('.cal__result').html(total_price);
            }
        });
    });
      
      


})(jQuery);