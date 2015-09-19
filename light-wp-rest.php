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
 * @var string
 */
define( 'LIGHT_REST_API_VERSION', '0.1' );

add_action( 'init', 'wordpress_rest_init' );
function wordpress_rest_init() {
    add_rewrite_rule( '^restify/posts?', 'index.php?wprestasn_api=1', 'top' );

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
    return $query_vars;
}

add_action( 'parse_request', 'wordpress_rest_parse_request' );
function wordpress_rest_parse_request( &$wp ) {
    if ( array_key_exists( 'wprestasn_api', $wp->query_vars ) ) {
        include 'get-all-posts.php';
        exit();
    }
    return;
}


//Add Admin dashboard
add_action('admin_menu', 'wordpress_rest_plugin_settings');
function wordpress_rest_plugin_settings() {
    add_menu_page('Light WP Rest Settings', 'Light WP Rest Settings', 'administrator', 'wordpress_rest_plugin_settings', 'wordpress_rest_display_settings');
}

function wordpress_rest_display_settings() {
    $lightwprest_posts_fields = (get_option('lightwprest_posts_fields') != '') ? get_option('lightwprest_posts_fields') : '[]';
    $lightwprest_posts_per_page = (get_option('lightwprest_posts_per_page') != '') ? get_option('lightwprest_posts_per_page') : '10';
    $html = '
        </pre>
            <div class="wrap"><form action="options.php" method="post" name="options">
                <h2>Light WP Rest Settings</h2>
                ' . wp_nonce_field('update-options') . '
                <hr /><br />
                <div class="postbox">
                <div style="padding: 0 15px;">
                <table class="form-table" width="100%" cellpadding="10">
                    <tbody>
                        <tr>
                            <th scope="row">
                                <label>Fields in All Posts JSON</label>
                            </th>

                            <td>
                                <input type="checkbox" name="lightwprest_posts_fields[]" value="id" '.(in_array("id", $lightwprest_posts_fields)?'checked="checked"':'').'/>ID<br />
                                <input type="checkbox" name="lightwprest_posts_fields[]" value="title" '.(in_array("title", $lightwprest_posts_fields)?'checked="checked"':'').'/>Title<br />
                                <input type="checkbox" name="lightwprest_posts_fields[]" value="status" '.(in_array("status", $lightwprest_posts_fields)?'checked="checked"':'').'/>Status<br />
                                <input type="checkbox" name="lightwprest_posts_fields[]" value="type" '.(in_array("type", $lightwprest_posts_fields)?'checked="checked"':'').'/>Type<br />
                                <input type="checkbox" name="lightwprest_posts_fields[]" value="author" '.(in_array("author", $lightwprest_posts_fields)?'checked="checked"':'').'/>Author<br />
                                <input type="checkbox" name="lightwprest_posts_fields[]" value="content" '.(in_array("content", $lightwprest_posts_fields)?'checked="checked"':'').'/>Content<br />
                                <input type="checkbox" name="lightwprest_posts_fields[]" value="featuredimg" '.(in_array("featuredimg", $lightwprest_posts_fields)?'checked="checked"':'').'/>Featured Image<br />
                                <input type="checkbox" name="lightwprest_posts_fields[]" value="parent" '.(in_array("parent", $lightwprest_posts_fields)?'checked="checked"':'').'/>Parent<br />
                                <input type="checkbox" name="lightwprest_posts_fields[]" value="link" '.(in_array("link", $lightwprest_posts_fields)?'checked="checked"':'').'/>Link<br />
                            </td>
                        </tr>

                        <tr>
                            <th scope="row">
                                <label>Posts per Page</label>
                            </th>

                            <td>
                                <input type="number" name="lightwprest_posts_per_page" value="'.$lightwprest_posts_per_page.'"/>
                            </td>
                        </tr>
                    </tbody>
                </table>
                </div>
                </div>
 
                <input type="hidden" name="action" value="update" />

                <input type="hidden" name="page_options" value="lightwprest_posts_fields,lightwprest_posts_per_page" />

                <input type="submit" name="Submit" value="Update" class="button-primary" id="submitbutton" /></form></div>
        <pre>
    ';

    echo $html;

}