<?php

function gacr_translate__($content) {
    if (function_exists('pll_e')) {
        return pll_e($content);
    } else {
        return $content;
    }
}

add_filter('gacr_translate__', 'gacr_translate__');

add_action('init', function() {
    if (function_exists('pll_register_string')) {
        pll_register_string('ZOBRAZIT DALŠÍ PROJEKTY', 'ZOBRAZIT DALŠÍ PROJEKTY', 'gacr-texts');
        pll_register_string('PŘÍLOHY', 'PŘÍLOHY', 'gacr-texts');
        pll_register_string('VÍCE INFORMACÍ', 'VÍCE INFORMACÍ', 'gacr-texts');
        pll_register_string('Hledat ...', 'Hledat ...', 'gacr-texts');
        pll_register_string('Zobrazit další novinky', 'Zobrazit další novinky', 'gacr-texts');
        pll_register_string('Zobrazit další články', 'Zobrazit další články', 'gacr-texts');
    }
});



?>
