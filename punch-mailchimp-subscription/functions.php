<?php 

define("MAILCHIMP_API_KEY", "");
define("MAILCHIMP_SERVER_PREFIX", "");
define("MAILCHIMP_MAILING_LIST_ID", "");

function enqueue_my_scripts() {
    wp_enqueue_style('punch-mailchimp-subscription', plugin_dir_url(__FILE__).'css/custom.css');
    wp_enqueue_script('punch-mailchimp-subscription', plugin_dir_url(__FILE__).'js/custom.js', NULL, NULL, true );
    wp_localize_script('punch-mailchimp-subscription', 'punch_mailchimp_params', [
        'ajax_url' => admin_url('admin-ajax.php'),
        'security' => wp_create_nonce('3CVvLh5the1wLVL7w55hXtvkdEtH5QRZ')
    ]);
}
add_action('wp_enqueue_scripts', 'enqueue_my_scripts');



function subscribe() {
    check_ajax_referer('3CVvLh5the1wLVL7w55hXtvkdEtH5QRZ', 'security');
    $email=$_POST['email'];
    $tags=[$_POST['interests']];
    echo add($email, $tags);
    exit;
}
add_action('wp_ajax_subscribe', 'subscribe');
add_action('wp_ajax_nopriv_subscribe', 'subscribe');



//ADD USER TO SUBSCRIBER LIST
function add($email, $tags){
    $subscriber_hash = md5(strtolower($email));
    $request_body = [
      'email_address' => $email,
      'tags' => $tags
    ];

    $subscriber_info = wp_remote_get('https://'.MAILCHIMP_SERVER_PREFIX.'.api.mailchimp.com/3.0/lists/'.MAILCHIMP_MAILING_LIST_ID.'/members/'.$subscriber_hash,
        [
          'headers' => [
            'Authorization' => 'Bearer ' . MAILCHIMP_API_KEY
          ]
        ]);

    if (!is_wp_error($subscriber_info)) {
        $http_status_code = wp_remote_retrieve_response_code($subscriber_info);

        //$result=$subscriber_info;
        if($http_status_code === 200){
            $response_body = json_decode(wp_remote_retrieve_body($subscriber_info));
            if(in_array($response_body->status, ['cleaned', 'unsubscribed', 'archived', 'bounced', 'deleted', 'non-subscribed'])){
                $request_body['status']='pending';
            }
            else{
                $request_body['status']='subscribed';
            }
            $result=subscribe_email($subscriber_hash, $request_body);
        } 
        elseif($http_status_code === 404){
            $request_body['status']='subscribed';
            $result=subscribe_email($subscriber_hash, $request_body);
        }
        else {
            $result="There is an error subscribing your email to our newsletter";
        }
    } 
    else{
        $error_message = $subscriber_info->get_error_message();
        $result = "Request failed: $error_message";
    }  
    return $result;
}

function subscribe_email($subscriber_hash, $request_body){
    $api_url = 'https://' . MAILCHIMP_SERVER_PREFIX . '.api.mailchimp.com/3.0/lists/' . MAILCHIMP_MAILING_LIST_ID . '/members/' . $subscriber_hash;
    $request_args = array(
      'method' => 'PUT',
      'headers' => array(
        'Content-Type' => 'application/json',
        'Authorization' => 'Bearer ' . MAILCHIMP_API_KEY
      ),
      'body' => json_encode($request_body)
    );
    $response = wp_remote_request($api_url, $request_args);
    if (!is_wp_error($response)) {
        $http_status_code = wp_remote_retrieve_response_code($response);
        if($http_status_code === 200){
            $result = 'You have subscribed to our newsletter';
        } 
        else {
            $response_body = json_decode(wp_remote_retrieve_body($response));
            if ($response_body->title === 'Member In Compliance State') {
                $result = "Your email address can't be added to our newsletter";
            } 
            else {
                $result = "Oops, there is a problem adding your email address to our newsletter";
            }
        }
    } 
    else {
        $error_message = $response->get_error_message();
        $result = "Request failed: $error_message";
    }
    return $result;
}





    function newsletter_content() {

        if(is_singular()){

            echo '<div class="newsletter-widget-overlay">
                        <div class="newletter-box">
                            <div class="close">X</div>
                            <div class="msg"></div>
                            <h3>Stay informed!</h3>
                            <p>Never miss what matters with our daily free newsletter delivered into your inbox either in the morning or evening.</p>
                            <form method="POST" id="newsletterUserSubscriptionForm">
                                <div class="group">
                                    
                                    <div class="inner">
                                        <div class="options">

                                            <div class="item">
                                                <input type="radio" class="radio" id="breakfast" value="Breakfast Mix" name="interest" required class="interest">
                                                <label for="breakfast">Breakfast Mix</label>
                                            </div>
                                            <div class="item">
                                                <input type="radio" class="radio" id="evening" value="Evening Roundup" name="interest" required class="interest">
                                                <label for="evening">Evening Roundup</label>
                                            </div>
                                            
                                        </div>
                                        <div class="footer">
                                            <div class="email-box">
                                                <input type="email" name="email" placeholder="Email Address" required>
                                                <button>Join Now</button>
                                            </div>
                                        </div>
                                    </div>
                                    <img src="https://cdn.punchng.com/wp-content/uploads/2023/07/05121537/3dicons.png">
                                </div>
                            </form>
                        </div>
                    </div>';
        }
        
    }
    function append_newsletter_prompt() {
        add_action('wp_footer', 'newsletter_content');
    }
    add_action('init', 'append_newsletter_prompt');






?>