<?php
/**
 * Template for a lesson preview element
 * @author 		LifterLMS
 * @package 	LifterLMS/Templates
 * @since       1.0.0
 * @version     3.19.2
 */
defined( 'ABSPATH' ) || exit;

$restrictions = llms_page_restricted( $lesson->get( 'id' ), get_current_user_id() );
$data_msg = $restrictions['is_restricted'] ? ' data-tooltip-msg="' . esc_html( strip_tags( llms_get_restriction_message( $restrictions ) ) ) . '"' : '';
?>





	<div class="viewed qwe">
		<div class="separate_set_accordion accordion">
			<div class="viewed_right">Просмотренно</div>
			<div class="viewed_left">Просмотренно</div>
			<div class="accordion_header">
				<button><?php echo get_the_title( $lesson->get( 'id' ) ) ?></button>
			</div>
			<span class="close">+</span>
			<div class="collapse">
				<div class="row">
					<div class="col">
						<div class="preview"><?php echo get_the_post_thumbnail( $lesson->get( 'id' ) ) ?></div>
						<a href="<?php echo ( ! $restrictions['is_restricted'] ) ? get_permalink( $lesson->get( 'id' ) ) : '#llms-lesson-locked'; ?>" class="accordion_but">СМОТРЕТЬ</a>
					</div>

					<div class="col">
						<button class="close"><?php echo get_the_title( $lesson->get( 'id' ) ) ?></button>

						<div class="row">
							<span class="duration">50 МИНУТ</span>
						</div>
						<p><?php echo llms_get_excerpt( $lesson->get( 'id' ) ); ?></p>

					</div>
				</div>
			</div>
		</div>
	</div>

