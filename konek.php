<?php
ini_set('display_errors', 1);       // fungsi PHP untuk menampilkan error secara detail. Hapus jika tidak diperlukan
ini_set('memory_limit', '1024M');   // fungsi PHP untuk menambah ukuran memori. 

$hostname = 'localhost';    // nama server. "localhost" untuk penggunaan server local seperti XAMPP / MAMPP
$username = 'root';         // username untuk mengakses database
$password = '';             // password untuk mengakses database
$db       = 'koin';         // nama databases. sesuaikan dengan database yang dipakai

$conn = mysqli_connect($hostname, $username, $password, $db);

function getAllData($tabel, $limit = false, $clean = false)
{
    global $conn;
    $query1 = "SELECT * FROM $tabel";
    $query2 = "";
    $query3 = "";

    if ($clean != false) {
        $query2 = " WHERE $clean IS NOT NULL";
    }
    if ($limit != false) {
        $query3 = " LIMIT $limit";
    }

    $query = $query1 . $query2 . $query3;

    $hasil = mysqli_query($conn, $query);

    $rows = [];

    while ($row = mysqli_fetch_assoc($hasil)) {
        $rows[] = $row;
    }

    return $rows;
}

function getJumlah($tabel)
{
    global $conn;
    $query = "SELECT COUNT(*) FROM $tabel WHERE nilai_range IS NOT NULL";
    $hasil = mysqli_query($conn, $query);
    $jumlah = $hasil->fetch_assoc();
    return $jumlah;
}

function insertMarket($namaMarket, $pair)
{
    global $conn;
    $query = "INSERT INTO tbl_market (nama_market, pair) VALUES ('$namaMarket', '$pair')";
    $hasil = mysqli_query($conn, $query);
    return $hasil;
}

function retrieveData($id_coin, $high, $low, $vol_coin, $vol_pair, $last, $buy, $sell, $time, $range, $topRange, $lowerRange, $percentRange, $percentTopRange, $percentLowerRange)
{
    global $conn;
    $query = "INSERT INTO tbl_data (id_coin, high, low, vol_coin, vol_pair, last, buy, sell, server_time, nilai_range, top_range, lower_range, percent_range, percent_top_range, percent_lower_range) 
            VALUES ('$id_coin', '$high', '$low', '$vol_coin', '$vol_pair', '$last', '$buy', '$sell', '$time', '$range', '$topRange', '$lowerRange', '$percentRange', '$percentTopRange', '$percentLowerRange')";

    $hasil = mysqli_query($conn, $query);
    return $hasil;
}

function getNamaMarket($id_coin)
{
    global $conn;
    $query = "SELECT nama_market FROM tbl_market WHERE id = '$id_coin'";
    $hasil = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($hasil);
    return $row;
}
