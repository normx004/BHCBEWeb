<?php 

//check if this page has been created already
$page = get_page_by_title('Podcast Page - Mint Themes');
if($page->ID == ""){
	// Create podcast page
	  $my_podcast_post = array(
		 'post_title' => 'Podcast Page - Mint Themes',
		 'post_content' => 'Podcast Feed Page.',
		 'post_status' => 'publish',
		 'post_author' => 1,
		 'post_type' => 'page'
	  );
	
	// Insert the page into the database
		$podcast_page_id = wp_insert_post( $my_podcast_post );
		update_post_meta($podcast_page_id, '_wp_page_template', 'mintthemes_podcast_page_template.php'); 
}
