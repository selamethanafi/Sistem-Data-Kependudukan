<?php
declare(strict_types=1);

include "inc/koneksi.php";
include "inc/fungsi.php";
/* ===============================
   SESSION SETTING (AMAN)
================================ */
session_set_cookie_params([
    'lifetime' => 0,
    'path'     => '/',
    'secure'   => isset($_SERVER['HTTPS']),
    'httponly' => true,
    'samesite' => 'Strict'
]);
session_start();

/* ===============================
   FLAG PESAN
================================ */
$login_error  = false;
$login_sukses = false;

/* ===============================
   PROSES LOGIN (HANYA JIKA SUBMIT)
================================ */
if (isset($_POST['btnLogin'])) {

    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === '' || $password === '') {
        $login_error = true;
    } else 
    {
        
        $sql = "SELECT id_pengguna, username, password, nama_pengguna, level
                FROM tb_pengguna
                WHERE BINARY username = ?
                LIMIT 1";

        $stmt = $koneksi->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $user_password = $user['password'] ?? '';
        $result = $stmt->get_result();
        $user   = $result->fetch_assoc();
        if ($password === $user_password) 
        {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $query="UPDATE tb_pengguna SET password='$hash' where `username`='$username'";
            $hasil = mysqli_query($koneksi, $query);
        }

        if ($user && password_verify($password, $user['password'])) {

            session_regenerate_id(true);

            $_SESSION['ses_id']       = $user['id_pengguna'];
            $_SESSION['ses_username'] = $user['username'];
            $_SESSION['ses_nama']     = $user['nama_pengguna'];
            $_SESSION['ses_level']    = $user['level'];
            $_SESSION['login_time']   = time();

            $login_sukses = true;

        } else {
            $sql = "SELECT * from tb_kk where `no_kk` = '$username'";
            $tb  = mysqli_query($koneksi, $sql);
            $ada = mysqli_num_rows($tb);
            if($ada > 0)
            {
                $db = mysqli_fetch_assoc($tb);
                $stored_password = $db['password'];
                if(password_verify($password, $stored_password))
                {
                    session_regenerate_id(true);
                    $_SESSION['ses_id']       = $db['id_kk'];
                    $_SESSION['ses_username'] = $db['no_kk'];
                    $_SESSION['ses_nama']     = $db['kepala'];
                    $_SESSION['ses_level']    = 'warga';
                    $_SESSION['login_time']   = time();
                    $login_sukses = true;
                }
                else
                {
                    usleep(500000); // delay brute force
                    $login_error = true;
                }
            }
            else
            {
                usleep(500000); // delay brute force
                $login_error = true;
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>GTA Web – Sistem Informasi Kependudukan</title>

    <meta property="og:title" content="GTA Web – Sistem Informasi Kependudukan">
    <meta property="og:description" content="Pendataan Kartu Keluarga dan Penduduk Berbasis Web">
    <meta property="og:url" content="https://www.gta.web.id/">
    <meta property="og:type" content="website">
    <meta property="og:image" content="https://www.gta.web.id/assets/preview.jpg">

    <meta name="description" content="Pendataan Kartu Keluarga dan Penduduk Berbasis Web">

    <!-- Optional (tapi disarankan) -->
    <meta name="description" content="Aplikasi pendataan Kartu Keluarga dan Penduduk berbasis web.">
	<link rel="icon" href="dist/img/izin.png">
	<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
	<link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
	<link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
<div class="login-box">
	<div class="card">
		<div class="card-body login-card-body">

			<center>
				<img src="dist/img/izin.png" width="170">
				<h5>
					<b>Sistem Data Kependudukan</b><br>
					PERUMAHAN GRAHA TENGARAN ASRI<br>
					RT 21B RW 4
				</h5>
			</center>

			<form method="post">
				<div class="input-group mb-3">
					<input type="text" name="username" class="form-control" placeholder="Username" required>
					<div class="input-group-append">
						<div class="input-group-text">
							<span class="fas fa-user"></span>
						</div>
					</div>
				</div>

				<div class="input-group mb-3">
					<input type="password" name="password" class="form-control" placeholder="Password" required>
					<div class="input-group-append">
						<div class="input-group-text">
							<span class="fas fa-lock"></span>
						</div>
					</div>
				</div>

				<button type="submit" name="btnLogin" class="btn btn-danger btn-block">
					<b>Login</b>
				</button>
			</form>

		</div>
	</div>
</div>

<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="plugins/alert.js"></script>

<?php if ($login_sukses): ?>
<script>
Swal.fire({
	title: 'Login Berhasil',
	icon: 'success'
}).then(() => {
	window.location = 'index.php';
});
</script>
<?php endif; ?>

<?php if ($login_error): ?>
<script>
Swal.fire({
	title: 'Login Gagal',
	text: 'Username atau password salah',
	icon: 'error'
});
</script>
<?php endif; ?>

</body>
</html>
