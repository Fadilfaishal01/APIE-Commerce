<?php

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

// Controller Route
$router->get('/key', 'ExampleController@generateKey');

$router->post('/foo', 'ExampleController@fooExam');
$router->get('/foo2', 'ExampleController@fooExam');

$router->get('/user/{id}', 'ExampleController@getUser');

// $router->get('/foo', function() {
//     return "Method Get";
// });

// $router->post('/bar', function() {
//     return "Method Post";
// });


/* Router Allow you to register routes that respond to any HTTP  
    1. GET
    2. POST
    3. PUT
    4. PATCH
    5. PATCH
    6. DELETE
    7. OPTIONS
*/

// Parameter Route

// $router->get('/user/{id}', function($id) {
//     return "User ID = " . $id;
// });

// // Double Parameter

// $router->get('/users/{Userid}/nama/{ktp}', function($Userid, $ktp) {
//     return "User ID = " . $Userid . "Fadil = " . $ktp;
// });

// Parameter Optional

// $router->get('/pengguna[/{Userid}]', function($Userid = null) {
//     return "User ID = " . $Userid;
// });

// Nama Alias pada Parameter

// $router->get('profile', function () {
//     return redirect()->route('route.profile');
// });

// $router->get('profile/nama', ['as' => 'route.profile', function () {
//     return 'FADIL FAISHAL';
// }]);

// Router Group
// Prefix       = Key untuk menjadi awalan di URL = admin/home
// Middleware   = Autentikasi terlebih dahulu untuk mengakses turunan route dibawah (Session)
/* Namespace    = Membuat suatu folder secara custom tidak mengikutin standar lumen, Membuat directory
sendiri dari controller atau hal lainnya */
// uses         = Folder / File Controller yg digunakan = BarangController@index

// $router->group(['prefix' => 'admin', 'middleware' => 'auth', 'namespace' => ''], function () use ($router){
//     $router->get('home', function () {
//         return 'Home Admin';
//     });

//     $router->get('profile', function () {
//         return 'Profile Admin';
//     });
// });

// Middleware

$router->get('profile', ['as' => 'profile', 'uses' =>  'ExampleController@getProfile']);
$router->get('profile/action', ['as' => 'profile.action', 'uses' =>  'ExampleController@getProfile']);

$router->get('/admin/home', ['middleware' => 'umur', function () {
    return 'Umur Cukup';
}]);

$router->get('/failed', function () {
    return 'Umur Kurang';
});

// Middleware Use Controller

// $router->get('/admin/home', ['middleware' => 'umur', 'uses' => 'ExampleController@getProfile']);

// Route Controller User Request Hanlder
// $router->get('req/method', 'ExampleController@RequestMethod');

// POST GET API
// $router->post('user/profile', 'ExampleController@UserProfile');

// Response HTTP
// $router->get('/response', 'ExampleController@Response');

// $router->post('/register', 'AuthController@register');
// $router->post('/login', 'AuthController@login');

$router->get('/barang', 'DataBarangController@GetDataBarang');
$router->post('/barang', 'DataBarangController@TambahDataBarang');
$router->post('/hapusBarang/{id}', 'DataBarangController@HapusBarang');