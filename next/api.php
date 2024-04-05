<?php 

    class PaladinsNextAPI {
        public function __construct() {
            add_action('rest_api_init', array($this, 'register_endpoints'));
            add_filter( 'acf/format_value/name=news_data', array($this, 'extend_news_data'));
            add_filter( 'acf/format_value/name=slider_data', array($this, 'extend_slider_data'));
            add_filter( 'acf/format_value/name=spielplan_data', array($this, 'extend_spielplan_data'));
            add_filter( 'acf/format_value/name=bildquelle', array($this, 'extend_sponsoren_data'));
            add_action('acf/save_post', array($this, 'update_roster'),10,1);
            add_action('acf/save_post', array($this, 'invalidate_cache'),10,1);

        }

        public function update_roster($postid) {
            $i = 0;
            if(isset($_POST['acf']['field_60a05b7a30107'])) {
                $fc = $_POST['acf']['field_60a05b7a30107'];
                if(is_array($fc)) {
                    foreach($fc as $row) {
                        $i++;
                        if($row['acf_fc_layout'] == "roster") {
                            $rowindex = $i;
                            $data = array();
                            if(!$row['field_roster_file']) continue;

                            $file = fopen(get_attached_file($row['field_roster_file']),'r');
                            while (! feof($file)) {
                                $data[] = fgetcsv($file, 1000, ",");
                            }
                            fclose($file);
                            $repeater = array();
                            if($data) {
                                foreach($data as $p) {
                                    $repeater[] = array(
                                        'roster_nummer' => $p[0],
                                        'roster_position' => $p[1],
                                        'roster_vorname' => $p[3],
                                        'roster_nachname' => $p[2],
                                        'roster_bild' => $p[5]
                                    );
                                }
                            }
                            $row['field_roster_data'] = $repeater;
                            $row['field_roster_file'] = false;

                            update_row('content', $i, $row, $postid);

                        }
                    }
                }
            }
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

            register_rest_route( 'next', '/news/(?P<slug>[a-zA-Z0-9-]+)', array(
                'methods' => 'GET',
                'callback' => array($this, 'getPostBySlug'),
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
                    if($post->post_name === "news") continue;
                    $data[] = array(
                        'params' =>  array(
                            'slug' => explode('/',get_page_uri($post->ID))
                        )
                    );
                }
            }
            return $data;
        }

        public function getPageBySlug($request) {
            $posts = get_posts(array(
                'name' => $request['slug'],
                'posts_per_page' => 1,
                'post_type' => ['page']
            ));
            if($posts) {
                $p = $posts[0];

                return array(
                    'post_type' => $p->post_type,
                    'id' => $p->ID,
					'date' => $p->post_date_gmt,
                    'title' => $p->post_title,
                    'inhalt' => get_field('content', $p->ID),
                    'global' => $this->getHeader(),

                );
            }
            return new WP_Error( 'page not found', 'invalid page', array( 'status' => 404 ) );
        }

        public function getPostBySlug($request) {
            $posts = get_posts(array(
                'post_type' => 'post', 
                'name' => $request['slug'],
                'posts_per_page' => 1
            ));
            if($posts) {
                $p = $posts[0];
                return array(
                    'id' => $p->ID,
                    'date' => $p->post_date_gmt,
                    'title' => $p->post_title,
                    'inhalt' => wpautop($p->post_content),
                    'thumbnail' => get_the_post_thumbnail_url($p->ID, 'full'),
                    'global' => $this->getHeader()
                );
            }
            return new WP_Error( 'post not found', 'invalid post', array( 'status' => 404 ) );
        }

        public function getHeader() {
            return array(
                'logo' => get_field('theme_logo', 'option'),
                'social' => get_field('social_media', 'option'),
                'menu' => $this->get_menu('hauptnavigation'),
                'footer' => $this->get_menu('footer'),
                'preheader' => get_field('header', 'option')
            );
        }

        public function get_menu($string) {
            $child_items = [];
            $navbar_items = wp_get_nav_menu_items($string);
          return $navbar_items;
        }

        public function extend_news_data() {
            $news = get_posts(array(
                'post_type' => 'post',
                'posts_per_page' => 8
            ));
            $arr = array();
            if($news) {
                foreach($news as $post) {
                    $arr[] = array(
                        'link' => get_permalink($post->ID),
                        'bild' => get_the_post_thumbnail($post->ID, 'medium' ),
                        'datum' =>  get_the_date('d.m.Y', $post->ID),
                        'title' => $post->post_title
                    );
                }
            }
            return $arr;
        }

        public function extend_slider_data() {
            $news = get_posts(array(
                'post_type' => 'post',
                'posts_per_page' => 10
            ));
            $arr = array();
            if($news) {
                foreach($news as $post) {
                    $arr[] = array(
                        'link' => get_permalink($post->ID),
                        'bild' => get_the_post_thumbnail($post->ID, 'large' ),
                        'datum' =>  get_the_date('d.m.Y', $post->ID),
                        'title' => $post->post_title,
                        'auszug' => get_the_excerpt($post->ID)
                    );
                }
            }
            return $arr;
        }

        public function extend_spielplan_data() {
            $games = get_posts(array(
                'post_type' => 'game',
                'posts_per_page' => -1,
                'meta_key' => 'datum',
                'orderby' => 'meta_value_num',
                'order' => "ASC"
            ));
            $arr = array();
            if($games) {
                foreach($games as $post) {
                    $arr[] = array(
                        'logo' => get_field('logo', $post->ID),
                        'datum' =>  get_field('datum', $post->ID),
                        'uhrzeit' =>  get_field('uhrzeit', $post->ID),
                        'gegner' => get_field('gegner', $post->ID),
                        'ort' => get_field('ort', $post->ID),
                        'auswarts' => get_field('auswarts', $post->ID),
                        "link" => get_field('ticketlink', $post->ID),
                        'ergebnis' => get_field('ergebnis', $post->ID)
                    );
                }
            }
            return $arr;
        }

        public function extend_sponsoren_data($value) {
            $arr = get_field('content', $value);
            return $arr;
        }

        public function invalidate_cache($postid) {
            $post = get_post($postid);

            if($post->post_type === "post") {
                self::revalidate('page-homepage-2');
                self::revalidate('page-news');
                self::revalidate('posts');
                self::revalidate('post-'.$post->post_name);
            }

            if($post->post_type === "page") {
                self::revalidate('page-'.$post->post_name);
                self::revalidate('pages');
            }

        }

        public static function revalidate($tag) {
            return true;
            return wp_remote_get('https://paladins-next.netlify.app/api/revalidate?tag='.$tag);
        }

    
    }
    $init = new PaladinsNextApi();
