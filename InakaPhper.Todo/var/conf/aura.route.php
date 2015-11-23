<?php
/**
 * Created by PhpStorm.
 * User: phper
 * Date: 2015/11/24
 * Time: 1:12
 */

/** @var $router \Aura\Router\RouteCollection */

$router->add('/weekday', '/weekday/{year}/{month}/{day}')->addValues(['path' => '/weekday']);