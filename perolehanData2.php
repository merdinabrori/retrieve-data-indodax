<?php
ini_set('display_errors', 1);
date_default_timezone_set('Asia/Jakarta');
require 'konek.php';

// konfigurasi pagination
$jumlahDataHalaman  = 20;
$jumlahData         = count(getAllData('tbl_data', false, 'nilai_range'));
$jumlahHalaman      = ceil($jumlahData / $jumlahDataHalaman);
$halamanAktif       = (isset($_GET["hal"])) ? $_GET["hal"] : 1;
$dataAwal           = ($jumlahDataHalaman * $halamanAktif) - $jumlahDataHalaman;
$limit              = $dataAwal . ", " . $jumlahDataHalaman;

$market = getAllData('tbl_market');
$coins = getAllData('tbl_data', $limit, 'nilai_range');
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="styles.css">
    <title>Perolehan Data</title>
</head>

<body>
    <h2 style="text-align: center;">PEROLEHAN DATA DENGAN RANGE</h2>
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
    <p>Jumlah data : <?= $jumlahData; ?></p>
    <table class="coins">
        <tr>
            <th>Market</th>
            <th>Tertinggi</th>
            <th>Terendah</th>
            <th>Harga sekarang</th>
            <th>Waktu</th>
            <th>Range</th>
            <th>Top Range</th>
            <th>Lower Range</th>
            <th>% Range</th>
            <th>% Top Range</th>
            <th>% Lower Range</th>
        </tr>
        <?php foreach ($coins as $coin => $value) : ?>
            <tr>
                <td><?= implode("", getNamaMarket($value['id_coin'])); ?></td>
                <td><?= $value['high']; ?></td>
                <td><?= $value['low']; ?></td>
                <td><?= $value['last']; ?></td>
                <td><?= $value['server_time']; ?></td>
                <td><?= $value['nilai_range']; ?></td>
                <td><?= $value['top_range']; ?></td>
                <td><?= $value['lower_range']; ?></td>
                <td><?= $value['percent_range']; ?></td>
                <td><?= $value['percent_top_range']; ?></td>
                <td><?= $value['percent_lower_range']; ?></td>
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
</body>

</html>