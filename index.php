<?php

unlink(error_log);
$load = sys_getloadavg();
$API_KEY = "token"; //TOKEN
define('API_KEY',$API_KEY);

function bot($method,$datas=[]){
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
function numberformat($str, $sep = ',')
{
    $result = '';
    $c = 0;
    $num = strlen("$str");
    for ($i = $num - 1; $i >= 0; $i--) {
        if ($c == 3) {
            $result = $sep . $result;
            $result = $str[$i] . $result;
            $c = 0;
        } else {
            $result = $str[$i] . $result;
        }
        $c++;
    }
    return $result;
}
function sendmessage($chat_id, $text, $mode, $disable_web_page_preview){
	bot('sendMessage',[
	'chat_id'=>$chat_id,
	'text'=>$text,
	'parse_mode'=>$mode,
	'disable_web_page_preview'=>$disable_web_page_preview,
	]);
	}
	function sendaction($chat_id, $action){
	bot('sendchataction',[
	'chat_id'=>$chat_id,
	'action'=>$action
	]);
	}
	function getFileList($folderName, $fileType = "")
{
    if (substr($folderName, strlen($folderName) - 1) != "/") {
        $folderName .= '/';
    }

	$c=0;
    foreach (glob($folderName . '*' . $fileType) as $filename) {
        if (is_dir($filename)) {
            $type = 'folder';
        } else {
            $type = 'file';
        }
        $c++;
    }
	return $c;

}

function create_zip($files = array(),$destination = '') {
    if(file_exists($destination)) { return false; }
    $valid_files = array();
    if(is_array($files)) {
        foreach($files as $file) {
            if(file_exists($file)) {
                $valid_files[] = $file;
            }
        }
    }
    if(count($valid_files)) {
        $zip = new ZipArchive();
        if($zip->open($destination,$overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE) !== true) {
            return false;
        }
        foreach($valid_files as $file) {
            $zip->addFile($file,$file);
        }
        $zip->close();
        return file_exists($destination);
    }
    else
    {
        return false;
    }
}
	function Forward($KojaShe,$AzKoja,$KodomMSG)
{
    bot('ForwardMessage',[
        'chat_id'=>$KojaShe,
        'from_chat_id'=>$AzKoja,
        'message_id'=>$KodomMSG
    ]);
}

function SendAudio($chatid,$audio,$keyboard,$caption,$sazande,$title){
	bot('SendAudio',[
	'chat_id'=>$chatid,
	'audio'=>$audio,
	'caption'=>$caption,
	'performer'=>$sazande,
	'title'=>$title,
	'reply_markup'=>$keyboard
	]);
	}
	function SendDocument($chatid,$document,$keyboard,$caption){
	bot('SendDocument',[
	'chat_id'=>$chatid,
	'document'=>$document,
	'caption'=>$caption,
	'reply_markup'=>$keyboard
	]);
	}
	function SendSticker($chatid,$sticker,$keyboard){
	bot('SendSticker',[
	'chat_id'=>$chatid,
	'sticker'=>$sticker,
	'reply_markup'=>$keyboard
	]);
	}
	function SendVideo($chatid,$video,$caption,$keyboard,$duration){
	bot('SendVideo',[
	'chat_id'=>$chatid,
	'video'=>$video,
        'caption'=>$caption,
	'duration'=>$duration,
	'reply_markup'=>$keyboard
	]);
	}
	function SendVoice($chatid,$voice,$keyboard,$caption){
	bot('SendVoice',[
	'chat_id'=>$chatid,
	'voice'=>$voice,
	'caption'=>$caption,
	'reply_markup'=>$keyboard
	]);
	}
	function SendContact($chatid,$first_name,$phone_number,$keyboard){
	bot('SendContact',[
	'chat_id'=>$chatid,
	'first_name'=>$first_name,
	'phone_number'=>$phone_number,
	'reply_markup'=>$keyboard
	]);
	}
	/* Tabee Send Chat Action */
function SendChatAction($chatid,$action){
	bot('sendChatAction',[
	'chat_id'=>$chatid,
	'action'=>$action
	]);
	}
	/* Tabee Kick Chat Member */
function KickChatMember($chatid,$user_id){
	bot('kickChatMember',[
	'chat_id'=>$chatid,
	'user_id'=>$user_id
	]);
	}
	/* Tabee Leave Chat */
function LeaveChat($chatid){
	bot('LeaveChat',[
	'chat_id'=>$chatid
	]);
	}
	/* Tabee Get Chat */
function getChat($idchat){
	$json=file_get_contents('https://api.telegram.org/bot'.API_KEY."/getChat?chat_id=".$idchat);
	$data=json_decode($json,true);
	return $data["result"]["first_name"];
}
	/* Tabee Get Chat Members Count */
function GetChatMembersCount($chatid){
	bot('getChatMembersCount',[
	'chat_id'=>$chatid
	]);
	}
	/* Tabee Get Chat Member */
function GetChatMember($chatid,$userid){
	$truechannel = json_decode(file_get_contents('https://api.telegram.org/bot'.API_KEY."/getChatMember?chat_id=".$chatid."&user_id=".$userid));
	$tch = $truechannel->result->status;
	return $tch;
	}
	/* Tabee Answer Callback Query */
function AnswerCallbackQuery($callback_query_id,$text,$show_alert){
	bot('answerCallbackQuery',[
        'callback_query_id'=>$callback_query_id,
        'text'=>$text,
		'show_alert'=>$show_alert
    ]);
	}
function sendphoto($chat_id, $photo, $action){
	bot('sendphoto',[
	'chat_id'=>$chat_id,
	'photo'=>$photo,
	'action'=>$action
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
#-----------------------------API
$smm = "https://worldsmm.site/api/v1";
$smmapi = "key"; //your api
$servid = "1403";
$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$chat_id = $message->chat->id;
$chat_id2 = $message->chat->id;
mkdir("data/$from_id");
$message_id = $message->message_id;
$from_id = $message->from->id;
$text = $update->message->text;
$oghab = file_get_contents("data/$from_id/com.txt");
$ADMIN = '1109004518'; //ADMIN ID
$user = file_get_contents("Member.txt");
$tc = $update->message->chat->type;
$truechannel = json_decode(file_get_contents("https://api.telegram.org/bot".API_KEY."/getChatMember?chat_id=@TXTsProjects&user_id=".$from_id));
$tch = $truechannel->result->status;
$first = $update->message->from->first_name;
$tedad = file_get_contents('data/'.$from_id."/golds.txt");
@$list = file_get_contents("Member.txt");
@$wait = file_get_contents("data/$from_id/wait.txt");
@$coin = file_get_contents("data/$from_id/golds.txt");
@$sof = file_get_contents("data/sofs.txt");
$channel = "@TXTsProjects"; //KANAL
$on = file_get_contents("on.txt");
#-------------------------
if($on =="off"&&$from_id!=$ADMIN){

bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"⚠️<b>Our Bot Is Upadting....
❌ So It Is Closed For Few Hours.
⚠️ Please Try Again Later.</b>",
        'parse_mode'=>'html',
        	'reply_markup'=>json_encode([
	'hide_keyboard'=>true
	])
	]);
	}else{
   if($text == '🔚 Back'){
	   file_put_contents("data/$from_id/com.txt","none");
  bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"<b>🏠 Menu</b>",
        'parse_mode'=>'html',
        	'reply_markup'=>json_encode([
	'resize_keyboard'=>true,
	'keyboard'=>[
	 [['text'=>"👁 View"],['text'=>"🅰 Auto-View"]],
 [['text'=>"➕ Deposit"],['text'=>"👤 My Account"]],
 [['text'=>"📋 Manual"]],
 [['text'=>"🆘 Help"],['text'=>"📊 Statistics"]]
	]
	])
	]);
	file_put_contents("data/$from_id/com.txt","none");
  }

if($text == "🅰 Auto-View"){
	bot('sendmessage',[
	'chat_id'=>$chat_id2,
	'text'=>"
*👁 Submit the required number of  Auto View .
Feel free to contact @TricksXTechOwner with questions and suggestions!
*",
        'parse_mode'=>'MarkDown',
        	'reply_markup'=>json_encode([
	'resize_keyboard'=>true,
	'keyboard'=>[
[['text'=>"🛍️ Weekly"],['text'=>"🚀 Monthly"]],
 [['text'=>"🔚 Back"]],
	]
	])
	]);
 
	}
//Forward message chat idsiga PM uradigan kanalingiz id qo'yasiz o'ziz
if($text == "👁 View"){
	bot('sendmessage',[
	'chat_id'=>$chat_id2,
	'text'=>"
*Submit The Desired 👁 Number Of Views.
You have $tedad  Views 👁 .
Feel Free To Contact @TricksXTechOwner With Questions and Suggestions!
*",
        'parse_mode'=>'MarkDown',
        	'reply_markup'=>json_encode([
	'resize_keyboard'=>true,
	'keyboard'=>[
[['text'=>"300 ️"],['text'=>"400 ️"]],
[['text'=>"500 ️"],['text'=>"600 ️"]],
[['text'=>"700 ️"],['text'=>"800 ️"]],
[['text'=>"900 "],['text'=>"1000  ️"]],
 [['text'=>"🔚 Back"]],
	]
	])
	]);
 
	}
elseif($text == "400 ️" or $text == "500 ️" or $text == "600 ️" or $text == "800️ " or $text == "1000  ️" or $text == "1100  ️"){
 if($tedad > 400){
     $ann=$text/1;
file_put_contents("./data/$from_id/com.txt","400");
file_put_contents("./data/$from_id/views.txt","$ann");
 bot('sendmessage',[
 'chat_id'=>$chat_id,
 'text'=>"You Have Selected <b> $text </b> 👁 Views! 
Forward The Message From The Channel <b> To </b>Multiply
Views Will Be Added To Last Post.",
        'parse_mode'=>'html',
         'reply_markup'=>json_encode([
 'resize_keyboard'=>true,
 'keyboard'=>[
 [['text'=>"🔚 Back"]],
 [['text'=>""]],
 ]
 ])
 ]);
  }else{
  
  bot('sendmessage',[
 'chat_id'=>$chat_id,
 'text'=>"⚠️<b> You don't have enough coins!</b>
 ➕ Go to My Account filler section and continue collecting coins.",
        'parse_mode'=>'html',
         'reply_markup'=>json_encode([
 'resize_keyboard'=>true,
 'keyboard'=>[
[['text'=>"👁 View"],['text'=>"🅰 Auto-View"]],
 [['text'=>"➕ Deposit"],['text'=>"👤 My Account"]],
 [['text'=>"📋 Manual"]],
 [['text'=>"🆘 Help"],['text'=>"📊 Statistics"]]
	]
 ])
 ]);
 }
 }
 
if ($oghab == "400" && $update->message->forward_from_chat->type == "channel") {
    file_put_contents("spam/$from_id.txt",file_get_contents("spam/$from_id.txt") + 1);
    if(file_get_contents("spam/$from_id.txt") <= 1){
     file_put_contents("data/$from_id/com.txt", "none");
     $noview = file_get_contents("./data/$from_id/views.txt");
  $newgold = $tedad - $noview;
  file_put_contents("data/$from_id/golds.txt", $newgold);
sleep(1);
bot('ForwardMessage', [
'chat_id' => "-1001309369274",
'from_chat_id' => $chat_id,
'message_id' => $message_id
]);
$curl = curl_init();  
  
curl_setopt_array($curl, array(  
    CURLOPT_URL => "$smm?key=$smmapi&action=add&service=$servid&link=https://t.me/".$update->message->forward_from_chat->username."&quantity=$noview",  
    CURLOPT_RETURNTRANSFER => true,  
    CURLOPT_ENCODING => "",  
    CURLOPT_MAXREDIRS => 2,  
    CURLOPT_TIMEOUT => 10,  
    CURLOPT_FOLLOWLOCATION => true,  
    CURLOPT_CUSTOMREQUEST => "GET"  
    ));  
$response = curl_exec($curl);  
  
curl_close($curl);
  bot('sendmessage', ['chat_id' => $chat_id, 'text' => "✅ Order received!
🚀 Maximum speed.
🚚 Order $noview views
🧩 Your order will be processed in the next few minutes.
<b>share with your friends!</b>", 'parse_mode' => 'html', 'reply_markup' => json_encode(['resize_keyboard' => true, 'keyboard' => [[['text'=>"👁 View"],['text'=>"🅰 Auto-View"]],
 [['text'=>"➕ Deposit"],['text'=>"👤 My Account"]],
 [['text'=>"📋 Manual"]],
 [['text'=>"🆘 Help"],['text'=>"📊 Statistics"]]
	]]) ]);
        $sofs = $sof + 2;
  file_put_contents("data/sofs.txt", $sofs);
  file_put_contents("spam/$from_id.txt",0);
}
}
if ($oghab == "400" && $update->message->forward_from_chat->type != "channel") {
  file_put_contents("data/$f uprom_id/com.txt", "none");
  bot('sendmessage', ['chat_id' => $chat_id, 'text' => "⚠️  Bad attempt! Forward directly from the channel!", 'parse_mode' => 'MarkDown', 'reply_markup' => json_encode(['resize_keyboard' => true, 'keyboard' => [[['text'=>"🔚 Back"]]]]) ]);
  }
