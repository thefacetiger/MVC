<?php

class Home extends controller{

  public $models;
  public function __construct(){
    $this->models = $this->model('HomeModals');
    
  }
  


  public function index(){
    // echo 'Trang chủ';
    $data = $this->models->getList();
  } 

  // public function details($id ='', $slug =''){
  //   echo 'id sp: '.$id .'<br>';
  //   echo 'san pham: '.$slug;
  // } 
}