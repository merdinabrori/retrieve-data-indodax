<?php
// pada metode single ini pengambilan data dilakukan relatif lebih ringan dengan satu foreach.
// namun hanya dapat mengambil aset yang sudah tersedia dalam database
// penambahan aset baru harus dilakukan secara manual

date_default_timezone_set('Asia/Jakarta');
require 'konek.php';
require 'fungsi.php';

$koin = getAllData('tbl_market');

foreach ($koin as $key => $v) {
    list($coin, $pair) = explode('_', $v['nama_market']);
    $api = curl("https://indodax.com/api/" . $v['nama_market'] . "/ticker");    // API market place Indodax
    $hasil = json_decode($api, true);
    $tgl = date("Y-m-d H:i:s", $hasil['ticker']['server_time']);

    $range = $hasil['ticker']['high'] - $hasil['ticker']['low'];
    $topRange = $hasil['ticker']['high'] - $hasil['ticker']['last'];
    $lowerRange = ($hasil['ticker']['last'] - $hasil['ticker']['low']) == 0 ? 1 : ($hasil['ticker']['last'] - $hasil['ticker']['low']);
    $percentRange = $range / $lowerRange * 100;
    $percentTopRange = $topRange / $range * 100;
    $percentLowerRange = $lowerRange / $range * 100;

    $ambil = retrieveData($v['id'], $hasil['ticker']['high'], $hasil['ticker']['low'], $hasil['ticker']["vol_$coin"], $hasil['ticker']["vol_$pair"], $hasil['ticker']['last'], $hasil['ticker']['buy'], $hasil['ticker']['sell'], $tgl, $range, $topRange, $lowerRange, $percentRange, $percentTopRange, $percentLowerRange);
    if ($ambil) {
        echo "Berhasil " . $v['nama_market'] . "- ";
    } else {
        echo mysqli_error($conn);
    }
}
