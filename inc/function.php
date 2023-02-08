<?php
/**
 * @package  HouseConfigurator
 */

 /**
 * Plugin Name:       House Configurator
* Plugin URI:		http://giopio.com
* Description:       House Configurator is helping for making house estimate in a minutes.
* Version:           1.0.0
*/

/**
 * The code that runs during save level data
 */
add_action('admin_post_level_data_action', 'level_data_action');
add_action('admin_post_nopriv_level_data_action', 'level_data_action');

function level_data_action() {
	// get data from form
	$level_name = $_POST['level_name'];
	$level_price = $_POST['level_price'];

	// store data in wp table name [wp_house_configurator_type] with prefix
	global $wpdb;
	$table_name = $wpdb->prefix . 'house_configurator_type';
	$wpdb->insert(
		$table_name,
		array(
			'name' => $level_name,
			'price' => $level_price
		)
	);

	// redirect to level page and show message
	wp_redirect( admin_url('admin.php?page=house_config_levels&message=1') );
	exit;
}

/**
 * The code that run during edit level data ['level_data_action']
 */
add_action('admin_post_edit_level_data_action', 'edit_level_data_action');
add_action('admin_post_nopriv_edit_level_data_action', 'edit_level_data_action');

function edit_level_data_action() {
	// get data from form
	$level_id = $_POST['level_id'];
	$level_name = $_POST['level_name'];
	$level_price = $_POST['level_price'];

	// store data in wp table name [wp_house_configurator_type] with prefix
	global $wpdb;
	$table_name = $wpdb->prefix . 'house_configurator_type';
	$wpdb->update(
		$table_name,
		array(
			'name' => $level_name,
			'price' => $level_price
		),
		array('id' => $level_id)
	);

	// redirect to level page and show message
	wp_redirect( admin_url('admin.php?page=house_config_levels&message=update') );
	exit;
}

/**
 * The code that run during delete level type ['delete_level_data_action']
 */
add_action('admin_post_delete_level_data_action', 'delete_level_data_action');
add_action('admin_post_nopriv_delete_level_data_action', 'delete_level_data_action');

function delete_level_data_action() {
	// get data from form
	$level_id = $_GET['level_id'];

	// store data in wp table name [wp_house_configurator_type] with prefix
	global $wpdb;
	$table_name = $wpdb->prefix . 'house_configurator_type';
	$wpdb->delete(
		$table_name,
		array('id' => $level_id)
	);

	// redirect to level page and show message
	wp_redirect( admin_url('admin.php?page=house_config_levels&message=delete') );
	exit;
}


/**
 * The code that runs during feature store [create_feature_action].
 */

add_action('admin_post_create_feature_action', 'create_feature_action');
add_action('admin_post_nopriv_create_feature_action', 'create_feature_action');

function create_feature_action() {
	// get data from form
	$feature_name = $_POST['feature_name'];
	$feature_price = $_POST['feature_price'];
	$feature_level = $_POST['feature_level'];

	// store data in wp table name [wp_house_configurator_feature] with prefix
	global $wpdb;
	$table_name = $wpdb->prefix . 'house_configurator_feature';
	$wpdb->insert(
		$table_name,
		array(
			'name' => $feature_name,
			'price' => $feature_price,
			'type_id' => implode(',', $feature_level)
		)
	);

	// redirect to level page and show message
	wp_redirect( admin_url('admin.php?page=house_config_features&message=success') );
	exit;
}

/**
 * The code that runs during feature update [edit_feature_action].
 */
add_action('admin_post_edit_feature_action', 'edit_feature_action');
add_action('admin_post_nopriv_edit_feature_action', 'edit_feature_action');

function edit_feature_action() {
	// get data from form
	$feature_id = $_POST['feature_id'];
	$feature_name = $_POST['feature_name'];
	$feature_price = $_POST['feature_price'];
	$feature_level = $_POST['feature_level'];

	// store data in wp table name [wp_house_configurator_feature] with prefix
	global $wpdb;
	$table_name = $wpdb->prefix . 'house_configurator_feature';
	$wpdb->update(
		$table_name,
		array(
			'name' => $feature_name,
			'price' => $feature_price,
			'type_id' => implode(',', $feature_level)
		),
		array('id' => $feature_id)
	);

	// redirect to level page and show message
	wp_redirect( admin_url('admin.php?page=house_config_features&message=update') );
	exit;
}

/**
 * The code that runs during feature delete [delete_feature_data_action].
 */
add_action('admin_post_delete_feature_data_action', 'delete_feature_data_action');
add_action('admin_post_nopriv_delete_feature_data_action', 'delete_feature_data_action');

function delete_feature_data_action() {
	// get data from form
	$feature_id = $_GET['feature_id'];

	// store data in wp table name [wp_house_configurator_feature] with prefix
	global $wpdb;
	$table_name = $wpdb->prefix . 'house_configurator_feature';
	$wpdb->delete(
		$table_name,
		array('id' => $feature_id)
	);

	// redirect to level page and show message
	wp_redirect( admin_url('admin.php?page=house_config_features&message=delete') );
	exit;
}