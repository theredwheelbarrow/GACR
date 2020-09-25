<?php
/**
 * Template part for displaying page content in page.php
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
        /*if ( 'post' === get_post_type() || 'page' === get_post_type()) :
            ?>
            <div class="entry-meta">
                <?php
                gacr_posted_on_edited();
                ?>
            </div><!-- .entry-meta -->
        <?php endif; ?>
        <div class="btnFullWidth -textCenter">
            <div class="articleSocial">
                <a href="" class="iconSocial iconFacebook"></a>
                <a href="" class="iconSocial iconLinkedIn"></a>
                <a href="" class="iconSocial iconTwitter"></a>
                <a href="" class="iconSocial iconGoogle"></a>
            </div>
        </div>*/
?>
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

    <?php if ( 'post' === get_post_type()) : ?>
    <div class="articleFooter">
        <span class="articleAuthor">Autor: <?php gacr_posted_by_edited() ?></span>
        <!--<div class="btnFullWidth -textCenter">
            <div class="articleSocial">
                <a href="" class="iconSocial iconFacebook"></a>
                <a href="" class="iconSocial iconLinkedIn"></a>
                <a href="" class="iconSocial iconTwitter"></a>
                <a href="" class="iconSocial iconGoogle"></a>
            </div>
        </div>-->
    </div>
    <?php endif; ?>
</article>

