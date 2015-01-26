<?php
/*
Plugin Name: WP-Plus
Plugin URI: http://blog.lwl12.com/wp-plus/
Description: 博客多功能增强插件
Author: liwanglin12
Author URI: http://lwl12.com
Version: 1.45
*/
define("plus_version", "1.45");
/*自动更新机制*/
function update()
{
    include_once 'updater.php';
    if (is_admin()) {
        $config = array(
            'slug' => plugin_basename(__FILE__),
            'proper_folder_name' => 'wp-plus',
            'api_url' => 'https://api.github.com/repos/liwanglin12/wp-plus',
            'raw_url' => 'https://raw.github.com/liwanglin12/wp-plus/master',
            'github_url' => 'https://github.com/liwanglin12/wp-plus',
            'zip_url' => 'https://github.com/liwanglin12/wp-plus/zipball/master',
            'sslverify' => true,
            'requires' => '4.1',
            'tested' => '4.1',
            'readme' => 'README.md',
            'access_token' => ''
        );
        new WP_GitHub_Updater($config);
    }
}
add_action('init', 'update');

/* 启用插件自动跳转至设置*/
register_activation_hook(__FILE__, 'plus_plugin_activate');
add_action('admin_init', 'plus_plugin_redirect');
function plus_plugin_activate()
{
    add_option('my_plugin_do_activation_redirect', true);
}
function plus_plugin_redirect()
{
    if (get_option('my_plugin_do_activation_redirect', false)) {
        delete_option('my_plugin_do_activation_redirect');
        wp_redirect(admin_url('options-general.php?page=wp_plus'));
    }
}

/* 添加插件控制面板*/
function register_plugin_settings_link($links)
{
    $settings_link = '<a href="options-general.php?page=wp_plus">设置</*a>';
    array_unshift($links, $settings_link);
    return $links;
}
$plugin = plugin_basename(__FILE__);
add_filter("plugin_action_links_{$plugin}", 'register_plugin_settings_link');


/* 配置插件设置*/
if (is_admin()) {
    add_action('admin_menu', 'wp_plus_menu');
}

/*配置插件设置*/
function wp_plus_menu()
{
    add_options_page('WP Plus 插件控制面板', 'WP Plus', 'administrator', 'wp_plus', 'pluginoptions_page');
    
}

/* 插件设置核心部分*/
function pluginoptions_page()
{
    if ($_POST['update_pluginoptions'] == 'true') {
        pluginoptions_update();
    }
?>
<div class="wrap">
<h2>WP Plus 插件控制面板</h2>
<h3>欢迎使用WP Plus插件，请按需调整插件功能！</h3>
<div id="message" class="updated"><p>WP-Plus <?php
    echo plus_version;
?>版本更新日志：</br>[新增]前台点击出现积分特效</br>[修复]强制开启微软雅黑功能的BUG</div>
<form method="POST" action="">
<input type="hidden" name="update_pluginoptions" value="true" />
<input type="checkbox" name="jdt" id="jdt" <?php
    echo get_option('wp_plus_jdt');
?> /> 启用“加载进度条”功能<p>
<input type="checkbox" name="glgjt" id="glgjt" <?php
    echo get_option('wp_plus_glgjt');
?> /> 启用“隐藏管理工具条”功能<p>
<input type="checkbox" name="gravatar" id="gravatar" <?php
    echo get_option('wp_plus_gravatar');
?> /> 启用“gravatar替换到铜芯科技镜像”功能<p>
<input type="checkbox" name="google" id="google" <?php
    echo get_option('wp_plus_google');
?> /> 启用“替换google相关资源”功能<p>
<input type="checkbox" name="wryh" id="wryh" <?php
    echo get_option('wp_plus_wryh');
?> /> 启用“变更后台字体为微软雅黑”功能（刷新后生效）<p>
<input type="checkbox" name="number" id="number" <?php
    echo get_option('wp_plus_number');
?> 
<input type="submit" class="button-primary" value="保存设置" /> &nbsp WP-Plus 版本 <?php
    echo plus_version;
?> &nbsp; 插件作者为 <a href="http://lwl12.com">liwanglin12</a> &nbsp; <a href="http://blog.lwl12.com/read/wp-plus">点击获取最新版本 & 说明
</form>
</div>
<?php
}
/* 插件设置验证*/
function pluginoptions_update()
{
    /* 插件设置验证*/
    if ($_POST['jdt'] == 'on') {
        $display = 'checked';
    } else {
        $display = '';
    }
    update_option('wp_plus_jdt', $display);
    if ($_POST['glgjt'] == 'on') {
        $display = 'checked';
    } else {
        $display = '';
    }
    update_option('wp_plus_glgjt', $display);
    if ($_POST['gravatar'] == 'on') {
        $display = 'checked';
    } else {
        $display = '';
    }
    update_option('wp_plus_gravatar', $display);
    if ($_POST['google'] == 'on') {
        $display = 'checked';
    } else {
        $display = '';
    }
    update_option('wp_plus_google', $display);
    if ($_POST['wryh'] == 'on') {
        $display = 'checked';
    } else {
        $display = '';
    }
    update_option('wp_plus_wryh', $display);
    if ($_post['number'] == 'on') {
        $display = 'checked';
    } else {
        $display = '';
    }
    update_option('wp_plus_number', $display);
    
}
?>

