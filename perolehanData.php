<?php
ini_set('display_errors', 1);
date_default_timezone_set('Asia/Jakarta');
require 'konek.php';

// konfigurasi pagination
$jumlahDataHalaman  = 20;
$jumlahData         = count(getAllData('tbl_data'));
$jumlahHalaman      = ceil($jumlahData / $jumlahDataHalaman);
$halamanAktif       = (isset($_GET["hal"])) ? $_GET["hal"] : 1;
$dataAwal           = ($jumlahDataHalaman * $halamanAktif) - $jumlahDataHalaman;
$limit              = $dataAwal . ", " . $jumlahDataHalaman;

$market = getAllData('tbl_market');
$coins = getAllData('tbl_data', $limit);
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="styles.css">
    <title>Perolehan Data</title>
</head>

<body>
    <h2 style="text-align: center;">PEROLEHAN DATA</h2>
    <div style="margin-bottom: 1.5rem;">
        <a href="index.php" style="background: blue;">kembali</a><br>
    </div>

    <!-- navigasi halaman -->
    <?php if ($halamanAktif > 1) : ?>
        <a href="?hal=<?= $halamanAktif - 1; ?>">&laquo;</a>
        <?= ($halamanAktif > 4) ? '<a href="?hal=1">1</a>...' : ''; ?>
    <?php endif; ?>
    <?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
        <?php if ($i == $halamanAktif) : ?>
            <a href="?hal=<?= $i; ?>" style="background: darkcyan;"><?= $i; ?></a>
        <?php else : ?>
            <?php if (abs($i - $halamanAktif) <= 3) : ?>
                <a href="?hal=<?= $i; ?>"><?= $i; ?></a>
            <?php endif; ?>
        <?php endif; ?>
    <?php endfor; ?>
    <?php if ($halamanAktif < $jumlahHalaman) : ?>
        <?= ($halamanAktif < ($jumlahHalaman - 3)) ? '...<a href="?hal=' . $jumlahHalaman . '">' . $jumlahHalaman . '</a>' : ''; ?>
        <a href="?hal=<?= $halamanAktif + 1; ?>">&raquo;</a>
    <?php endif; ?>

    <table class="coins">
        <tr>
            <th>Market</th>
            <th>Tertinggi</th>
            <th>Terendah</th>
            <th>Volume koin</th>
            <th>Volume IDR/USD</th>
            <th>Harga sekarang</th>
            <th>Last Buy</th>
            <th>Last Sell</th>
            <th>Waktu</th>
        </tr>
        <?php foreach ($coins as $coin => $value) : ?>
            <tr>
                <td><?= implode("", getNamaMarket($value['id_coin'])); ?></td>
                <td><?= $value['high']; ?></td>
                <td><?= $value['low']; ?></td>
                <td><?= $value['vol_coin']; ?></td>
                <td><?= $value['vol_pair']; ?></td>
                <td><?= $value['last']; ?></td>
                <td><?= $value['buy']; ?></td>
                <td><?= $value['sell']; ?></td>
                <td><?= $value['server_time']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <!-- navigasi halaman -->
    <?php if ($halamanAktif > 1) : ?>
        <a href="?hal=<?= $halamanAktif - 1; ?>">&laquo;</a>
        <?= ($halamanAktif > 4) ? '<a href="?hal=1">1</a>...' : ''; ?>
    <?php endif; ?>
    <?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
        <?php if ($i == $halamanAktif) : ?>
            <a href="?hal=<?= $i; ?>" style="background: darkcyan;"><?= $i; ?></a>
        <?php else : ?>
            <?php if (abs($i - $halamanAktif) <= 3) : ?>
                <a href="?hal=<?= $i; ?>"><?= $i; ?></a>
            <?php endif; ?>
        <?php endif; ?>
    <?php endfor; ?>
    <?php if ($halamanAktif < $jumlahHalaman) : ?>
        <?= ($halamanAktif < ($jumlahHalaman - 3)) ? '...<a href="?hal=' . $jumlahHalaman . '">' . $jumlahHalaman . '</a>' : ''; ?>
        <a href="?hal=<?= $halamanAktif + 1; ?>">&raquo;</a>
    <?php endif; ?>

    <p>Jumlah data : <?= $jumlahData; ?></p>
</body>

</html>