(function ($) {
    // use strict
    "use strict";
    var total_price = 0;
    // if this #calculate_01 form on change then alert value
    $('#calculate_01').on('change', function () {
        // get value of square_meters
        var square_meters = $('#square_meters').val();
        // levels get value by on change function
        var levels = $('#levels').val();
        
        if (square_meters == "" || square_meters < 20) {
            $('#square_meters').addClass('is-invalid');
            $('#square_meters').after('<small class="error text-danger">Please enter a value greater than 20</small>');
            if(square_meters == ""){
                $('#square_meters').next().text('Please enter a value');
            } else {
                $('#square_meters').next().text('Please enter a value greater than 20');
            }
        } else {
            total_price = square_meters * 10.7639;
            $('.cal__result').animate({
                opacity: '0.2'
            }, 100, function () {
                $('.cal__result').text(Math.round(total_price) + ' $');
                $('.cal__result').animate({
                    opacity: '1'
                }, 500);
            }
            );
        }

        // if level value is basic then add extra 200 to total price elseif level value is standard then add extra 500 to total price elseif level value is premium then add extra 1000 to total price
        if (levels == 'basic') {
            total_price = total_price + 200;
            // checked feature value and add extra 100 to total price
            $('#feature_1').attr('checked', true);
            $('#feature_2').attr('checked', true);
            $('#feature_3').attr('checked', true);
            $('#feature_4').attr('checked', true);
            // add extra 100 to total price for each checked feature
            if ($('#feature_1').is(':checked')) {
                total_price = total_price + 100;
            }
            if ($('#feature_2').is(':checked')) {
                total_price = total_price + 100;
            }
            if ($('#feature_3').is(':checked')) {
                total_price = total_price + 100;
            }
            if ($('#feature_4').is(':checked')) {
                total_price = total_price + 100;
            }
        } else if (levels == 'standard') {
            total_price = total_price + 500;
            // checked feature value and add extra 100 to total price
            $('#feature_5').attr('checked', true);
            $('#feature_6').attr('checked', true);
            // add extra 100 to total price for each checked feature
            if ($('#feature_5').is(':checked')) {
                total_price = total_price + 100;
            }
            if ($('#feature_6').is(':checked')) {
                total_price = total_price + 100;
            }
        } else if (levels == 'premium') {
            total_price = total_price + 1000;
            // checked feature value and add extra 100 to total price
            $('#feature_7').attr('checked', true);
            $('#feature_8').attr('checked', true);
            // add extra 100 to total price for each checked feature
            if ($('#feature_7').is(':checked')) {
                total_price = total_price + 100;
            }
            if ($('#feature_8').is(':checked')) {
                total_price = total_price + 100;
            }
        }

        
    });

    $(document).ready(function () {
        // after load page get value of square_meters and calculate square_feet
        var square_meters = $('#square_meters').val();
        var levels = $('#levels').val();
        total_price = square_meters * 10.7639;

        $('.cal__result').animate({
            opacity: '0.2'
        }, 100, function () {
            $('.cal__result').text(Math.round(total_price) + ' $');
            $('.cal__result').animate({
                opacity: '1'
            }, 500);
        }
        );

        // if level value is basic then add extra 200 to total price elseif level value is standard then add extra 500 to total price elseif level value is premium then add extra 1000 to total price
        if (levels == 'basic') {
            total_price = total_price + 200;
            // checked feature value and add extra 100 to total price
            $('#feature_1').attr('checked', true);
            $('#feature_2').attr('checked', true);
            $('#feature_3').attr('checked', true);
            $('#feature_4').attr('checked', true);
            // add extra 100 to total price for each checked feature
            if ($('#feature_1').is(':checked')) {
                total_price = total_price + 100;
            }
            if ($('#feature_2').is(':checked')) {
                total_price = total_price + 100;
            }
            if ($('#feature_3').is(':checked')) {
                total_price = total_price + 100;
            }
            if ($('#feature_4').is(':checked')) {
                total_price = total_price + 100;
            }
        } else if (levels == 'standard') {
            total_price = total_price + 500;
            // checked feature value and add extra 100 to total price
            $('#feature_5').attr('checked', true);
            $('#feature_6').attr('checked', true);
            // add extra 100 to total price for each checked feature
            if ($('#feature_5').is(':checked')) {
                total_price = total_price + 100;
            }
            if ($('#feature_6').is(':checked')) {
                total_price = total_price + 100;
            }
        } else if (levels == 'premium') {
            total_price = total_price + 1000;
            // checked feature value and add extra 100 to total price
            $('#feature_7').attr('checked', true);
            $('#feature_8').attr('checked', true);
            // add extra 100 to total price for each checked feature
            if ($('#feature_7').is(':checked')) {
                total_price = total_price + 100;
            }
            if ($('#feature_8').is(':checked')) {
                total_price = total_price + 100;
            }
        }

    });            

})(jQuery);