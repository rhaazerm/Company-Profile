<?php include('session.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/styleadmin.css">
    <title>Halaman Produk Data | Admin</title>
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
            <h5 class="card-title">Produk Data</h5>
            <button class="tambah-data" onclick="window.location.href='produk_tambah.php'">Tambah Data</button>
            <table class="table1" width="100%">
                <tr>
                    <th>No</th>
                    <th>Kategori</th>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Detail</th>
                    <th>Gambar</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>

                <?php
                $no = 1;
                $produk = mysqli_query($conn, "SELECT * FROM tb_product LEFT JOIN tb_category USING (category_id) ORDER BY product_id DESC");
                if (mysqli_num_rows($produk) > 0) {
                    while ($row = mysqli_fetch_array($produk)) {
                        ?>

                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $row['category_name']; ?></td>
                            <td><?php echo $row['product_name']; ?></td>
                            <td><?php echo $row['product_price']; ?></td>
                            <td><?php echo $row['product_description']; ?></td>
                            <td><img src="../images/<?php echo $row['product_image']; ?>" alt="" width="100"></td>
                            <td><?php echo $row['product_status'] == 0 ? 'Aktif' : 'Tidak Aktif'; ?></td>

                            <td>
                                <a href="produk_edit.php?id=<?php echo $row['product_id']; ?>">Edit</a> |
                                <a href="hapus_proses.php?idp=<?php echo $row['product_id']; ?>"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">Hapus</a>
                            </td>
                        </tr>
                    <?php }
                } else { ?>
                    <tr>
                        <td colspan="3">Tidak ada data</td>
                    </tr>
                <?php } ?>

            </table>

        </div>
    </div>
</body>

</html>