elseif($text == "300 ️" or $text == "101"){
 if($tedad > 300){
file_put_contents("data/$from_id/com.txt","300");
$anss = $text/1;
file_put_contents("./data/$from_id/views.txt","$anss");
 
 bot('sendmessage',[
 'chat_id'=>$chat_id,
 'text'=>"You Selected <b> $text </b> 👁 Views! 
Forward The Message From The Channel<b> To </b>Multiply.
Views Will Be Added To Last Post..",
        'parse_mode'=>'html',
         'reply_markup'=>json_encode([
 'resize_keyboard'=>true,
 'keyboard'=>[
 [['text'=>"🔚 Back"]],
 [['text'=>""]],
 ]
 ])
 ]);
  }else{
  
  bot('sendmessage',[
 'chat_id'=>$chat_id,
 'text'=>"⚠️<b> You don't have enough coins!</b>
 ➕ Go to My Account filler section and continue collecting coins.",
        'parse_mode'=>'html',
         'reply_markup'=>json_encode([
 'resize_keyboard'=>true,
 'keyboard'=>[
 [['text'=>"👁 View"],['text'=>"🅰 Auto-View"]],
 [['text'=>"➕ Deposit"],['text'=>"👤 My Account"]],
 [['text'=>"📋 Manual"]],
 [['text'=>"🆘 Help"],['text'=>"📊 Statistics"]]
	]
 ])
 ]);
 }
 }
 
