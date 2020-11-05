<?php

class PostIcon {

	public function __construct() {

		$this->load_dependencies();

    }
    
    private function load_dependencies() {

        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-post-icon-admin.php';
        $plugin_Admin = new PostIcon_Admin();

        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-post-icon-public.php';
        $plugin_Public = new PostIcon_Public();

    }
    
    //Entry point
    public function run() {

	}


}