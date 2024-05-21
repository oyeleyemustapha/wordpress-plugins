<?php

/** helps to load ad-tags for both adsense and admanager */

/**
 * 
 *  [adsense/admanager ad_id=""]
 * 
 * The add ids are;
 * -> large_banner = height: 90; width: 728;
 * -> half_page = height: 600; width: 300;
 * -> medium_rectangle = heihgt: 250: width: 200;
 * -> inarticle_1 = height: 300; width: 100%;
 * -> inarticle_2 = height: 300; width: 100%;
 * -> responsive_1 = auto height & width for standard page but width: 100vw; height: 320; for AMP page
 * -> multiplex = auto height & width for standard page but width: 100vw; height: 320; for AMP page
 * 
 * other options include;
 * placement (mobile/desktop) - to tell where the ads will appear either on desktop or on mobile
 * mb (true/false) - margin bottom can be true or false to ad a 2em margin to the bottom of the ad container
 * mt (true/false) - margin top can be true or false to ad a 2em margin to the top of the ad container
 */


function adsense_function($atts)
{
	//setup default parameters
	$data = shortcode_atts(['ad_id' => 'medium_rectangle', 'mobile_sticky' => false, 'show_amp' => true, 'mt' => true, 'mb' => true, 'placement' => 'all', 'view' => '', 'class' => false], $atts);

	$h = "auto";
	$w = "auto";
	$ad_client = 'ca-pub-7167863529667065';

	switch ($data['ad_id']) {

		case 'medium_rectangle':
			$w = 300;
			$h = 250;
			$amp_slot_id = $slot_id = 7982123102;
			break;

		case 'half_page':
			$w = 300;
			$h = 600;
			$amp_slot_id = $slot_id = 8952671418;
			break;

		case 'large_banner':
			$w = 728;
			$h = 90;
			$amp_slot_id = $slot_id = 6824938199;
			break;

		case 'inarticle_1':
			$w = 300;
			$h = 250;
			$slot_id = 6075226638;
			$amp_slot_id = 3034130320;
			break;

		case 'inarticle_2':
			$w = 300;
			$h = 250;
			$slot_id = 7613074554;
			$amp_slot_id = 3034130320;
			break;

		case 'responsive_1':
			$w = 100;
			$h = 320;
			$amp_slot_id = $slot_id = 3034130320;
			break;

		case 'multiplex':
			$w = 100;
			$h = 320;
			$amp_slot_id = $slot_id = 4899281305;
			break;

		default:
			// $w = 300; $h = 250; $slot_id = 7982123102;
			$w = '';
			$h = '';
			$slot_id = '';
			break;
	}

	// $style = 'height: '.$h.'px; width: '.$w.'px;'; 
	$style = '';
	$mt = ($data['mt'] == true) ? 'margin-top' : '';
	$mb = ($data['mb'] == true) ? 'margin-bottom' : '';

	// $placement = ( $data['placement'] === 'mobile' ) ? 'mobile-only' : '';
	// $placement = ( $data['placement'] === 'desktop' ) ? 'desktop-only' : '';

	if ($data['placement'] == 'mobile') {
		$placement = 'mobile-only';
	} else if ($data['placement'] == 'desktop') {
		$placement = 'desktop-only';
	} else {
		$placement = '';
	}

	// return $data['placement'];

	$class = ($data['class'] == false) ? '' : $data['class'];

	$standard = '<ins class="adsbygoogle" style="display:inline-block;max-width: 100%;' . $style . '" data-ad-client="' . $ad_client . '" data-ad-slot="' . $slot_id . '" data-full-width-responsive="true"></ins> <script> (adsbygoogle = window.adsbygoogle || []).push({}); </script>';
	$amp = '<amp-ad layout="fixed" width="300" height="' . $h . '" type="adsense" data-ad-client="' . $ad_client . '" data-ad-slot="' . $amp_slot_id . '"></amp-ad>';

	if ( $data['ad_id'] == 'inarticle_1' ) {
		$standard = '<ins class="adsbygoogle" style="display:block; text-align:center;" data-ad-layout="in-article" data-ad-format="fluid" data-ad-client="' . $ad_client . '" data-ad-slot="' . $slot_id . '"></ins> <script> (adsbygoogle = window.adsbygoogle || []).push({}); </script>';
		// $amp = '<amp-ad width=336 height=280 type="doubleclick" data-slot="/15748617,31989200/Punchngcom/Punchngcom-AMP-Rectangle-Mid" data-multi-size="320x240,320x100,320x50,300x250,300x100,300x50"> rtc-config=\'{ "vendors": { "aps": {"PUB_ID": "600", "PUB_UUID": "d02f0482-a50f-427c-ac01-9856371f1f6b", "PARAMS":{"amp":"1"}} }}\'> </amp-ad>';
		$amp = '<amp-ad width="300" height="320" type="adsense" data-ad-client="' . $ad_client . '" data-ad-slot="' . $amp_slot_id . ' data-auto-format="rspv" data-full-width=""> <div overflow=""></div> </amp-ad>';
	}
	if ( $data['ad_id'] == 'inarticle_2' ) {
		$standard = '<ins class="adsbygoogle" style="display:block; text-align:center;" data-ad-layout="in-article" data-ad-format="fluid" data-ad-client="' . $ad_client . '" data-ad-slot="' . $slot_id . '"></ins> <script> (adsbygoogle = window.adsbygoogle || []).push({}); </script>';
		$amp = '<amp-ad width=336 height=280 type="doubleclick" data-slot="/15748617,31989200/Punchngcom/Punchngcom-AMP-Rectangle-Mid" data-multi-size="320x240,320x100,320x50,300x250,300x100,300x50" rtc-config=\'{ "vendors": { "aps": {"PUB_ID": "600", "PUB_UUID": "d02f0482-a50f-427c-ac01-9856371f1f6b", "PARAMS":{"amp":"1"}} }}\'> </amp-ad>';
		// $amp = '<amp-ad width="300" height="320" type="adsense" data-ad-client="' . $ad_client . '" data-ad-slot="' . $amp_slot_id . ' data-auto-format="rspv" data-full-width=""> <div overflow=""></div> </amp-ad>';
	}

	if ($data['ad_id'] == 'responsive_1') {
		$standard = '<ins class="adsbygoogle" style="display:block; text-align:center;" data-ad-client="' . $ad_client . '" data-ad-slot="' . $slot_id . '" data-ad-format="auto" data-full-width-responsive="true"></ins> <script> (adsbygoogle = window.adsbygoogle || []).push({}); </script>';
		$amp = '<amp-ad width="300" height="' . $h . '" type="adsense" data-ad-client="' . $ad_client . '" data-ad-slot="' . $amp_slot_id . ' data-auto-format="rspv" data-full-width=""> <div overflow=""></div> </amp-ad>';
	}

	if ($data['ad_id'] == 'multiplex') {
		$standard = '<ins class="adsbygoogle" style="display:block; text-align:center;" data-ad-format="autorelaxed" data-ad-client="' . $ad_client . '" data-ad-slot="' . $slot_id . '"></ins> <script> (adsbygoogle = window.adsbygoogle || []).push({}); </script>';
		$amp = '<amp-ad width="300" height="' . $h . '" type="adsense" data-ad-client="' . $ad_client . '" data-ad-slot="' . $amp_slot_id . ' data-auto-format="mcrspv" data-full-width=""> <div overflow=""></div> </amp-ad>';
	}
	if( $data['ad_id'] == 'half_page' ) {
	    $standard = '<ins class="adsbygoogle" style="display:inline-block;width:300px;height:600px" data-ad-client="'.$ad_client.'" data-ad-slot="'.$slot_id.'"></ins> <script> (adsbygoogle = window.adsbygoogle || []).push({}); </script>';
		$amp = '<amp-ad layout="fixed" width="300" height="600" type="adsense" data-ad-client="'.$ad_client.'" data-ad-slot="'.$slot_id.'"></amp-ad>';
	}

	// return '===================================================adsense <br/>';
	return '<div class="ad-container ' . $placement . ' ' . $mt . ' ' . $mb . ' ' . $class . '"> ' . $standard . ' ' . $amp . ' </div>';
}
add_shortcode('adsense', 'adsense_function');
