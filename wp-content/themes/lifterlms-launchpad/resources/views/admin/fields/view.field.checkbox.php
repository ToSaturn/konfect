<?php
if ( ! isset($checkboxgroup) || $checkboxgroup === 'start') : ?>

    <tr valign="top" class="<?php echo esc_attr($wrapper_class); ?>">

        <th>
            <?php echo esc_html($title) ?>
        </th>

        <td class="forminp forminp-<?php echo sanitize_title($type) ?>">
            <fieldset class="<?php echo esc_attr(implode( ' ', $visibility_class)); ?>">

<?php else : ?>

    <fieldset class="<?php echo esc_attr(implode( ' ', $visibility_class)); ?>">

<?php endif; ?>

<?php if (isset($title)) : ?>

    <legend class="screen-reader-text"><span><?php echo esc_html($title) ?></span></legend>

<?php endif; ?>

<label for="<?php echo esc_attr($id); ?>">
    <input
        name="<?php echo esc_attr($id); ?>"
        id="<?php echo esc_attr($id); ?>"
        type="<?php echo esc_attr($type); ?>"
        value="1"
        <?php checked($option_value, 'yes'); ?>
        <?php echo implode(' ', $custom_attributes); ?>/>
    <?php echo $desc ?>
</label>

<?php if ( ! isset($checkboxgroup) || $checkboxgroup === 'end') : ?>

            </fieldset>
        </td>
    </tr>

<?php else : ?>

    </fieldset>

<?php endif; ?>
