<?php include 'session.php'; ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/styleadmin.css">
    <title>Halaman Produk Tambah | Admin</title>
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
                $produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_id = '" . $_GET['id'] . "' ");
                if (mysqli_num_rows($produk) == 0) {
                    echo '<script>window.location="produk_data.php"</script>';
                }
                $p = mysqli_fetch_object($produk);
                ?>

                <form action="" method="post">
                    <h3>Edit Data Produk</h3>
                    <fieldset>
                        <label>Nama Kategori</label>
                        <select class="form-control" name="kategori" required>
                            <option value="">--Pilih--</option>
                            <?php
                            $kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");
                            while ($r = mysqli_fetch_array($kategori)) {
                                ?>
                                <option value="<?php echo $r['category_id'] ?>" <?php echo $r['category_id'] == $p->category_id ? 'selected' : '' ?>>
                                    <?php echo $r['category_name'] ?>
                                </option>
                            <?php } ?>
                        </select>
                    </fieldset>

                    <fieldset>
                        <label>Nama Produk</label>
                        <input type="text" name="nama" value="<?php echo $p->product_name ?>" class="form-control"
                            required>
                    </fieldset>

                    <fieldset>
                        <label>Harga</label>
                        <input type="text" name="harga" value="<?php echo $p->product_price ?>" class="form-control"
                            required>
                    </fieldset>

                    <fieldset>
                        <label>Gambar Produk</label>
                        <img src="../produk/<?php echo $p->product_image ?>" width="100px">
                        <input type="hidden" name="foto" value="<?php echo $p->product_image ?>">
                        <input type="file" name="gambar" placeholder="...Gambar Produk..." class="form-control">
                    </fieldset>

                    <fieldset>
                        <label>Deskripsi Produk</label>
                        <textarea class="form-control" name="deskripsi" placeholder="...Deskripsi Produk..."><?php echo $p->product_description; ?></textarea>
                     </fieldset>
                   
                    <fieldset>
                        <label>Status</label>
                        <select class="form-control" name="status">
                            <option value="">--Pilih--</option>
                            <option value="1" <?php echo $p->product_status == '1' ? 'selected' : '' ?>>Aktif </option>
                            <option value="0" <?php echo $p->product_status == '0' ? 'selected' : '' ?>>Tidak Aktif
                            </option>
                        </select>
                    </fieldset>

                    <fieldset>
                        <button name="submit" type="submit" id="contact-submit" data-submit="...Sending">Edit</button>
                    </fieldset>

                </form>
                <?php
                if (isset($_POST['submit'])) {

                    // data inputan dari form
                    $kategori = $_POST['kategori'];
                    $nama = $_POST['nama'];
                    $harga = $_POST['harga'];
                    $deskripsi = $_POST['deskripsi'];
                    $status = $_POST['status'];
                    $foto = $_POST['foto'];

                    // menampung data file yang diupload
                    $filename = $_FILES['gambar']['name'];
                    $tmp_name = $_FILES['gambar']['tmp_name'];

                    if ($filename != '') {

                        $type1 = explode('.', $filename);
                        $type2 = strtolower(end($type1));

                        $newname = 'produk' . time() . '.' . $type2;

                        // menampung data format file yang diizinkan
                        $tipe_diizinkan = array('jpg', 'jpeg', 'png', 'gif');

                        // validasi format file
                        if (!in_array($type2, $tipe_diizinkan)) {
                            // jika format file tidak ada i dalam tipe diizinkan
                            echo '<script>alert("Format file tidak diizinkan")</script>';
                        } else {
                            unlink('../produk/' . $foto);
                            move_uploaded_file($tmp_name, '../produk/' . $newname);
                            $namagambar = $newname;
                        }

                    } else {
                        // jika admin tidak ganti gambar
                        $namagambar = $foto;

                    }
                    // query update data produk
                    $update = mysqli_query($conn, "UPDATE tb_product SET category_id='" . $kategori . "', product_name='" . $nama . "', product_price='" . $harga . "', product_description='" . $deskripsi . "', product_image='" . $namagambar . "', product_status=" . $status . " WHERE product_id=" . $p->product_id);

                    if ($update) {
                        echo '<script>alert("Ubah data berhasil")</script>';
                        echo '<script>window.location="produk_data.php"</script>';
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