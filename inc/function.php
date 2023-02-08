<?php
// level_data_action function to save data in wp custom field if field not exist then create new field and save data in it after that redirect to level page and show message
add_action('admin_post_level_data_action', 'level_data_action');
add_action('admin_post_nopriv_level_data_action', 'level_data_action');
function level_data_action() {
	// get level name and level price from form
	$level_name = $_POST['level_name'];
	$level_price = $_POST['level_price'];

	// get houseConfigure_level_data array
	$level_data = get_option('houseConfigure_level_data');

	// check if houseConfigure_level_data array exist or not
	if ($level_data) {
		// if exist then add new level name and level price in houseConfigure_level_data array
		$level_data[] = array(
			'level_name' => $level_name,
			'level_price' => $level_price
		);
	} else {
		// if not exist then create new houseConfigure_level_data array and add level name and level price in it
		$level_data = array(
			'level_name' => $level_name,
			'level_price' => $level_price
		);
	}

	// update houseConfigure_level_data array
	update_option('houseConfigure_level_data', $level_data);

	// redirect to level page and show message
	wp_redirect(admin_url('admin.php?page=house_config_levels&message=1'));
	exit;
}
