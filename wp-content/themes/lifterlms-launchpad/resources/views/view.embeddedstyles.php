<?php
$google_fonts = array();
foreach ( $args->font_families as $font ) {
    if ( 'google' === $font['font_type'] && ! in_array( $font['font_name'], $google_fonts ) ) {
        $google_fonts[] = $font['font_name'];
    }
}
?>

<?php if ( count( $google_fonts ) ) : ?>
<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=<?php echo implode( '|', $google_fonts ); ?>">
<?php endif; ?>

<style type="text/css">
    body {
        color: <?php echo $args->font_color_body; ?>;
        font-family: <?php echo $args->font_families['body']['font_family']; ?>;
    }

    h1, h2, h3, h4, h5, h6 {
        font-family: <?php echo $args->font_families['headings']['font_family']; ?>;
    }

    #site-navigation a, #nav-mobile a {
        font-family: <?php echo $args->font_families['menu']['font_family']; ?>;
    }

    .container,
    body.lp-layout-content.fl-builder .wrap-main > .container .entry-header,
    body.lp-layout-content.fl-builder .wrap-main > .container .entry-footer,
    body.lp-layout-content.fl-builder .wrap-main > .container .comments-area,
    body.lp-layout-content.fl-builder .wrap-main > .container .llms-meta-info,
    body.lp-layout-content.fl-builder .wrap-main > .container .post-thumbnail,
    body.lp-layout-content.fl-builder .wrap-main > .container .llms-access-plans,
    body.lp-layout-content.fl-builder .wrap-main > .container .llms-syllabus-wrapper,
    body.lp-layout-content.fl-builder .wrap-main > .container .llms-parent-course-link,
    body.lp-layout-content.fl-builder .wrap-main > .container .llms-course-navigation {
        max-width: <?php echo $args->width_container; ?>px;
    }

    body.lp-layout-content.fl-builder .wrap-main > .container .entry-header,
    body.lp-layout-content.fl-builder .wrap-main > .container .entry-footer,
    body.lp-layout-content.fl-builder .wrap-main > .container .comments-area,
    body.lp-layout-content.fl-builder .wrap-main > .container .post-thumbnail,
    body.lp-layout-content.fl-builder .wrap-main > .container .llms-access-plans,
    body.lp-layout-content.fl-builder .wrap-main > .container .llms-course-navigation {
        margin: 0 auto;
    }

    body.lp-layout-content.fl-builder .wrap-main > .container .llms-meta-info,
    body.lp-layout-content.fl-builder .wrap-main > .container .llms-parent-course-link,
    body.lp-layout-content.fl-builder .wrap-main > .container .llms-syllabus-wrapper {
        margin-left: auto;
        margin-right: auto;
    }

    body.lp-layout-content.fl-builder .wrap-main > .container {
        max-width: none;
        padding: 0;
        width: auto;
    }

    #content,
    .wrap-sidebar #secondary {
        margin-top: <?php echo $args->margin_top_container; ?>px;
    }

    @media (min-width: 750px) {
        .site-main > article {
             margin-bottom: <?php echo $args->margin_bottom_container; ?>px;
        }
    }

    #wrap-header {
        background-color: <?php echo $args->header_background_color; ?>;
        <?php if ( $args->header_background_image ) : ?>
        background-image: url("<?php echo $args->header_background_image; ?>");
        <?php endif; ?>
        background-position: <?php echo $args->header_background_image_position_x; ?> <?php echo $args->header_background_image_position_y; ?>;
        background-repeat: <?php echo ( 'yes' === $args->header_background_image_repeat ) ? 'repeat': 'no-repeat'; ?>;
    }

    .site-header { padding: <?php echo $args->padding_top_header; ?>px <?php echo $args->padding_right_header; ?>px <?php echo $args->padding_bottom_header; ?>px <?php echo $args->padding_left_header; ?>px; }
    .site-logo {
        width: <?php echo $args->logo_width; ?>px;
        padding-top: <?php echo $args->logo_distance_top_header; ?>px;
    }

	#menu-header{
		margin-bottom: 0;
		padding-top: <?php echo $args->menu_distance_top_header; ?>px;
	}

    header#masthead h1.site-title {
        background: none;
        color: <?php echo $args->font_color_site_title; ?>;
        font-size: <?php echo $args->font_size_site_title; ?>px;
        line-height: <?php echo $args->font_size_site_title; ?>px;
    }

    header#masthead h1.site-title a {
        color: <?php echo $args->font_color_site_title; ?>;
    }

    header#masthead h2.site-description {
        color: <?php echo $args->font_color_site_description; ?>;
    }

    h1 {
        color: <?php echo $args->font_color_h1; ?>;
        font-size: <?php echo $args->font_size_h1; ?>px;
    }

    h2 {
        color: <?php echo $args->font_color_h2; ?>;
        font-size: <?php echo $args->font_size_h2; ?>px;
    }

    h3 {
        color: <?php echo $args->font_color_h3; ?>;
        font-size: <?php echo $args->font_size_h3; ?>px;
    }

    h4 {
        color: <?php echo $args->font_color_h4; ?>;
        font-size: <?php echo $args->font_size_h4; ?>px;
    }

    h5 {
        color: <?php echo $args->font_color_h5; ?>;
        font-size: <?php echo $args->font_size_h5; ?>px;
    }

    h6 {
        color: <?php echo $args->font_color_h6; ?>;
        font-size: <?php echo $args->font_size_h6; ?>px;
    }

    p {
        font-size: <?php echo $args->font_size_p; ?>px;
    }

    li {
        font-size: <?php echo $args->font_size_li; ?>px;
    }

    a,
    .llms-button-text,
    input.llms-button-text,
    input[type=reset].llms-button-text,
    input[type=submit].llms-button-text {
        color: <?php echo $args->font_color_primary_link; ?>;
    }

    a:hover,
    .llms-button-text:hover,
    input.llms-button-text:hover,
    input[type=reset].llms-button-text:hover,
    input[type=submit].llms-button-text:hover {
        color: <?php echo $args->font_color_primary_link_hover; ?>;
    }

    #responsive-menu ul li a {
        color: <?php echo $args->font_color_main_menu; ?>;
        font-size: <?php echo $args->font_size_main_menu; ?>px;
		font-weight: <?php echo $args->font_weight_main_menu; ?>;
		padding-left: <?php echo $args->text_distance_main_menu; ?>px;
    }

	#responsive-menu ul li:first-child a {
		padding-left: 0px;
	}

    #responsive-menu ul li a:hover {
        color: <?php echo $args->hover_color_main_menu; ?>;
    }

    #responsive-menu ul.sub-menu li a {
        color: <?php echo $args->font_color_main_submenu; ?>;
    }

    #responsive-menu ul.sub-menu li a:hover {
        color: <?php echo $args->hover_color_main_submenu; ?>;
    }

    #responsive-menu ul.sub-menu li a {
        background-color: <?php echo $args->bg_color_main_submenu; ?>;
    }

    #site-navigation .menu-inline li ul li a:hover {
        background-color: <?php echo $args->bghover_color_main_submenu; ?>;
    }

    #site-navigation .menu-inline li ul li {
        border-color: <?php echo $args->border_color_main_submenu; ?>;
        border-width: <?php echo $args->border_width_main_submenu; ?>px;
    }

    nav#nav-mobile a{
        font-size: <?php echo $args->font_size_mobile_menu; ?>px;
        color: <?php echo $args->font_color_mobile_menu; ?>;
        background-color: <?php echo $args->bg_color_mobile_menu; ?>;
    }

    .breadcrumb-wrapper {
        background-color: <?php echo $args->background_color_breadcrumbs; ?>;
    }

    #breadcrumbs span a.bread-link {
        color: <?php echo $args->font_color_breadcrumb; ?>;
    }

    #breadcrumbs span.item-current {
        color: <?php echo $args->font_color_breadcrumb_current_page; ?>;
    }

    #breadcrumbs {
        font-size:12px;
    }

    #breadcrumbs .separator {
        color: <?php echo $args->font_color_breadcrumb_separator_icon; ?>;
    }

    .site-footer {
        background-color: <?php echo $args->background_color_footer; ?>;
        color: <?php echo $args->footer_font_color; ?>
        padding-top: <?php echo $args->padding_top_footer; ?>px;
        padding-bottom: <?php echo $args->padding_bottom_footer; ?>px;
        padding-right: <?php echo $args->padding_right_footer; ?>px;
        padding-left: <?php echo $args->padding_left_footer; ?>px;
    }

    .site-footer a {
        color: <?php echo $args->footer_link_color; ?>;
    }

    .site-footer a:hover {
        color: <?php echo $args->footer_link_hover_color; ?>;
    }

    .site-footer p, .site-footer li, .site-footer h1, .site-footer h2, .site-footer h3, .site-footer h4, .site-footer h5, .site-footer h6 {
        color: <?php echo $args->footer_font_color; ?>
    }

    .site-footer .widget .widget-title {
        color: <?php echo $args->footer_widget_title_font_color; ?>
    }

    .site-info {
        background-color: <?php echo $args->background_color_site_info; ?>;
        color: <?php echo $args->font_color_site_info; ?>;
        padding-top: <?php echo $args->padding_top_site_info; ?>px;
        padding-bottom: <?php echo $args->padding_bottom_site_info; ?>px;
        padding-right: <?php echo $args->padding_right_site_info; ?>px;
        padding-left: <?php echo $args->padding_left_site_info; ?>px;
    }

    .site-info a {
        color: <?php echo $args->link_color_site_info; ?>;
    }

    .site-info a:hover {
        color: <?php echo $args->link_hover_color_site_info; ?>;
    }

    .site-info p, .site-info li, .site-info h1, .site-info h2, .site-info h3, .site-info h4, .site-info h5, .site-info h6 {
        color: <?php echo $args->font_color_site_info; ?>
    }

    .launchpad-button,
    .llms-button-primary,
    .llms-button-action,
    .button,
    input[type="submit"],
    input[type="reset"],
    input[type="button"],
    button {
        background-color: <?php echo $args->background_color_button_primary; ?>;
        border-color: <?php echo $args->border_color_button_primary; ?>;
        color: <?php echo $args->font_color_button_primary; ?>;
        padding-top: <?php echo $args->padding_top_button; ?>px;
        padding-bottom: <?php echo $args->padding_bottom_button; ?>px;
        padding-right: <?php echo $args->padding_right_button; ?>px;
        padding-left: <?php echo $args->padding_left_button; ?>px;
    }

    .launchpad-button:hover,
    .llms-button-primary:hover,
    .llms-button-action:hover,
    .button:hover,
    input[type="submit"]:hover,
    input[type="reset"]:hover,
    input[type="button"]:hover,
    button:hover,
    .launchpad-button:active,
    .llms-button-primary:active,
    .llms-button-action:active,
    .button:active,
    input[type="submit"]:active,
    input[type="reset"]:active,
    input[type="button"]:active,
    button:active,
    .launchpad-button:focus,
    .llms-button-primary:focus,
    .llms-button-action:focus,
    .button:focus,
    input[type="submit"]:focus,
    input[type="reset"]:focus,
    input[type="button"]:focus,
    button:focus {
        background-color: <?php echo $args->background_color_button_primary_hover; ?>;
        border-color: <?php echo $args->border_color_button_primary_hover; ?>;
        color: <?php echo $args->font_color_button_primary_hover; ?>;
    }


    .llms-button-secondary {
        background-color: <?php echo $args->background_color_secondary_button; ?>;
        border-color: <?php echo $args->border_color_secondary_button; ?>;
        color: <?php echo $args->font_color_secondary_button; ?>;
        padding-top: <?php echo $args->padding_top_secondary_button; ?>px;
        padding-bottom: <?php echo $args->padding_bottom_secondary_button; ?>px;
        padding-right: <?php echo $args->padding_right_secondary_button; ?>px;
        padding-left: <?php echo $args->padding_left_secondary_button; ?>px;
    }

    .llms-button-secondary:hover,
    .llms-button-secondary:active,
    .llms-button-secondary:focus {
        background-color: <?php echo $args->background_color_secondary_button_hover; ?>;
        border-color: <?php echo $args->border_color_secondary_button_hover; ?>;
        color: <?php echo $args->font_color_secondary_button_hover; ?>;
    }

    <?php if (is_lifterlms_enabled()) : ?>

    .llms-loop-item-content {
        background: <?php echo $args->lifterlms_background_color_product_tile; ?>;
        padding-top: <?php echo $args->lifterlms_padding_top_product_tile; ?>px;
        padding-bottom: <?php echo $args->lifterlms_padding_bottom_product_tile; ?>px;
        padding-right: <?php echo $args->lifterlms_padding_right_product_tile; ?>px;
        padding-left: <?php echo $args->lifterlms_padding_left_product_tile; ?>px;
        border: <?php echo $args->lifterlms_border_width_product_tile; ?>px
        solid
    <?php echo $args->lifterlms_border_color_product_tile; ?>;
        border-radius: <?php echo $args->lifterlms_border_radius_product_tile; ?>px;
        text-align: <?php echo $args->lifterlms_text_align_product_tile; ?>;
        box-shadow:
            <?php echo $args->lifterlms_boxshadow_offset_x_product_tile; ?>px
                <?php echo $args->lifterlms_boxshadow_offset_y_product_tile; ?>px
                <?php echo $args->lifterlms_boxshadow_blur_product_tile; ?>px
                <?php echo $args->lifterlms_boxshadow_spread_product_tile; ?>px
    <?php echo $args->lifterlms_boxshadow_color_product_tile; ?>;
    }

    .llms-loop-item-content:hover {
        background-color: <?php echo $args->lifterlms_background_color_hover_product_tile; ?>;
    }

    .llms-loop-item-content .llms-featured-image {
        border-top-left-radius: <?php echo $args->lifterlms_border_radius_product_tile; ?>px;
        border-top-right-radius: <?php echo $args->lifterlms_border_radius_product_tile; ?>px;
    }

    .llms-loop-item .llms-loop-item-footer {
        padding-top: <?php echo $args->lifterlms_padding_top_product_tile_footer; ?>px;
        padding-bottom: <?php echo $args->lifterlms_padding_bottom_product_tile_footer; ?>px;
        padding-right: <?php echo $args->lifterlms_padding_right_product_tile_footer; ?>px;
        padding-left: <?php echo $args->lifterlms_padding_left_product_tile_footer; ?>px;
        margin-top: <?php echo $args->lifterlms_margin_top_product_tile_footer; ?>px;
        margin-bottom: <?php echo $args->lifterlms_margin_bottom_product_tile_footer; ?>px;
        margin-right: <?php echo $args->lifterlms_margin_right_product_tile_footer; ?>px;
        margin-left: <?php echo $args->lifterlms_margin_left_product_tile_footer; ?>px;
        border: <?php echo $args->lifterlms_border_width_product_tile_footer; ?>px
        solid
    <?php echo $args->lifterlms_border_color_product_tile_footer; ?>;
    }


    .llms-loop-item .llms-loop-title {
        font-size: <?php echo $args->lifterlms_font_size_product_tile_title; ?>px;
        color: <?php echo $args->lifterlms_font_color_product_tile_title; ?>;
        padding-top: <?php echo $args->margin_top_product_tile_title; ?>px;
        padding-bottom: <?php echo $args->margin_bottom_product_tile_title; ?>px;
        padding-right: <?php echo $args->margin_right_product_tile_title; ?>px;
        padding-left: <?php echo $args->margin_left_product_tile_title; ?>px;
    }

    .llms-loop-item-content .llms-loop-title:hover {
        color: <?php echo $args->lifterlms_font_color_product_tile_title_hover; ?>;
    }

    .llms-loop-item .llms-meta,
    .llms-loop-item .llms-author {
        padding-top: <?php echo $args->padding_top_product_tile_metas; ?>px;
        padding-bottom: <?php echo $args->padding_bottom_product_tile_metas; ?>px;
        padding-right: <?php echo $args->padding_right_product_tile_metas; ?>px;
        padding-left: <?php echo $args->padding_left_product_tile_metas; ?>px;
    }

    .llms-loop-item .llms-meta p,
    .llms-loop-item .llms-author .name {
        color: <?php echo $args->lifterlms_font_color_product_tile_metas; ?>;
        font-size: <?php echo $args->lifterlms_font_size_product_tile_metas; ?>px;
    }

    .llms-my-courses > h3 {
        background-color: <?php echo $args->lifterlms_background_color_account_course_tile_title; ?>;
    }

    .llms-my-certificates > h3 {
        background-color: <?php echo $args->lifterlms_background_color_account_certificate_tile_title; ?>;
    }

    .llms-my-achievements > h3 {
        background-color: <?php echo $args->lifterlms_background_color_account_achievement_tile_title; ?>;
    }

    .llms-my-memberships > h3 {
        background-color: <?php echo $args->lifterlms_background_color_account_membership_tile_title; ?>;
    }

    .single-course .entry-title {
        font-size: <?php echo $args->lifterlms_font_size_course_title; ?>px;
        color: <?php echo $args->lifterlms_font_color_course_title; ?>;
		font-weight: <?php echo $args->font_weight_course_title; ?>;
    }

    .single-course .post-thumbnail {
    <?php if ($args->lifterlms_hide_course_featured_image === 'yes') : ?>
        display: none;
        post-thumbnail
    <?php endif; ?>
    }

    .single-course .llms-meta-info .llms-meta-title {
        color: <?php echo $args->font_color_meta_title; ?>;
        font-size: <?php echo $args->font_size_meta_title; ?>px;
        margin: <?php echo $args->meta_title_margin_top; ?>px <?php echo $args->meta_title_margin_right; ?>px <?php echo $args->meta_title_margin_bottom; ?>px <?php echo $args->meta_title_margin_left; ?>px;
    }

    .single-course .llms-meta-info .llms-meta p,
    .single-course .llms-meta-info .llms-meta .llms-author p {
        color: <?php echo $args->font_color_meta_info; ?>;
        font-size: <?php echo $args->font_size_meta_info; ?>px;
    }

    .llms-syllabus-wrapper {
        text-align: <?php echo $args->lifterlms_text_alignment_course_syllabus_title; ?>;
    }

    .llms-syllabus-wrapper .llms-section-title {
        font-size: <?php echo $args->lifterlms_font_size_course_syllabus_title; ?>px;
        color: <?php echo $args->lifterlms_font_color_course_syllabus_title; ?>;
    }

    .llms-lesson-preview {
        margin-top: <?php echo $args->lifterlms_margin_top_lesson_preview; ?>px;
        margin-bottom: <?php echo $args->lifterlms_margin_bottom_lesson_preview; ?>px;
        margin-right: <?php echo $args->lifterlms_margin_right_lesson_preview; ?>px;
        margin-left: <?php echo $args->lifterlms_margin_left_lesson_preview; ?>px;
        width: <?php echo $args->lifterlms_width_lesson_preview; ?>px;
    }

    .llms-lesson-preview a.llms-lesson-link, .llms-lesson-preview a.llms-lesson-link-locked {
        background: <?php echo $args->lifterlms_background_color_lesson_preview; ?>;
        border: <?php echo $args->lifterlms_border_width_lesson_preview; ?>px
        solid
    <?php echo $args->lifterlms_border_color_lesson_preview; ?>;
        box-shadow:
            <?php echo $args->lifterlms_boxshadow_offset_x_lesson_preview; ?>px
                <?php echo $args->lifterlms_boxshadow_offset_y_lesson_preview; ?>px
                <?php echo $args->lifterlms_boxshadow_blur_lesson_preview; ?>px
                <?php echo $args->lifterlms_boxshadow_spread_lesson_preview; ?>px
    <?php echo $args->lifterlms_boxshadow_color_lesson_preview; ?>;
        padding-top: <?php echo $args->lifterlms_padding_top_lesson_preview; ?>px;
        padding-bottom: <?php echo $args->lifterlms_padding_bottom_lesson_preview; ?>px;
        padding-right: <?php echo $args->lifterlms_padding_right_lesson_preview; ?>px;
        padding-left: <?php echo $args->lifterlms_padding_left_lesson_preview; ?>px;
        min-height: 0;
        border-radius: <?php echo $args->lifterlms_border_radius_lesson_preview; ?>px;
    }

    .llms-lesson-preview a.llms-lesson-link:hover {
        background: <?php echo $args->lifterlms_background_color_lesson_preview_hover; ?>;
        border: <?php echo $args->lifterlms_border_width_lesson_preview_hover; ?>px
        solid
    <?php echo $args->lifterlms_border_color_lesson_preview_hover; ?>;
    }

    .llms-lesson-preview a.llms-lesson-link-locked {
        background: <?php echo $args->lifterlms_background_color_lesson_preview_disabled; ?>;
    }

    .llms-lesson-preview a.llms-lesson-link-locked:hover {
        background: <?php echo $args->lifterlms_background_color_lesson_preview_disabled_hover; ?>;
    }

    /**
     * incomplete / default state
     */
    .llms-widget-syllabus .llms-lesson-complete,
    .llms-lesson-preview.is-incomplete .llms-lesson-complete {
        color: <?php echo $args->lifterlms_background_color_lesson_complete_placeholder; ?>;
    }

    .llms-widget-syllabus .llms-lesson-complete.done,
    .llms-lesson-preview.is-complete .llms-lesson-complete,
    .llms-widget-syllabus .lesson-complete-placeholder.done {
        color: <?php echo $args->lifterlms_background_color_lesson_complete; ?>;
    }

    .llms-lesson-preview .llms-icon-free {
        background-color: <?php echo $args->lifterlms_background_color_lesson_complete_placeholder; ?>;
    }

    .llms-lesson-preview .llms-lesson-complete {
        position: relative;
        font-size: <?php echo $args->lifterlms_font_size_lesson_complete; ?>px;
        border-right: <?php echo $args->lifterlms_right_border_width_lesson_complete; ?>px
        solid
    <?php echo $args->lifterlms_right_border_color_lesson_complete; ?>;
        border-left: <?php echo $args->lifterlms_left_border_width_lesson_complete; ?>px
        solid
    <?php echo $args->lifterlms_left_border_color_lesson_complete; ?>;
        margin-top: <?php echo $args->margin_top_lesson_preview_complete; ?>px;
        margin-bottom: <?php echo $args->margin_bottom_lesson_preview_complete; ?>px;
        margin-right: <?php echo $args->margin_right_lesson_preview_complete; ?>px;
        margin-left: <?php echo $args->margin_left_lesson_preview_complete; ?>px;
        padding-top: <?php echo $args->padding_top_lesson_preview_complete; ?>px;
        padding-bottom: <?php echo $args->padding_bottom_lesson_preview_complete; ?>px;
        padding-right: <?php echo $args->padding_right_lesson_preview_complete; ?>px;
        padding-left: <?php echo $args->padding_left_lesson_preview_complete; ?>px;
    }

    .llms-progress .llms-progress-bar {
        background-color: <?php echo $args->lifterlms_background_color_course_progress; ?>;
    }

    .llms-progress .progress-bar-complete {
        background-color: <?php echo $args->lifterlms_background_color_course_progress_completed; ?>;
    }

    .llms-lesson-preview .llms-lesson-title {
        margin-top: <?php echo $args->margin_top_lesson_preview_title; ?>px;
        margin-bottom: <?php echo $args->margin_bottom_lesson_preview_title; ?>px;
        margin-right: <?php echo $args->margin_right_lesson_preview_title; ?>px;
        margin-left: <?php echo $args->margin_left_lesson_preview_title; ?>px;
        font-size: <?php echo $args->lifterlms_font_size_lesson_preview_title; ?>px;
        color: <?php echo $args->lifterlms_font_color_lesson_preview_title; ?>;
    }

    .llms-lesson-preview .llms-lesson-counter {
        font-size: <?php echo $args->lifterlms_font_size_lesson_preview_count; ?>px;
        color: <?php echo $args->lifterlms_font_color_lesson_preview_count; ?>;
    <?php if ($args->lifterlms_hide_lesson_count_lesson_preview === 'yes') : ?>
        display: none;
    <?php endif; ?>
    }

    .llms-lesson-preview .llms-lesson-excerpt {
        font-size: <?php echo $args->lifterlms_font_size_lesson_preview_excerpt; ?>px;
        color: <?php echo $args->lifterlms_font_color_lesson_preview_excerpt; ?>;
        margin-bottom: <?php echo $args->lifterlms_margin_bottom_lesson_preview_excerpt; ?>px;
    }

    .llms-sd-nav {
        text-align: <?php echo $args->lifterlms_text_alignment_account_sub_nav; ?>;
        margin-top: <?php echo $args->lifterlms_margin_top_account_sub_nav; ?>px;
        margin-bottom: <?php echo $args->lifterlms_margin_bottom_account_sub_nav; ?>px;
        margin-right: <?php echo $args->lifterlms_margin_right_account_sub_nav; ?>px;
        margin-left: <?php echo $args->lifterlms_margin_left_account_sub_nav; ?>px;
        padding-top: <?php echo $args->lifterlms_padding_top_account_sub_nav ; ?>px;
        padding-bottom: <?php echo $args->lifterlms_padding_bottom_account_sub_nav; ?>px;
        padding-right: <?php echo $args->lifterlms_padding_right_account_sub_nav; ?>px;
        padding-left: <?php echo $args->lifterlms_padding_left_account_sub_nav; ?>px;
        font-size: <?php echo $args->lifterlms_font_size_account_sub_nav; ?>px;
        border: <?php echo $args->lifterlms_border_width_account_sub_nav; ?>px solid <?php echo $args->lifterlms_border_color_sub_nav; ?>;
        border-radius: <?php echo $args->lifterlms_border_radius_account_sub_nav; ?>px;
    }

    .llms-sd-nav .llms-sd-item {
        display: inline-block;
        float: none;
    }

    .llms-sd-nav .llms-sd-item a,
    .llms-sd-nav .llms-sd-item .llms-sep {
        color: <?php echo $args->lifterlms_font_color_sub_nav; ?>;
        font-size: <?php echo $args->lifterlms_font_size_account_sub_nav; ?>px;
    }

    .llms-my-courses>h3,  .llms-my-certificates>h3, .llms-my-achievements>h3, .llms-my-memberships>h3{
        font-size: <?php echo $args->lifterlms_font_size_account_tile_title; ?>px;
        color: <?php echo $args->lifterlms_font_color_account_tile_title; ?>;
        margin-top: <?php echo $args->lifterlms_margin_top_account_tile_title; ?>px;
        margin-bottom: <?php echo $args->lifterlms_margin_bottom_account_tile_title; ?>px;
        margin-right: <?php echo $args->lifterlms_margin_right_account_tile_title; ?>px;
        margin-left: <?php echo $args->lifterlms_margin_left_account_tile_title; ?>px;
        padding-top: <?php echo $args->lifterlms_padding_top_account_tile_title; ?>px;
        padding-bottom: <?php echo $args->lifterlms_padding_bottom_account_tile_title; ?>px;
        padding-right: <?php echo $args->lifterlms_padding_right_account_tile_title; ?>px;
        padding-left: <?php echo $args->lifterlms_padding_left_account_tile_title; ?>px;
        text-align: <?php echo $args->lifterlms_text_alignment_account_tile_title; ?>
    }

    .llms-my-courses, .llms-my-certificates, .llms-my-achievements, .llms-my-memberships {
        background: <?php echo $args->lifterlms_background_color_account_tile; ?>;
        margin-top: <?php echo $args->lifterlms_margin_top_account_tile; ?>px;
        margin-bottom: <?php echo $args->lifterlms_margin_bottom_account_tile; ?>px;
        margin-right: <?php echo $args->lifterlms_margin_right_account_tile; ?>px;
        margin-left: <?php echo $args-> lifterlms_margin_left_account_tile; ?>px;
        padding-top: <?php echo $args->lifterlms_padding_top_account_tile; ?>px;
        padding-bottom: <?php echo $args->lifterlms_padding_bottom_account_tile; ?>px;
        padding-right: <?php echo $args->lifterlms_padding_right_account_tile; ?>px;
        padding-left: <?php echo $args->lifterlms_padding_left_account_tile; ?>px;
        border: <?php echo $args->lifterlms_border_width_account_tile; ?>px
        solid
    <?php echo $args->lifterlms_border_color_tile; ?>;
        border-radius: <?php echo $args->lifterlms_border_radius_account_tile; ?>px;
    }

    .llms-my-courses ul.listing-courses li.course-item {
        margin-top: <?php echo $args->lifterlms_margin_top_account_course_item; ?>px;
        margin-bottom: <?php echo $args->lifterlms_margin_bottom_account_course_item; ?>px;
        margin-right: <?php echo $args->lifterlms_margin_right_account_course_item; ?>px;
        margin-left: <?php echo $args->lifterlms_margin_left_account_course_item; ?>px;
        padding-top: <?php echo $args->lifterlms_padding_top_account_course_item; ?>px;
        padding-bottom: <?php echo $args->lifterlms_padding_bottom_account_course_item; ?>px;
        padding-right: <?php echo $args->lifterlms_padding_right_account_course_item; ?>px;
        padding-left: <?php echo $args->lifterlms_padding_left_account_course_item; ?>px;
        border: <?php echo $args->lifterlms_border_width_account_course_item; ?>px
        solid
    <?php echo $args->lifterlms_border_color_account_course_item; ?>;
        border-radius: <?php echo $args->lifterlms_border_radius_account_course_item; ?>px;
        box-shadow:
            <?php echo $args->lifterlms_boxshadow_offset_x_course_item; ?>px
                <?php echo $args->lifterlms_boxshadow_offset_y_course_item; ?>px
                <?php echo $args->lifterlms_boxshadow_blur_course_item; ?>px
                <?php echo $args->lifterlms_boxshadow_spread_course_item; ?>px
    <?php echo $args->lifterlms_boxshadow_color_course_item; ?>;
    }

    .llms-my-courses ul.listing-courses li.course-item .course .course-image {
        margin-top: <?php echo $args->lifterlms_margin_top_account_course_image; ?>px;
        margin-bottom: <?php echo $args->lifterlms_margin_bottom_account_course_image; ?>px;
        margin-right: <?php echo $args->lifterlms_margin_right_account_course_image; ?>px;
        margin-left: <?php echo $args->lifterlms_margin_left_account_course_image; ?>px;
        padding-top: <?php echo $args->lifterlms_padding_top_account_course_image; ?>px;
        padding-bottom: <?php echo $args->lifterlms_padding_bottom_account_course_image; ?>px;
        padding-right: <?php echo $args->lifterlms_padding_right_account_course_image; ?>px;
        padding-left: <?php echo $args->lifterlms_padding_left_account_course_image; ?>px;
        border: <?php echo $args->lifterlms_border_width_account_course_image; ?>px
        solid
    <?php echo $args->lifterlms_border_color_account_course_image; ?>;
        border-top-left-radius: <?php echo $args->lifterlms_border_radius_top_left_account_course_image; ?>px;
        border-top-right-radius: <?php echo $args->lifterlms_border_radius_top_right_account_course_image; ?>px;
        border-bottom-left-radius: <?php echo $args->lifterlms_border_radius_bottom_left_account_course_image; ?>px;
        border-bottom-right-radius: <?php echo $args->lifterlms_border_radius_bottom_right_account_course_image; ?>px;
    }

    .llms-my-courses .llms-image-thumb {
    <?php if ($args->lifterlms_auto_width_account_course_image === 'yes') : ?>
        width: auto;
    <?php else: ?>
        width: <?php echo $args->lifterlms_width_account_course_image; ?>px;
    <?php endif; ?>
    }

    .llms-my-courses .llms-sts-enrollment, .llms-my-courses .llms-sts-enrollment .llms-sts-current {
        font-size: <?php echo $args->lifterlms_font_size_account_course_enrollment_status; ?>px;
    }

    .llms-my-courses .llms-start-date {
        font-size: <?php echo $args->lifterlms_font_size_account_course_start_date; ?>px;
    }

    .llms-my-courses .course-item .course h3 a {
        font-size: <?php echo $args->lifterlms_font_size_account_course_title; ?>px;
    }

    .llms-my-courses .author {
        font-size: <?php echo $args->lifterlms_font_size_account_course_author; ?>px;
    }

    <?php if ( is_llms_account_page() && 'yes' === $args->side_by_side_login_registration ): ?>
        @media screen and ( min-width: 600px ) {
            .lifterlms { *zoom: 1; }
            .lifterlms:before,
            .lifterlms:after { content: ""; display: table; }
            .lifterlms:after { clear: both; }

            .lifterlms .llms-person-login-form-wrapper,
            .lifterlms .llms-new-person-form-wrapper {
                float: left;
                padding-right: 20px;
                width: 50%;
            }
        }
    <?php endif; ?>


   .llms-checkout-section {
        border: <?php echo $args->lifterlms_border_width_checkout_form; ?>px solid <?php echo $args->lifterlms_border_color_checkout_form; ?>;
    }

    .llms-checkout-section {
        border-top-left-radius: <?php echo $args->lifterlms_border_radius_top_left_checkout_form; ?>px;
        border-top-right-radius: <?php echo $args->lifterlms_border_radius_top_right_checkout_form; ?>px;
        border-bottom-left-radius: <?php echo $args->lifterlms_border_radius_bottom_left_checkout_form; ?>px;
        border-bottom-right-radius: <?php echo $args->lifterlms_border_radius_bottom_right_checkout_form; ?>px;
    }

    .llms-checkout-section .llms-form-heading {
        color: <?php echo $args->lifterlms_font_color_checkout_form_title; ?>;
        background: <?php echo $args->lifterlms_background_color_checkout_form_title; ?>;
        font-size: <?php echo $args->lifterlms_font_size_checkout_title; ?>px;
    }


    .llms-access-plan .llms-access-plan-content,
    .llms-access-plan .llms-access-plan-footer {
        background: <?php echo $args->access_plan_bg_color; ?>;
        color: <?php echo $args->access_plan_text_color; ?>;
    }

    .llms-access-plan .llms-access-plan-title {
        background: <?php echo $args->access_plan_title_bg_color; ?>;
        color: <?php echo $args->access_plan_title_text_color; ?>;
        font-size: <?php echo $args->access_plan_title_text_size; ?>px;
    }

    .llms-access-plan .llms-access-plan-price {
        color: <?php echo $args->access_plan_price_text_color; ?>;
        font-size: <?php echo $args->access_plan_price_text_size; ?>px;
    }

    .llms-access-plan .llms-access-plan-footer .llms-button-action {
        background: <?php echo $args->access_plan_button_bg_color; ?>;
        border-color: <?php echo $args->access_plan_button_border_color; ?>;
        color: <?php echo $args->access_plan_button_font_color; ?>;
    }

    .llms-access-plan.featured .llms-access-plan-featured {
        background: <?php echo $args->access_plan_featured_bg_color; ?>;
        color: <?php echo $args->access_plan_featured_text_color; ?>;
    }

    .llms-access-plan.featured .llms-access-plan-content,
    .llms-access-plan.featured .llms-access-plan-footer {
        border-left: <?php echo $args->access_plan_featured_border_size; ?>px solid <?php echo $args->access_plan_featured_border_color; ?>;
        border-right: <?php echo $args->access_plan_featured_border_size; ?>px solid <?php echo $args->access_plan_featured_border_color; ?>;
    }

    .llms-access-plan.featured .llms-access-plan-footer {
        border-bottom-color: <?php echo $args->access_plan_featured_border_color; ?>;
    }

    .llms-access-plan-footer {
        border-bottom: <?php echo $args->access_plan_featured_border_size; ?>px solid <?php echo $args->access_plan_bg_color; ?>;
    }

    .llms-access-plan .stamp {
        background: <?php echo $args->access_plan_stamp_bg_color; ?>;
        color: <?php echo $args->access_plan_stamp_text_color; ?>;
    }

    .llms-access-plan .llms-access-plan-footer .llms-button-action:hover {
        background: <?php echo $args->access_plan_button_hover_bg_color; ?>;
        border-color: <?php echo $args->access_plan_button_hover_border_color; ?>;
        color: <?php echo $args->access_plan_button_hover_font_color; ?>;
    }

    .llms-instructor-info .llms-instructors .llms-author {
        border-top-color: <?php echo $args->border_color_instructors; ?>;
    }

    .llms-instructor-info .llms-instructors .llms-author .avatar {
        background: <?php echo $args->border_color_instructors; ?>;
        border-color: <?php echo $args->border_color_instructors; ?>;
    }

    .llms-instructor-info .llms-instructors .llms-author .llms-author-info.name {
        color: <?php echo $args->font_color_instructor_name; ?>;
        font-size: <?php echo $args->font_size_instructor_name; ?>px;
    }

    .llms-instructor-info .llms-instructors .llms-author .llms-author-info.label {
        color: <?php echo $args->font_color_instructor_label; ?>;
        font-size: <?php echo $args->font_size_instructor_label; ?>px;
    }
    <?php endif; ?>


</style>
