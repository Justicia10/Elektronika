<?php
$host = "localhost";  // Server database (karena lokal, pakai "localhost")
$user = "root";       // Username MySQL default di XAMPP
$pass = "";           // Password default di XAMPP (kosongkan)
$dbname = "tugas_db"; // Nama database (harus sama dengan yang kamu buat di phpMyAdmin)

// Buat koneksi ke database
$conn = new mysqli($host, $user, $pass, $dbname);

// Periksa apakah koneksi berhasil
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