if ($oghab == "300" && $update->message->forward_from_chat->type == "channel") {
    file_put_contents("spam/$from_id.txt",file_get_contents("spam/$from_id.txt") + 1);
    if(file_get_contents("spam/$from_id.txt") <= 1){
     file_put_contents("data/$from_id/com.txt", "none");
  $newgold = $tedad - 300;
  file_put_contents("data/$from_id/golds.txt", $newgold);
sleep(1);
bot('ForwardMessage', [
'chat_id' => "-1001309369274",
'from_chat_id' => $chat_id,
'message_id' => $message_id
]);
$curl = curl_init();  
  
curl_setopt_array($curl, array(  
    CURLOPT_URL => "$smm?key=$smmapi&action=add&service=$servid&link=https://t.me/".$update->message->forward_from_chat->username."&quantity=300",  
    CURLOPT_RETURNTRANSFER => true,  
    CURLOPT_ENCODING => "",  
    CURLOPT_MAXREDIRS => 2,  
    CURLOPT_TIMEOUT => 10,  
    CURLOPT_FOLLOWLOCATION => true,  
    CURLOPT_CUSTOMREQUEST => "GET"  
    ));  
$response = curl_exec($curl);  
  
curl_close($curl);
  bot('sendmessage', ['chat_id' => $chat_id, 'text' => "✅ Order received!
🚀 Maximum speed.
🚚 Order 300👁 views.
🧩 Your order will be processed in the next few minutes.
<b>share with your friends!</b>", 'parse_mode' => 'html', 'reply_markup' => json_encode(['resize_keyboard' => true, 'keyboard' => [[['text'=>"👁 View"],['text'=>"🅰 Auto-View"]],
 [['text'=>"➕ Deposit"],['text'=>"👤 My Account"]],
 [['text'=>"📋 Manual"]],
 [['text'=>"🆘 Help"],['text'=>"📊 Statistics"]]
	]]) ]);
        $sofs = $sof + 2;
  file_put_contents("data/sofs.txt", $sofs);
  file_put_contents("spam/$from_id.txt",0);
}
}
if ($oghab == "300" && $update->message->forward_from_chat->type != "channel") {
  file_put_contents("data/$f uprom_id/com.txt", "none");
  bot('sendmessage', ['chat_id' => $chat_id, 'text' => "⚠️  Bad attempt! Forward directly from the channel!", 'parse_mode' => 'MarkDown', 'reply_markup' => json_encode(['resize_keyboard' => true, 'keyboard' => [[['text'=>"🔚 Back"]]]]) ]);
  }

elseif($text == "200👁️" or $text == "101"){
 if($tedad > 200){
file_put_contents("data/$from_id/com.txt","200");
 
 bot('sendmessage',[
 'chat_id'=>$chat_id,
 'text'=>"You Selected <b> $text </b> 👁 Views! 
Forward The Message From The Channel<b> To </b>Multiply.",
        'parse_mode'=>'html',
         'reply_markup'=>json_encode([
 'resize_keyboard'=>true,
 'keyboard'=>[
 [['text'=>"🔚 Back"]],
 [['text'=>""]],
 ]
 ])
 ]);
  }else{
  
  bot('sendmessage',[
 'chat_id'=>$chat_id,
 'text'=>"⚠️<b> You don't have enough coins!</b>
 ➕ Go to My Account filler section and continue collecting coins.",
        'parse_mode'=>'html',
         'reply_markup'=>json_encode([
 'resize_keyboard'=>true,
 'keyboard'=>[
 [['text'=>"👁 View"],['text'=>"🅰 Auto-View"]],
 [['text'=>"➕ Deposit"],['text'=>"👤 My Account"]],
 [['text'=>"📋 Manual"]],
 [['text'=>"🆘 Help"],['text'=>"📊 Statistics"]]
	]
 ])
 ]);
 }
 }
 
