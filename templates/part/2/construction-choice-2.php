<div class="table-header d-flex justify-content-between mb-3">
    <h4><?php echo esc_html('Manage AF / Add AF', 'house-configurator'); ?></h4>
    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addAFModal">Add New</button>
</div>
<!-- table for contact list -->
<table class="table table-hover house_configurator_table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Afplakken Name</th>
            <th>Afplakken Price</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // get data from wp table name [wp_house_configurator_part_2] with prefix
        global $wpdb;
        $table_name = $wpdb->prefix . 'house_configurator_part_2';
        $aff_list = $wpdb->get_var("SELECT value FROM $table_name WHERE name = 'afplakken_list'");
        $aff_list = json_decode($aff_list, true);
        // loop for contact list
        if($aff_list > 0) {
            foreach ($aff_list as $key => $value) {
                ?>
                 <tr>
                    <td><?php echo $key + 1; ?></td>
                     <td><?php echo $value['name']; ?></td>
                     <td><?php echo '€ '.$value['value']; ?></td>
                     <td>
                         <a href="<?php echo admin_url('admin.php?page=house_config_house_part_two&edit_a_f=' . $value['name']); ?>" class="button button-primary">Edit</a>
                         <a href="<?php echo admin_url('admin.php?page=house_config_house_part_two&delet_a_f=' . $value['name']); ?>" class="button button-primary">Delete</a>
                     </td>
                 </tr>
            <?php
            }
        }
        else {
            ?>
            <tr>
                <td colspan="5">No AF Found</td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>
<?php createFormforAF(); ?>
<?php deleteAF(); ?>
<?php updateFormForAF(); ?>

<?php
/**
 * Create form for hear from us
 */
function createFormforAF() {
    // add form for create name and price
    ?>
    <div class="modal fade" id="addAFModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="addAFModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="addAFModalLabel">Add New AF</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="<?php echo esc_attr('admin-post.php'); ?>" method="post">
                        <input type="hidden" name="action" value="afplakken_data_action" />
						<div class="form-group">
							<label for="afplakken_name">Afplakken Name</label>
							<input type="text" name="afplakken_name" id="afplakken_name" class="form-control" placeholder="Enter Name">
						</div>
						<div class="form-group">
							<label for="afplakken_price">Afplakken Price</label>
							<input type="number" name="afplakken_price" id="afplakken_price" class="form-control" placeholder="Enter Price">
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
function updateFormForAF() {
    // add form for update name and price
    if ( isset( $_GET['edit_a_f'] ) ) {
        $af_name = $_GET['edit_a_f'];
        // find the name from edit_b_t_w to btw_list json array name and show the form
        global $wpdb;
        $table_name = $wpdb->prefix . 'house_configurator_part_2';
        $aff_list = $wpdb->get_var("SELECT value FROM $table_name WHERE name = 'afplakken_list'");
        $aff_list = json_decode($aff_list, true);

        foreach($aff_list as $af) {
            if($af['name'] == $af_name) {
                $selected_af = $af;
                break;
            }
        }
        ?>
        <!-- form -->
        <form action="<?php echo esc_attr('admin-post.php'); ?>" method="post">
            <input type="hidden" name="action" value="btw_data_update_action" />
            <input type="hidden" name="aff_name_update" value="<?php echo $af_name; ?>" />
            <table class="form-table">
                <tr class="example-class">
                    <th scope="row">Afplakken Name</th>
                    <td><input type="text" name="afplakken_name" value="<?php echo $selected_af['name']; ?>" class="regular-text" /></td>
                </tr>
                <tr class="example-class">
                    <th scope="row">Afplakken Price</th>
                    <td><input type="text" name="afplakken_price" value="<?php echo $selected_af['value']; ?>" class="regular-text" /></td>
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
function deleteAF() {
    // delete the name and price from btw_list json array
    if (isset($_GET['delet_a_f'])) {
        // delete btw_list name with confirm message and set name to $_GET['delet_b_t_w'] then send to function
        $btw_name = $_GET['delet_a_f'];
        ?>
        <script>
            var r = confirm("Are you sure you want to delete this?");
            if (r == true) {
                window.location.href = "<?php echo admin_url('admin-post.php?action=btw_data_delete_action&afplakken_name' . $btw_name); ?>";
            } else {
                window.location.href = "<?php echo admin_url('admin.php?page=house_config_house_part_two'); ?>";
            }
        </script>
        <?php
    }
}