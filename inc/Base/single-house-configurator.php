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
                    $image_id = get_term_meta( $terms[0]->term_id, 'feature_image_id', true );
                    $image_url = wp_get_attachment_image_src( $image_id, 'full' );
                    ?>
                    <img src="<?php echo $image_url[0]; ?>" class="img-fluid w-100" id="feature_img" alt="Responsive image">
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
                    <tr id="levels_type">
                        <?php
                        // get the level taxonomy based on the house ID and show thumbnail_id image and set first image as active
                        $terms = get_the_terms( $house_id, 'level' );
                        $i = 0;
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
                        <form action="#">
                            <?php
                            // get the level taxonomy
                            $levels = get_the_terms( $house_id, 'level' );
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
                            ?>
                            <div class="format-box d-flex justify-content-between mt-3">
                                <div class="formet-width">
                                    <h6 class="m-1 text-white">Format Width</h6>
                                    <div class="form-group">
                                        <select name="format_width" id="format_width" class="form-select form-control-sm">
                                            <option value="0">2.00m</option>
                                            <option value="3">3.00m</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="formet-depth">
                                    <h6 class="m-1 text-white">Format Width</h6>
                                    <div class="form-group">
                                        <select name="format_depth" id="format_depth" class="form-select form-control-sm">
                                            <option value="2">2.00m</option>
                                            <option value="2.5">2.50m</option>
                                            <option value="3">3.00m</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="option-list-p-3">
                                <h6 class="m-1 text-white">Feature</h6>
                                <?php
                                $options = get_terms( 'option' );
                                
                                foreach($options as $key => $option){
                                    $option_price = get_term_meta( $option->term_id, '_house_configurator_price_option', true );
                                    ?>
                                    <div class="form-group mb-2 options_data">
                                        <div class="form-check text-light">
                                            <input class="form-check-input" type="checkbox" name="data-price" id="option_<?php echo $option->term_id; ?>" value="a" data-price="<?php echo $option_price; ?>">
                                            <label class="form-check-label" for="option_<?php echo $option->term_id; ?>"><?php echo $option->name; ?></label>
                                        </div>
                                    </div>
                                <?php
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
                        $level_price = get_term_meta( $levels[0]->term_id, '_house_configurator_price', true );
                    ?>
                    <h5 class="m-0 text-white" id="calculate_total_part3" data-price="<?php echo $price; ?>">
                        <?php
                        echo '€ ' . $price+$level_price;
                        ?>
                    </h5>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();
?>