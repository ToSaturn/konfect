<?php
use LaunchPad\Metaboxes\Layout;
?>
                        </div>
                    </div>
                    <?php do_action('launchpad_after_content'); ?>
                </div>
            </div>
        </div>
     </div>
      <div id="wrap-footer" class="wrap-footer">
        <?php if ( apply_filters( 'launchpad_show_footer_widgets', ( 'yes' !== Layout::get_setting( 'launchpad_hide_page_footer_widgets', 'no' ) ) ) ) : ?>
          <footer id="colophon" class="site-footer">
              <div class="container">
                  <div class="row">
                      <?php do_action('launchpad_before_footer'); ?>
                  </div>
                  <div class="row">
                      <?php wp_nav_menu( array( 'theme_location' => 'footer', 'menu_id' => 'menu-footer', 'menu_class' => 'menu-inline' ) ); ?>
                  </div>
              </div>
          </footer>
        <?php endif; ?>

        <div class="site-info">
          <div class="container">
              <div class="row">
                  <div class="copyright_bar_left columns six">
                      <?php echo get_option('launchpad_settings_text_site_info_left'); ?>
                  </div>
                  <div class="copyright_bar_right columns six">
                      <?php echo get_option('launchpad_settings_text_site_info_right'); ?>
                  </div>
              </div>
          </div>
        </div>

      </div>
    </div>
    <?php if ( 'yes' === get_option( 'launchpad_settings_custom_js_wrapper' ) ) : ?>
      <script type="text/javascript">(function($){<?php echo html_entity_decode( get_option('launchpad_settings_custom_footer_js') ); ?>})(jQuery);</script>
    <?php else: ?>
      <?php echo html_entity_decode( get_option('launchpad_settings_custom_footer_js') ); ?>
    <?php endif; ?>
    <?php wp_footer(); ?>
  </body>
</html>
