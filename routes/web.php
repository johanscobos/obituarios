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
    //});

    $router->post('/role/create', ['uses' => 'RoleController@createRole' ]);
    $router->put('/role/update/{id}', ['uses' => 'RoleController@updateRole' ]);
    $router->put('/role/destroy/{id}', ['uses' => 'RoleController@destroyRole' ]);

    $router->get('/opcion/show', ['uses' => 'OpcionController@index' ]);
    $router->post('/opcion/create', ['uses' => 'OpcionController@createOpcion' ]);
    $router->put('/opcion/update/{id}', ['uses' => 'OpcionController@updateOpcion' ]);
    $router->put('/opcion/destroy/{id}', ['uses' => 'OpcionController@destroyOpcion' ]);

    //Grupo: Obituarios
    $router->get('/obituario/show', ['uses' => 'ObituariosController@index' ]);
    $router->post('/obituarios/create', ['uses' => 'ObituariosController@createObituario' ]);
    $router->put('/obituarios/update/{id}', ['uses' => 'ObituariosController@updateObituario' ]);
    $router->put('/obituarios/destroy/{id}', ['uses' => 'ObituariosController@destroyObituario' ]);

    //Grupo: Salas
    $router->get('/salas', ['uses' => 'SalasController@index' ]);
    $router->post('/salas/create', ['uses' => 'SalasController@createSala' ]);
    $router->put('/salas/update/{id}', ['uses' => 'SalasController@updateSala' ]);
    $router->put('/salas/destroy/{id}', ['uses' => 'SalasController@destroySala' ]);

    //Grupo: Sedes
    $router->get('/sedes', ['uses' => 'SedesController@index' ]);
    $router->post('/sedes/create', ['uses' => 'SedesController@createSede' ]);
    $router->put('/sedes/update/{id}', ['uses' => 'SedesController@updateSede' ]);
    $router->put('/sedes/destroy/{id}', ['uses' => 'SedesController@destroySede' ]);

    //Grupo: Ubicaciones
    $router->get('/ubicaciones', ['uses' => 'UbicacionesController@index' ]);
    $router->post('/ubicaciones/create', ['uses' => 'UbicacionesController@createUbicacion' ]);
    $router->put('/ubicaciones/update/{id}', ['uses' => 'UbicacionesController@updateUbicacion' ]);
    $router->put('/ubicaciones/destroy/{id}', ['uses' => 'UbicacionesController@destroyUbicacion' ]);
//});
