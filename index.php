<?php

use Master\Menu;
use Master\Pelaku;
use Master\Pelanggan;
use Master\Produk;

include 'autoload.php';
include 'Config/Database.php';

$menu = new Menu();
$pelaku = new Pelaku($dataKoneksi);
$pelanggan = new Pelanggan($dataKoneksi);
$produk = new Produk($dataKoneksi);
// $mahasiswa->tambah();
$target = @$_GET['target'];
$act = @$_GET['act'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Marketplace UMKM Situbondo</title>
    <link href="assets/bootstrap/css/bootstrap.css" rel="stylesheet">
    <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark bg-info">
            <div class="container-fluid">
                <a class="navbar-brand" href="">UMKM SITUBONDO</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#MyMenu" aria- controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="MyMenu">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <?php
foreach ($menu->topMenu() as $r) {
    ?>
                            <li class="nav-item">
                                <a href="<?php echo $r['Link']; ?>" class="nav-link">
                                    <?php echo $r['Text']; ?>
                                </a>
                            </li>
                        <?php
}
?>
                    </ul>
                </div>
            </div>
        </nav>
        <br>
        <div class="content">
            <h5>Content <?php echo strtoupper($target); ?></h5>
            <?php
if (!isset($target) or $target == "home") {
    echo "Hai, Selamat Datang Di Beranda";
    // =========== start kontent pelaku ======================
} elseif ($target == "pelaku") {
    if ($act == "tambah_pelaku") {
        echo $pelaku->tambah();
    } elseif ($act == "simpan_pelaku") {
        if ($pelaku_umkm->simpan()) {
            echo "<script>
                            alert('data sukses disimpan');
                            window.location.href='?target=pelaku_umkm';
                        </script>";
        } else {
            echo "<script>
                            alert('data gagal disimpan');
                            window.location.href='?target=pelaku_umkm';
                        </script>";
        }
    } elseif ($act == "edit_pelaku") {
        $id = $_GET['id'];
        echo $pelaku->edit($id);
    } elseif ($act == "update_pelaku") {
        if ($pelaku->update()) {
            echo "<script>
                            alert('data sukses diubah');
                            window.location.href='?target=pelaku';
                        </script>";
        } else {
            echo "<script>
                            alert('data gagal diubah');
                            window.location.href='?target=pelaku';
                        </script>";
        }
    } elseif ($act == "delete_pelaku") {
        $id = $_GET['id'];
        if ($pelaku->delete($id)) {
            echo "<script>
                            alert('data sukses dihapus');
                            window.location.href='?target=pelaku';
                        </script>";
        } else {
            echo "<script>
                        alert('data gagal dihapus');
                        window.location.href='?target=pelaku';
                    </script>";
        }
    } else {
        echo $pelaku->index();
    }

    // pelanggan
} elseif ($target == "pelanggan") {
    if ($act == "tambah_pelanggan") {
        echo $pelanggan->tambah();
    } elseif ($act == "simpan_pelanggan") {
        if ($pelanggan->simpan()) {
            echo "<script>
                        alert('data sukses disimpan');
                        window.location.href='?target=pelanggan';
                    </script>";
        } else {
            echo "<script>
                        alert('data gagal disimpan');
                        window.location.href='?target=pelanggan';
                    </script>";
        }
    } elseif ($act == "edit_pelanggan") {
        $id = $_GET['id'];
        echo $pelanggan->edit($id);
    } elseif ($act == "update_pelanggan") {
        if ($pelanggan->update()) {
            echo "<script>
                        alert('data sukses diubah');
                        window.location.href='?target=pelanggan';
                    </script>";
        } else {
            echo "<script>
                        alert('data gagal diubah');
                        window.location.href='?target=pelanggan';
                    </script>";
        }
    } elseif ($act == "delete_pelanggan") {
        $id = $_GET['id'];
        if ($pelanggan->delete($id)) {
            echo "<script>
                        alert('data sukses dihapus');
                        window.location.href='?target=pelanggan';
                    </script>";
        } else {
            echo "<script>
                    alert('data gagal dihapus');
                    window.location.href='?target=pelanggan';
                </script>";
        }
    } else {
        echo $pelanggan->index();
    }

    // produk
} elseif ($target == "produk") {
    if ($act == "tambah_produk") {
        echo $produk->tambah();
    } elseif ($act == "simpan_produk") {
        if ($produk->simpan()) {
            echo "<script>
                        alert('data sukses disimpan');
                        window.location.href='?target=produk';
                    </script>";
        } else {
            echo "<script>
                        alert('data gagal disimpan');
                        window.location.href='?target=produk';
                    </script>";
        }
    } elseif ($act == "edit_produk") {
        $id = $_GET['id'];
        echo $produk->edit($id);
    } elseif ($act == "update_produk") {
        if ($produk->update()) {
            echo "<script>
                        alert('data sukses diubah');
                        window.location.href='?target=produk';
                    </script>";
        } else {
            echo "<script>
                        alert('data gagal diubah');
                        window.location.href='?target=produk';
                    </script>";
        }
    } elseif ($act == "delete_produk") {
        $id = $_GET['id'];
        if ($produk->delete($id)) {
            echo "<script>
                        alert('data sukses dihapus');
                        window.location.href='?target=produk';
                    </script>";
        } else {
            echo "<script>
                    alert('data gagal dihapus');
                    window.location.href='?target=produk';
                </script>";
        }
    } else {
        echo $produk->index();
    }

    // no pengguna
} elseif ($target == 'pengguna') {

    echo "selamat datang di pengguna";
}
?>
    </div>
</div>
</body>
</html>