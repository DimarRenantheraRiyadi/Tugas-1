<?php
class Level {
    private $conn;
    private $table = "level";

    public $id;
    public $nama;

    public function __construct($db) {
        $this->conn = $db;
    }

    // READ semua
    public function readAll() {
        $query = "SELECT * FROM " . $this->table . " ORDER BY id ASC";
        return mysqli_query($this->conn, $query);
    }

    // READ satu
    public function readOne() {
        $query = "SELECT * FROM " . $this->table . " WHERE id = ? LIMIT 1";
        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $this->id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
        if ($row) {
            $this->nama = $row['nama'];
            return true;
        }
        return false;
    }

    // CREATE
    public function create() {
        $query = "INSERT INTO " . $this->table . " (nama) VALUES (?)";
        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, "s", $this->nama);
        return mysqli_stmt_execute($stmt);
    }

    // UPDATE
    public function update() {
        $query = "UPDATE " . $this->table . " SET nama = ? WHERE id = ?";
        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, "si", $this->nama, $this->id);
        return mysqli_stmt_execute($stmt);
    }

    // DELETE
    public function delete() {
        // Cek apakah ada studies yang pakai level ini
        $check = "SELECT COUNT(*) as total FROM studies WHERE idlevel = ?";
        $stmt = mysqli_prepare($this->conn, $check);
        mysqli_stmt_bind_param($stmt, "i", $this->id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
        
        if ($row['total'] > 0) {
            return "ada_relasi";
        }

        $query = "DELETE FROM " . $this->table . " WHERE id = ?";
        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $this->id);
        return mysqli_stmt_execute($stmt);
    }
}
?>