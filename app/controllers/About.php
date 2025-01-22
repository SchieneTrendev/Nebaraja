<?php

// Mendefinisikan class About
// Class About ini merupakan child dari class Controller
class About extends Controller{
    // Membuat method default dengan parameter nama dan pekerjaan
    public function index($nama = 'Razin', $pekerjaan = 'Mahasiswa', $umur = 21){
        $data['nama'] = $nama;
        $data['pekerjaan'] = $pekerjaan;
        $data['umur'] = $umur;
        $data['judul'] = 'About Me';
        $this->view('templates/header', $data);
        $this->view('about/index', $data);
        $this->view('templates/footer');
    }

    // Membuat method page
    public function page(){
        $data['judul'] = 'Pages';
        $this->view('templates/header', $data);
        $this->view('about/page');
        $this->view('templates/footer');
    }
}