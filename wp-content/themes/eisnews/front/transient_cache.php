<?php

$data = wp_cache_get('key');
if (false === $data) {
    $data = "This is data";
    wp_cache_set('key', $data);
}

add_action("save_posts", function () {
    wp_cache_delete('key');
});


//=============================

$data = get_transient('key');

if (false === $data) {
    $data = "This is data";
    set_transient('key', $value);
}

add_action("save_post", function () {
    delete_transient('key');
});

switch ($num) {
    case 1: {
            return "This is 1";
        }
    default: {
            return "This is default";
        }
}


switch($num){
    case 1:
    case 2:
    case 3:{
        
    }
}