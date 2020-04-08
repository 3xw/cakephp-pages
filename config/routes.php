<?php
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;


Router::prefix('Admin', function (RouteBuilder $routes) {
	$routes->plugin('Trois/Pages', ['path' => '/pages'], function (RouteBuilder $routes) {
		$routes->connect('/', ['controller' => 'Pages', 'action' => 'index']);
		  $routes->setExtensions(['json']);
			$routes->resources('SectionTypes');
		$routes->fallbacks();
	});
});

/*
//FRONT ROUTES ACTIVE
Router::plugin(
    'Trois/Pages',
    ['path' => '/pages'],
    function (RouteBuilder $routes)
    {
      $routes->setExtensions(['json']);
      $routes->fallbacks('DashedRoute');
    }
);
*/
