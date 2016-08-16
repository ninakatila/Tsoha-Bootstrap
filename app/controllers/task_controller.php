<?php
class TaskController extends BaseController{
    public static function index(){
        $tasks = Task::all();
        View::make('task/index.html', array('tasks' => $tasks));
    }
    
    public static function show($id){
        $task = Task::find($id);
        View::make('task/task.html', array ('task' => $task));        
    }
    
    public static function store(){
        View::make('task/new.html');
        $params = $_POST;
        $task = new Task(array(
            'task_name' => $params ['task_name'],
            'task_status' => $params ['task_status'],
            'task_description' => $params ['task_description'],
            'deadline'=> $params ['deadline'],
            'taski_importance' => $params ['task_importance']
        ));
        
        Kint::dump($params);
        $task ->save();
        
       // Redirect::to('/task/' .$task->id, array('message' => 'Tehtävä on lisätty muistilistaan'));
    }

}

