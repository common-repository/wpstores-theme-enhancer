<?php
/* The SEO Title Module
@ For WPStores Themes
*/

/* SEO Titles */
function wpstores_seo($title) {
if ( wpstores_option('seo') == '1') {
	// Get the seperator
	$sep = wpstores_option('seosep');
	
	// Get The Current Page Number
	global $page, $paged, $currentpage;
	$pagednow = (get_query_var('paged')) ? get_query_var('paged') : 1;
	$pagenow = (get_query_var('page')) ? get_query_var('page') : 1;
	
	if ($pagednow > 1 ) { $currentpage = "$sep Page: $pagednow";}
	if ($pagenow > 1 ) { $currentpage = "$sep Page: $pagenow";}
	
	// Homepage SEO Title
	if (is_home() || is_front_page()) {
		if ( wpstores_option('hometitle') == '1' ) {
			$title = '' . get_bloginfo('name') . ' ' . $currentpage .'';
		} elseif ( wpstores_option('hometitle') == '2' ) {
			$title = '' . get_bloginfo('name') . ' '. $sep .' ' . get_bloginfo('description'). ' ' . $currentpage .'';
		}
	}
	
	// Single Posts and Pages SEO Title
	elseif (is_single() || is_page()) {
		if ( wpstores_option('singletitle') == '1' ) { 
			$title = '' . get_the_title() . ' ' . $currentpage . '';
		} elseif ( wpstores_option('singletitle') == '2' ) { 
			$title = '' . get_the_title() . ' ' . $currentpage . ' '. $sep .' ' . get_bloginfo('name') . '';
		} elseif ( wpstores_option('singletitle') == '3' ) { 
			$title = '' . get_the_title() . ' '. $sep .' ' . get_bloginfo('name') . ' ' . $currentpage . '';
		}
	}
	
	// Category Page SEO Title
	elseif (is_category()) {
		if ( wpstores_option('cattitle') == '1' ) { 
			$title = '' . single_cat_title('Posts Under Category') . ' ' . $currentpage . '';
		} elseif ( wpstores_option('cattitle') == '2' ) { 
			$title = '' . single_cat_title('Posts Under Category') . ' ' . $currentpage . ' '. $sep .' ' . get_bloginfo('name') . '';
		} elseif ( wpstores_option('cattitle') == '3' ) { 
			$title = '' . single_cat_title('Posts Under Category') . ' '. $sep .' ' . get_bloginfo('name') . ' ' . $currentpage . '';
		}
	}
	
	// Tag Pages SEO Title
	elseif (is_tag()) {
		if ( wpstores_option('tagtitle') == '1' ) { 
			$title = '' . single_tag_title('Posts Tagged With') . ' ' . $currentpage . '';
		} elseif ( wpstores_option('tagtitle') == '2' ) { 
			$title = '' . single_tag_title('Posts Tagged With') . ' ' . $currentpage . ' '. $sep .' ' . get_bloginfo('name') . '';
		} elseif ( wpstores_option('tagtitle') == '3' ) { 
			$title = '' . single_tag_title('Posts Tagged With') . ' '. $sep .' ' . get_bloginfo('name') . ' ' . $currentpage . '';
		}
	}
	
	// Author Pages SEO Title
	elseif (is_author()) {
	$curauth = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author'));
	$authname = $curauth->display_name;
		if ( wpstores_option('authtitle') == '1' ) { 
			$title = 'Posts Written By: ' . $authname . ' ' .  $currentpage . '';
		} elseif ( wpstores_option('authtitle') == '2' ) { 
			$title = 'Posts Written By: ' . $authname . ' ' .  $currentpage . ' '. $sep .' ' . get_bloginfo('name') . '';
		} elseif ( wpstores_option('authtitle') == '3' ) { 
			$title = 'Posts Written By: ' . $authname . ' '. $sep .' ' . get_bloginfo('name') . ' ' .  $currentpage . '';
		}
	}	
	
	// 404 Page SEO Title
	elseif (is_404()) {
		if ( wpstores_option('xtitle') == '1' ) { 
			$title = 'Item Not Found '. $sep .' ' . get_bloginfo('name'). '';
		} elseif ( wpstores_option('xtitle') == '2' ) { 
			$title = 'Sorry, it\'s 404 - Doesn\'t Exist '. $sep .' ' . get_bloginfo('name'). '';
		} elseif ( wpstores_option('xtitle') == '3' ) { 
			$title = 'Oops.. You Found A Broken Page '. $sep .' ' . get_bloginfo('name'). '';
		}
	}
	
	}
		return $title;
}
add_filter( 'wp_title', 'wpstores_seo', 5, 1 );
?>