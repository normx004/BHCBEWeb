<?php 
/**
 * The template for displaying Search Results pages.
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
					
					<h1 class="two_col"><?php printf( __( 'Search Results for: %s', 'twentyten' ), '' . get_search_query() . '' ); ?></h1> 
					
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
                   <?php if ( have_posts() ) : ?>
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
					
                    <?php while ( have_posts() ) : the_post(); ?>
                                <tr> 
                                        <td class="posted_on"><?php the_time('F j, Y'); ?></td> 
                                        <td class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></td> 
                                        <td class="excerpt"<?php the_excerpt(); ?></td> 
                                        <td class="replys"><?php comments_number('0','1','%'); ?></td> 
                                </tr> 
                    <?php endwhile; // end of the loop. ?>
                    <?php else : ?>
					<h2><?php _e( 'Nothing Found', 'twentyten' ); ?></h2>
					<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'twentyten' ); ?></p>
					
					<?php endif; ?>
							</tbody> 
						</table> 
 
											
					</div> <!-- end .page_content.full --> 
                  
				
               
			<div class="hr"><hr /></div> 
					
						
					
				</div> <!-- end #section_main --> 
           
<?php get_footer(); ?>