<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package gacr
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_directory')?>/css/style.min.css">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'gacr' ); ?></a>


    <header>
        <div class="content -header">
            <?php
            the_custom_logo();
            ?>
            <div class="row">
                <img class="headerLogo" src="img/gacr_logo_cs.svg" alt="">
                <div class="topMenu">
                    <a href="">Pro média</a>
                    <a href="">Grantová Aplikace</a>
                    <a href="">Správa projektů <span class="topMenuArrow">&#x25BE;</span></a>
                    <a href="">English</a>
                </div>
                <a href="" class="icon iconBurger iconMenu"></a>
            </div>
            <?php
            wp_nav_menu( array(
                'theme_location' => 'menu-1',
                'menu_id'        => 'primary-menu',
                'container' => 'div',
                'container_class' => 'headerFlex',
                'menu_class' => 'mainMenu'
            ) );
            ?>
        </div>
    </header>

    <header id="masthead" class="site-header">
		<div class="site-branding">
			<?php
			the_custom_logo();
			if ( is_front_page() && is_home() ) :
				?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php
			else :
				?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php
			endif;
			$gacr_description = get_bloginfo( 'description', 'display' );
			if ( $gacr_description || is_customize_preview() ) :
				?>
				<p class="site-description"><?php echo $gacr_description; /* WPCS: xss ok. */ ?></p>
			<?php endif; ?>
		</div><!-- .site-branding -->

		<nav id="site-navigation" class="main-navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'gacr' ); ?></button>
			<?php
			wp_nav_menu( array(
				'theme_location' => 'menu-1',
				'menu_id'        => 'primary-menu',
                'container' => 'div',
                'container_class' => 'headerFlex',
                'menu_class' => 'mainMenu'
            ) );
			?>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">
