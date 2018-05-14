<?php
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

Router::prefix('admin', function (RouteBuilder $routes) {
	$routes->plugin('Trois/Pages', ['path' => '/pages'], function (RouteBuilder $routes) {
		$routes->connect('/', ['controller' => 'Pages', 'action' => 'index'], ['routeClass' => DashedRoute::class]);
		$routes->setExtensions(['json']);
		$routes->fallbacks(DashedRoute::class);
	});
});
