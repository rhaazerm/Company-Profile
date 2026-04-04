<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Quicksand&display=swap" rel="stylesheet">

</head>

<body id="bg-login"> <!-- untuk membuat background dengan id bg-login yang sudah dibuat di file style.css -->
    <div class="box-login"> <!-- untuk membuat box login dengan class box-login yang sudah dibuat di file style.css -->
        <h2>Login</h2>
        <form action="login.php" method="POST"> <!-- untuk mengirim data ke file login.php dengan method POST -->
            <input type="text" name="user" placeholder="Username" class="input-control">
            <input type="password" name="pass" placeholder="Password" class="input-control"><br>
            <input type="submit" name="submit" value="Login" class="btn"><br>
            <label>Belum Punya Akun? <a href="register.php"><strong>Klik di sini untuk Mendaftar</strong></a></label>
        </form> <!-- untuk membuat form login dengan input username dan password serta tombol submit untuk mengirim data ke file login.php -->

        <?php // untuk membuat script php untuk memproses data yang dikirim dari form login
        include('db.php'); //untuk menghubungkan ke database dengan memanggil file db.php yang sudah dibuat sebelumnya
        if (isset($_POST['submit'])) { //jika tombol submit di klik maka akan menjalankan script dibawah ini
            $username = $_POST['user']; //untuk mengambil data username dari form input dengan name user
            $password = $_POST['pass'];

            $sql = mysqli_query($conn, "SELECT * FROM tb_admin WHERE username='$username' AND password='$password'")
                or die(mysqli_error($conn));
            //untuk menjalankan query SELECT untuk mencari data username dan password yang sesuai dengan data yang dikirim dari form login, jika terjadi error maka akan menampilkan error mysql

            //SELECT = untuk mengambil data dari database, * = untuk mengambil semua data dari tabel, FROM = untuk menentukan tabel yang akan diambil datanya, WHERE = untuk menentukan kondisi yang harus dipenuhi agar data yang diambil sesuai dengan yang diinginkan, AND = untuk menggabungkan dua kondisi atau lebih dalam query SELECT

            //INSERT = untuk memasukkan data ke dalam database, INTO = untuk menentukan tabel yang akan dimasukkan data, VALUES = untuk menentukan nilai yang akan dimasukkan ke dalam tabel


            //di bawah ini merupakan kondisi salah

            if (mysqli_num_rows($sql) == 0) { //jika data yang ditemukan dari query SELECT tidak ada maka akan menjalankan script dibawah ini
                echo "<script>alert('Username / Password Salah!')</script>";
                echo '<script type="text/javascript">window.location = "login.php"</script>';
            } else {

                session_start();

                $row = mysqli_fetch_assoc($sql);
                $_SESSION['id_login'] = $row['admin_id'];
                $_SESSION['level'] = $row['level'];
                $_SESSION['status_login'] = true; //fungsi session untuk menyimpan data login yang berhasil, id_login untuk menyimpan id admin yang login, level untuk menyimpan level admin yang login, status_login untuk menyimpan status login yang berhasil atau tidak.


                //di bawah ini merupakan kondisi benar

                if ($row['level'] == 'admin') {
                    echo "<script>alert('Sukses')</script>";
                    echo '<script type="text/javascript">window.location = "admin/dashboard.php"</script>';
                } else if ($row['level'] == 'pelanggan') {
                    echo "<script>alert('Sukses')</script>";
                    echo '<script type="text/javascript">window.location = "user/dashboard.php"</script>';
                } else {
                    header('location:index.php');
                }
            }
        }


        ?>

    </div>

</body>

</html>