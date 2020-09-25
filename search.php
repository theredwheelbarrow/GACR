<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package gacr
 */

get_header();
?>

    <section>
        <div class="content -header">
            <div class="listBig" id="gacr-listing-container">
                <h2>Výsledky hledání</h2>
                <p class="-textCenter">pro: <b><?php printf( esc_html__( '%s', 'gacr' ), '<span>' . get_search_query() . '</span>' ); ?></b></p>

                <?php if ( have_posts() ) : ?>
                    <?php while ( have_posts() ) : the_post(); ?>
                        <div class="listBigStripe">
                            <div class="row">
                                <div class="listBigStripe_img" <?php if ( has_post_thumbnail() ) { echo "style=\"background-image: url('" , the_post_thumbnail_url() , "')\""; } else {  echo ""; }  ?>></div>
                                <div class="listBigStripe_content">
                                    <a href="<?php the_permalink() ?>" class="-fullwidth -nowrap"><?php the_title(); ?></a>
                                    <span class="-fullwidth -nowrap -date"><?php echo get_the_date() ?></span>
                                    <p class="-small"><?php the_excerpt() ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>

                <?php else : ?>
                    <p><?php __('Nothing there'); ?></p>
                <?php endif; ?>

            </div>

            <!--<div class="btnFullWidth -textCenter">
                <a href="" class="btn -bigMargin" id="load-more">ZOBRAZIT DALŠÍ ČLÁNKY</a>
            </div>-->
        </div>
    </section>


<?php
//get_sidebar();
get_footer();
