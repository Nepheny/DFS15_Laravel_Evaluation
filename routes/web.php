<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**
 * Route 1
 * Uri : /
 * Action : appelle la méthode index du contrôleur
 * Name : home
 */

Route::get('/', 'TopicController@index')->name('home');

/**
 * Route 2
 * Ressource
 * Modèle : topics
 * Contrôleur : TopicController
 * Sauf la route index (car elle est générée par la Route 1)
 */

Route::resource('topics', 'TopicController', ['except' => ['index']]);

/**
 * Route 3
 * Uri : commentaire
 * Action : appelle la méthode comment du contrôleur
 * Name : commentaire
 * Méthode http : post
 */

Route::post('commentaire', 'TopicController@comment')->name('commentaire');

/**
 * Route 4
 * Uri : recherche
 * action : appelle la méthode search du contrôleur
 * name : recherche
 */

Route::post('recherche', 'TopicController@search')->name('recherche');

/**
 * Auth routes
 */
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
