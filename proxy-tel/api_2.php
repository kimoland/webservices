<?php

$prox=json_decode(file_get_contents("https://mtpro.xyz/api/?type=mtproto"),true);
for ($i = 0; $i < 8;$i++)
{
    $host = $prox[$i]["host"];
    $port = $prox[$i]["port"];
    $secret = $prox[$i]["secret"];
    $ping = $prox[$i]["ping"];
    $message2 .= "🌐 Proxy: "."https://t.me/proxy?server=$host&port=$port&secret=$secret"."\n"."⚡️ Ping: $ping"."\n\n";
}

?>
<?php echo $message; ?>