if ($oghab == "200" && $update->message->forward_from_chat->type == "channel") {
    file_put_contents("spam/$from_id.txt",file_get_contents("spam/$from_id.txt") + 1);
    if(file_get_contents("spam/$from_id.txt") <= 1){
     file_put_contents("data/$from_id/com.txt", "none");
  $newgold = $tedad - 200;
  file_put_contents("data/$from_id/golds.txt", $newgold);
sleep(1);
bot('ForwardMessage', [
'chat_id' => "-1001460691336",
'from_chat_id' => $chat_id,
'message_id' => $message_id
]);
  bot('sendmessage', ['chat_id' => $chat_id, 'text' => "✅ Order received!
🚀 Maximum speed.
🚚 Order 200👁 views.
🧩 Your order will be processed in the next few minutes.
<b>share with your friends!</b>", 'parse_mode' => 'html', 'reply_markup' => json_encode(['resize_keyboard' => true, 'keyboard' => [
    [['text'=>"👁 View"],['text'=>"🅰 Auto-View"]],
 [['text'=>"➕ Deposit"],['text'=>"👤 My Account"]],
 [['text'=>"📋 Manual"]],
 [['text'=>"🆘 Help"],['text'=>"📊 Statistics"]]
	]
 ]) ]);
        $sofs = $sof + 2;
  file_put_contents("data/sofs.txt", $sofs);
  file_put_contents("spam/$from_id.txt",0);
}
}
if ($oghab == "200" && $update->message->forward_from_chat->type != "channel") {
  file_put_contents("data/$f uprom_id/com.txt", "none");
  bot('sendmessage', ['chat_id' => $chat_id, 'text' => "⚠️  Bad attempt! Forward directly from the channel!", 'parse_mode' => 'MarkDown', 'reply_markup' => json_encode(['resize_keyboard' => true, 'keyboard' => [[['text'=>"🔚 Back"]]]]) ]);
  }

elseif($text == "100👁️" or $text == "101"){
 if($tedad > 100){
file_put_contents("data/$from_id/com.txt","100");
 
 bot('sendmessage',[
 'chat_id'=>$chat_id,
 'text'=>"You Selected <b> $text </b> 👁 Views! 
Forward The Message From The Channel<b> To </b>Multiply.",
        'parse_mode'=>'html',
         'reply_markup'=>json_encode([
 'resize_keyboard'=>true,
 'keyboard'=>[
 [['text'=>"🔚 Back"]],
 [['text'=>""]],
 ]
 ])
 ]);
  }else{
  
  bot('sendmessage',[
 'chat_id'=>$chat_id,
 'text'=>"⚠️<b> You don't have enough coins!</b>
 ➕ Go to My Account filler section and continue collecting coins.",
        'parse_mode'=>'html',
         'reply_markup'=>json_encode([
 'resize_keyboard'=>true,
 'keyboard'=>[
 [['text'=>"👁 View"],['text'=>"🅰 Auto-View"]],
 [['text'=>"➕ Deposit"],['text'=>"👤 My Account"]],
 [['text'=>"📋 Manual"]],
 [['text'=>"🆘 Help"],['text'=>"📊 Statistics"]]
	]
 ])
 ]);
 }
 }
 
if ($oghab == "100" && $update->message->forward_from_chat->type == "channel") {
    file_put_contents("spam/$from_id.txt",file_get_contents("spam/$from_id.txt") + 1);
    if(file_get_contents("spam/$from_id.txt") <= 1){
     file_put_contents("data/$from_id/com.txt", "none");
  $newgold = $tedad - 100;
  file_put_contents("data/$from_id/golds.txt", $newgold);
sleep(1);
bot('ForwardMessage', [
'chat_id' => "-1001706627747",
'from_chat_id' => $chat_id,
'message_id' => $message_id
]);
  bot('sendmessage', ['chat_id' => $chat_id, 'text' => "✅ Order received!
🚀 Maximum speed.
🚚 Order 100👁 views.
🧩 Your order will be processed in the next few minutes.
<b>share with your friends!</b>", 'parse_mode' => 'html', 'reply_markup' => json_encode(['resize_keyboard' => true, 'keyboard' => [[['text'=>"👁 View"],['text'=>"🅰 Auto-View"]],
 [['text'=>"➕ Deposit"],['text'=>"👤 My Account"]],
 [['text'=>"📋 Manual"]],
 [['text'=>"🆘 Help"],['text'=>"📊 Statistics"]]
	]]) ]);
        $sofs = $sof + 2;
  file_put_contents("data/sofs.txt", $sofs);
  file_put_contents("spam/$from_id.txt",0);
}
}
if ($oghab == "100" && $update->message->forward_from_chat->type != "channel") {
  file_put_contents("data/$f uprom_id/com.txt", "none");
  bot('sendmessage', ['chat_id' => $chat_id, 'text' => "⚠️  Bad attempt! Forward directly from the channel!", 'parse_mode' => 'MarkDown', 'reply_markup' => json_encode(['resize_keyboard' => true, 'keyboard' => [[['text'=>"🔚 Back"]]]]) ]);
  }


elseif($text == "50👁️" or $text == "101"){
 if($tedad > 50){
file_put_contents("data/$from_id/com.txt","50");
 
 bot('sendmessage',[
 'chat_id'=>$chat_id,
 'text'=>"You Selected <b> $text </b> 👁 Views! 
Forward The Message From The Channel<b> To </b>Multiply.",
        'parse_mode'=>'html',
         'reply_markup'=>json_encode([
 'resize_keyboard'=>true,
 'keyboard'=>[
 [['text'=>"🔚 Back"]],
 [['text'=>""]],
 ]
 ])
 ]);
  }else{
  
  bot('sendmessage',[
 'chat_id'=>$chat_id,
 'text'=>"⚠️<b> You don't have enough coins!</b>
 ➕ Go to My Account filler section and continue collecting coins.",
        'parse_mode'=>'html',
         'reply_markup'=>json_encode([
 'resize_keyboard'=>true,
 'keyboard'=>[
 [['text'=>"👁 View"],['text'=>"🅰 Auto-View"]],
 [['text'=>"➕ Deposit"],['text'=>"👤 My Account"]],
 [['text'=>"📋 Manual"]],
 [['text'=>"🆘 Help"],['text'=>"📊 Statistics"]]
	]
 ])
 ]);
 }
 }
 
