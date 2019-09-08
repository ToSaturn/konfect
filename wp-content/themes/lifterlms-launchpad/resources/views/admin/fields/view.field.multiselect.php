<tr valign="top" class="<?php echo esc_attr($wrapper_class); ?>">
    <th>
        <label for="<?php echo esc_attr($id); ?>"><?php echo esc_html($title); ?></label>
        <?php //echo $tooltip; ?>
    </th>
    <td class="forminp forminp-<?php echo sanitize_title($type) ?>">

        <select
            name="<?php echo esc_attr($id); ?>[]"
            id="<?php echo esc_attr($id); ?>"
            style="<?php echo esc_attr($css); ?>"
            class="launchpad-field <?php echo esc_attr($class); ?>"
            <?php echo implode(' ', $custom_attributes); ?>
            multiple="multiple">

                <?php foreach ( $options as $key => $val ) : ?>

                    <option value="<?php echo esc_attr($key); ?>"

                        <?php selected(in_array($key, $option_value), true); ?>>

                    <?php echo $val ?></option>
                <?php endforeach; ?>
        </select>
        <span class="launchpad-field-desc"><?php echo $desc; ?></span>
    </td>
</tr>