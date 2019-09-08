<tr valign="top" class="<?php echo esc_attr($wrapper_class); ?>">
    <th>
        <label for="<?php echo esc_attr($id); ?>"><?php echo esc_html($title); ?></label>
        <?php //echo $tooltip; ?>
    </th>
    <td class="forminp forminp-<?php echo sanitize_title($type); ?>">

        <input type="text"
               name="<?php echo esc_attr($id); ?>"
               id="<?php echo esc_attr($id); ?>"
               class="color-picker <?php echo esc_attr($css); ?>"
               value="<?php echo esc_attr($option_value); ?>"
                <?php echo implode(' ', $custom_attributes); ?>
                />

        <div id="<?php echo esc_attr($id); ?>_preview"
             style="color: <?php echo esc_attr($option_value); ?>">

            <?php if ( ! isset($preview)) : ?>
                <div class="launchpad-color-preview" style="background: <?php echo esc_attr($option_value); ?>;"></div>
            <?php else: ?>
                <?php echo $preview; ?>
            <?php endif; ?>

        </div>
        <span class="launchpad-field-desc"><?php echo $desc; ?></span>
    </td>
</tr>
