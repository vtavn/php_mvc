<?php
class Home{
    public function index(){
        echo 'Home';
    }

    public function detail($id='', $slug=''){
        echo $id .' - '. $slug;
    }

    public function search($keyword){
        echo $keyword;
    }
}