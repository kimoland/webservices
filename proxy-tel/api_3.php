<?php

$prox = json_decode(file_get_contents("https://shahrokh.xyz/mobogram/prxmgr/prxmgr.php"), true);
for ($i = 0; $i < 8; $i++) {
    $host = $prox[$i]["ip"];
    $port = $prox[$i]["prt"];
    $secret = $prox[$i]["secret"];
    $message .= "🌐Proxy: "."https://t.me/proxy?server=$host&port=$port&secret=$secret"."\n\n";
}

?>

<?php echo $message; ?>
