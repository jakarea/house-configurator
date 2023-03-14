<div class="tab-pane fade" id="h__tabs-features" role="tabpanel" aria-labelledby="h__tabs-feature-tab">
    <div class="table-header d-flex justify-content-between mb-3">
        <h4><?php echo esc_html('Manage Features / Add Features', 'house-configurator'); ?></h4>
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addFeatureModal"><?php echo esc_html('Add New', 'house-configurator'); ?></button>
    </div>
    <table class="table table-hover house_configurator_table">
        <thead>
            <tr>
                <th><?php echo esc_html('ID', 'house-configurator'); ?></th>
                <th><?php echo esc_html('Feature Name', 'house-configurator'); ?></th>
                <th><?php echo esc_html('Feature Price', 'house-configurator'); ?></th>
                <th><?php echo esc_html('Level Name', 'house-configurator'); ?></th>
                <th><?php echo esc_html('Actions', 'house-configurator'); ?></th>
            </tr>
        </thead>
        <tbody>
            <!-- get wp_house_configurator_feature data and foreach after set edit page and delete button -->
            <?php
                global $wpdb;
                $house_features = $wpdb->prefix . 'house_configurator_feature';
                $features = $wpdb->get_results("SELECT * FROM $house_features");
                if( $features ) {
                    foreach ($features as $key => $feature) {
                        ?>
                        <tr>
                            <td><?php echo $key+1; ?></td>
                            <td><?php echo $feature->name; ?></td>
                            <td><?php echo '€ '. $feature->price; ?></td>
                            <td>
                                <?php
                                    $house_levels = $wpdb->prefix . 'house_configurator_type';
                                    // take array from type_id and show name
                                    $type_id = explode(',', $feature->type_id);
                                    // if type_id is equal 0 then no level
                                    if( $type_id[0] == 0 ) {
                                        echo 'No Level';
                                    }
                                    else {
                                        foreach ($type_id as $key => $id) {
                                            $level = $wpdb->get_row("SELECT * FROM $house_levels WHERE id = $id");
                                            echo $level->name . ', ';
                                        }
                                    }
                                ?>
                            </td>
                            <td>
                                <a href="<?php echo admin_url('admin.php?page=house_config_house_part_one&edit_feature=' . $feature->id); ?>" class="button button-primary"><?php echo esc_html('Edit', 'house-configurator'); ?></a>
                                <a href="<?php echo admin_url('admin.php?page=house_config_house_part_one&delete_feature=' . $feature->id); ?>" class="button button-primary"><?php echo esc_html('Delete', 'house-configurator'); ?></a>
                            </td>
                        </tr>
                        <?php
                    }
                }
                else {
                    ?>
                    <tr>
                        <td colspan="5"><?php echo esc_html('No Features Found', 'house-configurator'); ?></td>
                    </tr>
                    <?php
                }
            ?>                    
        </tbody>
    </table>
    <?php createFeatureForm(); ?>
    <?php ediFeatureForm(); ?>
    <?php deleteFeature(); ?>
</div>

<?php
/**
 * Create Feature Form
 */
