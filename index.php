<?php 

define('API_KEY','1529135125:AAESTjd32qwoLcH8qEU7fJFdRGKmFzyPjBY');

function Bot($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
       return json_decode($res);
    }
}
function SendPhoto($ChatId,$photo,$keyboard,$caption){
	bot('SendPhoto',[
	'chat_id'=>$ChatId,
	'photo'=>$photo,
	'caption'=>$caption,
	'reply_markup'=>$keyboard
	]);
	}

function formatBytes($bytes, $precision = 2) { 
    $units = array('B', 'KB', 'MB', 'GB', 'TB'); 

    $bytes = max($bytes, 0); 
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024)); 
    $pow = min($pow, count($units) - 1); 

    // Uncomment one of the following alternatives
     $bytes /= pow(1024, $pow);
     //$bytes /= (1 << (10 * $pow)); 

    return round($bytes, $precision) . ' ' . $units[$pow]; 
} 
$update = json_decode(file_get_contents('php://input'));
if(isset($update->message)){
    $message = $update->message; 
    $chat_id = $message->chat->id;
    $message_id = $message->message_id;
    $textmessage = $message->text;
}
if($textmessage == '/start'){
	    bot('sendMessage',[
         'chat_id'=>$chat_id,
          'text'=>"به ربات نیم بها خوش امدید!
          
جهت نیم بها کردن لینک فایل موردنظر خود را ارسال کنید:",
	 ]);
}elseif(filter_var($textmessage)){
    
    $data = json_decode(file_get_contents('https://www.omdbapi.com/?i='.$textmessage.'&apikey=5a76e7e5'),true);
    if(isset($data['file'])){
        $file = $data['file'];
        $length = formatBytes($data['length']);
        $Title = $data['Title'];
        $Year = $data['Year'];
        $Rated = $data['Rated'];
        $Genre = $data['Genre'];
        $Runtime = $data['Runtime'];
        $Poster = $data['Poster'];
        $Plot = $data['Plot'];
        $Country = $data['Country'];
        $Language = $data['Language'];
        $imdbRating = $data['imdbRating'];
        $Metascore = $data['Language'];
        bot('SendPhoto',[
         'chat_id'=>$chat_id,
         'photo'=>$Poster,
         'caption'=>"₳ $Title $Year

         ⚡️$imdbRating | ✅$Metascore

         ▷ $Rated
         ۞ $Genre
         
         ∰ $Plot
         
         ※ کشور : $Country
         ₯ زبان : اصلی + دوبله فارسی بدون سانسور
         🔥حجم مصرفی لینک ها نیم بها میباشد.
         
         ◆ #Movie
         ◈ @King_Movie7",
          'reply_markup'=> json_encode([
             'inline_keyboard'=>[
[['text'=>"$Runtime",'callback_data'=>'is_join']],
[['text'=>"$Language",'callback_data'=>'is_join']]
]])
	 ]);
    }else{
        bot('sendMessage',[
         'chat_id'=>$chat_id,
          'text'=>"لینک نامعتبر!",
	 ]);
    }
    
}else{
     bot('sendMessage',[
         'chat_id'=>$chat_id,
          'text'=>"لینک نامعتبر!",
	 ]);
}

    

?>
