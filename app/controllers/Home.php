<?php
class Home extends Controller {

    public $province;

    public function __construct()
    {
        $this->province = $this->model('HomeModel');
    }

    public function index(){
//        $data = $this->province->getList();

//        $data = $this->province->get();

//        foreach ($data as $item) {
//            echo $item['_name'].' - '.$item['_code'].'<br/>';
//        }
//        $data = $this->province->getListProvince();
//        $data2 = $this->province->getDetailProvince('Hà Nội');
//        echo '<pre>';
//        print_r($data);
//        print_r($data2);
//        echo '</pre>';
//
//        $data3 = $this->province->find(3);
//        print_r($data3);

        $dataInsert = [
            '_name' => 'Quảng Nam',
            '_code' => 'QN'
        ];
        $id = $this->province->insertProvince($dataInsert);
        echo $id;
    }

}