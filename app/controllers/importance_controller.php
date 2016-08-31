<?php

class ImportanceController extends BaseController{
    
    public static function index() {
        self::check_logged_in();
        $user_logged_in = self::get_user_logged_in();
        $params = $_GET;
        $options = array('personid' => $user_logged_in->id);        
        $importances = Importance::all($options);
        
        View::make('importance/list_importance.html', array('importances' => $importances));
    }

    public static function show($id) {
        self::check_logged_in();
        $importance = Importance::find($id);
        View::make('importance/importance.html', array('importance' => $importance));
    }

    public static function create() {        
        View::make('importance/new_importance.html');
    }

    public static function store() { 
        $user_logged_in=  self::get_user_logged_in();
        $params = $_POST;
        $attributes = array(
            'importance_value' => $params ['importance_value'],
            'importance_description' => $params ['importance_description'],
            'personid'=>$user_logged_in->id
            );

        $importance = new Importance($attributes);
        $errors = $importance->errors();

        if (count($errors) == 0) {
            $importance->save();

            Redirect::to('/prioriteetti/' . $importance->id, array('message' => 'Prioriteetti on lisätty muistilistaan'));
        } else {
            View::make('importance/new_importance.html', array('errors' => $errors, 'attributes' => $attributes));
        }
    }

    public static function edit($id) {
        self::check_logged_in();
        $importance = Importance::find($id);
        View::make('importance/edit_importance.html', array('attributes' => $importance));
    }

    public static function update($id) {
        self::check_logged_in();
        $user_logged_in=  self::get_user_logged_in();
        $params = $_POST;
        $attributes = array(
            'id' => $id,
            'importance_value' => $params ['importance_value'],
            'importance_description' => $params ['importance_description'],
            'personid'=>$user_logged_in->id
        );

        $importance = new Importance($attributes);
        $errors = $importance->errors();

        if (count($errors) > 0) {
            View::make('importance/edit_importance.html', array('errors' => $errors, 'attributes' => $attributes));
        } else {
            $importance->update();

            Redirect::to('/prioriteetti/' . $importance->id, array('message' => 'Prioriteetin muokkaus onnistui'));
        }
    }

    public static function destroy($id) {
        self::check_logged_in();
        $importance = new Importance(array('id' => $id));
        $importance->destroy($id);
        Redirect::to('/prioriteetti/' .$importance->id, array('message' => 'Prioriteetti on poistettu'));
    }

}





