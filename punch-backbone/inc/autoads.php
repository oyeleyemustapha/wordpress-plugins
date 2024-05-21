<?php

/**
 * This handels the auto ads insertion for the articles 
*/
function auto_insert_ads($content) {

    if( is_single() ) { //prevent in article ads from showing on non-article page

        global $post;
        if($post->ID==1565271){
            return $content;
        }
        else{
            $contents = explode( '</p>', $content );
            $parsed_article = '';
            $i = 1;
            $display_ads_index = 1;
            $admanager_index = 2;
            
            $last_index = count( $contents ) - 1;

            if( ($last_index <  8) && ($last_index > 3) ) {
                $parsed_article = $content.''.do_shortcode('[adsense ad_id="inarticle_1"]');
            } else {

                global $post;
                $cats = wp_get_post_categories($post->ID, array( 'fields' => 'slugs' ) );
                foreach($contents as $chunk) {
                    $parsed_article .= $chunk;

                    if( $i == 4 ) {

                        $bc_text_link = get_post_meta(get_the_ID(), '_bc_text_link', true);

                        if( !empty( $bc_text_link )) {
                            $parsed_article .= "<div style='border-top: 1px dotted #9d9d9d; border-bottom: 1px dotted #9d9d9d; padding-top: 0.5em; padding-bottom: 0.5em;'> 
                                                    <ul>
                                                        <li>". $bc_text_link ."</li> 
                                                    </ul>
                                                </div>";
                        }


                        if( in_array('sports', $cats) ) {
                            $parsed_article .= '<div class="bc-widget margin-top margin-bottom" style="border-top: 1px solid #9d9d9d; border-bottom: 1px solid #9d9d9d; padding-top: 0.5em; padding-bottom: 0.5em;">
                                                    <div id="betsense" class="bc-placeholder"></div>
                                                    <script async defer src="https://dtokw98w8oklz.cloudfront.net/build.js"></script>
                                                </div> ';
                        }

                        if( !in_array('betting', $cats) ) {
                            // $parsed_article .= '-----------'.json_encode( $cats );
                            if( in_array('news', $cats) || in_array('metro-plus', $cats) || in_array('featured', $cats) || in_array('punch-lite', $cats) ){
                                $parsed_article .= '<div style="margin-top: 1.5em; margin-bottom: 1.5em;" id="show360playvid" class="360playvidUnit"> </div>';
                                $parsed_article .= '<amp-video-iframe src="https://360playvid.info/slidepleer/videoIframe.html?fn=s1184s" width="16" height="9" layout="responsive" dock="#pv-dock-slot" style=" overflow: visible !important;"> </amp-video-iframe>
                                                        <div style="left: 10px; position: fixed; bottom: 80px;">
                                                        <amp-layout
                                                                width="256"
                                                                height="144"
                                                                id="pv-dock-slot">
                                                        </amp-layout>
                                                        </div>';
                                // echo do_shortcode('[admanager ad_id="outstream_video"]');
                                // $parsed_article .= do_shortcode('[admanager ad_id="outstream_video"]');
                            } elseif( in_array('business', $cats) ){
                                $parsed_article .= '<div id="lupon_placement"> </div>';
                            } else {
                                $parsed_article .= '<div style="margin-top: 1.5em; margin-bottom: 1.5em;" id="show-primis-ads" class="primisVideoUnit"> </div>';
                                    // if( amp_is_request()){
                                        $parsed_article .= '<div style="margin-top: 1.5em; margin-bottom: 1.5em;" class="primisVideoUnit">

                                            <!-- Insert this to the BODY section where the docking player should render -->
                                            <style>.amp-video-docked-dismiss {transform: translate(13.5px, -31px) !important; pointer-events:all!important;}</style>
                                            <amp-video-iframe src="https://live.primis-amp.tech/content/video/amp/videoIframe.php?s=113240" width="16" height="9" layout="responsive" dock="#primis-dock-slot">
                                            </amp-video-iframe>
                                            <div style="right: 1px; position: fixed; bottom: 101px;"><amp-layout width="213" height="120" id="primis-dock-slot"></amp-layout></div>
                                        </div>';
                                // }

                            }
                            
                        }

                        

                    }

                    // if( $i == 15) {
                    //     if( in_array('betting', $cats) ) {
                    //         $parsed_article .= '<div id="betsense" class="bc-placeholder"></div> <script async defer src="https://dtokw98w8oklz.cloudfront.net/build.js"></script>';
                    //     }
                    // }

                    // if( $i == 4 && ( !in_array('betting', $cats) || !has_post_format( 'video' ) )  ) {


                    //     if ( in_array('sports', $cats  ) ) { 
                    //         $parsed_article .= '<div class="bc-widget margin-top margin-bottom">
                    //                                 <script type="text/javascript" src="https://borgjs.igaming-warp-service.io/borg.js"  data-borg-campaign-id="clgyyjwik3gr20auhkt0ove2a" defer></script>
                    //                                 <div id="borg-elm-o3qsqhfjsj" layout="" style="height: 320px"></div>
                    //                             </div>';

                    //     }
                    //     if( in_array('betting', $cats) ){
                    //         $parsed_article .= '-----------'.json_encode( $cats );
                    //         // $parsed_article .= '<div style="margin-top: 1.5em; margin-bottom: 1.5em;" id="show-primis-ads" class="primisVideoUnit"> </div>';
                    //     }

                    //         // $parsed_article .= '<div class="avantis-incontent"> </div>';
                    //         // $parsed_article .= '<div style="margin-top: 1.5em; margin-bottom: 1.5em;" class="primisVideoUnit"> 
                    //         // <script type="text/javascript" language="javascript" src="https://live.primis.tech/live/liveView.php?s=110622&cbuster=%%CACHEBUSTER%%" defer></script> </div>';

                    //         //this is a test implemeantation for primis
                    //         // $parsed_article .= '<div style="margin-top: 1.5em; margin-bottom: 1.5em;" id="show-primis-ads" class="primisVideoUnit"> </div>';


                            

                    //         // $parsed_article.='<div style="margin-top: 1em;"> <div class="OUTBRAIN" data-src="'.esc_url(get_the_permalink(get_the_ID())).'" data-widget-id="AR_2"></div> <script type="text/javascript" async="async" src="//widgets.outbrain.com/outbrain.js"></script><amp-embed width="100" height="100" type="outbrain" layout="responsive" data-widgetIds="AMP_2" data-block-on-consent></amp-embed></div>';
                    //     // }
                    // }

                    if( ($i%7) === 0 ) {

                        if( (in_array('investigations', $cats) ) || (in_array('betting', $cats)) ){ 
                            // return $parsed_article;
                        }else {
                            // if( $display_ads_index == 1 ) {
                            //     $parsed_article .=  do_shortcode('[admanager ad_id="outstream_video"]');

                            // } else {
                                if( ad_type( $display_ads_index ) == 'admanager' ){
                                
                                    if( $admanager_index <= 4 ) {
                                        // $parsed_article .=  do_shortcode('[admanager ad_id="desktop_'.$admanager_index.'" placement="desktop"]');
                                        // $parsed_article .= do_shortcode('[admanager ad_id="mobile_'.$admanager_index.'" placement="mobile"]');
                                        if( $admanager_index == 3 ) {
                                            $parsed_article.='<div style="margin-top: 2em; margin-bottom:2em;"> <div class="OUTBRAIN" data-src="'.esc_url(get_the_permalink(get_the_ID())).'" data-widget-id="AR_2"></div> <amp-embed width="100" height="100" type="outbrain" layout="responsive" data-widgetIds="AMP_2" data-block-on-consent></amp-embed></div>';
                                        } else if( $admanager_index == 4 ) {
                                            $parsed_article .=  do_shortcode('[admanager ad_id="desktop_3" placement="desktop"]');
                                            $parsed_article .= do_shortcode('[admanager ad_id="mobile_3" placement="mobile"]');
                                        } else {
                                            $parsed_article .=  do_shortcode('[admanager ad_id="desktop_'.$admanager_index.'" placement="desktop"]');
                                            $parsed_article .= do_shortcode('[admanager ad_id="mobile_'.$admanager_index.'" placement="mobile"]');
                                        }
                                    } else {
                                        $parsed_article .= do_shortcode('[adsense ad_id="inarticle_2"]');
                                    }
                                   
                                    $admanager_index++;
        
                                } else {
        
                                    $parsed_article .= do_shortcode('[adsense ad_id="inarticle_2"]');
        
                                }
                            // }
                            $display_ads_index++;
                        }
                    }
                    $i++;
                }
            }

            if ( ($last_index  > 10) && ( $last_index < 14)){
                if( (in_array('investigations', $cats) ) || (in_array('betting', $cats)) ){ } else {

                    $parsed_article .=  do_shortcode('[admanager ad_id="desktop_'.$admanager_index.'" placement="desktop"]');
                    $parsed_article .= do_shortcode('[admanager ad_id="mobile_'.$admanager_index.'" placement="mobile"]');

                }
            }
            return $parsed_article;
        }

        
    }

    return $content;
}
add_filter( 'the_content', 'auto_insert_ads', 99, 1 );

