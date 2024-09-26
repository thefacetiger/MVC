<?php

class Products extends controller{  
  public function index(){
    echo 'Danh sách sản phẩm';
  }

  public function list_pro(){    
    $temp = $this->model('ProductModels'); // gọi đến models
    $data = $temp->getListProduct();
    echo '<pre>';
    print_r($data);
    echo '</pre>';
  }
}