<?php
/* The Social Module
@ For WPStores Themes
*/

function wpstores_te_social () { ?>
<div class="share_post">
	<div class="facebook"><div class="fb-like" data-href="<?php urlencode(get_permalink()); ?>" data-send="false" data-layout="button_count" data-width="40" data-show-faces="false" data-font="verdana"></div></div>
	<div class="tweeter_post"><a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php if (function_exists('wp_get_shortlink')) { echo wp_get_shortlink(get_the_ID()); } else { the_permalink();  }?>" data-counturl="<?php the_permalink(); ?>" data-text="<?php get_the_title(); ?>">Tweet</a></div>
	<div class="bufferapp"><a href="http://bufferapp.com/add" class="buffer-add-button" data-text="<?php echo get_the_title(); ?>" data-url="<?php get_permalink(); ?>" data-count="horizontal" data-via="itsabhik" >Buffer</a></div>
	<div class="linkedin"><script type="IN/Share" data-url="<?php get_permalink(); ?>" data-counter="right"></script></div>
	<div class="pinterest"><a href="http://pinterest.com/pin/create/button/?url=<?php echo urlencode(get_permalink()) ?>&amp;media=&amp;description=<?php echo get_the_title(); ?>" class="pin-it-button" count-layout="horizontal"><img src="//assets.pinterest.com/images/PinExt.png" title="Pin It" /></a></div>
	<div class="google1"><div class="g-plusone" data-size="medium"></div></div>
	<div class="clear"></div>
</div>

<?php }

function wpstores_social() {
if ('1' == wpstores_option( 'socialbuttons')) {
	if (wpstores_option( 'buttonsposition') == 'top') {
		add_action ('wpstores_before_single_content', 'wpstores_te_social');
	} elseif (wpstores_option( 'buttonsposition') == 'bottom') {
		add_action ('wpstores_after_single_content', 'wpstores_te_social');
	} elseif ( wpstores_option( 'buttonsposition') == 'both' ) {
		add_action ('wpstores_before_single_content', 'wpstores_te_social');
		add_action ('wpstores_after_single_content', 'wpstores_te_social');
	}
}
}
add_action('init', 'wpstores_social');

function wpstores_te_social_scripts() {
	if ('1' == wpstores_option( 'socialbuttons')) {
		$socialsites = wpstores_option('socialsites');
		if ($socialsites['facebook'] == '1') { ?>
			<div id="fb-root"></div>
			<script>(function(d, s, id) {
				var js, fjs = d.getElementsByTagName(s)[0];
				if (d.getElementById(id)) return;
				js = d.createElement(s); js.id = id;
					js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=";
				fjs.parentNode.insertBefore(js, fjs);
				}(document, 'script', 'facebook-jssdk'));
			</script>
		<?php }
		if ($socialsites['twitter'] == '1') { ?>
			<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
		<?php }
		if ($socialsites['buffer'] == '1') { ?>
			<script type="text/javascript" src="http://static.bufferapp.com/js/button.js"></script>
		<?php }
		if ($socialsites['linkedin'] == '1') { ?>
			<script src="//platform.linkedin.com/in.js" type="text/javascript">
				lang: en_US
			</script>
		<?php }
		if ($socialsites['pinterest'] == '1') { ?>		
		<script type="text/javascript">
			(function(d){
				var f = d.getElementsByTagName('SCRIPT')[0], p = d.createElement('SCRIPT');
				p.type = 'text/javascript';
				p.async = true;
				p.src = '//assets.pinterest.com/js/pinit.js';
				f.parentNode.insertBefore(p, f);
			}(document));
		</script>
		<?php }
		if ($socialsites['google'] == '1') { ?>		
		<script type="text/javascript">
			(function() {
				var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
				po.src = 'https://apis.google.com/js/plusone.js';
				var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
			})();
		</script>
		<?php }
	}
}
add_action('wp_footer', 'wpstores_te_social_scripts');
?>