<?php

class Game extends Controller
{
    public function index(){

        $this->view('game/index');

    
    }
    
    public function tingkat($tingkat = 1){
        $this->view('game/tingkat'.$tingkat);

    
    }
    
    public function level($level = 1){

        $this->view('game/level'.$level);

    
    }
    
    public function soal($soal = 1 ,$tingkat = 1){

        $this->view('menu/langkah');

    
    }
}
