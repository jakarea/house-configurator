<?php
/**
 * Template Name: Single House Model
 * The template for displaying the single house model
 * @package Wordpress,
 * @subpackage TwentyTwelve 
 * @since v1.0. 
 */
get_header();
// Get the house ID
$house_id = get_the_ID();
$dimensionPrice = esc_attr( get_option( 'house_config_house_part_four_price' ) );
/**
 * ========================= floor tile =========================
 */

$floor_tile_terms = get_terms( array(
    'taxonomy' => 'floor_tile',
    'hide_empty' => false,
    'parent' => 0,
    'orderby' => 'term_id',
    'order' => 'ASC'
) );

$floor_tile_terms = array_map(function($term) {
    $term->children = get_terms( array(
        'taxonomy' => 'floor_tile',
        'hide_empty' => false,
        'parent' => $term->term_id,
        'orderby' => 'term_id',
        'order' => 'ASC'
    ) );

    // Set the price meta field value for each child term
    foreach ( $term->children as $child ) {
        // get floor_tile_price meta value for each child
        $term_meta = get_option( "taxonomy_$child->term_id" );
        $child->price = $term_meta['floor_tile_price'] ?? 0;

    }

    return $term;
}, $floor_tile_terms);

$floor_tile_terms = array_map(function($term) {
    $term->children = array_map(function($child) {
        $child->children = get_terms( array(
            'taxonomy' => 'floor_tile',
            'hide_empty' => false,
            'parent' => $child->term_id,
            'orderby' => 'term_id',
            'order' => 'ASC'
        ) );
        // set the floor_tile_image for each child term
        foreach ( $child->children as $child_child ) {
            // get floor_tile_image meta value for each child
            $term_meta = get_option( "taxonomy_$child_child->term_id" );
            $child_child->image = $term_meta['floor_tile_image'] ?? '';
        }
        return $child;
    }, $term->children);
    return $term;
}, $floor_tile_terms);
/**
 * ========================= end floor tile =========================
 */

/**
 * ========================= sanitary =========================
 */
$sanitaries = get_terms( array(
    'taxonomy' => 'sanitary',
    'hide_empty' => false,
    'parent' => 0,
    'orderby' => 'term_id',
    'order' => 'ASC'
) );

$sanitaries = array_map(function($term) {
    $term->children = get_terms( array(
        'taxonomy' => 'sanitary',
        'hide_empty' => false,
        'parent' => $term->term_id,
        'orderby' => 'term_id',
        'order' => 'ASC'
    ) );

    // Set the price meta field value for each child term
    foreach ( $term->children as $child ) {
        // get sanitary_price meta value for each child
        $term_meta = get_option( "taxonomy_$child->term_id" );
        $child->price = $term_meta['sanitary_price'] ?? 0;
        $child->image = $term_meta['sanitary_image'] ?? '';

    }

    return $term;
}, $sanitaries);

/**
 * ========================= end sanitary =========================
 */

 /**
  * ========================= bathroom_furniture furniture =========================
  */
$bathroom_furniture = get_terms( array(
    'taxonomy' => 'bathroom_furniture',
    'hide_empty' => false,
    'parent' => 0,
    'orderby' => 'term_id',
    'order' => 'ASC'
) );

$bathroom_furniture = array_map(function($term) {
    $term->children = get_terms( array(
        'taxonomy' => 'bathroom_furniture',
        'hide_empty' => false,
        'parent' => $term->term_id,
        'orderby' => 'term_id',
        'order' => 'ASC'
    ) );

    // Set the price meta field value for each child term
    foreach ( $term->children as $child ) {
        // get bathroom_furniture_price meta value for each child
        $term_meta = get_option( "taxonomy_$child->term_id" );
        $child->price = $term_meta['bathroom_furniture_price'] ?? 0;
        $child->image = $term_meta['bathroom_furniture_image'] ?? '';

    }

    return $term;
}, $bathroom_furniture);
/*
* ========================= end bathroom_furniture =========================
*/

