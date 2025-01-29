<?php

class Menu extends Controller
{
    public function index(){

        $this->view('menu/index');

    
    }
    
    public function kurikulum(){

        $this->view('menu/kurikulum');

    
    }
    
    public function materi(){

        $this->view('menu/materi');

    
    }
    
    public function langkah(){

        $this->view('menu/langkah');

    
    }
}
