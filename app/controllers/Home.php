<?php
class Home extends Controller {

    public $province;

    public function __construct()
    {
        $this->province = $this->model('HomeModel');
    }

    public function index(){
//        $data = $this->province->getList();

        $data = $this->province->first();

//        foreach ($data as $item) {
//            echo $item['_name'].' - '.$item['_code'].'<br/>';
//        }
        echo '<pre>';
        print_r($data);
        echo '</pre>';
    }


}