/*
* ========================= accesories taxonomy =========================
*/
$accesories = get_terms( array(
    'taxonomy' => 'accesories',
    'hide_empty' => false,
    'parent' => 0,
    'orderby' => 'term_id',
    'order' => 'ASC'
) );

$accesories = array_map(function($term) {
    $term->children = get_terms( array(
        'taxonomy' => 'accesories',
        'hide_empty' => false,
        'parent' => $term->term_id,
        'orderby' => 'term_id',
        'order' => 'ASC'
    ) );

    // Set the price meta field value for each child term
    foreach ( $term->children as $child ) {
        // get accesories_price meta value for each child
        $term_meta = get_option( "taxonomy_$child->term_id" );
        $child->price = $term_meta['accesories_price'] ?? 0;
        $child->image = $term_meta['accesories_image'] ?? '';

    }

    return $term;
}, $accesories);

/*
* ========================= end accesories =========================
*/

/**
 * ========================= installation =========================
 */
$installation = get_terms( array(
    'taxonomy' => 'installation',
    'hide_empty' => false,
    'parent' => 0,
    'orderby' => 'term_id',
    'order' => 'ASC'
) );

$installation = array_map(function($term) {
    $term->children = get_terms( array(
        'taxonomy' => 'installation',
        'hide_empty' => false,
        'parent' => $term->term_id,
        'orderby' => 'term_id',
        'order' => 'ASC'
    ) );

    // Set the price meta field value for each child term
    foreach ( $term->children as $child ) {
        // get installation_price meta value for each child
        $term_meta = get_option( "taxonomy_$child->term_id" );
        $child->price = $term_meta['installation_price'] ?? 0;
        $child->image = $term_meta['installation_image'] ?? '';

    }

    return $term;
}, $installation);

$dimensionA = '0';
$dimensionB = '0';

