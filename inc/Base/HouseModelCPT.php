<?php
/**
 * @package  HouseConfigurator
 */

namespace Inc\Base;

use Inc\Base\BaseController;

class HouseModelCPT extends BaseController
{
    public function register()
    {
        /*
        =============================== Custom Post Type ===============================
        */
        add_action('init', array($this, 'custom_post_type'));
        /*
        =============================== Custom Taxonomy ===============================
        */
        add_action('init', array($this, 'floor_tiles_taxonomy'));
        /*
        // Add form field "price" and "image" to floor_tile taxonomy page
        */
        add_action('floor_tile_add_form_fields', array($this, 'add_floor_tile_price_field'), 10, 2);
        add_action('floor_tile_edit_form_fields', array($this, 'edit_floor_tile_price_field'), 10, 2);
        add_action('created_floor_tile', array($this, 'save_floor_tile_price_field'), 10, 2);
        add_action('edited_floor_tile', array($this, 'save_floor_tile_price_field'), 10, 2);
        add_action('delete_floor_tile', array($this, 'delete_floor_tile_price_field'), 10, 2);


        add_action('floor_tile_add_form_fields', array($this, 'add_floor_tile_image_field'), 10, 2);
        add_action('floor_tile_edit_form_fields', array($this, 'edit_floor_tile_image_field'), 10, 2);
        add_action('created_floor_tile', array($this, 'save_floor_tile_image_field'), 10, 2);
        add_action('edited_floor_tile', array($this, 'save_floor_tile_image_field'), 10, 2);
        add_action('delete_floor_tile', array($this, 'delete_floor_tile_image_field'), 10, 2);

        /*
        // Add column "price" to floor_tile taxonomy page
        */
        add_filter('manage_edit-floor_tile_columns', array($this, 'add_floor_tile_price_column'));
        add_filter('manage_floor_tile_custom_column', array($this, 'add_floor_tile_price_column_content'), 10, 3);
        
        /*
        // house_model custom post type single page
        */
        add_filter('single_template', array($this, 'house_model_single_template'));
    }

    public function custom_post_type()
    {
        $labels = array(
            'name' => 'House Models',
            'singular_name' => 'House Model',
            'add_new' => 'Add House Model',
            'all_items' => 'All House Models',
            'add_new_item' => 'Add House Model',
            'edit_item' => 'Edit House Model',
            'new_item' => 'New House Model',
            'view_item' => 'View House Model',
            'search_item' => 'Search House Model',
            'not_found' => 'No House Model found',
            'not_found_in_trash' => 'No House Model found in trash',
            'parent_item_colon' => 'Parent House Model',
        );
        $args = array(
            'labels' => $labels,
            'public' => true,
            'has_archive' => true,
            'publicly_queryable' => true,
            'query_var' => true,
            'rewrite' => true,
            'capability_type' => 'post',
            'hierarchical' => false,
            'supports' => array(
                'title',
                'editor',
                'excerpt',
                'thumbnail',
                'revisions',
            ),
            'taxonomies' => array('category', 'post_tag'),
            'menu_position' => 26,
            'exclude_from_search' => false,
        );
        register_post_type('house_model', $args);
    }

    /*
    ======================================== Floor Tiles Taxonomies =================================================
    */
    
