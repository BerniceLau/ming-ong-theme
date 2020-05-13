<?php

add_action('rest_api_init', 'moRegisterApi');

function moRegisterApi() {
    register_rest_route('mo/v1','get', array(
        'methods' => WP_REST_SERVER::READABLE,
        'callback' => 'moGetResults'
    ));
}

function moGetResults() {
    $maf = new WP_Query(array(
        'post_type' => 'maf'
    ));
    
    $mafResults = array();
    
    while($maf->have_posts()) {
        $maf->the_post();
        array_push($mafResults, array(
            'title' => get_the_title(),
            'permalink' => get_the_permalink(),
            'postType' => get_post_type(),
            'authorName' => get_the_author(),
            'active' => get_field("publish_flag")
        ));
    }
    
    return $mafResults;
}