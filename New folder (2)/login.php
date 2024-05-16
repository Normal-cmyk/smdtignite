<?php

// Memuat pustaka Google Apps Script
require_once 'google/api/client/autoload.php';

// Menyiapkan autentikasi Google Apps Script
$client = new Google_Client();
$client->setAuthConfig('credentials.json');
$client->setScopes(['https://spreadsheets.google.com/feeds']);
$service = new Google_Service_Sheets($client);

// Membaca data dari Google Sheet
$spreadsheetId = '1SgXluuyEYEOhjEVwl5PJMwUDsvE0kSZBD6lphZNPXsc'; // Ganti dengan ID spreadsheet Anda
$range = 'Sheet1!A2:B'; // Ganti dengan range data Anda (misalnya: A2:B untuk tabel di atas)
$response = $service->spreadsheets_values->get($spreadsheetId, $range);
$values = $response->getValues();

// Mendapatkan data dari form
$username = $_POST['username'];
$password = $_POST['password'];

// Mencari pengguna di database Google Sheet
foreach ($values as $row) {
  if ($row[0] == $username && $row[1] == $password) {
    // Kredensial valid, redirect ke halaman lain
    header('Location: page.html');
    exit;
  }
}

// Kredensial tidak valid, tampilkan pesan error
echo "Nama Anda Tidak Terdaftar";

?>
