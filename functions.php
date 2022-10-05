<?php 

    class PaladinsTheme {
        public function __construct() {
            define('PALAURL', get_template_directory_uri(__FILE__));
            define('PALAPATH', get_template_directory(__FILE__));
            add_action('wp_enqueue_scripts', array($this, 'register_styles_and_scripts'));
            add_action( 'after_setup_theme', array($this, 'register_paladins_menu'));
            add_action('init', array($this, 'disable_emojis'));
            add_action('init', array($this, 'add_options_page'));
            add_filter('show_admin_bar', '__return_false');
            add_action('init', array($this, 'remove_page_content'));
      
            add_filter( 'excerpt_length', array($this, 'shorten_excerpt'), 999 );
            add_theme_support( 'post-thumbnails' );
            add_filter('acf/settings/save_json', array($this, 'save_json'));
            add_filter('acf/settings/load_json', array($this, 'load_json'));

            require_once PALAPATH.'/models/spielplan.php';
        }

        public function register_styles_and_scripts() {
            wp_enqueue_style( 'paladins-style', PALAURL.'/assets/styles/style.min.css', array(), time());
            wp_enqueue_script( 'paladins-script', PALAURL.'/assets/scripts/custom.min.js', array('jquery', 'paladins-slick'), time(), true );
            wp_enqueue_script( 'paladins-slick','https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js', array('jquery'), time(), true );
            wp_enqueue_style( 'paladins-slickstyle','https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css');
            wp_enqueue_style( 'paladins-slick-theme','https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css');
            wp_enqueue_style( 'paladins-slick-style','https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css');
        }

        public function shorten_excerpt() {
            return 25;
        }

        public function register_paladins_menu() {
            register_nav_menus( array(
                'primary_menu' => __( 'Hauptnavigation', 'sgpal' ),
                'footer_menu'  => __( 'Footernavigation', 'sgpal' ),
            ) );
        }

        public  function add_options_page() {
            acf_add_options_page(array(
                'page_title' 	=> 'Paladins Einstellungen',
                'menu_title'	=> 'Paladins',
                'menu_slug' 	=> 'paladins-general-settings',
                'capability'	=> 'edit_posts',
                'redirect'		=> false
            ));
        }

        public function disable_emojis() {
            remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
            remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
            remove_action( 'wp_print_styles', 'print_emoji_styles' );
            remove_action( 'admin_print_styles', 'print_emoji_styles' );	
            remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
            remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );	
            remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
        }

        public function remove_page_content() {
            remove_post_type_support( 'page', 'editor' );

        }

        public function save_json($path) {
            $path = get_stylesheet_directory() . '/fields';
            return $path;
        }

        public function load_json($paths) {
            unset($paths[0]);
            $paths[] = get_stylesheet_directory() . '/fields';
            return $paths;
        }
      

    }
    new PaladinsTheme();
