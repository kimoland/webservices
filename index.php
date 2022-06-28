<?php

define('API_KEY','1491491242:AAHX1Yj0f6hsI8fTDD_wg2DbAh355DGqPo4');
$userbot = "KingProxy7Bot";
$channel = "King_Network7";
$log_channel = "@KingProxyLog";
$admin = 710732845;
//====================Functions======================//
function bot($method,$datas=[]){$url = "https://api.telegram.org/bot".API_KEY."/".$method;$ch = curl_init();curl_setopt($ch,CURLOPT_URL,$url);curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);curl_setopt($ch,CURLOPT_POSTFIELDS,http_build_query($datas));$res = curl_exec($ch);if(curl_error($ch)){var_dump(curl_error($ch));}else{return json_decode($res);}}
function apiRequest($method, $parameters) {if (!is_string($method)) {error_log("Method name must be a string\n");return false;}if (!$parameters) {$parameters = array();} else if (!is_array($parameters)) {error_log("Parameters must be an array\n");return false;}foreach ($parameters as $key => &$val) {if (!is_numeric($val) && !is_string($val)) {$val = json_encode($val);}}$url = "https://api.telegram.org/bot".API_KEY."/".$method.'?'.http_build_query($parameters);$handle = curl_init($url);curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 5);curl_setopt($handle, CURLOPT_TIMEOUT, 60);return exec_curl_request($handle);}
function SendMessage($chat_id, $text){bot('sendMessage',['chat_id'=>$chat_id,'text'=>$text,'parse_mode'=>"HTML"]);}
function save($filename, $data){$file = fopen($filename, 'w');fwrite($file, $data);fclose($file);}
function SendAction($chat_id, $action){bot('sendChataction',['chat_id'=>$chat_id,'action'=>$action]);}
function EditMessageText($chat_id,$message_id,$text,$parse_mode){bot('editMessagetext',['chat_id'=>$chat_id,'message_id'=>$message_id,'text'=>$text,'parse_mode'=>$parse_mode,]);}
function objectToArrays($object){if (!is_object($object) && !is_array($object)) {return $object;}if (is_object($object)) {$object = get_object_vars($object);}return array_map("objectToArrays", $object);}
function SendPhoto($chat_id, $photo_id,$caption){bot('sendphoto',['chat_id'=>$chat_id,'photo'=>$photo_id,'caption'=>$caption]);}
function ForwardMessage($chat_id,$from_chat,$message_id){bot('ForwardMessage',['chat_id'=>$chat_id,'from_chat_id'=>$from_chat,'message_id'=>$message_id]);}
//====================Variables======================//
$update = json_decode(file_get_contents('php://input'));
var_dump($update);
$chat_id = $update->message->chat->id;
$from_id = $update->message->from->id;
$text = $update->message->text;
$message_id = $update->message->message_id;
$data = $update->callback_query->data;
$chat_id2 = $update->callback_query->message->chat->id;
$message_id2 = $update->callback_query->message->message_id;
$username = $update->message->from->username;
@mkdir("user");
@mkdir("user/$from_id");
$step_r = file_get_contents("user/$chat_id/step.txt");
$s_comment = $update->message->reply_to_message->forward_from->id;
$get_comment = file_get_contents("user/$from_id/comment");
$server_1 = file_get_contents("https://kingproxy.de/webservices/proxy-tel/api_1.php");
$server_2 = file_get_contents("https://kingproxy.de/webservices/proxy-tel/api_2.php");
$server_3 = file_get_contents("https://kingproxy.de/webservices/proxy-tel/api_3.php");
$server_4 = file_get_contents("https://kingproxy.de/webservices/proxy-tel/api_4.php");
$inch = file_get_contents("https://api.telegram.org/bot".API_KEY."/getChatMember?chat_id=@$channel&user_id=".$from_id); 
//====================Buttons======================//
$btn_menu = json_encode([
    'keyboard' => [
      [['text' => "⚡️ دریافت پروکسی ⚡️"]],
      [['text' => "حمایت 💰"], ['text' => "☎️ پشتیبانی"]],
      [['text' => "راهنما 📙"], ['text' => "📘 درباره ما"]],
      [['text' => "🛰 اشتراک گذاری ربات 🛰"]]
   ], 'resize_keyboard' => true,
]);
$btn_admin_menu = json_encode([
   'inline_keyboard' => [
      [['text' => "📈آمار ربات📈", 'callback_data' => "status"]],
      [['text' => "پیام همگانی📤", 'callback_data' => "mtoall"], ['text' => "📤فوروارد همگانی", 'callback_data' => "ftoall"]],
   ],
]);
$btn_getproxy = json_encode([
   'keyboard' => [
      [['text' => "سرور دوم 2️⃣"], ['text' => "1️⃣ سرور اول"]],
      [['text' => "سرور چهارم 4️⃣"], ['text' => "3️⃣ سرور سوم"]],
      [['text' => "↩️ برگشت"]]
   ], 'resize_keyboard' => true,
]);
$btn_update_1 = json_encode([
	'keyboard' => [
	   [['text' => "بروزرسانی سرور 1 ♻️"],['text' => "↩️ برگشت"]]
	], 'resize_keyboard' => true,
 ]);
 $btn_update_2 = json_encode([
	'keyboard' => [
		[['text' => "بروزرسانی سرور 2 ♻️"],['text' => "↩️ برگشت"]]
	], 'resize_keyboard' => true,
 ]);
 $btn_update_3 = json_encode([
	'keyboard' => [
		[['text' => "بروزرسانی سرور 3 ♻️"],['text' => "↩️ برگشت"]]
	], 'resize_keyboard' => true,
 ]);
