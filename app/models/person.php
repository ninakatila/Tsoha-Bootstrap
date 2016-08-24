<?php

class Person extends BaseModel{
    public $id, $lastname, $firstname, $phone, $mail, $username, $password;
    
     public function __construct($attributes) {
        parent::__construct($attributes);
        
    }
    
    public static function authenticate($username, $password){
        $query = DB::connection()->prepare('SELECT * FROM person WHERE username= :username AND password= :password LIMIT 1');
        $query->execute(array('username'=> $username, 'password'=>$password));
        $row=$query->fetch();
        if ($row){
            $person = new Person(array(
                'id' => $row['id'],
                'lastname' => $row['lastname'],
                'firstname' => $row['firstname'],
                'phone' => $row['phone'],
                'mail' => $row['mail'],
                'username' => $row['username'],
                'passeword' => $row['password']
            ));
            return $person;
        }else{
            return null;           
        }
    }
    
    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM person WHERE id= :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        if ($row){
            $person = new Person(array(
                'id' => $row['id'],
                'lastname' => $row['lastname'],
                'firstname' => $row['firstname'],
                'phone' => $row['phone'],
                'mail' => $row['mail'],
                'username' => $row['username'],
                'passeword' => $row['password']
            ));
            return $person;
            
        }else{
            return null;            
        }
    }

}