// Get the dimensionA and dimensionB from the url
if (isset($_GET['dimensionA']) && isset($_GET['dimensionB'])) {
    $dimensionA = $_GET['dimensionA'];
    $dimensionB = $_GET['dimensionB'];
}
?>
<!-- SmartWizard html -->
<div class="row py-4">
    <div class="col-9 mb-2">
        <div class="card">
            <div id="smartwizard">
                <ul class="nav m-0">
                    <li class="nav-item">
                    <a class="nav-link" href="#step-1">
                        <div class="num">1</div>
                        Floor Tiles
                    </a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="#step-2">
                        <span class="num">2</span>
                        Sanitary
                    </a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="#step-3">
                        <span class="num">3</span>
                        Bath. furniture
                    </a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link " href="#step-4">
                        <span class="num">4</span>
                        accessories
                    </a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link " href="#step-5">
                        <span class="num">5</span>
                        Installation
                    </a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link " href="#step-6">
                        <span class="num">6</span>
                        Overview
                    </a>
                    </li>
                </ul>
            
                <div class="tab-content">
                    <div id="step-1" class="tab-pane" role="tabpanel" aria-labelledby="step-1">
                        <!-- card item --> 
                        <form action="#" id="form-1" name="Floor Tiles">
                        <?php foreach($floor_tile_terms as $term) : ?>
                            <div class="card my-3">
                                <div class="card-body">
                                    <h4 class="text-primary mb-3"><strong><?php echo $term->name; ?></strong></h4>
                                <?php foreach($term->children as $child) : ?>
                                    <div class="inner-item">
                                        <div class="inner__taxonomy">
                                            <ul class="list-unstyled m-0">
                                                <li data-price="<?php echo $child->price; ?>">
                                                    <div class="d-flex justify-content-between">
                                                        <h5><?php echo $child->name; ?></h5>
                                                        <h5>+ <?php echo '€ '. $child->price; ?></h5>
                                                    </div>
                                                    <div class="inner_taxo_item d-flex justify-content-between">
                                                        <ul class="list-unstyled m-0 d-flex">
                                                        <?php foreach($child->children as $child_child) : ?>
                                                            <li class="mr-2">
                                                                <label class="image-checkbox">
                                                                    <img class="img-responsive" src="<?php echo $child_child->image; ?>" />
                                                                    <input type="checkbox" name="price[]" value="<?php echo $child->price; ?>" data-prev-value="0" />
                                                                    <i class="fa fa-check hidden"></i>
                                                                </label>
                                                            </li>
                                                        <?php endforeach; ?>    
                                                        </ul>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        </form>
                    </div>
                    <div id="step-2" class="tab-pane" role="tabpanel" aria-labelledby="step-2">
                        <!-- card item --> 
                        <form action="#" id="form-2" name="Sanitary">
                        <?php foreach($sanitaries as $term) : ?>
                            <div class="card my-3">
                                <div class="card-body">
                                <?php foreach($term->children as $child) : ?>
                                    <div class="inner-item">
                                        <div class="inner__taxonomy mb-3 border-bottom">
                                            <h4 class="text-primary mb-3"><strong><?php echo $term->name; ?></strong></h4>
                                            <ul class="list-unstyled m-0">
                                                <li data-price="<?php echo $child->price; ?>">
                                                    <ul class="list-unstyled m-0">
                                                        <li>
                                                            <div class="imagenprice d-flex align-item-center justify-content-between">
                                                                <?php if($child->image) : ?>
                                                                    <img class="img-responsive mr-3" src="<?php echo $child->image; ?>" />
                                                                <?php endif; ?>
                                                                <h5 class="mr-auto"><?php echo $child->name; ?></h5>
                                                                <label class="image-checkbox">
                                                                    <input type="checkbox" name="price[]" value="<?php echo $child->price; ?>" data-prev-value="0" />
                                                                    <span>+ Add</span>
                                                                </label>
                                                                <h5>+ <?php echo '€ '. $child->price; ?></h5>
                                                            </div>
                                                        </li>
                                                    </ul>    
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        </form>
                    </div>
                    <div id="step-3" class="tab-pane" role="tabpanel" aria-labelledby="step-3">
                        <!-- card item --> 
                        <form action="#" id="form-3" name="Bath Furniture">
                        <?php foreach($bathroom_furniture as $term) : ?>
                            <div class="card my-3">
                                <div class="card-body">
                                <?php foreach($term->children as $child) : ?>
                                    <div class="inner-item">
                                        <div class="inner__taxonomy mb-3 border-bottom">
                                            <h4 class="text-primary mb-3"><strong><?php echo $term->name; ?></strong></h4>
                                            <ul class="list-unstyled m-0">
                                                <li data-price="<?php echo $child->price; ?>">
                                                    <ul class="list-unstyled m-0">
                                                        <li>
                                                            <div class="imagenprice d-flex align-item-center justify-content-between">
                                                                <?php if($child->image) : ?>
                                                                    <img class="img-responsive mr-3" src="<?php echo $child->image; ?>" />
                                                                <?php endif; ?>
                                                                <h5 class="mr-auto"><?php echo $child->name; ?></h5>
                                                                <label class="image-checkbox">
                                                                    <input type="checkbox" name="price[]" value="<?php echo $child->price; ?>" data-prev-value="0" />
                                                                    <span>+ Add</span>
                                                                </label>
                                                                <h5>+ <?php echo '€ '. $child->price; ?></h5>
                                                            </div>
                                                        </li>
                                                    </ul>    
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        </form>
                    </div>
                    <div id="step-4" class="tab-pane" role="tabpanel" aria-labelledby="step-4">
                        <!-- card item --> 
                        <form action="#" id="form-4" name="Accessories">
                        <?php foreach($accesories as $term) : ?>
                            <div class="card my-3">
                                <div class="card-body">
                                <?php foreach($term->children as $child) : ?>
                                    <div class="inner-item">
                                        <div class="inner__taxonomy mb-3 border-bottom">
                                            <h4 class="text-primary mb-3"><strong><?php echo $term->name; ?></strong></h4>
                                            <ul class="list-unstyled m-0">
                                                <li data-price="<?php echo $child->price; ?>">
                                                    <ul class="list-unstyled m-0">
                                                        <li>
                                                            <div class="imagenprice d-flex align-item-center justify-content-between">
                                                                <?php if($child->image) : ?>
                                                                    <img class="img-responsive mr-3" src="<?php echo $child->image; ?>" />
                                                                <?php endif; ?>
                                                                <h5 class="mr-auto"><?php echo $child->name; ?></h5>
                                                                <label class="image-checkbox">
                                                                    <input type="checkbox" name="price[]" value="<?php echo $child->price; ?>" data-prev-value="0" />
                                                                    <span>+ Add</span>
                                                                </label>
                                                                <h5>+ <?php echo '€ '. $child->price; ?></h5>
                                                            </div>
                                                        </li>
                                                    </ul>    
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        </form>
                    </div>
                    <div id="step-5" class="tab-pane" role="tabpanel" aria-labelledby="step-5">
                        <!-- card item --> 
                        <form action="#" id="form-4" name="Installation">
                        <?php foreach($installation as $term) : ?>
                            <div class="card my-3">
                                <div class="card-body">
                                <?php foreach($term->children as $child) : ?>
                                    <div class="inner-item">
                                        <div class="inner__taxonomy mb-3 border-bottom">
                                            <h4 class="text-primary mb-3"><strong><?php echo $term->name; ?></strong></h4>
                                            <ul class="list-unstyled m-0">
                                                <li data-price="<?php echo $child->price; ?>">
                                                    <ul class="list-unstyled m-0">
                                                        <li>
                                                            <div class="imagenprice d-flex align-item-center justify-content-between">
                                                                <?php if($child->image) : ?>
                                                                    <img class="img-responsive mr-3" src="<?php echo $child->image; ?>" />
                                                                <?php endif; ?>
                                                                <h5 class="mr-auto"><?php echo $child->name; ?></h5>
                                                                <label class="image-checkbox">
                                                                    <input type="checkbox" name="price[]" value="<?php echo $child->price; ?>" data-prev-value="0" />
                                                                    <span>+ Add</span>
                                                                </label>
                                                                <h5>+ <?php echo '€ '. $child->price; ?></h5>
                                                            </div>
                                                        </li>
                                                    </ul>    
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        </form>
                    </div>
                    <div id="step-6" class="tab-pane" role="tabpanel" aria-labelledby="step-6">
                        <div class="card mb-3">
                            <img class="img-responsive card-header-top" src="https://s.brugman.nl/_processed_/4/d/csm_002%20Vierkante%20badkamer.jpg_1391e51b85.jpg" />
                        </div>
                        <div class="card mb-3 total-ammount-ofselected card-shadow p-3">
                            <ul class="list-unstyled m-0 total-ammount-ofselected d-flex justify-content-between">
                                <li class="text-mute"> <h6>Total</h6> </li>
                                <li class="total_ammount_overview"> <strong>€ 0</strong> </li>
                            </ul>
                        </div>
                        <div class="card card-summery-of-all mb-3">
                            <div class="card-body">
                                <div id="total_summary">
                                    <!-- get all the forms select data -->
                                </div>
                                <div class="mt-3">
                                    <!-- generate pdf -->
                                    <a href="#" class="btn btn-primary btn-block" id="generate_pdf">Generate PDF</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            
                <!-- Include optional progressbar HTML -->
                <div class="progress">
                <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-3">
        <div class="card">
            <div class="card-header p-0">
                <img class="card-img-top" src="https://via.placeholder.com/150x100" alt="Card image cap">
            </div>
            <div class="card-body">
                <h5><?php echo get_the_title(); ?></h5>
                <div class="all-item mt-3">
                    <ul class="list-unstyled m-0 d-flex justify-content-between">
                        <li class="text-mute"> <span class="d__l"><?php echo $dimensionA. 'cm'; ?></span> x <span class="l__2"><?php echo $dimensionB. 'cm'; ?></span></li>
                        <li class="dimension_price"> <strong>
                            <?php 
                                if($dimensionA && $dimensionB) {
                                    $dimension = $dimensionA + $dimensionB;
                                    echo '€ '. $dimension * $dimensionPrice;
                                } else {
                                    echo '€ 0';
                                }
                            ?>
                        </strong> </li>
                    </ul>
                </div>
                <hr />
                <div class="all-item mt-3">
                    <ul class="list-unstyled m-0 d-flex justify-content-between">
                        <li class="text-mute"> <h6>Extra</h6> </li>
                        <li class="extra_total"> <strong>€ 0</strong> </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-body justify-content-center align-self-middle">
                <div class="result-total d-flex justify-content-between">
                    <h5 class="m-0">Total</h5>
                    <h4 class="m-0 bg-primary p-1 text-white rounded">€ 0</h4>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
