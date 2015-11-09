<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.  The actual display of comments is
 * handled by a callback to churchthemer_comment which is
 * located in the functions.php file.
 *
 * @package WordPress
 * @subpackage Moses Theme by Church Themer
 * @since Moses Theme by Church Themer 3.0
 */
?>

<?php if ( post_password_required() ) : ?>
				<p><?php _e( 'This post is password protected. Enter the password to view any comments.', 'churchthemer' ); ?></p>
<?php
		/* Stop the rest of comments.php from being processed,
		 * but don't kill the script entirely -- we still have
		 * to fully load the template.
		 */
		return;
	endif;
?>

<?php
	// You can start editing here -- including this comment!
?>
<div class="comments">
<?php if ( have_comments() ) : ?>
         
        
        
                     <h2><?php
                    printf( _n( '1 Comment', '%1$s Comments', get_comments_number(), 'churchthemer' ),
                    number_format_i18n( get_comments_number() ), '' . get_the_title() . '' );
                    ?></h2> 
                                                        
                                        
        
        <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
                        <?php previous_comments_link( __( '&larr; Older Comments', 'churchthemer' ) ); ?>
                        <?php next_comments_link( __( 'Newer Comments &rarr;', 'churchthemer' ) ); ?>
        <?php endif; // check for comment navigation ?>
        
                    <ul>
                        <?php
                            /* Loop through and list the comments. Tell wp_list_comments()
                             * to use churchthemer_comment() to format the comments.
                             * If you want to overload this in a child theme then you can
                             * define churchthemer_comment() and that will be used instead.
                             * See churchthemer_comment() in churchthemer/functions.php for more.
                             */
                            wp_list_comments( array( 'callback' => 'minimal_comment' ) );
                        ?>
                    </ul>
        
        <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
                        <?php previous_comments_link( __( '&larr; Older Comments', 'churchthemer' ) ); ?>
                        <?php next_comments_link( __( 'Newer Comments &rarr;', 'churchthemer' ) ); ?>
        <?php endif; // check for comment navigation ?>
		
<?php else : // or, if we don't have comments:

	/* If there are no comments and comments are closed,
	 * let's leave a little note, shall we?
	 */
	if ( ! comments_open() ) :
?>
	<p><?php //_e( 'Comments are closed.', 'churchthemer' ); ?></p>
    
<?php endif; // end ! comments_open() ?>

<?php endif; // end have_comments() ?>

<?php
//style the comments form
$fields =  array(
		'author' => '<p class="comment-form-author">' . '<label for="author">' . __( 'Name' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) .
		            '<input id="author" name="author" type="text" value="Name" size="30"' . $aria_req . ' /></p>',
		'email'  => '<p class="comment-form-email"><label for="email">' . __( 'Email' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) .
		            '<input id="email" name="email" type="text" value="Email" size="30"' . $aria_req . ' /></p>',
		'url'    => '<p class="comment-form-url"><label for="url">' . __( 'Website' ) . '</label>' .
		            '<input id="url" name="url" type="text" value="Website" size="30" /></p>',
);


$defaults = array(
'fields'=> apply_filters( 'comment_form_default_fields', $fields ),

'logged_in_as'=>'<fieldset class="fields"> You are currently logged in.
<div class="text_fields"> ',

'comment_notes_before'=>'<fieldset class="fields"> 
<div class="text_fields"> ',

'comment_field'=>'</div><div class="field_message"><textarea id="comment" name="comment"></textarea></div></fieldset><fieldset class="submit"><input type="submit" name="submit" class="submitcomment" value="Submit Comment"></fieldset>',

'comment_notes_after'=>'',

'title_reply'=>__( '<h2>Leave a Comment</h2>' ),

);
comment_form($defaults); ?>
</div>