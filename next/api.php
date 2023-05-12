<?php 

    class PaladinsNextAPI {
        public function __construct() {
            add_action('rest_api_init', array($this, 'register_endpoints'));
        }

        public function register_endpoints() {
            register_rest_route( 'next', '/pages', array(
                'methods' => 'GET',
                'callback' => array($this, 'getAllPages'),
            ));

            register_rest_route( 'next', '/page/(?P<slug>[a-zA-Z0-9-]+)', array(
                'methods' => 'GET',
                'callback' => array($this, 'getPageBySlug'),
            ));

            register_rest_route( 'next', '/header', array(
                'methods' => 'GET',
                'callback' => array($this, 'getHeader'),
            ));
        }

        public function getAllPages() {
            $args = array(
                'post_type' => 'page', 
                'posts_per_page' => -1,
            );
            $data = array();
            $posts = get_posts($args);
            if($posts) {
                foreach($posts as $post) {
                    $data[] = array(
                        'params' =>  array(
                            'slug' => array($post->post_name)
                        )
                    );
                }
            }
            return $data;
        }

        public function getPageBySlug($request) {
            $posts = get_posts(array(
                'post_type' => 'page', 
                'name' => $request['slug'],
                'posts_per_page' => 1
            ));
            if($posts) {
                $p = $posts[0];
                return array(
                    'id' => $p->ID,
                    'title' => $p->post_title,
                    'inhalt' => get_field('content', $p->ID),
                    'global' => $this->getHeader()
                );
            }
            return new WP_Error('not found', 404);
        }

        public function getHeader() {
            return array(
                'logo' => get_field('theme_logo', 'option'),
                'social' => get_field('social_media', 'option'),
                'menu' => 
            );
        }

        public function get_menu() {
            $child_items = [];
            $navbar_items = wp_get_nav_menu_items('hauptnavigation');
            // pull all child menu items into separate object
            foreach ($navbar_items as $key => $item) {
                if ($item->menu_item_parent) {
                    array_push($child_items, $item);
                    unset($navbar_items[$key]);
                }
            }
    
            // push child items into their parent item in the original object
            foreach ($navbar_items as $item) {
                foreach ($child_items as $key => $child) {
                    if ($child->menu_item_parent == $item->post_name) {
                        if (!$item->child_items) {
                            $item->child_items = [];
                        }
    
                        array_push($item->child_items, $child);
                        unset($child_items[$key]);
                    }
                }
            }
    
            return $navbar_items;
        }
    }
    $init = new PaladinsNextApi();