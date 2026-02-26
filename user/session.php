<?php include ('../db.php');
session_start();
//Check whether the session variable SESS_MEMBER_ID is present or not
if (!isset($_SESSION['id_login']) || (trim($_SESSION['id_login']) == '')) { ?>
<script>
alert('Silakan Login Terlebih Dahulu')
window.location = "../";
</script>
<?php
}
$session_id=$_SESSION['id_login'];
$user_query = mysqli_query($conn, "select * from tb_admin where admin_id = '$session_id'")
or die(mysql_error());
$user_row = mysqli_fetch_array($user_query);
?>