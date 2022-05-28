<?php
$routes['default_controller'] = 'home';

/*
 * Đường dẫn ảo => đường dẫn thật
 * */

$routes['trang-chu'] = 'home';
$routes['tin-tuc/.+-(\d+).html'] = 'news/category/$1';
$routes['san-pham'] = 'product/index';

?>