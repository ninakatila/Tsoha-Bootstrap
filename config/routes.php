<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });
  
   /* $routes->get('/etusivu', function() {
    HelloWorldController::login();
  });*/

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });
