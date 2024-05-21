<?php

/**
 * Template Name: #Disqus Payload
 *
 * This is the Disqus payload for the InApp comment.
 *
 * @since  v1.0.0
 * @package Backbone Plugin
 */


if( isset($_GET['slug']) && isset($_GET['id']) ) {
    $slug = $_GET['slug']; $post_id = $_GET['id'];
    echo "<div id='disqus_thread'></div>
        <script>
            var disqus_config = function () {
                this.page.url = 'https://punchng.com/$slug/'; 
                this.page.identifier = $post_id;
            };
            (function() {  // DON'T EDIT BELOW THIS LINE
                var d = document, s = d.createElement('script');
                
                s.src = 'https://punchmobile.disqus.com/embed.js';
                
                s.setAttribute('data-timestamp', +new Date());
                (d.head || d.body).appendChild(s);
            })();
        </script>";
} else {
    echo 'Invalid Request!';
}

?>