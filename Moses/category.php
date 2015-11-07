<?php
/**
 * The template for displaying Category Archive pages.
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
					
					<h1 class="two_col"><?php echo single_cat_title( '', false ); ?></h1> 
					
                    <?php
					$category_description = category_description();
					if ( ! empty( $category_description ) )
						echo '' . $category_description . '';

				
					?>
                
					<div class="hr"><hr /></div> 
					
					<div id="nav_sub">                         
                        <?php get_sidebar(); ?>
					</div> 
                    
                   <div class="page_content full"> 
                   <table id="bloglist"> 
							<thead> 
								<tr> 
									<th scope="col" class="posted_on">Posted On</th> 
									<th scope="col" class="title">Title</th> 
									<th scope="col" class="excerpt">Excerpt</th> 
									<th scope="col" class="replys">Replies</th> 
								</tr> 
							</thead> 
							<tbody> 
					<?php 
					$args = array('paged' => $paged, 'cat' => get_query_var('cat'));
					query_posts($args);	
					if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
                                <tr> 
                                        <td class="posted_on"><?php the_time('F j, Y'); ?></td> 
                                        <td class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></td> 
                                        <td class="excerpt"><?php echo (strip_tags(trim(get_the_excerpt()))); ?></td> 
                                        <td class="replys"><?php comments_number('0','1','%'); ?></td> 
                                </tr> 
                    <?php endwhile; // end of the loop. ?>
                    
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