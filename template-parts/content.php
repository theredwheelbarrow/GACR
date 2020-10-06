<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package gacr
 */

?>

<?php
    if ( is_singular() ) :
        the_title( '<h1 class="entry-title">', '</h1>' );
    else :
        the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
    endif;
?>

<article <?php post_class('article'); ?>id="post-<?php the_ID(); ?>">
    <!--<div class="articleInner">-->
    <?php

    if ( 'post' === get_post_type() ) :
        ?>
        <div class="entry-meta">
            <?php
            gacr_posted_on_edited();
            ?>
        </div><!-- .entry-meta -->
    <?php endif; ?>
        <div class="btnFullWidth -textCenter">
            <div class="articleSocial">
                <a href="//www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()) ?>" class="iconSocial iconFacebook"
                   target="_blank" onclick="window.open(this.href,'','scrollbars=1,resizable=1,width=400,height=620');return false;"></a>

                <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode(get_permalink()) ?>"
                   class="iconSocial iconLinkedIn"
                   target="_blank"
                   onclick="window.open(this.href,'','scrollbars=1,resizable=1,width=520,height=570');return false;"></a>

                <a href="http://www.twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()) ?>&text=<?php echo urlencode(single_post_title()) ?>" class="iconSocial iconTwitter" target="_blank"
                   onclick="window.open(this.href,'','scrollbars=1,resizable=1,width=400,height=620');return false;"></a>

            </div>
        </div>


    <?php gacr_post_thumbnail(); ?>
    <!-- MAIN CONTENT -->
    <?php
    the_content( sprintf(
        wp_kses(
        /* translators: %s: Name of current post. Only visible to screen readers */
            __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'gacr' ),
            array(
                'span' => array(
                    'class' => array(),
                ),
            )
        ),
        get_the_title()
    ) );

    wp_link_pages( array(
        'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'gacr' ),
        'after'  => '</div>',
    ) );
    ?>
    <!--</div>-->

    <div class="articleFooter">
        <div class="btnFullWidth -textCenter">
            <div class="articleSocial">
                <a href="//www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()) ?>" class="iconSocial iconFacebook"
                   target="_blank" onclick="window.open(this.href,'','scrollbars=1,resizable=1,width=400,height=620');return false;"></a>

                <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode(get_permalink()) ?>"
                   class="iconSocial iconLinkedIn"
                   target="_blank"
                   onclick="window.open(this.href,'','scrollbars=1,resizable=1,width=520,height=570');return false;"></a>

                <a href="http://www.twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()) ?>&text=<?php echo urlencode(single_post_title()) ?>" class="iconSocial iconTwitter" target="_blank"
                   onclick="window.open(this.href,'','scrollbars=1,resizable=1,width=400,height=620');return false;"></a>

            </div>
        </div>
    </div>
</article>



<?php
// the query
/*$post_id = get_the_ID();
$cat_ids = array();
$categories = get_the_category( $post_id );


if(!empty($categories) && is_wp_error($categories)):
    foreach ($categories as $category):
        array_push($cat_ids, $category->term_id);
    endforeach;
endif;


$projekty = new WP_Query(array(
    'category__in' => $cat_ids,
    'post__not_in' => array($post_id),
    'posts_per_page' => 3,
));*/

$projekty = new WP_Query(
        array( 'category__in' => wp_get_post_categories($post->ID),
            'posts_per_page' => 3,
            'post__not_in' => array($post->ID) ) );



?>

<?php if ($projekty->have_posts()) : ?>
</div>
<section class="sectionProjects" style="padding-bottom: 100px;">
    <div class="content -textCenter">
            <h2><?php echo gacr_translate__('SOUVISEJÍCÍ ČLÁNKY'); ?></h2>

        <div class="projectFlex">


            <?php if ($projekty->have_posts()) : ?>
                <?php while ($projekty->have_posts()) : $projekty->the_post(); ?>

                    <a class="project" href="<?php the_permalink() ?>">

                        <div class="row">
                            <div class="projectHeader">
                                <div class="projectBg" <?php if (has_post_thumbnail()) {
                                    echo "style=\"background-image: url('", the_post_thumbnail_url(), "')\"";
                                } else {
                                    echo "";
                                } ?>></div>
                            </div>
                            <div class="projectBody">
                                <div class="projectText -small">
                                    <p><?php the_title(); ?></p>
                                </div>
                                <div class="projectButton">
                                    <span class="btn -white"><?php echo gacr_translate__('VÍCE INFORMACÍ'); ?></span>
                                </div>
                            </div>
                        </div>

                    </a>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>

            <?php else : ?>
                <p><?php __('No News'); ?></p>
            <?php endif; ?>
        </div>

        <?php if (!empty($tlacitko_main)) : ?>
            <a href="<?php echo $tlacitko_main; ?>" class="btn -bigMargin">ZOBRAZIT DALŠÍ PROJEKTY</a>
        <?php endif; ?>

    </div>

</section>

<?php endif; ?>




		<?php /* gacr_entry_footer(); */ ?>
