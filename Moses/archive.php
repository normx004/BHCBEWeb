<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
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

<?php
	/* Queue the first post, that way we know
	 * what date we're dealing with (if that is the case).
	 *
	 * We reset this later so we can run the loop
	 * properly with a call to rewind_posts().
	 */
	if ( have_posts() )
		the_post();
?>

			<h1>
<?php if ( is_day() ) : ?>
				<?php printf( __( 'Daily Archives: %s', 'twentyten' ), get_the_date() ); ?>
<?php elseif ( is_month() ) : ?>
				<?php printf( __( 'Monthly Archives: %s', 'twentyten' ), get_the_date('F Y') ); ?>
<?php elseif ( is_year() ) : ?>
				<?php printf( __( 'Yearly Archives: %s', 'twentyten' ), get_the_date('Y') ); ?>
<?php else : ?>
				<?php _e( 'Blog Archives', 'twentyten' ); ?>
<?php endif; ?>
			</h1>

<?php
	/* Since we called the_post() above, we need to
	 * rewind the loop back to the beginning that way
	 * we can run the loop properly, in full.
	 */
	rewind_posts();

	/* Run the loop for the archives page to output the posts.
	 * If you want to overload this in a child theme then include a file
	 * called loop-archives.php and that will be used instead.
	 */
	 ?>
	 <table id="bloglist"> 
							<thead> 
								<tr> 
									<th scope="col" class="posted_on">Posted On</th> 
									<th scope="col" class="title">Title</th> 
									<th scope="col" class="excerpt">Excerpt</th> 
									<th scope="col" class="replys">Replys</th> 
								</tr> 
							</thead> 
							<tbody> 
					<?php 
					$args = array('paged' => $paged);
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