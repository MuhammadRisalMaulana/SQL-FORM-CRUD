<?php
class Database
{
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $dbname = "politeknik";
    public $conn;

    public function __construct()
    {
        $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->dbname);
        if ($this->conn->connect_error) {
            die("Koneksi gagal: " . $this->conn->connect_error);
        }
    }
}

class Mahasiswa extends Database
{
    public function create($nim, $nama, $tempat_lahir, $tanggal_lahir, $jurusan, $program_studi, $ipk)
    {
        $stmt = $this->conn->prepare("INSERT INTO mahasiswa (nim, nama, tempat_lahir, tanggal_lahir, jurusan, program_studi, ipk) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssd", $nim, $nama, $tempat_lahir, $tanggal_lahir, $jurusan, $program_studi, $ipk);
        if ($stmt->execute()) {
            return "Data berhasil ditambahkan.";
        } else {
            return "Error: " . $stmt->error;
        }
    }

    public function read()
    {
        $result = $this->conn->query("SELECT * FROM mahasiswa");
        return $result;
    }

    public function update($nim, $nama, $tempat_lahir, $tanggal_lahir, $jurusan, $program_studi, $ipk)
    {
        $stmt = $this->conn->prepare("UPDATE mahasiswa SET nama = ?, tempat_lahir = ?, tanggal_lahir = ?, jurusan = ?, program_studi = ?, ipk = ? WHERE nim = ?");
        $stmt->bind_param("ssssssd", $nama, $tempat_lahir, $tanggal_lahir, $jurusan, $program_studi, $ipk, $nim);
        if ($stmt->execute()) {
            return "Data berhasil diperbarui.";
        } else {
            return "Error: " . $stmt->error;
        }
    }

    public function delete($nim)
    {
        $stmt = $this->conn->prepare("DELETE FROM mahasiswa WHERE nim = ?");
        $stmt->bind_param("s", $nim);
        if ($stmt->execute()) {
            return "Data berhasil dihapus.";
        } else {
            return "Error: " . $stmt->error;
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mahasiswa = new Mahasiswa();
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $jurusan = $_POST['jurusan'];
    $program_studi = $_POST['program_studi'];
    $ipk = $_POST['ipk'];

    if (isset($_POST['create'])) {
        echo $mahasiswa->create($nim, $nama, $tempat_lahir, $tanggal_lahir, $jurusan, $program_studi, $ipk);
    } elseif (isset($_POST['update'])) {
        echo $mahasiswa->update($nim, $nama, $tempat_lahir, $tanggal_lahir, $jurusan, $program_studi, $ipk);
    } elseif (isset($_POST['delete'])) {
        echo $mahasiswa->delete($nim);
    }
}

$mahasiswa = new Mahasiswa();
$result = $mahasiswa->read();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Mahasiswa</title>
</head>
<body>
    <h1>CRUD Mahasiswa</h1>
    <form method="POST" action="">
        <input type="text" name="nim" placeholder="NIM" required><br><br>
        <input type="text" name="nama" placeholder="Nama" required><br><br>
        <input type="text" name="tempat_lahir" placeholder="Tempat Lahir" required><br><br>
        <input type="date" name="tanggal_lahir" placeholder="Tanggal Lahir" required><br><br>
        <input type="text" name="jurusan" placeholder="Jurusan" required><br><br>
        <input type="text" name="program_studi" placeholder="Program Studi" required><br><br>
        <input type="number" step="0.01" name="ipk" placeholder="IPK" required><br><br>
        <input type="submit" name="create" value="Create">
        <input type="submit" name="update" value="Update">
        <input type="submit" name="delete" value="Delete">
    </form>
    <h2>Data Mahasiswa</h2>
    <table border="1">
        <tr>
            <th>NIM</th>
            <th>Nama</th>
            <th>Tempat Lahir</th>
            <th>Tanggal Lahir</th>
            <th>Jurusan</th>
            <th>Program Studi</th>
            <th>IPK</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['nim']; ?></td>
                <td><?php echo $row['nama']; ?></td>
                <td><?php echo $row['tempat_lahir']; ?></td>
                <td><?php echo $row['tanggal_lahir']; ?></td>
                <td><?php echo $row['jurusan']; ?></td>
                <td><?php echo $row['program_studi']; ?></td>
                <td><?php echo $row['ipk']; ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>