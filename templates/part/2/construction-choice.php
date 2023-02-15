<div class="table-header d-flex justify-content-between mb-3">
    <h4><?php echo esc_html('Manage Levels / Add Levels', 'house-configurator'); ?></h4>
    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addBTWModal">Add New</button>
</div>
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
        // loop for BTW list
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
<?php createFormforBTW(); ?>
<?php updateFormForBTW(); ?>
<?php deleteBTW(); ?>

<?php
/**
 * Create form for hear from us
 */
function createFormforBTW() {
    // add form for create name and price
    ?>
    <div class="modal fade" id="addBTWModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="addBTWModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="addBTWModalLabel">Add New BTW</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="<?php echo esc_attr('admin-post.php'); ?>" method="post">
                        <input type="hidden" name="action" value="btw_data_action" />
						<div class="form-group">
							<label for="btw_name">BTW Name</label>
							<input type="text" name="btw_name" id="btw_name" class="form-control" placeholder="Enter text">
						</div>
						<div class="form-group">
							<label for="btw_price">BTW Price</label>
							<input type="number" name="btw_price" id="btw_price" class="form-control" placeholder="Enter price">
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-primary">Add Level</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
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