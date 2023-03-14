<div class="tab-pane fade" id="h__tabs-levels" role="tabpanel" aria-labelledby="h__tabs-levels-tab">
	<div class="table-header d-flex justify-content-between mb-3">
		<h4><?php echo esc_html('Manage Levels / Add Levels', 'house-configurator'); ?></h4>
		<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addLevelModal"><?php echo esc_html('Add New', 'house-configurator'); ?></button>
	</div>
	<table class="table table-hover house_configurator_table">
		<thead>
			<tr>
				<th><?php echo esc_html('ID', 'house-configurator'); ?></th>
				<th><?php echo esc_html('Level Name', 'house-configurator'); ?></th>
				<th><?php echo esc_html('Level Price', 'house-configurator'); ?></th>
				<th><?php echo esc_html('Actions', 'house-configurator'); ?></th>
			</tr>
		</thead>
		<tbody>
			<!-- get wp_house_configurator_type data and foreach after set edit page and delete button -->
			<?php
				global $wpdb;
				$house_levels = $wpdb->prefix . 'house_configurator_type';
				$levels = $wpdb->get_results("SELECT * FROM $house_levels");
				if( $levels ) {
					foreach ($levels as $key => $level) {
						?>
						<tr>
							<td><?php echo $key+1; ?></td>
							<td><?php echo $level->name; ?></td>
							<td><?php echo '€ '.$level->price; ?></td>
							<td>
								<a href="<?php echo admin_url('admin.php?page=house_config_house_part_one&edit_level=' . $level->id); ?>" class="button button-primary"><?php echo esc_html('Edit', 'house-configurator'); ?></a>
								<a href="<?php echo admin_url('admin.php?page=house_config_house_part_one&delete_level=' . $level->id); ?>" class="button button-primary"><?php echo esc_html('Delete', 'house-configurator'); ?></a>
							</td>
						</tr>
						<?php
					}
				}
				else {
					?>
					<tr>
						<td colspan="4"><?php echo esc_html('No Levels Found', 'house-configurator'); ?></td>
					</tr>
					<?php
				}
			?>
			
		</tbody>
	</table>
	<?php updateLevel(); ?>
	<?php createFormforLevel(); ?>
	<?php deleteLevel(); ?>
</div>
<?php
/**
 * Create form for level name and price
 */
function createFormforLevel() {
	// create form for lavel name and price with lebel name and price
	?>
	<div class="modal fade" id="addLevelModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="addLevelModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="addLevelModalLabel"><?php echo esc_html('Add New Level', 'house-configurator'); ?></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="<?php echo esc_attr('admin-post.php'); ?>" method="post">
						<input type="hidden" name="action" value="level_data_action" />
						<div class="form-group">
							<label for="level_name"><?php echo esc_html('Level Name', 'house-configurator'); ?></label>
							<input type="text" name="level_name" id="level_name" class="form-control" placeholder="Enter Level Name">
						</div>
						<div class="form-group">
							<label for="level_price"><?php echo esc_html('Level Price', 'house-configurator'); ?></label>
							<input type="number" name="level_price" id="level_price" class="form-control" placeholder="Enter Level Price">
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-primary"><?php echo esc_html('Add Level', 'house-configurator'); ?></button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<?php
}

/**
 * Update level name and price
 */
function updateLevel() {
	if (isset($_GET['edit_level'])) {
		global $wpdb;
		$house_levels = $wpdb->prefix . 'house_configurator_type';
		$level = $wpdb->get_row("SELECT * FROM $house_levels WHERE id = " . $_GET['edit_level']);
		?>
			<form action="<?php echo esc_attr('admin-post.php'); ?>" method="post">
		    	<input type="hidden" name="action" value="edit_level_data_action" />
		    	<input type="hidden" name="level_id" value="<?php echo $level->id; ?>" />
			
				<table class="form-table">
					<tr class="example-class">
						<td>
							<label for="level_name"><?php echo esc_html('Level Name', 'house-configurator'); ?></label>
						</td>
						<td>
							<input type="text" name="level_name" id="level_name" value="<?php echo $level->name; ?>" class="regular-text" placeholder="Enter Name">
						</td>
					</tr>
					<tr class="example-class">
						<td>
							<label for="level_price"><?php echo esc_html('Level Price', 'house-configurator'); ?></label>
						</td>
						<td>
							<input type="text" name="level_price" id="level_price" value="<?php echo $level->price; ?>" class="regular-text" placeholder="Enter Price">
						</td>
					</tr>
					<tr class="example-class">
						<td>
							<input type="submit" name="submit" value="Update" class="button button-primary">
							<!-- submit to function -->
							<?php //submit_button('Add New', 'primary', 'btnSubmit'); ?>
						</td>
					</tr>
				</table>
			</form>
		<?php
	}
}


/**
 * Delete level
 */
function deleteLevel() {
	if (isset($_GET['delete_level'])) {
		// delete level with confirm message and set id to $_GET['delete'] then send to function
		?>
			<script type="text/javascript">
				var r = confirm("Are you sure you want to delete this level?");
				if (r == true) {
					window.location.href = "<?php echo admin_url('admin-post.php?action=delete_level_data_action&level_id=' . $_GET['delete_level']); ?>";
				} else {
					window.location.href = "<?php echo admin_url('admin.php?page=house_config_levels'); ?>";
				}
			</script>
		<?php
	}
}