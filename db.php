<?php
$server = "prognet.localnet";
$user = "2205551010";
$pass = "2205551010";
$database = "db_2205551010";

$koneksi = new mysqli($server, $user, $pass, $database);

if ($koneksi->connect_error) {
    die("Koneksi Gagal: " . $koneksi->connect_error);
}

// CREATE (Tambah Data)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tambah'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];
    $usia = $_POST['usia'];
    $jeniskelamin = $_POST['jeniskelamin'];
    $warnafavorit = implode(", ", $_POST['warna']);
    $hobi = $_POST['hobi']
    ;

    $sql = "INSERT INTO tb_form (nama, email, alamat, usia, jeniskelamin, warna, hobi) VALUES ('$nama', '$email', '$alamat', $usia, '$jeniskelamin', '$warnafavorit', '$hobi')";

    if ($koneksi->query($sql) === TRUE) {
        echo "Data berhasil ditambahkan";
    } else {
        echo "Error: " . $sql . "<br>" . $koneksi->error;
    }
}

// READ (Baca Data)
$sql = "SELECT * FROM tb_form";
$result = $koneksi->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>Data:</h2>";
    echo "<table border='1'>";
    echo "<tr><th>Nama</th><th>Email</th><th>Alamat</th><th>Usia</th><th>Jenis Kelamin</th><th>Warna Favorit</th><th>Hobi</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["nama"] . "</td><td>" . $row["email"] . "</td><td>" . $row["alamat"] . "</td><td>" . $row["usia"] . "</td><td>" . $row["jeniskelamin"] . "</td><td>" . $row["warna"] . "</td><td>" . $row["hobi"] . "</td></tr>";
    }
    echo "</table>";
} else {
    echo "Tidak ada data.";
}

// DELETE (Hapus Data)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['hapus'])) {
    $nama = $_POST['hapus_nama'];
    $sql = "DELETE FROM tb_form WHERE nama='$nama'";

    if ($koneksi->query($sql) === TRUE) {
        echo "Data berhasil dihapus";
    } else {
        echo "Error: " . $sql . "<br>" . $koneksi->error;
    }
}

$koneksi->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tugas 1</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="index.html">Pemrograman Internet</a>
    </nav>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h3 class="text-center">Tugas CRUD</h3>
                <form action="" method="post">
                    <!-- Form untuk menambah data -->
                    <h4>Tambah Data:</h4>
                    <div class="form-group">
                        <label for="nama">Nama:</label>
                        <input type="text" class="form-control" name="nama" id="nama" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="text" class="form-control" name="email" id="email" required>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat:</label>
                        <input type="text" class="form-control" name="alamat" id="alamat" required>
                    </div>
                    <div class="form-group">
                        <label for="usia">Usia:</label>
                        <input type="text" class="form-control" name="usia" id="usia" required>
                    </div>
                    <div class="form-group">
                        <label for="jeniskelamin">Jenis Kelamin:</label><br>
                        <input type="radio" id="Laki-Laki" name="jeniskelamin" value="Laki-Laki">
                        <label for="Laki-Laki">Laki-Laki</label><br>
                        <input type="radio" id="perempuan" name="jeniskelamin" value="perempuan">
                        <label for="perempuan">Perempuan</label><br>
                    </div>
                    <div class="form-group">
                        <label for="warnafavorit">Pilih Warna Favorit:</label><br>
                        <input type="checkbox" id="warna1" name="warna[]" value="Merah">
                        <label for="warna1">Merah</label><br>
                        <input type="checkbox" id="warna2" name="warna[]" value="Biru">
                        <label for="warna2">Biru</label><br>
                        <input type="checkbox" id="warna3" name="warna[]" value="Hijau">
                        <label for="warna3">Hijau</label><br>
                    </div>
                    <div class="form-group">
                        <label for="hobi">Hobi:</label><br>
                        <select class="form-control" name="hobi" id="hobi" required>
                            <option value="">Pilih Hobi</option>
                            <option value="Membaca">Membaca</option>
                            <option value="Olahraga">Olahraga</option>
                            <option value="Bermain Musik">Bermain Musik</option>
                            <option value="Makan">Makan</option>
                        </select><br>
                    </div>
                    <button type="submit" class="btn btn-dark" name="tambah">Tambah</button>
                </form>

                <!-- Form untuk menghapus data -->
                <h4>Hapus Data:</h4>
                <form action="" method="post">
                    <div class="form-group">
                        <label for="hapus_nama">Hapus berdasarkan Nama:</label>
                        <input type="text" class="form-control" name="hapus_nama" id="hapus_nama" required>
                    </div>
                    <button type="submit" class="btn btn-danger" name="hapus">Hapus</button>
                </form>
            </div>
        </div>
    </div>

</body>
</html>
