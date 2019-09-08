<tr valign="top" class="<?php echo esc_attr($wrapper_class); ?>">
    <th>
        <label for="<?php echo esc_attr($id); ?>"><?php echo esc_html($title); ?></label>
        <?php //echo $tooltip; ?>
    </th>
    <td class="forminp forminp-<?php echo sanitize_title($type) ?>">
        <?php wp_editor( $option_value, esc_attr($id), $settings ); ?>
        <span class="launchpad-field-desc"><?php echo $desc; ?></span>
    </td>
</tr>
