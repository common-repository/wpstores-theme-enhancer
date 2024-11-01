<?php
/* Author Box Module
@ For WPStores Themes
*/


function wpstores_contacts( $contactmethods ) {
	unset($contactmethods['jabber']);	// Removes Jabber
	unset($contactmethods['yim']);	// Removes Yahoo! Messanger
	unset($contactmethods['aim']);	// Removes AIM
	
		$contactmethods['websitename'] = 'Website Title';	// Adds Website Title Field
		$contactmethods['googleplus'] = 'Google+ Profile';	// Adds Google+ Profile Link
		$contactmethods['linkedin'] = 'LinkedIn Profile';	// Adds LinkedIn Profile Link
		$contactmethods['twitter'] = 'Twitter Profile';		// Twitter Profile Link
		$contactmethods['facebook'] = 'Facebook Profile';	// Facebook Profile Link
		$contactmethods['pinterest'] = 'Pinterest Profile';	// Pinterest Profile Link
		$contactmethods['youtube'] = 'YouTube Profile';		// YouTube Profile Link
		$contactmethods['flickr'] = 'Flickr Profile';		// Flickr Profile Link
		$contactmethods['yahoo'] = 'Yahoo Profile';			// Yahoo Profile Link
		$contactmethods['stumble'] = 'StumbleUpon Profile';	// StumbleUpon Profile Link
		
	return $contactmethods;
}
add_filter('user_contactmethods','wpstores_contacts', 10, 1);



function wpstores_authorbox(){
	/* Required Information */
	global $post;
	$email = get_the_author_meta('email');
	//$default = WP_PLUGIN_URL . '/advanced-author-bio/images/default.png';
	$default = plugins_url( '../images/default.png' , __FILE__ );
	$size = 70;
	$grav_url = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?d=" . urlencode( $default ) . "&amp;s=" . $size;
	$imgfolder = plugins_url( '../images' , __FILE__ );
	
	$wpstores_author = array();
	$wpstores_author['name'] = get_the_author();
	$wpstores_author['numberofposts'] = number_format_i18n(get_the_author_posts());
	$wpstores_author['authorpage'] = get_author_posts_url(get_the_author_meta( 'ID' ));
	$wpstores_author['description'] = get_the_author_meta('description');
	$wpstores_author['twitter'] = get_the_author_meta('twitter');
	$wpstores_author['facebook'] = get_the_author_meta('facebook');
	$wpstores_author['googleplus'] = get_the_author_meta('googleplus');
	$wpstores_author['linkedin'] = get_the_author_meta('linkedin');
	$wpstores_author['website'] = get_the_author_meta('url');
	$wpstores_author['gravatar'] = get_avatar(get_the_author_meta('email'), '50');
	$wpstores_author['websitename'] = get_the_author_meta('websitename');
	$wpstores_author['firstname'] = get_the_author_meta('first_name');
	$wpstores_author['youtube'] = get_the_author_meta('youtube');
	$wpstores_author['flickr'] = get_the_author_meta('flickr');
	$wpstores_author['pinterest'] = get_the_author_meta('pinterest');
	$wpstores_author['yahoo'] = get_the_author_meta('yahoo');
	$wpstores_author['stumble'] = get_the_author_meta('stumble');
?>

<!-- WPStores Theme Enhancer Author Box Starts -->
	<div id="authorboxbody">
		<div class="authorinfo">
			<img class="gravatar" src="<?php echo $grav_url; ?>" alt="" />
			<p class="authorname">Post By <a href="<?php echo $wpstores_author['authorpage']; ?>"><?php echo $wpstores_author['name'];?></a> (<span style="text-decoration:underline;"><?php echo $wpstores_author['numberofposts'];?> Posts</span>)</p>
			<p class="description"><?php echo $wpstores_author['description']; ?></p>
			<?php if ($wpstores_author['website']) { ?>
				<p class="website">Website: &rarr; <a href="<?php echo $wpstores_author['website']; ?>"><?php echo $wpstores_author['websitename']; ?></a></p>
			<?php } ?>
		</div>	
		<div class="authorsocial">
			<p>Connect</p>
			<div class="socialicons">
				<?php if ($wpstores_author['facebook']) { ?>
					<a href="<?php echo $wpstores_author['facebook']; ?>"><img src="<?php echo $imgfolder;?>/facebook.png" alt="" /></a>
				<?php } 
				if ($wpstores_author['twitter']) { ?>
					<a href="<?php echo $wpstores_author['twitter']; ?>"><img src="<?php echo $imgfolder;?>/twitter.png" alt="" /></a>
				<?php }
				if ($wpstores_author['googleplus']) { ?>
					<a href="<?php echo $wpstores_author['googleplus']; ?>"><img src="<?php echo $imgfolder;?>/googleplus.png" alt="" /></a>
				<?php }
				if ($wpstores_author['linkedin']) { ?>
					<a href="<?php echo $wpstores_author['linkedin']; ?>"><img src="<?php echo $imgfolder;?>/linkedin.png" alt="" /></a>
				<?php }
				if ($wpstores_author['pinterest']) { ?>
					<a href="<?php echo $wpstores_author['pinterest']; ?>"><img src="<?php echo $imgfolder;?>/pinterest.png" alt="" /></a>
				<?php }
				if ($wpstores_author['flickr']) { ?>
					<a href="<?php echo $wpstores_author['flickr']; ?>"><img src="<?php echo $imgfolder;?>/flickr.png" alt="" /></a>
				<?php }
				if ($wpstores_author['youtube']) { ?>
					<a href="<?php echo $wpstores_author['youtube']; ?>"><img src="<?php echo $imgfolder;?>/youtube.png" alt="" /></a>
				<?php }
				if ($wpstores_author['yahoo']) { ?>
					<a href="<?php echo $wpstores_author['yahoo']; ?>"><img src="<?php echo $imgfolder;?>/yahoo.png" alt="" /></a>
				<?php }
				if ($wpstores_author['stumble']) { ?>
					<a href="<?php echo $wpstores_author['stumble']; ?>"><img src="<?php echo $imgfolder;?>/stumble.png" alt="" /></a>
				<?php } ?>
			</div>
		</div>
		<div class="clear"></div>
	</div>
<!-- WPStores Theme Enhancer Author Box Ends -->
<?php
}

function wpstores_authorbox_display() {
	if ( wpstores_option('authorbox') == '1' ) {
		$abpages = wpstores_option('abpages', 'none');
			if (isset($abpages)) {
				$abpost = $abpages['posts'];
				$abpage = $abpages['pages'];
			}
		// Static Pages
			if ( wpstores_option('abdisplay') == 'below' && $abpage == '1') {
				add_action( 'wpstores_after_page_content', 'wpstores_authorbox' );
			} elseif (wpstores_option('abdisplay') == 'above' && $abpage == '1') {
				add_action( 'wpstores_before_page_content', 'wpstores_authorbox' );
			}
		
		// Single Posts
			if ( wpstores_option('abdisplay') == 'below' && $abpost == '1') {
				add_action( 'wpstores_after_single_content', 'wpstores_authorbox' );
			} elseif (wpstores_option('abdisplay') == 'above' && $abpost == '1') {
				add_action( 'wpstores_before_single_content', 'wpstores_authorbox' );
			}			
	
	} //End Checking 'authorbox'
}
add_action('init', 'wpstores_authorbox_display');
/* Enables HTML in Author Bio */
	remove_filter('pre_user_description', 'wp_filter_kses');
	add_filter( 'pre_user_description', 'wp_filter_post_kses' );
	
	
/* */
?>