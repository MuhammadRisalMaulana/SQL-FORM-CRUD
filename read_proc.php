<?php
include 'db.php'; // File koneksi database
$sql = "SELECT id, name, email FROM users";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "ID: " . $row["id"] . " - Nama: " . $row["name"] . " - Email: " . $row["email"] .
            "<br>";
    }
} else {
    echo "0 results";
}
mysqli_close($conn);
