<?php
class FCM {
function __construct() {
}

public function send_notification($registatoin_ids, $notification) {
$url = 'https://fcm.googleapis.com/fcm/send';
$apikey = 'AAAAWrgN_b8:APA91bFS8htzNSOlGORB3onITocW14DDw8CPv2NsC6FczH01elS6h7kDQsMPlQV9tdaJfzVeMPEoMHqiNAuZN3mW84mrR9LJBUg812JGaLd-hQv8ckhmEzQV-aJ_HLE-hWDVgY8K_FyH';

$fields = array(
'to' => $registatoin_ids,
'notification' => $notification
);


$headers = array('Authorization: key=' .$apikey, 'Content-Type: application/json');

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
$result = curl_exec($ch);
if ($result === FALSE) {
die('Curl failed: ' . curl_error($ch));
}
curl_close($ch);
echo $result;
}
}

?>