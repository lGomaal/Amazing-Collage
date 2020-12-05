<?php


function universityRegisterSearch(){
    register_rest_route('university/v1' ,'search', [
        'methods' =>WP_REST_SERVER::READABLE,  //will substiture with a constant name get.
        'callback' => 'universitySearchResults',
    ]);
}

function universitySearchResults($parameters){
    $mainQuery = new WP_Query([
        'posts_per_page' => -1,
        'post_type' => ['professor' , 'event' , 'program' , 'post' , 'page'],
        's' => sanitize_text_field($parameters['term']),
    ]);
    wp_reset_postdata();
    $profeesorResults = [
        'generalInfo' => [],
        'professors' => [],
        'programs' => [],
        'events' => [],
    ];
    while ($mainQuery->have_posts()) {
        $mainQuery->the_post();
        if(get_post_type() == 'post' || get_post_type() == 'page'){
            array_push($profeesorResults['generalInfo'],[
                'title' => get_the_title(),
                'permalink' => get_the_permalink(),
                'postType' => get_post_type(),
                'authorName' => get_author_name(),
    
            ]);
        }
        elseif(get_post_type() == 'professor'){
            array_push($profeesorResults['professors'],[
                'title' => get_the_title(),
                'permalink' => get_the_permalink(),
                'image' => get_the_post_thumbnail_url(0,'ProfessorLandScape'),
    
            ]);
        }
        elseif(get_post_type() == 'program'){
            array_push($profeesorResults['programs'],[
                'title' => get_the_title(),
                'permalink' => get_the_permalink(),
    
            ]);
        }
        elseif(get_post_type() == 'event'){
            $event_date_time = new DateTime(get_post_meta(get_the_ID(),'DateEventPic', true));

            array_push($profeesorResults['events'],[
                'title' => get_the_title(),
                'permalink' => get_the_permalink(),
                'month' => $event_date_time->format('M'),
                'day' => $event_date_time->format('d'),
                'content' => wp_trim_words(get_the_content(),18),
            ]);
        }
    }

    $Professors_Related = new WP_Query([
        'posts_per_page' => -1,
        'post_type' => 'professor',
        'meta_key' => 'ProgramsProfPosts',
        'order_by' => 'title',
        'order' => 'ASC',
        'meta_query' =>[
          [
            'key'=> 'ProgramsProfPosts',
            'compare' =>'LIKE',
            'value' => $parameters['term'],  // thats means today date with this formate
            'type' => 'string'
          ]
        ]
    ]);
    wp_reset_postdata();

    while($Professors_Related->have_posts()){
        $Professors_Related->the_post();
        if(get_post_type() == 'professor'){
            array_push($profeesorResults['professors'],[
                'title' => get_the_title(),
                'permalink' => get_the_permalink(),
                'image' => get_the_post_thumbnail_url(0,'ProfessorLandScape'),
    
            ]);
        }
    }
    $profeesorResults['professors'] = array_unique($profeesorResults['professors']);

    return $profeesorResults;
}

add_action('rest_api_init' , 'universityRegisterSearch');



?>