get_footer();
?>
<!-- JavaScript -->
<script>
    jQuery(function($) {
        // SmartWizard initialize
        $('#smartwizard').smartWizard({
            selected: 0, // Initial selected step, 0 = first step
            theme: 'basic', // theme for the wizard, related css need to include for other than default theme
            justified: true, // Nav menu justification. true/false
            autoAdjustHeight: true, // Automatically adjust content height
            backButtonSupport: true, // Enable the back button support
        });

        function showConfirm() {
            $('#smartwizard').smartWizard('showMessage', 'Finish Clicked');
            // Set state as finished
            $('#smartwizard').smartWizard('setFinishStep', 3);
        }

        // get data of all form selected data and show in the total summary
        $('form').on('change', function() {
        var total = 0;
        var html = '';
            $('form').each(function() {
                var form = $(this);
                var data = form.serializeArray();
                var label = form.attr('name');
                $.each(data, function(index, value) {
                var name = value.name;
                var price = value.value;
                if (price) {
                    total += parseInt(price);
                    html += '<ul class="list-unstyled m-0 d-flex justify-content-between"><li class="d-flex clearfix align-item-center"><h6 class="text-mute">' + label + '</h6></li><li><h6>€ ' + price + '</h6></li></ul>';
                }
                });
            });
            $('#total_summary').html(html);
        });



        // input checkbox check only one and calculate total price
        var total_sum = 0;

        $('input[type="checkbox"]').on('change', function() {
            var card_sum = 0;
            var checkboxes = $(this).closest('.card').find('input[type="checkbox"]');

            // Check only one checkbox in the card
            checkboxes.not(this).prop('checked', false);

            checkboxes.each(function() {
                if ($(this).is(':checked')) {
                var price = parseInt($(this).closest('li[data-price]').data('price'));
                var increment = 1;
                card_sum += price * increment;

                // Update the checkbox label
                var $label = $(this).closest('label');
                var isChecked = $(this).is(':checked');
                var $span = $label.find('span');
                $span.text(isChecked ? '- Remove' : '+ Add');
                } else {
                // Reset the checkbox label
                var $label = $(this).closest('label');
                var $span = $label.find('span');
                $span.text('+ Add');
                }
            });

            // Update the total_sum
            var prev_sum = parseInt($(this).data('prev-value'));
            total_sum += card_sum - prev_sum;

            $(this).data('prev-value', card_sum);
            $('.extra_total strong').html('€ ' + total_sum);
            $('.result-total h4').html('€ ' + (total_sum + parseInt($('.dimension_price strong').html().replace('€ ', ''))));
            $('.total_ammount_overview').html('€ ' + (total_sum + parseInt($('.dimension_price strong').html().replace('€ ', ''))));

        });

        $('#generate_pdf').on('click', function() {
            window.jsPDF = window.jspdf.jsPDF;
            var doc = new jsPDF();
            var checkboxes = $('input[type="checkbox"]');
            var i = 0;
            var yOffset = 10; // initial vertical offset
            var tableData = [];
            // add website name
            doc.setFontSize(20);
            var websiteName = 'Bouwspecialist.nl';
            var websiteNameWidth = doc.getStringUnitWidth(websiteName) * doc.internal.getFontSize() / doc.internal.scaleFactor;
            var x = (doc.internal.pageSize.width - websiteNameWidth) / 2;
            doc.text(x, yOffset, websiteName);
            yOffset += 10; // increment vertical offset

            doc.setFontSize(14);
            // website url
            var websiteUrl = 'https://bouwspecialist.nl/';
            var websiteUrlWidth = doc.getStringUnitWidth(websiteUrl) * doc.internal.getFontSize() / doc.internal.scaleFactor;
            x = (doc.internal.pageSize.width - websiteUrlWidth) / 2;

            // add current url
            var url = window.location.href;
            var urlWidth = doc.getStringUnitWidth(url) * doc.internal.getFontSize() / doc.internal.scaleFactor;
            x = (doc.internal.pageSize.width - urlWidth) / 2;

            // add current date
            doc.setFontSize(12);
            var currentDate = new Date();
            var dateString = 'Generated on: ' + currentDate.toLocaleDateString() + ' ' + currentDate.toLocaleTimeString();
            var dateStringWidth = doc.getStringUnitWidth(dateString) * doc.internal.getFontSize() / doc.internal.scaleFactor;
            x = (doc.internal.pageSize.width - dateStringWidth) / 2;
            doc.text(x, yOffset, dateString);
            yOffset += 10; // increment vertical offset

            doc.setFontSize(16);
            checkboxes.each(function() {
                if ($(this).is(':checked')) {
                    var label = $(this).closest('form').attr('name');
                    var name = $(this).closest('li[data-price]').data('name');
                    var price = $(this).closest('li[data-price]').data('price');
                    tableData.push([label, '€ ' + price]);
                }
            });

            // total price to push in table
            var total_price = '€ ' + (total_sum + parseInt($('.dimension_price strong').html().replace('€ ', '')));
            tableData.push(['Total', total_price, '']);

            // Define table columns and options
            var tableColumns = [
                { header: 'Items', dataKey: 'label' },
                { header: 'Price', dataKey: 'price' }
            ];
            var tableOptions = {
                startY: 50,
                margin: { top: 50 },
                styles: {
                    headerFontStyle: 'bold',
                    cellPadding: 5
                },
                columnStyles: {
                    item: { columnWidth: 'auto' },
                    price: { columnWidth: 'auto' },
                    label: { columnWidth: 'auto' }
                }
            };

            // Create the table
            doc.autoTable(tableColumns, tableData, tableOptions);

            // add footer text
            doc.setFontSize(10);
            var footerText = "The invoice is created on a computer and is valid without the signature and stamp.";
            var footerTextWidth = doc.getStringUnitWidth(footerText) * doc.internal.getFontSize() / doc.internal.scaleFactor;
            x = (doc.internal.pageSize.width - footerTextWidth) / 2;
            // doc.text(x, 280, footerText);


            // add date and current url of PDF generation it should be at the bottom left of the page and same line as date
            var date = new Date();
            var dateString = 'Generated on: ' + date.toLocaleDateString() + ' ' + date.toLocaleTimeString();
            var dateStringWidth = doc.getStringUnitWidth(dateString) * doc.internal.getFontSize() / doc.internal.scaleFactor;
            var dateStringX = 20; // Set the x-coordinate for the date text on the left side
            var url = window.location.href;
            var urlWidth = doc.getStringUnitWidth(url) * doc.internal.getFontSize() / doc.internal.scaleFactor;
            var urlX = doc.internal.pageSize.width - urlWidth - 20; // Set the x-coordinate for the URL text on the right side
            var textY = doc.internal.pageSize.height - 10; // Set the margin to 10 units from the bottom of the page
            doc.setFontSize(10);
            doc.text(dateStringX, textY, dateString);
            doc.text(urlX, textY, url);

            // save pdf
            doc.save('part-04.pdf');
        });


    });
</script>