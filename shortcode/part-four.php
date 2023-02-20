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
                <h3 class="m-0">Start your kitchen calculation here. AB</h3>
            </div>
            <div class="card-body">
                <!-- heading name and icon, it can be user icon for wordpress -->
                <div class="heading-form justify-content-center">
                    <h6 class="m-0"><span class="dashicons dashicons-admin-users bg-light rounded"> </span> Whose is this budget plan?</h6>
                </div>
                <hr class="my-2" />
                <!-- form with two column -->
                <div class="row mt-3">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="radio" name="mr" id="mr">
                            <label for="mr">Mr.</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input type="radio" name="mr" id="mrs">
                            <label for="mrs">Mrs.</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control form-control-sm">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="lastname">Lastname</label>
                            <input type="text" name="lastname" id="lastname" class="form-control form-control-sm">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="heading-form justify-content-center">
                            <h6 class="m-0"><span class="dashicons dashicons-phone bg-light rounded"> </span> Wat zijn je contactgegevens?</h6>
                        </div>
                        <hr class="my-2" />
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control form-control-sm">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" name="phone" id="phone" class="form-control form-control-sm">
                        </div>
                    </div>
                    <!-- condition check if agree -->
                    <div class="col-12">
                        <div class="form-group">
                            <input type="checkbox" name="agree" id="agree">
                            <label for="agree">Brugman may approach me for offers that may be of interest to me. (By e-mail, telephone and/or by post). You can unsubscribe from this at any time.</label>
                        </div>
                    </div>
                    <!-- button submit -->
                    <div class="col-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn-info">Start the budget planner</button>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <p>We process your personal data in accordance with our privacy policy. You can find this policy here . If you continue to fill out the form, we assume that you have read our policy.</p>
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
                        <div class="row">
                            <div class="col-12 justify-content-center">
                                <div class="body-head-text d-flex justify-content-between">
                                    <h4 class="m-0"><?php echo get_the_title(); ?></h4>
                                    <?php the_post_thumbnail('full', array('class' => 'text-right', 'width' => '30px')); ?>
                                </div>
                            </div>

                            <div class="form-group mt-3 col-12 row">
                                <label for="Dimension A" class="col-4 col-form-label">Dimension A</label>
                                <div class="col-8">
                                    <input type="number" class="form-control form-control-sm" id="dimension" placeholder="In centimeters" >
                                </div>
                            </div>

                            <div class="form-group mt-3 col-12 row">
                                <label for="Dimension A" class="col-4 col-form-label">Dimension B</label>
                                <div class="col-8">
                                    <input type="number" class="form-control form-control-sm" id="dimension" placeholder="In centimeters" >
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-between">
                        <a href="#">Use standard dimensions</a>
                        <!-- post permalink with set custom attribute -->
                        <a href="<?php echo get_permalink(); ?>" class="btn btn-info btn-sm" data-post-id="<?php echo get_the_ID(); ?>">Use Dimension</a>
                    </div>
                </div>
            </div>
        </div>
   <?php endwhile; ?>
    <!-- <div class="col-4">
        <div class="card text-center card-hover py-3">
            <a href="#" data-toggle="modal" data-target="#exampleModal">
                <img src="https://s.brugman.nl/_processed_/5/5/csm_rechthoekopstelling_58184d6bc3.jpg" class="text-center m-auto" width="180px" alt="...">
            </a>
        </div>
    </div> -->
    <!-- <div class="col-4">
        <div class="card text-center card-hover py-3">
            <a href="#" data-toggle="modal" data-target="#exampleModal">
                <img src="https://s.brugman.nl/_processed_/1/a/csm_Brugman%20rechthoekige%20keuken_c893739822.jpg" class="text-center m-auto" width="180px" alt="...">
            </a>
        </div>
    </div>
    <div class="col-4">
        <div class="card text-center card-hover py-3">
            <a href="#" data-toggle="modal" data-target="#exampleModal">
                <img src="https://s.brugman.nl/_processed_/0/a/csm_Hoekopstelling%20%281%29_dc235f0ba0.jpg" class="text-center m-auto" width="180px" alt="...">
            </a>
        </div>
    </div> -->
</div>