<?php
/*
Plugin Name: 博客多功能增强插件
Plugin URI: http://blog.lwl12.com/wp-plus/
Description: 博客多功能增强插件
Author: liwanglin12
Author URI: http://lwl12.com
Version: 0.2
*/

if ( ! defined( 'ABSPATH' ) ) exit;

define( 'WP_NPROGRESS_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

//进度条

function wpn_enqueue() {
	wp_enqueue_style( 'nprogresss', WP_NPROGRESS_PLUGIN_URL . 'nprogress.css' );

	wp_enqueue_script( 'nprogress', WP_NPROGRESS_PLUGIN_URL . 'nprogress.js', array( 'jquery' ), '0.1.2', true );
	wp_enqueue_script( 'wp-nprogress', WP_NPROGRESS_PLUGIN_URL . 'global.js', array( 'jquery', 'nprogress' ), '0.0.1', true );
}

add_action( 'wp_enqueue_scripts', 'wpn_enqueue' );

//隐藏管理工具条
show_admin_bar(false);

//头像SSL加载
function get_ssl_avatar($avatar) {
   $avatar = preg_replace('/.*\/avatar\/(.*)\?s=([\d]+)&.*/','<img src="https://secure.gravatar.com/avatar/$1?s=$2" class="avatar avatar-$2" height="$2" width="$2">',$avatar);
   return $avatar;
}
add_filter('get_avatar', 'get_ssl_avatar');

//替换google相关资源到360前端库CDN
function devework_replace_open_sans() {
	wp_deregister_style('open-sans');
	wp_register_style( 'open-sans', '//fonts.useso.com/css?family=Open+Sans:300italic,400italic,600italic,300,400,600' );
	wp_enqueue_style( 'open-sans');
	if(is_admin()) wp_enqueue_style( 'open-sans');
}
add_action( 'wp_enqueue_scripts', 'devework_replace_open_sans' );
add_action('admin_enqueue_scripts', 'devework_replace_open_sans');
add_action( 'init', 'devework_replace_open_sans' );

// 修改后台字体为微软雅黑
function admin_fonts(){
    echo'<style type="text/css">
        * { font-family: "Microsoft YaHei" !important; }
        i, .ab-icon, .mce-close, i.mce-i-aligncenter, i.mce-i-alignjustify, i.mce-i-alignleft, i.mce-i-alignright, i.mce-i-blockquote, i.mce-i-bold, i.mce-i-bullist, i.mce-i-charmap, i.mce-i-forecolor, i.mce-i-fullscreen, i.mce-i-help, i.mce-i-hr, i.mce-i-indent, i.mce-i-italic, i.mce-i-link, i.mce-i-ltr, i.mce-i-numlist, i.mce-i-outdent, i.mce-i-pastetext, i.mce-i-pasteword, i.mce-i-redo, i.mce-i-removeformat, i.mce-i-spellchecker, i.mce-i-strikethrough, i.mce-i-underline, i.mce-i-undo, i.mce-i-unlink, i.mce-i-wp-media-library, i.mce-i-wp_adv, i.mce-i-wp_fullscreen, i.mce-i-wp_help, i.mce-i-wp_more, i.mce-i-wp_page, .qt-fullscreen, .star-rating .star { font-family: dashicons !important; }
        .mce-ico { font-family: tinymce, Arial !important; }
        .fa { font-family: FontAwesome !important; }
        .genericon { font-family: "Genericons" !important; }
        .appearance_page_scte-theme-editor #wpbody *, .ace_editor * { font-family: Monaco, Menlo, "Ubuntu Mono", Consolas, source-code-pro, monospace !important; }
        .post-type-post #advanced-sortables, .post-type-post #autopaging .description { display: none !important; }
        .form-field input, .form-field textarea { width: inherit; border-width: 0; }
        </style>';
}
add_action('admin_head', 'admin_fonts');

?>