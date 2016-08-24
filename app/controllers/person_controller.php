<?php

class PersonController extends BaseController{
    public static function login(){
        View::make('person/login.html');
    }
    public static function handle_login(){
        $params = $_POST;
        $person=Person::authenticate($params['username'], $params['password']);
        
        if (!$person){
            View::make('person/login.html', array('error'=> 'Väärä käyttäjätunnus tai salasana', 'username'=>$params['username']));
        }else{
            $_SESSION['person'] = $person->id;
            
            Redirect::to('/', array('message'=> 'Tervetuloa takaisin'.$person->firstname.'!'));
        }
    }
}

