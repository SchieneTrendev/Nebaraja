<?php

// Mendefinisikan class Database yang berisi konfigurasi database
class Database {
    // Mendefinisikan property yang berisi konfigurasi database
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $db_name = DB_NAME;

    // Mendefinisikan property yang berisi koneksi database
    private $dbh;
    private $stmt;

    // Mendefinisikan method yang berisi koneksi database
    public function __construct()
    {
        // data source name, untuk mengidentifikasi alamat server database
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->db_name;

        // opsi untuk mengatur koneksi ke database agar lebih aman
        $option = [
            // untuk mengatur error mode menjadi exception
            PDO::ATTR_PERSISTENT => true,
            // untuk mengatur mode error menjadi exception
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];

        // coba koneksi ke database dengan blok try catch
        try {
            // berfungsi untuk mengatur opsi koneksi ke database agar lebih aman
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $option);
        } catch (PDOException $e) {
            // jika koneksi gagal, maka akan ditampilkan pesan errornya
            die($e->getMessage());
        }
    }

    // Mendefinisikan method yang berisi query database
    public function query($query)
    {
        // mengatur query database
        $this->stmt = $this->dbh->prepare($query);
    }

    // Mendefinisikan method yang berisi binding data yang berfungsi untuk mencegah sql injection, karena query dieksekusi setelah string dibersihkan 
    public function bind($param, $value, $type = null)
    {
        // jika tipe data null, maka akan diatur sesuai dengan tipe datanya masing-masing
        if ( is_null($type)) {
            switch ( true ) {
                // jika tipe data integer, maka akan diatur menjadi parameter integer
                case is_int($value) :
                    // PDO::PARAM_INT merupakan konstanta yang berisi parameter integer
                    $type = PDO::PARAM_INT;
                    break;
                // jika tipe data boolean, maka akan diatur menjadi boolean
                case is_bool($value) :
                    // PDO::PARAM_BOOL merupakan konstanta yang berisi parameter boolean
                    $type = PDO::PARAM_BOOL;
                    break;
                // jika tipe data null, maka akan diatur menjadi null
                case is_null($value) :
                    // PDO::PARAM_NULL merupakan konstanta yang berisi parameter null
                    $type = PDO::PARAM_NULL;
                    break;
                // jika tipe data string, maka akan diatur menjadi string
                default :
                    // PDO::PARAM_STR merupakan konstanta yang berisi parameter string
                    $type = PDO::PARAM_STR;
            }
        }

        // mengatur binding data 
        $this->stmt->bindValue($param, $value, $type);
    }

    // Mendefinisikan method yang berisi eksekusi query database
    public function execute()
    {
        // eksekusi query database
        $this->stmt->execute();
    }

    // Mendefinisikan method yang berisi mengambil semua data
    public function resultSet()
    {
        // eksekusi query database
        $this->execute();
        // mengembalikan semua data dalam bentuk array assosiatif
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Mendefinisikan method yang berisi mengambil satu data
    public function single()
    {
        // eksekusi query database
        $this->execute();
        // mengembalikan satu data dalam bentuk array assosiatif
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }
}