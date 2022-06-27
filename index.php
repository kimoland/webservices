<?php

flush();
ob_start();
ob_implicit_flush(1);
error_reporting( 0 );
ini_set( "log_errors","Off" );
ini_set( "expose_php","Off" );
ini_set( "Allow_url_fopen","Off" );
//====================Functions======================//
define('API_KEY', '1491491242:AAHX1Yj0f6hsI8fTDD_wg2DbAh355DGqPo4');
function S_A_F_T($method, $datas = [])
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
function apiRequest($method, $parameters)
{
    if (!is_string($method)) {
        error_log("Method name must be a string\n");
        return false;
    }
    if (!$parameters) {
        $parameters = array();
    } else if (!is_array($parameters)) {
        error_log("Parameters must be an array\n");
        return false;
    }
    foreach ($parameters as $key => &$val) {
        if (!is_numeric($val) && !is_string($val)) {
            $val = json_encode($val);
        }
    }
    $url = "https://api.telegram.org/bot" . API_KEY . "/" . $method . '?' . http_build_query($parameters);
    $handle = curl_init($url);
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 5);
    curl_setopt($handle, CURLOPT_TIMEOUT, 60);
    return exec_curl_request($handle);
}
function sendmessage($chat_id, $text, $mode)
{
    S_A_F_T('sendMessage', [
        'chat_id' => $chat_id,
        'text' => $text,
        'parse_mode' => $mode
    ]);
}
function sendaction($chat_id, $action)
{
    S_A_F_T('sendchataction', [
        'chat_id' => $chat_id,
        'action' => $action
    ]);
}
function Forward($KojaShe, $AzKoja, $KodomMSG)
{
    S_A_F_T('ForwardMessage', [
        'chat_id' => $KojaShe,
        'from_chat_id' => $AzKoja,
        'message_id' => $KodomMSG
    ]);
}
function sendphoto($chat_id, $photo, $action)
{
    S_A_F_T('sendphoto', [
        'chat_id' => $chat_id,
        'photo' => $photo,
        'action' => $action
    ]);
}
function objectToArrays($object)
{
    if (!is_object($object) && !is_array($object)) {
        return $object;
    }
    if (is_object($object)) {
        $object = get_object_vars($object);
    }
    return array_map("objectToArrays", $object);
}
//====================Variables======================//
$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$chat_id = $message->chat->id;
$message_id = $message->message_id;
$from_id = $message->from->id;
$text = $message->text;
@mkdir("data/$chat_id");
$data = $update->callback_query->data;
$chatid = $update->callback_query->message->chat->id;
$message_id2 = $update->callback_query->message->message_id;
@$KingNet7 = file_get_contents("data/$chat_id/KingNet7.txt");
$userbot = "KingProxy7Bot";
$ADMIN = 710732845; 
$channel = "King_Network7";
$log_channel = "@KingProxyLog";
$server_1 = file_get_contents("https://kn7proxytel.herokuapp.com//proxy-tel/api_1.php");
$server_2 = file_get_contents("https://kn7proxytel.herokuapp.com//proxy-tel/api_2.php");
$server_3 = file_get_contents("https://kn7proxytel.herokuapp.com//proxy-tel/api_3.php");
$inch = file_get_contents("https://api.telegram.org/bot" . API_KEY . "/getChatMember?chat_id=@$channel&user_id=" . $from_id); // ایدی کانال
//====================Buttons======================//
$btn_menu = json_encode([
    'keyboard' => [
      [['text' => "⚡️دریافت پروکسی⚡️"]],
      [['text' => "حمایت💰"], ['text' => "☎️پشتیبانی"]],
      [['text' => "راهنما📙"], ['text' => "📘درباره ما"]],
      [['text' => "🛰اشتراک گذاری ربات🛰"]]
   ], 'resize_keyboard' => true,
]);
$btn_admin_menu = json_encode([
   'inline_keyboard' => [
      [['text' => "📈آمار ربات📈", 'callback_data' => "status"]],
      [['text' => "پیام همگانی📤", 'callback_data' => "mtoall"], ['text' => "📤فوروارد همگانی", 'callback_data' => "ftoall"]],
      [['text' => "↩️منوی اصلی", 'callback_data' => "start"]]
   ],
  ]);
