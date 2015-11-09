<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Moses Theme by Church Themer
 * @since Moses Theme by Church Themer 3.0
 */

get_header(); ?>


				

					<!-- Page --> 
	
	<div id="page_wrapper_outer"> 
		<div id="page_wrapper"> 
			<div id="page"> 
				
				<div id="section_main" class="inner_page"> 
					
					<h1 class="two_col"><?php the_title(); ?></h1> 
					
					<div class="hr"><hr /></div> 
					
					<div id="nav_sub">                         
                        <?php get_sidebar(); ?>
					</div> 
					
                    <div class="page_content full"> 
						
                      
					   
						<?php if (have_posts()) : ?>
						<?php while (have_posts()) : the_post(); ?>
						  
					
						 <?php
						//get the post thumbnail for this post
						$image_id = get_post_thumbnail_id();  
						$image_url = wp_get_attachment_image_src($image_id,'full');  
						$image_url = $image_url[0];  
						if ($image_url != ""){
						?>
						<img src="<?php bloginfo( 'template_directory' ); ?>/thumb.php?src=<?php if (is_multisite()){echo get_current_site(1)->path; echo str_replace(get_blog_option($blog_id,'fileupload_url'),get_blog_option($blog_id,'upload_path'),$image_url); }else{ echo $image_url;}?>&h=210&w=700&zc=1" width="700" height="210" alt="image" />
						<?php } ?>  
                    
					
					<div class="article_content"> 
						<?php the_content(); ?>
                    </div>
                 
              
                  <table id="bloglist">
							<thead>
								<tr>
									<th scope="col" class="title">Event Date</th> 
									<th scope="col" class="title">Title</th> 
									<th scope="col" class="excerpt">Location</th> 
									<th scope="col" class="replys">Map</th> 
								</tr>
							</thead>
							<tbody>
								 <tr> 
                                        <td class="posted_on"><?php the_time('M j, Y'); ?> - <?php the_time(); ?></td> 
                                        <td class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></td> 
                                        <td class="excerpt"><?php echo get_post_meta($post->ID, 'address', true);  ?></td>
                                        <td class="replys"><a href="<?php echo get_post_meta($post->ID, 'map', true); ?>">View</a></td> 
                                </tr> 
								
					
								
								
								

							</tbody>
						</table>
 					<?php endwhile; // end of the loop. ?>
                    <?php endif; ?>
                   </div> <!-- end .page_content --> 
					
                    
				
					
					<div class="hr"><hr /></div> 
					
						
					
				</div> <!-- end #section_main --> 
           
<?php get_footer(); ?>