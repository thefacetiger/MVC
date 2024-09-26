<?php
// Class này kế thừa từ class Model
class HomeModals{
  protected $_tables = 'products';

  public function getList(){
    $data = [
      'Item1', 'Item2', 'Item3'
    ];

    return $data;
  }
}