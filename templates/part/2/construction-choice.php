<div class="wrap">
	<h1><?php echo esc_html('Manage BTW', 'house-configurator'); ?></h1>
	<?php settings_errors(); ?>
	<ul class="nav nav-tabs">
		<li class="active"><a href="#btw-tab-1"><?php echo esc_html('Manage BTW', 'house-configurator'); ?></a></li>
		<li><a href="#btw-tab-2"><?php echo esc_html('Add New BTW', 'house-configurator')?></a></li>
	</ul>
    <!-- where you here about us -->
    <div class="tab-content">
        <div id="btw-tab-1" class="tab-pane active">
            <h3>Manage BTW</h3>
            <!-- table for contact list -->
            <table class="table table-hover house_configurator_table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>BTW Name</th>
                        <th>BTW Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // get data from wp table name [wp_house_configurator_part_2] with prefix
                    global $wpdb;
                    $table_name = $wpdb->prefix . 'house_configurator_part_2';
                    $btw_list = $wpdb->get_var("SELECT value FROM $table_name WHERE name = 'btw_list'");
                    $btw_list = json_decode($btw_list, true);
                    // loop for contact list
                    foreach ($btw_list as $key => $value) {
                        ?>
                        <tr>
                            <td><?php echo $key + 1; ?></td>
                            <td><?php echo $value['name']; ?></td>
                            <td><?php echo '€ '.$value['value']; ?></td>
                            <td>
                                <a href="<?php echo admin_url('admin.php?page=house_config_house_part_two&edit_b_t_w=' . $value['name']); ?>" class="button button-primary">Edit</a>
                                <a href="<?php echo admin_url('admin.php?page=house_config_house_part_two&delet_b_t_w=' . $value['name']); ?>" class="button button-primary">Delete</a>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
            <?php updateFormForBTW(); ?>
        </div>
        <div id="btw-tab-2" class="tab-pane fade">
            <h3>Add New BTW</h3>
            <?php createFormforBTW(); ?>
            <?php deleteBTW(); ?>
        </div>
    </div>
</div>

<?php
/**
 * Create form for hear from us
 */
function createFormforBTW() {
    // add form for create name and price
    ?>
    <form action="<?php echo esc_attr('admin-post.php'); ?>" method="post">
        <input type="hidden" name="action" value="btw_data_action" />
        <table class="form-table">
            <tr class="example-class">
                <th scope="row">BTW Name</th>
                <td><input type="text" name="btw_name" value="" class="regular-text" /></td>
            </tr>
            <tr class="example-class">
                <th scope="row">BTW Price</th>
                <td><input type="text" name="btw_price" value="" class="regular-text" /></td>
            </tr>
        </table>
        <?php submit_button('Add New', 'primary', 'btnSubmit'); ?>
    </form>
    <?php
}

/**
 * Update form for hear from us
 */
function updateFormForBTW() {
    // add form for update name and price
    if ( isset( $_GET['edit_b_t_w'] ) ) {
        $btw_name = $_GET['edit_b_t_w'];
        // find the name from edit_b_t_w to btw_list json array name and show the form
        global $wpdb;
        $table_name = $wpdb->prefix . 'house_configurator_part_2';
        $btw_list = $wpdb->get_var("SELECT value FROM $table_name WHERE name = 'btw_list'");
        $btw_list = json_decode($btw_list, true);
        foreach($btw_list as $btw) {
            if($btw['name'] == $btw_name) {
                $selected_btw = $btw;
                break;
            }
        }
        ?>
        <!-- form -->
        <form action="<?php echo esc_attr('admin-post.php'); ?>" method="post">
            <input type="hidden" name="action" value="btw_data_update_action" />
            <input type="hidden" name="btw_name_update" value="<?php echo $selected_btw['name']; ?>" />
            <table class="form-table">
                <tr class="example-class">
                    <th scope="row">BTW Name</th>
                    <td><input type="text" name="btw_name" value="<?php echo $selected_btw['name']; ?>" class="regular-text" /></td>
                </tr>
                <tr class="example-class">
                    <th scope="row">BTW Price</th>
                    <td><input type="text" name="btw_price" value="<?php echo $selected_btw['value']; ?>" class="regular-text" /></td>
                </tr>
            </table>
            <?php submit_button('Update', 'primary', 'btnSubmit'); ?>
        </form>
        <?php
    }    
}


/**
 * Delete BTW
 */
function deleteBTW() {
    // delete the name and price from btw_list json array
    if (isset($_GET['delet_b_t_w'])) {
        // delete btw_list name with confirm message and set name to $_GET['delet_b_t_w'] then send to function
        $btw_name = $_GET['delet_b_t_w'];
        ?>
        <script>
            var r = confirm("Are you sure you want to delete this?");
            if (r == true) {
                window.location.href = "<?php echo admin_url('admin-post.php?action=btw_data_delete_action&btw_name' . $btw_name); ?>";
            } else {
                window.location.href = "<?php echo admin_url('admin.php?page=house_config_house_part_two'); ?>";
            }
        </script>
        <?php
    }
}