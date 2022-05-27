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
        $title = 'Danh sách sản phẩm';

        $this->data['product_list'] = $dataProduct;
        $this->data['title'] = $title;
        //Render view
        $this->render('products/list', $this->data);
    }

    public function detail($id=0)
    {
        $product = $this->model('ProductModel');

        $this->data['info'] = $product->getDetail($id);
        $this->render('products/detail', $this->data);
    }
}
