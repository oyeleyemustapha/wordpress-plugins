<?php

add_filter('theme_page_templates', 'add_disqus_payload_template');
add_filter('theme_page_templates', 'add_category_payload_template');

function add_category_payload_template($templates)
{
    $templates[plugin_dir_path(__FILE__) . 'templates/mobile-app-category-payload.php'] = __('MobileApp Category payload', 'mobile-app-category-payload');

    return $templates;
}

function add_disqus_payload_template($templates)
{
    $templates[plugin_dir_path(__FILE__) . 'templates/mobile-app-disqus-payload.php'] = __('Disqus payload', 'disqus-payload');

    return $templates;
}
