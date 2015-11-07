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
	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
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
              
				<?php $xml = (get_bloginfo('wpurl') . "/QUESTIONfeed=audioANDpid=" . $post->ID); ?>
                
                <script type="text/javascript">
                <!--
                function sermonPopup<?php echo $post->ID; ?>() {
                window.open( "<?php echo get_template_directory_uri();?>/includes/sermon-popup/?mp3=<?php echo get_post_meta($post->ID, 'sermonmp3', true) ?>&ogg=<?php echo get_post_meta($post->ID, 'sermonogg', true)?>&title=<?php echo get_the_title(); ?>", "myWindow", 
                "status = 1, height = 116, width = 422, resizable = 0" )
                }
                //-->
                </script>
                
                  <table id="bloglist">
							<thead>
								<tr>
									<th scope="col" class="posted_on">Date Posted</th> 
									<th scope="col" class="excerpt">Title</th> 
									<th scope="col" class="replys">Listen</th> 
									<th scope="col" class="replys">Download</th> 
								</tr>
							</thead>
							<tbody>
								 <tr> 
                                        <td class="posted_on"><?php the_time('M j, Y'); ?></td> 
                                        <td class="excerpt"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></td> 
                                        <td class="replys"><a onClick="sermonPopup<?php echo $post->ID; ?>()" href="">Listen</a></td> 
                                        <td class="replys"><a href="<?php if (get_option("cap_mp3_php") == "true"){?><?php echo get_template_directory_uri();?>/includes/mp3.php?file=<?php echo get_post_meta($post->ID, 'sermonmp3', true); ?>&fname=<?php echo get_the_title(); ?><?php } else { echo get_post_meta($post->ID, 'sermonmp3', true); } ?>" target="_blank">Download</a></td> 
                                </tr> 
								
					
								
								
								

							</tbody>
						</table>

                   </div> <!-- end .page_content --> 
					
				
					
					<div class="hr"><hr /></div> 
					
						
					
				</div> <!-- end #section_main --> 
           <?php endwhile; // end of the loop. ?>
<?php get_footer(); ?>