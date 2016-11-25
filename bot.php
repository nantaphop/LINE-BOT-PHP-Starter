<?php
$access_token = 'milcol1eihnEjRBq1K2YsDxZePWnLOcC6fvz38MMWqrA9C/LAYbYlV15Pq0NQS3dy/DLRx+XiH3K7Xb5mr44+ej8pBVVAmpxHiG37VPK+DlUBVwYePDgWzIdS/fHul9mSD3npXl7Xk+c+MTS690lDAdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;