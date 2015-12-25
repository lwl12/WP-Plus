<?php
function welcome_msg()
{
    if (is_bot()) {
        return;
    }
    if ($m = apply_filters('welcome_msg', $string)) {
        return $m;
        return;
    }
    global $referer;
    $referer     = $_SERVER['HTTP_REFERER'];
    $hostinfo    = parse_url($referer);
    $host_h      = $hostinfo["host"];
    $host_p      = $hostinfo["path"];
    $host_scheme = $hostinfo['scheme'];
    $host        = array(
        $host_h,
        $host_p
    );
    $host_hfull = $host_h;
    if (substr($host_h, 0, 4) == 'www.')
    $host_h     = substr($host_h, 4);
    $host_h_url = '<a href="' . $host_scheme . '://' . $host_hfull . '/">$host_h</a>';
    if ($referer == "") {
        $callback = "<!--您直接访问了本站!-->\n";
        if ($_COOKIE["comment_author_" . COOKIEHASH] != "") {
            $callback = 'Howdy, <strong>' . $_COOKIE["comment_author_" . COOKIEHASH] . '</strong>, 欢迎回来';
        } else {
            $callback = "您直接访问了本站!  莫非您记住了我的<strong>域名</strong>.厉害~  我倍感荣幸啊 嘿嘿";
        }
        //搜索引擎
        //baidu
    } elseif (preg_match('/baidu.*/i', $host_h)) {
        $callback = '您通过 <strong>百度</strong> 找到了我，厉害！';
        //360
    } elseif (preg_match('/haosou.*/i', $host_h)) {
        $callback = '您通过 <strong>好搜</strong> 找到了我，厉害！';
        //google
    } elseif (!preg_match('/www\.google\.com\/reader/i', $referer) && preg_match('/google\./i', $referer)) {
        $callback = '您居然通过 <strong>Google</strong> 找到了我! 一定是个技术宅吧!';
        //yahoo
    } elseif (preg_match('/search\.yahoo.*/i', $referer) || preg_match('/yahoo.cn/i', $referer)) {
        $callback = '您通过 <strong>Yahoo</strong> 找到了我! 厉害！';
        //阅读器
        //google
    } elseif (preg_match('/google\.com\/reader/i', $referer)) {
        $callback = "感谢你通过 <strong>Google</strong> 订阅我!  既然过来读原文了. 欢迎留言指导啊.嘿嘿 ^_^";
        //xianguo
    } elseif (preg_match('/xianguo\.com\/reader/i', $referer)) {
        $callback = "感谢你通过 <strong>鲜果</strong> 订阅我!  既然过来读原文了. 欢迎留言指导啊.嘿嘿 ^_^";
        //zhuaxia
    } elseif (preg_match('/zhuaxia\.com/i', $referer)) {
        $callback = "感谢你通过 <strong>抓虾</strong> 订阅我!  既然过来读原文了. 欢迎留言指导啊.嘿嘿 ^_^";
        //哪吒
    } elseif (preg_match('/inezha\.com/i', $referer)) {
        $callback = "感谢你通过 <strong>哪吒</strong> 订阅我!  既然过来读原文了. 欢迎留言指导啊.嘿嘿 ^_^";
        //有道
    } elseif (preg_match('/reader\.youdao/i', $referer)) {
        $callback = "感谢你通过 <strong>有道</strong> 订阅我!  既然过来读原文了. 欢迎留言指导啊.嘿嘿 ^_^";
        //自己  
    } elseif (self()) { //若来路是自己的网站
        //$callback = "你在找什么呢？试试上面的搜索吧~"."\n";
        $callback = false;
    } elseif (get_option('wp_plus_linkman') == 'checked' && get_bookmarks(array('search' => $host_hfull))) {
        $callback = '欢迎来自友站<strong>' . get_bookmarks(array('search' => $host_hfull))[0]->link_name . '</strong>的小伙伴~ 也请多多关注我哦 ^_^ ';
    } elseif ($_COOKIE["comment_author_" . COOKIEHASH] != "") {
        $callback = 'Howdy, <strong>' . $_COOKIE["comment_author_" . COOKIEHASH] . '</strong>欢迎从<strong>' . $host_h . '</strong>回来';
    } else {
        $callback = '欢迎来自<strong>' . $host_h . '</strong>的朋友. 我经常分享一些好东西哦 ^_^ ';
    }
    return $callback;
}
//判断来路是自己网站的函数
function self()
{
    $local_info   = parse_url(get_option('siteurl'));
    $local_host   = $local_info['host'];
    $local_scheme = $local_info['scheme'];
    //check self
    if (preg_match("/^$local_scheme:\/\/(\w+\.)?($local_host)/", $_SERVER['HTTP_REFERER']) != 0)
        return true;
}

/**
 * 通过USER_Agent判断是否为机器人.
 */
function is_bot()
{
    $bots      = array(
        'Google Bot1' => 'googlebot',
        'Google Bot2' => 'google',
        'MSN' => 'msnbot',
        'Alex' => 'ia_archiver',
        'Lycos' => 'lycos',
        'Ask Jeeves' => 'jeeves',
        'Altavista' => 'scooter',
        'AllTheWeb' => 'fast-webcrawler',
        'Inktomi' => 'slurp@inktomi',
        'Turnitin.com' => 'turnitinbot',
        'Technorati' => 'technorati',
        'Yahoo' => 'yahoo',
        'Findexa' => 'findexa',
        'NextLinks' => 'findlinks',
        'Gais' => 'gaisbo',
        'WiseNut' => 'zyborg',
        'WhoisSource' => 'surveybot',
        'Bloglines' => 'bloglines',
        'BlogSearch' => 'blogsearch',
        'PubSub' => 'pubsub',
        'Syndic8' => 'syndic8',
        'RadioUserland' => 'userland',
        'Gigabot' => 'gigabot',
        'Become.com' => 'become.com',
        'Bot' => 'bot',
        'Spider' => 'spider',
        'yinheli_for_test' => 'dFirefox'
    );
    $useragent = $_SERVER['HTTP_USER_AGENT'];
    foreach ($bots as $name => $lookfor) {
        if (stristr($useragent, $lookfor) !== false) {
            return true;
            break;
        }
    }
}


?>