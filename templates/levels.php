<div class="wrap">
	<h1><?php echo esc_html('Levels Settings', 'house-configurator'); ?></h1>
	<?php settings_errors(); ?>

	<ul class="nav nav-tabs">
		<li class="active"><a href="#tab-1">Manage Levels</a></li>
		<li><a href="#tab-2">Add New Level</a></li>
	</ul>

	<div class="tab-content">
		<div id="tab-1" class="tab-pane active">
			<table class="table table-hover">
				<thead>
					<tr>
						<th>ID</th>
						<th>Level Name</th>
						<th>Level Price</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					<!-- get houseConfigure_level_data array and set level name in thead and level price in thead level price -->
					<?php
						$levels[] = get_option('houseConfigure_level_data');
						// var_dump($levels);
					?>
					<?php foreach ($levels as $key => $value) : ?>
						<tr>
							<td><?php echo $key; ?></td>
							<td><?php echo $value['level_name']; ?></td>
							<td><?php echo $value['level_price']; ?></td>
							<td>
								<a href="#" class="btn btn-danger">Delete</a>
							</td>
						</tr>
					<?php endforeach; ?>
					
				</tbody>
			</table>
		</div>
		<div id="tab-2" class="tab-pane">
			<!-- <form method="post" action="options.php">
				<?php
					// settings_fields( 'house_configurator_options_group' );
					// do_settings_sections( 'house_config_levels' );
					// submit_button('Add New', 'primary', 'btnSubmit');
				?>
			</form> -->
			<!-- insert fucntion for level type -->
			<?php createFormforLevel(); ?>
		</div>
	</div>
</div>

<?php
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