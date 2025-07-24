<?php
/**
 * Routes configuration.
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * It's loaded within the context of `Application::routes()` method which
 * receives a `RouteBuilder` instance `$routes` as method argument.
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

use Cake\Routing\Route\DashedRoute;
use Cake\Routing\RouteBuilder;

/*
 * This file is loaded in the context of the `Application` class.
  * So you can use  `$this` to reference the application class instance
  * if required.
 */
//return function (RouteBuilder $routes): void {
    /*
     * The default class to use for all routes
     *
     * The following route classes are supplied with CakePHP and are appropriate
     * to set as the default:
     *
     * - Route
     * - InflectedRoute
     * - DashedRoute
     *
     * If no call is made to `Router::defaultRouteClass()`, the class used is
     * `Route` (`Cake\Routing\Route\Route`)
     *
     * Note that `Route` does not do any inflections on URLs which will result in
     * inconsistently cased URLs when used with `{plugin}`, `{controller}` and
     * `{action}` markers.
     */
    $routes->setRouteClass(DashedRoute::class);

    // in config/routes.php
    $routes->scope('/api', function (RouteBuilder $routes): void {
        $routes->setExtensions(['json', 'xml']);
        $routes->resources('Articles', ['prefix' => 'Api']);
        $routes->resources('Users', ['prefix' => 'Api']);
        $routes->resources('Tags', ['prefix' => 'Api']);
    });

    $routes->scope('/api', function (RouteBuilder $routes) {

        // ARTICLES
        // Route for GET requests to /articles/view{id}
        $routes->get('/articles/view/{id}', ['controller' => 'Articles', 'action' => 'view'])
            ->setPatterns(['id' => '[0-9]+']); // Define ID as a numeric pattern

        // Route for POST requests to /articles/add
        $routes->post('/articles/add', ['controller' => 'Articles', 'action' => 'add']); 

        // Route for PUT requests to /articles/edit/{id}
        $routes->put('/articles/edit/{id}', ['controller' => 'Articles', 'action' => 'edit'])
            ->setPatterns(['id' => '[0-9]+']); // Define ID as a numeric pattern

        // Route for DELETE requests to /articles/delete/{id}
        $routes->delete('/articles/delete/{id}', ['controller' => 'Articles', 'action' => 'delete'])
            ->setPatterns(['id' => '[0-9]+']); // Define ID as a numeric pattern

        // USERS
        // Route for GET requests to /users/view
        $routes->get('/users/view/{id}', ['controller' => 'Users', 'action' => 'view'])
            ->setPatterns(['id' => '[0-9]+']);

        // Route for POST requests to /users/add
        $routes->post('/users/add', ['controller' => 'Users', 'action' => 'add']); 

        // Route for PUT requests to /users/edit/{user_id}
        $routes->put('/users/edit/{user_id}', ['controller' => 'Users', 'action' => 'edit'])
            ->setPatterns(['user_id' => '[0-9]+']);

        $routes->delete('/users/delete/{id}', ['controller' => 'Users', 'action' => 'delete'])
            ->setPatterns(['id' => '[0-9]+']);

        // TAGS
        $routes->get('/tags/view/{id}', ['controller' => 'Tags', 'action' => 'view'])
            ->setPatterns(['id' => '[0-9]+']);
        
        $routes->post('/tags/add', ['controller' => 'Tags', 'action' => 'add']); 
    
        $routes->put('/tags/edit/{id}', ['controller' => 'Tags', 'action' => 'edit'])
            ->setPatterns(['id' => '[0-9]+']);

        $routes->delete('/tags/delete/{id}', ['controller' => 'Tags', 'action' => 'delete'])
            ->setPatterns(['id' => '[0-9]+']);
    });

    $routes->scope('/', function (RouteBuilder $builder) {
        /*
         * Here, we are connecting '/' (base path) to a controller called 'Pages',
         * its action called 'display', and we pass a param to select the view file
         * to use (in this case, templates/Pages/home.php)...
         */
        $builder->connect('/', ['controller' => 'Pages', 'action' => 'display', 'home']);

        /*
         * ...and connect the rest of 'Pages' controller's URLs.
         */
        $builder->connect('/pages/*', ['controller' => 'Pages', 'action' => 'display']);

        // New route we're adding for our tagged action.
        // The trailing `*` tells CakePHP that this action has
        // passed parameters.
        $builder->scope('/articles', function (RouteBuilder $builder) {
            $builder->connect('/tagged/*', ['controller' => 'Articles', 'action' => 'tags']);
        });

        // $builder->scope('/users/view/*', function (RouteBuilder $builder) {
        //     $builder->connect('/articles/edit*', ['controller' => 'Articles', 'action' => 'edit']);
        // });

        /*
         * Connect catchall routes for all controllers.
         *
         * The `fallbacks` method is a shortcut for
         *
         * ```
         * $builder->connect('/{controller}', ['action' => 'index']);
         * $builder->connect('/{controller}/{action}/*', []);
         * ```
         *
         * You can remove these routes once you've connected the
         * routes you want in your application.
         */
        $builder->fallbacks();
    });


    
    // in config/routes.php
// $routes->scope('/', function (RouteBuilder $routes): void {
//     $routes->setExtensions(['json']);
//     $routes->resources('Recipes');
// });
    /*
     * If you need a different set of middleware or none at all,
     * open new scope and define routes there.
     *
     * ```
     * $routes->scope('/api', function (RouteBuilder $builder): void {
     *     // No $builder->applyMiddleware() here.
     *
     *     // Parse specified extensions from URLs
     *     // $builder->setExtensions(['json', 'xml']);
     *
     *     // Connect API actions here.
     * });
     * ```
     */
// };
