<?php

$prox=json_decode(file_get_contents("https://nitroxy.info/nitroxy/ntxy.php?type=home"),true);
for ($i = 0; $i < 3;$i++)
{
    $a = rand(0,25);
    $show = $prox["data"][$a];
    $message .= "🌐 Proxy: "."$show"."\n\n";
}

?>

<?php echo $message; ?>
