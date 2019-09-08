<tr valign="top" class="<?php echo esc_attr($wrapper_class); ?>">
    <th>
        <label for="<?php echo esc_attr($id); ?>"><?php echo esc_html($title); ?></label>
        <?php //echo $tooltip; ?>
    </th>
    <td class="forminp forminp-<?php echo sanitize_title($type) ?>">
        <textarea
            name="<?php echo esc_attr($id); ?>"
            id="<?php echo esc_attr($id); ?>"
            style="<?php echo esc_attr($css); ?>"
            class="<?php echo esc_attr($class); ?>"
            <?php echo implode(' ', $custom_attributes); ?>><?php echo esc_attr($option_value); ?></textarea>
            <span class="launchpad-field-desc"><?php echo $desc; ?></span>
    </td>
</tr>


