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
[新增]我也忘了我到底改了些什么，先凑合用，有啥问题再修好了。。。<br />
</div>
<form method="POST" action="">
<input type="hidden" name="update_pluginoptions" value="true" />
    <h3>界面美化</h3>
    <div style="margin-left: 50px">
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
    </div>
    <hr>
    <h3>优化增强</h3>
    <div style="margin-left: 50px">
        <input type="checkbox" name="gravatar" id="gravatar" <?php
        echo get_option('wp_plus_gravatar');
        ?> /> 启用“Gravatar替换到TYCDN镜像”功能<p>
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
        <input type="checkbox" name="copyright" id="copyright" <?php
        echo get_option("wp_plus_copyright");
        ?> /> 启用“复制文字时自动添加版权信息”功能: 复制<input type="number" value="<?php echo get_option("wp_plus_copyright_num") ? get_option("wp_plus_copyright_num") : "30";?>" size="3" name="copyright_num" id="copyright_num" required="required"/>字时添加<p>
        <input type="checkbox" name="oldpost" id="oldpost" <?php
        echo get_option("wp_plus_oldpost");
        ?> /> 启用“久远文章提示”功能: 文章最后修改时间距现在<input type="number" value="<?php echo get_option("wp_plus_oldpost_num") ? get_option("wp_plus_oldpost_num") : "31";?>" size="3" name="oldpost_num" id="oldpost_num" required="required"/>天时提醒<p>
        <input type="checkbox" name="disable_emoji" id="disable_emoji" <?php
        echo get_option("wp_plus_disable_emoji");
        ?> /> 启用“禁用自带 Emoji”功能<p>
    </div>
    <input type="submit" class="button-primary" value="保存设置" style="margin: 20px 0;" /> &nbsp; WP-Plus 版本 <?php
    echo plus_version;
    ?> &nbsp; 插件作者 <a href="http://lwl12.com">liwanglin12</a> &nbsp; <a href="http://blog.lwl12.com/read/wp-plus.html">点击获取最新版本 & 说明</a>
</form>

<hr>

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
    <input type="submit" class="button" value="清空计划任务设置"  style="margin: 10px 0;" />
</form>
<form method="POST" action="">
    <input type="hidden" name="plus_update_info" value="true" />
    <input type="submit" class="button" value="发送信息刷新事件"  style="margin: 10px 0;" />
</form>
<form method="POST" action="">
    <input type="hidden" name="plus_post_open" value="true" />
    <input type="submit" class="button" value="发送插件启用事件"  style="margin: 10px 0;" />
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
    if ($_POST['copyright'] == 'on') {
        $display = 'checked';
    } else {
        $display = '';
    }
    update_option('wp_plus_copyright', $display);
    update_option('wp_plus_copyright_num', $_POST['copyright_num']);
    if ($_POST['oldpost'] == 'on') {
        $display = 'checked';
    } else {
        $display = '';
    }
    update_option('wp_plus_oldpost', $display);
    update_option('wp_plus_oldpost_num', $_POST['oldpost_num']);

    if ($_POST['disable_emoji'] == 'on') {
        $display = 'checked';
    } else {
        $display = '';
    }
    update_option('wp_plus_disable_emoji', $display);
}
?>