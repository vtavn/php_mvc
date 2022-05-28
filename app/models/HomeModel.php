<?php
/*
 * Kế thừa class Model
 * */
class HomeModel extends Model
{
    private $_table = 'province';

    function tableFill(){
        return 'province';
    }

    function fieldFill(){
        return '_name,_code';
    }

    public function getList(){
//        $data = $this->db->query("SELECT * FROM $this->_table")->fetchAll(PDO::FETCH_ASSOC);

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