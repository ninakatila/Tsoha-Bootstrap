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
    
    public function save(){
        $query = DB::connection()->prepare('INSERT INTO task (task_name, task_status, task_description, deadline, task_importance) VALUES (:task_name, :task_status, :task_description, :deadline, :task_importance) RETURNING id');
        $query ->execute(array('task_name' =>$this->task_name, 'task_status'=> $this->task_status, 'task_description'=>  $this->task_description, 'deadline'=>  $this->deadline, 'task_importance'=>  $this->task_importance));
        $row = $query->fetch();
        $this->id = $row ['id'];
    }

}
