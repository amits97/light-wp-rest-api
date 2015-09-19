<?php

    /**
     * Fetch a specific post.
     * 
     */
    $post_id = ($wp->query_vars['post_id'])?intval($wp->query_vars['post_id']):'';
	$post_query = new WP_Query();
	$posts_list = $post_query->query(array(
            'p'   =>  $post_id
		));
	$response = '';

	//Fetch Plugin Options
    $lightwprest_single_post_fields = (get_option('lightwprest_single_post_fields') != '')?get_option('lightwprest_single_post_fields'):'[]';
	$show_id = in_array("id", $lightwprest_single_post_fields)?true:false;
	$show_title = in_array("title", $lightwprest_single_post_fields)?true:false;
	$show_status = in_array("status", $lightwprest_single_post_fields)?true:false;
	$show_type = in_array("type", $lightwprest_single_post_fields)?true:false;
	$show_author = in_array("author", $lightwprest_single_post_fields)?true:false;
	$show_content = in_array("content", $lightwprest_single_post_fields)?true:false;
	$show_featured_image = in_array("featuredimg", $lightwprest_single_post_fields)?true:false;
	$show_parent = in_array("parent", $lightwprest_single_post_fields)?true:false;
	$show_link = in_array("link", $lightwprest_single_post_fields)?true:false;

	foreach ($posts_list as $post) {
		$post = get_object_vars($post);
		$post_obj = get_post($post['ID']);

		$GLOBALS['post'] = $post_obj;
		setup_postdata($post_obj);
        
        $post_fields = array();
		
		// prepare common post fields
		if($show_id) {
			$post_fields['id'] = $post['ID'];
		}
		if($show_title) {
			$post_fields['title'] = get_the_title($post['ID']);
		}
		if($show_status) {
			$post_fields['status'] = $post['post_status'];
		}
		if($show_type) {
			$post_fields['type'] = $post['post_type'];
		}
		if($show_author) {
			$post_fields['author'] = (int) $post['post_author'];
		}
		if($show_content) {
			$post_fields['content'] = apply_filters('the_content', $post['post_content']);
		}
		if($show_featured_image) {
			$post_fields['featured_image'] = wp_get_attachment_url(get_post_thumbnail_id($post->ID, 'thumbnail'));
		}
		if($show_parent) {
			$post_fields['parent'] = (int) $post['post_parent'];
		}
		if($show_link) {
			$post_fields['link'] = get_permalink($post['ID']);
		}

		$response = $post_fields;
	}
	
	header('Content-Type: application/json');
	echo json_encode($response);
?>