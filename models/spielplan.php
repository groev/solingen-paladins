<?php 

    class SpielplanModel {
        public function __construct() {
            add_action('init', array($this, 'register_post_type'));
        }

        public function register_post_type() {
            $labels = array(
                'name' => _x( 'Spiele', 'Post Type General Name', 'textdomain' ),
                'singular_name' => _x( 'Spiel', 'Post Type Singular Name', 'textdomain' ),
                'menu_name' => _x( 'Spiele', 'Admin Menu text', 'textdomain' ),
                'name_admin_bar' => _x( 'Spiel', 'Add New on Toolbar', 'textdomain' ),
                'archives' => __( 'Spiel Archives', 'textdomain' ),
                'attributes' => __( 'Spiel Attributes', 'textdomain' ),
                'parent_item_colon' => __( 'Parent Spiel:', 'textdomain' ),
                'all_items' => __( 'All Spiele', 'textdomain' ),
                'add_new_item' => __( 'Add New Spiel', 'textdomain' ),
                'add_new' => __( 'Add New', 'textdomain' ),
                'new_item' => __( 'New Spiel', 'textdomain' ),
                'edit_item' => __( 'Edit Spiel', 'textdomain' ),
                'update_item' => __( 'Update Spiel', 'textdomain' ),
                'view_item' => __( 'View Spiel', 'textdomain' ),
                'view_items' => __( 'View Spiele', 'textdomain' ),
                'search_items' => __( 'Search Spiel', 'textdomain' ),
                'not_found' => __( 'Not found', 'textdomain' ),
                'not_found_in_trash' => __( 'Not found in Trash', 'textdomain' ),
                'featured_image' => __( 'Featured Image', 'textdomain' ),
                'set_featured_image' => __( 'Set featured image', 'textdomain' ),
                'remove_featured_image' => __( 'Remove featured image', 'textdomain' ),
                'use_featured_image' => __( 'Use as featured image', 'textdomain' ),
                'insert_into_item' => __( 'Insert into Spiel', 'textdomain' ),
                'uploaded_to_this_item' => __( 'Uploaded to this Spiel', 'textdomain' ),
                'items_list' => __( 'Spiele list', 'textdomain' ),
                'items_list_navigation' => __( 'Spiele list navigation', 'textdomain' ),
                'filter_items_list' => __( 'Filter Spiele list', 'textdomain' ),
            );
            $args = array(
                'label' => __( 'Spiel', 'textdomain' ),
                'description' => __( '', 'textdomain' ),
                'labels' => $labels,
                'menu_icon' => 'dashicons-calendar',
                'supports' => array('title'),
                'taxonomies' => array(),
                'public' => false,
                'show_ui' => true,
                'show_in_menu' => true,
                'menu_position' => 5,
                'show_in_admin_bar' => true,
                'show_in_nav_menus' => true,
                'can_export' => true,
                'has_archive' => false,
                'hierarchical' => false,
                'exclude_from_search' => false,
                'show_in_rest' => true,
                'publicly_queryable' => true,
                'capability_type' => 'post',
            );
            register_post_type( 'game', $args );
        }

    }

    new SpielplanModel();