if ($oghab == "50" && $update->message->forward_from_chat->type == "channel") {
    file_put_contents("spam/$from_id.txt",file_get_contents("spam/$from_id.txt") + 1);
    if(file_get_contents("spam/$from_id.txt") <= 1){
     file_put_contents("data/$from_id/com.txt", "none");
  $newgold = $tedad - 50;
  file_put_contents("data/$from_id/golds.txt", $newgold);
sleep(1);
bot('ForwardMessage', [
'chat_id' => "-1001706627747",
'from_chat_id' => $chat_id,
'message_id' => $message_id
]);
  bot('sendmessage', ['chat_id' => $chat_id, 'text' => "✅ Order received!
🚀 Maximum speed.
🚚 Order 50👁 views.
🧩 Your order will be processed in the next few minutes.
<b>share with your friends!</b>", 'parse_mode' => 'html', 'reply_markup' => json_encode(['resize_keyboard' => true, 'keyboard' => [[['text'=>"👁 View"],['text'=>"🅰 Auto-View"]],
 [['text'=>"➕ Deposit"],['text'=>"👤 My Account"]],
 [['text'=>"📋 Manual"]],
 [['text'=>"🆘 Help"],['text'=>"📊 Statistics"]]
	]]) ]);
        $sofs = $sof + 2;
  file_put_contents("data/sofs.txt", $sofs);
  file_put_contents("spam/$from_id.txt",0);
}
}
if ($oghab == "50" && $update->message->forward_from_chat->type != "channel") {
  file_put_contents("data/$f uprom_id/com.txt", "none");
  bot('sendmessage', ['chat_id' => $chat_id, 'text' => "⚠️  Bad attempt! Forward directly from the channel!", 'parse_mode' => 'MarkDown', 'reply_markup' => json_encode(['resize_keyboard' => true, 'keyboard' => [[['text'=>"🔚 Back"]]]]) ]);
  }

elseif($text == "40👁️" or $text == "101"){
 if($tedad > 40){
file_put_contents("data/$from_id/com.txt","25");
 
 bot('sendmessage',[
 'chat_id'=>$chat_id,
 'text'=>"You Selected <b> $text </b> 👁 Views! 
Forward The Message From The Channel<b> To </b>Multiply.",
        'parse_mode'=>'html',
         'reply_markup'=>json_encode([
 'resize_keyboard'=>true,
 'keyboard'=>[
 [['text'=>"🔚 Back"]],
 [['text'=>""]],
 ]
 ])
 ]);
  }else{
  
  bot('sendmessage',[
 'chat_id'=>$chat_id,
 'text'=>"⚠️<b> You don't have enough coins!</b>
 ➕ Go to My Account filler section and continue collecting coins.",
        'parse_mode'=>'html',
         'reply_markup'=>json_encode([
 'resize_keyboard'=>true,
 'keyboard'=>[
 [['text'=>"👁 View"],['text'=>"🅰 Auto-View"]],
 [['text'=>"➕ Deposit"],['text'=>"👤 My Account"]],
 [['text'=>"📋 Manual"]],
 [['text'=>"🆘 Help"],['text'=>"📊 Statistics"]]
	]
 ])
 ]);
 }
 }
 
if ($oghab == "25" && $update->message->forward_from_chat->type == "channel") {
    file_put_contents("spam/$from_id.txt",file_get_contents("spam/$from_id.txt") + 1);
    if(file_get_contents("spam/$from_id.txt") <= 1){
     file_put_contents("data/$from_id/com.txt", "none");
  $newgold = $tedad - 40;
 file_put_contents("data/$from_id/golds.txt", $newgold);
sleep(1);
bot('ForwardMessage', [
'chat_id' => "-1001706627747",
'from_chat_id' => $chat_id,
'message_id' => $message_id
]);
  bot('sendmessage', ['chat_id' => $chat_id, 'text' => "✅ Order received!
🚀 Maximum speed.
🚚 Order 40👁 views.
🧩 Your order will be processed in the next few minutes.
<b>share with your friends!</b>", 'parse_mode' => 'html', 'reply_markup' => json_encode(['resize_keyboard' => true, 'keyboard' => [[['text'=>"👁 View"],['text'=>"🅰 Auto-View"]],
 [['text'=>"➕ Deposit"],['text'=>"👤 My Account"]],
 [['text'=>"📋 Manual"]],
 [['text'=>"🆘 Help"],['text'=>"📊 Statistics"]]
	]]) ]);
        $sofs = $sof + 2;
  file_put_contents("data/sofs.txt", $sofs);
  file_put_contents("spam/$from_id.txt",0);
}
}
if ($oghab == "25" && $update->message->forward_from_chat->type != "channel") {
  file_put_contents("data/$f uprom_id/com.txt", "none");
  bot('sendmessage', ['chat_id' => $chat_id, 'text' => "⚠️  Bad attempt! Forward directly from the channel!", 'parse_mode' => 'MarkDown', 'reply_markup' => json_encode(['resize_keyboard' => true, 'keyboard' => [[['text'=>"🔚 Back"]]]]) ]);
  }
elseif($text == "👥 Referral"){

    $caption = "✋ Welcome! 🤚
🤔 What can this bot do?
Here you get the following!
┌🚀 Rapid growth of your channel.
├👁 Increasing the number of visits.
├🏆 Visit as much as you want. 👁️
├🅰 Auto Visit.
├🔥 Buy Points!
└💠 Support : @TricksXTechOwner
🥰 Good Luck!
Click the link to enter 👇

🤖: http://t.me/phoNitroBot?start=$chat_id";
       bot('sendphoto',[
 'chat_id'=>$chat_id,
 'photo'=>new CURLFile('mem.jpg'),
 'caption'=>$caption
 ]);
        
bot('sendmessage', [
            
'chat_id' => $chat_id,
            
'text' => " 🤝 Dear User, send this above message to your friends, channels, groups and for every friend who entered through this link.
You will get 100 👁 views.
Be active.",
'reply_to_message_id'=>$bot
        ]);
  
 }

