<?php
if (!function_exists('register_location_post_type')):

	//Registering Post Type

    function register_location_post_type() {
        $labels = array(
            'name'                => __('Locations'),
            'singular_name'       => __('Location'),
            'menu_name'           => __('Locations'),
            'parent_item_colon'   => __('Parent Location:'),
            'all_items'           => __('All Locations'),
            'view_item'           => __('View Location'),
            'add_new_item'        => __('Add New Location'),
            'add_new'             => __('Add New'),
            'edit_item'           => __('Edit Location'),
            'update_item'         => __('Update Location'),
            'search_items'        => __('Search Locations'),
            'not_found'           => __('No Locations found.'),
            'not_found_in_trash'  => __('No Locations found in trash.')
        );

        $rewrite = array(
            'slug'                => 'location',
            'with_front'          => false,
            'pages'               => true,
            'feeds'               => true,
        );

        $args = array(
            'label'               => __('Location'),
            'description'         => __('Locations'),
            'labels'              => $labels,
            'taxonomies'          => array('portfolio-category'),
            'supports'            => array('title','editor', 'thumbnail', 'excerpt'),
            'hierarchical'        => false,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_nav_menus'   => false,
            'show_in_admin_bar'   => true,
            'menu_position'       => 5,
            'menu_icon'           => 'dashicons-location-alt',
            'can_export'          => true,
            'has_archive'         => false,
            'exclude_from_search' => false,
            'publicly_queryable'  => true,
            'rewrite'             => $rewrite,
            'capability_type'     => 'post'
        );

       register_post_type('location', $args);

       /* FLUSH THE REWTIRE RULES ONCE THEN DELETE THE flush_rewrite_rules(); FUNCTION!!!! */
      flush_rewrite_rules();
    }

    add_action('init', 'register_location_post_type');

endif;

?>
