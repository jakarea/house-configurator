<div class="wrap">
	<h1><?php echo esc_html('House Configurator Plugin', 'house-configurator'); ?></h1>
	<?php settings_errors(); ?>

	<ul class="nav nav-tabs">
		<li class="active"><a href="#tab-1"><?php echo esc_html('Manage Settings', 'house-configurator'); ?></a></li>
		<li><a href="#tab-2"><?php echo esc_html('Updates', 'house-configurator'); ?></a></li>
		<li><a href="#tab-3"><?php echo esc_html('About', 'house-configurator'); ?></a></li>
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
			<p><?php echo esc_html('Use this shortcode to activate the House Configurator plugin inside a Page or a Post', 'house-configurator'); ?></p>
			<p><?php echo esc_html('A powerful and user-friendly plugin for estimating the cost of building a house. With "House Configurator", users can easily and quickly get an accurate estimate of the cost of building their dream house, without the need for manual calculations. This plugin is a must-have tool for anyone looking to build a house, and it provides a valuable service to the construction industry.', 'house-configurator'); ?></p>+
			<!-- Part one Shortcode -->
			<h3><?php echo esc_html('Part 01 Shortcode', 'house-configurator'); ?></h3>
			<p><?php echo esc_html('Use this shortcode to activate the House Configurator plugin inside a Page or a Post', 'house-configurator'); ?></p>
			<p><code><?php echo esc_html('[house_configurator_part_one]', 'house-configurator'); ?></code></p>
			<!-- Part Two Shortcode -->
			<h3><?php echo esc_html('Part 02 Shortcode', 'house-configurator'); ?></h3>
			<p><?php echo esc_html('Use this shortcode to activate the House Configurator plugin inside a Page or a Post', 'house-configurator'); ?></p>
			<p><code><?php echo esc_html('[house_configurator_part_two]', 'house-configurator'); ?></code></p>
			<!-- Part Three Shortcode -->
			<h3><?php echo esc_html('Part 03 Shortcode', 'house-configurator'); ?></h3>
			<p><?php echo esc_html('Use this shortcode to activate the House Configurator plugin inside a Page or a Post', 'house-configurator'); ?></p>
			<p><code><?php echo esc_html('[house_configurator_part_three]', 'house-configurator'); ?></code></p>
			<!-- Part Four Shortcode -->
			<h3><?php echo esc_html('Part 04 Shortcode', 'house-configurator'); ?></h3>
			<p><?php echo esc_html('Use this shortcode to activate the House Configurator plugin inside a Page or a Post', 'house-configurator'); ?></p>
			<p><code><?php echo esc_html('[house_configurator_part_four]', 'house-configurator'); ?></code></p>
			
		</div>

		<div id="tab-3" class="tab-pane">
			<!-- Wite static content wordpress style -->
			<h3><?php echo esc_html('About', 'house-configurator'); ?></h3>
			<!-- write long text about the plugin -->
			<p><?php echo esc_html('House Configurator is a powerful and user-friendly plugin for estimating the cost of building a house. With "House Configurator", users can easily and quickly get an accurate estimate of the cost of building their dream house, without the need for manual calculations. This plugin is a must-have tool for anyone looking to build a house, and it provides a valuable service to the construction industry.', 'house-configurator'); ?></p>
			<!-- show recent update log -->
			<h5><?php echo esc_html('Recent Updates', 'house-configurator'); ?></h5>
			<ul>
				<li><?php echo esc_html('Version 1.0.0', 'house-configurator'); ?>
					<ul>
						<li>
							<code><?php echo esc_html('1.0.0 We have initialised the plugin. we have also done bootstrapping for the plugin. Removing unused code and linkup with all enquee javascript.', 'house-configurator'); ?></code>
						</li>
					</ul>
				</li>
				<li><?php echo esc_html('Version 1.0.1', 'house-configurator'); ?>
					<ul>
						<li>
							<code><?php echo esc_html('1.0.1 We have added the shortcode for the plugin. We have also fixing other bugs on that step.', 'house-configurator'); ?></code>
						</li>
					</ul>
				</li>
				<li><?php echo esc_html('Version 1.0.2', 'house-configurator'); ?>
					<ul>
						<li>
							<code><?php echo esc_html('1.0.2 We have added the shortcode for the plugin. We have also fixing other bugs on that step. We have registerd custom post for manage part three settings.', 'house-configurator'); ?></code>
						</li>
					</ul>
				</li>
			</ul>

		</div>
	</div>
</div>