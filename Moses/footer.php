<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content
 * after.  Calls sidebar-footer.php for bottom widgets.
 *
 * @package WordPress
 * @subpackage Moses Theme by Church Themer
 * @since Moses Theme by Church Themer 3.0
 */
 
global $homevar;
?>

<?php if ($homevar != 1) {?>
		<div id="section_supplemental"> 
					<div class="news_strip"> 
                    		 <?php
							 $args = array( 'post_type' => 'sermons',
							 'showposts' => 1);
							 $the__events_query = new WP_Query($args);	
							 global $post;
							 $sermonposts = get_posts($args);
							 foreach($sermonposts as $post) : ?>
 						<?php error_log("ENTERED latest sermon code in footer"); ?> 
						<p>Latest Sermon: <?php the_title(); ?> - <?php the_time('F j, Y'); ?></p> 
						<a href="<?php echo get_bloginfo('template_url');?>/includes/mp3.php?file=<?php echo get_post_meta($post->ID, 'sermonfile', true); ?>&fname=<?php echo get_the_title(); ?>" id="downloadlatestsermon">Download Latest Sermon</a> 
						<?php endforeach; ?>
						<div class="hr"><hr /></div> 
					</div> 
		</div> 

<?php } ?>
                    
                    
                    

<div id="footer"> 
					
					<div id="supplemental_details"> 
						<p class="links"><strong>Follow Us:</strong> 
                        	<!-- Twitter Button -->
							<?php $twitter = reverse_escape(get_option('cap_twitter_username')); ?>
							<?php  if($twitter != "Your Twitter Username" && $twitter != ""){?>
                          				  <a href="http://twitter.com/<?php echo($twitter); ?>" class="twitter">Twitter</a> 
							<?php } ?>
							<!-- Facebook Button -->
							<?php $facebook = reverse_escape(get_option('cap_facebook_url')); ?>
							<?php  if($facebook != "Your Facebook URL" && $facebook != ""){?>
                          				  <a href="<?php echo($facebook); ?>" class="facebook">Facebook</a> 
							<?php } ?>
							<!-- YouTube Button -->
							<?php $youtube = reverse_escape(get_option('cap_youtube_url')); ?>
							<?php  if($youtube != "Your YouTube URL" && $youtube != ""){?>
                          				  <a href="<?php echo($youtube); ?>" class="youtube">YouTube</a> 
							<?php } ?>
                            <!-- Vimeo Button -->
							<?php $vimeo = reverse_escape(get_option('cap_vimeo_url')); ?>
							<?php  if($vimeo != "Your Vimeo URL" && $vimeo != ""){?>
                          				  <a href="<?php echo($vimeo); ?>" class="vimeo">Vimeo</a> 
							<?php } ?>
                            <!-- Pinterest Button -->
							<?php $pinterest = reverse_escape(get_option('cap_pinterest_url')); ?>
							<?php  if($pinterest != "Your Pinterest URL" && $pinterest != ""){?>
                          				  <a href="<?php echo($pinterest); ?>" class="pinterest">Pinterest</a> 
							<?php } ?>
							
							<!-- Facebook Button -->
							<?php $feedburner = reverse_escape(get_option('cap_feedburner')); ?>
							<?php  if($feedburner != "Your Feedburner URL" && $feedburner != ""){?>
                          				  <a href="<?php echo($feedburner); ?>" class="emailupdates">Email Updates</a> 
							<?php } ?>
						</p> 
						
						<div id="search"> 
							<form role="search" method="get" id="searchform" action="<?php bloginfo('url'); ?>"> 
							<fieldset> 
								<p class="text_field"> <input type="text" name="s" id="s" value="Search" /> </p> 
								<input type="submit" id="searchsubmit" value="submit" /> 
							</fieldset> 
							</form> 
						</div> 
					</div> 
					
					<div id="site_map"> 
						<p class="address_hours"> 
						<strong><?php bloginfo('name'); ?></strong><br /> 
						<?php  echo(stripslashes(reverse_escape(get_option('cap_address')))); ?><br /> 
						<?php  echo(stripslashes(reverse_escape(get_option('cap_phone_number')))); ?><br /> 
						<strong>Synagogue Office Hours</strong><br /> 
						<?php  echo(stripslashes(reverse_escape(get_option('cap_office_hours')))); ?><br />
						</p> 
						
						
						 
							<?php wp_nav_menu( array( 'container' => "", 'menu_class' => "", 'menu_id' => "", 'theme_location' => 'footer_row1' ) ); ?>
                            <?php wp_nav_menu( array( 'container' => "", 'menu_class' => "", 'menu_id' => "", 'theme_location' => 'footer_row2' ) ); ?>
                            <?php wp_nav_menu( array( 'container' => "", 'menu_class' => "", 'menu_id' => "", 'theme_location' => 'footer_row3' ) ); ?>
                            <?php wp_nav_menu( array( 'container' => "", 'menu_class' => "", 'menu_id' => "", 'theme_location' => 'footer_row4' ) ); ?>


	        <!-- Footer with jewish org logos and image map for linking Norm N. July 2015 -->	
       

<MAP NAME="map1"> 
<AREA
   HREF="http://www.uscj.org/default.aspx" ALT="UCSJ" TITLE="UCSJ" TARGET="_blank"
   SHAPE=RECT COORDS="8,6,122,84">
<AREA
   HREF="https://fjmc.org/" ALT="FJMC" TITLE="FJMC"  TARGET="_blank"
   SHAPE=RECT COORDS="130,6,253,80">
<AREA
   HREF="http://wlcj.org/" ALT="WomensLeague" TITLE="WomensLeague"  TARGET="_blank"
   SHAPE=RECT COORDS="270,8,361,87">
<AREA
   HREF="http://www.usy.org" ALT="USY" TITLE="United Synagogue Youth"  TARGET="_blank"
   SHAPE=RECT COORDS="377,7,504,847">
<AREA
   HREF="http://www.keshetonline.org/" ALT="Keshet" TITLE="Keshet"  TARGET="_blank"
   SHAPE=RECT COORDS="515,8,627,85">
</MAP>

	         <div class="footerflag1" >
                <?php $surl=get_option("siteurl"); $simg="/wp-content/uploads/2015/07/All5Logos.png";?>
                <img src="<?php echo $surl;echo $simg;?>" alt="jewish org  logos" usemap="#map1"  style="align:right;width:645px;height:90px;">				
		</div>				
						
	        <!-- END LOGO BANNER FOOTER CODE -->
					
					<div class="hr"><hr /></div> 
					</div> 
					
					<div id="legal"> 
						<p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All Rights Reserved.</p> 
						<a href="http://www.mintthemes.com" id="churchthemer">Moses Theme by Church Themer</a> 
						
						<div class="hr"><hr /></div> 
					</div> 
				
				</div> 
			
			
			
			</div> <!-- end #page --> 
		</div> 
	</div> 


<?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */

	wp_footer();
?>
</body>
</html>
