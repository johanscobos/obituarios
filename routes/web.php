<?php

/** @var \Laravel\Lumen\Routing\Router $router */
use App\Http\Middleware\Authenticate;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/
$router->get('/', function () use ($router) {
    return $router->app->version();
});


$router->post('/users/login', ['uses' => 'UsersController@getToken']);
//$router->group(['middleware' => 'auth'], function () use ($router) {
    $router->get('/user/show', ['uses' => 'UsersController@index' ]);
    $router->post('/user/create', ['uses' => 'UsersController@createUser' ]);
    $router->put('/user/update/{id}', ['uses' => 'UsersController@updateUser' ]);
    $router->put('/user/destroy/{id}', ['uses' => 'UsersController@destroyUser' ]);


    $router->post('/role/create', ['uses' => 'RoleController@createRole' ]);
    $router->put('/role/update/{id}', ['uses' => 'RoleController@updateRole' ]);
    $router->put('/role/destroy/{id}', ['uses' => 'RoleController@destroyRole' ]);

    $router->get('/opcion/show', ['uses' => 'OpcionController@index' ]);
    $router->post('/opcion/create', ['uses' => 'OpcionController@createOpcion' ]);
    $router->put('/opcion/update/{id}', ['uses' => 'OpcionController@updateOpcion' ]);
    $router->put('/opcion/destroy/{id}', ['uses' => 'OpcionController@destroyOpcion' ]);
//});







