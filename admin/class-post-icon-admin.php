<?php

class PostIcon_Admin {

    public function __construct() {
 
        add_action("admin_menu", array($this, "options_page"));
        add_action("admin_init", array($this, "post_icon_plugin_settings_init"));
        
    }
    
    public function options_page(){
		add_options_page(
			"Post icon",
			"Post icon",
			"manage_options",
			"posticon",
			array($this, 'render')
        );
    }
    
    public function post_icon_plugin_settings_init(){
        register_setting( 'post-icon-settings-group', 'post_icon_plugin_settings' );

        add_settings_section(
            'post_icon_section',
            __( 'Налаштування плагіну', 'wordpress' ),
            array($this, "post_icon_settings_section_callback"),
            'post-icon-settings-page'
        );

        add_settings_field(
            'post_icon_status',
            __( 'Статус', 'wordpress' ),
            array($this, 'post_icon_status_render'),
            'post-icon-settings-page',
            'post_icon_section'
        );

        add_settings_field(
            'post_icon_posts',
            __( 'Пости', 'wordpress' ),
            array($this, 'post_icon_posts_render'),
            'post-icon-settings-page',
            'post_icon_section'
        );

        add_settings_field(
            'post_icon_icon',
            __( 'Іконка', 'wordpress' ),
            array($this, 'post_icon_icon_render'),
            'post-icon-settings-page',
            'post_icon_section'
        );

        add_settings_field(
            'post_icon_position',
            __( 'Позиція іконки', 'wordpress' ),
            array($this, 'post_icon_position_render'),
            'post-icon-settings-page',
            'post_icon_section'
        );

    }

    public function post_icon_status_render() {
        $val = get_option('post_icon_plugin_settings');
        $val = $val ? $val['post_icon_status'] : null;
        ?>
            <label>
                <input type="checkbox" name="post_icon_plugin_settings[post_icon_status]" value="1" <?php checked( 1, $val ) ?> />
                Активний
            </label>
        <?php
    }

    public function post_icon_posts_render(){
        $options = get_option('post_icon_plugin_settings');
        $opt_posts = $options['post_icon_posts'];
        $posts = get_posts(
            array(
            'numberposts' => -1
           )
        );

        echo '<ul class="cat-checklist category-checklist">';
        foreach($posts as $post){
            $checked = (array_key_exists($post->ID, $opt_posts)) ? 'checked="checked""' : '';
            echo '<li class="popular-category"><label class="selectit">';
            echo '<input value="1" type="checkbox" name="post_icon_plugin_settings[post_icon_posts][' . $post->ID . ']" ' . $checked  . '>';
            echo $post->post_title . '</label></li>';
        }
        echo '</ul>';
    }

    public function post_icon_icon_render(){
        $options = get_option('post_icon_plugin_settings');
        echo '<input name="post_icon_plugin_settings[post_icon_icon]" size="40" type="text" value="' . $options['post_icon_icon'] . '" />';
    }

    public function post_icon_position_render() {
        $options = get_option('post_icon_plugin_settings');
        ?>
        <select name='post_icon_plugin_settings[post_icon_position]'>
            <option value='before' <?php selected( $options['post_icon_position'], 'before' ); ?>>Зліва</option>
            <option value='after' <?php selected( $options['post_icon_position'], 'after' ); ?>>Справа</option>
        </select>
    
    <?php
    }

    public function post_icon_settings_section_callback(  ) {
        echo __( '', 'wordpress' );
    }

	public function render(){
		require plugin_dir_path( dirname( __FILE__ ) ) . 'admin/view/view-post-icon-admin.php';
    }

}