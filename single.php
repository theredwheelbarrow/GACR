<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package gacr
 */

get_header();
?>

    <section <?php if ( 'post' === get_post_type()) : ?> style="padding-bottom:0;" <?php endif; ?>>
    <div class="content">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', get_post_type() );

			//TODO: disabled the_post_navigation();

			// If comments are open or we have at least one comment, load up the comment template.
			/* TODO: disabled if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;*/

		endwhile; // End of the loop.
		?>

    </div>
    </section>
<?php
//get_sidebar();
get_footer();