    public function floor_tiles_taxonomy()
    {
        $labels = array(
            'name' => _x('Floor Tiles', 'taxonomy general name'),
            'singular_name' => _x('Floor Tile', 'taxonomy singular name'),
            'search_items' => __('Search Floor Tiles'),
            'all_items' => __('All Floor Tiles'),
            'parent_item' => __('Parent Floor Tile'),
            'parent_item_colon' => __('Parent Floor Tile:'),
            'edit_item' => __('Edit Floor Tile'),
            'update_item' => __('Update Floor Tile'),
            'add_new_item' => __('Add New Floor Tile'),
            'new_item_name' => __('New Floor Tile Name'),
            'menu_name' => __('Floor Tiles'),
        );

        // Now register the taxonomy
        register_taxonomy('floor_tile', array('house_model'), array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'floor-tile'),
        ));
    }
    /*
    ========================================== End Floor Tiles Taxonomies =========================================
    */

    /*
    ======================================== Add Column to Floor Tiles Taxonomy =====================================
    */
    public function add_floor_tile_price_column($columns)
    {
        $columns['floor_tile_price'] = __('Price', 'houseconfigurator');
        $columns['floor_tile_image'] = __('Image', 'houseconfigurator');
        $columns = array_slice( $columns, 0, 2, true ) + array( 'floor_tile_price' => __( 'Price', 'house-configurator' ) ) + array_slice( $columns, 2, null, true );
        $columns = array_slice( $columns, 0, 3, true ) + array( 'floor_tile_image' => __( 'Image', 'house-configurator' ) ) + array_slice( $columns, 3, null, true );

        return $columns;
    }

    public function add_floor_tile_price_column_content($content, $column_name, $term_id)
    {
        if ( 'floor_tile_price' === $column_name ) {
            $term_meta = get_option( "taxonomy_$term_id" );
            $price = $term_meta['floor_tile_price'] ? $term_meta['floor_tile_price'] : '-';
            $content = '<span class="floor_tile_price">' . $price . '</span>';
        }

        if ( 'floor_tile_image' === $column_name ) {
            $term_meta = get_option( "taxonomy_$term_id" );
            $image = $term_meta['floor_tile_image'] ? '<img src="' . $term_meta['floor_tile_image'] . '" width="30" height="30" />' : '-';
            $content = '<span class="floor_tile_image">' . $image . '</span>';
        }


        return $content;
    }

    

    /*
    ======================================== Add Custom Field =================================================
    */
    /**
     * Add custom field to floor_tile taxonomy ['price', 'image']
     */
    public function add_floor_tile_price_field() {
        // this will add the custom meta field to the add new term page
        ?>
        <div class="form-field">
            <label for="floor_tile_price"><?php _e('Price', 'houseconfigurator'); ?></label>
            <input type="text" name="floor_tile_price" id="floor_tile_price" value="">
            <p class="description"><?php _e('Enter a value for this field', 'houseconfigurator'); ?></p>
        </div>
        <?php
    }

    public function add_floor_tile_image_field() {
        // image field should be able to upload image from media library with preview
        wp_enqueue_media();
        ?>
        <!-- upload image and preview with hidden input value -->
        <div class="form-field">
            <label for="floor_tile_image"><?php _e('Image', 'houseconfigurator'); ?></label>
            <input type="hidden" name="floor_tile_image" id="floor_tile_image" value="">

            <div class="image-preview-wrapper">
                <img id="image-preview" src="<?php echo esc_url( plugins_url( 'house-configurator/assets/placeholder.png' ) ); ?>" alt="Image preview" style="max-width: 200px;">
            </div>
            <input id="upload_image_button" type="button" class="button" value="<?php _e('Upload image', 'houseconfigurator'); ?>">
            <p class="description"><?php _e('Upload image for this field', 'houseconfigurator'); ?></p>
        </div>
        
        <script>
            jQuery(document).ready(function($){
                // Instantiates the variable that holds the media library frame.
                var meta_image_frame;
                // Runs when the image button is clicked.
                $('#upload_image_button').click(function(e){
                    // Prevents the default action from occuring.
                    e.preventDefault();
                    var meta_image = $('#floor_tile_image'); // use ID instead of name attribute
                    // If the field already has a value, set it as the default display
                    var default_image = $('#image-preview').attr('src');
                    if (meta_image.val() !== '') {
                        default_image = meta_image.val();
                    }
                    // If the frame already exists, re-open it.
                    if ( meta_image_frame ) {
                        meta_image_frame.open();
                        return;
                    }
                    // Sets up the media library frame
                    meta_image_frame = wp.media.frames.meta_image_frame = wp.media({
                        title: meta_image.title,
                        button: { text:  meta_image.button },
                        library: { type: 'image' }
                    });
                    // Runs when an image is selected.
                    meta_image_frame.on('select', function(){
                        // Grabs the attachment selection and creates a JSON representation of the model.
                        var media_attachment = meta_image_frame.state().get('selection').first().toJSON();
                        // Sends the attachment URL to our custom image input field.
                        meta_image.val(media_attachment.url);
                        $('#image-preview').attr('src', media_attachment.url);
                    });
                    // Opens the media library frame with default image set
                    meta_image_frame.on('open',function() {
                        var selection = meta_image_frame.state().get('selection');
                        var default_image_src = default_image;
                        if (default_image_src !== '') {
                            var attachment = wp.media.attachment(default_image_src);
                            attachment.fetch();
                            selection.add( attachment ? [ attachment ] : [] );
                        }
                    });
                    meta_image_frame.open();
                });
            });
        </script>

        <?php
    }

    /*
    ======================================== Edit Custom Field =================================================
    */
    /**
     * Edit custom field to floor_tile taxonomy ['price', 'image']
     */
    public function edit_floor_tile_price_field( $term ) {
        $t_id = $term->term_id;
        $term_meta = get_option( "taxonomy_$t_id" );
        ?>
        <tr class="form-field">
            <th scope="row" valign="top"><label for="floor_tile_price"><?php _e('Price', 'houseconfigurator'); ?></label></th>
            <td>
                <input type="text" name="floor_tile_price" id="floor_tile_price" value="<?php echo esc_attr( isset( $term_meta['floor_tile_price'] ) ? $term_meta['floor_tile_price'] : '' ); ?>">
                <p class="description"><?php _e('Enter a value for this field', 'houseconfigurator'); ?></p>
            </td>
        </tr>
        <?php
    }    

    public function edit_floor_tile_image_field( $term ) {
        wp_enqueue_media();
        $t_id = $term->term_id;
        $term_meta = get_option( "taxonomy_$t_id" );
        $floor_tile_image = isset( $term_meta['floor_tile_image'] ) ? $term_meta['floor_tile_image'] : '';
        ?>
        <!-- upload image and preview with hidden input value -->
        <tr class="form-field">
            <th scope="row" valign="top"><label for="floor_tile_image"><?php _e('Image', 'houseconfigurator'); ?></label></th>
            <td>
                <input type="hidden" name="floor_tile_image" id="floor_tile_image" value="<?php echo esc_attr( $floor_tile_image ); ?>">
                <div class="image-preview-wrapper">
                    <img id="image-preview" src="<?php echo esc_attr( $floor_tile_image ? $floor_tile_image : esc_url( plugins_url( 'house-configurator/assets/placeholder.png' ) ) ); ?>" alt="Image preview" style="max-width: 200px;">
                </div>
                <input id="upload_image_button" type="button" class="button" value="<?php _e('Upload image', 'houseconfigurator'); ?>">
                <p class="description"><?php _e('Upload image for this field', 'houseconfigurator'); ?></p>
            </td>
        </tr>
    
        <script>
            jQuery(document).ready(function($){
                // Instantiates the variable that holds the media library frame.
                var meta_image_frame;
                // Runs when the image button is clicked.
                $('#upload_image_button').click(function(e){
                    // Prevents the default action from occuring.
                    e.preventDefault();
                    var meta_image = $('#floor_tile_image');
                    // If the frame already exists, re-open it.
                    if ( meta_image_frame ) {
                        meta_image_frame.open();
                        return;
                    }
                    // Sets up the media library frame
                    meta_image_frame = wp.media.frames.meta_image_frame = wp.media({
                        title: meta_image.title,
                        button: { text:  meta_image.button },
                        library: { type: 'image' }
                    });
                    // Runs when an image is selected.
                    meta_image_frame.on('select', function(){
                        // Grabs the attachment selection and creates a JSON representation of the model.
                        var media_attachment = meta_image_frame.state().get('selection').first().toJSON();
                        // Sends the attachment URL to our custom image input field.
                        meta_image.val(media_attachment.url);
                        $('#image-preview').attr('src', media_attachment.url);
                    });
                    // Opens the media library frame.
                    meta_image_frame.open();
                });
            });
        </script>
        <?php
    }
    

    /*
    ======================================== Save Custom Field =================================================
    */
    /**
     * Save custom field to floor_tile taxonomy ['price', 'image']
     */
    public function save_floor_tile_price_field( $term_id ) {
       // save and update both
        if ( isset( $_POST['floor_tile_price'] ) ) {
            $t_id = $term_id;
            $term_meta = get_option( "taxonomy_$t_id" );
            $term_meta['floor_tile_price'] = $_POST['floor_tile_price'];
            update_option( "taxonomy_$t_id", $term_meta );
        }
        else {
            $t_id = $term_id;
            $term_meta = get_option( "taxonomy_$t_id" );
            $term_meta['floor_tile_price'] = '';
            update_option( "taxonomy_$t_id", $term_meta );
        }
    }
    
    public function save_floor_tile_image_field( $term_id ) {
        if ( isset( $_POST['floor_tile_image'] ) ) {
            $t_id = $term_id;
            $term_meta = get_option( "taxonomy_$t_id" );
            $term_meta['floor_tile_image'] = $_POST['floor_tile_image'];
            update_option( "taxonomy_$t_id", $term_meta );
        }
        else {
            $t_id = $term_id;
            $term_meta = get_option( "taxonomy_$t_id" );
            $term_meta['floor_tile_image'] = '';
            update_option( "taxonomy_$t_id", $term_meta );
        }
    }


    /*
    ======================================== Delete Custom Field =================================================
    */
    /**
     * Delete custom field to floor_tile taxonomy ['price', 'image']
     */
    public function delete_floor_tile_price_field($term_id) {
        if ( isset( $_POST['floor_tile_price'] ) ) {
            // delete floor_tile_price
            $t_id = $term_id;
            $term_meta = get_option( "taxonomy_$t_id" );
            $cat_keys = array_keys( $_POST['term_meta'] );
            foreach ( $cat_keys as $key ) {
                if ( isset ( $_POST['term_meta'][$key] ) ) {
                    $term_meta[$key] = $_POST['term_meta'][$key];
                }
            }
            // Save the option array.
            update_option( "taxonomy_$t_id", $term_meta );
        }

        delete_option( "taxonomy_$t_id" );
    }

    public function delete_floor_tile_image_field($term_id) {
        if ( isset( $_POST['floor_tile_image'] ) ) {
            $t_id = $term_id;
            $term_meta = get_option( "taxonomy_$t_id" );
            $cat_keys = array_keys( $_POST['term_meta'] );
            foreach ( $cat_keys as $key ) {
                if ( isset ( $_POST['term_meta'][$key] ) ) {
                    $term_meta[$key] = $_POST['term_meta'][$key];
                }
            }
            // Save the option array.
            update_option( "taxonomy_$t_id", $term_meta );
        }

        delete_option( "taxonomy_$t_id" );

    }

    /*
    ======================================== End Custom Field =================================================
    */

    /*
    ======================================== Single Page Configuration =================================================
    */
    public function house_model_single_template() {
        if ( is_singular( 'house_model' ) ) {
            $template = plugin_dir_path( __FILE__ ) . 'single-house-model.php';
        }
        return $template;
    }

}