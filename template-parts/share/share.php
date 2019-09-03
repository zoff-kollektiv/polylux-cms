<?php

global $wp;

$current_url = esc_url(home_url($wp->request));
$title = get_the_title();

$twitter_url =
    'https://twitter.com/intent/tweet?text=' .
    urlencode($title . ' ' . $current_url);
$facebook_url =
    'https://www.facebook.com/sharer/sharer.php?u=' . urlencode($current_url);

get_component('social/social', [
    'title' => 'Teilen auf',
    'twitter_url' => $twitter_url,
    'facebook_url' => $facebook_url
]);

?>
