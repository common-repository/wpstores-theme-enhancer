<?php
/* The OpenGraph Module
@ For WPStores Themes
*/

// Let's get the image part first.
function wpstores_og_image() {
  
  global $post, $posts;
	// Check for Featured Image First
	if ( has_post_thumbnail( $post->ID ) ) {
		$tnurl = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'thumbnail' );
		$image = $tnurl[0];
	} else {
	// If NO Featured Image is set
		$content = get_the_content( $post->ID );
		$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $content, $matches);	
		if (!empty($output)) {
			$image = $matches[1][0];
		} else {
			$image = wpstores_option('ogthumb');
		}	
	}
  
  return $image;
}

// Let's limit the word count in description
function wpstores_ogwc() {
	$excerpt_length = wpstores_option('ogwc');
	$text = get_the_content('');
	$text = strip_shortcodes( $text );

	$text = apply_filters('the_content', $text);
	$text = str_replace(']]>', ']]&gt;', $text);
	$text = strip_tags($text);
	
	$words = preg_split("/[\n\r\t ]+/", $text, $excerpt_length + 1, PREG_SPLIT_NO_EMPTY);
	if ( count($words) > $excerpt_length ) {
		array_pop($words);
		$text = implode(' ', $words);
		$text = str_replace(array("&#8217;", "&#8216;", "&#8220;", "&#8221;"), "", $text);
	return "$text..";
	} else {
		$text = implode(' ', $words);
		return "$text";
	}
}

// Construct The OpenGraph
function wpstores_og ($wpstoresog) {
if ( is_single() ) {
	if (have_posts()) : while (have_posts()) : the_post(); 
		$checktitle = get_the_title(); if (!empty($checktitle)) { $title = $checktitle; } else {$title = '';}
		$permalink = get_permalink();
	endwhile; endif;
	wp_reset_query();

		$image = wpstores_og_image();
		$blogname = get_option('blogname');
		$descrip = wpstores_ogwc();
		$locale = wpstores_option('oglocale');
		$appid = wpstores_option('ogappid');
		$publisher = wpstores_option('ogpgun');
		$pubauthor = wpstores_option('ogpfun');
		$twsite = wpstores_option('ogtwwshandle');
		$twcreator = wpstores_option('ogtwcrhandle');
	
	global $wpstoresog;
		$wpstoresog.="\n";
		$wpstoresog.="<!-- WPStores.NET Facebook OpenGraph and Twitter Card Start -->";
		$wpstoresog.="\n";
		if ( wpstores_option('opengraph') == '1') {
		$wpstoresog.='<meta property="og:title" content="'.$title.'" />';
		$wpstoresog.="\n";
		$wpstoresog.='<meta property="og:type" content="article" />';
		$wpstoresog.="\n";
		$wpstoresog.='<meta property="og:url" content="'.$permalink.'" />';
		$wpstoresog.="\n";
		$wpstoresog.='<meta property="og:image" content="'.$image.'" />';
		$wpstoresog.="\n";
		$wpstoresog.='<meta property="og:site_name" content="'.$blogname.'" />';
		$wpstoresog.="\n";
		$wpstoresog.='<meta property="og:description" content="'.$descrip.'" />';
		$wpstoresog.="\n";
		$wpstoresog.='<meta property="article:publisher" content="https://www.facebook.com/'.$publisher.'" />';
		$wpstoresog.="\n";
		$wpstoresog.='<meta property="article:author" content="https://www.facebook.com/'.$pubauthor.'" />';
		$wpstoresog.="\n";
		$wpstoresog.='<meta property="og:locale" content="'.$locale.'" />';
		$wpstoresog.="\n";
		$wpstoresog.='<meta property="fb:app_id" content="'.$appid.'" />';
		$wpstoresog.="\n";
		}
		if ( wpstores_option('twittercard') == '1') {
		$wpstoresog.='<meta name="twitter:card" content="summary">';
		$wpstoresog.="\n";
		$wpstoresog.='<meta name="twitter:site" content="@'.$twsite.'">';
		$wpstoresog.="\n";
		$wpstoresog.='<meta name="twitter:creator" content="@'.$twcreator.'">';
		$wpstoresog.="\n";
		$wpstoresog.='<meta name="twitter:title" content="'.$title.'">';
		$wpstoresog.="\n";
		$wpstoresog.='<meta name="twitter:description" content="'.$descrip.'">';
		$wpstoresog.="\n";
		$wpstoresog.='<meta name="twitter:image" content="'.$image.'">';
		$wpstoresog.="\n";
		$wpstoresog.='<meta name="twitter:domain" content="'.site_url().'">';
		$wpstoresog.="\n";
		}
		$wpstoresog.='<!-- WPStores.NET Facebook OpenGraph and Twitter Card End -->';
		$wpstoresog.="\n";
	echo $wpstoresog;
	}
}
add_action( 'wp_head', 'wpstores_og', 5 );

?>