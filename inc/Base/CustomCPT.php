<?php
/**
 * @package  HouseConfigurator
 */

namespace Inc\Base;

use Inc\Base\BaseController;

/**
 * register custom post type for part-there with one custome field [price] and two taxonomies [level, option]
 */
class CustomCPT extends BaseController
{
    public function __construct() {
        /*===============================================================
        * Level Taxonomy Custom Columns and fields
        */
        add_filter( 'manage_edit-level_columns', array( $this, 'addCustomColumnsToLevelHeader' ) );
        add_filter( 'manage_level_custom_column', array( $this, 'addCustomColumnsToLevel' ), 10, 3 );
        /*===============================================================
        * Level Taxonomy Custom Fields
        */
        add_action( 'level_add_form_fields', array( $this, 'addCustomFieldsToLevel' ) );
        add_action( 'create_level', array( $this, 'saveCustomFieldsToLevel' ), 10, 2 );
        add_action( 'level_edit_form_fields', array( $this, 'editCustomFieldsToLevel' ) );
        add_action( 'edited_level', array( $this, 'updateCustomFieldsToLevel' ), 10, 2 );
        /*===============================================================
        * Option Taxonomy Custom Columns and fields
        */
        add_filter( 'manage_edit-option_columns', array( $this, 'addCustomColumnsToOptionHeader' ) );
        add_filter( 'manage_option_custom_column', array( $this, 'addCustomColumnsToOption' ), 10, 3 );
        /*===============================================================
        * Option Taxonomy Custom Fields
        */
        add_action( 'option_add_form_fields', array( $this, 'addCustomFieldsToOption' ) );
        add_action( 'create_option', array( $this, 'saveCustomFieldsToOption' ), 10, 2 );
        add_action( 'option_edit_form_fields', array( $this, 'editCustomFieldsToOption' ) );
        add_action( 'edited_option', array( $this, 'updateCustomFieldsToOption' ), 10, 2 );
        /*===============================================================
        /* fwidth Taxonomy Custom Columns and fields
        */
        add_filter( 'manage_edit-fwidth_columns', array( $this, 'addCustomColumnsToFwidthHeader' ) );
        add_filter( 'manage_fwidth_custom_column', array( $this, 'addCustomColumnsToFwidth' ), 10, 3 );
        
        add_action( 'fwidth_add_form_fields', array( $this, 'addCustomFieldsToFwidth' ) );
        add_action( 'create_fwidth', array( $this, 'saveCustomFieldsToFwidth' ), 10, 2 );
        add_action( 'fwidth_edit_form_fields', array( $this, 'editCustomFieldsToFwidth' ) );
        add_action( 'edited_fwidth', array( $this, 'updateCustomFieldsToFwidth' ), 10, 2 );
        /*===============================================================
        /* twidth Taxonomy Custom Columns and fields
        */
        add_filter( 'manage_edit-twidth_columns', array( $this, 'addCustomColumnsToTwidthHeader' ) );
        add_filter( 'manage_twidth_custom_column', array( $this, 'addCustomColumnsToTwidth' ), 10, 3 );

        add_action( 'twidth_add_form_fields', array( $this, 'addCustomFieldsToTwidth' ) );
        add_action( 'create_twidth', array( $this, 'saveCustomFieldsToTwidth' ), 10, 2 );
        add_action( 'twidth_edit_form_fields', array( $this, 'editCustomFieldsToTwidth' ) );
        add_action( 'edited_twidth', array( $this, 'updateCustomFieldsToTwidth' ), 10, 2 );

        /*===============================================================
        * House Configurator Custom Post Type Single Page Template
        */
        add_filter( 'single_template', array( $this, 'loadSingleTemplate' ) );

    }
    public function register() 
    {
        add_action( 'init', array( $this, 'createCustomPostType' ) );
        add_action( 'init', array( $this, 'createCustomTaxonomies' ) );
        add_action( 'add_meta_boxes', array( $this, 'addCustomMetaBox' ) );
        add_action( 'save_post', array( $this, 'saveCustomMetaBox' ) );
        add_filter( 'manage_house-configurator_posts_columns', array( $this, 'addCustomColumns' ), 10, 2 );
        add_action( 'manage_house-configurator_posts_custom_column', array( $this, 'addCustomColumnsData' ), 10, 2 );
        add_theme_support( 'taxonomies_thumbnail', array( 'level' ) );
    }

