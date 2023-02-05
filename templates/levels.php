<div class="wrap">
	<h1><?php echo esc_html('Levels Settings', 'house-configurator'); ?></h1>
	<?php settings_errors(); ?>

	<ul class="nav nav-tabs">
		<li class="<?php echo !isset($_POST["edit_post"]) ? 'active' : '' ?>"><a href="#tab-1">Your Custom Post Types</a></li>
		<li class="<?php echo isset($_POST["edit_post"]) ? 'active' : '' ?>">
			<a href="#tab-2">
				<?php echo isset($_POST["edit_post"]) ? 'Edit' : 'Add' ?> Custom Post Type
			</a>
		</li>
		<li><a href="#tab-3">Export</a></li>
	</ul>

	<div class="tab-content">
		<!-- <div id="tab-1" class="tab-pane active">
			<form method="post" action="options.php">
				<?php 
					// settings_fields( 'house_configurator_options_group' );
					// do_settings_sections( 'house_configurator' );
					// submit_button();
				?>
			</form>
			
		</div> -->
		<div id="tab-2 active" class="tab-pane">
			<form method="post" action="options.php">
				<?php 
					settings_fields( 'house_configurator_plugin_levels_settings' );
					do_settings_sections( 'house_configurator_plugin_levels' );
					submit_button();
				?>
			</form>
		</div>
	</div>
</div>