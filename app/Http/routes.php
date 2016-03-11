<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
|-----------
| Test Hacks
|------------
*/
Route::get('/hack1','UserController@hack1');



//<!-- CRUD WORK EXPERIENCE
Route::post('/create-work-experience','GeneralController@createWorkExperience');
Route::get('/add-work-experience','GeneralController@addWorkExperience');

Route::get('/edit-work-experience/{id}','GeneralController@editWorkExperience');
Route::put('/update-work-experience/{id}','GeneralController@updateWorkExperience');

Route::delete('/delete-work-experience/{id}','GeneralController@deleteWorkExperience');

// CRUD WORK EXPERIENCE -->

// <!-- INSERT SKILL USER
Route::post('/skill/create', 'GeneralController@createSkill');
Route::get('/skill/add', 'GeneralController@addSkill');

// INSERT SKILL USER -->


Route::get('/', 'GeneralController@index');
Route::get('/training-provider', 'GeneralController@provider');
Route::get('/freelance-trainer', 'GeneralController@freelancer');

Route::get('/trainerlist', 'UserController@getUsers');
Route::get('/lang', 'WelcomeController@changeLanguage');
Route::get('/send_email', 'WelcomeController@send_email');

Route::get('/landing', 'WelcomeController@index');
Route::get('home', 'HomeController@index');


/*
|--------
| Auth
|--------
*/

Route::post('auth', 'AuthController@index');
Route::get('logout', 'AuthController@logout');

Route::get('auth/google', 'AuthController@redirectToGoogle');
Route::get('auth/google/callback', 'AuthController@handleGoogleCallback');

Route::get('auth/linkedin', 'AuthController@redirectToLinkedin');
Route::get('auth/linkedin/callback', 'AuthController@handleLinkedinCallback');

/*
|--------
| Search
|--------
*/
Route::get('/training-needs-analysis', 'SearchController@trainingNeedsAnalysis');

/*
|--------
| PROFILE
|--------
*/
Route::get('/dashboard', 'UserController@getUser');
Route::get('/dashboard/contacts', 'UserController@getContacts');
Route::get('/dashboard/messages', 'MessageController@index');
Route::get('/dashboard/group', 'GroupController@getGroupProfile');

Route::get('dashboard/basic-profile', 'UserController@editBasicProfile');
Route::put('dashboard/basic-profile', 'UserController@updateBasicProfile');

Route::get('/dashboard/forgot-password', 'UserController@editForgotPassword');

Route::get('/dashboard/training-experience/add', 'GeneralController@addTrainingExperience');

Route::get('/dashboard/work-experience/add', 'GeneralController@addWorkExperience');

Route::get('/dashboard/certification/add', 'GeneralController@addCertification');

Route::get('/dashboard/award/add', 'GeneralController@addAward');

Route::get('/dashboard/program/add', 'GeneralController@addProgram');

Route::get('/dashboard/skill/add', 'GeneralController@addSkill');

Route::get('/settings/plan', 'UserController@getPlans');

/*
|--------
| Search
|--------
*/

Route::get('/trainers', 'UserController@getUsers');
Route::get('/trainers-fandy', 'UserController@getUsersF');
Route::get('/training-providers', 'GroupController@getGroups');

/*
|--------
| Users
|--------
*/
Route::get('/users', 'UserController@getUsers');
Route::get('/u/{slug}', 'UserController@getUser');
Route::get('/g/{slug}', 'GroupController@getGroup');
Route::get('/evaluation/{slug}', 'GeneralController@getEvaluation');

/*
|--------
| Events
|--------
*/
Route::get('/public-training/add', 'EventController@addPublicTraining');
Route::get('/public-trainings', 'EventController@getPublicTrainings');
Route::get('/{event}/register', 'EventController@registerTraining');

/*
|--------
| Trainings
|--------
*/
Route::get('{group}/trainings','TrainingController@getTrainings');
Route::get('{group}/training/{name}','TrainingController@getTrainingDetail');
Route::get('{group}/create-training','TrainingController@createTraining');
Route::post('{group}/create-training','TrainingController@insertTraining');
Route::get('{group}/edit-training/{id}','TrainingController@editTraining');
Route::get('{group}/delete-training/{id}','TrainingController@deleteTraining');
Route::get('{group}/training/{name}/add-evaluation','TrainingController@createEvaluation');
Route::post('{group}/training/{name}/add-evaluation','TrainingController@insertEvaluation');


/*
|--------
| Ajax
|--------
*/
Route::get('getautocompletedata/{table}/{columnName}/{key}','GeneralController@getAutoCompleteData');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
