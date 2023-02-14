<?php
/**
 * @package  HouseConfigurator
 */

 if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
* Plugin Name:       House Configurator
* Plugin URI:		http://giopio.com
* Description:       House Configurator is helping for making house estimate in a minutes.
* Version:           1.0.0
*/

/**
 * The code that runs during show success message or error message
 */
if ( isset( $_GET['message'] ) && $_GET['message'] == 1 ) {
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
} else if ( isset( $_GET['message'] ) && $_GET['message'] == 4 ) {
    echo '<div class="notice notice-error is-dismissible">
            <p>Data has been deleted failed!</p>
        </div>';
}
    

/**
 * import feature template
 */
// require_once 'features.php';

?>
<div class="wrap">
	<h1><?php echo esc_html('Part One Manage All Settings', 'house-configurator'); ?></h1>
	<?php settings_errors(); ?>
	<hr>
    <div class="card col-12">
		<div class="card-body row">
			<div class="col-md-12">
                <div class="row">
                    <div class="col-md-2 mb-3">
                        <ul class="nav nav-pills flex-column" id="h__tabs-level" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="h__tabs-levels-tab" data-toggle="tab" href="#h__tabs-levels" role="tab" aria-controls="h__tabs-levels" aria-selected="true">Manage Levels</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="h__tabs-features-tab" data-toggle="tab" href="#h__tabs-features" role="tab" aria-controls="h__tabs-features" aria-selected="false">Manage Feature</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-10">
                        <div class="tab-content" id="h__tabs-levelContent">
                            <?php
                                // include level template
                                require_once 'levels.php';
                            ?>
                            <?php
                                // include feature template
                                require_once 'features.php';
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>