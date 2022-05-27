<?php
class Product extends Controller {
    public function index(){
        echo 'Danh sach sản phẩm';
    }

    public function listProduct(){
        $product = $this->model('ProductModel');
        $data = $product->getProductList();
        print_r($data);
    }
}