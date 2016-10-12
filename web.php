<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', 'DisplayController@index');

//birthdaycalendar
Route::get('/birthdays', 'DisplayController@birthdays');

//specific boys page
Route::get('/idol/{boy_id}', 'DisplayController@idol');
//all of a boys cards
Route::get('/idol/{boy_id}/all', 'DisplayController@idolAll');

//Cheslea page
Route::get('/chelsea', 'DisplayController@chelsea');

//specific card
Route::get('/card/{card_id}', 'DisplayController@card');

//userprofile ->public
Route::get('/user/{user_id}','DisplayController@user');

//tags
Route::get('/tag/{tag_name}','DisplayController@tag');

//skills
Route::get('/skill/{skill_id}','DisplayController@skill');

//units
Route::get('/unit/{unit_name}','DisplayController@unit');

//events
//calculator
Route::get('/event/calculator','DisplayController@eventCalculator');

Route::get('/event/{event_url}','DisplayController@event');


//stories
Route::get('/story/{story_id}','DisplayController@story');
Route::get('/story/{story_id}/{chaper_id}','DisplayController@chapter');

//adding card suggestions
Route::post('/add/name', 'CardController@addName');
Route::post('/add/link', 'CardController@addLink');

Auth::routes();

//dashboard
Route::get('/home', 'HomeController@index');
//user cardlist in dashboard
Route::get('/home/cards','HomeController@cards');

Route::get('/home/album','HomeController@album');
//add cards to album
Route::get('/home/album/builder','HomeController@albumBuilder');

//translation area
Route::get('/home/translations','HomeController@translations');
Route::get('/home/translations/{story_id}','HomeController@translationStory');
Route::get('/home/translations/{story_id}/{chapter_id}','HomeController@translationChapter');
//posting
Route::post('/add/translation','HomeController@addTranslation');
//ajax posting
Route::post('/add/translationajax','HomeController@addTranslationAjax');

//tool page
Route::get('/home/tools','HomeController@tools');
//adding slides
Route::post('/add/translation/slides','HomeController@addSlides');



