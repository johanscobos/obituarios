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


    $router::post('/users/login', ['uses' => 'UsersController@getToken']);
  //$router->group(['middleware' => 'auth'], function () use ($router) {
    $router->get('/user/show', ['uses' => 'UsersController@index' ]);
    $router->get('/user/showRole', ['uses' => 'UsersController@getroleuser' ]);
    $router->post('/user/create', ['uses' => 'UsersController@createUser' ]);
    $router->put('/user/update/{id}', ['uses' => 'UsersController@updateUser' ]);
    $router->delete('/user/destroy/{id}', ['uses' => 'UsersController@destroyUser' ]);
    //});

    $router->get('/role/show', ['uses' => 'RoleController@index' ]);
    $router->post('/role/create', ['uses' => 'RoleController@createRole' ]);
    $router->put('/role/update/{id}', ['uses' => 'RoleController@updateRole' ]);
    $router->delete('/role/destroy/{id}', ['uses' => 'RoleController@destroyRole' ]);

    $router->get('/opcion/show', ['uses' => 'OpcionController@index' ]);
    $router->post('/opcion/create', ['uses' => 'OpcionController@createOpcion' ]);
    $router->put('/opcion/update/{id}', ['uses' => 'OpcionController@updateOpcion' ]);
    $router->delete('/opcion/destroy/{id}', ['uses' => 'OpcionController@destroyOpcion' ]);

    //Grupo: Obituarios
    $router->get('/obituario/show/{id}', ['uses' => 'ObituariosController@index' ]);
    $router->get('/obituario/showall', ['uses' => 'ObituariosController@getAll' ]);
    $router->get('/obituario/showobithome', ['uses' => 'ObituariosController@showObituariosHome' ]);
    $router->post('/obituarios/create', ['uses' => 'ObituariosController@createObituario' ]);
    $router->put('/obituarios/update/{id}', ['uses' => 'ObituariosController@updateObituario' ]);
    $router->delete('/obituarios/destroy/{id}', ['uses' => 'ObituariosController@destroyObituario' ]);

    //Grupo: Salas
    $router->get('/salas/show/{id}', ['uses' => 'SalasController@index' ]);
    $router->get('/salas/showall/', ['uses' => 'SalasController@getAll' ]);
    $router->post('/salas/create', ['uses' => 'SalasController@createSala' ]);
    $router->put('/salas/update/{id}', ['uses' => 'SalasController@updateSala' ]);
    $router->delete('/salas/destroy/{id}', ['uses' => 'SalasController@destroySala' ]);

    //Grupo: Sedes
    $router->get('/sedes/show/{id}', ['uses' => 'SedesController@index' ]);
    $router->get('/sedes/showall/', ['uses' => 'SedesController@getAll' ]);
    $router->post('/sedes/create', ['uses' => 'SedesController@createSede' ]);
    $router->put('/sedes/update/{id}', ['uses' => 'SedesController@updateSede' ]);
    $router->delete('/sedes/destroy/{id}', ['uses' => 'SedesController@destroySede' ]);

     //Grupo: Cementerios
     $router->get('/cementerios/show/{id}', ['uses' => 'CementeriosController@index' ]);
     $router->get('/cementerios/showall', ['uses' => 'CementeriosController@getAll' ]);
     $router->post('/cementerios/create', ['uses' => 'CementeriosController@createCementerio' ]);
     $router->put('/cementerios/update/{id}', ['uses' => 'CementeriosController@updateCementerio' ]);
     $router->delete('/cementerios/destroy/{id}', ['uses' => 'CementeriosController@destroyCementerio' ]);

    //Grupo: Iglesias
     $router->get('/iglesias/show/{id}', ['uses' => 'IglesiasController@index' ]);
     $router->get('/iglesias/showall', ['uses' => 'IglesiasController@getAll' ]);
     $router->post('/iglesias/create', ['uses' => 'IglesiasController@createIglesia' ]);
     $router->put('/iglesias/update/{id}', ['uses' => 'IglesiasController@updateIglesia' ]);
     $router->delete('/iglesias/destroy/{id}', ['uses' => 'IglesiasController@destroyIglesia' ]);

    //Grupo: Ubicaciones
    $router->get('/ubicaciones/show', ['uses' => 'UbicacionesController@index' ]);
    $router->post('/ubicaciones/create', ['uses' => 'UbicacionesController@createUbicacion' ]);
    $router->put('/ubicaciones/update/{id}', ['uses' => 'UbicacionesController@updateUbicacion' ]);
    $router->delete('/ubicaciones/destroy/{id}', ['uses' => 'UbicacionesController@destroyUbicacion' ]);

    $router->get('/ciudades/show/{id}', ['uses' => 'CiudadesController@index' ]);
    $router->get('/ciudades/showAll', ['uses' => 'CiudadesController@getAll' ]);
//});
