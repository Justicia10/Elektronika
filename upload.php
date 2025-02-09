<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $description = $_POST['description'];
    $file = $_FILES['file'];

    // Pastikan direktori upload ada
    $uploadDir = 'uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Simpan file ke server
    $fileName = basename($file["name"]);
    $filePath = $uploadDir . $fileName;
    move_uploaded_file($file["tmp_name"], $filePath);

    // Simpan ke database
    $sql = "INSERT INTO assignments (file_path, description) VALUES ('$fileName', '$description')";
    if ($conn->query($sql) === TRUE) {
        echo "<script>
                alert('Tugas berhasil diupload!');
                window.location.href = 'index.php';
              </script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
