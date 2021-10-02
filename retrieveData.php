<?php
// pada metode batch ini juga memungkinkan menambah nama aset baru pada database secara otomatis

date_default_timezone_set('Asia/Jakarta');
require 'konek.php';
require 'fungsi.php';

$koin = getAllData('tbl_market');

$api = curl("https://indodax.com/api/tickers"); // API market place Indodax
$hasil = json_decode($api, true);

foreach ($hasil as $tickers) {
    foreach ($tickers as $aset => $a) {
        list($coin, $pair) = explode('_', $aset);
        $tgl = date("Y-m-j H:i:s", $a['server_time']);

        $range = $a['high'] - $a['low'];
        $topRange = $a['high'] - $a['last'];
        $lowerRange = ($a['last'] - $a['low']) == 0 ? 0.0000001 : ($a['last'] - $a['low']);
        $percentRange = $range / $lowerRange * 100;
        $percentTopRange = $topRange / $range * 100;
        $percentLowerRange = $lowerRange / $range * 100;

        $status = 0;     // variabel untuk mengetahui aset yang sudah ada pada DB, 0 : belum terdaftar; 1 : terdaftar

        foreach ($koin as $key => $v) {
            if ($aset == $v['nama_market']) {
                $ambil = retrieveData($v['id'], $a['high'], $a['low'], $a["vol_$coin"], $a["vol_$pair"], $a['last'], $a['buy'], $a['sell'], $tgl, $range, $topRange, $lowerRange, $percentRange, $percentTopRange, $percentLowerRange);
                $status = 1;
                break;
            }
        }
        if ($ambil) {
            echo "Berhasil ambil data : $aset - ";
        } else {
            echo mysqli_error($conn);
        }

        // jika status masih 0 (belum terdaftar), maka akan ditambahkan pada tbl_market
        if ($status == 0) {
            $tambahAset = insertMarket($aset, $pair);
            if ($tambahAset) {
                echo "Menambahkan aset : $aset";
            } else {
                echo mysqli_error($conn);
            }
        }
    }
}
