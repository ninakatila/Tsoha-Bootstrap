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
}

