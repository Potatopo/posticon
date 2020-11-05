<?php

class PostIcon_Public {

    public function __construct(){

        $this->checkStatus();

    }
    
    public function checkStatus(){
        $status = get_option('post_icon_plugin_settings')['post_icon_status'];
        if($status)
            $this->addIconPublic();
        
    }

    public function addIconPublic(){

        add_filter( 'the_title', array($this, 'add_icon_to_page_title'), 10, 2 );

    }

    public function add_icon_to_page_title( $title, $id = null ) {
        $options = get_option('post_icon_plugin_settings');

        if( array_key_exists($id, $options['post_icon_posts']) ){
            if($options['post_icon_position'] == 'before'){
                $title = '<span class="dashicons ' . $options['post_icon_icon'] . '"></span> ' . $title;
            } elseif($options['post_icon_position'] == 'after'){
                $title = $title . '<span class="dashicons ' . $options['post_icon_icon'] . '"></span> ';
            }
        }
    
        return $title;
    }

}