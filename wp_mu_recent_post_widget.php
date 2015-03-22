<?php
/*
Plugin Name: Recent post from sub site
Version: 0.1-alpha
Description: This plugin outputs in widget recent post from subsites of multisite.
Author: Maxim Seliverstov
Author URI: github.com/seliverstov-maxim
Plugin URI: github.com/seliverstov-maxim/wpmu-recent-posts
Text Domain: wp_mu_recent_post_widget
Domain Path: /languages
*/

$base = plugin_dir_path(__FILE__);
require_once(join(DIRECTORY_SEPARATOR, array($base, 'lib', 'recent_post_widget.php')));

add_action('widgets_init', 'register_recent_post_widget');
function register_recent_post_widget() {
  if(is_multisite()){
    register_widget('RecentPostWidget');
  }
}
