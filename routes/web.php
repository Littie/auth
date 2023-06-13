<?php
declare(strict_types=1);

use App\Core\Router;

/** @var $this Router */

/** @uses \App\Controller\LoginController */
$this->get('/login', 'App\Controller\LoginController@index');

/** @uses \App\Controller\SigninController */
$this->post('/signin', 'App\Controller\SigninController@index');

/** @uses \App\Controller\RegisterController */
$this->get('/register', 'App\Controller\RegisterController@index');

/** @uses \App\Controller\RegisterController */
$this->post('/signup', 'App\Controller\SignupController@index');

/** @uses \App\Controller\HomeController */
$this->get('/home', 'App\Controller\HomeController@index');

/** @uses \App\Controller\MainController */
$this->get('/', 'App\Controller\MainController@index');
