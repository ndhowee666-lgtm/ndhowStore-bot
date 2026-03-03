<?php
$token = "8708952369:AAETxuINdpLIGZaPBLEYobt6GNItQTpKjhE";
$api = "https://api.telegram.org/bot".$token."/";

$content = file_get_contents("php://input");
$update = json_decode($content, true);

if(isset($update["message"])){

    $chat_id = $update["message"]["chat"]["id"];
    $text = $update["message"]["text"];

    if($text == "/start"){
        sendMessage($chat_id, "Selamat datang di ndhowStore 🎬\n\nTekan tombol di bawah untuk beli.", [
            "keyboard" => [
                [["text"=>"🛒 BELI VLOG"]],
                [["text"=>"📩 HUBUNGI ADMIN"]]
            ],
            "resize_keyboard" => true
        ]);
    }

    elseif($text == "🛒 BELI VLOG"){
        sendMessage($chat_id, "🎬 VLOG PREMIUM\n\nHarga: Rp10.000\n\nSilakan scan QRIS lalu kirim bukti.");
    }

    elseif($text == "📩 HUBUNGI ADMIN"){
        sendMessage($chat_id, "Hubungi admin di:\n@usernamekamu");
    }
}

function sendMessage($chat_id, $text, $keyboard=null){
    global $api;

    $data = [
        "chat_id"=>$chat_id,
        "text"=>$text
    ];

    if($keyboard){
        $data["reply_markup"] = json_encode($keyboard);
    }

    file_get_contents($api."sendMessage?".http_build_query($data));
}
?>
