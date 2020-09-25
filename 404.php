<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package gacr
 */

get_header();
?>

    <section class="error-404 not-found">
        <div class="content">
            <h1 class="page-title"><?php esc_html_e('Oops! That page can&rsquo;t be found.', 'gacr'); ?></h1>
            <div class="page-content">
                <p class="-textCenter"><?php esc_html_e('It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'gacr'); ?></p>

                <?php
                //get_search_form();

                //the_widget('WP_Widget_Recent_Posts');
                ?>


            </div><!-- .page-content -->
        </div>
    </section><!-- .error-404 -->


<?php
get_footer();
