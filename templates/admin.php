<div class="wrap">
	<h1><?php echo esc_html('House Configurator Plugin', 'house-configurator'); ?></h1>
	<?php settings_errors(); ?>

	<ul class="nav nav-tabs">
		<li class="active"><a href="#tab-1">Manage Settings</a></li>
		<li><a href="#tab-2">Updates</a></li>
		<li><a href="#tab-3">About</a></li>
	</ul>

	<div class="tab-content">
		<div id="tab-1" class="tab-pane active">

			<form method="post" action="options.php">
				<?php 
					settings_fields( 'house_configurator_options_group' );
					do_settings_sections( 'house_configurator' );
					submit_button();
				?>
			</form>
			
		</div>

		<div id="tab-2" class="tab-pane">
			<!-- Write static content wordpress style -->
			<h3>Updates</h3>
			<!-- give guideline about using ['house_configurator'] shortcode -->
			<p>Use this shortcode to activate the House Configurator plugin inside a Page or a Post</p>
			<p>A powerful and user-friendly plugin for estimating the cost of building a house. With "House Configurator", users can easily and quickly get an accurate estimate of the cost of building their dream house, without the need for manual calculations. This plugin is a must-have tool for anyone looking to build a house, and it provides a valuable service to the construction industry.</p>+
			<!-- Part one Shortcode -->
			<h3>Part 01 Shortcode</h3>
			<p>Use this shortcode to activate the House Configurator plugin inside a Page or a Post</p>
			<p><code>[house_configurator_part_one]</code></p>
			<!-- Part Two Shortcode -->
			<h3>Part 02 Shortcode</h3>
			<p>Use this shortcode to activate the House Configurator plugin inside a Page or a Post</p>
			<p><code>[house_configurator_part_two]</code></p>
			<!-- Part Three Shortcode -->
			<h3>Part 03 Shortcode</h3>
			<p>Use this shortcode to activate the House Configurator plugin inside a Page or a Post</p>
			<p><code>[house_configurator_part_three]</code></p>
			
		</div>

		<div id="tab-3" class="tab-pane">
			<!-- Wite static content wordpress style -->
			<h3>About</h3>
			<!-- write long text about the plugin -->
			<p>House Configurator is a powerful and user-friendly plugin for estimating the cost of building a house. With "House Configurator", users can easily and quickly get an accurate estimate of the cost of building their dream house, without the need for manual calculations. This plugin is a must-have tool for anyone looking to build a house, and it provides a valuable service to the construction industry.</p>
			<!-- show recent update log -->
			<h5>Recent Updates</h5>
			<ul>
				<li>Version 1.0.0
					<ul>
						<li>
							<code>1.0.0 We have initialised the plugin. we have also done bootstrapping for the plugin. Removing unused code and linkup with all enquee javascript.</code>
						</li>
					</ul>
				</li>
				<li>Version 1.0.1
					<ul>
						<li>
							<code>1.0.1 We have added the shortcode for the plugin. We have also fixing other bugs on that step.</code>
						</li>
					</ul>
				</li>
				<li>Version 1.0.2</li>
			</ul>

		</div>
	</div>
</div>