function table_of_content($content){

    global $post;
    $cats = wp_get_post_categories($post->ID, array( 'fields' => 'slugs' ) );

    if( in_array('betting', $cats)  ) {
        
        $links = [];
        $parsed_article = "";
        // echo $parsed_article;

        $pattern = '#(?P<full_tag><(?P<tag_name>h\d)(?P<tag_extra>[^>]*)>(?P<tag_contents>[^<]*)</h\d>)#i';
        if ( preg_match_all( $pattern, $content, $matches, PREG_SET_ORDER ) ) {
            $find = array();
            $replace = array();
            foreach( $matches as $match ) {
                if ( strlen( $match['tag_extra'] ) && false !== stripos( $match['tag_extra'], 'id=' ) ) {
                    continue;
                }
                $find[]    = $match['full_tag'];
                $id        = sanitize_title( $match['tag_contents'] );
                $id_attr   = sprintf( ' id="%s"', $id );
                $replace[] = sprintf( '<%1$s%2$s%3$s>%4$s</%1$s>', $match['tag_name'], $match['tag_extra'], $id_attr, $match['tag_contents']);
                array_push($links, $id );
            }
            $content = str_replace( $find, $replace, $content );
        }


        preg_match_all( '@<h2.*?>(.*?)<\/h2>@', $content, $matches );  
        $tags = $matches[1];
        $i = 0;
        if ($tags){
            $parsed_article .= "<div> <strong> Jump To </strong> <ul data-bs-toggle='collapse'>";
            foreach( $tags as $tag ){
                $parsed_article .= '<li> <a href="#'.$links[$i].'"> '.$tag.' </a> </li>';
                $i++;
            }
            $parsed_article .= "</ul> </div>";

        }
    }

    // echo json_encode( $links );
    $parsed_article .= $content;
    return $parsed_article;

}
// add_filter( 'the_content', 'table_of_content', 99, 1 );


function ad_type( $index ) { 
    if( ( $index%2 ) == 0) {
        return 'adsense';
    }
    return 'admanager';
    
}