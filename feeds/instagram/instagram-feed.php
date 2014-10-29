<?php
add_action('wp_enqueue_scripts', 'fts_instagram_head');
function  fts_instagram_head() {
    wp_enqueue_style( 'fts_instagram_css', plugins_url( 'instagram/css/styles.css',  dirname(__FILE__) ) );
	wp_enqueue_script( 'fts_instagram_masonry_pkgd_js', plugins_url( 'instagram/js/masonry.pkgd.min.js',  dirname(__FILE__) ), array( 'jquery' ) );
	
	// masonry js snippet in date-format.js too
	wp_enqueue_script( 'fts_instagram_date_js', plugins_url( 'instagram/js/date-format.js',  dirname(__FILE__) ), array( 'jquery' ) );
}

add_shortcode( 'fts instagram', 'fts_instagram_func' );
//Main Funtion
function fts_instagram_func($atts){

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

if(is_plugin_active('feed-them-premium/feed-them-premium.php')) {
   include(WP_CONTENT_DIR.'/plugins/feed-them-premium/feeds/instagram/instagram-feed.php');
}
else 	{
	extract( shortcode_atts( array(
		'instagram_id' => '',
		'type' => '',
		'super_gallery' => '',
		'image_size' => '',
		'icon_size' => '',
		'space_between_photos' => '',
		'hide_date_likes_comments' => '',
		'center_container' => '',
		'image_stack_animation' => '',
		
	), $atts ) );
	$pics_count = '6';
}
?>
<?php
ob_start(); 

//URL to get Feeds
 if ($type == 'hashtag') {  
	$insta_url = 'https://api.instagram.com/v1/tags/'.$instagram_id.'/media/recent/?access_token=258559306.502d2c4.c5ff817f173547d89477a2bd2e6047f9';
  } 
	else {
 	$insta_url = 'https://api.instagram.com/v1/users/'.$instagram_id.'/media/recent/?access_token=258559306.502d2c4.c5ff817f173547d89477a2bd2e6047f9';
	}
$cache = WP_CONTENT_DIR.'/plugins/feed-them-social/feeds/instagram/cache/instagram-cache-'.$instagram_id.'.json';
// https://api.instagram.com/v1/tags/snow/media/recent?access_token=ACCESS-TOKEN
// https://instagram.com/oauth/authorize/?client_id=[CLIENT_ID_HERE]&redirect_uri=http://localhost&response_type=token

	//Get Data for Instagram
	$response = wp_remote_fopen($insta_url);
	
	//Error Check
	$error_check = json_decode($response);
	if($error_check->meta->error_message){
		return $error_check->meta->error_message;
	}

 
if(file_exists($cache) && !filesize($cache) == 0 && filemtime($cache) > time() - 900){
	$insta_data = json_decode(file_get_contents($cache));
} 
else {
	$insta_data = json_decode($response);
	if (!file_exists($cache)) {
		touch($cache);
	}
	file_put_contents($cache,json_encode($insta_data));
}

 if ($super_gallery == 'yes') { ?>
<div class="fts-slicker-instagram masonry js-masonry" style="margin:auto" data-masonry-options='{ "isFitWidth": <?php if ($center_container == 'no') { ?>false<?php } else {?>true<?php } if ($image_stack_animation == 'no') { ?>, "transitionDuration": 0<?php } ?> }'>
	<?php } 
    else { ?>
    	<div class="fts-instagram">
   <?php } 
   
$set_zero = 0;
if (!$insta_data->data) {
	return '<div style="padding-right:35px;">Looks like instagram\'s API down. Please try clearing cache and reloading this page in the near future.</div>';
}
foreach($insta_data->data as $insta_d) {
if($set_zero==$pics_count)
break;
//Create Instagram Variables 
$instagram_date=  date('F j, Y',$insta_d->created_time);
$instagram_link = $insta_d->link;
$instagram_thumb_url = $insta_d->images->thumbnail->url;
$instagram_lowRez_url = $insta_d->images->standard_resolution->url;
$instagram_likes = $insta_d->likes->count;
$instagram_comments = $insta_d->comments->count;

if ($super_gallery == 'yes') {
?>
<div class='slicker-instagram-placeholder' style="width:<?php print $image_size ?>; margin:<?php print $space_between_photos ?>;"><a href='<?php print $instagram_link ?>' title="See More" class='fts-slicker-backg' style="height:<?php print $icon_size ?> !important; width:<?php print $icon_size ?>; line-height:<?php print $icon_size ?>; font-size:<?php print $icon_size ?>;"><span class="fts-instagram-icon" style="height:<?php print $icon_size ?>; width:<?php print $icon_size ?>; line-height:<?php print $icon_size ?>; font-size:<?php print $icon_size ?>;"></span></a>
  <?php if ($hide_date_likes_comments == 'no') { ?>
  	<div class='slicker-date'><?php print $instagram_date?></div>
  <?php } ?>
  <div class='slicker-instaG-backg-link'>
    <div class='slicker-instagram-image'><img src="<?php print $instagram_lowRez_url ?>" /></div>
    <div class='slicker-instaG-photoshadow'></div>
  </div>
 <?php if ($hide_date_likes_comments == 'no') { ?>
      <ul class='slicker-heart-comments-wrap'>
        <li class='slicker-instagram-image-likes'><?php print $instagram_likes ?></li>
        <li class='slicker-instagram-image-comments'><span class="fts-comment-instagram"></span><?php print $instagram_comments ?></li>
      </ul>
  <?php } ?>
</div>
<?php }
else {  ?>
<div class='instagram-placeholder'><a class='fts-backg' target='_blank' href='<?php print $instagram_link ?>'></a>
  <div class='date'><?php print $instagram_date ?></div>
  <a class='instaG-backg-link' target='_blank' href='<?php print $instagram_link ?>'>
    <div class='instagram-image' style='background:rgba(204, 204, 204, 0.8) url(<?php print $instagram_thumb_url ?>)'></div>
    <div class='instaG-photoshadow'></div>
  </a>
  <ul class='heart-comments-wrap'>
    <li class='instagram-image-likes'><?php print $instagram_likes ?></li>
    <li class='instagram-image-comments'><?php print $instagram_comments ?></li>
  </ul>
</div>
<?php }
	 $set_zero++;
	 }	
?>
<div class="clear"></div>
</div>
<?php 
return ob_get_clean(); 	
}
?>