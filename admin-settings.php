<?php

/**
 * Create Admin Dashboard page for customizing settings
 * 
 */

add_action('admin_menu', 'wordpress_rest_plugin_settings');
function wordpress_rest_plugin_settings() {
    add_menu_page('Light WP Rest Settings', 'Light WP Rest Settings', 'administrator', 'wordpress_rest_plugin_settings', 'wordpress_rest_display_settings');
}

function wordpress_rest_display_settings() {
    $lightwprest_posts_fields = (get_option('lightwprest_posts_fields') != '') ? get_option('lightwprest_posts_fields') : array();
    $lightwprest_posts_per_page = (get_option('lightwprest_posts_per_page') != '') ? get_option('lightwprest_posts_per_page') : '10';
    $lightwprest_single_post_fields = (get_option('lightwprest_single_post_fields') != '') ? get_option('lightwprest_single_post_fields') : array();
    $html = '
        </pre>
            <div class="wrap"><form action="options.php" method="post" name="options">
                <h2>Light WP Rest Settings</h2>
                ' . wp_nonce_field('update-options') . '
                <hr />
                <h3>All Posts JSON</h3>
                <p class="description" style="margin-top: -0.5em; margin-bottom: 1em;">Results you see when you hit /restify/posts/</p>
                <div class="postbox">
                <div style="padding: 0 15px;">
                <table class="form-table" width="100%" cellpadding="10">
                    <tbody>
                        <tr>
                            <th scope="row">
                                <label>Fields</label>
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

                <hr />

                <h3>Single Post JSON</h3>
                <p class="description" style="margin-top: -0.5em; margin-bottom: 1em;">Results you see when you hit /restify/posts/[id]</p>
                <div class="postbox">
                <div style="padding: 0 15px;">
                <table class="form-table" width="100%" cellpadding="10">
                    <tbody>
                        <tr>
                            <th scope="row">
                                <label>Fields</label>
                            </th>

                            <td>
                                <input type="checkbox" name="lightwprest_single_post_fields[]" value="id" '.(in_array("id", $lightwprest_single_post_fields)?'checked="checked"':'').'/>ID<br />
                                <input type="checkbox" name="lightwprest_single_post_fields[]" value="title" '.(in_array("title", $lightwprest_single_post_fields)?'checked="checked"':'').'/>Title<br />
                                <input type="checkbox" name="lightwprest_single_post_fields[]" value="status" '.(in_array("status", $lightwprest_single_post_fields)?'checked="checked"':'').'/>Status<br />
                                <input type="checkbox" name="lightwprest_single_post_fields[]" value="type" '.(in_array("type", $lightwprest_single_post_fields)?'checked="checked"':'').'/>Type<br />
                                <input type="checkbox" name="lightwprest_single_post_fields[]" value="author" '.(in_array("author", $lightwprest_single_post_fields)?'checked="checked"':'').'/>Author<br />
                                <input type="checkbox" name="lightwprest_single_post_fields[]" value="content" '.(in_array("content", $lightwprest_single_post_fields)?'checked="checked"':'').'/>Content<br />
                                <input type="checkbox" name="lightwprest_single_post_fields[]" value="featuredimg" '.(in_array("featuredimg", $lightwprest_single_post_fields)?'checked="checked"':'').'/>Featured Image<br />
                                <input type="checkbox" name="lightwprest_single_post_fields[]" value="parent" '.(in_array("parent", $lightwprest_single_post_fields)?'checked="checked"':'').'/>Parent<br />
                                <input type="checkbox" name="lightwprest_single_post_fields[]" value="link" '.(in_array("link", $lightwprest_single_post_fields)?'checked="checked"':'').'/>Link<br />
                            </td>
                        </tr>
                    </tbody>
                </table>
                </div>
                </div>
 
                <input type="hidden" name="action" value="update" />

                <input type="hidden" name="page_options" value="lightwprest_posts_fields,lightwprest_posts_per_page,lightwprest_single_post_fields" />

                <input type="submit" name="Submit" value="Update" class="button-primary" id="submitbutton" /></form></div>
        <pre>
    ';

    echo $html;
}

?>