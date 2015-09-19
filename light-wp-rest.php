<?php
/**
 * Plugin Name: Light WP REST API
 * Plugin URI: http://amitsn.com
 * Description: This plugin adds basic light-weight JSON based REST API to your WordPress blog.
 * Version: 1.0.0
 * Author: Amit S Namboothiry
 * Author URI: http://amitsn.com
 * License: GPL2
 */

/**
 * Version number for our API.
 *
 */
define( 'LIGHT_REST_API_VERSION', '0.1' );

add_action( 'init', 'wordpress_rest_init' );
function wordpress_rest_init() {
    add_rewrite_rule( '^restify/posts/([0-9]+)?', 'index.php?wprestasn_api=1&post_id=$matches[1]', 'top' );
    add_rewrite_rule( '^restify/posts/?', 'index.php?wprestasn_api=1', 'top' );

    //Determine if Rewrite rules need to be flushed
    $version = get_option( 'light_json_api_version', null );

    if ( empty( $version ) ||  $version !== LIGHT_REST_API_VERSION ) {
        flush_rewrite_rules();
        update_option( 'light_json_api_version', JSON_API_VERSION );
    }
}

add_filter( 'query_vars', 'wordpress_rest_query_vars' );
function wordpress_rest_query_vars( $query_vars ) {
    $query_vars[] = 'wprestasn_api';
    $query_vars[] = 'post_id';
    return $query_vars;
}

add_action( 'parse_request', 'wordpress_rest_parse_request' );
function wordpress_rest_parse_request( &$wp ) {
    if (array_key_exists( 'wprestasn_api', $wp->query_vars)) {
        if(array_key_exists( 'post_id', $wp->query_vars)) {
            include 'get-post.php';
        } else {
            include 'get-all-posts.php';
        }
        exit();
    }
    return;
}

include 'admin-settings.php';
