<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });
  
  $routes->get('/muistilista/kirjautuminen', function() {
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

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });
