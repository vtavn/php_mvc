<?php
class Home extends Controller {

    public $model;

    public function __construct()
    {
        $this->model = $this->model('HomeModel');
    }

    public function index(){
        $data = $this->model->getList();
        print_r($data);

        $detail = $this->model->getDetail(0);
        print_r($detail);
    }


}