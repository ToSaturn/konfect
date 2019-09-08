<tr valign="top" class="<?php echo esc_attr($wrapper_class); ?>">
    <th>
        <label for="<?php echo esc_attr($id); ?>"><?php echo esc_html($title); ?></label>
        <?php //echo $tooltip; ?>
    </th>
    <td class="forminp forminp-<?php echo sanitize_title($type) ?> <?php echo esc_attr($wrapper_class); ?>">

        <fieldset>
            <ul>
                <?php foreach ((array)$options as $key => $val ) : ?>
                    <li>
                        <label><input
                                name="<?php echo esc_attr($id); ?>"
                                value="<?php echo $key; ?>"
                                type="<?php echo $type; ?>"
                                style="<?php echo esc_attr($css); ?>"
                                class="<?php echo esc_attr($class); ?>"
                                <?php echo implode( ' ', $custom_attributes ); ?>
                                <?php checked($key, $option_value); ?>
                                /> <?php echo $val ?></label>
                    </li>
                <?php endforeach; ?>
            </ul>
        </fieldset>
        <span class="launchpad-field-desc"><?php echo $desc; ?></span>
    </td>
</tr>