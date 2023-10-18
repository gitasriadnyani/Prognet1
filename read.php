<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data dari Database</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
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
    <!-- Bagian body HTML -->
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
    <div class="container mt-3">
        <h1 class="text-center">Data dari Database</h1>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Nomor</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Alamat</th> 
                        <th>Warna Favorit</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $server = "prognet.localnet";
                    $user = "2205551010";
                    $pass = "2205551010";
                    $database = "db_2205551010";

                    $koneksi = new mysqli($server, $user, $pass, $database);

                    if ($koneksi->connect_error) {
                        die("Koneksi Gagal: " . $koneksi->connect_error);
                    }

                    $sql = "SELECT * FROM tb_form";
                    $result = $koneksi->query($sql);

                    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['hapus'])) {
                        $hapus_id = $_POST['hapus_id'];
                        $sql = "DELETE FROM tb_form WHERE id='$hapus_id'";


                        if ($koneksi->query($sql) === TRUE) {
                            echo "Data berhasil dihapus";
                        } else {
                            echo "Error: " . $sql . "<br>" . $koneksi->error;
                        }
                    }

                    if ($result->num_rows > 0) {
                        $no = 1; // Inisialisasi nomor entri

                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $no++ . "</td>";
                            echo "<td>" . $row["nama"] . "</td>";
                            echo "<td>" . $row["email"] . "</td>";
                            echo "<td>" . $row["alamat"] . "</td>";
                            $colors = explode(", ", $row["warna"]);
                            $colorList = implode(", ", $colors);
                            echo "<td>" . $colorList . "</td>";
                            echo "<td>
                                    <a href='edit.php?id=" . $row["id"] . "'>Edit</a> |
                                    <form method='post' action='read.php'>
                                        <input type='hidden' name='hapus_id' value='" . $row["id"] . "'>
                                        <input type='submit' name='hapus' value='Delete'>
                                    </form> |
                                    <a href='hasil.php?id=" . $row["id"] . "'>Detail</a>
                                  </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "Tidak ada data.";
                    }

                    $koneksi->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
