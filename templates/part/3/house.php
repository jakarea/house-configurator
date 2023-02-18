<div class="table-header d-flex justify-content-between mb-3">
    <h4><?php echo esc_html('Manage Houses / Add Levels', 'house-configurator'); ?></h4>
    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addHouseModal">Add New</button>
</div>
<table class="table table-hover house_configurator_table">
    <thead>
        <tr>
            <th>ID</th>
            <th>House Name</th>
            <th>House Description</th>
            <th>House Price</th>
			<th>House Image</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
            global $wpdb;
            $houses = $wpdb->prefix . 'house_configurator_part_3';
            $houses = $wpdb->get_results("SELECT * FROM $houses");
            if( $levels ) {
                foreach ($houses as $key => $house) {
                    ?>
                    <tr>
                        <td><?php echo $key+1; ?></td>
                        <td><?php echo $house->name; ?></td>
                        <td>
                            <?php
                                $description = $house->description;
                                $description = substr($description, 0, 50);
                                echo $description . '...';
                            ?>
                        </td>
                        <td><?php echo '€ '.$house->price; ?></td>
                        <td>
                            <!-- get directory of wp-content -->
                            <?php
                                $upload_dir = wp_upload_dir();
                                $upload_dir = $upload_dir['baseurl'];
                                $upload_dir = $upload_dir . '/house-configurator/house_image/';
                                $upload_dir_image = $upload_dir . $house->image;
                            ?>
                            <img src="<?php echo ''. $upload_dir_image; ?>" alt="<?php echo $house->name; ?>" width="20" height="20">
                        </td>
                        <td>
                            <a href="<?php echo admin_url('admin.php?page=house_config_house_part_three&edit_house=' . $house->id); ?>" class="button button-primary">Edit</a>
                            <a href="<?php echo admin_url('admin.php?page=house_config_house_part_three&delete_house=' . $house->id); ?>" class="button button-primary">Delete</a>
                        </td>
                    </tr>
                    <?php
                }
            }
            else {
                ?>
                <tr>
                    <td colspan="4">No House Found</td>
                </tr>
                <?php
            }
        ?>
    </tbody>
</table>
<?php createFormforHouse(); ?>
<?php updateHouse(); ?>
<?php deleteHouse(); ?>
<?php
/**
 * Create form for house name and price
 */
function getHouseLevels() {
    global $wpdb;
    $house_levels = $wpdb->prefix . 'house_configurator_part_3_level';
    $levels = $wpdb->get_results("SELECT * FROM $house_levels");
    return $levels;
}
function createFormforHouse() {
	// create form for lavel name and price with lebel name and price
	?>
	<div class="modal fade" id="addHouseModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="addHouseModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="addHouseModalLabel">Add New House</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="<?php echo esc_attr('admin-post.php'); ?>" method="post" enctype="multipart/form-data">
						<input type="hidden" name="action" value="part_3_house_data_action" />
						<div class="form-group">
							<label for="house_name">House Name</label>
							<input type="text" name="house_name" id="house_name" class="form-control" placeholder="Enter House Name">
						</div>
                        <div class="form-group">
                            <label for="house_level">House Level</label><br />
                            <?php
                                foreach(getHouseLevels() as $level)
                                {
                                    echo '<div class="form-check form-check-inline">';
                                    echo '<input class="form-check-input" type="checkbox" name="house_level[]" id="house_level'.$level->id.'" value="'.$level->id.'">';
                                    echo '<label class="form-check-label" for="house_level'.$level->id.'">'.$level->name.'</label>';
                                    echo '</div>';
                                }
                            ?>
                        </div>
                        <div class="form-group mt-3">
                            <label for="house_description">House Description</label>
                            <?php
                                $content = ''; // Initialize the content variable

                                // Get the editor ID
                                $editor_id = 'house_description';
                                
                                // Generate the editor
                                wp_editor( $content, $editor_id );
                            ?>
                        </div>
						<div class="form-group">
							<label for="house_price">House Price</label>
							<input type="number" name="house_price" id="house_price" class="form-control" placeholder="Enter House Price">
						</div>
                        <div class="form-group">
                            <label for="house_image">House House Image</label>
                            <input type="file" name="house_image" id="house_image" class="form-control" placeholder="Enter House Image" onchange="document.getElementById('house__preview_image').src = window.URL.createObjectURL(this.files[0])" required>
                            <img src="https://via.placeholder.com/100" alt="img" class="img-fluid mt-2" id="house__preview_image">
                        </div>
				</div>
				<div class="card-footer d-flex justify-content-between">
						<button type="submit" class="btn btn-primary btn-block">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<?php
}

function updateHouse() {

}

function deleteHouse() {
    if (isset($_GET['delete_house'])) {
		// delete level with confirm message and set id to $_GET['delete'] then send to function
		?>
			<script type="text/javascript">
				var r = confirm("Are you sure you want to delete this level?");
				if (r == true) {
					window.location.href = "<?php echo admin_url('admin-post.php?action=delete_house_data_action&house_id=' . $_GET['delete_house']); ?>";
				} else {
					window.location.href = "<?php echo admin_url('admin.php?page=house_config_house_part_three'); ?>";
				}
			</script>
		<?php
	}
}