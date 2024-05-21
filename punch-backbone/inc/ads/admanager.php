<?php

/** helps to load ad-tags for both adsense and admanager */

/**
 * 
 *  [admanager ad_id=""]
 * 
 * The add ids are;
 * -> rvp-desktop-(1-5) = 300x250, 725x90
 * -> rvp-desktop-leaderboard = 728x90, 970x90
 * -> rvp-mobile-(1-5) = 300x250, 300x50, 300x100 
 * -> rvp-sidebar-(1-2) = 300x250, 300x600
 * -> rvp-mobile-halfpage = 300x600
 * 
 * other options include;
 * placement (mobile/desktop) - to tell where the ads will appear either on desktop or on mobile
 * mb (true/false) - margin bottom can be true or false to ad a 2em margin to the bottom of the ad container
 * mt (true/false) - margin top can be true or false to ad a 2em margin to the top of the ad container
 */


function admanager_function($atts)
{

  $data = shortcode_atts(['ad_id' => '', 'mobile_sticky' => false, 'show_amp' => true, 'mt' => true, 'mb' => true, 'lazy' => true, 'placement' => 'all', 'view' => '', 'class' => false], $atts);

  switch ($data['ad_id']) {

    case 'mobile_1':
      $ad_id = 'div-gpt-ad-1652282720550-0';
      break;

    case 'mobile_1_r89':
      $ad_id = 'div-gpt-ad-1652282720550-0';
      break;

    case 'mobile_2':
      $ad_id = 'div-gpt-ad-1652282798096-0';
      break;

    case 'mobile_3':
      $ad_id = 'div-gpt-ad-1652282869388-0';
      break;

    case 'mobile_4':
      $ad_id = 'div-gpt-ad-1652282927453-0';
      break;

    case 'mobile_5':
      $ad_id = 'div-gpt-ad-1652283037699-0';
      break;

    case 'halfpage':
      $ad_id = 'div-gpt-ad-1652283086935-0';
      break;

    case 'desktop_1':
      $ad_id = 'div-gpt-ad-1652278950647-0';
      break;

    case 'desktop_2':
      $ad_id = 'div-gpt-ad-1652281233069-0';
      break;

    case 'desktop_3':
      $ad_id = 'div-gpt-ad-1652281318990-0';
      break;

    case 'desktop_4':
      $ad_id = 'div-gpt-ad-1652281437867-0';
      break;

    case 'desktop_5':
      $ad_id = 'div-gpt-ad-1652281667269-0';
      break;

    case 'sidebar_1':
      $ad_id = 'div-gpt-ad-1652282076413-0';
      break;

    case 'desktop_leaderboard':
      $ad_id = 'div-gpt-ad-1652282034867-0';
      break;

    case 'rvp_desktop_leaderboard_1':
      $ad_id = 'div-gpt-ad-1662508893487-0';
      break;

    case 'mobile_leaderboard':
      $ad_id = 'div-gpt-ad-1657175094343-0';
      break;

    case 'outstream_video':
      $ad_id = 'div-gpt-ad-1690814874120-0';
      break;

    case 'outstream_video_2':
      $ad_id = 'div-gpt-ad-1705331421819-0';
      break;
  }

  $mt = ($data['mt'] === true) ? 'margin-top' : '';
  $mb = ($data['mb'] === true) ? 'margin-bottom' : '';

  // $placement = ( $data['placement'] == 'mobile' ) ? 'mobile-only' : '';
  // $placement = ( $data['placement'] == 'desktop' ) ? 'desktop-only' : '';

  if ($data['placement'] == 'mobile') {
    $placement = 'mobile-only';
  } else if ($data['placement'] == 'desktop') {
    $placement = 'desktop-only';
  } else {
    $placement = '';
  }

  // $lazy = ($data['lazy'] == false) ? "googletag.cmd.push(function() { googletag.display('" . $ad_id . "'); });" : "";
  $class = ($data['class'] == false) ? '' : $data['class'];
  // $lazy_amp = "data-lazy-fetch='true' data-loading-strategy='2'";
  $lazy_amp = " data-lazy-fetch='true' data-loading-strategy='prefer-viewability-over-views' "; //testing this out to see how it works out for us

  $amp = '';
  // json='{"targeting":{"category":[]}}' this portion is for ads targeting in AMP
  if ($data['ad_id'] == 'mobile_1') {
    $amp = '<amp-ad width=336 height=280 data-block-on-consent="_till_responded" type="doubleclick" data-slot="/15748617,31989200/Punchngcom/Punchngcom-AMP-Mobile-Top" data-multi-size="320x240,320x100,320x50,300x250,300x100,300x50" rtc-config=\'{ "vendors": { "aps": {"PUB_ID": "600", "PUB_UUID": "d02f0482-a50f-427c-ac01-9856371f1f6b", "PARAMS":{"amp":"1"}} }}\'> </amp-ad>';
    //replace refinery89 amp tages with all our mobile app amp tags
    // $amp = '<amp-ad width="336" height="280" type="doubleclick" data-slot="/31989200/rvp-mobile-1" data-multi-size="300x250" '.$lazy_amp.' ></amp-ad>';
  }
  if ($data['ad_id'] == 'mobile_2') {
    // $amp = '<amp-ad width="300" height="250" type="doubleclick" data-slot="/31989200/rvp-mobile-2" '.$lazy_amp.' > </amp-ad>';
    $amp = '<amp-ad width="336" height="280" data-loading-strategy="1" type="doubleclick" data-slot="/15748617,31989200/Punchngcom/Punchngcom-AMP-Rectangle-Mid" data-multi-size="320x240,320x100,320x50,300x250,300x100,300x50" rtc-config=\'{ "vendors": { "aps": {"PUB_ID": "600", "PUB_UUID": "d02f0482-a50f-427c-ac01-9856371f1f6b", "PARAMS":{"amp":"1"}} }}\' > </amp-ad>';
  }
  if($data['ad_id'] == 'mobile_1_r89') {
    // $amp = '<amp-sticky-ad layout="nodisplay"> <amp-ad width=336 height=280 data-block-on-consent="_till_responded" type="doubleclick" data-slot="/15748617,31989200/Punchngcom/Punchngcom-AMP-Mobile-Top" data-multi-size="320x240,320x100,320x50,300x250,300x100,300x50" rtc-config=\'{ "vendors": { "aps": {"PUB_ID": "600", "PUB_UUID": "d02f0482-a50f-427c-ac01-9856371f1f6b", "PARAMS":{"amp":"1"}} }}\'> </amp-ad> </amp-sticky-ad>';
    $amp = '<amp-ad width=336 height=280 data-block-on-consent="_till_responded" type="doubleclick" data-slot="/15748617,31989200/Punchngcom/Punchngcom-AMP-Mobile-Top" data-multi-size="320x240,320x100,320x50,300x250,300x100,300x50" rtc-config=\'{ "vendors": { "aps": {"PUB_ID": "600", "PUB_UUID": "d02f0482-a50f-427c-ac01-9856371f1f6b", "PARAMS":{"amp":"1"}} }}\'> </amp-ad>';
  }
  if ($data['ad_id'] == 'mobile_3') {
    $amp = '<amp-ad width="300" height="250" type="doubleclick" data-slot="/31989200/rvp-mobile-3" data-multi-size="300x250" '.$lazy_amp.' > </amp-ad>';
  }
  if ($data['ad_id'] == 'mobile_4') {
    $amp = '<amp-ad width=300 height="250" type="doubleclick" data-slot="/31989200/rvp-mobile-4" data-multi-size="300x250" '.$lazy_amp.' > </amp-ad>';
  }
  if ($data['ad_id'] == 'mobile_5') {
    $amp = '<amp-ad width="300" height="250" type="doubleclick" data-slot="/31989200/rvp-mobile-5" data-multi-size="300x250" '.$lazy_amp.' > </amp-ad>';
  }

  if( $data['ad_id'] == 'outstream_video') {
    $amp = '<amp-ad width=1 height=1 type="doubleclick" data-slot="/31989200/rvp-outstream-video" '.$lazy_amp.' > </amp-ad>';
  }

  if( $data['ad_id'] == 'outstream_video_2') {
    $amp = '<amp-ad width=1 height=1 type="doubleclick" data-slot="/31989200/rvp-outstream-video-2" '.$lazy_amp.' > </amp-ad>';
  }
  // if ($data['ad_id'] == 'mobile_')
  // $data['ad_id'] == 'desktop_leaderboard-2' ||
  $centralize = ( $data['ad_id'] == 'desktop_leaderboard' || $data['ad_id'] == 'rvp_desktop_leaderboard_1' || $data['ad_id'] == 'mobile_leaderboard' ) ? 'style="display:flex;align-items:center;justify-content:center;"' : 'class="ad-container-inner"';

  $standard = '<div id="' . $ad_id . '" class="punch-admanager"> </div>';
  // if ($data['lazy'] == false) {
  //   $standard = '<div id="' . $ad_id . '" class="punch-admanager"> </div>';
  // }

  $mimum_height = ( $data['ad_id'] == 'rvp_desktop_leaderboard_1' ) ? 'style="min-height:100px;"' : '';
  // style='min-width: 300px; min-height: 50px;'
  // return '===================================================='.$data['ad_id'].' <br/>';

  return '<div '.$mimum_height.' class="ad-container ' . $placement . ' ' . $mt . ' ' . $mb . ' ' . $class . '"> <div ' . $centralize . '>' . $standard . ' ' . $amp . ' </div></div>';
}
add_shortcode('admanager', 'admanager_function');