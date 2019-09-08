<tr valign="top" class="<?php echo esc_attr($wrapper_class); ?>">
    <th>
        <label for="<?php echo esc_attr($id); ?>"><?php echo esc_html($title); ?></label>
        <?php //echo $tooltip; ?>
    </th>
    <td class="forminp forminp-<?php echo sanitize_title($type) ?>">
        <input type="hidden"
               id="<?php echo esc_attr($id); ?>"
               class="<?php echo esc_attr($class); ?>"
               name="<?php echo esc_attr($id); ?>"
               value="<?php echo esc_attr($option_value); ?>"
               <?php echo implode(' ', $custom_attributes); ?>
            />
        <input id="<?php echo $id; ?>_upload"
               type="button"
               class="button image-upload-button <?php echo esc_attr($class); ?>"
               name="<?php echo esc_attr($id); ?>_upload"
               value="<?php echo
                    apply_filters(
                        esc_attr($id).'_button_value',
                        sprintf('Upload %s',
                            esc_html($title)
                    ), 'launchpad'); ?>"
               />

        <div id="<?php echo $id; ?>_preview" class="launchpad-image-preview">
            <img style="max-width:100%;" src="<?php echo esc_attr($option_value); ?>" />
            <a href="#"
               id="<?php echo $id; ?>_remove"
               class="launchpad-image-remove-button <?php echo esc_attr($remove_button_visibility_class); ?>">
                <i class="fa fa-times"></i>
            </a>
        </div>
        <span class="launchpad-field-desc"><?php echo $desc; ?></span>
    </td>
</tr>
