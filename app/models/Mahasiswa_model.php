<?php
class Mahasiswa_model{
    // properti yang berisi nama tabel yang akan digunakan
    private $table = 'mahasiswa';
    private $db;

    // method untuk menghubungkan database
    public function __construct(){
        // instansiasi class Database
        $this->db = new Database;
    }

    // method untuk mengambil data mahasiswa
    public function getAllMahasiswa(){
        // mengatur query database
        $this->db->query('SELECT * FROM ' . $this->table);
        // mengeksekusi query database
        return $this->db->resultSet();
    }

    // method untuk mengambil data mahasiswa berdasarkan id
    public function getMahasiswaById($id){
        // mengatur query database
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id=:id');
        // mengikat data untuk mencegah sql injection
        $this->db->bind('id', $id);
        // mengeksekusi query database, pakai single karena hanya mengambil satu data
        return $this->db->single();
    }
}