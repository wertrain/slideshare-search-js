<?php
/**
 * @author wertrain
 */
header("Content-Type: application/json; charset=utf-8");

$q = $_GET['keyword'];
$sort = "relevance";
if (isset($_GET['sort'])) {
    $sort = $_GET['sort'];
}
$lang = "ja";
if (isset($_GET['lang'])) {
    $lang = $_GET['lang'];
}
$api_key = getenv('API_KEY');
$api_secret = getenv('API_SECRET');
$ts = $_SERVER['REQUEST_TIME'];
$hash = sha1($api_secret.$ts);

$base_url = 'https://www.slideshare.net/api/2/search_slideshows';
$url = $base_url.'?q='.urlencode($q).'&items_per_page=20&page=1&lang='.$lang.'&sort='.$sort.'&upload_date=any&fileformat=all&file_type=all&api_key='.$api_key.'&hash='.$hash.'&ts='.$ts;
$curl = curl_init();
$option = [
    CURLOPT_URL => $url,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_RETURNTRANSFER => true,
];
curl_setopt_array($curl, $option);
$response = curl_exec($curl);
curl_close($curl);

$data = simplexml_load_string($response);
echo json_encode($data);