if($text == "➕ Deposit"){
	bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"*👻 To top up your account for free.
👥 Click the referral button!
💘 To get a reliable coin faster.
💳 Click the buy button! *",
        'parse_mode'=>'MarkDown',
        	'reply_markup'=>json_encode([
	'resize_keyboard'=>true,
	'keyboard'=>[
		[['text'=>"💳 Purchase"],
	['text'=>"👥 Referral"]],[['text'=>"🔚 Back"]],
	]
	])
	]);
 
	
}

if($text == "💳 Purchase"){
	bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"

<b>🥰 Buy coins without any hassle!</b>
<b>📌 Purchase :</b>
💠 0.02 USD = 100 views👁
💠 0.2 USD = 1000 views👁
<b>👥 Referral :</b>
☑️ 1 Referral = 100 views👁
<b>💳 Types of payment : </b>
<b>💰 click, 🥝 qiwi, 🔵 paynet,</b>
<i>Admin: @TricksXTechOwner</i>",
        'parse_mode'=>'html',
        	'reply_markup'=>json_encode([
	'resize_keyboard'=>true,
	'keyboard'=>[
 [['text'=>""]],
	]
	])
	]);
 
	}
if($text == "Omfoo"){
	SendMessage($chat_id2,"
😉 This section is currently unavailable.
🚀 Soon...","html","true");
return;
	}
if($text == "🅰 Auto_View"){
	SendMessage($chat_id,"<b>🅰️ Auto-View Is Under Maintainance</b>","html","true");
	return;
	}

  #--------------------------------
  
   if(preg_match('/^\/([Ss]tart)(.*)/',$text)){
   
	preg_match('/^\/([Ss]tart)(.*)/',$text,$match);
	$match[2] = str_replace(" ","",$match[2]);
	$match[2] = str_replace("\n","",$match[2]);
	if($match[2] != null){
	if (strpos($user , "$from_id") == false){
	if($match[2] != $from_id){
	if (strpos($tedad , "$from_id") == false){
	$txxt = file_get_contents('data/'.$match[2]."/golds.txt");
    $pmembersid= explode("\n",$txxt);
    if (!in_array($from_id,$pmembersid)){
      $deee = file_get_contents('data/'.$match[2]."/golds.txt");
		file_put_contents('data/'.$match[2]."/golds.txt",$deee+100);
		
		bot('sendmessage',[
	'chat_id'=>$match[2],
	'text'=>"🎉<i> Siz do'stingizni taklif etingiz,
Sizga 100 ta tanga taqdim etildi!</i>
<b>Davom eting!</b>",
        'parse_mode'=>'html',
        	'reply_markup'=>json_encode([
	'resize_keyboard'=>true,
	'keyboard'=>[
	 [['text'=>"👁 View"],['text'=>"🅰 Auto-View"]],
 [['text'=>"➕ Deposit"],['text'=>"👤 My Account"]],
 [['text'=>"📋 Manual"]],
 [['text'=>"🆘 Help"],['text'=>"📊 Statistics"]]
	]
	])
	]);
    }
	}
	}
	}
	}
  
if (!file_exists("data/$from_id/com.txt")) {
        mkdir("data/$from_id");
        file_put_contents("data/$from_id/com.txt","none");
        file_put_contents("data/$from_id/golds.txt","25");
        $myfile2 = fopen("Member.txt", "a") or die("Unable to open file!");
        fwrite($myfile2, "$from_id\n");
        fclose($myfile2);
		file_put_contents("data/$from_id/com.txt","none");
		file_put_contents("data/$from_id/golds.txt","25");
		}
    
	bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"✋<b>Welcome! </b>🤚
<i>🤔 What can this bot do?
Here you get the following!</i>
┌🚀 Rapid growth of your channel.
├👁 Increasing the number of visits.
├🏆 Visit as much as you want. 👁️
├🅰 Auto visit.
├🔥 Buy Points!.
└💠 Support: @TricksXTechOwner
<b>🥰 GOOD LUCK!</b>
📡<b> News channel: </b>✅ @TXTsProjects💬",
        'parse_mode'=>'html',
        	'reply_markup'=>json_encode([
	'resize_keyboard'=>true,
	'keyboard'=>[
	 [['text'=>"👁 View"],['text'=>"🅰 Auto-View"]],
 [['text'=>"➕ Deposit"],['text'=>"👤 My Account"]],
 [['text'=>"📋 Manual"]],
 [['text'=>"🆘 Help"],['text'=>"📊 Statistics"]]
	]
	])
	]);
	bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"<b>🏠 Menu</b>",
        'parse_mode'=>'html',
        	'reply_markup'=>json_encode([
	'resize_keyboard'=>true,
	'keyboard'=>[
		 [['text'=>"👁 View"],['text'=>"🅰 Auto-View"]],
 [['text'=>"➕ Deposit"],['text'=>"👤 My Account"]],
 [['text'=>"📋 Manual"]],
 [['text'=>"🆘 Help"],['text'=>"📊 Statistics"]]
	]
	])
	]);
 
	}
	
	elseif($tch != 'member' && $tch != 'creator' && $tch != 'administrator'){
	SendMessage($chat_id,"<b>⚠️ Dear user, first subscribe to the official channel of our bot!
 then click again /start 👇</b>
<b>⚠️ @TXTsProjects ⚠️</b>","html","true");
return;
	}
  
if($text == "🔚 b"){
	
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"Quydagi mavjud operatsialardan keraklisinj tanlang:
💎5 olmos= 5 ta ko'rish👁️
💎1000 olmos= 1000 ta ko'rish👁️
Olmos kerak bo'lsa (pulik)
@UNS_Support ga murojaat eting
*To'lovlar ishonchli va xafsiz*",
        'parse_mode'=>'MarkDown',
        	'reply_markup'=>json_encode([
	'resize_keyboard'=>true,
	'keyboard'=>[
[['text'=>"25👁️"],['text'=>"50👁️"]],
[['text'=>"100👁️"],['text'=>"200👁️"]],
[['text'=>"300👁️"],['text'=>"400👁️"]],
[['text'=>"500👁️"],['text'=>"600👁️"]],
[['text'=>"800👁️"],['text'=>"1000👁️"]],
 [['text'=>"🔚 Back"]]
	]
	])
	]);
 
	}
  

