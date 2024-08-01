<?php
include 'db.php'; // File koneksi database
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $stmt = mysqli_prepare($conn, "DELETE FROM users WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    if (mysqli_stmt_execute($stmt)) {
        echo "Data berhasil dihapus.";
    } else {
        echo "Error: " . mysqli_stmt_error($stmt);
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>
<form method="POST" action="">
    ID: <input type="number" name="id" required><br>
    <input type="submit" value="Delete">
</form>