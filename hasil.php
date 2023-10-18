<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Formulir</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #f2f2f2;
        }
        .container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
            margin-top: 20px;
        }
        table {
            width: 100%;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #333;
            color: #fff;
        }
        td {
            background-color: #f2f2f2;
        }
    </style>
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
        </div>
    </nav>
    <div class="container">
        <h2 class="text-center">Data Diri</h2>
        <table class="table">
            <?php
            $server = "prognet.localnet";
            $user = "2205551010";
            $pass = "2205551010";
            $database = "db_2205551010";

            $koneksi = new mysqli($server, $user, $pass, $database);

            if ($koneksi->connect_error) {
                die("Koneksi Gagal: " . $koneksi->connect_error);
            }

            if (isset($_GET['id'])) {
                $id = $_GET['id'];

                $sql = "SELECT * FROM tb_form WHERE id = $id";
                $result = $koneksi->query($sql);

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $name = $row['nama'];
                    $email = $row['email'];
                    $address = $row['alamat'];
                    $age = $row['usia'];
                    $jk = $row['jeniskelamin'];
                    $hobi = $row['hobi'];
                    $color = isset($row['warna']) ? $row['warna'] : '';

                    echo "<tr>
                            <th>Nama</th>
                            <td>$name</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>$email</td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td>$address</td>
                        </tr>
                        <tr>
                            <th>Usia</th>
                            <td>$age</td>
                        </tr>
                        <tr>
                            <th>Jenis Kelamin</th>
                            <td>$jk</td>
                        </tr>
                        <tr>
                            <th>Hobi</th>
                            <td>$hobi</td>
                        </tr>
                        <tr>
                            <th>Warna Favorit</th>
                            <td>$color</td>
                        </tr>";
                } else {
                    echo "Data tidak ditemukan.";
                }
            } else {
                echo "ID tidak ditemukan.";
            }

            $koneksi->close();
            ?>
        </table>
        <div class="text-center mt-3">
            <a href="./read.php" class="btn btn-dark">Kembali</a>
        </div>
    </div>
    <script src="script.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
