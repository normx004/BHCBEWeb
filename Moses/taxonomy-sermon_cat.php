<?php
/*
Template Name: Sermons
*/


get_header(); ?>
			

	<!-- Page --> 
	
	<div id="page_wrapper_outer"> 
		<div id="page_wrapper"> 
			<div id="page"> 
				
				<div id="section_main" class="inner_page"> 
					
					<?php 
					$podcast_url = get_page_by_title('Podcast Page - Mint Themes');
					$podcast_url = $podcast_url->guid;
                    $podcast_url = str_replace("http", "itpc", $podcast_url )
                    ?>
					<h1 class="two_col"><?php echo single_cat_title( '', false ); ?> <a href="<?php echo $podcast_url; ?>" class="podcast">Subscribe to Podcast</a></h1>
					
                    <?php
					$category_description = category_description();
					if ( ! empty( $category_description ) )
						echo '' . $category_description . '';

				
					?>
                
					
					
					<div id="nav_sub">                         
                        <?php get_sidebar(); ?>
					</div> 
                    
                   <div class="page_content full"> 
                   <table id="bloglist"> 
							<thead> 
								<tr> 
									<th scope="col" class="posted_on">Date Posted</th> 
									<th scope="col" class="title">Title</th> 
									<th scope="col" class="excerpt">Excerpt</th> 
                                    <th scope="col" class="excerpt">Listen</th> 
									<th scope="col" class="replys">Downloads</th> 
								</tr> 
							</thead> 
							<tbody> 
               
         	   
      	    	<?php if (have_posts()) : ?>
      	      	<?php while (have_posts()) : the_post(); ?>
                               
                <script type="text/javascript">
                <!--
                function sermonPopup<?php echo $post->ID; ?>() {
                window.open( "<?php echo get_template_directory_uri();?>/includes/sermon-popup/?mp3=<?php echo get_post_meta($post->ID, 'sermonmp3', true) ?>&ogg=<?php echo get_post_meta($post->ID, 'sermonogg', true)?>&title=<?php echo get_the_title(); ?>", "myWindow", 
                "status = 1, height = 116, width = 422, resizable = 0" )
                }
                //-->
                </script>
                    
                                <tr> 
                                        <td class="posted_on"><?php the_time('M j, Y'); ?></td> 
                                        <td class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></td> 
                                        <td class="excerpt"><?php echo (strip_tags(trim(get_the_excerpt()))); ?></td>
                                        <td class="excerpt"><a onClick="sermonPopup<?php echo $post->ID; ?>()" href="">Listen</a></td> 
                                        <td class="replys"><a href="<?php if (get_option("cap_mp3_php") == "true"){?><?php echo get_template_directory_uri();?>/includes/mp3.php?file=<?php echo get_post_meta($post->ID, 'sermonmp3', true); ?>&fname=<?php echo get_the_title(); ?><?php } else { echo get_post_meta($post->ID, 'sermonmp3', true); } ?>" target="_blank">Download</a></td> 
                                </tr> 
                    <?php endwhile; // end of the loop. ?>
                    <?php endif; ?>
                    
							</tbody> 
						</table> 
 					<?php if ( $wp_query->max_num_pages > 1 ) : ?>
					<?php 
                    $nextposts = get_next_posts_link( __( '&larr; Older posts', 'faded' ) ); 
                    $prevposts = get_previous_posts_link( __( 'Newer posts &rarr;', 'faded' ) ); 
                    $nextposts = split('"',$nextposts);
                    $prevposts = split('"',$prevposts);
                    ?>
                    <!-- Pagination -->
                        <div class="pagination">
                            <?php if ($prevposts[1]) { ?>
                            <a href="<?php echo $prevposts[1]; ?>" class="prev">Prev</a>
                            <?php } else { ?>
                            <!--show no link-->
                            <?php } 
                            if ($nextposts[1]) { ?>
                            <a href="<?php echo $nextposts[1]; ?>" class="next">Next</a>
                            <?php } else{ ?>
                            <!--show no link-->
                            <?php } ?>
                        </div>
                    
            		<?php endif; ?>
                    
											
											
					</div> <!-- end .page_content.full --> 
                  
				
               
			<div class="hr"><hr /></div> 
					
						
					
				</div> <!-- end #section_main --> 
           
<?php get_footer(); ?>