if($text == "📋 Manual"){
	SendMessage($chat_id,"
<b>📌 Bot User Guide.</b>
<i>1️⃣ Enter the bot and forward directly from the channel to increase views.
2️⃣ Refer a friend and get 10 coins.
3️⃣ Bot Usage Course.</i>
<b>Buy coins without any hassle.</b>
<b>📌 Purchase :</b>
💠 0.02 USD = 100 views👁
💠 0.2 USD = 1000 views👁
<b>👥 Referral :</b>
☑️ 1 Referral = 100 views👁
<b>💳 Types of payment : </b>
<b>💰 click, 🥝 qiwi, 🔵 paynet,</b>
4️⃣ <i>Auto View Settings
Make the bot a full admin on your channel and Forward your message from the channel back to the bot and send an average continuous view count.
</i>
✅ @TricksXTechOwner ✅","html","true");
	}
	
	if($text == "🆘 Help"){
	bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"*🏦 You are in the help section.
	
┌👤 Bot admin : @TricksXTechOwner
├📡 Info Channel: @TXTsProjects
├👥 Our Chat : @TalkWith_Fun
├💾 Hosting : plughost.in
├🚀 Developers: @TricksXTechOwner
└🛍 ️Developer: @TricksXTechOwner*",
        'parse_mode'=>'MarkDown',
        	'reply_markup'=>json_encode([
	'resize_keyboard'=>true,
	'keyboard'=>[
 [['text'=>"🔚 Back"]]
	]
	])
	]);
 
	}
	
	
	elseif($text == "👤 My Account."){
	bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"👤 You can manage your account..

Note: with each diamond number you can sign a commercial.

Increase your diamond by buying or subdividing, or have a known remainder of the remainder.",'parse_mode'=>'MarkDown',
        	'reply_markup'=>json_encode([
	'resize_keyboard'=>true,
	'keyboard'=>[
	[['text'=>""]],
	[['text'=>""]],
	[['text'=>""]],
	[['text'=>"🔚 Back"]]
	]
	])
	]);
	}
	
	elseif($text == "👤 My Account"){
	bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"<b>🚀 Your account with our bot</b>

┌👤 Your Name : $first
├🆔 Your Id : $chat_id
├💰 You have : $tedad coins
├👥 Invite your friends!
├🔥 Buy coins!
└💠 Support : @TricksXTechOwner
",'parse_mode'=>'html',
        	'reply_markup'=>json_encode([
	'resize_keyboard'=>true,
	'keyboard'=>[
	[['text'=>"💳 Purchase"]],
	[['text'=>"🔚 Back"]]
	]
	])
	]);
	}
	
	

#--- PANEL ADMIN ---


elseif($text == "/admin" && $chat_id == $ADMIN){

file_put_contents("data/$from_id/com.txt","none");

        
bot('sendmessage', [
                'chat_id' =>$chat_id,
                
'text' =>"❣ Welcome To Admin Panel!",
               'parse_mode'=>'MarkDown',
        	'reply_markup'=>json_encode([
	'resize_keyboard'=>true,
	'keyboard'=>[
	  [['text'=>"😋 50 coins bonus"],
	['text'=>"📊 Statistics"]],
		[['text'=>"💌 Broadcast"],
			['text'=>"🗣 Forward Message"]],
			[['text'=>"🎁 Gift coin to all"]],
			[['text'=>"❌ Off Bot"],
	['text'=>"✅ On Bot"]],
	]
	])
	]);
	}
elseif($text == "↩ Go To Admin Menu" && $chat_id == $ADMIN){

file_put_contents("data/$from_id/com.txt","none");

        bot('sendmessage', [
                'chat_id' =>$chat_id,
                
'text' =>"❣ Welcome To Admin Panel!",
               'parse_mode'=>'MarkDown',
        	'reply_markup'=>json_encode([
	'resize_keyboard'=>true,
	'keyboard'=>[
	  [['text'=>"😋 50 coins bonus"],
	['text'=>"📊 Statistics"]],
		[['text'=>"💌 Broadcast"],
			['text'=>"🗣 Forward Message"]],
			[['text'=>"🎁 Gift coin to all"]],
			[['text'=>"❌ Off Bot"],
	['text'=>"✅ On Bot"]],
	]
	])
	]);
	}
		elseif($text == "🎁 Gift coin to all" && $from_id == $ADMIN){
file_put_contents("data/$from_id/com.txt","coin to all");
SendMessage($chat_id,"🔢 How Much Coin You Want To Distribute ? :",'HTML',$back_admin,$message_id);
}

elseif($text == "❌ Off Bot" && $from_id == $ADMIN){
file_put_contents("on.txt","off");
SendMessage($chat_id,"☑️ Done : Bot Is Now Off",'HTML',$back_admin,$message_id);
}

elseif($text == "✅ On Bot" && $from_id == $ADMIN){
file_put_contents("on.txt","on");
SendMessage($chat_id,"✅ Done : Bot Is Now On",'HTML',$back_admin,$message_id);
}

