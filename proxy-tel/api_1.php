<?php

header('Content-type: application/json;');
function getProxies()
{
    $get = file_get_contents('https://t.me/s/GlypeX');
    preg_match_all('#href="(.*?)" target="_blank" rel="noopener"#', $get, $prxs);
    preg_match_all('#class="tgme_widget_message_inline_button url_button" href="(.*?)"#', $get, $in_prxs);
    return $in_prxs[1] ?: $prxs[1];
}
function ExProxy($proxy)
{
    preg_match('#server=(.*?)&port=(.*?)&secret=(.*)#', $proxy, $info);
    return ['link' => $proxy, 'server' => $info[1], 'port' => $info[2], 'secret' => $info[3]];
}
if (!is_null($_GET['channel'])) {
    $prxs = getProxies();
    if (!is_null($prxs)) {
        for ($p = count($prxs) - 1; $p >= 0; $p--) {
            $prxlist[] = ExProxy(html_entity_decode($prxs[$p]));
        }
        $poker = ['ok' => true, 'channel' => '@GlypeX', 'proxies' => $prxlist];
    } else {
        $poker = ['ok' => false, 'channel' => '@GlypeX', 'message' => 'There is not any proxy in @'];
    }
} else {
    $poker = ['ok' => false, 'channel' => '@GlypeX', 'message' => 'I need channel param :|'];
}
echo json_encode($poker, 128);