    public function createCustomPostType() 
    {
        $labels = array(
            'name'               => _x( 'Part 03 Settings', 'post type general name', 'house-configurator' ),
            'singular_name'      => _x( 'Part 03 Settings', 'post type singular name', 'house-configurator' ),
            'menu_name'          => _x( 'Part 03 Settings', 'admin menu', 'house-configurator' ),
            'name_admin_bar'     => _x( 'Part 03 Settings', 'add new on admin bar', 'house-configurator' ),
            'add_new'            => _x( 'Add New', 'house-configurator', 'house-configurator' ),
            'add_new_item'       => __( 'Add New House', 'house-configurator' ),
            'new_item'           => __( 'New House', 'house-configurator' ),
            'edit_item'          => __( 'Edit House', 'house-configurator' ),
            'view_item'          => __( 'View House', 'house-configurator' ),
            'all_items'          => __( 'All House', 'house-configurator' ),
            'search_items'       => __( 'Search House', 'house-configurator' ),
            'parent_item_colon'  => __( 'Parent House:', 'house-configurator' ),
            'not_found'          => __( 'No house found.', 'house-configurator' ),
            'not_found_in_trash' => __( 'No house found in Trash.', 'house-configurator' )
        );

        $args = array(
            'labels'             => $labels,
            'description'        => __( 'Description.', 'house-configurator' ),
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => array( 'slug' => 'house-configurator' ),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => null,
            'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
        );

        // define single page template

        register_post_type( 'house-configurator', $args );
    }

    public function createCustomTaxonomies() 
    {
        $labels = array(
            'name'              => _x( 'Part 03 Levels', 'taxonomy general name', 'house-configurator' ),
            'singular_name'     => _x( 'Level', 'taxonomy singular name', 'house-configurator' ),
            'search_items'      => __( 'Search Levels', 'house-configurator' ),
            'all_items'         => __( 'All Levels', 'house-configurator' ),
            'parent_item'       => __( 'Parent Level', 'house-configurator' ),
            'parent_item_colon' => __( 'Parent Level:', 'house-configurator' ),
            'edit_item'         => __( 'Edit Level', 'house-configurator' ),
            'update_item'       => __( 'Update Level', 'house-configurator' ),
            'add_new_item'      => __( 'Add New Level', 'house-configurator' ),
            'new_item_name'     => __( 'New Level Name', 'house-configurator' ),
            'menu_name'         => __( 'Part 03 Level', 'house-configurator' ),
        );

        $args = array(
            'hierarchical'      => true,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => 'level' ),
            'supports'          => array('title', 'editor', 'thumbnail')
        );

        register_taxonomy( 'level', array( 'house-configurator' ), $args );
        

        $labels = array(
            'name'              => _x( 'Part 03  Options', 'taxonomy general name', 'house-configurator' ),
            'singular_name'     => _x( 'Option', 'taxonomy singular name', 'house-configurator' ),
            'search_items'      => __( 'Search Options', 'house-configurator' ),
            'all_items'         => __( 'All Options', 'house-configurator' ),
            'parent_item'       => __( 'Parent Option', 'house-configurator' ),
            'parent_item_colon' => __( 'Parent Option:', 'house-configurator' ),
            'edit_item'         => __( 'Edit Option', 'house-configurator' ),
            'update_item'       => __( 'Update Option', 'house-configurator' ),
            'add_new_item'      => __( 'Add New Option', 'house-configurator' ),
            'new_item_name'     => __( 'New Option Name', 'house-configurator' ),
            'menu_name'         => __( 'Part 03 Option', 'house-configurator' ),
        );

