<?php

add_filter( 'the_content', 'tgm_io_shortcode_empty_paragraph_fix' );

function tgm_io_shortcode_empty_paragraph_fix( $content ) {

    $array = array(
        '<p>['    => '[',
        ']</p>'   => ']',
        ']<br />' => ']'
    );
    return strtr( $content, $array );

}

function gacr_accordeons( $attr, $content = null ) {
    return '<div class="accordeons">' . do_shortcode($content) . '</div>';
}

add_shortcode('accordeons', 'gacr_accordeons');



function gacr_accordeon( $attr, $content = null ) {
    STATIC $i = 0;
    extract( shortcode_atts( array(
        'title' => 'title',
        'subtitle' => 'subtitle'
    ), $attr ) );


    $toReturn = '';

    if (empty($attr['subtitle'])) {

        $toReturn = '<div class="accordeon">
                        <input id="accordeon-' . $i . '" type="checkbox">
                        <label for="accordeon-' . $i . '">' . $title . '</label>
                        <div class="accordeon-content">'
                            . $content .
                        '</div>
                    </div>
                    ';
    } else if (!empty($attr['subtitle'])) {
        $toReturn = '<div class="accordeon">
                        <input id="accordeon-' . $i . '" type="checkbox">
                        <label for="accordeon-' . $i . '">
                            <div class="accordeonName">' . $title . '</div>
                            <div class="accordeonPosition">' . $subtitle . '</div>
                        </label>
                        <div class="accordeon-content">'
                             . do_shortcode($content) .
                        '</div>
                    </div>
                    ';
    }

    $i++;
    return $toReturn;


}
/*
 * USAGE
 * [accordeon title="titleText" subtitle="subtitleText"]
 * content
 *[/accordeon]
 */
add_shortcode('accordeon', 'gacr_accordeon');



function gacr_select_shortcode( $attr, $content = null ) {
    $center = 'xxx';
    if (!empty($attr['center'])) {
        $center = $attr['center'];
    }
    $centerStyle = "";
    if ($center == 'none') {
        $centerStyle = "";
    } else {
        $centerStyle = 'class="articleCenter" style="margin-bottom: 0;"';
    };
    return '<div '. $centerStyle .'><select class="gacrDynamicSelect">' . do_shortcode($content) . '</select></div>';
}

/*
 * USAGE
 * [gacr-select]
 *  [gacr-option value="1"]nazevPolozky1[/gacr-option]
 *  [gacr-option value="2"]nazevPolozky2[/gacr-option]
 *[/gacr-select]
 */
add_shortcode('gacr-select', 'gacr_select_shortcode');


function gacr_option_shortcode( $attr, $content = null ) {

    $toReturn = '<option value="gacrOptionDynamicId-' . $attr['value'] . '" >'  . $content . '</option>';
    return $toReturn;
}

add_shortcode('gacr-option', 'gacr_option_shortcode');




function gacr_option_result_shortcode( $attr, $content = null ) {

    $show = $attr['show'];
    $display = 'none';
    if ($show === 'true') { $display = 'block'; };

    $toReturn = '<div id="gacrOptionDynamicId-' . $attr['value'] . '" style="display: ' . $display .'">' . do_shortcode($content) . '</div>';
    return $toReturn;
}

/*
 * [gacr-option-result value="1" show="true"]
 *  obsah, ktery by mel byt videt
 * [/gacr-option-result]
 */
add_shortcode('gacr-option-result', 'gacr_option_result_shortcode');



function gacr_rozcestnik( $attr, $content = null ) {
    return '<div class="rozcestnik">' . do_shortcode($content) . '</div>';
}

add_shortcode('rozcestnik', 'gacr_rozcestnik');


function gacr_rozcestnik_item( $attr, $content = null ) {
    $text = $attr['text'];
    $href = $attr['href'];

    $toReturn = '<a href="'. $href . '" class="rozcestnikItem">
                    <p>'. $text . '</p>
                    <div class="rozcestnikButton"><span class="btn -white">'. pll__('VÍCE INFORMACÍ') .'</span></div>
                </a>';
    return $toReturn;
}

add_shortcode('rozcestnik-item', 'gacr_rozcestnik_item');



?>
