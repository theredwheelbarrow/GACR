<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package gacr
 */

?>

<footer>
    <div style="max-width: 432px;width:100%;margin-bottom:30px;" id="gacr-news-subscription">
        <?php
 if ( shortcode_exists( 'mailpoet_form' ) ) {
    $form_widget = new \MailPoet\Form\Widget();
	echo $form_widget->widget(array('form' => 1, 'form_type' => 'php'));
}
?>
    </div>
        <div>© 2016 GA ČR</div>
</footer>

<?php wp_footer(); ?>

</body>
</html>
