<?php

add_action( 'init', 'cd_add_editor_styles' );
/**
 * Apply theme's stylesheet to the visual editor.
 *
 * @uses add_editor_style() Links a stylesheet to visual editor
 * @uses get_stylesheet_uri() Returns URI of theme stylesheet
 */
function cd_add_editor_styles() {
    add_editor_style( 'css/custom-editor-style.css' );
}



// Insert 'styleselect' into the $buttons array
function my_mce_buttons_2( $buttons ) {
    array_unshift( $buttons, 'styleselect' );
    return $buttons;
}
// Use 'mce_buttons' for button row #1, mce_buttons_3' for button row #3
add_filter('mce_buttons_2', 'my_mce_buttons_2');

function my_mce_before_init_insert_formats( $init_array ) {
    $style_formats = array(
        array(
            'title' => 'UL - big', // Title to show in dropdown
            'selector' => 'ul', // Element to add class to
            'classes' => '-big' // CSS class to add
        ),
        array(
            'title' => 'popisek', // Title to show in dropdown
            'selector' => 'p', // Element to add class to
            'classes' => 'imageDescription' // CSS class to add
        )
    );
    $init_array['style_formats'] = json_encode( $style_formats );
    return $init_array;
}
add_filter( 'tiny_mce_before_init', 'my_mce_before_init_insert_formats' );



function tinymce_config_59772( $init ) {
    // Don't remove line breaks
    $init['remove_linebreaks'] = false;
    // Convert newline characters to BR tags
    $init['convert_newlines_to_brs'] = true;
    // Do not remove redundant BR tags
    $init['remove_redundant_brs'] = false;

    $init['force_br_newlines'] = false;
    $init['force_p_newlines'] = false;
    $init['forced_root_block'] = '';


    // Pass $init back to WordPress
    return $init;
}
//add_filter('tiny_mce_before_init', 'tinymce_config_59772');

function custom_image_size() {
    // Set default values for the upload media box
    update_option('image_default_align', 'center' );

}
add_action('after_setup_theme', 'custom_image_size');


?>