<?php
/*加载进度*/
if (get_option('wp_plus_jdt') == 'checked') {
?>
<?php
    if (!defined('ABSPATH'))
        exit;
    define('WP_NPROGRESS_PLUGIN_URL', plugin_dir_url(__FILE__));
    function wpn_enqueue()
    {
        wp_enqueue_style('nprogresss', WP_NPROGRESS_PLUGIN_URL . 'jdt/nprogress.css');
        
        wp_enqueue_script('nprogress', WP_NPROGRESS_PLUGIN_URL . 'jdt/nprogress.js', array(
            'jquery'
        ), '0.1.2', true);
        wp_enqueue_script('wp-nprogress', WP_NPROGRESS_PLUGIN_URL . 'jdt/global.js', array(
            'jquery',
            'nprogress'
        ), '0.0.1', true);
    }
    add_action('wp_enqueue_scripts', 'wpn_enqueue');
?>
<?php
}
?>
<?php
if (get_option('wp_plus_glgjt') == 'checked') {
?>
<?php
    show_admin_bar(false);
?>
<?php
}
?>

<?php
/*替换头像*/
if (get_option('wp_plus_gravatar') == 'checked') {
?>
<?php
    function ty_avatar($avatar)
    {
        $avatar = str_replace(array(
            "www.gravatar.com",
            "0.gravatar.com",
            "1.gravatar.com",
            "2.gravatar.com"
        ), "ssl-gravatar.eqoe.cn", $avatar);
        return $avatar;
    }
    add_filter('get_avatar', 'ty_avatar', 10, 3);
?>
<?php
}
?>

<?php
/*谷歌替换*/
if (get_option('wp_plus_google') == 'checked') {
?>
<?php
    function devework_replace_open_sans()
    {
        wp_deregister_style('open-sans');
        wp_register_style('open-sans', '//fonts.useso.com/css?family=Open+Sans:300italic,400italic,600italic,300,400,600');
        wp_enqueue_style('open-sans');
        if (is_admin())
            wp_enqueue_style('open-sans');
    }
    add_action('wp_enqueue_scripts', 'devework_replace_open_sans');
    add_action('admin_enqueue_scripts', 'devework_replace_open_sans');
    add_action('init', 'devework_replace_open_sans');
?>
<?php
}
?>

<?php
/*微软雅黑*/
if (get_option('wp_plus_wryh') == 'checked') {
?>
<?php
    function admin_fonts()
    {
        echo '<style type="text/css">
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
<?php
}
?>
<?php
/*积分特效*/
if (get_option('wp_plus_number') == 'checked') {
?>
<?php
    function wp_plus_jifentx()
    {
        echo '<script> jQuery(document).ready(function($) { $("html,body").click(function(e){ var n=Math.round(Math.random()*100); var $i=$("<b/>").text("+"+n); var x=e.pageX,y=e.pageY; $i.css({ "z-index":99999, "top":y-20, "left":x, "position":"absolute", "color":"#E94F06" }); $("body").append($i); $i.animate( {"top":y-180,"opacity":0}, 1500, function(){$i.remove();}); e.stopPropagation();});}); </script>';
    }
    add_action('wp_footer', 'wp_plus_jifentx');
}
?>

