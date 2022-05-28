<?php
/*
 * Kế thừa class Model
 * */
class HomeModel extends Model
{
    private $_table = 'province';

    function tableFill(){
        return $this->_table;
    }

    function fieldFill(){
        return '_name,_code';
    }

    function primaryKey(){
        return 'id';
    }

    public function getDetail($id){
        $data = [
            'item 1',
            'item 2'
        ];
        return $data[$id];
    }

    public function getListProvince(){
        $data = $this->db->table($this->_table)
//            ->whereLike('_name', 'Hà')
//            ->where('id', '<=', '100')
//            ->limit(1)
                ->orderBy('id DESC, _name ASC')
            ->get();

        return $data;
    }

    public function getDetailProvince($name){
        $data = $this->db->table($this->_table)->orWhere('_name', '=', $name)->first();
        return $data;
    }

    public function insertProvince($data){
        $this->db->table($this->_table)->insert($data);
        return $this->db->lastId();
    }

    public function deleteProvince($id){
        return $this->db->table($this->_table)->where('id', '=', $id)->delete();
    }
}