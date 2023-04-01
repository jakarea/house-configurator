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
	wp_redirect( admin_url('admin.php?page=house_config_house_part_one&message=1') );
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
	wp_redirect( admin_url('admin.php?page=house_config_house_part_one&message=update') );
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
	wp_redirect( admin_url('admin.php?page=house_config_house_part_one&message=delete') );
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
	if (!$feature_level || empty($feature_level)) {
		$feature_level = 0;
	  } else {
		$feature_level = implode(',', $feature_level);
	  }
	  
	  $wpdb->insert(
		$table_name,
		array(
		  'name' => $feature_name,
		  'price' => $feature_price,
		  'type_id' => $feature_level
		)
	  );

	// redirect to level page and show message
	wp_redirect( admin_url('admin.php?page=house_config_house_part_one&message=success') );
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
	if (!$feature_level || empty($feature_level)) {
		$feature_level = 0;
	  } else {
		$feature_level = implode(',', $feature_level);
	  }
	  
	  $wpdb->insert(
		$table_name,
		array(
		  'name' => $feature_name,
		  'price' => $feature_price,
		  'type_id' => $feature_level
		)
	  );

	// redirect to level page and show message
	wp_redirect( admin_url('admin.php?page=house_config_house_part_one&message=update') );
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
	wp_redirect( admin_url('admin.php?page=house_config_house_part_one&message=delete') );
	exit;
}


/*/------------------------------------ House Part Two ------------------------------------/*/

/**
 * The code that runs during store contact name into json array [contact_data_action].
 */
add_action('admin_post_contact_data_action', 'contact_data_action');
add_action('admin_post_nopriv_contact_data_action', 'contact_data_action');

function contact_data_action() {
    // Get the contact name from the form
    $contact_name = $_POST['contact_name'];

	// Connect to the database and retrieve the current contact list (if it exists)
	global $wpdb;
	$table_name = $wpdb->prefix . 'house_configurator_part_2';
	$contact_list = $wpdb->get_var("SELECT value FROM $table_name WHERE name = 'contact_list'");

	// If there is no existing contact list, create a new one and insert it into the database
	if (!$contact_list) {
		$contact_list = array($contact_name);
		$wpdb->insert(
			$table_name,
			array(
				'name' => 'contact_list',
				'value' => json_encode($contact_list),
				'created_at' => current_time('mysql'),
				'updated_at' => current_time('mysql')
			),
			array('%s', '%s', '%s', '%s')
		);
	} else {
		// If the contact list exists, decode it from JSON
		$contact_list = json_decode($contact_list, true);

		// Add the new contact to the list
		array_push($contact_list, $contact_name);

		// Encode the contact list as JSON
		$contact_list = json_encode($contact_list);

		// Update the contact list in the database
		$wpdb->update(
			$table_name,
			array(
				'value' => $contact_list,
				'updated_at' => current_time('mysql')
			),
			array('name' => 'contact_list'),
			array('%s', '%s'),
			array('%s')
		);
	}

	// Redirect the user back to the page with a success message
	wp_redirect(admin_url('admin.php?page=house_config_house_part_two&message=success'));
	wp_redirect(admin_url('admin.php?page=house_config_house_part_two&message=delete'));

	exit;
}

/**
 * The code that runs during delete contact name into json array [delete_contact_data_action].
 */
add_action('admin_post_delete_contact_data_action', 'delete_contact_data_action');
add_action('admin_post_nopriv_delete_contact_data_action', 'delete_contact_data_action');

function delete_contact_data_action() {
	// Get the contact name from the form
	$contact_name = $_GET['contact_name'];

	// Connect to the database and retrieve the current contact list (if it exists)
	global $wpdb;
	$table_name = $wpdb->prefix . 'house_configurator_part_2';
	$contact_list = $wpdb->get_var("SELECT value FROM $table_name WHERE name = 'contact_list'");

	// if contact name is match with contact list then delete it
	if ($contact_list) {
		$contact_list = json_decode($contact_list, true);
		$contact_list = array_diff($contact_list, array($contact_name));
		$contact_list = json_encode($contact_list);

		// Update the contact list in the database
		$wpdb->update(
			$table_name,
			array(
				'value' => $contact_list,
				'updated_at' => current_time('mysql')
			),
			array('name' => 'contact_list'),
			array('%s', '%s'),
			array('%s')
		);
	}

	// Redirect the user back to the page with a success message
	wp_redirect(admin_url('admin.php?page=house_config_house_part_two&message=delete'));
	exit;
}

