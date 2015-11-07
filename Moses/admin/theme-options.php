<?php

add_action('init','of_options');

if (!function_exists('of_options')) {
function of_options(){
   
// VARIABLES
$themename = get_theme_data(STYLESHEETPATH . '/style.css');
$themename = $themename['Name'];
$shortname = "cap";

// Populate OptionsFramework option in array for use in theme
global $of_options;
$of_options = get_option('of_options');

$GLOBALS['template_path'] = OF_DIRECTORY;

//Access the WordPress Categories via an Array
$of_categories = array(); 
$of_categories_obj = get_categories('hide_empty=0');
foreach ($of_categories_obj as $of_cat) {
    $of_categories[$of_cat->cat_ID] = $of_cat->cat_name;}
$categories_tmp = array_unshift($of_categories, "Select a category:");   

$stylesheet_select = array("minimal.css","grunge.css","greengrunge.css","darkredglossy.css","blueglossy.css");
      
//Access the WordPress Pages via an Array
$of_pages = array();
$of_pages_obj = get_pages('sort_column=post_parent,menu_order');   
foreach ($of_pages_obj as $of_page) {
    $of_pages[$of_page->ID] = $of_page->post_name; }
$of_pages_tmp = array_unshift($of_pages, "Select a page:");      


$podcast_select_1 = array("Arts", "Business", "Comedy", "Education", "Games &amp; Hobbies", "Government &amp; Organizations", "Health", "Kids &amp; Family", "Music", "News &amp; Politics", "Religion &amp; Spirituality", "Science &amp; Medicine", "Society &amp; Culture", "Sports &amp; Recreation", "Technology", "TV &amp; Film");

$podcast_select_2 = array("Design", "Fashion &amp; Beauty", "Food", "Literature", "Performing Arts", "Visual Arts", "Business News", "Careers", "Investing", "Management &amp; Marketing", "Shopping", "Education", "Education Technology", "Higher Education", "K-12", "Language Courses", "Training", "Automotive", "Aviation", "Hobbies", "Other Games", "Video Games", "Local", "National", "Non-Profit", "Regional", "Alternative Health", "Fitness &amp; Nutrition", "Self-Help", "Sexuality", "Buddhism", "Christianity", "Hinduism", "Islam", "Judaism", "Other", "Spirituality", "Medicine", "Natural Sciences", "Social Sciences", "History", "Personal Journals", "Philosophy", "Places &amp; Travel", "Amateur", "College &amp; High School", "Outdoor", "Professional", "Gadgets", "Tech News", "Podcasting", "Software How-To");

// Set the Options Array
$options = array();

$options[] = array( "name" => "General Settings",
                    "type" => "heading");
                   

$options[] = array( "name" => "Custom Logo",
                    "desc" => "Upload a logo for your theme, or specify the image address of your online logo. (http://yoursite.com/logo.png). Size: 320px by 61px",
                    "id" => $shortname."_logo_image",
                    "std" => "Image URL",
                    "type" => "upload");
                   
$url =  OF_DIRECTORY . '../uploads/';

$options[] = array( "name" => "Address",
                    "desc" => "Enter your address.",
                    "id" => $shortname."_address",
                    "std" => "Address",
                    "type" => "text");

$options[] = array( "name" => "Address Link (ie: Google Map)",
                    "desc" => "Enter your address map link.",
                    "id" => $shortname."_address_link",
                    "std" => "Address Link",
                    "type" => "text");

$options[] = array( "name" => "Phone Number",
                    "desc" => "Enter your phone number.",
                    "id" => $shortname."_phone_number",
                    "std" => "Phone Number",
                    "type" => "text");

$options[] = array( "name" => "Office Hours",
                    "desc" => "Enter your office hours.",
                    "id" => $shortname."_office_hours",
                    "std" => "Office Hours",
                    "type" => "text");

$options[] = array( "name" => "Worship Times",
                    "desc" => "Enter your worship times.",
                    "id" => $shortname."_worship_times",
                    "std" => "Worship TImes",
                    "type" => "text");

$options[] = array( "name" => "Custom Favicon",
                    "desc" => "Upload a 16px x 16px Png/Gif image that will represent your website's favicon.",
                    "id" => $shortname."_custom_favicon",
                    "std" => "Favicon",
                    "type" => "upload");
                                              
$options[] = array( "name" => "Tracking Code",
                    "desc" => "Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme.",
                    "id" => $shortname."_google_analytics",
                    "std" => "",
                    "type" => "textarea");  

$options[] = array( "name" => "Use MP3.php?",
                    "desc" => "If you don't know what to do with this, leave it checked.",
                    "id" => "cap_mp3_php",
                    "std" => "true",
                    "type" => "checkbox"); 


//6 home images fader options ---------
   
$options[] = array( "name" => "Home Page Slider",
                    "type" => "heading");

$options[] = array( "name" => "First Slide",
					"desc" => "",
					"std" => "Enter the following information for the first slide on the home page",
					"type" => "info");

$options[] = array( "name" => "First Image Slide",
                    "desc" => "Upload the 1st image for the home page fader. 940px by 340px",
                    "id" => $shortname."_slider_image1",
                    "std" => "1st URL",
                    "type" => "upload");

$options[] = array( "name" => "First Image Title",
                    "desc" => "Enter the image title.",
                    "id" => $shortname."_slider_title1",
                    "std" => "Image Title",
                    "type" => "text");

$options[] = array( "name" => "First Image Description",
                    "desc" => "Enter the image's description",
                    "id" => $shortname."_slider_text1",
                    "std" => "Description",
                    "type" => "text");

$options[] = array( "name" => "First Image url",
                    "desc" => "Enter the url you want this image to go when clicked",
                    "id" => $shortname."_slider_link1",
                    "std" => "Link",
                    "type" => "text");

$options[] = array( "name" => "Second Slide",
					"desc" => "",
					"std" => "Enter the following information for the second slide on the home page",
					"type" => "info");
//
$options[] = array( "name" => "Second Image Slide",
                    "desc" => "Upload the 2nd image for the home page fader. 940px by 340px",
                    "id" => $shortname."_slider_image2",
                    "std" => "2nd URL",
                    "type" => "upload");

$options[] = array( "name" => "Second Image Title",
                    "desc" => "Enter the image title.",
                    "id" => $shortname."_slider_title2",
                    "std" => "Image Title",
                    "type" => "text");

$options[] = array( "name" => "Second Image Description",
                    "desc" => "Enter the image's description",
                    "id" => $shortname."_slider_text2",
                    "std" => "Description",
                    "type" => "text");

$options[] = array( "name" => "Second Image url",
                    "desc" => "Enter the url you want this image to go when clicked",
                    "id" => $shortname."_slider_link2",
                    "std" => "Link",
                    "type" => "text");
//
$options[] = array( "name" => "Third Slide",
					"desc" => "",
					"std" => "Enter the following information for the third slide on the home page",
					"type" => "info");

$options[] = array( "name" => "Third Image Slide",
                    "desc" => "Upload the 3rd image for the home page fader. 940px by 340px",
                    "id" => $shortname."_slider_image3",
                    "std" => "3rd URL",
                    "type" => "upload");

$options[] = array( "name" => "Third Image Title",
                    "desc" => "Enter the image title.",
                    "id" => $shortname."_slider_title3",
                    "std" => "Image Title",
                    "type" => "text");

$options[] = array( "name" => "Third Image Description",
                    "desc" => "Enter the image's description",
                    "id" => $shortname."_slider_text3",
                    "std" => "Description",
                    "type" => "text");

$options[] = array( "name" => "Third Image url",
                    "desc" => "Enter the url you want this image to go when clicked",
                    "id" => $shortname."_slider_link3",
                    "std" => "Link",
                    "type" => "text");
//
$options[] = array( "name" => "Fourth Slide",
					"desc" => "",
					"std" => "Enter the following information for the fourth slide on the home page",
					"type" => "info");

$options[] = array( "name" => "Fourth Image Slide",
                    "desc" => "Upload the 4th image for the home page fader. 940px by 440px",
                    "id" => $shortname."_slider_image4",
                    "std" => "4th URL",
                    "type" => "upload");

$options[] = array( "name" => "Fourth Image Title",
                    "desc" => "Enter the image title.",
                    "id" => $shortname."_slider_title4",
                    "std" => "Image Title",
                    "type" => "text");

$options[] = array( "name" => "Fourth Image Description",
                    "desc" => "Enter the image's description",
                    "id" => $shortname."_slider_text4",
                    "std" => "Description",
                    "type" => "text");

$options[] = array( "name" => "Fourth Image url",
                    "desc" => "Enter the url you want this image to go when clicked",
                    "id" => $shortname."_slider_link4",
                    "std" => "Link",
                    "type" => "text");
//
$options[] = array( "name" => "Fifth Slide",
					"desc" => "",
					"std" => "Enter the following information for the fifth slide on the home page",
					"type" => "info");

$options[] = array( "name" => "Fifth Image Slide",
                    "desc" => "Upload the 5th image for the home page fader. 950px by 550px",
                    "id" => $shortname."_slider_image5",
                    "std" => "5th URL",
                    "type" => "upload");

$options[] = array( "name" => "Fifth Image Title",
                    "desc" => "Enter the image title.",
                    "id" => $shortname."_slider_title5",
                    "std" => "Image Title",
                    "type" => "text");

$options[] = array( "name" => "Fifth Image Description",
                    "desc" => "Enter the image's description",
                    "id" => $shortname."_slider_text5",
                    "std" => "Description",
                    "type" => "text");

$options[] = array( "name" => "Fifth Image url",
                    "desc" => "Enter the url you want this image to go when clicked",
                    "id" => $shortname."_slider_link5",
                    "std" => "Link",
                    "type" => "text");
//
$options[] = array( "name" => "Sixth Slide",
					"desc" => "",
					"std" => "Enter the following information for the sixth slide on the home page",
					"type" => "info");

$options[] = array( "name" => "Sixth Image Slide",
                    "desc" => "Upload the 6th image for the home page fader. 960px by 660px",
                    "id" => $shortname."_slider_image6",
                    "std" => "6th URL",
                    "type" => "upload");

$options[] = array( "name" => "Sixth Image Title",
                    "desc" => "Enter the image title.",
                    "id" => $shortname."_slider_title6",
                    "std" => "Image Title",
                    "type" => "text");

$options[] = array( "name" => "Sixth Image Description",
                    "desc" => "Enter the image's description",
                    "id" => $shortname."_slider_text6",
                    "std" => "Description",
                    "type" => "text");

$options[] = array( "name" => "Sixth Image url",
                    "desc" => "Enter the url you want this image to go when clicked",
                    "id" => $shortname."_slider_link6",
                    "std" => "Link",
                    "type" => "text");


//3 Home Page Images
$options[] = array( "name" => "3 Home Page Images",
                    "type" => "heading");

//
$options[] = array( "name" => "1st Image",
					"desc" => "",
					"std" => "Enter the following information for the first of the 3 images on the home page",
					"type" => "info");

$options[] = array( "name" => "First Image",
                    "desc" => "Upload the 1st image for the home page. 300px by 140px",
                    "id" => $shortname."_home_image1",
                    "std" => "First Image",
                    "type" => "upload");

$options[] = array( "name" => "First Image Title",
                    "desc" => "Enter the test you want to appear on top of the image. ",
                    "id" => $shortname."_home_image1_text",
                    "std" => "Image Text",
                    "type" => "text");

$options[] = array( "name" => "First Image Link",
                    "desc" => "Enter the url you want this image to go to when clicked",
                    "id" => $shortname."_home_image1_link",
                    "std" => "Image Link",
                    "type" => "text");
//
$options[] = array( "name" => "2nd Image",
					"desc" => "",
					"std" => "Enter the following information for the second of the 3 images on the home page",
					"type" => "info");

$options[] = array( "name" => "Second Image",
                    "desc" => "Upload the 2nd image for the home page. 300px by 140px",
                    "id" => $shortname."_home_image2",
                    "std" => "Second Image",
                    "type" => "upload");

$options[] = array( "name" => "Second Image Title",
                    "desc" => "Enter the test you want to appear on top of the image. ",
                    "id" => $shortname."_home_image2_text",
                    "std" => "Image Text",
                    "type" => "text");

$options[] = array( "name" => "Second Image Link",
                    "desc" => "Enter the url you want this image to go to when clicked",
                    "id" => $shortname."_home_image2_link",
                    "std" => "Image Link",
                    "type" => "text");
//

$options[] = array( "name" => "3rd Image",
					"desc" => "",
					"std" => "Enter the following information for the third of the 3 images on the home page",
					"type" => "info");

$options[] = array( "name" => "Third Image",
                    "desc" => "Upload the 3rd image for the home page. 300px by 140px",
                    "id" => $shortname."_home_image3",
                    "std" => "Third Image",
                    "type" => "upload");

$options[] = array( "name" => "Third Image Title",
                    "desc" => "Enter the test you want to appear on top of the image. ",
                    "id" => $shortname."_home_image3_text",
                    "std" => "Image Text",
                    "type" => "text");

$options[] = array( "name" => "Third Image Link",
                    "desc" => "Enter the url you want this image to go to when clicked",
                    "id" => $shortname."_home_image3_link",
                    "std" => "Image Link",
                    "type" => "text");


//Links
$options[] = array( "name" => "Social Links",
                    "type" => "heading");

$options[] = array( "name" => "Facebook URL",
                    "desc" => "Enter your Facebook URL",
                    "id" => $shortname."_facebook_url",
                    "std" => "Your Facebook URL",
                    "type" => "text");

$options[] = array( "name" => "Twitter Username",
                    "desc" => "Enter your Twitter Username",
                    "id" => $shortname."_twitter_username",
                    "std" => "Your Twitter Username",
                    "type" => "text");

$options[] = array( "name" => "YouTube",
                    "desc" => "Enter your YouTube URL",
                    "id" => $shortname."_youtube_url",
                    "std" => "Your YouTube URL",
                    "type" => "text");

$options[] = array( "name" => "Vimeo",
                    "desc" => "Enter your Vimeo URL",
                    "id" => $shortname."_vimeo_url",
                    "std" => "Your Vimeo URL",
                    "type" => "text");

$options[] = array( "name" => "Pinterest",
                    "desc" => "Enter your Pinterest URL",
                    "id" => $shortname."_pinterest_url",
                    "std" => "Your Pinterest URL",
                    "type" => "text");

$options[] = array( "name" => "Feedburner URL",
                    "desc" => "Enter your Feedburner URL",
                    "id" => $shortname."_feedburner",
                    "std" => "Your Feedburner URL",
                    "type" => "text");

//podcast settings ---------
   
$options[] = array( "name" => "Sermon Podcast Settings",
                    "type" => "heading");

$options[] = array( "name" => "Info",
					"desc" => "",
					"std" => "The Podcast is automatically generated by the sermons you post. Fill out the basic information below to get it started.",
					"type" => "info");
                   
$options[] = array( "name" => "Podcast Title",
                    "desc" => "Enter the title of your podcast.",
                    "id" => "cap_podcast_title",
                    "std" => "",
                    "type" => "text");

$options[] = array( "name" => "Podcast Subtitle",
                    "desc" => "Enter a short subtitle for the podcast.",
                    "id" => "cap_podcast_subtitle",
                    "std" => "",
                    "type" => "text");

$options[] = array( "name" => "Podcast Email",
                    "desc" => "Enter an email address for the podcast.",
                    "id" => "cap_email",
                    "std" => "",
                    "type" => "text");

$options[] = array( "name" => "Podcast Author",
                    "desc" => "Enter the author of the podcast.",
                    "id" => "cap_podcast_author",
                    "std" => "",
                    "type" => "text");

$options[] = array( "name" => "Podcast Description",
                    "desc" => "Enter the description of the podcast.",
                    "id" => "cap_podcast_description",
                    "std" => "",
                    "type" => "text");

$options[] = array( "name" => "Podcast Image",
                    "desc" => "Upload an image to represent the podcast. Recommended size 600 x 600 Pixels",
                    "id" => "cap_podcast_image",
                    "std" => "",
                    "type" => "upload");

$options[] = array( "name" => "Category",
					"desc" => "Select a category for your podcast",
					"id" => "cap_podcast_cat_1",
					"std" => "Other",
					"type" => "select",
					"class" => "mini", //mini, tiny, small
					"options" => $podcast_select_1);    

$options[] = array( "name" => "Sub-Category",
					"desc" => "Select a sub-category for your podcast",
					"id" => "cap_podcast_cat_2",
					"std" => "Other",
					"type" => "select",
					"class" => "mini", //mini, tiny, small
					"options" => $podcast_select_2);    


//styling options ---------
   
$options[] = array( "name" => "Styling Options",
                    "type" => "heading");
       
                   
$options[] = array( "name" => "Custom CSS",
                    "desc" => "Quickly add some CSS to your theme by adding it to this block.",
                    "id" => $shortname."_custom_css",
                    "std" => "",
                    "type" => "textarea");

$options[] = array( "name" => "Select Style",
					"desc" => "Select a stylesheet..",
					"id" => "cap_stylesheet",
					"std" => "minimal.css",
					"type" => "select",
					"class" => "mini", //mini, tiny, small
					"options" => $stylesheet_select);     








update_option('of_template',$options);                      
update_option('of_themename',$themename);  
update_option('of_shortname',$shortname);

}
}
?>