        $args = array(
            'hierarchical'      => true,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => 'option' ),
            'supports'          => array('title', 'editor', 'thumbnail')
        );

        register_taxonomy( 'option', array( 'house-configurator' ), $args );

        $fwidth  = array(
            'name'              => _x( 'Part 03 Width From', 'taxonomy general name', 'house-configurator' ),
            'singular_name'     => _x( 'Width', 'taxonomy singular name', 'house-configurator' ),
            'search_items'      => __( 'Search Width', 'house-configurator' ),
            'all_items'         => __( 'All Width', 'house-configurator' ),
            'parent_item'       => __( 'Parent Width', 'house-configurator' ),
            'parent_item_colon' => __( 'Parent Width:', 'house-configurator' ),
            'edit_item'         => __( 'Edit Width', 'house-configurator' ),
            'update_item'       => __( 'Update Width', 'house-configurator' ),
            'add_new_item'      => __( 'Add New Width', 'house-configurator' ),
            'new_item_name'     => __( 'New Width Name', 'house-configurator' ),
            'menu_name'         => __( 'Part 03 Width From', 'house-configurator' ),
        );

        $args = array(
            'hierarchical'      => true,
            'labels'            => $fwidth,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => 'fwidth' ),
            'supports'          => array('title', 'editor', 'thumbnail')
        );

        register_taxonomy( 'fwidth', array( 'house-configurator' ), $args );

        $twidth = array(
            'name'              => _x( 'Part 03 Width To', 'taxonomy general name', 'house-configurator' ),
            'singular_name'     => _x( 'Width', 'taxonomy singular name', 'house-configurator' ),
            'search_items'      => __( 'Search Width', 'house-configurator' ),
            'all_items'         => __( 'All Width', 'house-configurator' ),
            'parent_item'       => __( 'Parent Width', 'house-configurator' ),
            'parent_item_colon' => __( 'Parent Width:', 'house-configurator' ),
            'edit_item'         => __( 'Edit Width', 'house-configurator' ),
            'update_item'       => __( 'Update Width', 'house-configurator' ),
            'add_new_item'      => __( 'Add New Width', 'house-configurator' ),
            'new_item_name'     => __( 'New Width Name', 'house-configurator' ),
            'menu_name'         => __( 'Part 03 Width To', 'house-configurator' ),
        );

        $args = array(
            'hierarchical'      => true,
            'labels'            => $twidth,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => 'twidth' ),
            'supports'          => array('title', 'editor', 'thumbnail')
        );

        register_taxonomy( 'twidth', array( 'house-configurator' ), $args );

    }

    public function addCustomMetaBox() 
    {
        add_meta_box(
            'house-configurator-price',
            __( 'Price', 'house-configurator' ),
            array( $this, 'renderCustomMetaBox' ),
            'house-configurator',
            'side',
            'high'
        );

    }

    public function renderCustomMetaBox( $post ) 
    {
        wp_nonce_field( 'house_configurator_price', 'house_configurator_price_nonce' );

        $value = get_post_meta( $post->ID, '_house_configurator_price', true );

        echo '<label for="house_configurator_price">';
        _e( 'Price', 'house-configurator' );
        echo '</label> ';
        echo '<input type="text" id="house_configurator_price" name="house_configurator_price" value="' . esc_attr( $value ) . '" size="25" />';
    }

    public function saveCustomMetaBox( $post_id ) 
    {
        if ( ! isset( $_POST['house_configurator_price_nonce'] ) ) {
            return;
        }

        if ( ! wp_verify_nonce( $_POST['house_configurator_price_nonce'], 'house_configurator_price' ) ) {
            return;
        }

        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return;
        }

        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }

        if ( ! isset( $_POST['house_configurator_price'] ) ) {
            return;
        }

        $my_data = sanitize_text_field( $_POST['house_configurator_price'] );

        update_post_meta( $post_id, '_house_configurator_price', $my_data );
    }

    public function addCustomColumns( $columns ) 
    {
        $columns['price'] = __( 'Price', 'house-configurator' );
        $columns = array_slice( $columns, 0, 2, true ) + array( 'price' => __( 'Price', 'house-configurator' ) ) + array_slice( $columns, 2, null, true );

        return $columns;
    }

    public function addCustomColumnsData( $column, $post_id ) 
    {
        if ( 'price' === $column ) {
            $price = get_post_meta( $post_id, '_house_configurator_price', true );
            echo $price;
        }
    }

    /*========================================================================================================
    =            Add custom columns to level taxonomy            =
    ==========================================================================================================*/

    /**
     * Add custom columns to level taxonomy
     * @param  string $column  Price
     * @param  int $term_id Term ID
     * @return void
     */
    public function addCustomColumnsToLevelHeader( $columns ) {
        $columns['price'] = __( 'Price', 'house-configurator' );
        $columns['thumbnail'] = __( 'Thumbnail', 'house-configurator' );
        $columns['featured'] = __( 'Featured Image', 'house-configurator' );
        // show both columns in the same position
        
        $columns = array_slice( $columns, 0, 2, true ) + array( 'price' => __( 'Price', 'house-configurator' ) ) + array_slice( $columns, 2, null, true );
        $columns = array_slice( $columns, 0, 3, true ) + array( 'thumbnail' => __( 'Thumbnail', 'house-configurator' ) ) + array_slice( $columns, 3, null, true );
        $columns = array_slice( $columns, 0, 4, true ) + array( 'featured' => __( 'Featured Image', 'house-configurator' ) ) + array_slice( $columns, 4, null, true );
        
        return $columns;
        
    }
    
    public function addCustomColumnsToLevel( $content, $column_name, $term_id ) {
        if ( 'price' === $column_name ) {
            $price = get_term_meta( $term_id, '_house_configurator_price', true );
            $content = $price ? $price : '-';
        }
        if ( 'thumbnail' === $column_name ) {
            $thumbnail_id = get_term_meta( $term_id, 'thumbnail_id', true );
            if ( $thumbnail_id ) {
                $content = wp_get_attachment_image( $thumbnail_id, array( 60, 60 ) );
            }
        }
        if ( 'featured' === $column_name ) {
            $featured = get_term_meta( $term_id, 'feature_image_id', true );
            if ( $featured ) {
                $content = wp_get_attachment_image( $featured, array( 60, 60 ) );
            }
        }
        return $content;
    }



    /**
     * Add custom fields to level taxonomy
     * @param  string $taxonomy Taxonomy name
     * @return void
     */
    public function addCustomFieldsToLevel( $taxonomy ) 
    {
        if ( 'level' !== $taxonomy ) {
            return;
        }
    
        $term_id = get_queried_object_id();
        $price = get_term_meta( $term_id, '_house_configurator_price', true );
    
        echo '<div class="form-field term-price-wrap">';
        echo '<label for="term-price">' . __( 'Price', 'house-configurator' ) . '</label>';
        echo '<input type="text" id="term-price" name="term-price" value="' . esc_attr( $price ) . '" size="40" />';
        echo '</div>';

        // add thumbnail field and feature image to level taxonomy
        wp_enqueue_media();

        wp_nonce_field( basename( __FILE__ ), 'level_featured_image_nonce' ); ?>
        
        <div class="form-field term-thumbnail-wrap">
            <label><?php _e( 'Thumbnail', 'house-configurator' ); ?></label>
            <div id="term-thumbnail" style="float: left; margin-right: 10px;"><img src="<?php if ( $thumbnail_id = absint( get_term_meta( $term_id, 'thumbnail_id', true ) ) ) echo wp_get_attachment_url( $thumbnail_id ); ?>" width="60px" height="60px" /></div>
            <div style="line-height: 60px;">
                <input type="hidden" id="term-thumbnail-id" name="term-thumbnail-id" value="<?php echo $thumbnail_id; ?>" />
                <button type="button" class="upload_image_button button"><?php _e( 'Upload/Add image', 'house-configurator' ); ?></button>
                <button type="button" class="remove_image_button button"><?php _e( 'Remove image', 'house-configurator' ); ?></button>
            </div>
            <div class="clear"></div>
        <!-- feature image -->
        <label><?php _e( 'Feature Image', 'house-configurator' ); ?></label>
        <div id="term-feature-image" style="float: left; margin-right: 10px;"><img src="<?php if ( $feature_image_id = absint( get_term_meta( $term_id, 'feature_image_id', true ) ) ) echo wp_get_attachment_url( $feature_image_id ); ?>" width="60px" height="60px" /></div>
        <div style="line-height: 60px;">
            <input type="hidden" id="term-feature-image-id" name="term-feature-image-id" value="<?php echo $feature_image_id; ?>" />
            <button type="button" class="upload_feature_image_button button"><?php _e( 'Upload/Add image', 'house-configurator' ); ?></button>
            <button type="button" class="remove_feature_image_button button"><?php _e( 'Remove image', 'house-configurator' ); ?></button>
        </div>
        <script>
            // both thumbnail and feature image upload to level taxonomy
            jQuery(document).ready(function($){
                var file_frame;
                var wp_media_post_id = wp.media.model.settings.post.id; // Store the old id
                var set_to_post_id = <?php echo $term_id; ?>; // Set this
                jQuery('.upload_image_button').on('click', function( event ){
                    event.preventDefault();
                    // If the media frame already exists, reopen it.
                    if ( file_frame ) {
                        // Set the post ID to what we want
                        file_frame.uploader.uploader.param( 'post_id', set_to_post_id );
                        // Open frame
                        file_frame.open();
                        return;
                    } else {
                        // Set the wp.media post id so the uploader grabs the ID we want when initialised
                        wp.media.model.settings.post.id = set_to_post_id;
                    }
                    // Create the media frame.
                    file_frame = wp.media.frames.file_frame = wp.media({
                        title: 'Select a image to upload',
                        button: {
                            text: 'Use this image',
                        },
                        multiple: false // Set to true to allow multiple files to be selected
                    });
                    // When an image is selected, run a callback.
                    file_frame.on( 'select', function() {
                        // We set multiple to false so only get one image from the uploader
                        attachment = file_frame.state().get('selection').first().toJSON();
                        // Do something with attachment.id and/or attachment.url here
                        $( '#term-thumbnail-id' ).val( attachment.id );
                        $( '#term-thumbnail' ).find( 'img' ).attr( 'src', attachment.sizes.thumbnail.url );
                        $( '.remove_image_button' ).show();
                        // Restore the main post ID
                        wp.media.model.settings.post.id = wp_media_post_id;
                    });
                    // Finally, open the modal
                    file_frame.open();
                });
                // Restore the main ID when the add media button is pressed
                jQuery( 'a.add_media' ).on( 'click', function() {
                    wp.media.model.settings.post.id = wp_media_post_id;
                });
            });

            jQuery(document).ready(function($){
                var file_frame;
                var wp_media_post_id = wp.media.model.settings.post.id; // Store the old id
                var set_to_post_id = <?php echo $term_id; ?>; // Set this
                jQuery('.upload_feature_image_button').on('click', function( event ){
                    event.preventDefault();
                    // If the media frame already exists, reopen it.
                    if ( file_frame ) {
                        // Set the post ID to what we want
                        file_frame.uploader.uploader.param( 'post_id', set_to_post_id );
                        // Open frame
                        file_frame.open();
                        return;
                    } else {
                        // Set the wp.media post id so the uploader grabs the ID we want when initialised
                        wp.media.model.settings.post.id = set_to_post_id;
                    }
                    // Create the media frame.
                    file_frame = wp.media.frames.file_frame = wp.media({
                        title: 'Select a image to upload',
                        button: {
                            text: 'Use this image',
                        },
                        multiple: false // Set to true to allow multiple files to be selected
                    });
                    // When an image is selected, run a callback.
                    file_frame.on( 'select', function() {
                        // We set multiple to false so only get one image from the uploader
                        attachment = file_frame.state().get('selection').first().toJSON();
                        // Do something with attachment.id and/or attachment.url here
                        $( '#term-feature-image-id' ).val( attachment.id );
                        $( '#term-feature-image' ).find( 'img' ).attr( 'src', attachment.sizes.thumbnail.url );
                        $( '.remove_feature_image_button' ).show();
                        // Restore the main post ID
                        wp.media.model.settings.post.id = wp_media_post_id;
                    });
                    // Finally, open the modal
                    file_frame.open();
                });
                // Restore the main ID when the add media button is pressed
                jQuery( 'a.add_media' ).on( 'click', function() {
                    wp.media.model.settings.post.id = wp_media_post_id;
                });
            });
        </script>
            <div class="clear"></div>
        </div>
        
        <?php
    }

    
    /**
     * Save custom fields to level taxonomy
     * @param  int $term_id Term ID
     * @param  int $tt_id   Term taxonomy ID
     * @return void
     */
    public function saveCustomFieldsToLevel( $term_id ) {
        if ( isset( $_POST['term-price'] ) ) {
            $price = sanitize_text_field( $_POST['term-price'] );
            update_term_meta( $term_id, '_house_configurator_price', $price );
        } else {
            delete_term_meta( $term_id, '_house_configurator_price' );
        }
    
        if ( isset( $_POST['term-thumbnail-id'] ) ) {
            $thumbnail_id = absint( $_POST['term-thumbnail-id'] );
            update_term_meta( $term_id, 'thumbnail_id', $thumbnail_id );
        } else {
            delete_term_meta( $term_id, 'thumbnail_id' );
        }

        if ( isset( $_POST['term-feature-image-id'] ) ) {
            $feature_image_id = absint( $_POST['term-feature-image-id'] );
            update_term_meta( $term_id, 'feature_image_id', $feature_image_id );
        } else {
            delete_term_meta( $term_id, 'feature_image_id' );
        }
    
    }
    

    /*
    * edit custom fields to level taxonomy
    * @param  object $term Term object
    * @return void
    */
    public function editCustomFieldsToLevel( $term ) 
    {
        $price = get_term_meta( $term->term_id, '_house_configurator_price', true );
    
        echo '<tr class="form-field term-price-wrap">';
        echo '<th scope="row"><label for="term-price">' . __( 'Price', 'house-configurator' ) . '</label></th>';
        echo '<td><input type="text" id="term-price" name="term-price" value="' . esc_attr( $price ) . '" size="40" /></td>';
        echo '</tr>';

        // add thumbnail field
        wp_enqueue_media();
        ?>
        <tr class="form-field term-thumbnail-wrap">
            <th scope="row" valign="top"><label><?php _e( 'Thumbnail', 'house-configurator' ); ?></label></th>
            <td>
                <div id="term-thumbnail" style="float: left; margin-right: 10px;"><img src="<?php if ( $thumbnail_id = absint( get_term_meta( $term->term_id, 'thumbnail_id', true ) ) ) echo wp_get_attachment_url( $thumbnail_id ); ?>" width="60px" height="60px" /></div>
                <div style="line-height: 60px;">
                    <input type="hidden" id="term-thumbnail-id" name="term-thumbnail-id" value="<?php echo $thumbnail_id; ?>" />
                    <button type="button" class="upload_image_button button"><?php _e( 'Upload/Add image', 'house-configurator' ); ?></button>
                    <button type="button" class="remove_image_button button"><?php _e( 'Remove image', 'house-configurator' ); ?></button>
                </div>
                <script type="text/javascript">
    
                    // Only show the "remove image" button when needed
                    if ( '0' === jQuery( '#term-thumbnail-id' ).val() ) {
                        jQuery( '.remove_image_button' ).hide();
                    }
    
                    // Uploading files
                    var file_frame;
    
                    jQuery( document ).on( 'click', '.upload_image_button', function( event ) {
    
                        event.preventDefault();
    
                        // If the media frame already exists, reopen it.
                        if ( file_frame ) {
                            file_frame.open();
                            return;
                        }
    
                        // Create the media frame.
                        file_frame = wp.media.frames.downloadable_file = wp.media({
                            title: '<?php _e( 'Choose an image', 'house-configurator' ); ?>',
                            button: {
                                text: '<?php _e( 'Use image', 'house-configurator' ); ?>'
                            },
                            multiple: false
                        });
    
                        // When an image is selected, run a callback.
                        file_frame.on( 'select', function() {
                            var attachment = file_frame.state().get( 'selection' ).first().toJSON();
    
                            jQuery( '#term-thumbnail-id' ).val( attachment.id );
                            jQuery( '#term-thumbnail' ).find( 'img' ).attr( 'src', attachment.sizes.thumbnail.url );
                            jQuery( '.remove_image_button' ).show();
                        });

                        // Finally, open the modal.
                        file_frame.open();
                    });

                    jQuery( document ).on( 'click', '.remove_image_button', function() {
                        jQuery( '#term-thumbnail' ).find( 'img' ).attr( 'src', '<?php echo esc_js( 'http://placehold.it/60x60' ); ?>' );
                        jQuery( '#term-thumbnail-id' ).val( '' );
                        jQuery( '.remove_image_button' ).hide();
                        return false;
                    });

                </script>
                <div class="clear"></div>
            </td>
        </tr>
        <tr>
            <th scope="row" valign="top"><label><?php _e( 'Feature Image', 'house-configurator' ); ?></label></th>
            <td>
                <div id="term-feature-image" style="float: left; margin-right: 10px;"><img src="<?php if ( $feature_image_id = absint( get_term_meta( $term->term_id, 'feature_image_id', true ) ) ) echo wp_get_attachment_url( $feature_image_id ); ?>" width="60px" height="60px" /></div>
                <div style="line-height: 60px;">
                    <input type="hidden" id="term-feature-image-id" name="term-feature-image-id" value="<?php echo $feature_image_id; ?>" />
                    <button type="button" class="upload_feature_image_button button"><?php _e( 'Upload/Add image', 'house-configurator' ); ?></button>
                    <button type="button" class="remove_feature_image_button button"><?php _e( 'Remove image', 'house-configurator' ); ?></button>
                </div>
                <script type="text/javascript">

                    // Only show the "remove image" button when needed
                    if ( '0' === jQuery( '#term-feature-image-id' ).val() ) {
                        jQuery( '.remove_feature_image_button' ).hide();
                    }

                    // Uploading files
                    var file_frame;

                    jQuery( document ).on( 'click', '.upload_feature_image_button', function( event ) {

                        event.preventDefault();

                        // If the media frame already exists, reopen it.
                        if ( file_frame ) {
                            file_frame.open();
                            return;
                        }

                        // Create the media frame.
                        file_frame = wp.media.frames.downloadable_file = wp.media({
                            title: '<?php _e( 'Choose an image', 'house-configurator' ); ?>',
                            button: {
                                text: '<?php _e( 'Use image', 'house-configurator' ); ?>'
                            },
                            multiple: false
                        });

                        // When an image is selected, run a callback.
                        file_frame.on( 'select', function() {
                            var attachment = file_frame.state().get( 'selection' ).first().toJSON();

                            jQuery( '#term-feature-image-id' ).val( attachment.id );
                            jQuery( '#term-feature-image' ).find( 'img' ).attr( 'src', attachment.sizes.thumbnail.url );
                            jQuery( '.remove_feature_image_button' ).show();
                        });

                        // Finally, open the modal.
                        file_frame.open();
                    });

                    jQuery( document ).on( 'click', '.remove_feature_image_button', function() {
                        jQuery( '#term-feature-image' ).find( 'img' ).attr( 'src', '<?php echo esc_js( 'http://placehold.it/60x60' ); ?>' );
                        jQuery( '#term-feature-image-id' ).val( '' );
                        jQuery( '.remove_feature_image_button' ).hide();
                        return false;
                    });

                </script>
                <div class="clear"></div>
            </td>
        </tr>
        <?php
    }

    public function updateCustomFieldsToLevel( $term_id ) {
        if ( isset( $_POST['term-price'] ) ) {
            $price = sanitize_text_field( $_POST['term-price'] );
            update_term_meta( $term_id, '_house_configurator_price', $price );
        } else {
            delete_term_meta( $term_id, '_house_configurator_price' );
        }
    
        if ( isset( $_POST['term-thumbnail-id'] ) ) {
            $thumbnail_id = absint( $_POST['term-thumbnail-id'] );
            update_term_meta( $term_id, 'thumbnail_id', $thumbnail_id );
        } else {
            delete_term_meta( $term_id, 'thumbnail_id' );
        }

        if ( isset( $_POST['term-feature-image-id'] ) ) {
            $feature_image_id = absint( $_POST['term-feature-image-id'] );
            update_term_meta( $term_id, 'feature_image_id', $feature_image_id );
        } else {
            delete_term_meta( $term_id, 'feature_image_id' );
        }
    }

    /*=====  End of Add custom columns to level taxonomy editedtag ======*/

    /*==========================================================================================
    =            Add custom columns to Option taxonomy            =
    ==========================================================================================*/

    /**
     * Add custom columns to Option taxonomy
     */
    public function addCustomColumnsToOptionHeader( $columns ) {
        $columns['option_price'] = __( 'Price', 'house-configurator' );
        $columns = array_slice( $columns, 0, 2, true ) + array( 'option_price' => __( 'Price', 'house-configurator' ) ) + array_slice( $columns, 2, count( $columns ) - 1, true );
        
        return $columns;
        
    }
    
    public function addCustomColumnsToOption( $content, $column_name, $term_id ) {
        if ( 'option_price' === $column_name ) {
            $price = get_term_meta( $term_id, '_house_configurator_price_option', true );
            $content = $price ? $price : '-';
        }
        return $content;
    }

    /**
     * Add custom fields to Option taxonomy
     */
    public function addCustomFieldsToOption( $taxonomy ) 
    {
        if ( 'option' !== $taxonomy ) {
            return;
        }
    
        $term_id = get_queried_object_id();
        $price = get_term_meta( $term_id, '_house_configurator_price_option', true );
    
        echo '<div class="form-field term-price-wrap">';
        echo '<label for="term-price-option">' . __( 'Price', 'house-configurator' ) . '</label>';
        echo '<input type="text" id="term-price-option" name="term-price-option" value="' . esc_attr( $price ) . '" size="40" />';
        echo '</div>';

    }

    public function saveCustomFieldsToOption( $term_id ) {
        if ( isset( $_POST['term-price-option'] ) ) {
            $price = sanitize_text_field( $_POST['term-price-option'] );
            update_term_meta( $term_id, '_house_configurator_price_option', $price );
        } else {
            delete_term_meta( $term_id, '_house_configurator_price_option' );
        }
    }

    /**
     * Edit custom fields to Option taxonomy
     */
    public function editCustomFieldsToOption( $term ) {
        
        $price = get_term_meta( $term->term_id, '_house_configurator_price_option', true );
    
        echo '<tr class="form-field term-price-wrap">';
        echo '<th scope="row"><label for="term-price-option">' . __( 'Price', 'house-configurator' ) . '</label></th>';
        echo '<td><input type="text" id="term-price-option" name="term-price-option" value="' . esc_attr( $price ) . '" size="40" /></td>';
        echo '</tr>';
    }

    /**
     * Update custom fields to Option taxonomy
     */
    public function updateCustomFieldsToOption( $term_id ) {

        if ( isset( $_POST['term-price-option'] ) ) {
            $price = sanitize_text_field( $_POST['term-price-option'] );
            update_term_meta( $term_id, '_house_configurator_price_option', $price );
        } else {
            delete_term_meta( $term_id, '_house_configurator_price_option' );
        }
    }

    /*=====  End of Add custom columns to Option taxonomy  ======*/

    /*===== Start of addCustomColumnsToFwidthHeader  ======*/
    public function addCustomColumnsToFwidthHeader( $columns ) {
        $columns['fwidth_price'] = __( 'Price', 'house-configurator' );
        $columns = array_slice( $columns, 0, 2, true ) + array( 'fwidth_price' => __( 'Price', 'house-configurator' ) ) + array_slice( $columns, 2, count( $columns ) - 1, true );
        
        return $columns;
        
    }

    public function addCustomColumnsToFwidth( $content, $column_name, $term_id ) {
        if ( 'fwidth_price' === $column_name ) {
            $price = get_term_meta( $term_id, '_house_configurator_price_fwidth', true );
            $content = $price ? $price : '-';
        }
        return $content;
    }

    public function addCustomFieldsToFwidth( $taxonomy ) 
    {
        if ( 'fwidth' !== $taxonomy ) {
            return;
        }
    
        $term_id = get_queried_object_id();
        $price = get_term_meta( $term_id, '_house_configurator_price_fwidth', true );

        echo '<div class="form-field term-price-wrap">';
        echo '<label for="term-price-fwidth">' . __( 'Price', 'house-configurator' ) . '</label>';
        echo '<input type="text" id="term-price-fwidth" name="term-price-fwidth" value="' . esc_attr( $price ) . '" size="40" />';
        echo '</div>';
    }

    public function saveCustomFieldsToFwidth( $term_id ) {
        if ( isset( $_POST['term-price-fwidth'] ) ) {
            $price = sanitize_text_field( $_POST['term-price-fwidth'] );
            update_term_meta( $term_id, '_house_configurator_price_fwidth', $price );
        } else {
            delete_term_meta( $term_id, '_house_configurator_price_fwidth' );
        }
    }

    public function editCustomFieldsToFwidth( $term ) {
        
        $price = get_term_meta( $term->term_id, '_house_configurator_price_fwidth', true );
    
        echo '<tr class="form-field term-price-wrap">';
        echo '<th scope="row"><label for="term-price-fwidth">' . __( 'Price', 'house-configurator' ) . '</label></th>';
        echo '<td><input type="text" id="term-price-fwidth" name="term-price-fwidth" value="' . esc_attr( $price ) . '" size="40" /></td>';
        echo '</tr>';
    }

    public function updateCustomFieldsToFwidth( $term_id ) {

        if ( isset( $_POST['term-price-fwidth'] ) ) {
            $price = sanitize_text_field( $_POST['term-price-fwidth'] );
            update_term_meta( $term_id, '_house_configurator_price_fwidth', $price );
        } else {
            delete_term_meta( $term_id, '_house_configurator_price_fwidth' );
        }
    }

    /*=====  End of addCustomColumnsToFwidthHeader  ======*/

    /*===== Start of addCustomColumnsToTwidthHeader  ======*/
    public function addCustomColumnsToTwidthHeader( $columns ) {
        $columns['twidth_price'] = __( 'Price', 'house-configurator' );
        $columns = array_slice( $columns, 0, 2, true ) + array( 'twidth_price' => __( 'Price', 'house-configurator' ) ) + array_slice( $columns, 2, count( $columns ) - 1, true );
        
        return $columns;        
    }

    public function addCustomColumnsToTwidth( $content, $column_name, $term_id ) {
        if ( 'twidth_price' === $column_name ) {
            $price = get_term_meta( $term_id, '_house_configurator_price_twidth', true );
            $content = $price ? $price : '-';
        }
        return $content;
    }

    public function addCustomFieldsToTwidth( $taxonomy ) 
    {
        if ( 'twidth' !== $taxonomy ) {
            return;
        }
    
        $term_id = get_queried_object_id();
        $price = get_term_meta( $term_id, '_house_configurator_price_twidth', true );

        echo '<div class="form-field term-price-wrap">';
        echo '<label for="term-price-twidth">' . __( 'Price', 'house-configurator' ) . '</label>';
        echo '<input type="text" id="term-price-twidth" name="term-price-twidth" value="' . esc_attr( $price ) . '" size="40" />';
        echo '</div>';
    }

    public function saveCustomFieldsToTwidth( $term_id ) {
        if ( isset( $_POST['term-price-twidth'] ) ) {
            $price = sanitize_text_field( $_POST['term-price-twidth'] );
            update_term_meta( $term_id, '_house_configurator_price_twidth', $price );
        } else {
            delete_term_meta( $term_id, '_house_configurator_price_twidth' );
        }
    }

    public function editCustomFieldsToTwidth( $term ) {
        
        $price = get_term_meta( $term->term_id, '_house_configurator_price_twidth', true );
    
        echo '<tr class="form-field term-price-wrap">';
        echo '<th scope="row"><label for="term-price-twidth">' . __( 'Price', 'house-configurator' ) . '</label></th>';
        echo '<td><input type="text" id="term-price-twidth" name="term-price-twidth" value="' . esc_attr( $price ) . '" size="40" /></td>';
        echo '</tr>';
    }

    public function updateCustomFieldsToTwidth( $term_id ) {

        if ( isset( $_POST['term-price-twidth'] ) ) {
            $price = sanitize_text_field( $_POST['term-price-twidth'] );
            update_term_meta( $term_id, '_house_configurator_price_twidth', $price );
        } else {
            delete_term_meta( $term_id, '_house_configurator_price_twidth' );
        }
    }

    /*=====  End of addCustomColumnsToTwidthHeader  ======*/

    /*==========================================================================================
    =            Define Single Page            =
    ==========================================================================================*/
    public function loadSingleTemplate($template) {
        global $post;
        if ( 'house-configurator' === $post->post_type ) {
            if ( is_single() ) {
                $custom_template = plugin_dir_path( __FILE__ ) . 'single-house-configurator.php';
                if ( file_exists( $custom_template ) ) {
                    return $custom_template;
                }
            }
        }
        return $template;
    }
    

}