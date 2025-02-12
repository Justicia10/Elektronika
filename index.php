<?php
include 'db.php';

// Ambil data tugas dari database
$sql = "SELECT * FROM assignments ORDER BY uploaded_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Elektronika || Matahari</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        /* Background dengan Gradient Animasi */
        @keyframes gradientBackground {
            0% {
                background-color: #1a1a2e;
            }
            50% {
                background-color: #2e003e;
            }
            100% {
                background-color: #1a1a2e;
            }
        }

        body {
            background: linear-gradient(45deg, #1a1a2e, #2e003e);
            animation: gradientBackground 5s ease-in-out infinite;
            color: white;
            font-family: 'Poppins', sans-serif;
            animation: fadeIn 1s ease-in-out;
        }

        .container {
            max-width: 700px;
            margin-top: 20px;
        }

        /* Card dengan Efek Hover Glow */
        .card {
            margin-bottom: 15px;
            background-color: #222;
            border: none;
            color: white;
            transition: 0.3s;
            box-shadow: 0 0 10px rgba(128, 0, 128, 0.2);
            transform: scale(1);
            transition: all 0.3s ease-in-out;
        }

        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 0 20px rgba(128, 0, 128, 0.7);
            background-color: #333;
        }

        /* Tombol dengan Efek Neon */
        .btn-primary {
            background: linear-gradient(45deg, #9a00d4, #6a0dad);
            border: none;
            color: white;
            padding: 10px 20px;
            transition: all 0.3s ease-in-out;
            animation: neonGlow 1.5s ease-in-out infinite;
        }

        .btn-primary:hover {
            background: linear-gradient(45deg, #9a00d4, #c300ff);
            box-shadow: 0 0 20px #c300ff;
            transform: scale(1.1);
        }

        .btn-danger:hover {
            box-shadow: 0 0 10px red;
        }

        /* Efek Animasi */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Preview File */
        .file-preview {
            width: 100%;
            height: 250px;
            border: none;
            background-color: #1c1e21;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ccc;
            border-radius: 10px;
        }

        /* Efek Neon untuk Judul */
        h2 {
            font-size: 2.5rem;
            font-weight: 600;
            text-align: center;
            animation: neonGlow 1.5s ease-in-out infinite;
        }

        @keyframes neonGlow {
            0% {
                text-shadow: 0 0 5px #9a00d4, 0 0 10px #9a00d4, 0 0 15px #9a00d4, 0 0 20px #9a00d4;
            }
            50% {
                text-shadow: 0 0 10px #9a00d4, 0 0 20px #9a00d4, 0 0 30px #9a00d4, 0 0 40px #9a00d4;
            }
            100% {
                text-shadow: 0 0 5px #9a00d4, 0 0 10px #9a00d4, 0 0 15px #9a00d4, 0 0 20px #9a00d4;
            }
        }

        /* Styling Profil */
        .profile-container {
            background-color: #6a0dad; /* Warna latar belakang container */
            padding: 20px;
            border-radius: 10px;
            margin-top: 30px;
            text-align: center;
            color: white;
        }

        .profile-container img {
            border-radius: 50%;
            width: 150px;
            height: 150px;
            object-fit: cover;
        }

        .profile-container h4 {
            margin-top: 10px;
            font-size: 1.5rem;
        }

        .profile-container p {
            font-size: 1rem;
            margin: 5px 0;
        }

    </style>
</head>
<body>

<div class="container">
    <!-- Profil Saya -->
    <div class="profile-container">
        <img src="WhatsApp Image 2024-06-04 at 14.57.25_29c33b94.jpg" alt="Foto Profil">
        <h4>Nama : Matahari Dhia Alwafy</h4>
        <p>NIM: 224443081</p>
        <p>Kelas: 1AEC4</p>
        <p>Matkul: Elektronika</p>
    </div>

    <br>
    <br>

    <h2 class="text-center">Upload Tugas</h2>
    <h2 class="text-center">*cara pakai : klik kanan lalu save as untuk melihat file</h2>
    <br>
    <form action="upload.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <input type="file" name="file" class="form-control" required>
        </div>
        <div class="form-group">
            <textarea name="description" class="form-control" placeholder="Tambahkan deskripsi..." required></textarea>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Upload</button>
    </form>

    <hr>
    <br>

    <h2 class="text-center">Tugas yang Diupload</h2>
    <br>
    <div class="row">
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <p><?php echo htmlspecialchars($row['description']); ?></p>
                        <small class="text-muted">Diupload pada: <?php echo $row['uploaded_at']; ?></small>
                        <br><br>
                        <?php
                        $filePath = "uploads/" . $row['file_path'];
                        $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);
                        ?>

                        <!-- Menampilkan Preview Langsung -->
                        <div class="file-preview">
                            <?php if (in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif'])): ?>
                                <img src="<?php echo $filePath; ?>" alt="Preview" style="max-width: 100%; max-height: 250px; border-radius: 10px;">
                            <?php elseif ($fileExtension == 'pdf'): ?>
                                <iframe src="<?php echo $filePath; ?>" width="100%" height="250px"></iframe>
                            <?php else: ?>
                                <p>Preview tidak tersedia untuk jenis file ini.</p>
                            <?php endif; ?>
                        </div>

                        <br>
                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#confirmDeleteModal"
                                onclick="setDeleteId(<?php echo $row['id']; ?>)">
                            Hapus
                        </button>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteLabel">Konfirmasi Hapus</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus tugas ini? Tindakan ini tidak dapat dibatalkan.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <a id="confirmDeleteBtn" href="#" class="btn btn-danger">Hapus</a>
            </div>
        </div>
    </div>
</div>

<script>
    function setDeleteId(id) {
        document.getElementById("confirmDeleteBtn").href = "delete.php?id=" + id;
    }
</script>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>

