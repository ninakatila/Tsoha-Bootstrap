<?php

class Category extends BaseModel{
    public $id, $category_name, $category_description, $personid;
    
    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_category_name', 'validate_category_description');
              
    }

    public static function all($options) {
        $query=DB::connection()->prepare('SELECT * FROM category WHERE personid= :personid ORDER BY category_name ASC');
        $query->execute(array('personid'=> $options['personid'])); 
        
        $rows = $query->fetchAll();
        $categories = array();
        
        foreach ($rows as $row){
            $categories[]= new Category($row);
        }        
        return $categories;
        }
    
     
        /* $query = DB::connection()->prepare('SELECT * FROM category ORDER BY category_name ASC');
        $query->execute();
        $rows = $query->fetchAll();
        $categories = array();

        foreach ($rows as $row) {
            $categories[] = new Category(array(
                'id' => $row['id'],
                'category_name'=> $row['category_name'],
                'category_description'=> $row['category_description'],
                'personid' => $row['personid']
            ));
        }
        return $categories;
    }*/

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM category WHERE id= :id');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $category = new Category(array(
                'id' => $row['id'],
                'category_name' => $row['category_name'],
                'category_description' => $row['category_description'],
                'personid' => $row['personid']
            ));

            return $category;
        }
        return null;
    }

    public function save() {
        $query = DB::connection()->prepare('INSERT INTO category (category_name, category_description, personid) VALUES (:category_name, :category_description, :personid) RETURNING id');
        $query->execute(array('category_name' => $this->category_name, 'category_description' => $this->category_description, 'personid'=>  $this->personid));
        $row = $query->fetch();
        $this->id = $row ['id'];
    }
    
    public function update(){
        $query = DB::connection()->prepare('UPDATE category SET (category_name= :category_name, category_description= :category_description WHERE id= :id');
        $query->execute(array('category_name' => $this->category_name, 'category_description' => $this->category_description, 'id'=>  (int)$this->id));
        $row = $query->fetch();
        
    }
    
     public function destroy($id){
         $query = DB::connection()->prepare('DELETE FROM category WHERE id= :id');
         $query->execute(array('id'=>$id));
         
     }

    public function validate_category_name() {
        $errors = array();
        if ($this->category_name == '' || $this->category_name == null) {
            $errors[] = 'Nimi ei saa olla tyhjä';
        }
        
        if (!preg_match('#^[A-Za-z0-9åäöÅÄÖ \!\?\,\.\\-]+$#', $this->category_name)) {
            $errors[] = 'Nimessä ei saa olla erikoismerkkejä';
        }
        return $errors;
    }

    public function validate_category_description() {
        $errors = array();
        if (!preg_match('#^[A-Za-z0-9åäöÅÄÖ \!\?\,\.\\-]+$#', $this->category_description)) {
            $errors[] = 'Kuvauksessa ei saa olla erikoismerkkejä';
        }
        return $errors;
    }
}

