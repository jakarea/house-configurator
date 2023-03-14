<!-- table for contact list -->
<div class="table-header d-flex justify-content-between mb-3">
    <h4><?php echo esc_html('Manage Contact / Add Contact', 'house-configurator'); ?></h4>
    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addContactModal"><?php echo esc_html('Add New', 'house-configurator'); ?></button>
</div>
<table class="table table-hover house_configurator_table">
    <thead>
        <tr>
            <th><?php echo esc_html('ID', 'house-configurator'); ?></th>
            <th><?php echo esc_html('Contact Name', 'house-configurator'); ?></th>
            <th><?php echo esc_html('Actions', 'house-configurator'); ?></th>
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
                    <a href="<?php echo admin_url('admin-post.php?action=delete_contact_data_action&contact_name=' . $value); ?>" class="button button-primary"><?php echo esc_html('Delete', 'house-configurator'); ?></a>
                </td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>
<?php createFormforContact(); ?>

<?php
/**
 * Create form for hear from us
 */
function createFormforContact() {
    // add form for hear from us name only
    ?>
    <div class="modal fade" id="addContactModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="addContactModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="addContactModalLabel"><?php echo esc_html('Add New Contact', 'house-configurator'); ?></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="<?php echo esc_attr('admin-post.php'); ?>" method="post">
                        <input type="hidden" name="action" value="contact_data_action" />
						<div class="form-group">
							<label for="contact_name"><?php echo esc_html('Level Name', 'house-configurator'); ?></label>
							<input type="text" name="contact_name" id="contact_name" class="form-control" placeholder="Enter Level Name">
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-primary"><?php echo esc_html('Add Level', 'house-configurator'); ?></button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
    <?php
}
