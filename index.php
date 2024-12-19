<?php
include 'config.php';

// Proses penyimpanan data mahasiswa ke database
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mengambil data dari form
    $nama = $_POST['nama'];
    $jurusan = $_POST['jurusan'];
    $tahun_ajaran = $_POST['tahun_ajaran'];
    $nilai = $_POST['nilai'];
    $tanggal_daftar = $_POST['tanggal_daftar'];

    // Query untuk memasukkan data mahasiswa
    $insert_query = "INSERT INTO mahasiswa (nama, jurusan, tahun_ajaran, nilai, tanggal_daftar) 
                     VALUES ('$nama', '$jurusan', '$tahun_ajaran', '$nilai', '$tanggal_daftar')";

    // Menjalankan query
    if ($conn->query($insert_query) === TRUE) {
        echo "Data mahasiswa berhasil ditambahkan!";
    } else {
        echo "Error: " . $insert_query . "<br>" . $conn->error;
    }
}

// Fungsi untuk menghitung jumlah mahasiswa
$count_query = "SELECT COUNT(*) AS total_mahasiswa FROM mahasiswa";
$count_result = $conn->query($count_query);
$count_row = $count_result->fetch_assoc();
$total_mahasiswa = $count_row['total_mahasiswa'];

// Fungsi untuk menghitung rata-rata nilai mahasiswa
$avg_query = "SELECT AVG(nilai) AS rata_rata_nilai FROM mahasiswa";
$avg_result = $conn->query($avg_query);
$avg_row = $avg_result->fetch_assoc();
$rata_rata_nilai = $avg_row['rata_rata_nilai'];

// Fungsi untuk menghitung nilai maksimal
$max_query = "SELECT MAX(nilai) AS nilai_tertinggi FROM mahasiswa";
$max_result = $conn->query($max_query);
$max_row = $max_result->fetch_assoc();
$nilai_tertinggi = $max_row['nilai_tertinggi'];

// Fungsi untuk menghitung nilai minimal
$min_query = "SELECT MIN(nilai) AS nilai_terendah FROM mahasiswa";
$min_result = $conn->query($min_query);
$min_row = $min_result->fetch_assoc();
$nilai_terendah = $min_row['nilai_terendah'];

// Fungsi untuk menghitung total nilai mahasiswa
$sum_query = "SELECT SUM(nilai) AS total_nilai FROM mahasiswa";
$sum_result = $conn->query($sum_query);
$sum_row = $sum_result->fetch_assoc();
$total_nilai = $sum_row['total_nilai'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistik Mahasiswa</title>
</head>
<body>
    <h1>Statistik Mahasiswa</h1>

    <!-- Form untuk Menambahkan Data Mahasiswa -->
    <h2>Tambah Mahasiswa</h2>
    <form method="POST" action="index.php">
        <label for="nama">Nama:</label><br>
        <input type="text" id="nama" name="nama" required><br><br>

        <label for="jurusan">Jurusan:</label><br>
        <input type="text" id="jurusan" name="jurusan" required><br><br>

        <label for="tahun_ajaran">Tahun Ajaran:</label><br>
        <input type="number" id="tahun_ajaran" name="tahun_ajaran" required><br><br>

        <label for="nilai">Nilai:</label><br>
        <input type="number" id="nilai" name="nilai" step="0.01" required><br><br>

        <label for="tanggal_daftar">Tanggal Daftar:</label><br>
        <input type="date" id="tanggal_daftar" name="tanggal_daftar" required><br><br>

        <input type="submit" value="Tambah Mahasiswa">
    </form>

    <br>

    <!-- Menampilkan Statistik Mahasiswa -->
    <table border="1">
        <tr>
            <th>Total Mahasiswa</th>
            <td><?php echo $total_mahasiswa; ?></td>
        </tr>
        <tr>
            <th>Rata-Rata Nilai</th>
            <td><?php echo number_format($rata_rata_nilai, 2); ?></td>
        </tr>
        <tr>
            <th>Nilai Tertinggi</th>
            <td><?php echo $nilai_tertinggi; ?></td>
        </tr>
        <tr>
            <th>Nilai Terendah</th>
            <td><?php echo $nilai_terendah; ?></td>
        </tr>
        <tr>
            <th>Total Nilai</th>
            <td><?php echo $total_nilai; ?></td>
        </tr>
    </table>

    <h2>Data Mahasiswa</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Jurusan</th>
            <th>Tahun Ajaran</th>
            <th>Nilai</th>
            <th>Tanggal Daftar</th>
        </tr>
        <?php
        $data_query = "SELECT * FROM mahasiswa";
        $data_result = $conn->query($data_query);

        while ($row = $data_result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['nama'] . "</td>";
            echo "<td>" . $row['jurusan'] . "</td>";
            echo "<td>" . $row['tahun_ajaran'] . "</td>";
            echo "<td>" . $row['nilai'] . "</td>";
            echo "<td>" . $row['tanggal_daftar'] . "</td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>
