<?php
/*
Proxy Api

Channel : @GlypeX
*/
header('Content-type: application/json;');
function getProxy($channel,$limit)
{
   
 $get = file_get_contents('https://t.me/GlypeX/' . $channel); //channel id proxy

    preg_match_all('#<a href="(.*?)" target="_blank" rel="noopener">#', $get, $proxies);
    for ($p = $limit - 1; 0 <= $p; $p--) {
        if (strpos($proxies[1][$p], 'https://t.me/proxy?server=') !== false or strpos($proxies[1][$p], 'tg://proxy?server=') !== false) {
            $proxs[] = $proxies[1][$p];
        }
    }
    return $proxs;
}
if (!empty($_GET['channel']) && !empty($_GET['limit'])) {
    if ($_GET['limit'] <= 20) {
        $proxies = getProxy($_GET['channel'], $_GET['limit']);
        if (!is_null($proxies)) {
            $show = ['ok' => true, 'channel' => '@GlypeX', 'results' => $proxies];
        } else {
            $show = ['ok' => false, 'channel' => '@GlypeX', 'message' => 'Something went wronge!!'];
        }
    } else {
        $show = ['ok' => false, 'channel' => '@GlypeX', 'message' => 'It is overload'];
    }
} else {
    $show = ['ok' => false, 'channel' => '@GlypeX', 'message' => 'I need channel and limit!!'];
}
echo json_encode($show, 128);
