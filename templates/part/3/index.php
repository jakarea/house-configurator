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
    <h1><?php echo esc_html('Part Three Manage All Settings', 'house-configurator'); ?></h1>
	<?php settings_errors(); ?>
	<hr>
    <div class="card col-12">
		<div class="card-body row">
			<div class="col-md-12">
                <div class="row">
                    <div class="col-md-2 mb-3">
                        <ul class="nav nav-pills flex-column" id="h__tabs-level" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="h__tabs-levels-part3-tab" data-toggle="tab" href="#h__tabs-levels-part3" role="tab" aria-controls="h__tabs-levels-part3" aria-selected="true"><?php echo esc_html('Manage Level', 'house-configurator'); ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="h__tabs-options-part3-tab" data-toggle="tab" href="#h__tabs-options-part3" role="tab" aria-controls="h__tabs-options-part3" aria-selected="true"><?php echo esc_html('Manage Option', 'house-configurator'); ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="h__tabs-house-part3-tab" data-toggle="tab" href="#h__tabs-house-part3" role="tab" aria-controls="h__tabs-house-part3" aria-selected="true"><?php echo esc_html('Manage House', 'house-configurator'); ?></a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-10">
                        <div class="tab-content" id="h__tabs-photos-Content">
                            <div class="tab-pane fade show active" id="h__tabs-levels-part3" role="tabpanel" aria-labelledby="h__tabs-levels-part3-tab">
                                <?php 
                                    require_once 'levels.php';
                                ?>
                            </div>
                            <div class="tab-pane fade" id="h__tabs-options-part3" role="tabpanel" aria-labelledby="h__tabs-options-part3-tab">
                                <?php 
                                    require_once 'options.php';
                                ?>
                            </div>
                            <div class="tab-pane fade" id="h__tabs-house-part3" role="tabpanel" aria-labelledby="h__tabs-house-part3-tab">
                                <?php 
                                    require_once 'house.php';
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>