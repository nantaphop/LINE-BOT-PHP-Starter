<?php
$access_token = 'milcol1eihnEjRBq1K2YsDxZePWnLOcC6fvz38MMWqrA9C/LAYbYlV15Pq0NQS3dy/DLRx+XiH3K7Xb5mr44+ej8pBVVAmpxHiG37VPK+DlUBVwYePDgWzIdS/fHul9mSD3npXl7Xk+c+MTS690lDAdB04t89/1O/w1cDnyilFU=';

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent
			$text = $event['message']['text'];
			// Get replyToken
			$replyToken = $event['replyToken'];
            $replyText = $text;
            $shouldReply = false;
            if($text == 'พ่อวินชื่อไร'){
                $replyText = 'เจริญชัยไงครับ';
                $shouldReply = true;
            }else if($text == 'แม่วินชื่อไร'){
                $replyText = 'วัลลดาไงสัส';
                $shouldReply = true;
            }

			// Build message to reply back
			$messages = [
				'type' => 'text',
				'text' => $replyText
			];

			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
            $data = [];
            if($shouldReply){
                $data = [
                    'replyToken' => $replyToken,
                    'messages' => [$messages],
                ];
            
                $post = json_encode($data);
                $headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

                $ch = curl_init($url);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                $result = curl_exec($ch);
                curl_close($ch);

                echo $result . "\r\n";
            }
		}
	}
}
echo "OK";