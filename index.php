<?php
ob_start();
$API_KEY = '1529135125:AAESTjd32qwoLcH8qEU7fJFdRGKmFzyPjBY';
##------------------------------##
define('API_KEY', $API_KEY);
function bot($method, $datas = [])
{
    $url = "https://api.telegram.org/bot" . API_KEY . "/" . $method;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $datas);
    $res = curl_exec($ch);
    if (curl_error($ch)) {
        var_dump(curl_error($ch));
    } else {
        return json_decode($res);
    }
}
function sendmessage($chat_id, $text, $model)
{
    bot('sendMessage', [
        'chat_id' => $chat_id,
        'text' => $text,
        'parse_mode' => $model
    ]);
}
function sendaction($chat_id, $action)
{
    bot('sendchataction', [
        'chat_id' => $chat_id,
        'action' => $action
    ]);
}
function Forward($KojaShe, $AzKoja, $KodomMSG)
{
    bot('ForwardMessage', [
        'chat_id' => $KojaShe,
        'from_chat_id' => $AzKoja,
        'message_id' => $KodomMSG
    ]);
}
function save($filename, $TXTdata)
{
    $myfile = fopen($filename, "w") or die("Unable to open file!");
    fwrite($myfile, "$TXTdata");
    fclose($myfile);
}
//====================TeleDiamondCh======================//
$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$chat_id = $message->chat->id;
$from_id = $message->from->id;
$text = $message->text;
$ADMIN = 710732845;
$server_free_1 = file_get_contents("api/server1.php");
$ali = file_get_contents("data/" . $from_id . "/ali.txt");
$mtn = file_get_contents("data/" . $from_id . "/mtn.txt");
//====================TeleDiamondCh======================//
if (preg_match('/^\/([Ss]tart)/', $text)) {
    if (!file_exists("data/$from_id/ali.txt")) {
        mkdir("data/$from_id");
        save("data/$from_id/ali.txt", "no");
        $myfile2 = fopen("data/users.txt", "a") or die("Unable to open file!");
        fwrite($myfile2, "$from_id\n");
        fclose($myfile2);
    }
    bot('sendmessage', [
        'chat_id' => $chat_id,
        'text' => "Send GetProxy or /get",
        'parse_mode' => "MarkDown",
        'reply_markup' => json_encode([
            'keyboard' => [
                [['text' => 'GetProxy']],
            ],
            'resize_keyboard' => true,
        ])
    ]);
} 

elseif ($text == "/GetProxy" || $text == "/get" || $text == "Reload") {
    bot('sendmessage', [
        'chat_id' => $chat_id,
        'text' => "➖➖➖➖➖➖➖➖➖➖
$server_free_1
➖➖➖➖➖➖➖➖➖➖",
        'parse_mode' => "MarkDown",
        'reply_markup' => json_encode([
            'keyboard' => [
                [
                    ['text' => "Back"], ['text' => "Reload"]
                ],
            ], 'resize_keyboard' => true
        ])
    ]);
}

elseif ($text == "Back") {
    bot('sendmessage', [
        'chat_id' => $chat_id,
        'text' => "Send GetProxy or /get",
        'parse_mode' => "MarkDown",
        'reply_markup' => json_encode([
            'keyboard' => [
                [['text' => 'GetProxy']],
            ], 'resize_keyboard' => true
        ])
    ]);
}
//====================TeleDiamondCh======================//
elseif ($text == "/panel" && $from_id == $ADMIN) {
    bot('sendmessage', [
        'chat_id' => $chat_id,
        'text' => "Welcome",
        'parse_mode' => "MarkDown",
        'reply_markup' => json_encode([
            'keyboard' => [
                [
                    ['text' => "Status"], ['text' => "Message to all"]
                ],
            ], 'resize_keyboard' => true
        ])
    ]);
} 

elseif ($text == "Status" && $from_id == $ADMIN) {
    $user = file_get_contents("data/users.txt");
    $member_id = explode("\n", $user);
    $member_count = count($member_id) - 1;
    sendmessage($chat_id, "Members Count : $member_count", "html");
} 

elseif ($text == "Message to all" && $from_id == $ADMIN) {
    save("data/$from_id/ali.txt", "bc");
    bot('sendmessage', [
        'chat_id' => $chat_id,
        'text' => "Send Your Message",
        'parse_mode' => "MarkDown",
        'reply_markup' => json_encode([
            'keyboard' => [
                [['text' => '/panel']],
            ], 'resize_keyboard' => true
        ])
    ]);
} 

elseif ($ali == "bc" && $from_id == $ADMIN) {
    save("data/$from_id/ali.txt", "no");
    bot('sendmessage', [
        'chat_id' => $chat_id,
        'text' => "The message was sent to everyone",
    ]);
    $all_member = fopen("data/users.txt", "r");
    while (!feof($all_member)) {
        $user = fgets($all_member);
        SendMessage($user, $text, "html");
    }
}
