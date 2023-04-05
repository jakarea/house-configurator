<?php
/**
 * @package  HouseConfigurator
 */
// get all post from house-configurator
$houses = get_posts( array(
    'post_type' => 'house-configurator',
    'posts_per_page' => -1,
) );

?>
<!-- add bootstrap card first 8 then last 4 in row -->
<div class="container">
    <div class="row">
        <?php if ( count($houses) > 0 ) : ?>
        <?php foreach ($houses as $house) : ?>
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $house->post_title; ?></h5>
                        <p class="card-text"><?php echo $house->excerpt; ?></p>
                        <a href="<?php echo get_permalink($house->ID); ?>" class="btn btn-primary">Read More</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <?php else :
            echo 'No House Found!';
        endif; ?>
    </div>
</div>