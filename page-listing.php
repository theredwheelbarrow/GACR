<?php
/*
Template Name: Listing
 * Template Post Type: post, page, product
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

$post_per_page = 10;

$offset = 0;

$listing_zobrazovane_kategorie = get_field('listing_zobrazovane_kategorie');
$query = new WP_Query(array( 'post_type' => 'post',
    'posts_per_page' => $post_per_page,
    'offset' =>$offset,
    'cat' => $listing_zobrazovane_kategorie
));

?>


<section>
    <div class="content -header">
        <div class="listBig" id="gacr-listing-container">
            <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

            <?php if ( $query->have_posts() ) : ?>
            <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                    <a href="<?php the_permalink() ?>">
                    <div class="listBigStripe">
                <div class="row">
                    <?php
                    $featured_image_url = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );
                    ?>
                    <div class="listBigStripe_img" <?php if ( ! empty( $featured_image_url ) ) { echo "style=\"background-image: url('" , the_post_thumbnail_url() , "')\""; } else {  echo ""; }  ?>></div>
                    <div class="listBigStripe_content">
                        <span class="-fullwidth -nowrap -link"><?php the_title(); ?></span>
                        <span class="-fullwidth -nowrap -date"><?php echo get_the_date() ?></span>
                        <p class="-small"><?php the_excerpt() ?></p>
                    </div>
                </div>
            </div>
                    </a>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>

            <?php else : ?>
                <p><?php __('Nothing there'); ?></p>
            <?php endif; ?>

        </div>

        <div class="btnFullWidth -textCenter">
            <a href="" class="btn -bigMargin" id="load-more"><?php echo gacr_translate__('Zobrazit další články'); ?></a>
        </div>
    </div>
</section>


<?php
//get_sidebar();
get_footer();

?>


<script>
    var $j = jQuery.noConflict();
    $j(function(){

        var offset = 0;

        $j("#load-more").click(function(event){
            event.preventDefault();
            event.stopPropagation();

            offset = offset+<?php echo $post_per_page ?>;

            $j("#load-more").text("NAČÍTÁM");
            $j.getJSON( "<?php echo get_site_url(); ?>/wp-admin/admin-ajax.php?action=gga_posts_by_taxonomy&post_type=post&taxonomy=post_tag<?php
               if (!empty($listing_zobrazovane_kategorie)) { echo "&cat=", $listing_zobrazovane_kategorie; } else { echo ""; };
                ?>&offset="+offset,
                function( data ) {
                    if ($j.isEmptyObject(data['posts'])) {
                        $j("#load-more").hide();
                    } else {
                        $j.each(data['posts'], function(index) {
                            createListItem(data['posts'][index]);
                        });
                    }
                });
            $j("#load-more").text("<?php echo gacr_translate__('Zobrazit další články'); ?>");
            return false;
        });

        function createListItem(postDataMap) {

            var title = $j('<a>').attr('href', postDataMap['permalink']).text(postDataMap['post_title'])
                .attr("class","-fullwidth -nowrap");
            var date = $j('<span>').attr('class', "-fullwidth -nowrap -date").text(postDataMap['post_date']);
            var excerpt = $j('<p>').attr("class","-small").html(postDataMap['post_excerpt']);

            var listBigStripe_content = $j('<div>').attr("class","listBigStripe_content");
            listBigStripe_content.append(title);
            listBigStripe_content.append(date);
            listBigStripe_content.append(excerpt);

            var listBigStripe_img = $j('<div>').attr("class","listBigStripe_img");


            if (!$j.isEmptyObject(postDataMap['post_thumbnail'])) {
                if (postDataMap['post_thumbnail']) {
                    listBigStripe_img.attr("style","background-image: url('"+postDataMap['post_thumbnail']+"');");
                }
            }
            var row = $j('<div>').attr("class","row");
            row.append(listBigStripe_img);
            row.append(listBigStripe_content);

            var listBigStripe = $j('<div>').attr("class","listBigStripe");
            listBigStripe.append(row);

            $j('#gacr-listing-container').append(listBigStripe);
        }

    });
</script>