$btn_update_4 = json_encode([
	'keyboard' => [
		[['text' => "بروزرسانی سرور 4 ♻️"],['text' => "↩️ برگشت"]]
	], 'resize_keyboard' => true,
]);
$btn_back = json_encode([
   'keyboard' => [
      [['text' => "↩️ برگشت"]]
   ], 'resize_keyboard' => true,
]);
$btn_admin_back = json_encode([
    'inline_keyboard' => [
        [['text' => "↩️ برگشت", 'callback_data' => "adminmenu"]],
    ]
]);
//====================Join forced======================//
if(strpos($inch , '"status":"left"') == true ) { 
var_dump(bot('sendMessage',[ 
    'chat_id'=>$chat_id, 
    'text'=>"💢 برای حمایت از ما و تیم ابتدا در کانال ما عضو شوید

🆔 @$channel
			
🔰 پس از عضویت در کانال ما دستور 
			
⚠️ /start
			
⚡️ رو ارسال کنید تا منو ربات برای شما نمایش داده شود
	
🔹 @$userbot", 
    'parse_mode'=>'HTML', 
    'reply_markup'=>json_encode([ 
    'inline_keyboard'=>[ 
        [['text'=>"🔆ورود به کانال🔆",'url'=>"https://telegram.me/$channel"]] 
        ] 
    ]) 
])); 
}
//====================Start======================//
elseif(preg_match('/^\/([Ss]tart)/',$text) || $text == "↩️ برگشت"){
$user = file_get_contents('user/Member.txt');
$members = explode("\n",$user);
if (!in_array($chat_id,$members)){
$add_user = file_get_contents('user/Member.txt');
$add_user .= $chat_id."\n";
file_put_contents('user/Member.txt',$add_user);
}
bot('sendMessage',[
    'parse_mode' => "HTML",
    'reply_to_message_id'=>$message_id,
    'chat_id'=>$chat_id,
    'text'=>"🔆 سلام به ربات کینگ پروکسی خوش اومدی!

🌀 با این رباتمیتونی پروکسی پرسرعت برای تلگرام دریافت کنی
			
❗️ پروکسی ها همیشه آپدیت میشن و نگرانی از این بابت وجود نداره
			
🆔 @$channel",
'reply_markup'=>$btn_menu
  ]);
  ForwardMessage($log_channel, $chat_id, $message_id);
}
//====================Get Proxy======================//
elseif ($text == "⚡️ دریافت پروکسی ⚡️") {
    bot('sendmessage', [
        'chat_id' => $chat_id,
        'text' => "💥 سرور مورد نظر خود را برای دریافت انتخاب کنید 💥",
        'parse_mode' => "HTML",
        'reply_markup' => $btn_getproxy
    ]);
    ForwardMessage($log_channel, $chat_id, $message_id);
}

