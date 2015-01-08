<?php
/*
Plugin Name: 博客多功能增强插件
Plugin URI: http://lwl12.com
Description: 博客多功能增强插件
Author: liwanglin12
Author URI: http://lwl12.com
Version: 0.0.1
*/

if ( ! defined( 'ABSPATH' ) ) exit;

define( 'WP_NPROGRESS_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

/**
 * Enqueue styles and scripts to `head'.
 *
 * @since 0.0.1
 */

//进度条
function wpn_enqueue() {
	wp_enqueue_style( 'nprogresss', WP_NPROGRESS_PLUGIN_URL . 'nprogress.css' );

	wp_enqueue_script( 'nprogress', WP_NPROGRESS_PLUGIN_URL . 'nprogress.js', array( 'jquery' ), '0.1.2', true );
	wp_enqueue_script( 'wp-nprogress', WP_NPROGRESS_PLUGIN_URL . 'global.js', array( 'jquery', 'nprogress' ), '0.0.1', true );
}

add_action( 'wp_enqueue_scripts', 'wpn_enqueue' );


//隐藏管理工具条
show_admin_bar(false);

//修改头像到镜像网站
function mytheme_get_avatar($avatar) {
$avatar = str_replace(array("www.gravatar.com","0.gravatar.com","1.gravatar.com","2.gravatar.com"),"gravatar.duoshuo.com",$avatar);
return $avatar;
}
add_filter( 'get_avatar', 'mytheme_get_avatar', 10, 3 );

//替换google相关资源
function izt_cdn_callback($buffer) {
	return str_replace('googleapis.com', 'useso.com', $buffer);
}
function izt_buffer_start() {
	ob_start("izt_cdn_callback");
}
function izt_buffer_end() {
	ob_end_flush();
}
add_action('init', 'izt_buffer_start');
add_action('shutdown', 'izt_buffer_end');