$btn_getproxy = json_encode([
   'keyboard' => [
      [['text' => "سرور دوم2️⃣"], ['text' => "1️⃣سرور اول"]],
      [['text' => "3️⃣سرور سوم3️⃣"]],
      [['text' => "↩️برگشت"]]
   ], 'resize_keyboard' => true,
]);
$btn_back = json_encode([
   'keyboard' => [
      [['text' => "↩️برگشت"]]
   ], 'resize_keyboard' => true,
]);
$btn_admin_back = json_encode([
    'inline_keyboard' => [
        [['text' => "↩️برگشت", 'callback_data' => "adminmenu"]],
    ]
]);
//====================Join forced======================//
if (strpos($inch, '"status":"left"') == true) {
    sendAction($chat_id, 'typing');
    var_dump(S_A_F_T('sendMessage', [
        'message_id' => $message_id2,
        'chat_id' => $update->message->chat->id,
        'text' => "💢 برای حمایت از ما و تیم ابتدا در کانال ما عضو شوید

🆔 @$channel
        
🔰 پس از عضویت در کانال ما دستور 
        
⚠️ /start
        
⚡️ رو ارسال کنید تا منو ربات برای شما نمایش داده شود

🔹 @$userbot",
        'reply_markup' => json_encode([
            'inline_keyboard' => [
                [['text' => "🔆ورود به کانال🔆", 'url' => "https://t.me/$channel"]],
            ]
        ])
    ]));
} 
//====================Start======================//
elseif ($text == "/start" || $text == "↩️برگشت") {
    if (!file_exists("data/$chat_id/KingNet7.txt")) {
        file_put_contents("data/$chat_id/KingNet7.txt", "none");
        $myfile2 = fopen("data/Member.txt", "a") or die("Unable to open file!");
        $add_user = file_get_contents('data/Member.txt');
        $add_user .= $from_id . "\n";
        fwrite($myfile2, "$chat_id\n");
        fclose($myfile2);
    }
    sendAction($chat_id, 'typing');
    S_A_F_T('sendmessage', [
        'chat_id' => $chat_id,
        'text' => "🔆 سلام به ربات کینگ پروکسی خوش اومدی!

🌀 با این رباتمیتونی پروکسی پرسرعت برای تلگرام دریافت کنی
        
❗️ پروکسی ها همیشه آپدیت میشن و نگرانی از این بابت وجود نداره
        
🆔 @$channel",
        'parse_mode' => "MarkDown",
        'reply_markup' => $btn_menu
    ]);
    Forward($log_channel, $chat_id, $message_id);
}
//====================Get Proxy======================//
elseif ($text == "⚡️دریافت پروکسی⚡️") {
    S_A_F_T('sendmessage', [
        'chat_id' => $chat_id,
                'text' => "💥 سرور مورد نظر خود را برای دریافت انتخاب کنید 💥",
        'parse_mode' => "MarkDown",
        'reply_markup' => $btn_getproxy
    ]);
    Forward($log_channel, $chat_id, $message_id);
}

elseif ($text == "1️⃣سرور اول") {
    S_A_F_T('sendmessage', [
        'chat_id' => $chat_id,
        'text' => "🔹 پروکسی های شما

➖➖➖➖➖➖➖➖➖
        
$server_1
        
➖➖➖➖➖➖➖➖➖
        
🆔 @$channel",
        'parse_mode' => "MarkDown",
        'reply_markup' => json_encode([
        'keyboard'=>[
                    [['text'=>"بروزرسانی سرور 1♻️"],['text'=>"↩️برگشت"]]
                   ],
                   'resize_keyboard'=>true,
                    ])
    ]);
    Forward($log_channel, $chat_id, $message_id);
}

elseif ($text == "سرور دوم2️⃣") {
    S_A_F_T('sendmessage', [
        'chat_id' => $chat_id,
        'text' => "🔹 پروکسی های شما

➖➖➖➖➖➖➖➖➖
                
$server_2
                
➖➖➖➖➖➖➖➖➖
                
🆔 @$channel",
        'parse_mode' => "MarkDown",
        'reply_markup' => json_encode([
        'keyboard'=>[
                    [['text'=>"بروزرسانی سرور 2♻️"],['text'=>"↩️برگشت"]]
                   ],
                   'resize_keyboard'=>true,
                    ])
    ]);
    Forward($log_channel, $chat_id, $message_id);
}

