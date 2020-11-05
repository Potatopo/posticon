<?php

/*
Plugin Name: Post Icon
Description: Test task Post Icon
Version: 1.0
Author: Anton Gryschuk
*/

require plugin_dir_path( __FILE__ ) . 'inc/class-post-icon.php';

function run_posticon() {
    
	$plugin = new PostIcon();
	$plugin->run();

}
run_posticon();