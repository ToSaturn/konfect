<?php
/*
Template Name: Личный кабинет
*/
get_header();
?>
<main class="account">
	<h1><?php wp_title("", true); ?></h1>
	<div class="left_sidebar">
		<?php get_sidebar('left'); ?>
	</div>
</main>


<?php
get_footer();
?>