elseif ($text == "1️⃣ سرور اول" || $text == "بروزرسانی سرور 1 ♻️") {
    bot('sendmessage', [
        'chat_id' => $chat_id,
        'text' => "🔹 پروکسی های شما

➖➖➖➖➖➖➖➖➖
        
$server_1

➖➖➖➖➖➖➖➖➖
        
🆔 @$channel",
        'parse_mode' => "HTML",
        'reply_markup' => $btn_update_1
    ]);
    ForwardMessage($log_channel, $chat_id, $message_id);
}

elseif ($text == "سرور دوم 2️⃣" || $text == "بروزرسانی سرور 2 ♻️") {
    bot('sendmessage', [
        'chat_id' => $chat_id,
        'text' => "🔹 پروکسی های شما

➖➖➖➖➖➖➖➖➖
        
$server_2

➖➖➖➖➖➖➖➖➖
        
🆔 @$channel",
        'parse_mode' => "HTML",
        'reply_markup' => $btn_update_2
    ]);
    ForwardMessage($log_channel, $chat_id, $message_id);
}

elseif ($text == "3️⃣ سرور سوم" || $text == "بروزرسانی سرور 3 ♻️") {
    bot('sendmessage', [
        'chat_id' => $chat_id,
        'text' => "🔹 پروکسی های شما

➖➖➖➖➖➖➖➖➖
        
$server_3

➖➖➖➖➖➖➖➖➖
        
🆔 @$channel",
        'parse_mode' => "HTML",
        'reply_markup' => $btn_update_3
    ]);
    ForwardMessage($log_channel, $chat_id, $message_id);
}

