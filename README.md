# retrieve-data-indodax
sebuah aplikasi web yang berfungsi untuk menampilkan dan mengambil data dari API indodax

## Penting : 
- struktur dari database dapat dilihat pada berkas koin.sql
- sambungan pada database terdapat pada berkas konek.php

## Fungsi Berkas :
- index.php berfungsi menampilkan langsung data yang didapat dari API indodax
- perolehanData.php berfungsi menampilkan data yang telah didapat dan disimpan pada database, kolom yang ditampilkan antara lain nama aset, low, high, last, vol_coin & vol_pair, buy, sell, dan server_time.
- perolehanData2.php berfungsi menampilkan data yang telah didapat dan disimpan pada database, kolom yang ditampilkan adalah nama aset, high, low, last, server_time, range, top_range, lower_range, % range, % top range, dan % lower range.
- retrieveData.php berfungsi mengambil data menggunakan API bacth (https://indodax.com/api/tickers) secara manual. pada berkas ini memungkinkan penambahan nama aset baru secara otomatis.
- retrieveDataSingle.php berfungsi mengambil data menggunakan API single (https://indodax.com/api/nama_aset/ticker) secara manual. metode ini lebih ringan namun penambahan aset baru harus dilakukan secara manual pada database.
- fungsi,php berfungsi untuk menyimpan fungsi-fungsi selain fungsi database.

## Rumus :
nilai dari range, top_range, lower_range, % range, % top range, dan % lower range didapat dari rumus yang berdasarkan artikel yang berjudul "Rizubot Version 1.0 algorithm: How to read the price movements of Crypto Currency Using the API to find a good purchase price". berikut rumus dari nilai-nilai tersebut :
- High – Low = Range
- High – Last = Top Range
- Last - Low = Lower Range
- Range / Lower Range * 100% = % of Range
- Top Range / Range *100%= % of Top Range
- Low Range / Range *100%= % of Lower Range


### NB : untuk mengotomatiskan fungsi pengambilan data gunakan cron job atau job scheduler lainnya. Arahkan cron job pada file retrieveData.php / retrieveDataSingle.php (cth: www.domain.com/retrieveData.php)
