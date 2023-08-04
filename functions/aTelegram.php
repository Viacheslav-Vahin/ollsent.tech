<?php
//https://api.telegram.org/bot1980245605:AAGJmdtnV2rbn84VrtpPqJSMAflZPs1z0uQ/getUpdates
// 413781655   chat_id

//$recipient1 = $_POST['oderzuvach'];
//$mess1 = $_POST['message1'];
//$token = '1980245605:AAGJmdtnV2rbn84VrtpPqJSMAflZPs1z0uQ';
//$chat_id = $_POST['oder_id'];
//$arr = array(
//    'Уведомление с Ollsent-hire' => $mess1
//);
//
//foreach ($arr as $key => $value) {
//    $txt .="<b>".$key."</b>".$value."%0A";
//};
//$sendToTel = fopen("https://api.telegram.org/bot{$token}/sendMessage&chat_id={$chat_id}
//&parse_mode=html&text={$txt}", "r");


// if ($sendToTel) {
//     echo '<h1 class="succTelSent">Сообщение отправлено успешно:)</h1>';
//     return true;
// } else {
//     header('Location: thank-you.html');
// }

function sendTelegr() {
    //https://api.telegram.org/bot1980245605:AAGJmdtnV2rbn84VrtpPqJSMAflZPs1z0uQ/getUpdates
    // 413781655   chat_id
    $recipient1 = $_POST['oderzuvach'];
    $mess1 = $_POST['message1'];
    $token = '1980245605:AAGJmdtnV2rbn84VrtpPqJSMAflZPs1z0uQ';
    $chat_id = $_POST['oder_id'];
    $arr = array(
        'Уведомление с Ollsent-hire' => $mess1
    );

    foreach ($arr as $key => $value) {
        $txt .= "<b>" . $key . "</b>" . $value . "%0A";
    };
    $sendToTel = fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}
&parse_mode=html&text={$txt}", "r");
}