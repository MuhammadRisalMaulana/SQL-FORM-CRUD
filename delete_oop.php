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
    public function delete($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM users WHERE id = ?");
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            return "Data berhasil dihapus.";
        } else {
            return "Error: " . $stmt->error;
        }
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = new User();
    $id = $_POST['id'];
    echo $user->delete($id);
}
?>
<form method="POST" action="">
    ID: <input type="number" name="id" required><br>
    <input type="submit" value="Delete">
</form>