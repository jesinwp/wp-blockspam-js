<?php
/*
Plugin Name: JavaScript Spam Blocker
Plugin URI: http://websistent.com/prevent-wordpress-comment-spam-using-javascript/
Description: Block comment spam bots with a single line of JavaScript
Author: Jesin
Author URI: http://websistent.com
*/

add_action( 'preprocess_comment' , 'preprocess_comment_handler' );

function preprocess_comment_handler( $commentdata ) {
	if ( ! is_admin() && ( ! isset( $_POST['js_field'] ) || $commentdata['comment_post_ID'] != $_POST['js_field'] ) ) {
		wp_die( 'Please enable JavaScript to comment on this blog' );
	}
	return $commentdata;
}

add_action( 'wp_footer', 'js_commentform_hidden_field' );

function js_commentform_hidden_field() {
?>
<script type="text/javascript">
var commentform = document.getElementById('commentform');
if ( commentform ) {
	commentform.innerHTML += '<input type="hidden" name="js_field" value="' + document.getElementById('comment_post_ID').value + '" />';
}
</script>
<?php
}
