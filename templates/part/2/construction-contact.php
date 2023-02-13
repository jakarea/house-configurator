<div class="wrap">
	<h1><?php echo esc_html('Manage Contact', 'house-configurator'); ?></h1>
	<?php settings_errors(); ?>
	<ul class="nav nav-tabs">
		<li class="active"><a href="#contact-tab-1"><?php echo esc_html('Manage Contact Hear', 'house-configurator'); ?></a></li>
		<li><a href="#contact-tab-2"><?php echo esc_html('Add New List', 'house-configurator')?></a></li>
	</ul>
    <!-- where you here about us -->
    <div class="tab-content">
        <div id="contact-tab-1" class="tab-pane fade in active">
            <h3>Manage Contact</h3>
            <!-- table for contact list -->
            <table class="table table-hover house_configurator_table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Contact Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // get data from wp table name [wp_house_configurator_part_2] with prefix
                    global $wpdb;
                    $table_name = $wpdb->prefix . 'house_configurator_part_2';
                    $contact_list = $wpdb->get_var("SELECT value FROM $table_name WHERE name = 'contact_list'");
                    $contact_list = json_decode($contact_list, true);
                    // loop for contact list
                    foreach ($contact_list as $key => $value) {
                        ?>
                        <tr>
                            <td><?php echo $key + 1; ?></td>
                            <td><?php echo $value; ?></td>
                            <td>
                                <a href="<?php echo admin_url('admin-post.php?action=delete_contact_data_action&contact_name=' . $value); ?>" class="button button-primary">Delete</a>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div id="contact-tab-2" class="tab-pane fade">
            <h3>Add New Contact List</h3>
            <?php createFormforContact(); ?>
        </div>
    </div>
</div>

<?php
/**
 * Create form for hear from us
 */
function createFormforContact() {
    // add form for hear from us name only
    ?>
	<form action="<?php echo esc_attr('admin-post.php'); ?>" method="post">
    	<input type="hidden" name="action" value="contact_data_action" />
        <table class="form-table">
            <tr class="example-class">
                <td>
                    <label for="contact_name">Contact Name</label>
                </td>
                <td>
                    <input type="text" name="contact_name" id="contact_name" value="" class="regular-text" placeholder="Enter Text">
                </td>
            </tr>
            <tr class="example-class">
				<td>
					<?php submit_button('Add New', 'primary', 'btnSubmit'); ?>
				</td>
			</tr>
        </table>
    </form>
    <?php
}
