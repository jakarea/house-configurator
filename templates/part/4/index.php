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
?>

<div class="wrap">
    <h1><?php echo esc_html('Part Four Manage All Settings', 'house-configurator'); ?></h1>
	<?php settings_errors(); ?>
	<hr>
    <div class="card col-12">
		<div class="card-body row">
			<div class="col-md-12">
                <div class="row">
                    <div class="col-md-2 mb-3">
                        <ul class="nav nav-pills flex-column" id="ht__tabs-index" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="ht__tabs-index-tab" data-toggle="tab" href="#ht__tabs-index" role="tab" aria-controls="ht__tabs-index" aria-selected="true">Manage Settings</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-10">
                        <div class="tab-content" id="h__tabs-photos-Content">
                            <div class="tab-content" id="ht__tabs-indexContent">
                                <div class="tab-pane fade show active" id="ht__tabs-index" role="tabpanel" aria-labelledby="ht__tabs-index-tab">
                                    <form method="post" action="options.php">
                                        <!-- part-04 -->
                                        <?php
                                            settings_fields( 'alecaddd_admin_part_four' );
                                            do_settings_sections( 'house_config_house_part_four' );
                                            submit_button();

                                            echo '<a href="' . admin_url( 'edit.php?post_type=house_model' ) . '" class="btn btn-success btn-sm">Go to House Model</a>';
                                        ?>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>