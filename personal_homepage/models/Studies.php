<?php
class Studies {
    private $conn;
    private $table = "studies";

    public $id;
    public $nama;
    public $idlevel;
    public $keterangan;
    public $tahun_lulus;
    public $foto_sekolah;

    public function __construct($db) {
        $this->conn = $db;
    }

    // READ semua (dengan JOIN level)
    public function readAll() {
        $query = "SELECT s.*, l.nama as nama_level 
                  FROM " . $this->table . " s 
                  LEFT JOIN level l ON s.idlevel = l.id 
                  ORDER BY s.tahun_lulus ASC";
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
            $this->idlevel = $row['idlevel'];
            $this->keterangan = $row['keterangan'];
            $this->tahun_lulus = $row['tahun_lulus'];
            $this->foto_sekolah = $row['foto_sekolah'];
            return true;
        }
        return false;
    }

    // CREATE
    public function create() {
        $query = "INSERT INTO " . $this->table . " (nama, idlevel, keterangan, tahun_lulus, foto_sekolah) 
                  VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, "siss", $this->nama, $this->idlevel, $this->keterangan, $this->tahun_lulus, $this->foto_sekolah);
        return mysqli_stmt_execute($stmt);
    }

    // UPDATE
    public function update() {
        $query = "UPDATE " . $this->table . " 
                  SET nama = ?, idlevel = ?, keterangan = ?, tahun_lulus = ?, foto_sekolah = ? 
                  WHERE id = ?";
        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, "sissi", $this->nama, $this->idlevel, $this->keterangan, $this->tahun_lulus, $this->foto_sekolah, $this->id);
        return mysqli_stmt_execute($stmt);
    }

    // DELETE
    public function delete() {
        $query = "DELETE FROM " . $this->table . " WHERE id = ?";
        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $this->id);
        return mysqli_stmt_execute($stmt);
    }
}
?>