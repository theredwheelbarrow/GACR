<?php
/**

 */

//value="<?php echo htmlspecialchars($search_request_value);"
if (isset($_GET['s'])) {
    $search_request_value = $_GET['s'];
} else {
    $search_request_value = '';
}

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400;1,600;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_directory')?>/css/style.min.css">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'gacr' ); ?></a>


    <header>
        <div class="content -header">
            <div class="row">
                <?php
                the_custom_logo();
                ?>
                <?php
                wp_nav_menu( array(
                    'theme_location' => 'menu-2',
                    'menu_id'        => 'secondary-menu',
                    'menu_class' => 'topMenu',
                    'container'=> false,
                    'depth' => 2
                ) );
                ?>
                <span class="icon iconBurger iconMenu"></span>
            </div>
            <div class="headerFlex">
                <?php
                wp_nav_menu( array(
                    'theme_location' => 'menu-1',
                    'menu_id'        => 'primary-menu',
                    'menu_class' => 'mainMenu',
                    'container'=> false,
                    'walker' => new Child_Wrap()
                ) );
                ?>
                <form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
                    <div class="search">
                        <input class="searchInput" type="text" class="field" name="s" id="s" placeholder="<?php gacr_translate__('Hledat ...'); ?>"
                        value="<?php echo htmlspecialchars($search_request_value); ?>">
                        <i class="icon icon-cf-search icon-baseline-search" onclick="(function(){document.getElementById('searchform').submit(); })()"></i>
                    </div>
                </form>
            </div>
        </div>
    </header>


	<div id="content" class="site-content">