elseif ($text == "3️⃣سرور سوم3️⃣") {
    S_A_F_T('sendmessage', [
        'chat_id' => $chat_id,
        'text' => "🔹 پروکسی های شما

➖➖➖➖➖➖➖➖➖
                
$server_3
                
➖➖➖➖➖➖➖➖➖
                
🆔 @$channel",
        'parse_mode' => "MarkDown",
        'reply_markup' => json_encode([
        'keyboard'=>[
                    [['text'=>"بروزرسانی سرور 3♻️"],['text'=>"↩️برگشت"]]
                   ],
                   'resize_keyboard'=>true,
                    ])
    ]);
    Forward($log_channel, $chat_id, $message_id);
}

elseif ($text == "بروزرسانی سرور 1♻️") {
    S_A_F_T('sendmessage', [
        'chat_id' => $chat_id,
        'text' => "🔹 پروکسی های شما

➖➖➖➖➖➖➖➖➖
                
$server_1
                
➖➖➖➖➖➖➖➖➖
                
🆔 @$channel",
        'parse_mode' => "MarkDown",
        'reply_markup' => json_encode([
        'keyboard'=>[
                    [['text'=>"بروزرسانی سرور 1♻️"],['text'=>"↩️برگشت"]]
                   ],
                   'resize_keyboard'=>true,
                    ])
    ]);
    Forward($log_channel, $chat_id, $message_id);
}
elseif ($text == "بروزرسانی سرور 2♻️") {
    S_A_F_T('sendmessage', [
        'chat_id' => $chat_id,
        'text' => "🔹 پروکسی های شما

➖➖➖➖➖➖➖➖➖
                
$server_2
                
➖➖➖➖➖➖➖➖➖
                
🆔 @$channel",
        'parse_mode' => "MarkDown",
        'reply_markup' => json_encode([
        'keyboard'=>[
                    [['text'=>"بروزرسانی سرور 2♻️"],['text'=>"↩️برگشت"]]
                   ],
                   'resize_keyboard'=>true,
                    ])
    ]);
    Forward($log_channel, $chat_id, $message_id);
}
elseif ($text == "بروزرسانی سرور 3♻️") {
    S_A_F_T('sendmessage', [
        'chat_id' => $chat_id,
        'text' => "🔹 پروکسی های شما

➖➖➖➖➖➖➖➖➖
                
$server_3
                
➖➖➖➖➖➖➖➖➖
                
🆔 @$channel",
        'parse_mode' => "MarkDown",
        'reply_markup' => json_encode([
        'keyboard'=>[
                    [['text'=>"بروزرسانی سرور 3♻️"],['text'=>"↩️برگشت"]]
                   ],
                   'resize_keyboard'=>true,
                    ])
    ]);
    Forward($log_channel, $chat_id, $message_id);
}
//====================Support======================//
elseif ($text == "☎️پشتیبانی") {
    S_A_F_T('sendmessage', [
        'chat_id' => $chat_id,
        'text' => "📞 برای گزارش مشکل، انتقاد، پیشنهاد و... با آیدی زیر در ارتباط باشید.

🆔 @$channel",
        'parse_mode' => "MarkDown",
        'reply_markup' => json_encode([
            'inline_keyboard' => [
                [['text' => "💠گروه پشتیبانی💠", 'url' => "https://t.me/king_network7_GP"]],
            ]
        ])
    ]);
    Forward($log_channel, $chat_id, $message_id);
}
//====================Donate======================//
elseif ($text == "حمایت💰") {
    S_A_F_T('sendmessage', [
        'chat_id' => $chat_id,
        'text' => "🔰 برای ادامه فعالیت ربات و تامین بخشی از هزینه های سرور میتوانید از طریق لینک زیر از ربات و تیم حمایت کنید.

🆔 @$channel",
        'parse_mode' => "MarkDown",
        'reply_markup' => json_encode([
            'inline_keyboard' => [
                [['text' => "〽️لینک دونیت〽️", 'url' => "https://payping.ir/d/WiZG"]],
            ]
        ])
    ]);
    Forward($log_channel, $chat_id, $message_id);
}
//====================About======================//
elseif ($text == "📘درباره ما") {
    S_A_F_T('sendmessage', [
        'chat_id' => $chat_id,
        'text' => "👤 درباره ما

➖➖➖➖➖➖➖➖➖
↯طراحی: KingNetwork
↯سرور: Exclusive
↯ورژن: v-1.0
↯اسپانسری: True
↯حمایت: Donate
➖➖➖➖➖➖➖➖➖

🆔 @$channel",
        'parse_mode' => "MarkDown",
        'reply_markup' => $btn_back
    ]);
    Forward($log_channel, $chat_id, $message_id);
}
//====================About======================//
elseif ($text == "راهنما📙") {
    S_A_F_T('sendmessage', [
        'chat_id' => $chat_id,
        'text' => "📚 راهنمای ربات

➖➖➖➖➖➖➖➖➖
⇇از اشتراک پروکسی ها خودداری کنید
⇇بعد از اتصال VPN را خاموش کنید
⇇پروکسی ها همیشه آپدیت می شوند
➖➖➖➖➖➖➖➖➖
        
🆔 @$channel",
        'parse_mode' => "MarkDown",
        'reply_markup' => $btn_back
    ]);
    Forward($log_channel, $chat_id, $message_id);
}
//====================About======================//
elseif ($text == "🛰اشتراک گذاری ربات🛰") {
    S_A_F_T('sendphoto', [
        'chat_id' => $update->message->chat->id,
        'photo'=>"https://s6.uupload.ir/files/banner_mmxe.png",
        'caption'=>"🔥 ربات پروکسی ضدفلیتر تلگرام
〰️〰️〰️〰️〰️〰️〰️
🔹 پرسرعت
🔹 رایگان
🔹 آپدیت آنی
🔹 بدون اسپانسر
🔹 ضدفیلتر و قوی
〰️〰️〰️〰️〰️〰️〰️
🆔 @$channel",
        'reply_markup' => json_encode([
        'inline_keyboard' =>
        [
            [['text' => "🔸ورود به ربات🔸", 'url' => "https://t.me/$userbot"]]
        ]
    ])
]);
}
//====================Source_Hut======================//
if ($text == "/botpanel") {
    file_put_contents("data/$chat_id/KingNet7.txt", "no");
    S_A_F_T('sendmessage', [
        'chat_id' => $ADMIN,
        'text' => "⚜️ خوش آمدید از منوی زیر استفاده کنید

🆔 @$channel",
        'parse_mode' => "MarkDown",
        'reply_markup' => $btn_admin_menu
    ]);
}

