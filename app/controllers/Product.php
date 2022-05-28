<?php
class Product extends Controller {
    public $data = [];

    public function index()
    {
        echo 'Danh sach sản phẩm';
    }

    public function list_product()
    {
        $product = $this->model('ProductModel');
        $dataProduct = $product->getProductList();
        $this->data['sub_content']['product_list'] = $dataProduct;
        $this->data['page_title'] =  'Danh sách sản phẩm';
        $this->data['content'] = 'products/list';
        //Render view
        $this->render('layouts/client_layout', $this->data);
    }

    public function detail($id=0)
    {
        $product = $this->model('ProductModel');
        $this->data['sub_content']['info'] = $product->getDetail($id);
        $this->data['page_title'] = 'Chi tiết sản phẩm';
        $this->data['content'] = 'products/detail';
        $this->render('layouts/client_layout', $this->data);
    }
}
