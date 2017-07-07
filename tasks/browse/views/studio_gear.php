<?php

if (isset($_GET['partTypeId'])) {

    $partTypeId = $_GET['partTypeId'];

    switch ($partTypeId) {
        case 62:
            $seo_title = '/recording-computer-studio-gear/audio-interfaces/';
            break;
        case 79:
            $seo_title = '/recording-computer-studio-gear/audio-software/';
            break;
        default:
            $seo_title = '/';
    }

    $partType = new PartType();
    $partType = (array) $partType->getPartType($conn, $partTypeId);

    $part = new Part();
    
    // Figure out what we are going to order the part list by
    $order_by = null;
    if (isset($_GET['order_by']) && $_GET['order_by']) {
        $temp = explode('::', $_GET['order_by']);
        $order_by = array('field' => $temp[0], 'direction' => $temp[1]);
    }
    
    // Generate order by drop down
    $order_by_list['part_title::asc'] = array('title'=>'Sort by Name <span>(a to z)</span>','url'=>'part_title::asc','active'=>false);
    $order_by_list['part_title::desc'] = array('title'=>'Sort by Name <span>(z to a)</span>','url'=>'part_title::desc','active'=>false);    
    $order_by_list['part_price::asc'] = array('title'=>'Sort by price <span>(low to high)</span>','url'=>'part_price::asc','active'=>false);
    $order_by_list['part_price::desc'] = array('title'=>'Sort by price <span>(high to low)</span>','url'=>'part_price::desc','active'=>false);
    $order_by_list['part_id::asc'] = array('title'=>'Sort by Product Age <span>(new to old)</span>','url'=>'part_id::asc','active'=>false);
    $order_by_list['part_id::desc'] = array('title'=>'Sort by Product Age <span>(old to new)</span>','url'=>'part_id::desc','active'=>false);        
    
    // Set whichever order_by is active to active
    if(isset($_GET['order_by']) && $_GET['order_by']) {        
        $order_by_list[$_GET['order_by']]['active'] = true;       
        $active_order_by = $_GET['order_by'];
    } else {        
        $order_by_list['part_title::asc']['active'] = true;   
        $active_order_by = '';
    }    
    
    // Get the part list
    $parts = $part->getPartsByPartType($conn, $partTypeId, 1, $order_by);

    $tag_list = array();
    $filters = array();
    
    $previous_filters = '&filters=';

    if (isset($_GET['filters']) && $_GET['filters']) {

        $temp1s = explode(',,', $_GET['filters']);

        foreach ($temp1s as $temp1) {
            $temp2 = explode('::', $temp1);
            $filters[$temp2[0]][] = $temp2[1];
        }

        $previous_filters .= clean($_GET['filters']);
    }
    
    foreach ($parts as $key => $part) {

        $tags = array();

        $tags_temp = explode(',,', $part['tags']);
        foreach ((array) $tags_temp as $tag) {            
            $field = explode('::', $tag);
            if (isset($field[0]) && isset($field[1])) {

                $tags[$field[0]] =$field[1];
                
            }            

            $parts[$key]['tags'] = $tags;
            
        }
    }         
    
    // Filter out the parts by filters requested
    $parts = filter_parts_by($parts, $filters);     


    // Generate an array of tags and tag values that apply to the list of parts by
    // cycling through all the parts that were pulled up with the db query.
    foreach ($parts as $part) {

        foreach($part['tags'] as $key=>$tag) {
            
            if($key != '' and $tag !='') {
                if(!isset($tag_list[$key])) { 

                    $tag_list[$key] = array();
                    $tag_list[$key][$tag] = $tag;

                } else {

                     $tag_list[$key][$tag] = $tag;

                }
            }
        }
            
    }

    // Sort the available tag values in each tag type    
    foreach($tag_list as $key=>$tag) {      
        
        if($key == 'Form Factor' || $key == 'Brand' || $key == 'Included Software') {
            
            ksort($tag, SORT_STRING);            

        } else {

            ksort($tag, SORT_NUMERIC);
            
        }
        
        $tag_list[$key] = $tag;
    }    

    // Generate an array of links with all applied filters
    foreach ($filters as $filter_key => $filter_values) {
        foreach ($filter_values as $filter_value) {
            $link_elements = array();
            foreach ($filters as $filter_key2 => $filter_values2) {
                foreach ($filter_values2 as $filter_value2) {
                    if (!($filter_key == $filter_key2 && $filter_value == $filter_value2)) {
                        $link_elements[] = clean($filter_key2) . '::' . clean($filter_value2);
                    }
                }
            }
            $active_filters[] = '<a href="' . $seo_title . '&filters=' . implode(',,', $link_elements) . '&order_by=' . $active_order_by . '"><span class="key">' . $filter_key . 
                ':</span> <span class="value">' . $filter_value . '</span></a>';
        }
    }    

    $site->addBreadCrumb('&raquo; <a href="#">Recording Computer Studio Gear</a> &raquo; <a href="#">' . $partType['title'] . '</a>');    
    $site->addToTitle($partType['title'] . ' - Recording Computer Studio Gear');
    $site->addToMeta('');
    
    // Start Output buffer and collect html content //
    ob_start();

    include 'tasks/browse/views/html/studio-gear.html.php';

    // Set the Site Object content to what we just collected  with the output buffer //
    $site->setContent(ob_get_contents());
    ob_end_clean();
}

function filter_parts_by($parts, $compare_tags) {

    $matches_need = count($compare_tags);

    $filtered_parts = array();

    foreach ((array) $parts as $part_key => $part) {

        $match_count = 0;

        foreach ((array) $part['tags'] as $tag_key => $tag_value) {

            foreach ((array) $compare_tags as $compare_tag_key => $compare_tag_values) {

                foreach ((array) $compare_tag_values as $compare_tag_value) {

                    if (clean($tag_key) == clean($compare_tag_key) && clean($tag_value) == clean($compare_tag_value)) {

                        $match_count++;
                    }
                }
            }
        }

        if ($match_count == $matches_need) {

            $filtered_parts[] = $part;
        }
    }

    return $filtered_parts;
}

function clean($value) {


    return urlencode(str_replace('/', 'fslash', str_replace('.','%2E',trim($value))));
}

function unclean($value) {

    return str_replace('fslash', '/', str_replace('%2E','.',urldecode($value) ));
}

?>