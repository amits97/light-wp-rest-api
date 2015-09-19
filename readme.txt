=== Light WP REST API ===
Contributors: amits97
Tags: rest api, json
Requires at least: 4
Tested up to: 4.3
Stable tag: 4.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

As the name suggests, this is a very basic JSON based REST API for your WordPress website. For now, it supports only GET operation.

== Description ==

*   Lightweight and simple.
*   Admin Dashboard to customize which fields of posts to expose and posts per page.
*   More coming soon!

== Installation ==

This section describes how to install the plugin and get it working.

e.g.

1. Upload `plugin-name.php` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Hit `www.yoursite.com/restify/posts` to get JSON of all posts.
1. Paginated JSON. Eg) Hit `www.yoursite.com/restify/posts?page=2` for second page of posts.
1. Hit `www.yoursite.com/restify/posts/<ID>` to get JSON of a single post.
1. All fields you get in the JSON response is customizable through the WordPress Dashboard.

== Frequently Asked Questions == 

== Screenshots ==

1. Admin settings page.

== Changelog ==

= 0.1 =
* Basic GET functionality with customizable Admin dashboard.

== Upgrade Notice ==
