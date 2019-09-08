<?php

namespace SkyLab\Http;

/**
 * Abstract Ajax Class
 *
 * @package SkyLab
 * @author codeBOX
 * @since 0.0.1
 */
abstract class AjaxRequest
{
    /**
     * nonce validation argument
     *
     * @var string
     */
    const NONCE = 'launchpad-ajax';

    /**
     * AjaxRequest constructor.
     * Calls Register Method
     *
     * @since 0.0.1
     * @version 0.0.1
     */
    public function __construct()
    {
        $this->register();
    }

    /**
     * Register all methods inside the class
     *
     * @since 0.0.1
     * @version 0.0.1
     */
    public function register()
    {
        $methods = get_class_methods($this);

        foreach ($methods as $method)
        {
            add_action('wp_ajax_' . $method, array($this, 'handle'));
            add_action('wp_ajax_nopriv_' . $method, array($this, 'handle'));
        }

    }

    /**
     * Handles the AJAX request
     * Scrubs the request and prepares the response
     * Sends the response and json if successful
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @return json response via wp_send_json_success
     */
    public function handle()
    {
        // Make sure we are getting a valid AJAX request
        check_ajax_referer(self::NONCE);

        $request = $this->scrub_request($_REQUEST);

        $action = $request['action'];

        $response = $this->$action($request);

        if ($response instanceof WP_Error) {
            $this->send_error($response);
        }

        wp_send_json_success($response);

        die();
    }

    /**
     * Scrub Request
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @param $request
     * @return mixed
     */
    public function scrub_request($request)
    {

        foreach ($request as $key => $value) {

            if (is_array($value)) {
                $request[$key] = $this->scrub_request($value);
            } else {
                $request[$key] = sanitize_text_field($value);
            }

        }

        return $request;
    }

    /**
     * Get the comment text sent by the AJAX request.
     * Uses PHP function filter_var
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @return string
     */
    private function get_comment()
    {
        $comment = '';

        if (isset($_POST['comment'])) {
            $comment = filter_var($_POST['comment'], FILTER_SANITIZE_STRING);
        }

        return $comment;
    }

    /**
     * Get the post ID sent by the AJAX request.
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @return int
     */
    private function get_post_id()
    {
        $post_id = 0;

        if (isset($_POST['post_id'])) {
            $post_id = absint(filter_var($_POST['post_id'], FILTER_SANITIZE_NUMBER_INT));
        }

        return $post_id;
    }

    /**
     * Sends a JSON response with the details of the given error.
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @param WP_Error $error
     */
    private function send_error(WP_Error $error)
    {
        wp_send_json(array(
            'code' => $error->get_error_code(),
            'message' => $error->get_error_message()
        ));
    }
}