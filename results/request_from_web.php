<?php
/**
 * Created by Earrow.
 * User:Kasun De Mel
 * Email:kasun@earrow.net
 * Date: 3/22/2019
 * Time: 1:17 PM
 */


//$request_url='http://122.255.11.150/esms/agriculture_results/web_results.php?id='.$_POST['id'];
$request_url='http://ww2.earrow.net/aq_agri/agriculture_results/web_auth_results.php?id='.$_POST['id'];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $request_url);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec($ch);
curl_close($ch);

print_r($response);
die();
