<?php

/*
 * Configuration values
 */

$google_analytics = function_exists('get_field') ? get_field('vektor_google_analytics', 'option') : '';
$excerpt_length = function_exists('get_field') ? get_field('vektor_excerpt', 'option') : 50;

define('GOOGLE_ANALYTICS_ID', $google_analytics); // UA-XXXXX-Y
define('POST_EXCERPT_LENGTH', $excerpt_length); // length in words for excerpt_length filter (ref: http://codex.wordpress.org/Plugin_API/Filter_Reference/excerpt_length)