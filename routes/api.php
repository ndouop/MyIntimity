<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



Route::resource('$_m_o_d_e_l__n_a_m_e_s', '$MODEL_NAMEAPIController');



Route::resource('pays', 'PayAPIController');

Route::resource('users', 'UserAPIController');

Route::resource('users', 'UserAPIController');

Route::resource('pays', 'PayAPIController');

Route::resource('pays', 'PayAPIController');

Route::resource('pays', 'PayAPIController');

Route::resource('pays', 'PayAPIController');

Route::resource('regions', 'RegionAPIController');

Route::resource('villes', 'VilleAPIController');

Route::resource('categories', 'CategorieAPIController');

Route::resource('devises', 'DeviseAPIController');

Route::resource('dons', 'DonAPIController');

Route::resource('fichiers', 'FichierAPIController');

Route::resource('friends', 'FriendAPIController');

Route::resource('likes', 'likeAPIController');

Route::resource('messages', 'MessageAPIController');

Route::resource('paiements', 'PaiementAPIController');

Route::resource('permissions', 'PermissionAPIController');

Route::resource('permission_roles', 'Permission_roleAPIController');

Route::resource('reponses', 'ReponseAPIController');

Route::resource('roles', 'RoleAPIController');

Route::resource('role_users', 'Role_userAPIController');

Route::resource('soldes', 'SoldeAPIController');

Route::resource('sujets', 'SujetAPIController');

Route::resource('villes', 'VilleAPIController');