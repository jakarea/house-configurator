<div class="table-header d-flex justify-content-between mb-3">
    <h4><?php echo esc_html('Manage Options / Add Options', 'house-configurator'); ?></h4>
    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addOptionsModal">Add New</button>
</div>
<table class="table table-hover house_configurator_table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Option Name</th>
            <th>Option Price</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <!-- get wp_house_configurator_type data and foreach after set edit page and delete button -->
        <?php
            global $wpdb;
            $part_3__options = $wpdb->prefix . 'house_configurator_part_3_options';
            $options = $wpdb->get_results("SELECT * FROM $part_3__options");
            if( $options ) {
                foreach ($options as $key => $data) {
                    ?>
                    <tr>
                        <td><?php echo $key+1; ?></td>
                        <td><?php echo $data->name; ?></td>
                        <td><?php echo '€ '.$data->price; ?></td>
                        <td>
                            <a href="<?php echo admin_url('admin.php?page=house_config_house_part_three&edit_option=' . $data->id); ?>" class="button button-primary">Edit</a>
                            <a href="<?php echo admin_url('admin.php?page=house_config_house_part_three&delete_option=' . $data->id); ?>" class="button button-primary">Delete</a>
                        </td>
                    </tr>
                    <?php
                }
            }
            else {
                ?>
                <tr>
                    <td colspan="4">No Levels Found</td>
                </tr>
                <?php
            }
        ?>
    </tbody>
</table>
<?php 
    CreateOptions();
    UpdateOptions();
    deleteOption();
?>

<?php
/**
 * Create Options
 */

 function CreateOptions() {
    ?>
	<div class="modal fade" id="addOptionsModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="addOptionsModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="addOptionsModalLabel">Add New Options</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="<?php echo esc_attr('admin-post.php'); ?>" method="post" enctype="multipart/form-data">
						<input type="hidden" name="action" value="part_3_options_data_create_action" />
						<div class="form-group">
							<label for="option_name">Option Name</label>
							<input type="text" name="option_name" id="option_name" class="form-control" placeholder="Enter Options Name">
						</div>
						<div class="form-group">
							<label for="option_price">Option Price</label>
							<input type="number" name="option_price" id="option_price" class="form-control" placeholder="Enter Options Price">
						</div>
				</div>
				<div class="card-footer d-flex justify-content-between">
						<button type="submit" class="btn btn-primary btn-block">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<?php
 }

 /**
  * Update Options
  */
function UpdateOptions() {
    if (isset($_GET['edit_option'])) {
		global $wpdb;
		$part_3__options = $wpdb->prefix . 'house_configurator_part_3_options';
		$option = $wpdb->get_row("SELECT * FROM $part_3__options WHERE id = " . $_GET['edit_option']);
    ?>
        <form action="<?php echo esc_attr('admin-post.php'); ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="action" value="part_3_options_data_update_action" />
            <input type="hidden" name="id" value="<?php echo $option->id; ?>" />
            <div class="form-group">
                <label for="option_name">Option Name</label>
                <input type="text" name="option_name" id="option_name" class="form-control" value="<?php echo $option->name; ?>" placeholder="Enter Options Name">
            </div>
            <div class="form-group">
                <label for="option_price">Option Price</label>
                <input type="number" name="option_price" id="option_price" class="form-control" value="<?php echo $option->price; ?>" placeholder="Enter Options Price">
            </div>
            <button type="submit" class="btn btn-primary btn-block">Save Changes</button>
        </form>
    <?php
    }
}

function deleteOption() {
    if (isset($_GET['delete_option'])) {
		?>
			<script type="text/javascript">
				var r = confirm("Are you sure you want to delete this option?");
				if (r == true) {
					window.location.href = "<?php echo admin_url('admin-post.php?action=delete_option_data_action&option_id=' . $_GET['delete_option']); ?>";
				} else {
					window.location.href = "<?php echo admin_url('admin.php?page=house_config_house_part_three'); ?>";
				}
			</script>
		<?php
	}
}