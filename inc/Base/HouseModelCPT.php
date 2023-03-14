<?php
/**
 * @package  HouseConfigurator
 */

namespace Inc\Base;

use Inc\Base\BaseController;

class HouseModelCPT
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
        add_action('init', array($this, 'sanitary_taxonomy'));
        add_action('init', array($this, 'bathroom_furniture_taxonomy'));
        add_action('init', array($this, 'accesories_taxonomy'));
        add_action('init', array($this, 'installation_taxonomy'));
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
        // Add column "price" and "image" to sanitary taxonomy page
        */
        add_filter('manage_edit-sanitary_columns', array($this, 'add_sanitary_price_column'));
        add_filter('manage_sanitary_custom_column', array($this, 'add_sanitary_price_column_content'), 10, 3);

        /**
         * Add form field "price" and "image" to sanitary taxonomy page
         */
        add_action('sanitary_add_form_fields', array($this, 'add_sanitary_price_field'), 10, 2);
        add_action('sanitary_edit_form_fields', array($this, 'edit_sanitary_price_field'), 10, 2);
        add_action('created_sanitary', array($this, 'save_sanitary_price_field'), 10, 2);
        add_action('edited_sanitary', array($this, 'save_sanitary_price_field'), 10, 2);
        add_action('delete_sanitary', array($this, 'delete_sanitary_price_field'), 10, 2);

        add_action('sanitary_add_form_fields', array($this, 'add_sanitary_image_field'), 10, 2);
        add_action('sanitary_edit_form_fields', array($this, 'edit_sanitary_image_field'), 10, 2);
        add_action('created_sanitary', array($this, 'save_sanitary_image_field'), 10, 2);
        add_action('edited_sanitary', array($this, 'save_sanitary_image_field'), 10, 2);
        add_action('delete_sanitary', array($this, 'delete_sanitary_image_field'), 10, 2);

        /*
        // Add column "price" and "image" to bathroom_furniture taxonomy page
        */
        add_filter('manage_edit-bathroom_furniture_columns', array($this, 'add_bathroom_furniture_price_column'));
        add_filter('manage_bathroom_furniture_custom_column', array($this, 'add_bathroom_furniture_price_column_content'), 10, 3);

        /**
         * Add form field "price" and "image" to bathroom_furniture taxonomy page
         */
        add_action('bathroom_furniture_add_form_fields', array($this, 'add_bathroom_furniture_price_field'), 10, 2);
        add_action('bathroom_furniture_edit_form_fields', array($this, 'edit_bathroom_furniture_price_field'), 10, 2);
        add_action('created_bathroom_furniture', array($this, 'save_bathroom_furniture_price_field'), 10, 2);
        add_action('edited_bathroom_furniture', array($this, 'save_bathroom_furniture_price_field'), 10, 2);
        add_action('delete_bathroom_furniture', array($this, 'delete_bathroom_furniture_price_field'), 10, 2);

        add_action('bathroom_furniture_add_form_fields', array($this, 'add_bathroom_furniture_image_field'), 10, 2);
        add_action('bathroom_furniture_edit_form_fields', array($this, 'edit_bathroom_furniture_image_field'), 10, 2);
        add_action('created_bathroom_furniture', array($this, 'save_bathroom_furniture_image_field'), 10, 2);
        add_action('edited_bathroom_furniture', array($this, 'save_bathroom_furniture_image_field'), 10, 2);
        add_action('delete_bathroom_furniture', array($this, 'delete_bathroom_furniture_image_field'), 10, 2);

        /*
        * Add column "price" and "image" to accesories taxonomy page
        */
        add_filter('manage_edit-accesories_columns', array($this, 'add_accesories_price_column'));
        add_filter('manage_accesories_custom_column', array($this, 'add_accesories_price_column_content'), 10, 3);

        /*
        * Add form field "price" and "image" to accesories taxonomy page
        */
        add_action('accesories_add_form_fields', array($this, 'add_accesories_price_field'), 10, 2);
        add_action('accesories_edit_form_fields', array($this, 'edit_accesories_price_field'), 10, 2);
        add_action('created_accesories', array($this, 'save_accesories_price_field'), 10, 2);
        add_action('edited_accesories', array($this, 'save_accesories_price_field'), 10, 2);
        add_action('delete_accesories', array($this, 'delete_accesories_price_field'), 10, 2);

        add_action('accesories_add_form_fields', array($this, 'add_accesories_image_field'), 10, 2);
        add_action('accesories_edit_form_fields', array($this, 'edit_accesories_image_field'), 10, 2);
        add_action('created_accesories', array($this, 'save_accesories_image_field'), 10, 2);
        add_action('edited_accesories', array($this, 'save_accesories_image_field'), 10, 2);
        add_action('delete_accesories', array($this, 'delete_accesories_image_field'), 10, 2);

        /*
        * Add column "price" and "image" to installation taxonomy page
        */
        add_filter('manage_edit-installation_columns', array($this, 'add_installation_price_column'));
        add_filter('manage_installation_custom_column', array($this, 'add_installation_price_column_content'), 10, 3);

        /*
        * Add form field "price" and "image" to installation taxonomy page
        */
        add_action('installation_add_form_fields', array($this, 'add_installation_price_field'), 10, 2);
        add_action('installation_edit_form_fields', array($this, 'edit_installation_price_field'), 10, 2);
        add_action('created_installation', array($this, 'save_installation_price_field'), 10, 2);
        add_action('edited_installation', array($this, 'save_installation_price_field'), 10, 2);
        add_action('delete_installation', array($this, 'delete_installation_price_field'), 10, 2);

        add_action('installation_add_form_fields', array($this, 'add_installation_image_field'), 10, 2);
        add_action('installation_edit_form_fields', array($this, 'edit_installation_image_field'), 10, 2);
        add_action('created_installation', array($this, 'save_installation_image_field'), 10, 2);
        add_action('edited_installation', array($this, 'save_installation_image_field'), 10, 2);
        add_action('delete_installation', array($this, 'delete_installation_image_field'), 10, 2);
        
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
            // 'taxonomies' => array('category', 'post_tag'),
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
    ======================================== Add Sanitary Taxonomy =====================================
    */
    public function sanitary_taxonomy()
    {
        $labels = array(
            'name' => _x('Sanitary', 'taxonomy general name'),
            'singular_name' => _x('Sanitary', 'taxonomy singular name'),
            'search_items' => __('Search Sanitary'),
            'all_items' => __('All Sanitary'),
            'parent_item' => __('Parent Sanitary'),
            'parent_item_colon' => __('Parent Sanitary:'),
            'edit_item' => __('Edit Sanitary'),
            'update_item' => __('Update Sanitary'),
            'add_new_item' => __('Add New Sanitary'),
            'new_item_name' => __('New Sanitary Name'),
            'menu_name' => __('Sanitary'),
        );

        // Now register the taxonomy
        register_taxonomy('sanitary', array('house_model'), array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'sanitary'),
        ));
    }
    /*
    ========================================== End Sanitary Taxonomies =========================================
    */

    /*
    ======================================== Add Bathroom furniture Taxnomony =====================================
    */
    public function bathroom_furniture_taxonomy()
    {
        $labels = array(
            'name' => _x('Bathroom Furniture', 'taxonomy general name'),
            'singular_name' => _x('Bathroom Furniture', 'taxonomy singular name'),
            'search_items' => __('Search Bathroom Furniture'),
            'all_items' => __('All Bathroom Furniture'),
            'parent_item' => __('Parent Bathroom Furniture'),
            'parent_item_colon' => __('Parent Bathroom Furniture:'),
            'edit_item' => __('Edit Bathroom Furniture'),
            'update_item' => __('Update Bathroom Furniture'),
            'add_new_item' => __('Add New Bathroom Furniture'),
            'new_item_name' => __('New Bathroom Furniture Name'),
            'menu_name' => __('Bathroom Furniture'),
        );

        // Now register the taxonomy
        register_taxonomy('bathroom_furniture', array('house_model'), array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'bathroom-furniture'),
        ));
    }
    /*
    ========================================== End Bathroom furniture Taxonomies =========================================
    */

    /*
    ======================================== Add Accesories Taxonomy =====================================
    */
    public function accesories_taxonomy()
    {
        $labels = array(
            'name' => _x('Accesories', 'taxonomy general name'),
            'singular_name' => _x('Accesories', 'taxonomy singular name'),
            'search_items' => __('Search Accesories'),
            'all_items' => __('All Accesories'),
            'parent_item' => __('Parent Accesories'),
            'parent_item_colon' => __('Parent Accesories:'),
            'edit_item' => __('Edit Accesories'),
            'update_item' => __('Update Accesories'),
            'add_new_item' => __('Add New Accesories'),
            'new_item_name' => __('New Accesories Name'),
            'menu_name' => __('Accesories'),
        );

        // Now register the taxonomy
        register_taxonomy('accesories', array('house_model'), array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'accesories'),
        ));
    }
    /*
    ========================================== End Accesories Taxonomies =========================================
    */

    /*
    ======================================== Add Installtion Taxonomy =====================================
    */
    public function installation_taxonomy()
    {
        $labels = array(
            'name' => _x('Installation', 'taxonomy general name'),
            'singular_name' => _x('Installation', 'taxonomy singular name'),
            'search_items' => __('Search Installation'),
            'all_items' => __('All Installation'),
            'parent_item' => __('Parent Installation'),
            'parent_item_colon' => __('Parent Installation:'),
            'edit_item' => __('Edit Installation'),
            'update_item' => __('Update Installation'),
            'add_new_item' => __('Add New Installation'),
            'new_item_name' => __('New Installation Name'),
            'menu_name' => __('Installation'),
        );

        // Now register the taxonomy
        register_taxonomy('installation', array('house_model'), array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'installation'),
        ));
    }

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
     ======================================== Add Column to Sanitary Taxonomy  =====================================
    */
    public function add_sanitary_price_column($columns)
    {
        $columns['sanitary_price'] = __('Price', 'houseconfigurator');
        $columns['sanitary_image'] = __('Image', 'houseconfigurator');
        $columns = array_slice( $columns, 0, 2, true ) + array( 'sanitary_price' => __( 'Price', 'house-configurator' ) ) + array_slice( $columns, 2, null, true );
        $columns = array_slice( $columns, 0, 3, true ) + array( 'sanitary_image' => __( 'Image', 'house-configurator' ) ) + array_slice( $columns, 3, null, true );

        return $columns;
    }

    public function add_sanitary_price_column_content($content, $column_name, $term_id)
    {
        if ( 'sanitary_price' === $column_name ) {
            $term_meta = get_option( "taxonomy_$term_id" );
            $price = $term_meta['sanitary_price'] ? $term_meta['sanitary_price'] : '-';
            $content = '<span class="sanitary_price">' . $price . '</span>';
        }

        if ( 'sanitary_image' === $column_name ) {
            $term_meta = get_option( "taxonomy_$term_id" );
            $image = $term_meta['sanitary_image'] ? '<img src="' . $term_meta['sanitary_image'] . '" width="30" height="30" />' : '-';
            $content = '<span class="sanitary_image">' . $image . '</span>';
        }
        
        return $content;
    }

    /*
    ======================================== Add Column to bathroom_furniture Taxonomy  =====================================
    */
    public function add_bathroom_furniture_price_column($columns)
    {
        $columns['bathroom_furniture_price'] = __('Price', 'houseconfigurator');
        $columns['bathroom_furniture_image'] = __('Image', 'houseconfigurator');
        $columns = array_slice( $columns, 0, 2, true ) + array( 'bathroom_furniture_price' => __( 'Price', 'house-configurator' ) ) + array_slice( $columns, 2, null, true );
        $columns = array_slice( $columns, 0, 3, true ) + array( 'bathroom_furniture_image' => __( 'Image', 'house-configurator' ) ) + array_slice( $columns, 3, null, true );

        return $columns;
    }

    public function add_bathroom_furniture_price_column_content($content, $column_name, $term_id)
    {
        if ( 'bathroom_furniture_price' === $column_name ) {
            $term_meta = get_option( "taxonomy_$term_id" );
            $price = $term_meta['bathroom_furniture_price'] ? $term_meta['bathroom_furniture_price'] : '-';
            $content = '<span class="bathroom_furniture_price">' . $price . '</span>';
        }

        if ( 'bathroom_furniture_image' === $column_name ) {
            $term_meta = get_option( "taxonomy_$term_id" );
            $image = $term_meta['bathroom_furniture_image'] ? '<img src="' . $term_meta['bathroom_furniture_image'] . '" width="30" height="30" />' : '-';
            $content = '<span class="bathroom_furniture_image">' . $image . '</span>';
        }
        
        return $content;
    }

    /*
    ======================================== Add Column to accesories Taxonomy  =====================================
    */
    public function add_accesories_price_column($columns)
    {
        $columns['accesories_price'] = __('Price', 'houseconfigurator');
        $columns['accesories_image'] = __('Image', 'houseconfigurator');
        $columns = array_slice( $columns, 0, 2, true ) + array( 'accesories_price' => __( 'Price', 'house-configurator' ) ) + array_slice( $columns, 2, null, true );
        $columns = array_slice( $columns, 0, 3, true ) + array( 'accesories_image' => __( 'Image', 'house-configurator' ) ) + array_slice( $columns, 3, null, true );

        return $columns;
    }

    public function add_accesories_price_column_content($content, $column_name, $term_id)
    {
        if ( 'accesories_price' === $column_name ) {
            $term_meta = get_option( "taxonomy_$term_id" );
            $price = $term_meta['accesories_price'] ? $term_meta['accesories_price'] : '-';
            $content = '<span class="accesories_price">' . $price . '</span>';
        }

        if ( 'accesories_image' === $column_name ) {
            $term_meta = get_option( "taxonomy_$term_id" );
            $image = $term_meta['accesories_image'] ? '<img src="' . $term_meta['accesories_image'] . '" width="30" height="30" />' : '-';
            $content = '<span class="accesories_image">' . $image . '</span>';
        }
        
        return $content;
    }

    /*
    ======================================== Add Column to installation Taxonomy  =====================================
    */
    public function add_installation_price_column($columns)
    {
        $columns['installation_price'] = __('Price', 'houseconfigurator');
        $columns['installation_image'] = __('Image', 'houseconfigurator');
        $columns = array_slice( $columns, 0, 2, true ) + array( 'installation_price' => __( 'Price', 'house-configurator' ) ) + array_slice( $columns, 2, null, true );
        $columns = array_slice( $columns, 0, 3, true ) + array( 'installation_image' => __( 'Image', 'house-configurator' ) ) + array_slice( $columns, 3, null, true );

        return $columns;
    }

    public function add_installation_price_column_content($content, $column_name, $term_id)
    {
        if ( 'installation_price' === $column_name ) {
            $term_meta = get_option( "taxonomy_$term_id" );
            $price = $term_meta['installation_price'] ? $term_meta['installation_price'] : '-';
            $content = '<span class="installation_price">' . $price . '</span>';
        }

        if ( 'installation_image' === $column_name ) {
            $term_meta = get_option( "taxonomy_$term_id" );
            $image = $term_meta['installation_image'] ? '<img src="' . $term_meta['installation_image'] . '" width="30" height="30" />' : '-';
            $content = '<span class="installation_image">' . $image . '</span>';
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
    * Add custom field to sanitary taxonomy ['price', 'image']
    */
    public function add_sanitary_price_field() {
        // this will add the custom meta field to the add new term page
        ?>
        <div class="form-field">
            <label for="sanitary_price"><?php _e('Price', 'houseconfigurator'); ?></label>
            <input type="text" name="sanitary_price" id="sanitary_price" value="">
            <p class="description"><?php _e('Enter a value for this field', 'houseconfigurator'); ?></p>
        </div>
        <?php
    }

    public function add_sanitary_image_field() {
        wp_enqueue_media();
        ?>
        <!-- upload image and preview with hidden input value -->
        <div class="form-field">
            <label for="sanitary_image"><?php _e('Image', 'houseconfigurator'); ?></label>
            <input type="hidden" name="sanitary_image" id="sanitary_image" value="">

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
                    var meta_image = $('#sanitary_image'); // use ID instead of name attribute
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
    * Add custom field to bathroom_furniture taxonomy ['price', 'image']
    */
    public function add_bathroom_furniture_price_field() {
        // this will add the custom meta field to the add new term page
        ?>
        <div class="form-field">
            <label for="bathroom_furniture_price"><?php _e('Price', 'houseconfigurator'); ?></label>
            <input type="text" name="bathroom_furniture_price" id="bathroom_furniture_price" value="">
            <p class="description"><?php _e('Enter a value for this field', 'houseconfigurator'); ?></p>
        </div>
        <?php
    }

    public function add_bathroom_furniture_image_field() {
        wp_enqueue_media();
        ?>
        <!-- upload image and preview with hidden input value -->
        <div class="form-field">
            <label for="bathroom_furniture_image"><?php _e('Image', 'houseconfigurator'); ?></label>
            <input type="hidden" name="bathroom_furniture_image" id="bathroom_furniture_image" value="">

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
                    var meta_image = $('#bathroom_furniture_image'); // use ID instead of name attribute
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
    * Add custom field to accesories taxonomy ['price', 'image']
    */
    public function add_accesories_price_field() {
        // this will add the custom meta field to the add new term page
        ?>
        <div class="form-field">
            <label for="accesories_price"><?php _e('Price', 'houseconfigurator'); ?></label>
            <input type="text" name="accesories_price" id="accesories_price" value="">
            <p class="description"><?php _e('Enter a value for this field', 'houseconfigurator'); ?></p>
        </div>
        <?php
    }

    public function add_accesories_image_field() {
        wp_enqueue_media();
        ?>
        <!-- upload image and preview with hidden input value -->
        <div class="form-field">
            <label for="accesories_image"><?php _e('Image', 'houseconfigurator'); ?></label>
            <input type="hidden" name="accesories_image" id="accesories_image" value="">

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
                    var meta_image = $('#accesories_image'); // use ID instead of name attribute
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
    * Add custom field to installation taxonomy ['price', 'image']
    */
    public function add_installation_price_field() {
        // this will add the custom meta field to the add new term page
        ?>
        <div class="form-field">
            <label for="installation_price"><?php _e('Price', 'houseconfigurator'); ?></label>
            <input type="text" name="installation_price" id="installation_price" value="">
            <p class="description"><?php _e('Enter a value for this field', 'houseconfigurator'); ?></p>
        </div>
        <?php
    }

    public function add_installation_image_field() {
        wp_enqueue_media();
        ?>
        <!-- upload image and preview with hidden input value -->
        <div class="form-field">
            <label for="installation_image"><?php _e('Image', 'houseconfigurator'); ?></label>
            <input type="hidden" name="installation_image" id="installation_image" value="">

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
                    var meta_image = $('#installation_image'); // use ID instead of name attribute
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

    /**
     * Edit custom field to sanitary taxonomy ['price', 'image']
    */
    public function edit_sanitary_price_field( $term ) {
        $t_id = $term->term_id;
        $term_meta = get_option( "taxonomy_$t_id" );
        ?>
        <tr class="form-field">
            <th scope="row" valign="top"><label for="sanitary_price"><?php _e('Price', 'houseconfigurator'); ?></label></th>
            <td>
                <input type="text" name="sanitary_price" id="sanitary_price" value="<?php echo esc_attr( isset( $term_meta['sanitary_price'] ) ? $term_meta['sanitary_price'] : '' ); ?>">
                <p class="description"><?php _e('Enter a value for this field', 'houseconfigurator'); ?></p>
            </td>
        </tr>
        <?php
    }
    
    public function edit_sanitary_image_field( $term )
    {
        wp_enqueue_media();
        $t_id = $term->term_id;
        $term_meta = get_option( "taxonomy_$t_id" );
        $sanitary_image = isset( $term_meta['sanitary_image'] ) ? $term_meta['sanitary_image'] : '';
        ?>
        <!-- upload image and preview with hidden input value -->
        <tr class="form-field">
            <th scope="row" valign="top"><label for="sanitary_image"><?php _e('Image', 'houseconfigurator'); ?></label></th>
            <td>
                <input type="hidden" name="sanitary_image" id="sanitary_image" value="<?php echo esc_attr( $sanitary_image ); ?>">
                <div class="image-preview-wrapper">
                    <img id="image-preview" src="<?php echo esc_attr( $sanitary_image ? $sanitary_image : esc_url( plugins_url( 'house-configurator/assets/placeholder.png' ) ) ); ?>" alt="Image preview" style="max-width: 200px;">
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
                    var meta_image = $('#sanitary_image');
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
    * Edit custom field to bathroom_furniture taxonomy ['price', 'image']
    */
    public function edit_bathroom_furniture_price_field( $term )
    {
        $t_id = $term->term_id;
        $term_meta = get_option( "taxonomy_$t_id" );
        ?>
        <tr class="form-field">
            <th scope="row" valign="top"><label for="bathroom_furniture_price"><?php _e('Price', 'houseconfigurator'); ?></label></th>
            <td>
                <input type="text" name="bathroom_furniture_price" id="bathroom_furniture_price" value="<?php echo esc_attr( isset( $term_meta['bathroom_furniture_price'] ) ? $term_meta['bathroom_furniture_price'] : '' ); ?>">
                <p class="description"><?php _e('Enter a value for this field', 'houseconfigurator'); ?></p>
            </td>
        </tr>
        <?php
    }

    public function edit_bathroom_furniture_image_field( $term ) {
        wp_enqueue_media();
        $t_id = $term->term_id;
        $term_meta = get_option( "taxonomy_$t_id" );
        $bathroom_furniture_image = isset( $term_meta['bathroom_furniture_image'] ) ? $term_meta['bathroom_furniture_image'] : '';
        ?>
        <!-- upload image and preview with hidden input value -->
        <tr class="form-field">
            <th scope="row" valign="top"><label for="bathroom_furniture_image"><?php _e('Image', 'houseconfigurator'); ?></label></th>
            <td>
                <input type="hidden" name="bathroom_furniture_image" id="bathroom_furniture_image" value="<?php echo esc_attr( $bathroom_furniture_image ); ?>">
                <div class="image-preview-wrapper">
                    <img id="image-preview" src="<?php echo esc_attr( $bathroom_furniture_image ? $bathroom_furniture_image : esc_url( plugins_url( 'house-configurator/assets/placeholder.png' ) ) ); ?>" alt="Image preview" style="max-width: 200px;">
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
                    var meta_image = $('#bathroom_furniture_image');
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
    * Edit custom field to accesories taxonomy ['price', 'image']
    */
    public function edit_accesories_price_field( $term ) {
        $t_id = $term->term_id;
        $term_meta = get_option( "taxonomy_$t_id" );
        ?>
        <tr class="form-field">
            <th scope="row" valign="top"><label for="accesories_price"><?php _e('Price', 'houseconfigurator'); ?></label></th>
            <td>
                <input type="text" name="accesories_price" id="accesories_price" value="<?php echo esc_attr( isset( $term_meta['accesories_price'] ) ? $term_meta['accesories_price'] : '' ); ?>">
                <p class="description"><?php _e('Enter a value for this field', 'houseconfigurator'); ?></p>
            </td>
        </tr>
        <?php
    }

    public function edit_accesories_image_field( $term )
    {
        wp_enqueue_media();
        $t_id = $term->term_id;
        $term_meta = get_option( "taxonomy_$t_id" );
        $accesories_image = isset( $term_meta['accesories_image'] ) ? $term_meta['accesories_image'] : '';
        ?>
        <tr class="form-field">
            <th scope="row" valign="top"><label for="accesories_image"><?php _e('Image', 'houseconfigurator'); ?></label></th>
            <td>
                <input type="hidden" name="accesories_image" id="accesories_image" value="<?php echo esc_attr( $accesories_image ); ?>">
                <div class="image-preview-wrapper">
                    <img id="image-preview" src="<?php echo esc_attr( $accesories_image ? $accesories_image : esc_url( plugins_url( 'house-configurator/assets/placeholder.png' ) ) ); ?>" alt="Image preview" style="max-width: 200px;">
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
                    var meta_image = $('#accesories_image');
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
    * Edit custom field to installation taxonomy ['price', 'image']
    */
    public function edit_installation_price_field( $term ) {
        $t_id = $term->term_id;
        $term_meta = get_option( "taxonomy_$t_id" );
        ?>
        <tr class="form-field">
            <th scope="row" valign="top"><label for="installation_price"><?php _e('Price', 'houseconfigurator'); ?></label></th>
            <td>
                <input type="text" name="installation_price" id="installation_price" value="<?php echo esc_attr( isset( $term_meta['installation_price'] ) ? $term_meta['installation_price'] : '' ); ?>">
                <p class="description"><?php _e('Enter a value for this field', 'houseconfigurator'); ?></p>
            </td>
        </tr>
        <?php
    }

    public function edit_installation_image_field( $term )
    {
        wp_enqueue_media();
        $t_id = $term->term_id;
        $term_meta = get_option( "taxonomy_$t_id" );
        $installation_image = isset( $term_meta['installation_image'] ) ? $term_meta['installation_image'] : '';
        ?>
        <tr class="form-field">
            <th scope="row" valign="top"><label for="installation_image"><?php _e('Image', 'houseconfigurator'); ?></label></th>
            <td>
                <input type="hidden" name="installation_image" id="installation_image" value="<?php echo esc_attr( $installation_image ); ?>">
                <div class="image-preview-wrapper">
                    <img id="image-preview" src="<?php echo esc_attr( $installation_image ? $installation_image : esc_url( plugins_url( 'house-configurator/assets/placeholder.png' ) ) ); ?>" alt="Image preview" style="max-width: 200px;">
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
                    var meta_image = $('#installation_image');
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

    /**
     * Save custom field to sanitary taxonomy ['price', 'image']
     */
    public function save_sanitary_price_field( $term_id ) {
        if ( isset( $_POST['sanitary_price'] ) ) {
            $t_id = $term_id;
            $term_meta = get_option( "taxonomy_$t_id" );
            $term_meta['sanitary_price'] = $_POST['sanitary_price'];
            update_option( "taxonomy_$t_id", $term_meta );
        }
        else {
            $t_id = $term_id;
            $term_meta = get_option( "taxonomy_$t_id" );
            $term_meta['sanitary_price'] = '';
            update_option( "taxonomy_$t_id", $term_meta );
        }
    }

    public function save_sanitary_image_field( $term_id ) {
        if ( isset( $_POST['sanitary_image'] ) ) {
            $t_id = $term_id;
            $term_meta = get_option( "taxonomy_$t_id" );
            $term_meta['sanitary_image'] = $_POST['sanitary_image'];
            update_option( "taxonomy_$t_id", $term_meta );
        }
        else {
            $t_id = $term_id;
            $term_meta = get_option( "taxonomy_$t_id" );
            $term_meta['sanitary_image'] = '';
            update_option( "taxonomy_$t_id", $term_meta );
        }
    }

    /*
    * Save custom field to bathroom_furniture taxonomy ['price', 'image']
    */
    public function save_bathroom_furniture_price_field( $term_id ) {
        if ( isset( $_POST['bathroom_furniture_price'] ) ) {
            $t_id = $term_id;
            $term_meta = get_option( "taxonomy_$t_id" );
            $term_meta['bathroom_furniture_price'] = $_POST['bathroom_furniture_price'];
            update_option( "taxonomy_$t_id", $term_meta );
        }
        else {
            $t_id = $term_id;
            $term_meta = get_option( "taxonomy_$t_id" );
            $term_meta['bathroom_furniture_price'] = '';
            update_option( "taxonomy_$t_id", $term_meta );
        }
    }

    public function save_bathroom_furniture_image_field( $term_id ) {
        if ( isset( $_POST['bathroom_furniture_image'] ) ) {
            $t_id = $term_id;
            $term_meta = get_option( "taxonomy_$t_id" );
            $term_meta['bathroom_furniture_image'] = $_POST['bathroom_furniture_image'];
            update_option( "taxonomy_$t_id", $term_meta );
        }
        else {
            $t_id = $term_id;
            $term_meta = get_option( "taxonomy_$t_id" );
            $term_meta['bathroom_furniture_image'] = '';
            update_option( "taxonomy_$t_id", $term_meta );
        }
    }

    /*
    * Save custom field to accesories taxonomy ['price', 'image']
    */
    public function save_accesories_price_field( $term_id ) {
        if ( isset( $_POST['accesories_price'] ) ) {
            $t_id = $term_id;
            $term_meta = get_option( "taxonomy_$t_id" );
            $term_meta['accesories_price'] = $_POST['accesories_price'];
            update_option( "taxonomy_$t_id", $term_meta );
        }
        else {
            $t_id = $term_id;
            $term_meta = get_option( "taxonomy_$t_id" );
            $term_meta['accesories_price'] = '';
            update_option( "taxonomy_$t_id", $term_meta );
        }
    }

    public function save_accesories_image_field( $term_id ) {
        if ( isset( $_POST['accesories_image'] ) ) {
            $t_id = $term_id;
            $term_meta = get_option( "taxonomy_$t_id" );
            $term_meta['accesories_image'] = $_POST['accesories_image'];
            update_option( "taxonomy_$t_id", $term_meta );
        }
        else {
            $t_id = $term_id;
            $term_meta = get_option( "taxonomy_$t_id" );
            $term_meta['accesories_image'] = '';
            update_option( "taxonomy_$t_id", $term_meta );
        }
    }

    /**
     * Save custom field to installation taxonomy ['price', 'image']
     */
    public function save_installation_price_field( $term_id ) {
        if ( isset( $_POST['installation_price'] ) ) {
            $t_id = $term_id;
            $term_meta = get_option( "taxonomy_$t_id" );
            $term_meta['installation_price'] = $_POST['installation_price'];
            update_option( "taxonomy_$t_id", $term_meta );
        }
        else {
            $t_id = $term_id;
            $term_meta = get_option( "taxonomy_$t_id" );
            $term_meta['installation_price'] = '';
            update_option( "taxonomy_$t_id", $term_meta );
        }
    }

    public function save_installation_image_field( $term_id ) {
        if ( isset( $_POST['installation_image'] ) ) {
            $t_id = $term_id;
            $term_meta = get_option( "taxonomy_$t_id" );
            $term_meta['installation_image'] = $_POST['installation_image'];
            update_option( "taxonomy_$t_id", $term_meta );
        }
        else {
            $t_id = $term_id;
            $term_meta = get_option( "taxonomy_$t_id" );
            $term_meta['installation_image'] = '';
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

    /**
     * Delete custom field to sanitary taxonomy ['price', 'image']
     */
    public function delete_sanitary_price_field($term_id) {
        if ( isset( $_POST['sanitary_price'] ) ) {
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

    public function delete_sanitary_image_field($term_id) {
        if ( isset( $_POST['sanitary_image'] ) ) {
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
    public function house_model_single_template($template) {
        if ( is_singular( 'house_model' ) ) {
            $template = plugin_dir_path( __FILE__ ) . 'single-house-model.php';
        }
        return $template;
    }

}