<?php
include 'db.php';

// Cek apakah ID dikirim melalui URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Ambil nama file berdasarkan ID
    $sql = "SELECT * FROM assignments WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $filePath = 'uploads/' . $row['file_path'];

        // Hapus file jika ada
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        // Hapus data dari database
        $conn->query("DELETE FROM assignments WHERE id = $id");

        // Redirect kembali ke index.php
        header("Location: index.php");
        exit();
    } else {
        echo "<script>
                alert('Tugas tidak ditemukan!');
                window.location.href = 'index.php';
              </script>";
    }
} else {
    echo "<script>
            alert('ID tugas tidak valid!');
            window.location.href = 'index.php';
          </script>";
}
?>
