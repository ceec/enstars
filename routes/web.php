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

Route::get('/','DisplayController@index');

//old home page/all stats
Route::get('/info', 'DisplayController@info');

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
//whatabout groups of skills?
// like /skill/gem/size    /skill/dorifes/vocal /skill/luck -> size can be there or not? if its not it will just show all!
Route::get('/skill/{category}/{type}/{size}','DisplayController@skillCategory');

//units
Route::get('/unit/{unit_name}','DisplayController@unit');

//events
//calculator
Route::get('/event/calculator','DisplayController@eventCalculator');

Route::get('/event/{event_id}','DisplayController@event');


//stories
Route::get('/story/{story_id}','DisplayController@story');
Route::get('/story/{story_id}/{chaper_id}','DisplayController@chapter');


//news/blog
Route::get('/news/{friendly_url}','DisplayController@blog');
//all old blogs


//adding card suggestions
Route::post('/add/name', 'CardController@addName');
Route::post('/add/link', 'CardController@addLink');

//scouts
Route::get('/scout/{scout_id}','DisplayController@scout');

//data
Route::get('/graph/cards-released','DisplayController@cardsReleased');

//contact form
Route::get('/contact','DisplayController@contact');
Route::post('/contact/send','DisplayController@contactSend');


/////////////////////////////////////////////////////////////////////
//    Data
/////////////////////////////////////////////////////////////////////

Route::get('/data/cards-released','DataController@cardsReleased');


/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////

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

//settings
Route::get('/home/edit/css','HomeController@editCSS');
//save settings
Route::post('/home/save/css','HomeController@saveCSS');

//card editing/adding UI
Route::get('/home/card/add','CardController@addDisplay');
//posting
Route::post('/add/card','CardController@add');

Route::get('/home/card/edit/{card_id}','CardController@editDisplay');
//posting
Route::post('/home/edit/card','CardController@edit');

//tool page
Route::get('/home/tools','HomeController@tools');

//adding slides
Route::post('/add/translation/slides','HomeController@addSlides');


//add edit blog
Route::get('/home/blog/add','BlogController@addDisplay');
Route::get('/home/blog/edit/{blog_id}','BlogController@editDisplay');
Route::get('/home/blog/list','BlogController@listDisplay');
//posting
Route::post('/add/blog','BlogController@add');
Route::post('/edit/blog','BlogController@edit');
