<?php

error_reporting(0);
set_time_limit(0);
flush();
//====================Functions======================//
define('API_KEY', '1529135125:AAESTjd32qwoLcH8qEU7fJFdRGKmFzyPjBY');
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
$ADMIN = 710732845; ////// ایدی عددی
$channel = "KimoLand"; ////// ایدی عددی
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
    'keyboard' => [
      [['text' => "📊آمار ربات📊"]],
      [['text' => "فوروارد همگانی📤"], ['text' => "📤ارسال همگانی"]],
      [['text' => "↩️برگشت"]]
    ], 'resize_keyboard' => true,
  ]);
$btn_getproxy = json_encode([
    'keyboard' => [
      [['text' => "سرور دوم2️⃣"], ['text' => "1️⃣سرور اول"]],
      [['text' => "سرور چهارم4️⃣"], ['text' => "3️⃣سرور سوم"]],
      [['text' => "↩️برگشت"]]
    ], 'resize_keyboard' => true,
]);
$btn_back = json_encode([
    'keyboard' => [
      [['text' => "↩️برگشت"]]
    ], 'resize_keyboard' => true,
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
        
⚡️ رو ارسال کنید تا منو ربات برای شما نمایش داده شود",
        'reply_markup' => json_encode([
            'inline_keyboard' => [
                [['text' => "🔆 ورود به کانال 🔆", 'url' => "https://t.me/$channel"]],
            ]
        ])
    ]));
} 
//====================Start======================//
elseif ($text == "/start") {
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
}
//====================Get Proxy======================//
elseif ($text == "⚡️دریافت پروکسی⚡️") {
    S_A_F_T('sendmessage', [
        'chat_id' => $chat_id,
        'text' => "💥 سرور مورد نظر خود را برای دریافت انتخاب کنید 💥",
        'parse_mode' => "MarkDown",
        'reply_markup' => $btn_getproxy
    ]);
}

elseif ($text == "1️⃣سرور اول") {
    S_A_F_T('sendmessage', [
        'chat_id' => $chat_id,
        'text' => "💥 سرور مورد نظر خود را برای دریافت انتخاب کنید 💥",
        'parse_mode' => "MarkDown",
        'reply_markup' => $btn_back
    ]);
}

elseif ($text == "سرور دوم2️⃣") {
    S_A_F_T('sendmessage', [
        'chat_id' => $chat_id,
        'text' => "💥 سرور مورد نظر خود را برای دریافت انتخاب کنید 💥",
        'parse_mode' => "MarkDown",
        'reply_markup' => $btn_back
    ]);
}

elseif ($text == "3️⃣سرور سوم") {
    S_A_F_T('sendmessage', [
        'chat_id' => $chat_id,
        'text' => "💥 سرور مورد نظر خود را برای دریافت انتخاب کنید 💥",
        'parse_mode' => "MarkDown",
        'reply_markup' => $btn_back
    ]);
}

