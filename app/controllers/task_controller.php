<?php

class TaskController extends BaseController {

    public static function index() {
        self::check_logged_in();
        $user_logged_in = self::get_user_logged_in();
        $params = $_GET;
        $options = array('personid' => $user_logged_in->id);
        
        if(isset($params['search'])){
            $options['search']=$params['search'];
        }
        
        $tasks = Task::all($options);
        
        View::make('task/index.html', array('tasks' => $tasks));
      
    }

    public static function show($id) {
        self::check_logged_in();
        $task = Task::find($id);
        View::make('task/task.html', array('task' => $task));
    }

    public static function create() {        
        View::make('task/new.html');
    }

    public static function store() {  
        $user_logged_in=  self::get_user_logged_in();
        $params = $_POST;
        // $categories = $params['categories'];
        $attributes = array(
            'task_name' => $params ['task_name'],
            'task_status' => $params ['task_status'],
            'task_description' => $params ['task_description'],
            'deadline' => $params ['deadline'],
            'task_importance' => $params ['task_importance'] ,
            'personid'=>$user_logged_in->id
            // 'categories'=>array()
        );
        
        /*foreach ($categories as $category){
            $attributes['categories'][]= $category;
        }*/

        $task = new Task($attributes);
        $errors = $task->errors();

        if (count($errors) == 0) {
            $task->save();

            Redirect::to('/tehtava/' . $task->id, array('message' => 'Tehtävä on lisätty muistilistaan'));
        } else {
            View::make('task/new.html', array('errors' => $errors, 'attributes' => $attributes));
        }
    }

    public static function edit($id) {
        self::check_logged_in();
        $task = Task::find($id);
        View::make('task/edit.html', array('attributes' => $task));
    }

    public static function update($id) {
        self::check_logged_in();
        $user_logged_in=  self::get_user_logged_in();
        $params = $_POST;
        $attributes = array(
            'id' => $id,
            'task_name' => $params ['task_name'],
            'task_status' => $params ['task_status'],
            'task_description' => $params ['task_description'],
            'deadline' => $params ['deadline'],
            'task_importance' => $params ['task_importance'],
            'personid'=>$user_logged_in->id
        );

        $task = new Task($attributes);
        $errors = $task->errors();

        if (count($errors) > 0) {
            View::make('task/edit.html', array('errors' => $errors, 'attributes' => $attributes));
        } else {
            $task->update();

            Redirect::to('/tehtava/' . $task->id, array('message' => 'Tehtävän muokkaus onnistui'));
        }
    }

    public static function destroy($id) {
        self::check_logged_in();
        $task = new Task(array('id' => $id));
        $task->destroy($id);
        Redirect::to('/tehtava/' .$task->id, array('message' => 'Tehtävä on poistettu'));
    }

}
