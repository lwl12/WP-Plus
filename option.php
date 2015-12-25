<?php
defined('ABSPATH') or exit;
if ($_POST['plus_empty_cron'] == 'true') {
    echo '<div id="message" class="updated"><h4>操作已完成！';
    var_dump(wp_clear_scheduled_hook('plus_hook_update'));
    echo '</h4></div>';
}
if ($_POST['plus_update_info'] == 'true') {
    echo '<div id="message" class="updated"><h4>操作已完成！';
    var_dump(plus_updateinfo());
    echo '</h4></div>';
}
if ($_POST['plus_post_open'] == 'true') {
    echo '<div id="message" class="updated"><h4>操作已完成！';
    var_dump(plus_post("activate"));
    echo '</h4></div>';
}
if ($_POST['update_pluginoptions'] == 'true') {
    plus_pluginoptions_update();
    echo '<div id="message" class="updated"><h4>设置已成功保存，感谢您使用<a href="http://blog.lwl12.com/read/wp-plus.html">WP-Plus插件！</a></h4></div>';
}
?>
<div class="wrap">
<h2>WP Plus 插件控制面板</h2>
<div id="message" class="updated"><p>WP-Plus <?php
echo plus_version;
?>版本更新日志：<br />
[新增]替换新版本JQuery功能
</div>
<form method="POST" action="">
<input type="hidden" name="update_pluginoptions" value="true" />
<b>界面美化</b><hr />
<input type="checkbox" name="jdt" id="jdt" <?php
echo get_option('wp_plus_jdt');
?> /> 启用“加载进度条”功能<p>
<input type="checkbox" name="glgjt" id="glgjt" <?php
echo get_option('wp_plus_glgjt');
?> /> 启用“隐藏管理工具条”功能<p>
<input type="checkbox" name="wryh" id="wryh" <?php
echo get_option('wp_plus_wryh');
?> /> 启用“变更后台字体为微软雅黑”功能<p>
<input type="checkbox" name="number" id="number" <?php
echo get_option('wp_plus_number');
?> /> 启用“在前台单击时，出现积分”特效<p>
<input type="checkbox" name="bingbg" id="bingbg" <?php
echo get_option("wp_plus_bingbg");
?> /> 启用“调用Bing背景作为登录页背景”功能<p>
<input type="checkbox" name="welcomemsg" id="welcomemsg" <?php
echo get_option("wp_plus_welcomemsg");
?> /> 启用“访客欢迎信息显示”功能<p>
<input type="checkbox" name="codehl" id="codehl" <?php
echo get_option("wp_plus_codehl");
?> /> 启用“代码高亮”功能<p>
<b>优化增强</b><hr />
<input type="checkbox" name="gravatar" id="gravatar" <?php
echo get_option('wp_plus_gravatar');
?> /> 启用“Gravatar替换到Geekzu镜像”功能<p>
<input type="checkbox" name="chuser" id="chuser" <?php
echo get_option("wp_plus_chuser");
?> /> 启用“允许添加中文用户名用户”功能<p>
<input type="checkbox" name="ping" id="ping" <?php
echo get_option("wp_plus_ping");
?> /> 启用“禁止站内文章互相pingback”功能<p>
<input type="checkbox" name="nofollow" id="nofollow" <?php
echo get_option("wp_plus_nofollow");
?> /> 启用“自动添加a标签nofollow与target="_blank"属性”功能<p>
<input type="checkbox" name="replaceurl" id="replaceurl" <?php
echo get_option("wp_plus_replaceurl");
?> /> 启用“使用相对链接替换绝对链接”功能<p>
<input type="checkbox" name="simplifyhead" id="simplifyhead" <?php
echo get_option("wp_plus_simplifyhead");
?> /> 启用“移除部分风险/无用头部信息”功能<p>
<input type="checkbox" name="ietip" id="ietip" <?php
echo get_option("wp_plus_ietip");
?> /> 启用“提示IE10以下IE用户更换浏览器”功能<p>
<input type="checkbox" name="linkman" id="linkman" <?php
echo get_option("wp_plus_linkman");
?> /> 启用“WP原生链接管理器”功能<p>
<input type="checkbox" name="google" id="google" <?php
echo get_option("wp_plus_google");
?> /> 启用“替换Google API”功能<p>
<input type="checkbox" name="jquery" id="jquery" <?php
echo get_option("wp_plus_jquery");
?> /> 启用“替换新版本JQuery”功能<p>
<input type="submit" class="button-primary" value="保存设置" /> &nbsp; WP-Plus 版本 <?php
echo plus_version;
?> &nbsp; 插件作者为 <a href="http://lwl12.com">liwanglin12</a> &nbsp; <a href="http://blog.lwl12.com/read/wp-plus.html">点击获取最新版本 & 说明</a>
</form>

