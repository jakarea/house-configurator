<?php
/**
 * @package  HouseConfigurator
 */

 namespace Inc\Api\Callbacks;
 use Inc\Base\BaseController;

 class LevelsCallback extends BaseController
 {
 	public function levelsDashboard()
 	{
 		return require_once( "$this->plugin_path/templates/levels.php" );
 	}

    public function setSectionManager()
    {
        echo 'Manage the sections and features of this plugin by activating the checkboxes from the following list.';
        // $args = array(
        //     array(
        //         'id' => 'house_configurator_admin_index',
        //         'title' => 'Levels Manager',
        //         'callback' => array( $this->callbacks, 'adminSectionManager' ),
        //         'page' => 'house_configurator'
        //     )
        // );
        // $this->settings->setSections( $args );
    }

    public function levelSanitize( $input )
    {
        $output = get_option('house_configurator_plugin_levels');		
		return $input;
    }

	public function houseConfigure_ds_feet()
	{
		$value = esc_attr( get_option( 'ds_feet' ) );
		echo '<input type="text" class="regular-text" name="ds_feet" value="' . $value . '" placeholder="Write Something Here!">';
	}

	public function checkboxField( $args )
	{
		$name = $args['label_for'];
		$classes = $args['class'];
		$option_name = $args['option_name'];
		$checked = false;

		if ( isset($_POST["edit_post"]) ) {
			$checkbox = get_option( $option_name );
			$checked = isset($checkbox[$_POST["edit_post"]][$name]) ?: false;
		}

		echo '<div class="' . $classes . '"><input type="checkbox" id="' . $name . '" name="' . $option_name . '[' . $name . ']" value="1" class="" ' . ( $checked ? 'checked' : '') . '><label for="' . $name . '"><div></div></label></div>';
	}
 }