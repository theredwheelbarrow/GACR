<?php
/**
 * The template for displaying attachments as list.
 *
 * Override this template by copying it to yourtheme/attachments-list.php
 *
 * @author Digital Factory
 * @package Download Attachments/Templates
 */

// exit if accessed directly
if ( ! defined( 'ABSPATH' ) )
	exit;

if ( empty( $args ) || ! is_array( $args ) )
	exit;

// extract variable storing all the parameters and attachments
extract( $args );

// you can start editing here 
?>

<?php if ( ! ( $display_empty === 0 && $count === 0 ) ) : ?>

	<?php if ( $container !== '' ) : ?>
		<<?php echo $container . ( $container_id !== '' ? ' id="' . $container_id . '"' : '' ) . ( $container_class !== '' ? ' class="' . $container_class . '"' : '' ); ?>>
	<?php endif; ?>

	<?php
    if ( $title !== '' ) : ?>
        <?php /* echo ( $title !== '' ? '<' . $title_container . ' class="' . $title_class . '">' . $title . '</' . $title_container . '>' : '' ); */ ?>
        <?php echo ( '<' . $title_container . ' class="' . $title_class . '">') ?>
        <?php echo ($title == 'Attachments' ? gacr_translate__('PŘÍLOHY') : $title ) ?>
        <?php echo ( '</' . $title_container . '>' ) ?>

	<?php endif; ?>

<?php endif; ?>

<?php echo $content_before; ?>

<?php if ( $count > 0 ) :
	$i = 1; ?>

	<div class="gacr_attachments">

	<?php 
	// attachments loop
	foreach ( $attachments as $attachment ) : 
	?>

		<?php if ( $use_desc_for_title === 1 && $attachment_description !== '' ) :
			$attachment_title = apply_filters( 'da_display_attachment_title', $attachment['description'] );
		else :
			$attachment_title = apply_filters( 'da_display_attachment_title', $attachment['title'] );
		endif; ?>


		<div class="gacrAttachmentsStripe <?php echo $attachment['type']; ?>">
            <div class="row">

                <?php if ( $display_icon === 1 ) : ?>
                    <div class="gacrAttachmentsStripe_img attachment-img <?php echo $attachment['type']; ?>">
                        <!--<img class="attachment-icon" src="<?php /* echo $attachment['icon_url']; */ ?>" alt="<?php /* echo $attachment['type']; */ ?>" />-->
                    </div>
                <?php endif; ?>

                <div class="gacrAttachmentsStripe_content">
                    <div class="-fullwidth">
                        <?php if ( $link_before !== '' ) : ?>
                            <span class="attachment-link-before"><?php echo $link_before; ?></span>
                        <?php endif; ?>
                        <a href="<?php echo da_get_download_attachment_url( $attachment['ID'] ); ?>" class="attachment-link" title="<?php echo esc_html( $attachment_title ); ?>"><?php echo $attachment_title; ?></a>
                        <?php if ( $link_after !== '' ) : ?>
                            <span class="attachment-link-after"><?php echo $link_after; ?></span>
                        <?php endif; ?>
                    </div>
                    <?php if ( $display_index === 1 ) : ?>
                        <span class="attachment-index attachment-label -date"><?php echo $i++; ?></span>
                    <?php endif; ?>

                    <?php if ( $display_size === 1 ) : ?>
                        <span class="attachment-size attachment-label -date"><?php echo __( '', 'download-attachments' ); ?> <?php echo size_format( $attachment['size'] ); ?></span>
                    <?php endif; ?>

                    <?php if ( $display_date === 1 ) : ?>
                        <span class="attachment-date attachment-label -date"><?php echo __( 'Datum přidání', 'download-attachments' ); ?>: <?php echo date_i18n( get_option( 'date_format' ), strtotime( $attachment['date_added'] ) ); ?></span>
                    <?php endif; ?>

                    <?php if ( $display_user === 1 ) : ?>
                        <span class="attachment-user attachment-label -date"><?php echo __( 'Přidal', 'download-attachments' ); ?>: <?php echo get_the_author_meta( 'display_name', $attachment['user_added'] ); ?></span>
                    <?php endif; ?>

                    <?php if ( $display_count === 1 ) : ?>
                        <span class="attachment-downloads attachment-label -date"><?php echo __( 'Počet Stažení', 'download-attachments' ); ?>: <?php echo $attachment['downloads']; ?></span>
                    <?php endif; ?>

                    <?php if ( $display_caption === 1 && $attachment['caption'] !== '' ) : ?>
                        <span class="attachment-caption -fullwidth"><?php echo $attachment['caption']; ?></span>
                    <?php endif; ?>

                    <?php if ( $display_description === 1 && $use_desc_for_title === 0 && $attachment['description'] !== '' ) : ?>
                        <span class="attachment-description -fullwidth"><?php echo $attachment['description']; ?></span>
                    <?php endif; ?>

                </div>



            </div>
		</div>

	<?php endforeach; ?>

	</div>

<?php elseif ( $display_empty === 1 ) : ?>

	<?php echo $display_option_none; ?>

<?php endif; ?>

<?php echo $content_after; ?>

<?php if ( ! ( $display_empty === 0 && $count === 0 ) && $container !== '' ) : ?>
	</<?php echo $container; ?>>
<?php endif; ?>