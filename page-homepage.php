<?php
/*

 */

get_header();
$nazev_main = get_field('nazev_main');
$kategorie_main = get_field('kategorie_main');
$tlacitko_main = get_field('tlacitko_main');
$nazev_left = get_field('nazev_left');
$more_left = get_field('more_left');

$kategorie_left = get_field('kategorie_left');
$nazev_right = get_field('nazev_right');
$kategorie_right = get_field('kategorie_right');
$more_right = get_field('more_right');


$y_zobrazovat_youtube = !empty(get_field('y_zobrazovat_youtube'));
$y_nazev_sekce = get_field('y_nazev_sekce');
$y_popis = get_field('y_popis');
$y_youtube_iframe = get_field('y_youtube_iframe');

$gacr_sc_show = !empty(get_field('gacr_sc_show'));
$gacr_sc_nadpis = get_field('gacr_sc_nadpis');
$gacr_sc_obsah_pod_nadpisem = get_field('gacr_sc_obsah_pod_nadpisem');
$gacr_sc_text_tlacitka = get_field('gacr_sc_text_tlacitka');
$gacr_sc_url_tlacitka = get_field('gacr_sc_url_tlacitka');
$gacr_sc_box_na_prave_strane = get_field('gacr_sc_box_na_prave_strane');

?>
<?php if ($gacr_sc_show) : ?>
    <div class="carousel" style="height: auto;">
        <div class="carouselHard -visible"
             id="carousel-special">
            <div class="content">
                <div class="row">
                    <div class="carouselContentHard">
                        <h1 class="carouselHeader"><?php echo $gacr_sc_nadpis; ?></h1>
                        <?php echo $gacr_sc_obsah_pod_nadpisem; ?>
                        <?php if (!empty($gacr_sc_url_tlacitka)) : ?>
                            <a href="<?php echo $gacr_sc_url_tlacitka; ?>"
                               class="btn"><?php echo $gacr_sc_text_tlacitka; ?></a>
                        <?php endif; ?>
                    </div>
                    <div class="carouselContentHardAside">
                        <?php if (!empty($gacr_sc_box_na_prave_strane)) : ?>
                            <div class="carouselBoxSmall">
                                <?php echo $gacr_sc_box_na_prave_strane; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php $slides = new WP_Query(array('post_type' => 'carousel', 'orderby' => 'post_id', 'order' => 'ASC')); ?>

<?php if ($slides->have_posts() && !$gacr_sc_show) : ?>
    <div class="carousel ">

        <?php if ($slides->have_posts()) : ?>
            <?php $post_idx = 0;
            while ($slides->have_posts()) : $slides->the_post(); ?>
                <div class="carouselSlide<?php if ($post_idx == 0) {
                    echo " -visible";
                } else {
                    echo "";
                } ?>" style="<?php if (!empty(get_field('obrazek_na_pozadi'))) {
                    echo "background-image: url('", get_field('obrazek_na_pozadi'), "');";
                } ?>opacity:<?php if ($post_idx == 0) {
                    echo "1;";
                } else {
                    echo "0;";
                } ?>"
                     id="carousel-slide-<?php echo $post_idx ?>">
                    <div class="content">
                        <div class="carouselContent">
                            <h1 class="carouselHeader"><?php echo get_field('nadpis') ?> </h1>
                            <p><?php echo get_field('popis') ?></p>
                            <?php if (!empty(get_field('zobrazit_tlacitko')) && !empty(get_field('url_tlacitka'))) : ?>
                                <a href="<?php echo get_field('url_tlacitka') ?>" class="btn"><?php echo gacr_translate__('VÍCE INFORMACÍ'); ?></a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php $post_idx++; endwhile; ?>

            <div class="content">
                <div class="carousel__circle">
                    <?php $post_idx = 0;
                    while ($slides->have_posts()) : $slides->the_post(); ?>
                        <span class="carousel__circleItem<?php if ($post_idx == 0) {
                            echo " -full";
                        } else {
                            echo "";
                        } ?>" id="carousel-slide-<?php echo $post_idx ?>-circle"></span>
                        <?php $post_idx++; endwhile; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>

<?php endif; ?>


<?php
// the query
$projekty = new WP_Query(array(
    'cat' => !empty($kategorie_main) ? $kategorie_main : '1234567890',
    'posts_per_page' => 3,
    'orderby' => 'post_date',
    'order' => 'DESC'
));
?>
    <section class="sectionProjects">

<?php
// the query
$basicResearch = new WP_Query(array(
    'cat' => !empty($kategorie_left) ? $kategorie_left : '1234567890',
    'posts_per_page' => 3,
    'orderby' => 'post_date',
    'order' => 'DESC'
));
?>


