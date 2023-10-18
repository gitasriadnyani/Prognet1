<?php
$server = "prognet.localnet";
$user = "2205551010";
$pass = "2205551010";
$database = "db_2205551010";

$koneksi = new mysqli($server, $user, $pass, $database);

if ($koneksi->connect_error) {
    die("Koneksi Gagal: " . $koneksi->connect_error);
}

$id = $_GET['id'];

$sql = "SELECT * FROM tb_form WHERE id = $id";
$result = $koneksi->query($sql);

if ($result->num_rows > 0) {
    $data = $result->fetch_assoc();
    $vNama = $data['nama'];
    $vEmail = $data['email'];
    $vAlamat = $data['alamat'];
    $vUsia = $data['usia'];
    $vJenisKelamin = $data['jeniskelamin'];
    $vWarnaFavorit = explode(", ", $data['warna']);
    $vHobi = $data['hobi'];
} else {
    echo "Data tidak ditemukan.";
}
// UPDATE (Pembaruan Data)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $nama = $_POST['update_nama'];
    $email = $_POST['update_email'];
    $alamat = $_POST['update_alamat'];
    $usia = $_POST['update_usia'];
    $jeniskelamin = $_POST['update_jeniskelamin'];
    $warnafavorit = implode(", ", $_POST['update_warna']);
    $hobi = $_POST['update_hobi'];

    $sql = "UPDATE tb_form SET
        nama = '$nama',
        email = '$email',
        alamat = '$alamat',
        usia = $usia,
        jeniskelamin = '$jeniskelamin',
        warna = '$warnafavorit',
        hobi = '$hobi'
        WHERE id = $id";

    if ($koneksi->query($sql) === True) {
        echo "Data berhasil diperbarui";
    } else {
        echo "Error: " . $sql . "<br>" . $koneksi->error;
    }
}
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
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="index.html">Pemrograman Internet</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.html">Beranda</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="./read.php">Kembali</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-12"> <!-- Mengatur lebar maksimum -->
                <h3 class="text-center">Update Data</h3>
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="update_nama">Nama:</label>
                            <input type="text" class="form-control" name="update_nama" id="update_nama" value="<?php echo $vNama; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="update_email">Email:</label>
                            <input type="text" class="form-control" name="update_email" id="update_email" value="<?php echo $vEmail; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="update_alamat">Alamat:</label>
                            <input type="text" class="form-control" name="update_alamat" id="update_alamat" value="<?php echo $vAlamat; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="update_usia">Usia:</label>
                            <input type="number" class="form-control" name="update_usia" id="update_usia" value="<?php echo $vUsia; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="update_jeniskelamin">Jenis Kelamin:</label><br>
                            <input type="radio" id="update_Laki-Laki" name="update_jeniskelamin" value="Laki-Laki" <?php if ($vJenisKelamin == 'Laki-Laki') echo 'checked'; ?>>
                            <label for="update_Laki-Laki">Laki-Laki</label><br>
                            <input type="radio" id="update_perempuan" name="update_jeniskelamin" value="Perempuan" <?php if ($vJenisKelamin == 'Perempuan') echo 'checked'; ?>>
                            <label for="update_perempuan">Perempuan</label><br>
                        </div>
                        <div class="form-group">
                            <label for="update_warna">Pilih Warna Favorit:</label><br>
                            <input type="checkbox" id="update_warna1" name="update_warna[]" value="Merah" <?php if (in_array('Merah', $vWarnaFavorit)) echo 'checked'; ?>>
                            <label for="update_warna1">Merah</label><br>
                            <input type="checkbox" id="update_warna2" name="update_warna[]" value="Biru" <?php if (in_array('Biru', $vWarnaFavorit)) echo 'checked'; ?>>
                            <label for="update_warna2">Biru</label><br>
                            <input type="checkbox" id="update_warna3" name="update_warna[]" value="Hijau" <?php if (in_array('Hijau', $vWarnaFavorit)) echo 'checked'; ?>>
                            <label for="update_warna3">Hijau</label><br>
                        </div>
                        <div class="form-group">
                            <label for="update_hobi">Hobi:</label><br>
                            <select class="form-control" name="update_hobi" id="update_hobi" required>
                                <option value="">Pilih Hobi</option>
                                <option value="Membaca" <?php if ($vHobi == 'Membaca') echo 'selected'; ?>>Membaca</option>
                                <option value="Olahraga" <?php if ($vHobi == 'Olahraga') echo 'selected'; ?>>Olahraga</option>
                                <option value="Bermain Musik" <?php if ($vHobi == 'Bermain Musik') echo 'selected'; ?>>Bermain Musik</option>
                                <option value="Makan" <?php if ($vHobi == 'Makan') echo 'selected'; ?>>Makan</option>
                            </select><br>
                        </div>
                        <button type="submit" class="btn btn-dark" name="update">Update</button>
                    </form>
            </div>
        </div>
    </div>
    <br><br>
    
    <script src="script.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
