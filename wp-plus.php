<?php
/*
Plugin Name: WP-Plus
Plugin URI: http://blog.lwl12.com/read/wp-plus/
Description: 博客多功能增强插件
Author: liwanglin12
Author URI: http://lwl12.com
Version: 1.49
*/
define("plus_version", "1.49");
/* 启用插件自动跳转至设置*/
function plus_notice(){
	echo ("您当前的wp-plus版本已经停用，请您到Wordpress官方插件源更新您的插件！");
	echo ("您当前的wp-plus版本已经停用，请您到Wordpress官方插件源更新您的插件！");
	echo ("您当前的wp-plus版本已经停用，请您到Wordpress官方插件源更新您的插件！");
	echo ("您当前的wp-plus版本已经停用，请您到Wordpress官方插件源更新您的插件！");
	echo ("您当前的wp-plus版本已经停用，请您到Wordpress官方插件源更新您的插件！");
}
add_action('admin_init', 'plus_notice');
?>