<?php
// Konfigurasi koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_kampus";

// Membuat koneksi ke MySQL
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// CREATE: Menambah data mahasiswa
if (isset($_POST['create'])) {
    $nama = $_POST['nama'];
    $id_jurusan = $_POST['id_jurusan'];
    $sql = "INSERT INTO mahasiswa (nama, id_jurusan) VALUES ('$nama', '$id_jurusan')";
    $conn->query($sql);
}

// UPDATE: Mengupdate data mahasiswa
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $id_jurusan = $_POST['id_jurusan'];
    $sql = "UPDATE mahasiswa SET nama='$nama', id_jurusan='$id_jurusan' WHERE id=$id";
    $conn->query($sql);
}

// DELETE: Menghapus data mahasiswa
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM mahasiswa WHERE id=$id";
    $conn->query($sql);
}

// Ambil data mahasiswa untuk ditampilkan
$sql = "SELECT mahasiswa.id, mahasiswa.nama, jurusan.nama_jurusan FROM mahasiswa 
        INNER JOIN jurusan ON mahasiswa.id_jurusan = jurusan.id_jurusan";
$result = $conn->query($sql);

// Ambil data jurusan untuk dropdown
$jurusan_result = $conn->query("SELECT * FROM jurusan");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Mahasiswa dan Jurusan</title>
    <style>
        table {
            width: 80%;
            border-collapse: collapse;
            margin: 20px auto;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        form {
            text-align: center;
            margin: 20px;
        }
    </style>
</head>
<body>
    <h2 style="text-align: center;">CRUD Mahasiswa dan Jurusan</h2>

    <!-- Form untuk menambah data mahasiswa -->
    <form method="POST">
        <input type="text" name="nama" placeholder="Nama Mahasiswa" required>
        <select name="id_jurusan" required>
            <option value="">Pilih Jurusan</option>
            <?php while ($jurusan = $jurusan_result->fetch_assoc()) { ?>
                <option value="<?= $jurusan['id_jurusan']; ?>"><?= $jurusan['nama_jurusan']; ?></option>
            <?php } ?>
        </select>
        <button type="submit" name="create">Tambah Mahasiswa</button>
    </form>

    <!-- Tabel untuk menampilkan data mahasiswa -->
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Mahasiswa</th>
                <th>Jurusan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?= $row['id']; ?></td>
                    <td><?= $row['nama']; ?></td>
                    <td><?= $row['nama_jurusan']; ?></td>
                    <td>
                        <a href="update.php?id=<?= $row['id']; ?>">Edit</a> | 
                        <a href="index.php?delete=<?= $row['id']; ?>" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>

<?php
$conn->close();
?>
