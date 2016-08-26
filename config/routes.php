<?php

$routes->get('/', function() {
    PersonController::login();
});

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

$routes->get('/prioriteetit', function() {
    ImportanceController::index();
});

$routes->get('/prioriteetti/uusi', function() {
    ImportanceController::create();
});

$routes->get('/prioriteetti/:id/muokkaa', function($id) {
    ImportanceController::edit($id);
});

$routes->post('/prioriteetti/:id/muokkaa', function($id) {
    ImportanceController::update($id);
});

$routes->post('/prioriteetti/:id/poista', function($id) {
    ImportanceController::destroy($id);
});

$routes->get('/prioriteetti/:id', function($id) {
    ImportanceController::show($id);
});


$routes->post('/prioriteetti', function() {
    ImportanceController::store();
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