/**
 * The code that runs during btw_list into json array with(name, value) [btw_data_action].
 */
add_action('admin_post_btw_data_action', 'btw_data_action');
add_action('admin_post_nopriv_btw_data_action', 'btw_data_action');

function btw_data_action() {
	// Get the btw name from the form
	$btw_name = $_POST['btw_name'];
	$btw_price = $_POST['btw_price'];

	// Connect to the database and retrieve the current btw list (if it exists)
	global $wpdb;
	$table_name = $wpdb->prefix . 'house_configurator_part_2';
	$btw_list = $wpdb->get_var("SELECT value FROM $table_name WHERE name = 'btw_list'");

	// If there is no existing btw list, create a new one and insert it into the database
	if (!$btw_list) {
		$btw_list = array(array('name' => $btw_name, 'value' => $btw_price));
		$wpdb->insert(
			$table_name,
			array(
				'name' => 'btw_list',
				'value' => json_encode($btw_list),
				'created_at' => current_time('mysql'),
				'updated_at' => current_time('mysql')
			),
			array('%s', '%s', '%s', '%s')
		);
	} else {
		// If the btw list exists, decode it from JSON
		$btw_list = json_decode($btw_list, true);

		// Add the new btw to the list
		array_push($btw_list, array('name' => $btw_name, 'value' => $btw_price));

		// Encode the btw list as JSON
		$btw_list = json_encode($btw_list);

		// Update the btw list in the database
		$wpdb->update(
			$table_name,
			array(
				'value' => $btw_list,
				'updated_at' => current_time('mysql')
			),
			array('name' => 'btw_list'),
			array('%s', '%s'),
			array('%s')
		);
	}

	// Redirect the user back to the page with a success message
	wp_redirect(admin_url('admin.php?page=house_config_house_part_two&message=success'));
	exit;
}

/**
 * The code that runs during edit btw_list into json array [btw_data_update_action].
 */
add_action('admin_post_btw_data_update_action', 'btw_data_update_action');
add_action('admin_post_nopriv_btw_data_update_action', 'btw_data_update_action');

function btw_data_update_action() {
    // Get the btw name and price from the form
	$btw_old_name = $_POST['btw_name_update'];
    $btw_name = $_POST['btw_name'];
    $btw_price = $_POST['btw_price'];

    // Connect to the database and retrieve the current btw list (if it exists)
    global $wpdb;
    $table_name = $wpdb->prefix . 'house_configurator_part_2';
    $btw_list = $wpdb->get_var("SELECT value FROM $table_name WHERE name = 'btw_list'");

    // If there is no existing btw list, create a new one
    if (!$btw_list) {
        $btw_list = array();
    } else {
        // If the btw list exists, decode it from JSON
        $btw_list = json_decode($btw_list, true);
    }

    // Find the index of the btw list with the same name
    $index = array_search($btw_old_name, array_column($btw_list, 'name'));

    // Update the name and price of the btw list
    $btw_list[$index]['name'] = $btw_name;
    $btw_list[$index]['value'] = $btw_price;

    // Encode the btw list as JSON
    $btw_list = json_encode($btw_list);

    // Update the btw list in the database
    $wpdb->update(
        $table_name,
        array(
            'value' => $btw_list,
            'updated_at' => current_time('mysql')
        ),
        array('name' => 'btw_list'),
        array('%s', '%s'),
        array('%s')
    );

    // Redirect the user back to the page with a success message
    wp_redirect(admin_url('admin.php?page=house_config_house_part_two&message=update'));
    exit;
}

/**
 * The code that runs during delete btw_list into json array [btw_data_delete_action].
 */
