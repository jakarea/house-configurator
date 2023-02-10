<?php
/**
 * @package  HouseConfigurator
 */
?>
<div class="wrap mt-5">
    <h1>Features Manage</h1>
    <?php settings_errors(); ?>
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab-1">Features</a></li>
        <li><a href="#tab-2">Create Feature</a></li>
    </ul>
    <div class="tab-content">
        <div id="tab-1" class="tab-pane active">
            <h3>Features List</h3>
            <!-- feature list table from wp table wp_house_configurator_feature with level name based on level id -->
            <table class="table table-hover house_configurator_table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Feature Name</th>
                        <th>Feature Price</th>
                        <th>Level Name</th>
                        <th>Actions</th>
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
                                        <a href="<?php echo admin_url('admin.php?page=house_config_features&edit=' . $feature->id); ?>" class="button button-primary">Edit</a>
                                        <a href="<?php echo admin_url('admin.php?page=house_config_features&delete=' . $feature->id); ?>" class="button button-primary">Delete</a>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        else {
                            ?>
                            <tr>
                                <td colspan="5">No Features Found</td>
                            </tr>
                            <?php
                        }
                    ?>                    
                </tbody>
            </table>
            <?php ediFeatureForm(); ?>
            <?php deleteFeature(); ?>
        </div>
        <div id="tab-2" class="tab-pane">
            <h3>Create Feature</h3>
            <?php createFeatureForm(); ?>
        </div>
    </div>
</div>

<?php
/**
 * Create Feature Form
 */
function createFeatureForm() {
    ?>
    <!-- create features form for wp_house_configurator_feature table -->
    <form action="<?php echo esc_attr('admin-post.php'); ?>" method="post">
        <input type="hidden" name="action" value="create_feature_action">
        <!-- table -->
        <table class="form-table">
            <tbody>
                <tr>
                    <th scope="row"><label for="feature_name">Feature Name</label></th>
                    <td><input name="feature_name" type="text" id="feature_name" value="" class="regular-text"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="feature_price">Feature Price</label></th>
                    <td><input name="feature_price" type="text" id="feature_price" value="" class="regular-text"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="feature_level">Feature Level</label></th>
                    <td>
                        <!-- feature level with checkbox -->
                        <?php
                            global $wpdb;
                            $house_levels = $wpdb->prefix . 'house_configurator_type';
                            $levels = $wpdb->get_results("SELECT * FROM $house_levels");
                            if( $levels ) {
                                foreach ($levels as $key => $level) {
                                    ?>
                                    <input type="checkbox" name="feature_level[]" class="mr-3" id="feature_level_<?php echo $level->id ?>" value="<?php echo $level->id; ?>">
                                     <label for="feature_level_<?php echo $level->id ?>"><?php echo $level->name; ?></label>
                                    <?php
                                }
                            }
                        ?>
                    </td>
                </tr>
            </tbody>
        </table>
        <?php submit_button('Create Feature', 'primary', 'submit_feature'); ?>
    </form>
    <?php
}

/**
 * Edit Feature Form
 */
function ediFeatureForm() {
    if( isset($_GET['edit']) ) {
        global $wpdb;
        $house_features = $wpdb->prefix . 'house_configurator_feature';
        $feature = $wpdb->get_row("SELECT * FROM $house_features WHERE id = $_GET[edit]");  
    ?>
    <!-- edit features form for wp_house_configurator_feature table -->
    <form action="<?php echo esc_attr('admin-post.php'); ?>" method="post">
        <input type="hidden" name="action" value="edit_feature_action">
        <input type="hidden" name="feature_id" value="<?php echo $feature->id; ?>">
        <!-- table -->
        <table class="form-table">
            <tbody>
                <tr>
                    <th scope="row"><label for="feature_name">Feature Name</label></th>
                    <td><input name="feature_name" type="text" id="feature_name" value="<?php echo $feature->name; ?>" class="regular-text"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="feature_price">Feature Price</label></th>
                    <td><input name="feature_price" type="text" id="feature_price" value="<?php echo $feature->price; ?>" class="regular-text"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="feature_level">Feature Level</label></th>
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
    if( isset($_GET['delete']) ) {
       ?>
        <script type="text/javascript">
            var r = confirm("Are you sure you want to delete this feature?");
            if (r == true) {
                window.location.href = "<?php echo admin_url('admin-post.php?action=delete_feature_data_action&feature_id=' . $_GET['delete']); ?>";
            } else {
                window.location.href = "<?php echo admin_url('admin.php?page=house_config_levels'); ?>";
            }
        </script>
        <?php
    }
}