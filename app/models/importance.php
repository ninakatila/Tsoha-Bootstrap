<?php

class Importance extends BaseModel{
    public $id, $importance_value, $importance_description, $personid;
    
    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_importance_value', 'validate_importance_description');
              
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM importance ORDER BY importance_value ASC');
        $query->execute();
        $rows = $query->fetchAll();
        $importances = array();

        foreach ($rows as $row) {
            $importances[] = new Importance(array(
                'id' => $row['id'],
                'importance_value'=> $row['importance_value'],
                'importance_description'=> $row['importance_description'],
                'personid' => $row['personid']
            ));
        }
        return $importances;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM importance WHERE id= :id');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $importance = new Importance(array(
                'id' => $row['id'],
                'importance_value' => $row['importance_value'],
                'importance_description' => $row['importance_description'],
                'personid' => $row['personid']
            ));

            return $importance;
        }
        return null;
    }

    public function save() {
        $query = DB::connection()->prepare('INSERT INTO importance (importance_value, importance_description) VALUES (:importance_value, :importance_description) RETURNING id');
        $query->execute(array('importance_value' => $this->importance_value, 'importance_description' => $this->importance_description));
        $row = $query->fetch();
        $this->id = $row ['id'];
    }
    
    public function update(){
        $query = DB::connection()->prepare('UPDATE importance SET (importance_value, importance_description) VALUES (:importance_value, :importance_description)RETURNING id');
        $query->execute(array('importance_value' => $this->importance_value, 'importance_description' => $this->importance_description));
        $row = $query->fetch();
        
    }
    
     public function destroy($id){
         $query = DB::connection()->prepare('DELETE FROM importance WHERE id= :id');
         $query->execute(array('id'=>$id));
         
     }

    public function validate_importance_value() {
        $errors = array();
        if ($this->importance_value == null) {
            $errors[] = 'Arvo ei saa olla tyhjä';
        }
        return $errors;
    }

    public function validate_importance_description() {
        $errors = array();
        if (!preg_match('#^[A-Za-z0-9åäöÅÄÖ \!\?\,\.\\-]+$#', $this->importance_description)) {
            $errors[] = 'Kuvauksessa ei saa olla erikoismerkkejä';
        }
        return $errors;
    }
}

    


