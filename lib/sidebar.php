<?php
/* Sidebar Module
 @ For WPStores Themes
*/

/**
 * Social Widget
**/
function wpstores_ssocial() {
$imgfolder = plugins_url( '../images' , __FILE__ ); ?>
<aside class="widget" id="sidebar-social">
	<h1 class="widget-title"><?php echo wpstores_option('sph');?></h1>
		<div class="socialsidebar">
			<?php if (wpstores_option('fbpu')) { ?>
			<a rel="nofollow" href="<?php echo wpstores_option('fbpu');?>" target="_blank"><img src="<?php echo $imgfolder;?>/sbfb.png" alt=""></a>
			<?php }
			if (wpstores_option('twpu')) { ?>
			<a rel="nofollow" href="<?php echo wpstores_option('twpu'); ?>" target="_blank"><img src="<?php echo $imgfolder;?>/sbtw.png" alt=""></a>
			<?php }
			if (wpstores_option('lipu')) { ?>			
			<a rel="nofollow" href="<?php echo wpstores_option('lipu'); ?>" target="_blank"><img src="<?php echo $imgfolder;?>/sbin.png" alt=""></a>
			<?php }
			if (wpstores_option('gppu')) { ?>				
			<a rel="nofollow" href="<?php echo wpstores_option('gppu'); ?>" target="_blank"><img src="<?php echo $imgfolder;?>/sbgp.png" alt=""></a>
			<?php }
			if (wpstores_option('sbmail')) { ?>
			<a rel="nofollow" href="<?php echo wpstores_option('sbmail'); ?>" target="_blank"><img src="<?php echo $imgfolder;?>/sbmail.png" alt=""></a>
			<?php }
			if (wpstores_option('rssu')) { ?>
			<a rel="nofollow" href="<?php echo wpstores_option('rssu'); ?>" target="_blank"><img src="<?php echo $imgfolder;?>/sbrss.png" alt=""></a>
			<?php } ?>
		</div>
</aside>
<?php }


/**
 * Helper Functions for Tabbed Widget
**/

/*** Popular Posts Based On Comment Count ***/
function wpstores_latest_posts() {
	
	// Query
	global $post;
	$query = get_posts( array ( 'posts_per_page'  => 10 ) );
	foreach( $query as $post ) : setup_postdata($post); ?>
			<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
	<?php wp_reset_postdata();?>
	<?php endforeach; ?>
	
<?php }

/*** Popular Posts Based On Comment Count ***/
function wpstores_popular_posts() {
	
	// Query
	global $post;
	$query = get_posts( array ( 'posts_per_page'  => 10, 'orderby' => 'comment_count', 'order' => 'DESC' ) );
	foreach( $query as $post ) : setup_postdata($post); 
		$gettitle = get_the_title();
		if ( strlen($gettitle) > 35 ) {
			$title = substr($gettitle, 0, 35) .'..';
		} else {
			$title = $gettitle; 
		} ?>
			<li><a href="<?php the_permalink(); ?>"><?php echo $title; ?></a> <span class="tabbercomments">(<?php comments_number( '0', '1', '%' ); ?>)</span></li>
	<?php wp_reset_postdata();?>
	<?php endforeach; ?>
	
<?php }

/*** Recent Comments ***/
function wpstores_recent_comments() {

	// Query
	$comments = get_comments( array('number' => 10, 'status' => 'approve', 'type' => 'comment',) );
	foreach($comments as $comment) :
		$comauth = $comment->comment_author;
		$comauthurl = $comment->comment_author_url;
		$comid = $comment->comment_ID;
		$compostid = $comment->comment_post_ID;
		$avatar = get_avatar( $comment->comment_author_email, 20, '', $comauth );
			// Setup Comment Author
			if ($comauthurl) {
				$com = "<a rel=\"nofollow\" href=\"$comauthurl\" target=\"_blanlk\">$comauth</a>";
			} else {
				$com = $comauth;
			}
			
			// Setup Comment's Permalink
			$composttitle = substr(get_the_title( $compostid ), 0, 14);
			$compostpermalink = get_permalink( $compostid );
				$commentpost = "<a href=\"$compostpermalink#comment-$comid\">$composttitle..</a>";
			
	echo "<li>$avatar <span class=\"tabbercom\">$com</span> <span class=\"tabbercomments\">On $commentpost</span></li>";
	endforeach;
}


/**
 * Tabbed Widget
**/
function wpstores_sidebar_tabber() {
?>

<aside class="widget" id="sidebar-tabbed">
	<h1 class="widget-title">What's Happening</h1>
	<div class="tabber">
		<div class="tabbertab">
			<h2>Latest Posts</h2>
			<ul>
				<?php if (function_exists('wpstores_latest_posts')) { echo wpstores_latest_posts(); } ?>
			</ul>
		</div>
		<div class="tabbertab">
			<h2>Popular Posts</h2>
			<ul class="ppul">
				<?php if (function_exists('wpstores_popular_posts')) { echo wpstores_popular_posts(); } ?>
			</ul>
		</div>
		<div class="tabbertab">
			<h2>Recent Comments</h2>
			<ul>
				<?php if (function_exists('wpstores_recent_comments')) { echo wpstores_recent_comments(); } ?>
			</ul>
		</div>

	</div>
</aside>

<?php }


/**
 * Advertsing Widget
**/
function wpstores_ad_widget() { ?>
<aside class="widget" id="sidebar-ads">
	<h1 class="widget-title"><?php echo wpstores_option('adwh');?></h1>
		<div class="adwidget">
		<?php if (wpstores_option('as1')) { echo wpstores_option('as1'); } ?>
		<?php if (wpstores_option('as2')) { echo wpstores_option('as2'); } ?>
		<?php if (wpstores_option('as3')) { echo wpstores_option('as3'); } ?>
		<?php if (wpstores_option('as4')) { echo wpstores_option('as4'); } ?>
		</div>
</aside>
<?php }

/**
 * Display INIT
**/
function wpstores_sidebar_display() {
	$social = wpstores_option('sprdisplay');
	$tabber = wpstores_option('tpandisplay');
	$adwidget = wpstores_option('advdisplay');
	
	
	if ( wpstores_option('spr') == '1' ) {
		if ($social == 'top') {
			add_action( 'wpstores_sidebar_top', 'wpstores_ssocial', 1);
		} elseif ($social == 'bottom') {
			add_action( 'wpstores_sidebar_bottom', 'wpstores_ssocial', 1);
		}
	}
	

	if ( wpstores_option('tpan') == '1' ) {	
		if ($tabber == 'top') {
			add_action( 'wpstores_sidebar_top', 'wpstores_sidebar_tabber', 1);
		} elseif ($tabber == 'bottom') {
			add_action( 'wpstores_sidebar_bottom', 'wpstores_sidebar_tabber', 1);
		}
	}
	

	if ( wpstores_option('adv') == '1' ) {		
		if ($adwidget == 'top') {
			add_action( 'wpstores_sidebar_top', 'wpstores_ad_widget', 2);
		} elseif ($adwidget == 'bottom') {
			add_action( 'wpstores_sidebar_bottom', 'wpstores_ad_widget', 2);
		}
	}
}
add_action( 'init', 'wpstores_sidebar_display' );
?>