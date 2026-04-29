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
            <h3 class="card-title">Produk</h3>
            <button class="tambah-data" onclick="window.location.href='produk_tambah.php'">Tambah Data</button>
            <table class="table1" width="100%">
                <tr>
                    <th>No</th> 
                    <th>Kategori</th>
                    <th>Nama Produk</th>
                    <th>Detail Produk</th>
                    <th>Harga</th>
                    <th>Gambar</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>

                <?php // Menampilkan data produk 
                $no = 1; // data yg ditampilkan dimulai dari no 1
                $produk = mysqli_query($conn, "SELECT * FROM tb_product LEFT JOIN tb_category USING (category_id) ORDER BY product_id DESC"); //untuk pemanggilan data dari tabel tb_product

                if (mysqli_num_rows($produk) > 0) { 
                    while ($row = mysqli_fetch_array($produk)) { // fungsi while digunakan untuk melakukan perulangan data produk yang ditampilkan
                        ?>

                        <tr> 
                            <td><?php echo $no++; ?></td> <!-- fungsi echo adalah untuk menampilkan nilai dari variabel -->
                            <td><?php echo $row['category_name']; ?></td>
                            <td><?php echo $row['product_name']; ?></td>
                            <td><?php echo $row['product_description']; ?></td>
                            <td>Rp. <?php echo number_format($row['product_price'], 0, ',', '.') ?></td>
                            <td><a href="../produk/<?php echo $row['product_image'] ?>" target="_blank"><img
                                        src="../produk/<?php echo $row['product_image'] ?>" width="50px"></a></td>
                            <td><?php echo ($row['product_status'] != 0) ? 'Aktif' : 'Tidak Aktif'; ?></td>

                            <td>
                                <a href="produk_edit.php?id=<?php echo $row['product_id']; ?>">Edit</a> |
                                <a href="hapus_proses.php?idp=<?php echo $row['product_id']; ?>"
                                    onclick="return confirm('Yakin ingin hapus?')">Hapus</a>
                            </td>
                        </tr>
                    <?php }
                } else { ?>
                    <tr>
                        <td colspan="7">Tidak ada data</td>
                    </tr>
                <?php } ?>

            </table>

        </div>
    </div>
</body>

</html>