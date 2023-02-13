<div class="wrap">
	<h1><?php echo esc_html('Levels Settings', 'house-configurator'); ?></h1>
	<?php settings_errors(); ?>
	<ul class="nav nav-tabs">
		<li class="active"><a href="#tab-1">Manage Levels</a></li>
		<li><a href="#tab-2">Add New Level</a></li>
	</ul>

	<div class="tab-content">
		<div id="tab-1" class="tab-pane active">
			<table class="table table-hover house_configurator_table">
				<thead>
					<tr>
						<th>ID</th>
						<th>Level Name</th>
						<th>Level Price</th>
						<th>Actions</th>
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
										<a href="<?php echo admin_url('admin.php?page=house_config_levels&edit=' . $level->id); ?>" class="button button-primary">Edit</a>
										<a href="<?php echo admin_url('admin.php?page=house_config_levels&delete=' . $level->id); ?>" class="button button-primary">Delete</a>
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
			<?php updateLevel(); ?>
		</div>
		<div id="tab-2" class="tab-pane">
			<?php createFormforLevel(); ?>
			<?php deleteLevel(); ?>
		</div>
	</div>
</div>

<?php
/**
 * Create form for level name and price
 */
function createFormforLevel() {
	// create form for lavel name and price with lebel name and price
	?>
	<form action="<?php echo esc_attr('admin-post.php'); ?>" method="post">
    	<input type="hidden" name="action" value="level_data_action" />
	
		<table class="form-table">
			<tr class="example-class">
				<td>
					<label for="level_name">Level Name</label>
				</td>
				<td>
					<input type="text" name="level_name" id="level_name" value="" class="regular-text" placeholder="Enter Name">
				</td>
			</tr>
			<tr class="example-class">
				<td>
					<label for="level_price">Level Price</label>
				</td>
				<td>
					<input type="text" name="level_price" id="level_price" value="" class="regular-text" placeholder="Enter Price">
				</td>
			</tr>
			<tr class="example-class">
				<td>
					<input type="submit" name="submit" value="Add New" class="button button-primary">
					<!-- submit to function -->
					<?php //submit_button('Add New', 'primary', 'btnSubmit'); ?>
				</td>
			</tr>
		</table>
	</form>
	<?php
}

/**
 * Update level name and price
 */
function updateLevel() {
	if (isset($_GET['edit'])) {
		global $wpdb;
		$house_levels = $wpdb->prefix . 'house_configurator_type';
		$level = $wpdb->get_row("SELECT * FROM $house_levels WHERE id = " . $_GET['edit']);
		?>
			<form action="<?php echo esc_attr('admin-post.php'); ?>" method="post">
		    	<input type="hidden" name="action" value="edit_level_data_action" />
		    	<input type="hidden" name="level_id" value="<?php echo $level->id; ?>" />
			
				<table class="form-table">
					<tr class="example-class">
						<td>
							<label for="level_name">Level Name</label>
						</td>
						<td>
							<input type="text" name="level_name" id="level_name" value="<?php echo $level->name; ?>" class="regular-text" placeholder="Enter Name">
						</td>
					</tr>
					<tr class="example-class">
						<td>
							<label for="level_price">Level Price</label>
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
	if (isset($_GET['delete'])) {
		// delete level with confirm message and set id to $_GET['delete'] then send to function
		?>
			<script type="text/javascript">
				var r = confirm("Are you sure you want to delete this level?");
				if (r == true) {
					window.location.href = "<?php echo admin_url('admin-post.php?action=delete_level_data_action&level_id=' . $_GET['delete']); ?>";
				} else {
					window.location.href = "<?php echo admin_url('admin.php?page=house_config_levels'); ?>";
				}
			</script>
		<?php
	}
}