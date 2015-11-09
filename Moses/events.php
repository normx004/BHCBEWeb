<?php
/*
Template Name: Events
*/


get_header(); ?>
			

	<!-- Page --> 
	
	<div id="page_wrapper_outer"> 
		<div id="page_wrapper"> 
			<div id="page"> 
				
				<div id="section_main" class="inner_page"> 
					
					<h1 class="two_col"><?php the_title(); ?></h1>
					
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
									<th scope="col" class="title">Event Date</th> 
									<th scope="col" class="title">Title</th> 
									<th scope="col" class="excerpt">Location</th> 
									<th scope="col" class="replys">Map</th> 
								</tr> 
							</thead> 
							<tbody> 
                    
                <?php
   				        
				$args = array( 'post_type' => 'cpt_events',
							   'post_status' => 'future',
							   'order' => 'ASC',
							   'showposts' => 50000);
				query_posts($args);		
				?>
         	   
      	    	<?php if (have_posts()) : ?>
      	      	<?php while (have_posts()) : the_post(); ?>
            
                                <tr> 
                                        <td class="posted_on"><?php the_time('M j, Y'); ?> - <?php the_time(); ?></td> 
                                        <td class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></td> 
                                        <td class="excerpt"><?php echo get_post_meta($post->ID, 'address', true);  ?></td>
                                        <td class="replys"><a href="<?php echo get_post_meta($post->ID, 'map', true); ?>">View</a></td> 
                                </tr> 
                    <?php endwhile; // end of the loop. ?>
						
                    <?php endif; ?>
                    
							</tbody> 
						</table> 
 
											
					</div> <!-- end .page_content.full --> 
                  
				
               
			<div class="hr"><hr /></div> 
					
						
					
				</div> <!-- end #section_main --> 
                
           
<?php get_footer(); ?>