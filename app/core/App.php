<?php

// Mendefinisikan class App
class App
{
    // Membuat property untuk menentukan controller, method, dan parameter default
    protected $controller = 'Home';
    protected $method = 'index';
    protected $params = [];

    // Membuat fungsi konstruktor
    public function __construct()
    {
        // Memanggil fungsi parseURL() untuk mendapatkan URL yang di-parse
        $url = $this->parseURL();

        // Memeriksa apakah file controller yang dimaksud ada
        if (file_exists('app/controllers/' . $url[0] . '.php')) {
            // Jika file controller yang dimaksud ada, maka controller akan ditimpa dengan controller yang dimaksud
            $this->controller = $url[0];
            // Menghilangkan elemen array yang pertama dengan fungsi array_shift()
            unset($url[0]);
        } else {
            http_response_code(404);
            include('exceptions/404.php'); // provide your own HTML for the error page
            die();
        }

        // Memanggil file controller yang dimaksud dan instansiasi objeknya
        require_once 'app/controllers/' . $this->controller . '.php';
        // Menginstansiasi objek dari class yang dimaksud dengan fungsi new
        $this->controller = new $this->controller;

        // Memeriksa apakah method yang dimaksud ada
        if (isset($url[1])) {
            // Memeriksa apakah method yang dimaksud ada di dalam class yang dimaksud
            if (method_exists($this->controller, $url[1])) {
                // Jika method yang dimaksud ada di dalam class yang dimaksud, maka method akan ditimpa dengan method yang dimaksud
                $this->method = $url[1];
                // Menghilangkan elemen array yang pertama dengan fungsi array_shift()
                unset($url[1]);
            }
        }

        // Memeriksa apakah ada parameter yang dikirimkan
        if (!empty($url)) {
            // Jika ada parameter yang dikirimkan, maka parameter akan ditimpa dengan parameter yang dikirimkan
            $this->params = array_values($url);
        }

        // jalankan controller & method, serta kirimkan params jika ada
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    // Membuat fungsi parseURL()
    public function parseURL()
    {
        // Memeriksa apakah ada parameter 'url' yang diterima melalui metode GET
        if (isset($_GET['url'])) {
            // Mengambil nilai 'url' dari variabel $_GET dan menyimpannya dalam variabel $url
            // Menghilangkan tanda '/' di akhir URL dengan fungsi rtrim()
            $url = rtrim($_GET['url']);

            // Membersihkan URL dari karakter-karakter yang tidak valid dengan fungsi filter_var()
            $url = filter_var($url, FILTER_SANITIZE_URL);

            // Memecah URL berdasarkan tanda '/' dengan fungsi explode()
            $url = explode('/', $url);

            // Mengembalikan nilai $url
            return $url;
        } else {
            $url = [$this->controller];
            return $url;
        }
    }
}
