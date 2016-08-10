<?php

class Task extends BaseModel {

    public $id, $task_name, $task_status, $task_description, $deadline, $task_importance, $personid;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }
    
    public static function all(){
        $query = DB::connection()->prepare('SELECT * FROM task ORDER BY task_status ASC, task_importance ASC, deadline ASC');
        $query->execute();
        $rows = $query->fetchAll();
        $tasks = array();
        
        foreach ($rows as $row){
            $tasks[] = new Task(array(
                'id' => $row['id'],
                'task_name' => $row['task_name'],
                'task_status' => $row['task_status'],
                'task_description' => $row['task_description'],
                'deadline' => $row['deadline'],
                'task_importance' => $row['task_importance'],
                'personid' => $row['personid']
            ));
        }
        return $tasks;
    }

    public static function find($id){
        $query = DB::connection()->prepare('SELECT * FROM task WHERE id= :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        
        if ($row){
            $task = new Task(array(
                'id' => $row['id'],
                'task_name' => $row['task_name'],
                'task_staus' => $row['task_status'],
                'task_description' => $row['task_description'],
                'deadline' => $row['deadline'],
                'task_importance' => $row['task_importance'],
                'personid' => $row['personid']
            ));
            
            return $task;
        }
        return null;
    }

}
