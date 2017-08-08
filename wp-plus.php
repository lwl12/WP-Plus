<?php
/*
Plugin Name: WP-Plus
Plugin URI: https://blog.lwl12.com/read/wp-plus.html
Description: 优化和增强您的博客
Author: liwanglin12
Author URI: https://lwl12.com
Version: 1.76-RC1.7
*/
/*Exit if accessed directly:安全第一,如果是直接载入,就退出.*/
defined('ABSPATH') or exit;
define("plus_version", "1.76-RC1.7");
/* 插件初始化*/
define('WP_PLUS_URL', plugin_dir_url(__FILE__));
register_activation_hook(__FILE__, 'plus_plugin_activate');
add_action('admin_init', 'plus_plugin_redirect');


function plus_plugin_redirect()
{
    if (get_option('do_activation_redirect', false)) {
        delete_option('do_activation_redirect');
        wp_redirect(admin_url('options-general.php?page=wp_plus'));
    }
}

/**
 * [register_plugin_settings_link 添加插件控制面板链接]
 */
function plus_register_plugin_settings_link($links)
{
    $settings_link = '<a href="options-general.php?page=wp_plus">设置</a>';
    array_unshift($links, $settings_link);
    return $links;
}
$plugin = plugin_basename(__FILE__);
add_filter("plugin_action_links_{$plugin}", 'plus_register_plugin_settings_link');


/* 注册控制面板*/
if (is_admin()) {
    add_action('admin_menu', 'wp_plus_menu');
}

/**
 * [wp_plus_menu 注册控制面板]
 */
function wp_plus_menu()
{
    add_options_page('WP Plus 插件控制面板', 'WP Plus', 'administrator', 'wp_plus', 'plus_pluginoptions_page');
}

