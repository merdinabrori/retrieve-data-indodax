<?php
date_default_timezone_set('Asia/Jakarta');
error_reporting(0);
ini_set('display_errors', 0);
function curl($url)
{
    $ch = curl_init();

    // set URL
    curl_setopt($ch, CURLOPT_URL, $url);
    // return as a string
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    $hasil = curl_exec($ch);

    curl_close($ch);
    return $hasil;
}
