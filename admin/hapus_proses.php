<?php
    include '../db.php';

    if (isset($_GET['idk'])) {
        $delete = mysqli_query($conn, "DELETE FROM tb_category WHERE category_id = '" . $_GET['idk'] . "' ");
        echo '<script>alert("Hapus data berhasil")</script>';
        echo '<script>window.location="kategori_data.php"</script>';
    }

    if (isset($_GET['idp'])) {
        $produk = mysqli_query($conn, "SELECT product_image FROM tb_product WHERE product_id = '" . $_GET['idp'] . "' ");
        $p = mysqli_fetch_object($produk);

        unlink('produk/' . $p->product_image);
        

        // Hapus data produk dari database
        $delete = mysqli_query($conn, "DELETE FROM tb_product WHERE product_id = '" . $_GET['idp'] . "'");
        echo '<script>alert("Hapus data berhasil")</script>';
        echo '<script>window.location="produk_data.php"</script>';

    }
?>