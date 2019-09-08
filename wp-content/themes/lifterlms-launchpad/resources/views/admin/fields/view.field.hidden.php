<tr valign="top" class="<?php echo esc_attr($wrapper_class); ?>">
    <th>
        <label for="<?php echo esc_attr($id); ?>"><?php echo esc_html($title); ?></label>
        <?php //echo $tooltip; ?>
    </th>
    <td class="forminp forminp-<?php echo sanitize_title($type) ?>">
        <input
            name="<?php echo esc_attr($id); ?>"
            id="<?php echo esc_attr($id); ?>"
            type="<?php echo esc_attr($type); ?>"
            value="<?php echo esc_attr($option_value); ?>"
            <?php echo implode(' ', $custom_attributes); ?>
            /> <?php echo $desc; ?>
    </td>
</tr>
