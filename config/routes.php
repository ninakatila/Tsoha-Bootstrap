<?php

$routes->get('/', function() {
    PersonController::login();
});

/* $routes->get('/muistilista/kirjautuminen', function() {
  HelloWorldController::login();
  });

  $routes->get('/muistilista/tehtavalista', function() {
  HelloWorldController::task_list();
  });

  $routes->get('/muistilista/tehtava', function() {
  HelloWorldController::task();
  });

  $routes->get('/muistilista/tehtava/muokkaa', function() {
  HelloWorldController::edit_task();
  });

  $routes->get('/muistilista/tehtavaluokat', function() {
  HelloWorldController::category_list();
  });

  $routes->get('/muistilista/tehtavaluokka', function() {
  HelloWorldController::category();
  });

  $routes->get('/muistilista/tehtavaluokka/muokkaa', function() {
  HelloWorldController::edit_category();
  });

  $routes->get('/muistilista/prioriteetit', function() {
  HelloWorldController::importance_list();
  });

  $routes->get('/muistilista/prioriteetti', function() {
  HelloWorldController::importance();
  });

  $routes->get('/muistilista/prioriteetti/muokkaa', function() {
  HelloWorldController::edit_importance();
  });

  $routes->get('/hiekkalaatikko', function() {
  HelloWorldController::sandbox();
  });
 */

$routes->get('/tehtavalista', function() {
    TaskController::index();
});

$routes->get('/login', function() {
    PersonController::login();
});

$routes->post('/login', function() {
    PersonController::handle_login();
});

$routes->post('/logout', function() {
    PersonController::logout();
});

$routes->get('/tehtavaluokat', function() {
    CategoryController::index();
});

$routes->get('/tehtavaluokka/uusi', function() {
    CategoryController::create();
});

$routes->get('/tehtavaluokka/:id/muokkaa', function($id) {
    CategoryController::edit($id);
});

$routes->post('/tehtavaluokka/:id/muokkaa', function($id) {
    CategoryController::update($id);
});

$routes->post('/tehtavaluokka/:id/poista', function($id) {
    CategoryController::destroy($id);
});

$routes->get('/tehtavaluokka/:id', function($id) {
    CategoryController::show($id);
});


$routes->post('/tehtavaluokka', function() {
    CategoryController::store();
});

$routes->get('/tehtava/uusi', function() {
    TaskController::create();
});

$routes->get('/tehtava/:id/muokkaa', function($id) {
    TaskController::edit($id);
});

$routes->post('/tehtava/:id/muokkaa', function($id) {
    TaskController::update($id);
});

$routes->post('/tehtava/:id/poista', function($id) {
    TaskController::destroy($id);
});

$routes->get('/tehtava/:id', function($id) {
    TaskController::show($id);
});


$routes->post('/tehtava', function() {
    TaskController::store();
});