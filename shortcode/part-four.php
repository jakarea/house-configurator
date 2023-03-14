<?php
/**
 * @package  HouseConfigurator
 */

 
//  get all post from custom post type name house_model
$house_model = new WP_Query(array(
    'post_type' => 'house_model',
    'posts_per_page' => -1,
    'order' => 'ASC'
));

?>

<!-- Design Form for 1st step -->
<div class="row col-8 justify-content-center offset-md-2 d-none">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="m-0"><?php echo esc_html('Start your kitchen calculation here. AB', 'house-configurator'); ?></h3>
            </div>
            <div class="card-body">
                <!-- heading name and icon, it can be user icon for wordpress -->
                <div class="heading-form justify-content-center">
                    <h6 class="m-0"><span class="dashicons dashicons-admin-users bg-light rounded"> </span> <?php echo esc_html('Whose is this budget plan?', 'house-configurator'); ?></h6>
                </div>
                <hr class="my-2" />
                <!-- form with two column -->
                <div class="row mt-3">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="radio" name="mr" id="mr">
                            <label for="mr"><?php echo esc_html('Mr.', 'house-configurator'); ?></label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input type="radio" name="mr" id="mrs">
                            <label for="mrs"><?php echo esc_html('Mrs.', 'house-configurator'); ?></label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="name"><?php echo esc_html('Name', 'house-configurator'); ?></label>
                            <input type="text" name="name" id="name" class="form-control form-control-sm">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="lastname"><?php echo esc_html('Last Name', 'house-configurator'); ?></label>
                            <input type="text" name="lastname" id="lastname" class="form-control form-control-sm">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="heading-form justify-content-center">
                            <h6 class="m-0"><span class="dashicons dashicons-phone bg-light rounded"> </span> <?php echo esc_html('Wat zijn je contactgegevens?', 'house-configurator'); ?></h6>
                        </div>
                        <hr class="my-2" />
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="email"><?php echo esc_html('Email', 'house-configurator'); ?></label>
                            <input type="email" name="email" id="email" class="form-control form-control-sm">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="phone"><?php echo esc_html('Phone', 'house-configurator'); ?></label>
                            <input type="text" name="phone" id="phone" class="form-control form-control-sm">
                        </div>
                    </div>
                    <!-- condition check if agree -->
                    <div class="col-12">
                        <div class="form-group">
                            <input type="checkbox" name="agree" id="agree">
                            <label for="agree"><?php echo esc_html('Brugman may approach me for offers that may be of interest to me. (By e-mail, telephone and/or by post). You can unsubscribe from this at any time.', 'house-configurator'); ?></label>
                        </div>
                    </div>
                    <!-- button submit -->
                    <div class="col-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn-info"><?php echo esc_html('Start the budget planner', 'house-configurator'); ?></button>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <p><?php echo esc_html('We process your personal data in accordance with our privacy policy. You can find this policy here . If you continue to fill out the form, we assume that you have read our policy.', 'house-configurator'); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- All post -->
<div class="row col-8 justify-content-center mt-4 offset-md-2">
    <?php while ($house_model->have_posts()) : $house_model->the_post(); ?>
        <div class="col-4">
            <div class="card text-center card-hover py-3">
                <a href="#" data-toggle="modal" data-target="#postModal_<?php echo get_the_ID(); ?>">
                    <?php the_post_thumbnail('full', array('class' => 'text-center m-auto', 'width' => '180px')); ?>
                </a>
            </div>
        </div>
        <!-- modal -->
        <div class="modal fade" id="postModal_<?php echo get_the_ID(); ?>" tabindex="-1" role="dialog" aria-labelledby="postModal_<?php echo get_the_ID(); ?>" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <button type="button" class="close p-2 text-end text-right" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="modal-body">
                        <form method="get" action="<?php echo esc_url(get_permalink()); ?>?form_submitted=true">
                            <div class="row">
                                <div class="col-12 justify-content-center">
                                    <div class="body-head-text d-flex justify-content-between">
                                        <h4 class="m-0"><?php echo get_the_title(); ?></h4>
                                        <?php the_post_thumbnail('full', array('class' => 'text-right', 'width' => '30px')); ?>
                                    </div>
                                </div>

                                <div class="form-group mt-3 col-12 row">
                                    <label for="Dimension A" class="col-4 col-form-label"><?php echo esc_html('Dimension A', 'house-configurator'); ?></label>
                                    <div class="col-8">
                                        <input type="number" name="dimensionA" class="form-control form-control-sm" id="dimension" placeholder="In centimeters" />
                                    </div>
                                </div>

                                <div class="form-group mt-3 col-12 row">
                                    <label for="Dimension A" class="col-4 col-form-label"><?php echo esc_html('Dimension B', 'house-configurator'); ?></label>
                                    <div class="col-8">
                                        <input type="number" name="dimensionB" class="form-control form-control-sm" id="dimension" placeholder="In centimeters" />
                                    </div>
                                </div>
                            </div>
                        
                    </div>
                    <div class="modal-footer d-flex justify-content-between">
                        <a href="#" id="user_dimension"><?php echo esc_html('Use standard dimensions', 'house-configurator'); ?></a>
                        <button type="submit" class="btn btn-info btn-sm"><?php echo esc_html('Use Dimension', 'house-configurator'); ?></button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <script>
            jQuery(document).ready(function($) {
                $('#user_dimension').click(function() {
                    $('input[name="dimensionA"]').val('250');
                    $('input[name="dimensionB"]').val('150');
                });
            });
        </script>
   <?php endwhile; ?>
</div>