elseif ($text == "سرور چهارم 4️⃣" || $text == "بروزرسانی سرور 4 ♻️") {
    bot('sendmessage', [
        'chat_id' => $chat_id,
        'text' => "🔹 پروکسی های شما

➖➖➖➖➖➖➖➖➖
        
$server_4

➖➖➖➖➖➖➖➖➖
        
🆔 @$channel",
        'parse_mode' => "HTML",
        'reply_markup' => $btn_update_4
    ]);
    ForwardMessage($log_channel, $chat_id, $message_id);
}
//====================Support======================//
elseif($text=="☎️ پشتیبانی"){
save("user/$from_id/comment","comment");
bot('sendmessage',[
'chat_id'=>$chat_id,
'reply_to_message_id'=>$message_id,
'text'=>"🌕 پیام خود را در قالب متن ارسال کنید

🆔 @$channel",
]);
ForwardMessage($log_channel, $chat_id, $message_id);
}
if($get_comment=="comment"){            
save("user/$from_id/comment","none");
bot("forwardmessage",[
'chat_id' =>$admin,
'from_chat_id' =>$chat_id,
'message_id' =>$message_id,
]);
SendMessage($log_channel, "✉️ یک پیام جدید ارسال شد

👤 یوزرآیدی: $from_id
💠 یوزرنیم: @$username
📝 متن: $text
	
🆔 @$channel", "HTML");
bot('sendmessage',[       
'chat_id'=>$chat_id,
'reply_to_message_id'=>$message_id,
'text'=>"☘️ پیام شما برای ادمین ارسال شد ☘️",
'parse_mode'=>'HTML',
]);
}
elseif($s_comment != "" && $from_id == $admin){
bot('sendMessage',[
'chat_id'=>$s_comment,
'text'=>$text,
'parse_mode'=>'HTML',
]);
bot('sendMessage',[
'chat_id'=>$chat_id,
'reply_to_message_id'=>$message_id,
'text'=>"✅ پیام شما به کاربر ارسال شد ✅",
'parse_mode'=>'HTML',
]);
}
//====================Donate======================//
elseif ($text == "حمایت 💰") {
    bot('sendmessage', [
        'chat_id' => $chat_id,
        'text' => "🔰 برای ادامه فعالیت ربات و تامین بخشی از هزینه های سرور میتوانید از طریق لینک زیر از ربات و تیم حمایت کنید.

🆔 @$channel",
        'parse_mode' => "HTML",
        'reply_markup' => json_encode([
            'inline_keyboard' => [
                [['text' => "〽️لینک دونیت〽️", 'url' => "https://payping.ir/d/WiZG"]],
            ]
        ])
    ]);
    ForwardMessage($log_channel, $chat_id, $message_id);
}
//====================About======================//
elseif ($text == "📘 درباره ما") {
    bot('sendmessage', [
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
        'parse_mode' => "HTML",
        'reply_markup' => $btn_back
    ]);
    ForwardMessage($log_channel, $chat_id, $message_id);
}
//====================About======================//
elseif ($text == "راهنما 📙") {
    bot('sendmessage', [
        'chat_id' => $chat_id,
        'text' => "📚 راهنمای ربات

➖➖➖➖➖➖➖➖➖
⇇از اشتراک پروکسی ها خودداری کنید
⇇بعد از اتصال VPN را خاموش کنید
⇇پروکسی ها همیشه آپدیت می شوند
➖➖➖➖➖➖➖➖➖
				
🆔 @$channel",
        'parse_mode' => "HTML",
        'reply_markup' => $btn_back
    ]);
    ForwardMessage($log_channel, $chat_id, $message_id);
}
//====================Share Bot======================//
elseif ($text == "🛰 اشتراک گذاری ربات 🛰") {
    bot('sendphoto', [
        'chat_id' => $chat_id,
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
//====================Admin Panel======================//
 if ($text == '/panel'){
var_dump(bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"⚜️ خوش آمدید از منوی زیر استفاده کنید

🆔 @$channel",
'parse_mode'=>'HTML',
'reply_markup'=>$btn_admin_menu
]));
}
if($data == "adminmenu"){
file_put_contents("user/$chat_id/KingNet7.txt", "no");
bot('editmessagetext',[
'chat_id'=>$admin,
'message_id' => $message_id2,
'text' => "⚜️ خوش آمدید از منوی زیر استفاده کنید

🆔 @$channel",
'parse_mode'=>"HTML",
'reply_markup' => $btn_admin_menu
]);
}
//====================Status Bot======================//
if($data == "status"){   
$userlist = file_get_contents('user/Member.txt');
$member_id = explode("\n",$userlist);
$member_count = count($member_id) -1;
bot('answercallbackquery', [
'callback_query_id' => $update->callback_query->id,
'text' => "🌟تعداد اعضای ربات : $member_count",
'show_alert' => true
]);
}
//====================Message To All======================//
if($data == "mtoall"){           
file_put_contents("user/$chat_id2/step.txt","SendToAll");
bot('editmessagetext',[
'chat_id'=>$chat_id2,
'message_id' => $message_id2,
'text'=>"🌕 پیام خود را ارسال کنید",
'parse_mode'=>"HTML",
'reply_markup' => $btn_admin_back
]);
}  
elseif($step_r == "SendToAll"){  
file_put_contents("user/$chat_id/step.txt","none");
$all_member = fopen( "user/Member.txt", 'r');
while( !feof( $all_member)) {
$user = fgets( $all_member);
SendMessage($user, $text, "html","true");
}
bot('sendMessage',[
'chat_id'=>$chat_id,
'text' => "🌿 پیام شما با موفقیت ارسال شد 🌿",
'parse_mode'=>"HTML",
'reply_markup' => $btn_admin_back
]);
} 
//====================Forward To All======================//
if($data == "ftoall"){           
file_put_contents("user/$chat_id2/step.txt","ForwardToAll");
bot('editmessagetext',[
'chat_id'=>$chat_id2,
'message_id' => $message_id2,
'text'=>"🌕 پیام خود را فوروارد کنید",
'parse_mode'=>"HTML",
'reply_markup' => $btn_admin_back
]);
} 
elseif($step_r == "ForwardToAll"){  
file_put_contents("user/$chat_id/step.txt","none");
$all_member_f = fopen( "user/Member.txt", 'r');
while( !feof( $all_member_f)) {
$user_f = fgets( $all_member_f);
ForwardMessage($user_f, $chat_id, $message_id);
}
bot('sendMessage',[
'chat_id'=>$chat_id,
'text' => "🌿 پیام شما با فوروارد ارسال شد 🌿",
'parse_mode'=>"HTML",
'reply_markup' => $btn_admin_back
]);
}
unlink("error_log");