elseif ($text == "سرور چهارم4️⃣") {
    S_A_F_T('sendmessage', [
        'chat_id' => $chat_id,
        'text' => "💥 سرور مورد نظر خود را برای دریافت انتخاب کنید 💥",
        'parse_mode' => "MarkDown",
        'reply_markup' => $btn_back
    ]);
}
//====================Source_Hut======================//
if ($text == "مدیریت") {
    file_put_contents("data/$chat_id/KingNet7.txt", "no");
    S_A_F_T('sendmessage', [
        'chat_id' => $ADMIN,
        'text' => "مدیر گرامی به پنل مدیریت ربات ‌موشکی خوش امدید🙂",
        'parse_mode' => "MarkDown",
        'reply_markup' => json_encode([
            'inline_keyboard' => [
                [
                    ['text' => "📈آمار کلی و وضعیت ربات📉", 'callback_data' => "am"]
                ],
                [
                    ['text' => "ارسال پیام به همه کاربران🙂", 'callback_data' => "send"], ['text' => "فروارد همگانی🤓", 'callback_data' => "fwd"]
                ],
                [
                    ['text' => "برگرد خونه🏡🤠", 'callback_data' => "home"]
                ],
            ]
        ])
    ]);
} elseif ($data == "homee") {
    file_put_contents("data/$chat_id/KingNet7.txt", "no");
    sendAction($chat_id, 'typing');
    S_A_F_T('sendMessage', [
        'chat_id' => $chat_id,
        'message_id' => $message_id2,
        'text' => "الان مثلا تو ادمین ربات ؟😐
این قسمت برای ادمیناس لطفا دیگر تلاش نکنید😁",
    ]);
    S_A_F_T('editmessagetext', [
        'chat_id' => $ADMIN,
        'message_id' => $message_id2,
        'text' => "خوش امدید",
        'parse_mode' => "MarkDown",
        'reply_markup' => json_encode([
            'inline_keyboard' => [
                [
                    ['text' => "📈آمار کلی و وضعیت ربات📉", 'callback_data' => "am"]
                ],
                [
                    ['text' => "ارسال پیام به همه کاربران🙂", 'callback_data' => "send"], ['text' => "فروارد همگانی🤓", 'callback_data' => "fwd"]
                ],
                [
                    ['text' => "برگرد خونه🏡🤠", 'callback_data' => "home"]
                ],
            ]
        ])
    ]);
} elseif ($data == "am") {
    $user = file_get_contents("data/Member.txt");
    $member_id = explode("\n", $user);
    $member_count = count($member_id) - 1;
    S_A_F_T('answercallbackquery', [
        'callback_query_id' => $update->callback_query->id,
        'text' => "تعداد ممبر ها : $member_count
",

        'show_alert' => true
    ]);
} elseif ($data == "send") {
    file_put_contents("data/$chatid/KingNet7.txt", "send");
    S_A_F_T('editmessagetext', [
        'chat_id' => $chatid,
        'message_id' => $message_id2,
        'text' => "خوب پیام خودتون را برام بفرستید تا بفرستم برا  کاربرا  . بدو وقت ندارم😑",
    ]);
} elseif ($KingNet7 == "send") {
    file_put_contents("data/$chat_id/KingNet7.txt", "no");
    $fp = fopen("data/Member.txt", 'r');
    while (!feof($fp)) {
        $ckar = fgets($fp);
        sendmessage($ckar, $text, "HTML");
    }
    S_A_F_T('sendMessage', [
        'chat_id' => $chat_id,
        'text' => "با موفقیت برای همه کاربران ارسال شد",
        'reply_markup' => json_encode([
            'inline_keyboard' => [
                [
                    ['text' => "برگرد خونه🏡🤠", 'callback_data' => "home"]
                ],
                [
                    ['text' => "برگشت مدیریت", 'callback_data' => "homee"]
                ],
            ]
        ])
    ]);
} elseif ($data == "fwd") {
    file_put_contents("data/$chatid/KingNet7.txt", "fwd");
    S_A_F_T('editmessagetext', [
        'chat_id' => $chatid,
        'message_id' => $message_id2,
        'text' => "خوب پیام خودتون را فروارد کنید فقط زود که حوصله ندارم😤",
    ]);
} elseif ($KingNet7 == 'fwd') {
    file_put_contents("data/$chat_id/KingNet7.txt", "no");
    $forp = fopen("data/Member.txt", 'r');
    while (!feof($forp)) {
        $fakar = fgets($forp);
        Forward($fakar, $chat_id, $message_id);
    }
    S_A_F_T('sendMessage', [
        'chat_id' => $chat_id,
        'text' => "با موفقیت فروارد شد.",
        'reply_markup' => json_encode([
            'inline_keyboard' => [
                [
                    ['text' => "برگرد خونه🏡🤠", 'callback_data' => "home"]
                ],
                [
                    ['text' => "برگشت مدیریت", 'callback_data' => "homee"]
                ],
            ]
        ])
    ]);
}
