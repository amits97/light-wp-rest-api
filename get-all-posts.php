<?php
	$post_query = new WP_Query();
	$posts_list = $post_query->query();
	$response = array();

	foreach ($posts_list as $post) {
		$post = get_object_vars($post);
		$post_obj = get_post( $post['ID'] );

		$GLOBALS['post'] = $post_obj;
		setup_postdata( $post_obj );

		// prepare common post fields
		$post_fields = array(
			'title'           => get_the_title( $post['ID'] ), // $post['post_title'],
			'status'          => $post['post_status'],
			'type'            => $post['post_type'],
			'author'          => (int) $post['post_author'],
			'content'         => apply_filters( 'the_content', $post['post_content'] ),
			'parent'          => (int) $post['post_parent'],
			'link'            => get_permalink( $post['ID'] ),
		);

		array_push($response, $post_fields);
	}
	
	header('Content-Type: application/json');
	echo json_encode($response);
?>