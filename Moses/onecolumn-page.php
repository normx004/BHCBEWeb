<?php
/**
 * Template Name: Full Width
 *
 * A custom page template.
 *
 * The "Template Name:" bit above allows this to be selectable
 * from a dropdown menu on the edit page screen.
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
					
					<h1 class="one_col"><?php the_title(); ?></h1> 
					
					<div class="hr"><hr /></div> 				
					
					<?php if (get_post_meta($post_id, 'image', $single) != ""){?>
						<img src="<?php get_post_meta($post_id, 'image', $single); ?>" alt="content_header" /> 
                     <?php } ?>
                     
                    <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
					<?php the_post_thumbnail('full'); ?>
                    <?php endwhile; // end of the loop. ?>
					
					<div class="page_content one_col"> 
					<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
						
						<?php the_content(); ?>
                        
                  
						<?php comments_template( '', true ); ?>
                    
                    <?php endwhile; // end of the loop. ?>
                   </div> <!-- end .page_content --> 
					
				
					
					<div class="hr"><hr /></div> 
					
						
					
				</div> <!-- end #section_main --> 
           
<?php get_footer(); ?>