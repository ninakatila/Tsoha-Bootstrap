<?php

class CategoryController extends BaseController{
    
    public static function index() {
        self::check_logged_in();
        $user_logged_in = self::get_user_logged_in();
        $params = $_GET;
        $options = array('personid' => $user_logged_in->id);                
        $categories = Category::all($options);
        View::make('category/list_category.html', array('categories' => $categories));
    }

    public static function show($id) {
        self::check_logged_in();
        $category = Category::find($id);
        View::make('category/category.html', array('category' => $category));
    }

    public static function create() {        
        View::make('category/new_category.html');
    }

    public static function store() { 
        $user_logged_in=  self::get_user_logged_in();
        $params = $_POST;
        $attributes = array(
            'category_name' => $params ['category_name'],
            'category_description' => $params ['category_description'],
            'personid'=>$user_logged_in->id
            );

        $category = new Category($attributes);
        $errors = $category->errors();

        if (count($errors) == 0) {
            $category->save();

            Redirect::to('/tehtavaluokka/' . $category->id, array('message' => 'Tehtäväluokka on lisätty muistilistaan'));
        } else {
            View::make('category/new_category.html', array('errors' => $errors, 'attributes' => $attributes));
        }
    }

    public static function edit($id) {
        self::check_logged_in();
        $category = Category::find($id);
        View::make('category/edit_category.html', array('attributes' => $category));
    }

    public static function update($id) {
        self::check_logged_in();
        $user_logged_in=  self::get_user_logged_in();
        $params = $_POST;
        $attributes = array(
            'id' => $id,
            'category_name' => $params ['category_name'],
            'category_description' => $params ['category_description'],
            'personid'=>$user_logged_in->id
        );

        $category = new Category($attributes);
        $errors = $category->errors();

        if (count($errors) > 0) {
            View::make('category/edit_category.html', array('errors' => $errors, 'attributes' => $attributes));
        } else {
            $category->update();

            Redirect::to('/tehtavaluokka/' . $category->id, array('message' => 'Tehtäväluokan muokkaus onnistui'));
        }
    }

    public static function destroy($id) {
        self::check_logged_in();
        $category = new Category(array('id' => $id));
        $category->destroy($id);
        Redirect::to('/tehtavaluokka/' .$category->id, array('message' => 'Tehtäväluokka on poistettu'));
    }

}



