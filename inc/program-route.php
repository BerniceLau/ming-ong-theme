<?php

add_action('rest_api_init', 'moProgramRoutes');

function moProgramRoutes()  {
    register_rest_route('mo/v1', 'manageProgram', array(
        'methods' => 'POST',
        'callback' => 'createProgram'
    ));
    
    register_rest_route('mo/v1', 'manageProgram', array(
        'methods' => 'DELETE',
        'callback' => 'deleteProgram'
    ));
}


function createProgram($data) {
    
    $progDate = sanitize_text_field($data['progdate']);
    $cell = sanitize_text_field($data['cell']);
    $program = sanitize_text_field($data['program']);
    
    if (is_user_logged_in() AND !empty($progDate) AND !empty($cell) AND !empty($program)) {
    
        
        $planner = sanitize_text_field($data['planner']);
        $selection = $cell + 1;
    
        return wp_insert_post(array(
            'post_type' => 'program',
            'post_status' => 'publish',
            'post_title' => 'Programtttt',
            'post_content' => $program,
            'meta_input' => array(
                'start_date' => $progDate,
                'cell' => $cell,
                'planner' => $planner
            )
        ));
        
    } else {
        
        die("Only logged in users can input data");
        
    }    
}

function deleteProgram($data) {
    
    $programId = sanitize_text_field($data['dataId']);
    
    if (is_user_logged_in() AND get_post_type($programId) == 'program') {
        
        wp_delete_post($programId, true);
        return 'Data deleted.';
        
    } else {
        
        die("You do not have permission to delete that.");
    }
}