<?php

add_action('rest_api_init', 'moEventRoutes');

function moEventRoutes()  {
    register_rest_route('mo/v1', 'manageEvent', array(
        'methods' => 'POST',
        'callback' => 'createEvent'
    ));
    
    register_rest_route('mo/v1', 'manageEvent', array(
        'methods' => 'DELETE',
        'callback' => 'deleteEvent'
    ));
}

function createEvent($data) {
    
    $frDate = sanitize_text_field($data['frdate']);
    $event = sanitize_text_field($data['content']);
    
    if (is_user_logged_in() AND !empty($frDate) AND !empty($event)) {
    
        $toDate = sanitize_text_field($data['todate']);
        $Time = sanitize_text_field($data['time']);
    
        return wp_insert_post(array(
            'post_type' => 'event',
            'post_status' => 'publish',
            'post_title' => 'Event',
            'post_content' => $event,
            'meta_input' => array(
                'start_date' => $frDate,
                'end_date' => $toDate,
                'time' => $Time
            )
        ));
        
    } else {
        
        die("Only logged in users can input data");
        
    }    
}

function deleteEvent($data) {
    
    $eventId = sanitize_text_field($data['dataId']);
    
    if (is_user_logged_in() AND get_post_type($eventId) == 'event') {
        
        wp_delete_post($eventId, true);
        return 'Data deleted.';
        
    } else {
        
        die("You do not have permission to delete that.");
    }
}