# Light WP Rest API

As the name suggests, this is a very basic JSON based REST API for your WordPress website.
For now, it supports only GET operation.

##Features
- Lightweight and simple.
- Admin Dashboard to customize which fields of posts to expose and posts per page.
- More coming soon!

##Usage
- Download and activate the plugin.
- Hit `www.yoursite.com/restify/posts` to get JSON of all posts.
- Paginated JSON. Eg) Hit `www.yoursite.com/restify/posts?page=2` for second page of posts.
- Hit `www.yoursite.com/restify/post/<ID>` to get JSON of a single post.
- All fields you get in the JSON response is customizable through the WordPress Dashboard.
