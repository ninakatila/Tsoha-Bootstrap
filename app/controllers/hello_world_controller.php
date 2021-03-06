<?php

  class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	  echo 'Tämä on etusivu!';
    }
    
    public static function login(){
     	View::make('/suunnitelmat/login.html');
    }
    
    public static function task_list(){
     	View::make('/suunnitelmat/task_list.html');
    }
    
     public static function task(){
     	View::make('/suunnitelmat/task.html');
    }
    
     public static function edit_task(){
     	View::make('/suunnitelmat/edit_task.html');
    }
    
     public static function category_list(){
     	View::make('/suunnitelmat/category_list.html');
    }
    
     public static function category(){
     	View::make('/suunnitelmat/category.html');
    }
    
     public static function edit_category(){
     	View::make('/suunnitelmat/edit_category.html');
    }
    
      public static function importance_list(){
     	View::make('/suunnitelmat/importance_list.html');
    }
    
     public static function importance(){
     	View::make('/suunnitelmat/importance.html');
    }
    
     public static function edit_importance(){
     	View::make('/suunnitelmat/edit_importance.html');
    }

    public static function sandbox(){
      // Testaa koodiasi täällä
    $muista = new Task(array(
        'task_name'=> 'd',
        'task_status'=> 'Avoin',
        'task_description'=> 'validoinnin:testausta',
        'deadline'=> '2016',
        'task_importance'=> '1'
    ));
    $errors = $muista->errors();
      Kint::dump($errors);
    }
  }
