<?php
class Database
{
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $dbname = "crud_example";
    public $conn;
    public function __construct()
    {
        $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->dbname);
        if ($this->conn->connect_error) {
            die("Koneksi gagal: " . $this->conn->connect_error);
        }
    }
}
class User extends Database
{
    public function update($id, $name, $email)
    {
        $stmt = $this->conn->prepare("UPDATE users SET name = ?, email = ? WHERE id = ?");
        $stmt->bind_param("ssi", $name, $email, $id);
        if ($stmt->execute()) {
            return "Data berhasil diperbarui.";
        } else {
            return "Error: " . $stmt->error;
        }
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = new User();
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    echo $user->update($id, $name, $email);
}
?>
<form method="POST" action="">
    ID: <input type="number" name="id" required><br>
    Nama: <input type="text" name="name" required><br>
    Email: <input type="email" name="email" required><br>
    <input type="submit" value="Update">
</form>