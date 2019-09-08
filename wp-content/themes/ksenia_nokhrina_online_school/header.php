<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Ksenia_Nokhrina_Online_School
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<!-- Шрифт Montserrat/ Neucha -->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,400i,700|Neucha&display=swap&subset=cyrillic-ext" rel="stylesheet">
	<title></title>
	<?php wp_head(); ?>
</head>
<body>
<!-- Шапка -->
<header>
	<div class="row">
		<!-- левое меню -->
		<?php wp_nav_menu(array(
				  'container'				=>		'nav',
				  'theme_location'  		=> 	'Меню слева',
				  'container_class' 		=> 	'left_menu',
				  'menu'            		=> 	'Меню слева', 
		)); ?>
		<!-- лого -->
		<div class="logo">
			<?php echo get_custom_logo(); ?>
		</div>
		<!-- правое меню -->
		<?php wp_nav_menu(array(
				  'container'				=>		'nav',
				  'theme_location'  		=> 	'Меню справа',
				  'container_class' 		=> 	'right_menu',
				  'menu'            		=> 	'Меню справа', 
		)); ?>
		<!-- переключение языка -->
		<div class="lang"></div>
	</div>
</header>