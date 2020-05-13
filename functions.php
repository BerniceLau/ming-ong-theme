<?php

require get_theme_file_path('/inc/custom-api.php');
require get_theme_file_path('/inc/event-route.php');
require get_theme_file_path('/inc/program-route.php');
    
function pageBanner($args = NULL) {

    if (!$args['title']) {
        $args['title'] = get_the_title();
    }
    
    if (!$args['subtitle']) {
        $args['subtitle'] = get_field('page_banner_subtitle');
    }
    
    if (!$args['photo']) {
        if (get_field('page_banner_background_image')) {
            $args['photo'] = get_field('page_banner_background_image')['sizes']['pageBanner'];
        } else {
            $args['photo'] = get_theme_file_uri('/images/indomee.jpg');
        }
    } 
    
    ?>
    <div class="page-banner">
        <div class="page-banner__bg-image" style="background-image: url(<?php echo $args['photo']; ?>);"></div>
        <div class="page-banner__content container container--narrow">
        <h1 class="page-banner__title"><?php echo $args['title'] ?></h1>
        <div class="page-banner__intro">
            <p><?php echo $args['subtitle']; ?></p>
        </div>
        </div>  
    </div>
    <?php }


function mo_files() {
    wp_enqueue_script('googleMap', '//maps.googleapis.com/maps/api/js?key=AIzaSyAutoIaQozzt8GoLhcsMosqUKT4VZCV-ks', NULL, microtime(), true);
    wp_enqueue_script('main-mo-js', get_theme_file_uri('/js/scripts-bundled.js'), NULL, microtime(), true);
    wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_style( 'custom-google-fonts', '//fonts.googleapis.com/css?family=Noto+Sans+SC|Noto+Serif+SC');
    //wp_enqueue_style('mo_main_styles', get_stylesheet_directory_uri().'/css/style.css', NULL, microtime());
    //wp_enqueue_style('custom-google-fonts','//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
    wp_enqueue_style('mo_main_styles', get_stylesheet_uri(), NULL, microtime());
    wp_localize_script('main-mo-js','moData', array(
        'root_url' => get_site_url(),
        'nonce' => wp_create_nonce('wp_rest')
    ));

   }

add_action('wp_enqueue_scripts','mo_files');


function mo_features() {
    register_nav_menu('headerMenuLocation','Header Menu Location');
    register_nav_menu('footerMenuLocationOne','Footer Menu Location One');
    register_nav_menu('footerMenuLocationTwo','Footer Menu Location Two');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_image_size('protraitImage', 480, 650, true);
    add_image_size('landscapeImage', 400, 260, true);
    add_image_size('pageBanner', 1500, 400, true);
}

add_action('after_setup_theme', 'mo_features');

function mo_adjust_queries($query) {
    
    if (!is_admin() AND is_post_type_archive('churchloc') AND $query-> is_main_query()) {
        $query->set('posts_per_page', -1);
    }
        
    if (!is_admin() AND is_post_type_archive('event') AND $query-> is_main_query()) {
        $today = date('Ymd');
        $query->set('meta_key', 'from_event_date');
        $query->set('orderby', 'meta_value_num');
        $query->set('order', 'ASC'); 
        $query->set('meta_query', array(
                    array(
                        'key' => 'from_event_date',
                        'compare' => '>=',
                        'value' => $today,
                        'type' => 'numeric'
                        )
                    ));
    }
      
}

add_action('pre_get_posts', 'mo_adjust_queries');

function moMapKey($api){
    $api['key'] = 'AIzaSyAutoIaQozzt8GoLhcsMosqUKT4VZCV-ks';
    return $api;
}

add_filter('acf/fields/google_map/api', 'moMapKey');

// Redirect subscriber accounts out of admin and onto homepage

add_action('admin_init','redirectSubsToFrontend');
    
function redirectSubsToFrontend() {
    $ourCurrentUser = wp_get_current_user();
    
    if (count($ourCurrentUser->roles) == 1 AND $ourCurrentUser->roles[0] == 'datainput'){
    wp_redirect(site_url('/'));
    exit;
    }
}

add_action('wp_loaded','noSubsAdminBar');

function noSubsAdminBar() {
    $ourCurrentUser = wp_get_current_user();
    
    if (count($ourCurrentUser->roles) == 1 AND $ourCurrentUser->roles[0] == 'datainput'){
    show_admin_bar(false);
    }
}

// Customize Login Screen
add_filter('login_headerurl','moHeaderUrl');

function moHeaderUrl(){
    return esc_url(site_url('/'));
}

add_action('login_enqueue_scripts','ourLoginCSS');

function ourLoginCSS() {
     wp_enqueue_style('mo_main_styles', get_stylesheet_uri());
}

add_filter('login_headertitle','moLoginTitle');

function moLoginTitle() {
    return get_bloginfo('name');
}
