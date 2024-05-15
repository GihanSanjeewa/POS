<?php
/**
 * Created by Earrow.
 * User:Kasun De Mel
 * Email:kasun@earrow.net
 * Date: 3/22/2019
 * Time: 1:42 PM
 */

$request_url='http://ww2.earrow.net/aq_agri/agriculture_results/web_promotion_results.php?id='.$_POST['id'];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $request_url);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec($ch);

print_r($response);
die();

curl_close($ch);


return $response;