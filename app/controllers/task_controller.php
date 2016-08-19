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
    
    public static function create(){
        View::make('task/new.html');
    }

    public static function store(){
        $params = $_POST;
       /* vanhaa  $task = new Task(array(
            'task_name' => $params ['task_name'],
            'task_status' => $params ['task_status'],
            'task_description' => $params ['task_description'],
            'deadline'=> $params ['deadline'],
            'task_importance' => $params ['task_importance']
        ));
       */
        $attributes = array(
            'task_name' => $params ['task_name'],
            'task_status' => $params ['task_status'],
            'task_description' => $params ['task_description'],
            'deadline'=> $params ['deadline'],
            'task_importance' => $params ['task_importance']
        );
        
       $task = new Task($attributes);
       $errors = $task->errors();
        
        if (count($errors) == 0){
            $task->save();
                        
       Redirect::to('/tehtava/' .$task->id, array('message' => 'Tehtävä on lisätty muistilistaan'));
    }else{
        View::make('task/new.html', array('errors' => $errors, 'attributes'=> $attributes));
    }
        
        
    /*    $errors = $task->validate_task_description();
               
        if (count($errors) == 0){
            $task->save();
        Redirect::to('/tehtava/' .$task->id, array('message' => 'Tehtävä on lisätty muistilistaan'));
        }else{
        View::make('task/new.html', array('message'=> 'jotain meni pieleen'));
        }
    */
    }
}
