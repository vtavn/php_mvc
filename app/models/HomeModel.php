<?php
/*
 * Kế thừa class Model
 * */
class HomeModel{
    protected $_table = 'products';

    public function getList(){
        $data = [
            'item 1',
            'item 2',
            'item 3'
        ];
        return $data;
    }

    public function getDetail($id){
        $data = [
            'item 1',
            'item 2'
        ];
        return $data[$id];
    }
}