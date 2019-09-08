<?php
/*
Template Name: Контакты
*/
get_header();
?>
<main class="contacts">
	<h1><?php wp_title("", true); ?></h1>
	<div class="contact_wrap">
		<div class="contact_block">
			<div>
				<p><?php the_field('текст_контакты'); ?></p>
				<span class="email"><?php the_field('email'); ?></span>
				<span class="phone"><?php the_field('телефон'); ?></span>
				<span class="inst"><?php the_field('инстаграмм'); ?></span>
			</div>
			<div>
				<?php echo do_shortcode('[wpforms id="34" title="false" description="false"]'); ?>
			</div>
		</div>
	</div>
</main>

<?php
get_footer();
?>