<?php if ($basicResearch->have_posts()) : ?>
    <div class="content">
    <div class="row">

    <div class="listSm col-2">
        <?php if (!empty($nazev_left)) : ?>
            <h3> <?php echo $nazev_left; ?></h3>
        <?php endif; ?>

        <?php if ($basicResearch->have_posts()) : ?>
            <?php while ($basicResearch->have_posts()) : $basicResearch->the_post(); ?>
                <a class="listSmStripe" href="<?php the_permalink() ?>">
                        <div class="row">
                            <div class="listSmStripe_img" <?php if (has_post_thumbnail()) {
                                echo "style=\"background-image: url('", the_post_thumbnail_url(), "')\"";
                            } else {
                                echo "";
                            } ?>></div>
                            <div class="listSmStripe_content">
                                <span class="-fullwidth -nowrap -date"><?php echo get_the_date(); ?></span>
                                <span class="-fullwidth -nowrap -link"><?php the_title(); ?></span>
                            </div>
                        </div>
                </a>

            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>

        <?php else : ?>
            <p><?php __('No News'); ?></p>
        <?php endif; ?>

        <?php if (!empty($more_left)) : ?>
            <a href="<?php echo $more_left; ?>" style="text-align: left;display: inherit;margin-top: 20px;text-decoration: underline;"><?php echo gacr_translate__('Zobrazit další novinky'); ?></a>
        <?php endif; ?>

    </div>
<?php endif; ?>

<?php
// the query
$basicResearch = new WP_Query(array(
    'cat' => !empty($kategorie_right) ? $kategorie_right : '1234567890',
    'posts_per_page' => 3,
    'orderby' => 'post_date',
    'order' => 'DESC'
));
?>
<?php if ($basicResearch->have_posts()) : ?>

    <div class="listSm col-2">
        <?php if (!empty($nazev_right)) : ?>
            <h3> <?php echo $nazev_right; ?></h3>
        <?php endif; ?>
        <?php
        // the query
        $basicResearch = new WP_Query(array(
            'cat' => !empty($kategorie_right) ? $kategorie_right : '1234567890',
            'posts_per_page' => 3,
            'orderby' => 'post_date',
            'order' => 'DESC'
        ));
        ?>

        <?php if ($basicResearch->have_posts()) : ?>
            <?php while ($basicResearch->have_posts()) : $basicResearch->the_post(); ?>
                <a class="listSmStripe" href="<?php the_permalink() ?>">
                        <div class="row">
                            <div class="listSmStripe_img" <?php if (has_post_thumbnail()) {
                                echo "style=\"background-image: url('", the_post_thumbnail_url(), "')\"";
                            } else {
                                echo "";
                            } ?>></div>
                            <div class="listSmStripe_content">
                                <span class="-fullwidth -nowrap -date"><?php echo get_the_date(); ?></span>
                                <span class="-fullwidth -nowrap -link"><?php the_title(); ?></span>
                            </div>
                        </div>
                </a>

            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>

        <?php else : ?>
            <p><?php __('No News'); ?></p>
        <?php endif; ?>
        <?php if (!empty($more_right)) : ?>
            <a href="<?php echo $more_right; ?>" style="text-align: left;display: inherit;margin-top: 20px;text-decoration: underline;"><?php echo gacr_translate__('Zobrazit další články'); ?></a>
        <?php endif; ?>

    </div>
    </div>
    </div>
<?php endif; ?>

        <?php if ($projekty->have_posts()) : ?>
            <div class="content -textCenter">
                <?php if (!empty($nazev_main)) : ?>
                    <h2> <?php echo $nazev_main; ?></h2>
                <?php endif; ?>

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
                    <a href="<?php echo $tlacitko_main; ?>" class="btn -bigMargin"><?php echo gacr_translate__('ZOBRAZIT DALŠÍ PROJEKTY'); ?></a>
                <?php endif; ?>

            </div>
        <?php endif; ?>

    </section>

<?php if ($y_zobrazovat_youtube) : ?>
    <section class="section -youtube">
        <div class="content -textCenter">
            <h2><?php if (!empty($y_nazev_sekce)) {
                    echo $y_nazev_sekce;
                } else {
                    echo "";
                } ?></h2>
            <?php if (!empty($y_popis)) {
                echo $y_popis;
            } ?>
            <div class="videoWrap">
                <div class="youtubeWrap">
                    <?php if (!empty($y_youtube_iframe)) {
                        echo $y_youtube_iframe;
                    } ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php
//get_sidebar();
get_footer();
