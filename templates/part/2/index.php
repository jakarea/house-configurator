<?php
/**
 * @package  HouseConfigurator
 */

 if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
* Plugin Name:      House Configurator
* Plugin URI:		http://giopio.com
* Description:      House Configurator is helping for making house estimate in a minutes.
* Version:          1.0.0
*/

/**
 * The code that runs during show success message or error message
 */
if ( isset( $_GET['message'] ) && $_GET['message'] == 'success' ) {
    echo '<div class="notice notice-success is-dismissible">
            <p>Data has been added successfully!</p>
        </div>';
} else if ( isset( $_GET['message'] ) && $_GET['message'] == 'update' ) {
    echo '<div class="notice notice-success is-dismissible">
            <p>Data has been updated successfully!</p>
        </div>';
} else if ( isset( $_GET['message'] ) && $_GET['message'] == 'delete' ) {
    echo '<div class="notice notice-success is-dismissible">
            <p>Data has been deleted successfully!</p>
        </div>';
} else if ( isset( $_GET['message'] ) && $_GET['message'] == 'error' ) {
    echo '<div class="notice notice-error is-dismissible">
            <p>Something went wrong!</p>
        </div>';
}
?>
<div class="wrap">
    <h1><?php echo esc_html('Part Two Manage All Settings', 'house-configurator'); ?></h1>
	<?php settings_errors(); ?>
	<hr>
    <div class="card col-12">
		<div class="card-body row">
			<div class="col-md-12">
                <div class="row">
                    <div class="col-md-2 mb-3">
                        <ul class="nav nav-pills flex-column" id="h__tabs-level" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="h__tabs-price-tab" data-toggle="tab" href="#h__tabs-price" role="tab" aria-controls="h__tabs-price" aria-selected="true"><?php echo esc_html('Manage Price', 'house-configurator'); ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="h__tabs-contact-tab" data-toggle="tab" href="#h__tabs-contact" role="tab" aria-controls="h__tabs-contact" aria-selected="true"><?php echo esc_html('Manage Contact', 'house-configurator'); ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="h__tabs-btw-tab" data-toggle="tab" href="#h__tabs-btw" role="tab" aria-controls="h__tabs-btw" aria-selected="true"><?php echo esc_html('Manage BTW', 'house-configurator'); ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="h__tabs-af-tab" data-toggle="tab" href="#h__tabs-af" role="tab" aria-controls="h__tabs-af" aria-selected="false"><?php echo esc_html('Manage AF', 'house-configurator'); ?></a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-10">
                        <div class="tab-content" id="h__tabs-btwContent">
                            <div class="tab-pane fade show active" id="h__tabs-price" role="tabpanel" aria-labelledby="h__tabs-price-tab">
                                <?php 
                                    require_once 'construction-price.php';
                                ?>
                            </div>
                            <div class="tab-pane fade" id="h__tabs-contact" role="tabpanel" aria-labelledby="h__tabs-contact-tab">
                                <?php 
                                    require_once 'construction-contact.php';
                                ?>
                            </div>
                            <div class="tab-pane fade" id="h__tabs-btw" role="tabpanel" aria-labelledby="h__tabs-btw-tab">
                                <?php 
                                    require_once 'construction-choice.php';
                                ?>
                            </div>
                            <div class="tab-pane fade" id="h__tabs-af" role="tabpanel" aria-labelledby="h__tabs-af-tab">
                                <?php 
                                    require_once 'construction-choice-2.php';
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>