function createFeatureForm() {
    ?>
    <!-- create features form for wp_house_configurator_feature table -->
	<div class="modal fade" id="addFeatureModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="addFeatureModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addFeatureModalfeature"><?php echo esc_html('Add New Feature', 'house-configurator'); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo esc_attr('admin-post.php'); ?>" method="post">
                        <input type="hidden" name="action" value="create_feature_action" />
                        <div class="form-group">
                            <label for="feature_name"><?php echo esc_html('Feature Name', 'house-configurator'); ?></label>
                            <input type="text" name="feature_name" id="feature_name" class="form-control" placeholder="Enter Feature Name">
                        </div>
                        <div class="form-group">
                            <label for="feature_price"><?php echo esc_html('Feature Price', 'house-configurator'); ?></label>
                            <input type="text" name="feature_price" id="feature_price" class="form-control" placeholder="Enter Feature Price">
                        </div>
                        <div class="form-group">
                            <label for="Level"><?php echo esc_html('Level Type', 'house-configurator'); ?></label><br>
                            <div class="form-check form-check-inline">
                                <?php
                                    global $wpdb;
                                    $house_levels = $wpdb->prefix . 'house_configurator_type';
                                    $levels = $wpdb->get_results("SELECT * FROM $house_levels");
                                    if( $levels ) {
                                        foreach ($levels as $key => $level) {
                                            ?>
                                            <input type="checkbox" name="feature_level[]" class="form-check-input" id="feature_level_<?php echo $level->id ?>" value="<?php echo $level->id; ?>">
                                            <label for="feature_level_<?php echo $level->id ?>" class="form-check-label mr-2"><?php echo $level->name; ?></label>
                                            <?php
                                        }
                                    }
                                ?>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo esc_html('Close', 'house-configurator'); ?></button>
                            <button type="submit" name="submit_feature" class="btn btn-primary"><?php echo esc_html('Create Feature', 'house-configurator'); ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
}

/**
 * Edit Feature Form
 */
function ediFeatureForm() {
    if( isset($_GET['edit_feature']) ) {
        global $wpdb;
        $house_features = $wpdb->prefix . 'house_configurator_feature';
        $feature = $wpdb->get_row("SELECT * FROM $house_features WHERE id = $_GET[edit_feature]");  
    ?>
    <!-- edit features form for wp_house_configurator_feature table -->
    <form action="<?php echo esc_attr('admin-post.php'); ?>" method="post">
        <input type="hidden" name="action" value="edit_feature_action">
        <input type="hidden" name="feature_id" value="<?php echo $feature->id; ?>">
        <!-- table -->
        <table class="form-table">
            <tbody>
                <tr>
                    <th scope="row"><label for="feature_name"><?php echo esc_html('Feature Name', 'house-configurator'); ?></label></th>
                    <td><input name="feature_name" type="text" id="feature_name" value="<?php echo $feature->name; ?>" class="regular-text"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="feature_price"><?php echo esc_html('Feature Price', 'house-configurator'); ?></label></th>
                    <td><input name="feature_price" type="text" id="feature_price" value="<?php echo $feature->price; ?>" class="regular-text"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="feature_level"><?php echo esc_html('Feature Level', 'house-configurator'); ?></label></th>
                    <td>
                        <!-- feature_level[] array with checkbox if id matched then chcecked -->
                        <?php
                            global $wpdb;
                            $house_levels = $wpdb->prefix . 'house_configurator_type';
                            $levels = $wpdb->get_results("SELECT * FROM $house_levels");
                            $feature_level = explode(',', $feature->type_id);
                            foreach($feature_level as $key => $value) {
                                $feature_level[$key] = (int)$value;
                            }
                            foreach ($levels as $level) {
                                echo '<input type="checkbox" name="feature_level[]" class="mr-3" id="feature_level_' . $level->id . '" value="' . $level->id . '" ' . (in_array($level->id, $feature_level) ? 'checked' : '') . '>';
                                echo '<label for="feature_level_' . $level->id . '">' . $level->name . '</label>&nbsp;';
                            }
                        ?>
                    </td>
                </tr>
            </tbody>
        </table>
        <?php submit_button('Update Feature', 'primary', 'submit_feature'); ?>
    </form>
    <?php
    }
}

/**
 * Delete Feature
 */

function deleteFeature() {
    if( isset($_GET['delete_feature']) ) {
       ?>
        <script type="text/javascript">
            var r = confirm("Are you sure you want to delete this feature?");
            if (r == true) {
                window.location.href = "<?php echo admin_url('admin-post.php?action=delete_feature_data_action&feature_id=' . $_GET['delete_feature']); ?>";
            } else {
                window.location.href = "<?php echo admin_url('admin.php?page=house_config_house_part_one'); ?>";
            }
        </script>
        <?php
    }
}