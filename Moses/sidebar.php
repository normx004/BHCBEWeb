<?php
/**
 * The Sidebar containing the primary and secondary widget areas.
 *
 * @package WordPress
 * @subpackage Moses Theme by Church Themer
 * @since Moses Theme by Church Themer 3.0
 */
?>
	<div class="aside"> 
						
<?php
	/* When we call the dynamic_sidebar() function, it'll spit out
	 * the widgets for that widget area. If it instead returns false,
	 * then the sidebar simply doesn't exist, so we'll hard-code in
	 * some default sidebar stuff just in case.
	 */
	 ?>
	<ul>
    <?php
	if ( ! dynamic_sidebar( 'primary-widget-area' ) ) : ?>
	
			
				<li class="widget-container">
							
                            <h3>Search:</h3> 
							<div id="search_widget"> 
							<form role="search" method="get" id="searchform" action="<?php bloginfo('url'); ?>"> 
							<fieldset> 
								<p class="text_field"> <input type="text" name="s" id="s" value="Search" /> </p> 
								<input type="submit" id="searchsubmit" value="submit" /> 
							</fieldset> 
							</form> 
							</div> 
				</li>	      
           

		<?php endif; // end primary widget area ?>
	</ul>	

<?php
	// A second sidebar for widgets, just because.
	if ( is_active_sidebar( 'secondary-widget-area' ) ) : ?>

			<ul class="xoxo">
				<?php dynamic_sidebar( 'secondary-widget-area' ); ?>
			</ul>

<?php endif; ?>

		
	</div> <!-- end of aside -->