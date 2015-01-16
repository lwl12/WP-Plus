<?php
/*
Plugin Name: wp-plus
Plugin URI: http://blog.lwl12.com/wp-plus/
Description: 博客多功能增强插件
Author: liwanglin12
Author URI: http://lwl12.com
Version: 0.2
*/

if ( ! defined( 'ABSPATH' ) ) exit;

define( 'WP_NPROGRESS_PLUGIN_URL', plugin_dir_url( __FILE__ ) );


/* 添加插件控制面板*/
function register_plugin_settings_link($links) { 
  $settings_link = '<a href="options-general.php?page=wp_plus">设置</*a>'; 
  array_unshift($links, $settings_link); 
  return $links; 
}
$plugin = plugin_basename(__FILE__); 
add_filter("plugin_action_links_{$plugin}", 'register_plugin_settings_link' );


/* 配置插件设置*/
if( is_admin() ) {
    add_action('admin_menu', 'wp_plus_menu');
}

/*配置插件设置*/
function wp_plus_menu() {
    add_options_page('WP Plus + 插件控制面板', 'WordPress Plus', 'administrator','wp_plus', 'pluginoptions_page');

}

/* 插件设置核心部分*/
function pluginoptions_page()
{
	if ( $_POST['update_pluginoptions'] == 'true' ) { pluginoptions_update(); }
?>
<div class="wrap">
<h2>WP Plus 插件控制面板</h2>
<h3>欢迎使用WP Plus插件，请按需调整插件功能！</h3>
<form method="POST" action="">
<input type="hidden" name="update_pluginoptions" value="true" />
<input type="checkbox" name="jdt" id="jdt" <?php echo get_option('mytheme_jdt'); ?> /> 启用“加载进度条”功能<p>
<input type="checkbox" name="glgjt" id="glgjt" <?php echo get_option('mytheme_glgjt'); ?> /> 启用“隐藏管理工具条”功能<p>
<input type="checkbox" name="gravatar" id="gravatar" <?php echo get_option('mytheme_gravatar'); ?> /> 启用“gravatar替换到typcn镜像”功能<p>
<input type="checkbox" name="google" id="google" <?php echo get_option('mytheme_google'); ?> /> 启用“替换google相关资源”功能<p>
<input type="checkbox" name="wryh" id="wryh" <?php echo get_option('mytheme_wryh'); ?> /> 启用“变更后台字体为微软雅黑”功能<p>
</form>
</div>
<?php
}
/* 插件设置验证*/
function pluginoptions_update()
{
/* 插件设置验证*/
if ($_POST['jdt']=='on') { $display = 'checked'; } else { $display = ''; }
update_option('mytheme_jdt', $display);
if ($_POST['glgjt']=='on') { $display = 'checked'; } else { $display = ''; }
update_option('mytheme_glgjt', $display);
if ($_POST['gravatar']=='on') { $display = 'checked'; } else { $display = ''; }
update_option('mytheme_gravatar', $display);
if ($_POST['google']=='on') { $display = 'checked'; } else { $display = ''; }
update_option('mytheme_google', $display);
if ($_POST['wryh']=='on') { $display = 'checked'; } else { $display = ''; }
update_option('mytheme_wryh', $display);
}
?>
<?php if ( get_option('mytheme_jdt') == 'checked') { ?>
<?php
function wpn_enqueue() {
	wp_enqueue_style( 'nprogresss', WP_NPROGRESS_PLUGIN_URL . 'nprogress.css' );

	wp_enqueue_script( 'nprogress', WP_NPROGRESS_PLUGIN_URL . 'nprogress.js', array( 'jquery' ), '0.1.2', true );
	wp_enqueue_script( 'wp-nprogress', WP_NPROGRESS_PLUGIN_URL . 'global.js', array( 'jquery', 'nprogress' ), '0.0.1', true );
}
add_action( 'wp_enqueue_scripts', 'wpn_enqueue' );
?>
<?php } ?>
<?php if ( get_option('glgjt') == 'checked') { ?>
<?php
show_admin_bar(false);
?>
<?php } ?>
<?php if ( get_option('gravatar') == 'checked') { ?>
<?php
function ty_avatar($avatar) { 
$avatar = str_replace(array("www.gravatar.com","0.gravatar.com","1.gravatar.com","2.gravatar.com"),"gravatar.eqoe.cn",$avatar);
return $avatar; 
} 
add_filter( 'get_avatar', 'ty_avatar', 10, 3 ); 
?>
<?php } ?>
<?php if ( get_option('google') == 'checked') { ?>
<?php
function devework_replace_open_sans() {
	wp_deregister_style('open-sans');
	wp_register_style( 'open-sans', '//fonts.useso.com/css?family=Open+Sans:300italic,400italic,600italic,300,400,600' );
	wp_enqueue_style( 'open-sans');
	if(is_admin()) wp_enqueue_style( 'open-sans');
}
add_action( 'wp_enqueue_scripts', 'devework_replace_open_sans' );
add_action('admin_enqueue_scripts', 'devework_replace_open_sans');
add_action( 'init', 'devework_replace_open_sans' );
?>
<?php } ?>
<?php if ( get_option('wryh') == 'checked') { ?>
<?php
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
<?php } ?>