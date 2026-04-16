<?php include('session.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/styleadmin.css">
    <title>Halaman Tambah Produk | Admin</title>
</head>

<body>
    <div class="wrapper">
        <div class="header"></div>

        <div class="sidebar">
            <div class="sidebar-title">Sehatkita Company</div>
            <ul>
                <?php include 'sidebar.php'; ?>
            </ul>
        </div>

        <div class="section">
            <div class="container">
                <?php
                $query = mysqli_query($conn, "SELECT * FROM tb_admin WHERE admin_id = '" . $_SESSION['id_login'] . "' ");
                $d = mysqli_fetch_object($query);
                ?>
                <form action="" method="POST">
                    <h3>Tambah Data Produk</h3>
                    <fieldset>
                        <label>Nama Produk</label>
                        <select name="kategori" class="form-control" required>
                            <option value="">Pilih</option>
                            <?php
                            $kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");
                                while ($r = mysqli_fetch_array($kategori)) {
                            ?>
                                    <option value="<?php echo $r['category_id']; ?>"><?php echo $r['category_name']; ?></option>
                            <?php 
                            } ?>

                        </select>
                    </fieldset>

                    <fieldset>
                        <button type="submit" name="submit" id="contact-submit" data-submit="...Sending">Tambah</button>
                    </fieldset>
                </form>
                <?php
                if (isset($_POST['submit'])) {
                    $nama = $_POST['nama'];

                    $insert = mysqli_query($conn, "INSERT INTO tb_category VALUES ('', '$nama')");

                    if ($insert) {
                        echo '<script>alert("Tambah data berhasil")</script>';
                        echo '<script>window.location="kategori_data.php"</script>';
                    } else {
                        echo 'gagal' . mysqli_error($conn);
                    }
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>