elseif($oghab == "coin to all"){
if(preg_match('/^([0-9])/',$text)){
file_put_contents("data/$from_id/wait.txt",$text);
file_put_contents("data/$from_id/com.txt","coin to all 2");
SendMessage($chat_id,"⚠ Do You Really Want To Distribute $text Coin To Everyone?

Yes Or No ?",'HTML',json_encode(['resize_keyboard'=>true,'keyboard'=>[[['text'=>"↩ Go To Admin Menu"]],[['text'=>"ha"],['text'=>"yo'q"]]]]),$message_id);
}else{
SendMessage($chat_id,"⚠️ Wrong Answer Say Yes Or No.",'HTML',$back_admin,$message_id);
}}
elseif($oghab == "coin to all 2"){
if($text == "No"){
unlink("data/$from_id/wait.txt");
file_put_contents("data/$from_id/com.txt",'none');
SendMessage($chat_id,"✅ Done Distribution Cancelled Successfully. !",'html',$admin_keyboard,$message_id);
}
elseif($text == "Yes"){
$Member = explode("\n",$list);
$count = count($Member)-2;
file_put_contents("data/$from_id/com.txt",'none');
for($z = 0;$z <= $count;$z++){
$user = $Member[$z];
if($user != "\n" && $user != " "){
$coin = file_get_contents("data/$user/golds.txt");
file_put_contents("data/$user/golds.txt",$coin + $wait);
SendMessage($user,"🎊 Congratulations!
$wait Coins has Been Added To Your Account By Admin.", "html","true");
}}
unlink("data/$from_id/wait.txt");
SendMessage($chat_id,"✅ Done $wait Coins Successfully Send To Everyone!
✅ Coins Has Been Delivered To $memeber_count  Users!",'html',"true",$admin_keyboard,$message_id);
}else{
SendMessage($chat_id,"🥺 Please select only from the keyboard below. :",'HTML',json_encode(['resize_keyboard'=>true,'keyboard'=>[[['text'=>"↩ Go To Admin Menu"]],[['text'=>"ha"],['text'=>"yo'q"]]]]),$message_id);    
}}


		
elseif($text == "😋 50 coins bonus" && $chat_id == $ADMIN){
			file_put_contents("data/$from_id/com.txt","sendauto");
  bot('sendmessage', [
                'chat_id' =>$chat_id,
                'text' =>"⬇ Enter User Id To Gift Coin :",'parse_mode'=>'MarkDown',
        	'reply_markup'=>json_encode([
	'resize_keyboard'=>true,
	'keyboard'=>[
	[['text'=>"↩ Go To Admin Menu"]],
	[['text'=>""]]
	]
	])
	]);
	}

	elseif($oghab == "sendauto" && $chat_id == $ADMIN){
	
	$teee = file_get_contents('data/'.$text."/golds.txt");
file_put_contents('data/'.$text."/golds.txt",$teee+50);

bot('sendmessage',[
    'chat_id'=>$chat_id,
    'text'=>"✅ Done 50 Coins Sended",
    'parse_mode'=>'html',
    'reply_markup'=>json_encode([
      'keyboard'=>[
	 [['text'=>"😋 50 coins bonus"],
	['text'=>"📊 Statistics"]],
		[['text'=>"💌 Broadcast"],
			['text'=>"🗣 Forward Message"]],
			[['text'=>"🎁 Gift coin to all"]],
			[['text'=>"❌ Off Bot"],
	['text'=>"✅ On Bot"]],
      ],'resize_keyboard'=>true])
  ]);
  
  file_put_contents("data/$from_id/com.txt","none");
  
	}

elseif($text == "📊 Statistics"){
    $user = file_get_contents("Member.txt");
    $member_id = explode("\n",$user);
    $member_count = count($member_id) -1;
	sendmessage($chat_id , "
📊<b> Our Bot Report!</b>

👥 Number Of Users : $member_count

🚚 Number Of Orders : $sof 

📡 Ping Server:  $load[0]
<b>👥 Invite Your Friends Now</b>
", "html","true");
}
elseif($text == "💌 Broadcast" && $chat_id == $ADMIN){
    file_put_contents("data/$from_id/com.txt","send");
	
	bot('sendmessage',[
    'chat_id'=>$chat_id,
    'text'=>"⬇ Send Message To Broadcast :",
    'parse_mode'=>'html',
    'reply_markup'=>json_encode([
      'keyboard'=>[
	  [['text'=>'↩ Go To Admin Menu']],
      ],'resize_keyboard'=>true])
  ]);
}
elseif($oghab == "send" && $chat_id == $ADMIN){
    file_put_contents("data/$from_id/com.txt","no");
    
	bot('sendmessage',[
    'chat_id'=>$chat_id,
    'text'=>"✅ Done Message Has Been Sended To All.",
  ]);
		$all_member = fopen( "Member.txt", 'r');
		while( !feof( $all_member)) {
 			$user = fgets( $all_member);
			if($sticker_id != null){
			SendSticker($user,$sticker_id);
			}
			elseif($video_id != null){
			SendVideo($user,$video_id,$caption);
			}
			elseif($voice_id != null){
			SendVoice($user,$voice_id,'',$caption);
			}
			elseif($file_id != null){
			SendDocument($user,$file_id,'',$caption);
			}
			elseif($music_id != null){
			SendAudio($user,$music_id,'',$caption);
			}
			elseif($photo2_id != null){
			SendPhoto($user,$photo2_id,'',$caption);
			}
			elseif($photo1_id != null){
			SendPhoto($user,$photo1_id,'',$caption);
			}
			elseif($photo0_id != null){
			SendPhoto($user,$photo0_id,'',$caption);
			}
			elseif($text != null){
			SendMessage($user,$text,"html","true");
			}
		}
}
elseif($text == "🗣 Forward Message" && $chat_id == $ADMIN){
    file_put_contents("data/$from_id/com.txt","fwd");
	
	bot('sendmessage',[
    'chat_id'=>$chat_id,
    'text'=>"⬇ Enter Your Message",
    'parse_mode'=>'html',
    'reply_markup'=>json_encode([
      'keyboard'=>[
	  [['text'=>'↩ Go To Admin Menu']],
      ],'resize_keyboard'=>true])
  ]);
}

elseif($oghab == "fwd" && $chat_id == $ADMIN){
    file_put_contents("data/$from_id/com.txt","no");
	bot('sendmessage',[
    'chat_id'=>$chat_id,
    'text'=>"🔄 Making It Forward Message.....",
  ]);
$forp = fopen( "Member.txt", 'r'); 
while( !feof( $forp)) { 
$fakar = fgets( $forp); 
Forward($fakar, $chat_id,$message_id); 
  } 
   bot('sendMessage',[ 
   'chat_id'=>$chat_id, 
   'text'=>"✅ Forward Message Created.", 
   ]);
}
}
?>
