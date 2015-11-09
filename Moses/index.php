<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query. 
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Moses Theme by Church Themer
 * @since Moses Theme by Church Themer 1.0
 */

get_header(); 
//image directory
$imagedir = get_bloginfo( 'template_url' );
?>

<?php error_log("ENTERED index.php in Moses theme directory"); ?>
<?php $multisite=false; ?>
<!-- Page --> 
	
	<div id="page_wrapper_outer"> 
		<div id="page_wrapper"> 
			<div id="page"> 
				
				<div id="section_main"> 
					
					<div class="scrollable">   
					   
				   
	<?php
							// array of 6 sliders for the homepage
							
 $ptrx = array(1,2,3,4,5,6);						

 $ok = is_readable('sliderorder');

 if ($ok) {
    $ptrx = file ( 'sliderorder' , FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
 }

  // clean up comment lines (lines that start with '#')
  $ptry = array (1,2,3,4,5,6);
  $ix = 0;
  $iy = 0;
  $size = count($ptrx);
//  echo ("size of ptrx is $size\n");
  while ($ix < 6 && $iy < ($size+1)) {
  	$val = substr($ptrx[$iy],0,1);
 // 	echo ("when iy = $iy, Val is $val\n");
  	if (strcmp($val,"#") != 0) {
  		 $ptry[$ix] = $ptrx[$iy];
  		 $ix += 1;
  //		 echo ("ix=$ix, iy=$iy ptry[ix] = $ptry[$ix]\n");
  	} else {
  //		echo ("comment:  $ptrx[$iy]\n");
  	}
  	$iy += 1;
  }
  $ptrx = $ptry;
  //echo ("ptrx is at end  $ptrx[0] $ptrx[1] $ptrx[2] $ptrx[3] $ptrx[4] $ptrx[5] \n");
  

  // there is probably a more elegant way to do this.... 
  $csti1="cap_slider_title" . $ptrx[0];
  $cste1="cap_slider_text"  . $ptrx[0];
  $csi1 ="cap_slider_image" . $ptrx[0];
  $csl1 ="cap_slider_link"  . $ptrx[0];
  
  $csti2="cap_slider_title" . $ptrx[1];
  $cste2="cap_slider_text"  . $ptrx[1];
  $csi2 ="cap_slider_image" . $ptrx[1];
  $csl2 ="cap_slider_link"  . $ptrx[1];
  
  $csti3="cap_slider_title" . $ptrx[2];
  $cste3="cap_slider_text"  . $ptrx[2];
  $csi3 ="cap_slider_image" . $ptrx[2];
  $csl3 ="cap_slider_link"  . $ptrx[2];

  
  $csti4="cap_slider_title" . $ptrx[3];
  $cste4="cap_slider_text"  . $ptrx[3];
  $csi4 ="cap_slider_image" . $ptrx[3];
  $csl4 ="cap_slider_link"  . $ptrx[3];
  
  $csti5="cap_slider_title" . $ptrx[4];
  $cste5="cap_slider_text"  . $ptrx[4];
  $csi5 ="cap_slider_image" . $ptrx[4];
  $csl5 ="cap_slider_link"  . $ptrx[4];
  
  $csti6="cap_slider_title" . $ptrx[5];
  $cste6="cap_slider_text"  . $ptrx[5];
  $csi6 ="cap_slider_image" . $ptrx[5];
  $csl6 ="cap_slider_link"  . $ptrx[5];
  
  $sliders = array(
                                                                'first' => array(
                                                                        'title' => reverse_escape(get_option($csti1)),
                                                                        'text' => reverse_escape(get_option($cste1)),
                                                                        'image' => reverse_escape(get_option($csi1)),
                                                                        'link' => reverse_escape(get_option($csl1))
                                                                ),
                                                                'second' => array(
                                                                        'title' => reverse_escape(get_option($csti2)),
                                                                        'text' => reverse_escape(get_option($cste2)),
                                                                        'image' => reverse_escape(get_option($csi2)),
                                                                        'link' => reverse_escape(get_option($csl2))
                                                                ),
                                                                'third' => array(
                                                                        'title' => reverse_escape(get_option($csti3)),
                                                                        'text' => reverse_escape(get_option($cste3)),
                                                                        'image' => reverse_escape(get_option($csi3)),
                                                                        'link' => reverse_escape(get_option($csl3))
                                                                ),
                                                                'fourth' => array(
                                                                        'title' => reverse_escape(get_option($csti4)),
                                                                        'text' => reverse_escape(get_option($cste4)),
                                                                        'image' => reverse_escape(get_option($csi4)),
                                                                       'link' => reverse_escape(get_option($csl4))
                                                                ),
                                                                'fifth' => array(
                                                                        'title' => reverse_escape(get_option($csti5)),
                                                                        'text' => reverse_escape(get_option($cste5)),
                                                                        'image' => reverse_escape(get_option($csi5)),
                                                                       'link' => reverse_escape(get_option($csl5))
                                                                ),
                                                                'sixth' => array(
                                                                        'title' => reverse_escape(get_option($csti6)),
                                                                        'text' => reverse_escape(get_option($cste6)),
                                                                        'image' => reverse_escape(get_option($csi6)),
                                                                       'link' => reverse_escape(get_option($csl6))
                                                                ) 
 );
							?>
											   
													<!-- root element for the items --> 
													<div class="items"> 
							
							<?php
							// loop through all the sliders, only rendering if there's an image

							if ($sliders['first']['image'] == '1st URL' || $sliders['first']['image'] == ''){?>
									<div class="item"> 
                                    <div class="text"> 
                                        <h1>Oops no image entered</h1> 
                                        <p>Enter an image in the back-end</p> 
                                    </div> 
                                    <img src="<?php echo bloginfo( 'template_directory' )?>/images/no-image.jpg" alt="<?php echo $num; ?>" /> 
                                	</div> 
                            <?php } else {
							foreach($sliders as $num => $slider) {
								if(!strstr($slider['image'], ' URL')) {
							?>
							
														<div class="item"> 
                                                        <?php if ($slider['title'] != "Image Title"){if ($slider['title'] != ""){ ?>
															<div class="text"> 
																<h1><?php  echo($slider['title']); ?></h1> 
																<p><?php  echo($slider['text']); ?></p> 
															</div> 
                                                            <?php } }?>
															<?php if(!strstr($slider['link'], ' URL')){ ?><a href="<?php echo $slider['link']; ?>"><?php } ?><img src="<?php bloginfo( 'template_directory' ); ?>/thumb.php?src=<?php if ($multisite == true){echo get_current_site(1)->path; echo str_replace(get_blog_option($blog_id,'fileupload_url'),get_blog_option($blog_id,'upload_path'),$slider['image']); }else{ echo $slider['image'];}?>&h=340&w=940&zc=1" alt="<?php echo $num; ?>" /><?php if(!strstr($slider['link'], ' URL')){ ?></a><?php } ?>
														</div> 
							
							
							<?php
								// end image check for sliders
								}
							// end loop through sliders
							} 
							}?>
						</div> 
					</div> 
					
					<div class="navi_wrap">				
						<div class="navi"></div> 
					</div> 
					
					<div class="hr"><hr /></div> 
					
					
					<div class="highlights"> 
						
						<?php if (get_option('cap_home_image1') != "First Image"){if (get_option('cap_home_image1') != ""){ ?>
                         <a href="<?php  echo(stripslashes(reverse_escape(get_option('cap_home_image1_link')))); ?>" class="highlight first"> 
							<img src="<?php bloginfo( 'template_directory' ); ?>/thumb.php?src=<?php if ($multisite == true){echo get_current_site(1)->path; echo str_replace(get_blog_option($blog_id,'fileupload_url'),get_blog_option($blog_id,'upload_path'),reverse_escape(get_option('cap_home_image1'))); }else{ echo reverse_escape(get_option('cap_home_image1'));}?>&h=140&w=300&zc=1" alt="sub_front1" /> 
						</a> 
                        <?php if (get_option('cap_home_image1_text') != "Image Text"){if (get_option('cap_home_image1_text') != ""){?><a href="<?php  echo(stripslashes(reverse_escape(get_option('cap_home_image1_link')))); ?>" ><h2 class="first-h2"><?php  echo(stripslashes(reverse_escape(get_option('cap_home_image1_text')))); ?></h2></a>
						<?php } } } }?>
						
						<?php if (get_option('cap_home_image2') != "Second Image"){if (get_option('cap_home_image2') != ""){ ?>
                       	<a href="<?php  echo(stripslashes(reverse_escape(get_option('cap_home_image2_link')))); ?>" class="highlight"> 
							<img src="<?php if (reverse_escape(get_option('cap_home_image2')) == "Image URL"){ echo (bloginfo( 'template_directory' ) . '/images/no-image-small.jpg"'); }else { bloginfo( 'template_directory' ); ?>/thumb.php?src=<?php if ($multisite == true){echo get_current_site(1)->path; echo str_replace(get_blog_option($blog_id,'fileupload_url'),get_blog_option($blog_id,'upload_path'),reverse_escape(get_option('cap_home_image2'))); }else{ echo reverse_escape(get_option('cap_home_image2'));}}?>&h=140&w=300&zc=1" alt="sub_front2" /> 
						</a> 
                        <?php if (get_option('cap_home_image2_text') != "Image Text"){if (get_option('cap_home_image2_text') != ""){?><a href="<?php  echo(stripslashes(reverse_escape(get_option('cap_home_image2_link')))); ?>" ><h2 class="second-h2"><?php  echo(stripslashes(reverse_escape(get_option('cap_home_image2_text')))); ?></h2></a>
                        <?php } } } }?>
						
						
						<?php if (get_option('cap_home_image3') != "Third Image"){if (get_option('cap_home_image3') != ""){ ?>
                        <a href="<?php  echo(stripslashes(reverse_escape(get_option('cap_home_image3_link')))); ?>" class="highlight"> 
							<img src="<?php if (reverse_escape(get_option('cap_home_image3')) == "Image URL"){ echo (bloginfo( 'template_directory' ) . '/images/no-image-small.jpg"'); }else { bloginfo( 'template_directory' ); ?>/thumb.php?src=<?php if ($multisite == true){echo get_current_site(1)->path; echo str_replace(get_blog_option($blog_id,'fileupload_url'),get_blog_option($blog_id,'upload_path'),reverse_escape(get_option('cap_home_image3'))); }else{ echo reverse_escape(get_option('cap_home_image3'));}}?>&h=140&w=300&zc=1" alt="sub_front3" /> 
						</a> 
                        <?php if (get_option('cap_home_image3_text') != "Image Text"){if (get_option('cap_home_image3_text') != ""){?>
                        <a href="<?php  echo(stripslashes(reverse_escape(get_option('cap_home_image3_link')))); ?>" > <h2 class="third-h2"><?php  echo(stripslashes(reverse_escape(get_option('cap_home_image3_text')))); ?></h2></a>
                        <?php } } } } ?>
					</div> 
					
					<div class="hr"><hr /></div> 
						
					
				</div> <!-- end #section_main --> 
				<div id="section_supplemental"> 
					<div class="news_strip"> 
              <?php


         $surl = get_option("siteurl");
				 $args = array( 'post_type' => 'cpt_sermons','showposts' => 1);
				 $the__events_query = new WP_Query($args);	
				 global $post;
				 $sermonposts = get_posts($args);

				 foreach($sermonposts as $post) : ?>
		         	                 <?php
                                       $whoWrote = get_post_meta($post->ID, 'sermonauthor', true);
                                       $result = preg_replace( "/ucke/", "xxxx", $whoWrote);
                                       if ( strcmp($whoWrote, $result)) {
                                            $who="Tucker";
                                       } else {
                                         $result = preg_replace("/ohen/", "xxxx", $whoWrote);
                                         if (strcmp($whoWrote, $result)) {
                                             $who="Cohen";
                                          } else {
                                            $who = "who"; 
                                          }
                                         }
                                         if (!strcmp($who, "Tucker")) {
                                              $simg="/wp-content/uploads/2013/07/RTuckerPortrait.jpg";
                                            } else {
                                              if (!strcmp( $who, "Cohen")) {
                                                  $simg="/wp-content/uploads/2013/05/bulliten-photo.jpg";
                                               } else {
                                                $simg="/wp-content/uploads/2013/05/Sanc1a1-150x150.png";
                                               }
                                         }
                                       ?>

                                      <img class=alignleft width="76" height="115"  src="<?php echo $surl;echo $simg;?>" > 
				      <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                 
				  	by <?php echo get_post_meta($post->ID, 'sermonauthor', true); ?>
				     <h3 class="news_strip"><?php echo (strip_tags(trim(get_the_excerpt() ) ) ); ?>
							 
				   
					    
                                     <br><br>			   
	                             <a href="<?php echo get_permalink(get_page_by_title("sermons")); ?>">View the sermon archive.</a>
                                  &nbsp; &nbsp; &nbsp;
                                     <a href="<?php echo get_permalink(get_page_by_title("erev shabbat messages")); ?>">View the collected Erev Shabbat messages.</a>
				  </p> 
		       	          <a href="<?php if (get_option("cap_mp3_php") == "true"){?>
				  <?php echo get_template_directory_uri();?>/includes/mp3.php?file=
				  <?php echo get_post_meta($post->ID, 'sermonmp3', true); ?>
			      		&fname=
			       		<?php echo get_the_title(); ?>
			       		<?php } else { echo get_post_meta($post->ID, 'sermonmp3', true); } ?>
			        		" target="_blank" id="downloadlatestsermon">Download Latest Sermon</a> 
			     <?php endforeach; ?>


			<div class="hr"><hr /></div> 
			</div> 
					
					
					<div class="module left"> 
						<div class="header"> 
							<h2>Upcoming Events</h2> 
							<a href="<?php bloginfo( 'url' ); ?>/events" class="viewall">View All</a> 
						</div> 
						<div class="content"> 
							<ul> 
                            <?php
							   $args = array( 'post_type' => 'cpt_events',
							   'post_status' => 'future',
							   'showposts' => 6,
							   'order' => 'ASC');
							   $the__events_query = new WP_Query($args);	
							
                           
                             global $post;
							 $eventsposts = get_posts($args);
							 foreach($eventsposts as $post) : ?>
								<li><h3><?php the_time('M j, Y'); ?> - <?php the_title(); ?> <small><?php the_time(); ?></small></h3> <a href="<?php the_permalink(); ?>" class="viewmore">View More</a></li> 
							<?php endforeach; ?>

							</ul> 
						
						</div> 
					</div> 
					
					<div class="module right"> 
						<div class="header"> 
							<h2>In Our Community</h2> 
							<a href="<?php bloginfo( 'url' ); ?>/news" class="readall">Read All</a> 
						</div> 
						<div class="content"> 
							<ul> 
                           <?php 
						     $args = array( 'post_type' => 'cpt_news',
							   'showposts' => 6);
							   $the__news_query = new WP_Query($args);	
							
                           
                             global $post;
							 $newsposts = get_posts($args);
							 foreach($newsposts as $post) : ?>
								<li> 
									<h3><?php the_title();?><small> posted on <?php the_time('F j, Y'); ?></small></h3> 
									<a href="<?php the_permalink(); ?>" class="readmore">Read More</a> 
								</li> 
								
 							<?php endforeach; ?>
							</ul> 
						
						</div> 
					</div> 
					
					
				</div> 
			
<?php //get_sidebar(); ?>
<?php get_footer(); ?>
