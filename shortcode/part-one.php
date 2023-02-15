<?php
/**
 * @package  HouseConfigurator
 */

 global $wpdb;
    // get all levels from database
    $h_type = $wpdb->prefix . 'house_configurator_type';
    $levels = $wpdb->get_results("SELECT * FROM $h_type");

    // get all features from database
    $h_feature = $wpdb->prefix . 'house_configurator_feature';
    $features = $wpdb->get_results("SELECT * FROM $h_feature");

    $house_configure_price = esc_attr( get_option( 'house_configure_price' ) );

?>
<!-- add simple bootstrap card -->
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header">
                <h5 class="card-title">House Configurator</h5>
            </div>
            <div class="card-body">
                <form action="#" method="post" id="calculate_01">
                    <div class="form-group mb-3">
                        <label for="square_meters">Surface area in square metres</label>
                        <input type="number" class="form-control" id="square_meters" name="square_meters" placeholder="Enter square meters" value="<?php echo $house_configure_price; ?>" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="levels">All Levels</label>
                        <select class="form-control" id="levels" name="levels" required>
                        <?php
                        foreach ($levels as $level) { 
                            echo '<option value="'.$level->price.'" data-id="'.$level->id.'">'.$level->name.'</option>';
                        }
                        ?>
                        </select>
                    </div>
                    <div id="features">
                    <?php
                    foreach($features as $feature){ ?>
                    <div class="form-group">
                        <?php
                            echo '<div class="form-check form-check-inline">';
                            echo '<input class="form-check-input" type="checkbox" id="feature_'.$feature->id.'" name="feature" value="'.$feature->price.'" data-type="'.$feature->type_id.'">';
                            echo '<label class="form-check-label" for="feature_'.$feature->id.'">'.$feature->name.'</label>';
                            echo '</div>';
                        ?>                       
                    </div>
                    <?php } ?>
                    </div>
                </form>
            </div>
        </div>

        <div class="card mt-5 shadow-sm">
            <div class="card-body text-center">
                <div class="card-title">
                    <h4 class="mb-3">Result</h4>
                </div>
                <div class="badge badge-primage bg-success">
                    <h3 class="mb-0 cal__result">0</h3>
                </div>
            </div>
        </div>
    </div>
</div>