add_action('admin_post_btw_data_delete_action', 'btw_data_delete_action');
add_action('admin_post_nopriv_btw_data_delete_action', 'btw_data_delete_action');

function btw_data_delete_action() {
    // Get the slug from the form
    $contact_name = $_GET['btw_name'];

    // Connect to the database and retrieve the current contact list (if it exists)
    global $wpdb;
    $table_name = $wpdb->prefix . 'house_configurator_part_2';
    $contact_list_json = $wpdb->get_var("SELECT value FROM $table_name WHERE name = 'btw_list'");

    if ($contact_list_json) {
        // Decode the JSON string into an array
        $contact_list = json_decode($contact_list_json, true);

        // Find the index of the item with the matching slug
        $index = array_search($contact_name, array_column($contact_list, 'slug'));

        if ($index !== false) {
            // Remove the item from the array
            unset($contact_list[$index]);

            // Reindex the array
            $contact_list = array_values($contact_list);

            // Encode the array back into JSON
            $contact_list_json = json_encode($contact_list);

            // Update the contact list in the database
            $wpdb->update(
                $table_name,
                array(
                    'value' => $contact_list_json,
                    'updated_at' => current_time('mysql')
                ),
                array('name' => 'btw_list'),
                array('%s', '%s'),
                array('%s')
            );
        }
    }

    // Redirect the user back to the page with a success message
    wp_redirect(admin_url('admin.php?page=house_config_house_part_two&message=delete'));
    exit;
}


/**
 * The code that runs during add house_part_two into json array [afplakken_data_action].
 */
add_action('admin_post_afplakken_data_action', 'afplakken_data_action');
add_action('admin_post_nopriv_afplakken_data_action', 'afplakken_data_action');

function afplakken_data_action() {
	// Get the btw name from the form
	$af_name = $_POST['afplakken_name'];
	$af_price = $_POST['afplakken_price'];

	// Connect to the database and retrieve the current btw list (if it exists)
	global $wpdb;
	$table_name = $wpdb->prefix . 'house_configurator_part_2';
	$af_list = $wpdb->get_var("SELECT value FROM $table_name WHERE name = 'afplakken_list'");

	// If there is no existing btw list, create a new one and insert it into the database
	if (!$af_list) {
		$af_list = array(array(
			'name' => $af_name,
			'slug' => 'afplakken_' . sanitize_title($af_name),
			'value' => $af_price
		));
		
		$wpdb->insert(
			$table_name,
			array(
				'name' => 'afplakken_list',
				'value' => json_encode($af_list),
				'created_at' => current_time('mysql'),
				'updated_at' => current_time('mysql')
			),
			array('%s', '%s', '%s', '%s')
		);
	} else {
		// If the btw list exists, decode it from JSON
		$af_list = json_decode($af_list, true);

		// Add the new btw to the list
		array_push($af_list, array(
			'name' => $af_name, 
			'slug' => 'afplakken_' . sanitize_title($af_name),
			'value' => $af_price
		));

		// Encode the btw list as JSON
		$af_list = json_encode($af_list);

		// Update the btw list in the database
		$wpdb->update(
			$table_name,
			array(
				'value' => $af_list,
				'updated_at' => current_time('mysql')
			),
			array('name' => 'afplakken_list'),
			array('%s', '%s'),
			array('%s')
		);
	}

	// Redirect the user back to the page with a success message
	wp_redirect(admin_url('admin.php?page=house_config_house_part_two&message=success'));
	exit;
}

/**
 * The code that runs during update house_part_two into json array [btw_data_update_action].
 */
add_action('admin_post_afplakken_data_update_action', 'afplakken_data_update_action');
add_action('admin_post_nopriv_afplakken_data_update_action', 'afplakken_data_update_action');