/* 插件设置核心部分*/
function plus_pluginoptions_page()
{
    require "option.php";
}
/*加载进度*/
if (get_option('wp_plus_jdt') == 'checked') {
    ?><?php

    function plus_wpn_enqueue()
    {
        wp_enqueue_style('nprogresss', WP_PLUS_URL . 'css/nprogress.css?ver=' . plus_version);

        wp_enqueue_script('nprogress', WP_PLUS_URL . 'js/nprogress.js?ver=' . plus_version, array(
            'jquery'
        ), '0.1.2', true);
        wp_enqueue_script('wp-nprogress', WP_PLUS_URL . 'js/global.js?ver=' . plus_version, array(
            'jquery',
            'nprogress'
        ), '0.0.1', true);
    }
    add_action('wp_enqueue_scripts', 'plus_wpn_enqueue'); ?><?php

}
?><?php
if (get_option('wp_plus_glgjt') == 'checked') {
    ?><?php
    show_admin_bar(false); ?><?php

}
?><?php
/*替换头像*/
if (get_option('wp_plus_gravatar') == 'checked') {
    ?><?php
    function plus_v2ex_avatar($avatar)
    {
        $avatar = str_replace(array(
            "www.gravatar.com/avatar/",
            "0.gravatar.com/avatar/",
            "1.gravatar.com/avatar/",
            "2.gravatar.com/avatar/",
            "secure.gravatar.com/avatar/"
        ), "v2ex.assets.uxengine.net/gravatar/", $avatar);
        return $avatar;
    }
    add_filter('get_avatar', 'plus_v2ex_avatar', 10, 3); ?><?php

}
?><?php
/*微软雅黑*/
if (get_option('wp_plus_wryh') == 'checked') {
    ?><?php
    function plus_admin_fonts()
    {
        echo '<style type="text/css"> * { font-family: "Microsoft YaHei" !important; } i, .ab-icon, .mce-close, i.mce-i-aligncenter, i.mce-i-alignjustify, i.mce-i-alignleft, i.mce-i-alignright, i.mce-i-blockquote, i.mce-i-bold, i.mce-i-bullist, i.mce-i-charmap, i.mce-i-forecolor, i.mce-i-fullscreen, i.mce-i-help, i.mce-i-hr, i.mce-i-indent, i.mce-i-italic, i.mce-i-link, i.mce-i-ltr, i.mce-i-numlist, i.mce-i-outdent, i.mce-i-pastetext, i.mce-i-pasteword, i.mce-i-redo, i.mce-i-removeformat, i.mce-i-spellchecker, i.mce-i-strikethrough, i.mce-i-underline, i.mce-i-undo, i.mce-i-unlink, i.mce-i-wp-media-library, i.mce-i-wp_adv, i.mce-i-wp_fullscreen, i.mce-i-wp_help, i.mce-i-wp_more, i.mce-i-wp_page, .qt-fullscreen, .star-rating .star { font-family: dashicons !important; } .mce-ico { font-family: tinymce, Arial !important; } .fa { font-family: FontAwesome !important; } .genericon { font-family: "Genericons" !important; } .appearance_page_scte-theme-editor #wpbody *, .ace_editor * { font-family: Monaco, Menlo, "Ubuntu Mono", Consolas, source-code-pro, monospace !important; } .post-type-post #advanced-sortables, .post-type-post #autopaging .description { display: none !important; } .form-field input, .form-field textarea { width: inherit; border-width: 0; } </style>';
    }
    add_action('admin_head', 'plus_admin_fonts'); ?><?php

}
?><?php
/*积分特效*/
if (get_option('wp_plus_number') == 'checked') {
    ?><?php
    function wp_plus_jifentx()
    {
        echo '<script> jQuery(document).ready(function($) { $("html,body").click(function(e){ var n=Math.round(Math.random()*100); var $i=$("<b/>").text("+"+n); var x=e.pageX,y=e.pageY; $i.css({ "z-index":99999, "top":y-20, "left":x, "position":"absolute", "color":"#E94F06" }); $("body").append($i); $i.animate( {"top":y-180,"opacity":0}, 1500, function(){$i.remove();}); e.stopPropagation();});}); </script>';
    }
    add_action('wp_footer', 'wp_plus_jifentx');
}
?><?php
/*中文用户*/
if (get_option('wp_plus_chuser') == 'checked') {
    ?><?php
    add_filter('sanitize_user', 'plus_chinese_user', 3, 3);
    function plus_chinese_user($username, $raw_username, $strict)
    {
        $username = $raw_username;
        $username = strip_tags($username);
        $username = preg_replace('|%([a-fA-F0-9][a-fA-F0-9])|', '', $username);
        $username = preg_replace('/&.+?;/', '', $username);
        if ($strict) {
            $username = preg_replace('|[^a-z0-9 _.\-@\x80-\xFF]|i', '', $username);
        }
        $username = preg_replace('|\s+|', ' ', $username);
        return $username;
    }
}
?><?php
if (get_option('wp_plus_ping') == 'checked') {
    ?><?php
    /* 禁止站内文章PingBack */
    function plus_no_self_ping(&$links)
    {
        $home = get_option('home');
        foreach ($links as $l => $link) {
            if (0 === strpos($link, $home)) {
                unset($links[$l]);
            }
        }
    }
    add_action('pre_ping', 'plus_no_self_ping'); ?><?php

}
?><?php
if (get_option('wp_plus_nofollow') == 'checked') {
    ?><?php
    /* 自动为博客内的连接添加nofollow属性并在新窗口打开链接 */
    add_filter('the_content', 'plus_cn_nf_url_parse');

    function plus_cn_nf_url_parse($content)
    {
        $regexp = "<a\s[^>]*href=(\"??)([^\" >]*?)\\1[^>]*>";
        if (preg_match_all("/$regexp/siU", $content, $matches, PREG_SET_ORDER)) {
            if (!empty($matches)) {
                $srcUrl = get_option('siteurl');
                for ($i = 0; $i < count($matches); $i++) {
                    $tag      = $matches[$i][0];
                    $tag2     = $matches[$i][0];
                    $url      = $matches[$i][0];
                    $noFollow = '';
                    $pattern  = '/target\s*=\s*"\s*_blank\s*"/';
                    preg_match($pattern, $tag2, $match, PREG_OFFSET_CAPTURE);
                    if (count($match) < 1) {
                        $noFollow .= ' target="_blank" ';
                    }
                    $pattern = '/rel\s*=\s*"\s*[n|d]ofollow\s*"/';
                    preg_match($pattern, $tag2, $match, PREG_OFFSET_CAPTURE);
                    if (count($match) < 1) {
                        $noFollow .= ' rel="nofollow" ';
                    }
                    $pos = strpos($url, $srcUrl);
                    if ($pos === false) {
                        $tag = rtrim($tag, '>');
                        $tag .= $noFollow . '>';
                        $content = str_replace($tag2, $tag, $content);
                    }
                }
            }
        }
        $content = str_replace(']]>', ']]>', $content);
        return $content;
    } ?><?php

}
?><?php
if (get_option('wp_plus_bingbg') == 'checked') {
    ?><?php
    // 调用Bing美图作为登陆界面背景 //
    function plus_bingbg()
    {
        $imgurl = 'https://api.i-meto.com/bing?new&blur';
        echo '<style type="text/css">body{background: url(' . $imgurl . ');width:100%;height:100%;background-image:url(' . $imgurl . ');background-size: cover;-moz-border-image: url(' . $imgurl . ') 0;background-repeat:no-repeat\9;background-image:none\9;}</style>';
    }
    add_action('login_head', 'plus_bingbg'); ?><?php

}
?><?php
if (get_option('wp_plus_simplifyhead') == 'checked') {
    ?><?php
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'index_rel_link');
    remove_action('wp_head', 'parent_post_rel_link', 10, 0);
    remove_action('wp_head', 'start_post_rel_link', 10, 0);
    remove_action('wp_head', 'wp_generator'); ?><?php

}
?><?php
if (get_option('wp_plus_replaceurl') == 'checked') {
    ?><?php
    add_action('template_redirect', 'plus_relative_urls');

    function plus_relative_urls()
    {
        if (is_feed() || get_query_var('sitemap')) {
            return;
        }
        $filters = array(
            'post_link',
            'post_type_link',
            'page_link',
            'attachment_link',
            'get_shortlink',
            'post_type_archive_link',
            'get_pagenum_link',
            'get_comments_pagenum_link',
            'term_link',
            'search_link',
            'day_link',
            'month_link',
            'year_link'
        );
        foreach ($filters as $filter) {
            add_filter($filter, 'wp_make_link_relative');
        }
    } ?><?php

}
?><?php
if (get_option('wp_plus_welcomemsg') == 'checked') {
    ?><?php
    require "welcomemsg.php";
    function plus_welcomemsg()
    {
        $msg = welcome_msg();
        if ($msg !== false) {
            echo "<script>notie('$msg', {type:'info', autoHide:true, timeout: 5000,width:200})</script>";
        }
    }
    add_action('wp_footer', 'plus_welcomemsg'); ?><?php

}
?><?php
if (get_option('wp_plus_ietip') == 'checked') {
    ?><?php
    function plus_ietip()
    {
        echo '<!--[if lt IE 10]><script src="' . WP_PLUS_URL . 'js/iedie.min.js"></script><![endif]-->';
    }
    add_action('wp_head', 'plus_ietip'); ?><?php

}
?><?php
if (get_option('wp_plus_linkman') == 'checked') {
    ?><?php
    add_filter('pre_option_link_manager_enabled', '__return_true'); ?><?php

}
?><?php
/*代码高亮*/
if (get_option('wp_plus_codehl') == 'checked') {
    ?><?php
    function plus_add_prismjs()
    {
        wp_register_script('prismJS', WP_PLUS_URL . 'js/plus_prism.js?ver=' . plus_version);
        wp_enqueue_script('prismJS');
    }
    function plus_add_prismcss()
    {
        wp_register_style('prismCSS', WP_PLUS_URL . 'css/plus_prism.css?ver=' . plus_version);
        wp_enqueue_style('prismCSS');
    }

    class plusPrism
    {
        public function __construct()
        {
            add_filter('clean_url', array(
                $this,
                'add_async_forscript'
            ), 11, 1);
        }
        public function add_async_forscript($url)
        {
            if (strpos($url, 'plus_prism.js')===false) {
                return $url;
            } elseif (is_admin()) {
                return $url;
            } else {
                return $url."' async='async";
            }
        }
    }

    new plusPrism;
    add_action('wp_enqueue_scripts', 'plus_add_prismjs');
    add_action('wp_head', 'plus_add_prismcss'); ?><?php

}
?><?php
/*替换JQ*/
if (get_option('wp_plus_jquery') == 'checked') {
    ?><?php
    add_action('init', 'jquery_register');
    function jquery_register()
    {
        if (!is_admin()) {
            wp_deregister_script('jquery');
            wp_register_script('jquery', (WP_PLUS_URL . 'js/jquery-1.8.2.min.js?ver=' . plus_version), false, null, true);
            wp_enqueue_script('jquery');
        }
    } ?><?php

}
?><?php
/*版权提示*/
if (get_option('wp_plus_copyright') == 'checked') {
    ?><?php

    function plus_copyright()
    {
        echo '<script>function plus_copyright(){document.body.addEventListener("copy", function (e) { if (window.getSelection().toString().length > '. get_option("wp_plus_copyright_num") .') { setClipboardText(e); notie("商业转载请联系作者获得授权，非商业转载请注明出处", {type:"error", autoHide:true, timeout: 5000,width:200}); } }); function setClipboardText(event) { event.preventDefault(); var htmlData = "" + "著作权归作者所有。<br>" + "商业转载请联系作者获得授权，非商业转载请注明出处。<br>" + "作者：' . get_the_author() . '<br>" + "链接：" + window.location.href + "<br>" + "来源：' . get_bloginfo('name') . '<br><br>" + window.getSelection().toString(); var textData = "" + "著作权归作者所有。\n" + "商业转载请联系作者获得授权，非商业转载请注明出处。\n" + "作者：' . get_the_author() . '\n" + "链接：" + window.location.href + "\n" + "来源：' . get_bloginfo('name') . '\n\n" + window.getSelection().toString(); if (event.clipboardData) { event.clipboardData.setData("text/html", htmlData); event.clipboardData.setData("text/plain",textData); } else if (window.clipboardData) { return window.clipboardData.setData("text", textData); } }}</script>';
        if (is_single()) {
            echo '<script>plus_copyright();</script>';
        }
    }
    add_action('wp_footer', 'plus_copyright'); ?><?php

}
?><?php
/*久远文章提示*/
if (get_option('wp_plus_oldpost') == 'checked') {
    ?><?php

    function plus_oldpost($content)
    {
        if (is_single()) {
            $time = time() - get_the_modified_date('U');
            if ($time > get_option("wp_plus_oldpost_num") * 86400) {
                return $content . "<script>window.plus_oldpost = function(){notie('此文章最后修订于 ". floor($time / 86400) ." 天前，其中的信息可能已经有所发展或是发生改变', {type:'warning', autoHide:true, timeout: 5000,width:200});};plus_oldpost();</script>";
            }
        }
        return $content;
    }
    add_filter('the_content', 'plus_oldpost'); ?><?php

}
?><?php
/*禁用emoji*/
if (get_option('wp_plus_disable_emoji') == 'checked') {
    ?><?php
/**
 * 禁用emoji
 */
function disable_emoji()
{
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
    add_filter('tiny_mce_plugins', 'disable_emoji_tinymce');
}
    add_action('init', 'disable_emoji');

    function disable_emoji_tinymce($plugins)
    {
        if (is_array($plugins)) {
            return array_diff($plugins, array( 'wpemoji' ));
        } else {
            return array();
        }
    } ?><?php

}
?><?php
/*版本控制忽略*/
if (get_option('wp_plus_ignore_git') == 'checked') {
    ?><?php
add_filter('automatic_updates_is_vcs_checkout', '__return_false'); ?><?php

}
?><?php
/**
 * Description: 解决 WordPress 简体中文版每次加载后台都会产生好多条非必要 SQL 请求的情况，实质上是在 admin_init 钩子上移除了 wp-content/languages/zh_CN.php 本地化文件中清理旧版选项的函数，改为只在 WordPress 升级数据库时执行。
 * Version:     1.0
 *
 * Author:      斌果
 * Author URI:  https://www.bgbk.org
 */
 if (get_option('wp_plus_remove_zh_cn_legacy_option_clean') == 'checked') {
     ?><?php
function Bing_remove_zh_cn_legacy_option_clean()
     {
         if (remove_action('admin_init', 'zh_cn_l10n_legacy_option_cleanup')) {
             add_action('wp_upgrade', 'zh_cn_l10n_legacy_option_cleanup');
         }
     }
     add_action('init', 'Bing_remove_zh_cn_legacy_option_clean'); ?><?php

 }
?><?php
function plus_loadalert()
{
    if (get_option('wp_plus_welcomemsg') == 'checked' || get_option('wp_plus_copyright') == 'checked' || get_option('wp_plus_oldpost') == 'checked') {
        wp_register_script('notieJS', WP_PLUS_URL . 'js/notie.min.js');
        wp_enqueue_script('notieJS');
    }
}
add_action('wp_enqueue_scripts', 'plus_loadalert');
