<?php

class Controller{
    // Membuat method view dengan parameter view dan data defaultnya adalah array kosong siapa tahu tidak ada data yang dikirimkan
    public function view($view, $data = []){
        // Memeriksa apakah file view yang dimaksud ada di dalam folder views
        // $view yang dimaksud adalah "home/index" yang berada pada file app\controllers\Home.php pada baris ke-8

        if (file_exists('app/views/' . $view . '.php')) {

            require_once 'app/views/' . $view . '.php';
            
        } else {
            http_response_code(404);
            include('exceptions/404_view.php'); // provide your own HTML for the error page
            die();
        }
    }

    // Membuat method model dengan parameter model
    public function model($model){
        // Memeriksa apakah file model yang dimaksud ada di dalam folder models
        // $model yang dimaksud adalah "User_model" yang berada pada file app\controllers\Home.php pada baris ke-12
        require_once 'app/models/' . $model . '.php';
        // Instansiasi class yang ada di dalam file User_model.php
        return new $model;
    }
}
