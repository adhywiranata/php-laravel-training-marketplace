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

// <!-- INSERT SKILL USER
Route::post('/skill/create', 'GeneralController@createSkill');
Route::get('/skill/add', 'GeneralController@addSkill');

// INSERT SKILL USER -->

/*
|-----------------------
| LANDING PAGE AND HOME
|-----------------------
*/

Route::get('/tr4ck1n6','GeneralController@tracking');

Route::get('/', 'GeneralController@index');
Route::get('/training-provider', 'GeneralController@provider');
Route::get('/freelance-trainer', 'GeneralController@freelancer');

Route::get('/about', 'GeneralController@about');

Route::get('/login', 'GeneralController@loginLanding');

Route::get('/signup-front/{role}', 'GeneralController@signupLanding');
Route::post('/signup-front/{role}', 'GeneralController@createUserFromLanding');

Route::get('/trainerlist', 'UserController@getUsers');
Route::get('/lang', 'WelcomeController@changeLanguage');
Route::get('/send_email', 'WelcomeController@send_email');

Route::get('/landing', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

/*
|--------
| Utility
|--------
*/
Route::get('count_feature/{id}', 'GeneralController@countFeature');

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
| PROFILE
|--------
*/
Route::get('/dashboard', 'UserController@getUser');
Route::get('/dashboard/contacts', 'ContactController@index');
Route::get('/dashboard/messages', 'MessageController@index');
Route::get('/dashboard/group', 'GroupController@getGroupProfile');

Route::get('dashboard/basic-profile', 'UserController@editBasicProfile');
Route::put('dashboard/basic-profile', 'UserController@updateBasicProfile');

Route::get('/dashboard/forgot-password', 'UserController@editForgotPassword');

//Training Experience
Route::get('/dashboard/training-experience/add', 'GeneralController@addTrainingExperience');
Route::post('/dashboard/training-experience/add','GeneralController@createTrainingExperience');
Route::get('/dashboard/training-experience/{id}/edit','GeneralController@editTrainingExperience');
Route::put('/dashboard/training-experience/{id}/edit','GeneralController@updateTrainingExperience');
Route::delete('/dashboard/training-experience/{id}','GeneralController@deleteTrainingExperience');

//Work Experience
Route::get('/dashboard/work-experience/add','GeneralController@addWorkExperience');
Route::post('/dashboard/work-experience/add','GeneralController@createWorkExperience');
Route::get('/dashboard/work-experience/{id}/edit','GeneralController@editWorkExperience');
Route::put('/dashboard/work-experience/{id}/edit','GeneralController@updateWorkExperience');
Route::delete('/dashboard/work-experience/{id}','GeneralController@deleteWorkExperience');

//Certification
Route::get('/dashboard/certification/add', 'GeneralController@addCertification');
Route::post('/dashboard/certification/add','GeneralController@createCertification');
Route::get('/dashboard/certification/{id}/edit','GeneralController@editCertification');
Route::put('/dashboard/certification/{id}/edit','GeneralController@updateCertification');
Route::delete('/dashboard/certification/{id}','GeneralController@deleteCertification');

//Award
Route::get('/dashboard/award/add', 'GeneralController@addAward');
Route::post('/dashboard/award/add','GeneralController@createAward');
Route::get('/dashboard/award/{id}/edit','GeneralController@editAward');
Route::put('/dashboard/award/{id}/edit','GeneralController@updateAward');
Route::delete('/dashboard/award/{id}','GeneralController@deleteAward');

//Training Program
Route::get('/dashboard/program/add', 'GeneralController@addProgram');
Route::post('/dashboard/program/add','GeneralController@createProgram');
Route::get('/dashboard/program/{id}/edit','GeneralController@editProgram');
Route::put('/dashboard/program/{id}/update','GeneralController@updateProgram');
Route::delete('/dashboard/program/{id}','GeneralController@deleteProgram');

//Skills
Route::get('/dashboard/skill/add', 'GeneralController@addSkill');
Route::delete('/dashboard/skill/{id}', 'GeneralController@deleteSkill');

Route::get('/skill/{id}/endorse', 'GeneralController@addEndorse');
Route::delete('/skill/{id}/remove-endorse', 'GeneralController@deleteEndorse');



//Video
Route::get('/dashboard/video/add', 'GeneralController@addVideo');
Route::post('/dashboard/video/create','GeneralController@createVideo');
Route::get('/dashboard/video/{id}/edit','GeneralController@editVideo');
Route::put('/dashboard/video/{id}/update','GeneralController@updateVideo');
Route::delete('/dashboard/video/{id}','GeneralController@deleteVideo');

//TESTIMONIAL
Route::post('/dashboard/testimonial/{role}/{id}/create','GeneralController@createTestimonial');
/*
|--------
| Search
|--------
*/
//Route::get('/trainers', 'UserController@getUsers');
//Route::get('/trainers-fandy', 'UserController@getUsersF');
//Route::get('/training-providers', 'GroupController@getGroups');
Route::get('/trainers', 'SearchController@find_trainers');
Route::get('/training-providers', 'SearchController@find_providers');

Route::get('/training-needs-analysis', 'SearchController@trainingNeedsAnalysisWizard');
Route::get('/tna/getSubObjectives', 'SearchController@getSubObjectives');
Route::get('/tna/getJobFunctions', 'SearchController@getJobFunctions');
Route::get('/tna/getSeniorityLevels', 'SearchController@getSeniorityLevels');
Route::get('/tna/getIndustryTypes', 'SearchController@getIndustryTypes');
Route::get('/tna/getRelated', 'SearchController@getRelated');

Route::get('/training-needs-analysis/result', 'SearchController@tnaResult');


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

Route::get('/popup/video/{video_title}/{video_id}', 'GeneralController@popupSectionVideo');
Route::get('/popup/testimonial/{owner_id}/{owner_role_id}/{owner_name}', 'GeneralController@popupSectionTestimonial');

Route::get('/create-contact/{owner_id}/{owner_role_id}', 'ContactController@createContact');
Route::get('/remove-contact/{owner_id}/{owner_role_id}', 'ContactController@deleteContact');
Route::get('/get-contacts/{search}/{sort_by}/{sort_order}/{filter_by}/{filter_param}','ContactController@indexAjax');

Route::get('/settings/plan', 'UserController@getPlans');


Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
