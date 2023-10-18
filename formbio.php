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
    <script>
        function showSuccessMessage() {
            alert("Data berhasil ditambahkan ke database!");
        }
    </script>
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
                    <a class="nav-link" href="read.php">Data</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h3 class="text-center">Tugas Javascript</h3>
                <form action="" method="post">
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
                        <input type="number" class="form-control" name="usia" id="usia" required>
                    </div>
                    <div class="form-group">
                        <label for="jeniskelamin">Jenis Kelamin:</label><br>
                        <input type="radio" id="Laki-Laki" name="jeniskelamin" value="Laki-Laki">
                        <label for="Laki-Laki">Laki-Laki</label><br>
                        <input type="radio" id="perempuan" name="jeniskelamin" value="perempuan">
                        <label for="perempuan">Perempuan</label><br>
                    </div>
                    <div class="form-group">
                        <label for="warnaFavorit">Pilih Warna Favorit:</label><br>
                        <input type="checkbox" id="warna1" name="warna1" value="Merah">
                        <label for="warna1">Merah</label><br>
                        <input type="checkbox" id="warna2" name="warna2" value="Biru">
                        <label for="warna2">Biru</label><br>
                        <input type="checkbox" id="warna3" name="warna3" value="Hijau">
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
                    <button type="submit" class="btn btn-dark" name="tambah">Kirim</button>
                    <button type="reset" onclick="return confirm('Apakah yakin ingin menghapus data?')" class="btn btn-danger" name="hapus">Hapus </button>
                    <br><br>
                </form>
                <?php
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tambah'])) {
                    $server = "prognet.localnet";
                    $user = "2205551010";
                    $pass = "2205551010";
                    $database = "db_2205551010";
                    
                    $koneksi = new mysqli($server, $user, $pass, $database);
                
                    if ($koneksi->connect_error) {
                        die("Koneksi Gagal: " . $koneksi->connect_error);
                    }
                
                    $nama = $_POST['nama'];
                    $email = $_POST['email'];
                    $alamat = $_POST['alamat'];
                    $usia = $_POST['usia'];
                    $jeniskelamin = $_POST['jeniskelamin'];
                    

                    $warnaFavorit = "";
                    if (isset($_POST['warna1'])) {
                        $warnaFavorit .= $_POST['warna1'] . ", ";
                    }
                    if (isset($_POST['warna2'])) {
                        $warnaFavorit .= $_POST['warna2'] . ", ";
                    }
                    if (isset($_POST['warna3'])) {
                        $warnaFavorit .= $_POST['warna3'] . ", ";
                    }
                    $warnaFavorit = rtrim($warnaFavorit, ", ");
                    
                    $hobi = $_POST['hobi'];
                
                    $sql = "INSERT INTO tb_form (nama, email, alamat, usia, jeniskelamin, warna, hobi) VALUES (?, ?, ?, ?, ?, ?, ?)";
                    $stmt = $koneksi->prepare($sql);
                
                    if ($stmt) {
                        $stmt->bind_param("sssisss", $nama, $email, $alamat, $usia, $jeniskelamin, $warnaFavorit, $hobi);
                
                        if ($stmt->execute()) {
                            echo '<div class="alert alert-success" role="alert">
                                    Data berhasil ditambahkan ke database!
                                  </div>';
                        } else {
                            echo "Error: " . $stmt->error;
                        }
                
                        $stmt->close();
                    } else {
                        echo "Error: " . $koneksi->error;
                    }
                
                    $koneksi->close();
                }
                ?>
            </div>
        </div>
    </div>
    
    <script src="script.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>