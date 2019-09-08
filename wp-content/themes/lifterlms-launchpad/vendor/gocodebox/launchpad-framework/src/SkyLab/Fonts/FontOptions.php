<?php

namespace SkyLab\Fonts;

/**
 * Font Options
 *
 * @package SkyLab
 * @author codeBOX
 * @since 0.0.1
 */
class FontOptions
{
    /**
     * Get font options
     * Combines the OS fonts with the google fonts from the the webfonts.json file
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @return array
     */
    public function get_font_options()
    {
        $typography_mixed_fonts = array_merge(
            $this->get_os_fonts(),
            $this->get_google_fonts()
        );
        asort($typography_mixed_fonts);

        return $typography_mixed_fonts;
    }

    /**
     * Get OS Fonts
     * Returns an array of operating system fonts accessible to all major browsers
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @return array
     */
    private function get_os_fonts() {

        $os_faces = apply_filters(
            'launchpad_font_options', [
                'Arial, sans-serif' => 'Arial',
                '"Avant Garde", sans-serif' => 'Avant Garde',
                'Cambria, Georgia, serif' => 'Cambria',
                'Copse, sans-serif' => 'Copse',
                'Garamond, "Hoefler Text", Times New Roman, Times, serif' => 'Garamond',
                'Georgia, serif' => 'Georgia',
                '"Helvetica Neue", Helvetica, sans-serif' => 'Helvetica Neue',
                'Tahoma, Geneva, sans-serif' => 'Tahoma'
            ]
        );

        return $os_faces;
    }

    /**
     * Get Google Fonts
     * Returns an array of Google Fonts
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @return array
     */
    private function get_google_fonts()
    {
        $google_faces = [];

        include realpath(dirname(__FILE__)) . '/webfonts.php';

        if ($webfonts)
        {
            foreach ($webfonts['items'] as $font)
            {
                $google_faces['google_' . $font['family'] . ', ' . $font['category']] = $font['family'];
            }

        }

        return $google_faces;
    }
}