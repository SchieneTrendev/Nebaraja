<?php

class Mahasiswa extends Controller{
    public function index(){
        $data['judul'] = 'Daftar Mahasiswa';
        // Mengambil data mahasiswa dari method getAllMahasiswa yang ada di Mahasiswa_model
        $data['mhs'] = $this->model('Mahasiswa_model')->getAllMahasiswa();
        $this->view('templates/header', $data);
        $this->view('mahasiswa/index', $data);
        $this->view('templates/footer');
    }

    public function detail($id){
        $data['judul'] = 'Detail Mahasiswa';
        // Mengambil data mahasiswa dari method getMahasiswaById yang ada di Mahasiswa_model
        $data['mhs'] = $this->model('Mahasiswa_model')->getMahasiswaById($id);
        $this->view('templates/header', $data);
        $this->view('mahasiswa/detail', $data);
        $this->view('templates/footer');
    }
}