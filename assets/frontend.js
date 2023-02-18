(function ($) {
    // use strict
    "use strict";
    var total_price = 0;
    
    /**
     * House Configurator part 1 js
     */
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

    /**
     * House Configurator part 3 js
     */
    $(document).ready(function() {

            $('.options_data input[type="checkbox"]').on('change', function() {
            var total = parseInt($('#calculate_total_part3').text().replace('€ ', ''));

            if ($(this).prop('checked')) {
                total += parseInt($(this).attr('data-price'));
            }
            else {
                total -= parseInt($(this).attr('data-price'));
            }

            $('#calculate_total_part3').html('€ ' + total);

        });
                
        $('tr#levels_type td, .model_level input[type="radio"]').on('click', function() {

            var id = $(this).attr('data-id');
            var total = $('#calculate_total_part3').attr('data-price');
            $('tr#levels_type td a').removeClass('p__active');
            $(this).find('a').addClass('p__active');
            
            $('.model_level input[type="radio"]').change(function() {

                var selectedId = $(this).attr('data-id');

                if ($(this).attr('data-id') == id) {
                    $(this).prop('checked', true);
                }  
                $('tr#levels_type td a').removeClass('p__active');
                $('tr#levels_type td[data-id="' + selectedId + '"] a').addClass('p__active');

            });
            $.ajax({
                url: ajax_url.ajax_url,
                type: 'POST',
                data: {
                    action: 'get_level_taxonomies',
                    id: id
                },
                success: function(response) {
                    var obj = $.parseJSON(response);
                    console.log(obj);
                    $('#feature_img').attr('src', obj[0].feature_img);
                    $('.model_level input[type="radio"]').each(function() {
                        if ($(this).attr('data-id') == id) {
                            $(this).prop('checked', true);
                            $('tr#levels_type td a').each(function() {
                                if ($(this).attr('data-id') == id) {
                                    $(this).addClass('p__active');
                                }
                            });
                        }
                    });
                    console.log(total);
                    total = parseInt(total) + parseInt(obj[0].price);
                    $('#calculate_total_part3').html('€ ' +total);
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            });
        });        
    });
      
      


})(jQuery);