<?php
/*
Template Name: Submenu
 * Template Post Type: page
 */

/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package gacr
 */

get_header();

?>


<section>
    <div class="content -header">
        <h1><?php single_post_title(); ?></h1>
        <div class="submenuListing">
        <?php
        wp_nav_menu( array(
            'menu'     => 'Nova struktura - primary',
            'sub_menu' => true,
            'walker' => new Rozcestnik_Walker(),
            /*'link_before' => '<div class="rozcestnikItem">',
            'link_after' => '</div>'*/
        ) );

        ?>
        </div>


    </div>
</section>


<?php
//get_sidebar();
get_footer();

?>