function afplakken_data_update_action() {
	// Get the btw name from the form
	$af_old_name = $_POST['aff_name_update'];
	$af_name = $_POST['afplakken_name'];
	$af_price = $_POST['afplakken_price'];

	// Connect to the database and get the afplakken list from json
	global $wpdb;
	$table_name = $wpdb->prefix . 'house_configurator_part_2';
	$af_list = $wpdb->get_var("SELECT value FROM $table_name WHERE name = 'afplakken_list'");
	$af_list = json_decode($af_list, true);

	// Find the index of the afplakken slug in the afplakken list
	$index = array_search(sanitize_title($af_old_name), array_column($af_list, 'slug'));

	// If the afplakken slug is found, update it in the list
	if ($index !== false) {
		$af_list[$index]['name'] = $af_name;
		$af_list[$index]['slug'] = 'afplakken_' . sanitize_title($af_name);
		$af_list[$index]['value'] = $af_price;
	}

	// Encode the afplakken list as JSON
	$af_list = json_encode($af_list);

	// Update the afplakken list in the database as json array
	$wpdb->update(
		$table_name,
		array(
			'value' => $af_list,
			'updated_at' => current_time('mysql')
		),
		array('name' => 'afplakken_list'),
		array('%s', '%s'),
		array('%s')
	);

	// Redirect the user back to the page with a success message
	wp_redirect(admin_url('admin.php?page=house_config_house_part_two&message=success'));
}

/**
 * The code that runs during delete house_part_two into json array [btw_data_delete_action].
 */
add_action('admin_post_afplakken_data_delete_action', 'afplakken_data_delete_action');
add_action('admin_post_nopriv_afplakken_data_delete_action', 'afplakken_data_delete_action');

function afplakken_data_delete_action() {
    // Get the slug from the form
    $contact_name = $_GET['afplakken_name'];

    // Connect to the database and retrieve the current contact list (if it exists)
    global $wpdb;
    $table_name = $wpdb->prefix . 'house_configurator_part_2';
    $contact_list_json = $wpdb->get_var("SELECT value FROM $table_name WHERE name = 'afplakken_list'");

    if ($contact_list_json) {
        // Decode the JSON string into an array
        $contact_list = json_decode($contact_list_json, true);

        // Find the index of the item with the matching slug
        $index = array_search($contact_name, array_column($contact_list, 'slug'));

        if ($index !== false) {
            // Remove the item from the array
            unset($contact_list[$index]);

            // Reindex the array
            $contact_list = array_values($contact_list);

            // Encode the array back into JSON
            $contact_list_json = json_encode($contact_list);

            // Update the contact list in the database
            $wpdb->update(
                $table_name,
                array(
                    'value' => $contact_list_json,
                    'updated_at' => current_time('mysql')
                ),
                array('name' => 'afplakken_list'),
                array('%s', '%s'),
                array('%s')
            );
        }
    }

    // Redirect the user back to the page with a success message
    wp_redirect(admin_url('admin.php?page=house_config_house_part_two&message=delete'));
    exit;
}


/*
	================================================================================================
		END OF HOUSE PART TWO
	================================================================================================
*/

/*
	================================================================================================
		HOUSE PART THREE
	================================================================================================
*/
add_action( 'wp_ajax_get_level_taxonomies', 'get_level_taxonomies_callback' );
add_action( 'wp_ajax_nopriv_get_level_taxonomies', 'get_level_taxonomies_callback' );

function get_level_taxonomies_callback() {
    // Get the level ID from the AJAX request
    $id = $_POST['id'];

    // Get the level taxonomy data based on the level ID
	$level_taxonomies = get_terms(array(
		'taxonomy' => 'level',
		'hide_empty' => false,
		'term_taxonomy_id' => $id,
	));
	// get get_term_meta feature_image_id url from level taxonomy data
	$level_taxonomies[0]->feature_img = get_term_meta($level_taxonomies[0]->term_id, 'feature_image_id', true);
	$level_taxonomies[0]->feature_img = wp_get_attachment_image_src($level_taxonomies[0]->feature_img, 'full')[0];
	$level_taxonomies[0]->price = get_term_meta($level_taxonomies[0]->term_id, '_house_configurator_price', true);

	// Return the level taxonomy data as JSON
	echo json_encode($level_taxonomies);
    
    wp_die();
}