elseif ($data == "adminmenu") {
    file_put_contents("data/$chat_id/KingNet7.txt", "no");
    S_A_F_T('editmessagetext', [
        'chat_id' => $ADMIN,
        'message_id' => $message_id2,
        'text' => "⚜️ خوش آمدید از منوی زیر استفاده کنید

🆔 @$channel",
        'parse_mode' => "MarkDown",
        'reply_markup' => $btn_admin_menu
    ]);
} 

elseif ($data == "status") {
    $user = file_get_contents("data/Member.txt");
    $member_id = explode("\n", $user);
    $member_count = count($member_id) - 1;
    S_A_F_T('answercallbackquery', [
        'callback_query_id' => $update->callback_query->id,
        'text' => "🌟تعداد اعضای ربات : $member_count",
        'show_alert' => true
    ]);
} 

elseif ($data == "mtoall") {
    file_put_contents("data/$chatid/KingNet7.txt", "send");
    S_A_F_T('editmessagetext', [
        'chat_id' => $chatid,
        'message_id' => $message_id2,
        'text' => "🌕 پیام خود را ارسال کنید",
    ]);
} 
elseif ($KingNet7 == "send") {
    file_put_contents("data/$chat_id/KingNet7.txt", "no");
    $fp = fopen("data/Member.txt", 'r');
    while (!feof($fp)) {
        $ckar = fgets($fp);
        sendmessage($ckar, $text, "HTML");
    }
    S_A_F_T('sendMessage', [
        'chat_id' => $chat_id,
        'text' => "🌿 پیام شما با موفقیت ارسال شد 🌿",
        'reply_markup' => $btn_admin_back
    ]);
} 

elseif ($data == "ftoall") {
    file_put_contents("data/$chatid/KingNet7.txt", "fwd");
    S_A_F_T('editmessagetext', [
        'chat_id' => $chatid,
        'message_id' => $message_id2,
        'text' => "🌕 پیام خود را فوروارد کنید",
    ]);
} 
elseif ($KingNet7 == 'fwd') {
    file_put_contents("data/$chat_id/KingNet7.txt", "no");
    $forp = fopen("data/Member.txt", 'r');
    while (!feof($forp)) {
        $fakar = fgets($forp);
        Forward($fakar, $chat_id, $message_id);
    }
    S_A_F_T('sendMessage', [
        'chat_id' => $chat_id,
        'text' => "🌿 پیام شما با موفقیت فوروارد شد 🌿",
        'reply_markup' => $btn_admin_back
    ]);
} 
else {
    Forward($log_channel, $chat_id, $message_id);
}
