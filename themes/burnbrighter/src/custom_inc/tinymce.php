<?php

//* Edit color picker
// http://urosevic.net/wordpress/tips/custom-colours-tinymce-4-wordpress-39/
add_filter( 'tiny_mce_before_init', 'tw_tiny_mce_customization', 2 );
function tw_tiny_mce_customization( $init ) {
    //colors
    $default_colours = '
     "000000", "Black",
     "FFFFFF", "White"
     ';
    $custom_colours = '
        "8ebd54", "Burn Brigter green",
        "df5558", "Burn Brigter red",
        "3e3636", "Burn Brighter dark gray",
        "d3d3d3", "Burn Brigter gray rule",
        "e4e4e4", "Burn Brigter lightest gray"
     ';
    // Insert the array, JSON ENCODED, into 'style_formats'
    $init['textcolor_map'] = '['.$default_colours.','.$custom_colours.']';
  
    return $init;
}
