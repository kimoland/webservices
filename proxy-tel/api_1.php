<?php

$prox = json_decode(file_get_contents("http://dl.dropboxusercontent.com/s/dn0mdwhk7mjwa0k/novingram_server.json"), true);
for ($i = 0; $i < 8; $i++) {
    $show = $prox["login"][$i];
    $message .= "🌐Proxy: "."$show"."\n\n";
}

?>

<?php echo $message; ?>
