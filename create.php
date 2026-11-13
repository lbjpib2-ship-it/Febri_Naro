
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
 <?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include 'koneksi.php';

if (!$db) {
    die("Koneksi database gagal!");
}

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = mysqli_query($db,
        "SELECT * FROM usern WHERE username='$username'"
    );

    if (!$query) {
        die("Query error: " . mysqli_error($db));
    }

    $user = mysqli_fetch_assoc($query);

   if ($user && $password == $user['password']) {
        $_SESSION['user'] = $user;

        if ($user['role'] == 'administrator') {
            header("Location: dashboard_admin.php");
        } else {
            header("Location: dashboard_petugas.php");
        }
        exit;
    } else {
        echo "Username atau password salah!";
    }
}
?>

<h2>Login Kasir</h2>

<form method="POST">
    <input type="text" name="username" placeholder="Username">
    <br><br>
    <input type="password" name="password" placeholder="Password">
    <br><br>
    <button type="submit" name="login">Login</button>
</form>
   
</body>
</html>