<?php

class App{
  
  private $__controller, $__acctions, $__params; 
  function __construct()
  {
    global $routes;

    if(isset($routes['default_controller'])){
      $this->__controller = $routes['default_controller']; // tham sô mặc định
    }

    // $this->__controller = 'home';
    $this->__acctions = 'index'; // tham sô mặc định
    $this->__params = []; 
    $this->handleUrl(); // hàm lấy url
    // echo $this->getUrl();
  }

  public function getUrl(){ // hàm lấy url từ trang web
    if(isset($_SERVER['PATH_INFO'])){
      $url = $_SERVER['PATH_INFO'];
    }else $url = '/';

    return $url;
  }

  // hàm tách chuỗi url

  public function handleUrl(){
    $url = $this->getUrl();
    $urlArr = array_filter(explode('/',$url));
    $urlArr = array_values($urlArr);
    
    // Xử lý controllers
    if(isset($urlArr[0])){ // nếu mà tồn tại controllers từ người dùng
      $this->__controller = ucfirst($urlArr[0]);      
    }
    else
    {
      $this->__controller = ucfirst($this->__controller); // nếu ko tồn tại thì gọi tham số mặc định
    } 

    if(file_exists('app/controllers/'.($this->__controller).'.php')){
      require_once 'controllers/'.($this->__controller).'.php';
      // Kiểm tra class controller tồn tại
      if(class_exists($this->__controller)){
        $this->__controller = new $this->__controller();
        unset($urlArr[0]); // hàm hủy
      } else{
        $this->err();
      }
    }else 
      $this->err();
      
    // Xử lú acction
    if(isset($urlArr[1])){
      $this->__acctions = $urlArr[1];
      unset($urlArr[1]);
    }

    // xử lý params
    $this->__params = array_values($urlArr);

    // Kiểm tra method tồn tại
    if(method_exists($this->__controller, $this->__acctions)){
      call_user_func_array([$this->__controller, $this->__acctions], $this->__params);  
  }else{
    $this->err();
  }
    
  }

  public function err($name = '404'){
    require_once 'app/errors/'.($name).'.php';
  }
}