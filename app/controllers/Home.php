<?php

// Mendefinisikan class Home 
// Class Home ini merupakan child dari class Controller
class Home extends Controller{
    public function index(){
        //Mengirimkan data judul ke dalam view yang akan ditampilkan pada tab browser yang sedang dibuka  
        $data['judul'] = 'Home';
        // Memanggil method getUser yang ada di dalam class User_model
        $data['nama'] = $this->model('User_model')->getUser();
        $this->view('templates/header', $data);
        // Memanggil method view yang ada di dalam class Controller dengan parameter 'home/index'
        $this->view('home/index', $data);
        // Memanggil method view yang ada di dalam class Controller dengan parameter 'templates/footer'
        $this->view('templates/footer', $data);
    }
}