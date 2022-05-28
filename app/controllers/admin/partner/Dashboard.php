<?php
class Dashboard
{
    public function index()
    {
        echo 'Dashboard admin';
    }

    public function detail($id)
    {
        echo 'Trang chi tiết Dashboard. '.$id;
    }
}