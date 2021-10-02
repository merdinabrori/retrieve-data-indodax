<?php
date_default_timezone_set('Asia/Jakarta');
require 'konek.php';
require 'fungsi.php';

$regis = curl("https://indodax.com/api/tickers"); // API market place Indodax
$result = json_decode($regis, true);
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="styles.css">
    <title>indodax API</title>
</head>

<body>
    <div>
        <!-- Tombol untuk mengambil data secara manual secara batch-->
        <a href="retrieveData.php" target="_blank" style="background: red;">Ambil Data Batch</a>
        <!-- Tombol untuk mengambil data secara manual secara single-->
        <a href="retrieveDataSingle.php" target="_blank" style="background: darkred;">Ambil Data Single</a>
        <a href="perolehanData.php" style="background: blue;">Lihat Perolehan Data</a>
        <a href="perolehanData2.php" style="background: green;">Lihat Perolehan Data dengan % Range</a>
        <h2 style="text-align: center;">Pantau Indodax</h2>
    </div>
    <table id="coins">
        <tr>
            <th>No.</th>
            <th>Market</th>
            <th>Tertinggi</th>
            <th>Persentase</th>
            <th>Terendah</th>
            <th>Volume koin</th>
            <th>Volume IDR/USD</th>
            <th>Harga sekarang</th>
            <th>Last Buy</th>
            <th>Last Sell</th>
            <th>Waktu</th>
        </tr>
        <?php
        $no = 1;
        foreach ($result as $tickers) {
            foreach ($tickers as $aset => $a) {
                list($coin, $pair) = explode('_', $aset);
                $seconds = $a["server_time"];
                $persen  = (($a['high'] - $a['low']) / $a['low']) * 100;
                $persenn = substr($persen, 0, 4);
        ?>

                <tr>
                    <td><?= $no; ?></td>
                    <td><?= $aset; ?></td>
                    <td><?= $a['high']; ?></td>
                    <td><?= $persenn; ?></td>
                    <td><?= $a['low']; ?></td>
                    <td><?= $a["vol_$coin"]; ?></td>
                    <td><?= $a["vol_$pair"]; ?></td>
                    <td><?= $a['last']; ?></td>
                    <td><?= $a['buy']; ?></td>
                    <td><?= $a['sell']; ?></td>
                    <td><?= date("d/m/Y H:i:s", $seconds); ?></td>
                </tr>
        <?php
                $no = $no + 1;
            }
        }
        ?>
    </table>
</body>

</html>