<hr />
<p>DEBUG中心</p>此处信息供出现问题时作者分析使用！请勿随意触动此处按钮！<br />
<?php
echo ("下次报告时间");
var_dump(wp_next_scheduled('plus_hook_update'));
echo ("<br />");
echo ("UUID");
var_dump(get_option('wp_plus_uuid'));
echo ("<br />");
?>
<form method="POST" action="">
<input type="hidden" name="plus_empty_cron" value="true" />
<input type="submit" class="button" value="清空计划任务设置" />
</form>
<form method="POST" action="">
<input type="hidden" name="plus_update_info" value="true" />
<input type="submit" class="button" value="发送信息刷新事件" />
</form>
</form>
<form method="POST" action="">
<input type="hidden" name="plus_post_open" value="true" />
<input type="submit" class="button" value="发送插件启用事件" />
</form>
</form>
</div>
<?php
/* 插件设置验证*/
function plus_pluginoptions_update()
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
    if ($_POST['wryh'] == 'on') {
        $display = 'checked';
    } else {
        $display = '';
    }
    update_option('wp_plus_wryh', $display);
    if ($_POST['number'] == 'on') {
        $display = 'checked';
    } else {
        $display = '';
    }
    update_option('wp_plus_number', $display);
    if ($_POST['chuser'] == 'on') {
        $display = 'checked';
    } else {
        $display = '';
    }
    update_option('wp_plus_chuser', $display);
    if ($_POST['ping'] == 'on') {
        $display = 'checked';
    } else {
        $display = '';
    }
    update_option('wp_plus_ping', $display);
    if ($_POST['nofollow'] == 'on') {
        $display = 'checked';
    } else {
        $display = '';
    }
    update_option('wp_plus_nofollow', $display);
    if ($_POST['bingbg'] == 'on') {
        $display = 'checked';
    } else {
        $display = '';
    }
    update_option('wp_plus_bingbg', $display);
    if ($_POST['replaceurl'] == 'on') {
        $display = 'checked';
    } else {
        $display = '';
    }
    update_option('wp_plus_replaceurl', $display);
    if ($_POST['simplifyhead'] == 'on') {
        $display = 'checked';
    } else {
        $display = '';
    }
    update_option('wp_plus_simplifyhead', $display);
    if ($_POST['welcomemsg'] == 'on') {
        $display = 'checked';
    } else {
        $display = '';
    }
    update_option('wp_plus_welcomemsg', $display);
    if ($_POST['ietip'] == 'on') {
        $display = 'checked';
    } else {
        $display = '';
    }
    update_option('wp_plus_ietip', $display);
    if ($_POST['linkman'] == 'on') {
        $display = 'checked';
    } else {
        $display = '';
    }
    update_option('wp_plus_linkman', $display);
    if ($_POST['google'] == 'on') {
        $display = 'checked';
    } else {
        $display = '';
    }
    update_option('wp_plus_google', $display);
    if ($_POST['codehl'] == 'on') {
        $display = 'checked';
    } else {
        $display = '';
    }
    update_option('wp_plus_codehl', $display);
    if ($_POST['jquery'] == 'on') {
        $display = 'checked';
    } else {
        $display = '';
    }
    update_option('wp_plus_jquery', $display);
}
?>