<?php
/**
 * Template Name: Single House Configurator
 * The template for displaying the single house configurator
 * @package Wordpress,
 * @subpackage TwentyTwelve 
 * @since v1.0. 
 */
get_header();
// Get the house ID
$house_id = get_the_ID();
?>
<div class="container my-5">
    <div class="row">
        <div class="col-md-8 m-0 p-0">
            <div class="card">
                <div class="card-header bg-secondary">
                    <ul class="nav justify-content-center">
                    <?php
                    // get all post-type house-configurator name only with permalink
                    $args = array(
                        'post_type' => 'house-configurator',
                        'posts_per_page' => -1,
                        'fields' => 'ids'
                    );
                    $posts = get_posts( $args );
                    foreach ( $posts as $post ) {
                        $post_id = $post;
                        $post_title = get_the_title( $post_id );
                        $post_permalink = get_the_permalink( $post_id );
                        ?>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="<?php echo $post_permalink; ?>"><?php echo $post_title; ?></a>
                        </li>
                        <?php
                    }
                    ?>
                    </ul>
                </div>
                <div class="card-body m-0 p-0">
                    <?php
                    // get the level taxonomy based on the house ID
                    $terms = get_the_terms( $house_id, 'level' );
                    // show the first level meta feature_image_id image
                    if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
                        $image_id = get_term_meta( $terms[0]->term_id, 'feature_image_id', true );
                        $image_url = wp_get_attachment_image_src( $image_id, 'full' );
                    }
                    if ( ! empty( $image_url ) ) {
                        ?>
                        <img src="<?php echo $image_url[0]; ?>" class="img-fluid w-100" id="feature_img" alt="Responsive image">
                        <?php
                    }
                    else {
                        ?>
                        <img src="<?php echo plugins_url( '../assets/placeholder.png', dirname(__FILE__) ); ?>" class="img-fluid w-100" id="feature_img" alt="Responsive image">
                        <?php
                    }

                    ?>
                    <div class="card-header bg-secondary">
                        <h5 class="text-capitalize text-light">
                            <?php
                                the_title();
                            ?>
                        </h5>
                    </div>
                    <div class="card-description">
                        <div class="card-body">
                            <?php
                                the_content();
                            ?>                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <table class="table table-bordered m-0" id="post__house_photo">
                <tbody>
                    <?php
                    // get all post-type house-configurator name and feature image with permalink and set active class based on current post id and add tr every 2 items
                    $args = array(
                        'post_type' => 'house-configurator',
                        'posts_per_page' => -1,
                        'fields' => 'ids'
                    );
                    $posts = get_posts( $args );
                    $i = 0;
                    foreach ( $posts as $post ) {
                        $post_id = $post;
                        $post_title = get_the_title( $post_id );
                        $post_permalink = get_the_permalink( $post_id );
                        $post_thumbnail = get_the_post_thumbnail_url( $post_id, 'full' );
                        if ( $i % 2 == 0 ) {
                            echo '<tr>';
                        }
                        ?>
                        <td class="p-0">
                            <a href="<?php echo $post_permalink; ?>" class="<?php echo $post_id == $house_id ? 'p__active' : ''; ?>"><img src="<?php echo $post_thumbnail; ?>" class="img-fluid w-100" alt="Responsive image"></a>
                        </td>
                        <?php
                        if ( ($i+1) % 2 == 0 || ($i+1) == count($posts)) {
                            echo '</tr>';
                        }
                        $i++;
                    }
                    ?>
                </tbody>
            </table>

            <table class="table table-bordered" id="post__house_photo">
                <tbody>
                <?php
                    // get the level taxonomy based on the house ID and show thumbnail_id image and set first image as active
                    $terms = get_the_terms( $house_id, 'level' );
                    $i = 0;
                    if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
                ?>
                    <tr id="levels_type">
                        <?php
                            foreach ( $terms as $term ) {
                                $image_id = get_term_meta( $term->term_id, 'thumbnail_id', true );
                                $image_url = wp_get_attachment_image_src( $image_id, 'full' );
                                ?>
                                <td class="p-0" data-id="<?php echo $term->term_id; ?>">
                                    <a href="javascript:void(0)" class="<?php echo $i == 0 ? 'p__active' : ''; ?>"><img src="<?php echo $image_url[0]; ?>" class="img-fluid w-100" alt="Responsive image"></a>
                                </td>
                                <?php
                                $i++;
                            }
                        ?>
                    </tr>
                <?php 
                }else {
                    ?>
                    <td class="p-3 mt-3">
                        No Level Found
                    </td>
                    <?php
                }
                ?>
                </tbody>
            </table>

            <div class="card bg-secondary">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="m-0 text-white">Cost Calculation</h5>
                    <img src="https://via.placeholder.com/50" class="img-fluid" alt="Responsive image">
                </div>
                <div class="card-body">
                    <div class="model-list">
                        <h6 class="my-2 text-white">Model</h6> <hr />
                        <form action="#" id="calculate_03">
                            <?php
                            // get the level taxonomy
                            $levels = get_the_terms( $house_id, 'level' );
                            if ( ! empty ($levels) && ! is_wp_error( $levels ) ) {
                                foreach($levels as $key => $level) {
                                    // get price meta value based on the level taxonomy
                                    $price = get_term_meta( $level->term_id, '_house_configurator_price', true );
                                    ?>
                                    <div class="form-check text-light model_level">
                                        <input class="form-check-input" type="radio" name="levels" id="levels_<?php echo $level->term_id; ?>" value="<?php echo $price; ?>" data-id="<?php echo $level->term_id; ?>" <?php echo $key == 0 ? 'checked' : ''; ?>>
                                        <label class="form-check-label" for="levels_<?php echo $level->term_id; ?>"><?php echo $level->name; ?></label>
                                    </div>
                                    <?php
                                }
                            }
                            else {
                                echo "No Level Found";
                            }
                            ?>
                            <?php
                                // get all fwidth taxonomy
                                $fwidth = get_terms( array(
                                    'taxonomy' => 'fwidth',
                                    'hide_empty' => false,
                                ) );
                                $twidth = get_terms( array(
                                    'taxonomy' => 'twidth',
                                    'hide_empty' => false,
                                ) );
                            ?>
                            <div class="format-box d-flex justify-content-between mt-3">
                                <div class="formet-width">
                                    <h6 class="m-1 text-white">Format Width</h6>
                                    <div class="form-group">
                                        <select name="format_width" id="format_width" class="form-select form-control-sm">
                                            <?php
                                            if ( ! empty ($fwidth) && ! is_wp_error( $fwidth ) ) {
                                                foreach($fwidth as $key => $width){
                                                    // get price meta value based on the fwidth taxonomy
                                                    $f_price = get_term_meta( $width->term_id, '_house_configurator_price_fwidth', true );

                                                    ?>
                                                    <option value="<?php echo $f_price; ?>"><?php echo $width->name; ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="formet-depth">
                                    <h6 class="m-1 text-white">Format Width</h6>
                                    <div class="form-group">
                                        <select name="format_depth" id="format_depth" class="form-select form-control-sm">
                                            <?php
                                            if ( ! empty ($twidth) && ! is_wp_error( $twidth ) ) {
                                                foreach($twidth as $key => $width){
                                                    // get price meta value based on the twidth taxonomy
                                                    $t_price = get_term_meta( $width->term_id, '_house_configurator_price_twidth', true );
                                                    ?>
                                                    <option value="<?php echo $t_price; ?>"><?php echo $width->name; ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="option-list-p-3">
                                <h6 class="m-1 text-white">Feature</h6>
                                <?php
                                $options = get_terms( 'option' );
                                if ( ! empty ($options) && ! is_wp_error( $options ) ) {
                                    foreach($options as $key => $option){
                                        $option_price = get_term_meta( $option->term_id, '_house_configurator_price_option', true );
                                        ?>
                                        <div class="form-group mb-2 options_data">
                                            <div class="form-check text-light">
                                                <input class="form-check-input" type="checkbox" name="data-price" id="option_<?php echo $option->term_id; ?>" value="<?php echo $option_price; ?>" data-price="<?php echo $option_price; ?>">
                                                <label class="form-check-label" for="option_<?php echo $option->term_id; ?>"><?php echo $option->name; ?></label>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                }
                                else {
                                    echo "No Option Found";
                                }
                                ?>
                            </div>
                        </form>
                    </div>
                </div>
                 <!-- footer with total result -->
                <div class="card-footer d-flex justify-content-between align-items-center bg-warning">
                    <h5 class="m-0 text-white">Total</h5>
                    <?php
                        // get meta data prce based on post id
                        $price = get_post_meta( $house_id, '_house_configurator_price', true );
                        // get mata data price based on first level taxonomy
                        $level_price = 0;
                        if ( ! empty ($levels) && ! is_wp_error( $levels ) ) {
                            $level_price = get_term_meta( $levels[0]->term_id, '_house_configurator_price', true );
                        }
                    ?>
                    <h5 class="m-0 text-white" id="calculate_total_part3" data-price="<?php echo $price; ?>">
                        <?php
                        echo '€ ' . $price+$level_price;
                        ?>
                    </h5>
                </div>
            </div>
            <div class="mt-3">
                <a href="javascript:void(0)" class="btn btn-primary btn-block" id="generate_pdf">Generate PDF</a>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>
<script>

function generatePDF() {
        window.jsPDF = window.jspdf.jsPDF;
        var doc = new jsPDF();
        var form = document.getElementById('calculate_03');
        var formData = new FormData(form);

        // Add website logo
        // doc.addImage("https://sample-videos.com/img/Sample-jpg-image-50kb.jpg", "JPG", 15, 40, 180, 180);

        // Add website name
        doc.setFontSize(20);
        var websiteName = 'Bouwspecialist.nl';
        var websiteNameWidth = doc.getStringUnitWidth(websiteName) * doc.internal.getFontSize() / doc.internal.scaleFactor;
        var x = (doc.internal.pageSize.width - websiteNameWidth) / 2;
        doc.text(x, 20, websiteName).setFontSize(14);

        var websiteUrl = 'https://bouwspecialist.nl/';
        var websiteUrlWidth = doc.getStringUnitWidth(websiteUrl) * doc.internal.getFontSize() / doc.internal.scaleFactor;
        x = (doc.internal.pageSize.width - websiteUrlWidth) / 2;
        doc.text(x, 30, websiteUrl);

        var url = window.location.href;
        var urlWidth = doc.getStringUnitWidth(url) * doc.internal.getFontSize() / doc.internal.scaleFactor;
        x = (doc.internal.pageSize.width - urlWidth) / 2;

        // Add date and time of PDF generation


        // Iterate through form data and add to PDF
        doc.setFontSize(14);
        var y = 70;
        var total = document.getElementById('calculate_total_part3').innerHTML;
        var i = 0;
        // Iterate through form data and create a table
        var tableData = [];
        for (var pair of formData.entries()) {
            var label = '';
            var input = document.querySelector('[name="' + pair[0] + '"]');
            var select = document.querySelector('[name="' + pair[0] + '"]');
            if (input.type === 'checkbox') {
                // get all checked checkboxes with i 
                var inputId = document.querySelectorAll('[name="data-price"]:checked')[i].id;
                label = document.querySelector('[for="' + inputId + '"]').textContent;
                i++;
            } else if (input.type === 'select-one') {
                var select = document.querySelector('[name="' + pair[0] + '"]');
                label = 'Format Width ' + select.options[select.selectedIndex].textContent;
            } else if (input.type === 'radio') {
                var inputId = document.querySelector('[name="' + pair[0] + '"]:checked').id;
                label = document.querySelector('[for="' + inputId + '"]').textContent;
            } else if (input.type === 'number') {
                label = pair[0] + ' (' + pair[1] + 'm²)';
            } else {
                label = pair[0];
            }
            tableData.push([label, '€ ' + pair[1]]); // modify this line to push an array
        }

        //
        tableData.push(['Total', total]);

        // Set table column headers and options
        var tableColumns = ['Items', 'Price'];
        var tableOptions = {
            startY: y + 10,
            margin: {left: 20, right: 20},
            bodyStyles: {fontSize: 12},
            headStyles: {fontSize: 14, halign: 'left'},
            columnStyles: {
                0: {cellWidth: 'auto', fontStyle: 'bold'},
                1: {cellWidth: 'auto'}
            },
            theme: 'striped',
        };

        // Generate the table
        doc.autoTable(tableColumns, tableData, tableOptions);




        // doc.text(20, y, 'Total Price: ' + cal__result);


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

        // Save the PDF

        doc.save('texen-budgetplanner.pdf');
    }

document.getElementById('generate_pdf').addEventListener('click', generatePDF);

</script>