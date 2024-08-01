<?php
include 'db.php'; // File koneksi database
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $stmt = mysqli_prepare($conn, "INSERT INTO users (name, email, password) VALUES 
(?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "sss", $name, $email, $password);
    if (mysqli_stmt_execute($stmt)) {
        echo "Data berhasil ditambahkan.";
    } else {
        echo "Error: " . mysqli_stmt_error($stmt);
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>
<form method="POST" action="">
    Nama: <input type="text" name="name" required><br>
    Email: <input type="email" name="email" required><br>
    Password: <input type="password" name="password" required><br>
    <input type="submit" value="Tambah">
</form>