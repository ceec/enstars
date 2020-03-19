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

//data check on boys page
Route::get('/data/idol/{boy_id}', 'DisplayController@idolData');

//all of a boys cards
Route::get('/idol/{boy_id}/all', 'DisplayController@idolAll');

//Cheslea page
Route::get('/chelsea', 'DisplayController@chelsea');

//specific card
Route::get('/card/{card_id}', 'DisplayController@card');

//tags
Route::get('/tag/{tag_name}','DisplayController@tag');

//skills
Route::get('/skill/{skill_id}','DisplayController@skill');
//whatabout groups of skills?
// like /skill/gem/size    /skill/dorifes/vocal /skill/luck -> size can be there or not? if its not it will just show all!
Route::get('/skill/{category}/{type}/{size}','DisplayController@skillCategory');

//units
Route::get('/unit/{unit_name}','DisplayController@unit');
//classes
Route::get('/class/{class_name}','DisplayController@classroom');
//clubs

//events
//calculator
Route::get('/event/calculator','DisplayController@eventCalculator');

//all events
Route::get('/event/all','DisplayController@eventAll');

//specific event
Route::get('/event/{event_id}','DisplayController@event');

//mini event
Route::get('/minievent/{event_id}','DisplayController@miniEvent');


//all scouts
Route::get('/scout/all','DisplayController@scoutAll');
//specfic scouts
Route::get('/scout/{scout_id}','DisplayController@scout');

//all collaborations
Route::get('/collaboration/all','DisplayController@collaborationAll');
//specific collaboration
Route::get('/collaboration/{collaboration_id}','DisplayController@collaboration');

// All Unit Collections
Route::get('/unitcollection/all','DisplayController@collectionAll');
// Specific Unit Collection
Route::get('/unitcollection/{collection_id}','DisplayController@collection');

//listing large groups of stories
Route::get('/translation/event','DisplayController@translationEvent');
Route::get('/translation/scout','DisplayController@translationScout');
Route::get('/translation/character','DisplayController@translationCharacter');
Route::get('/translation','DisplayController@translation');


//stories
Route::get('/story/{story_id}','DisplayController@story');
Route::get('/story/{story_id}/{chaper_id}','DisplayController@chapter');
Route::get('/story/{story_id}/{chaper_id}/{generated}','DisplayController@chapter');
Route::get('/story/{story_id}/{chaper_id}/{generated}/{raw}','DisplayController@chapter');

//all old blogs
Route::get('/news/all','DisplayController@blogAll');
//news/blog
Route::get('/news/{friendly_url}','DisplayController@blog');


//unitskills
Route::get('/unitskill/all','DisplayController@unitskillAll');
//specfic scouts
Route::get('/unitskill/{skill_id}','DisplayController@unitskill');


//adding card suggestions
Route::post('/add/name', 'CardController@addName');
Route::post('/add/link', 'CardController@addLink');


//store
Route::get('/store','DisplayController@store');


//login events
Route::get('/bonus/all','DisplayController@loginBonusAll');
Route::get('/bonus/{name}','DisplayController@loginBonus');

//graphs
//released cards
Route::get('/graph/cards-released','DisplayController@cardsReleased');
//guessing future cards
Route::get('/graph/five-star-history','DisplayController@cardPrediction');
//event history
Route::get('/graph/event-border-history','GraphController@eventHistory');
//timeline of events and scouts
Route::get('/graph/timeline','DisplayController@timeline');
//fivestar history color
Route::get('/graph/five-star-color','DisplayController@cardFiveStarColor');


//contact form
Route::get('/contact','DisplayController@contact');
Route::post('/contact/send','DisplayController@contactSend');

//displaying user profile without being logged in, anyone can see
Route::get('/collection/{name}','DisplayController@userCollection');

//card error form
Route::get('/cardissue/{card}','DisplayController@cardIssue');
Route::post('/cardissue/send','DisplayController@cardIssueSend');

//list of all cards data
Route::get('/graph/cardlist','DisplayController@cardList');


////gameplay info///////
Route::get('/game/management','GameController@management');
Route::get('/game/courses','GameController@courses');
Route::get('/game/releasenotes','GameController@releasenotes');
Route::get('/game/terms','GameController@terms');


//////// Beta Features in BetaController - move when hatched //////


Route::get('/memory','BetafeatureController@memoryGame');
Route::get('/memory/{language}','BetafeatureController@memoryGame');



/////////////////////////////////////////////////////////////////////
//    Data
/////////////////////////////////////////////////////////////////////

Route::get('/data/cards-released','DataController@cardsReleased');
Route::get('/data/event-border-history','DataController@eventHistory');
//specific event border
Route::get('/data/event-border/{event_id}','DataController@eventBorder');
//current event borders
Route::get('/data/event-border','DataController@eventBorder');
//timeline of events and scouts
Route::get('/data/timeline','DataController@timeline');
//idolroad
Route::get('/data/road/{card_id}','DataController@idolRoad');
//cardfrequency
Route::get('/data/frequency/{boy_id}','DataController@frequencyChart');

/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////

//baby api
Route::get('/api/event/{event_id}','ApiController@event');
Route::get('/api/skill/dreamfestival/{type}','ApiController@skill');






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
Route::get('/home/translations/menu','HomeController@translationMenu');
Route::get('/home/translations/{story_id}','HomeController@translationStory');
Route::get('/home/translations/{story_id}/minievent/{mini_id}','HomeController@translationMiniEvent');
Route::get('/home/translations/{story_id}/{chapter_id}','HomeController@translationChapter');
Route::get('/home/status','HomeController@translationStatus');


//posting
Route::post('/add/translation','HomeController@addTranslation');
//ajax posting
Route::post('/add/translationajax','HomeController@addTranslationAjax');
Route::post('/add/minievent/translationajax','HomeController@addMiniEventTranslationAjax');
//setting chapter live
Route::post('/add/chapterDisplay','HomeController@chapterDisplay');
//changing chapter name
Route::post('/add/chapterName','HomeController@chapterName');



//settings
Route::get('/home/edit/css','HomeController@editCSS');
//save settings
Route::post('/home/save/css','HomeController@saveCSS');

//card editing/adding UI
Route::get('/home/card/add','CardController@addDisplay');
//posting
Route::post('/add/card','CardController@add');
Route::post('/edit/card','CardController@edit');
//add a road for a card that doesnt have one
Route::post('/edit/card/addRoad','CardController@addRoad');
//edit one node
Route::post('/edit/card/editRoadNode','CardController@editRoadNode');
//add suggestion
Route::post('/add/cardsuggestion','CardController@addsuggestion');
//edit suggestion
Route::post('/edit/cardsuggestion','CardController@editsuggestion');

//events
Route::post('/edit/event','EventController@edit');
Route::post('/edit/event/card','EventController@editCard');

//scouts
Route::post('/edit/scout','ScoutController@edit');

// Unit Collections
Route::post('/edit/collection','CollectionController@edit');

Route::get('/home/card/edit/{card_id}','CardController@editDisplay');
//posting
Route::post('/home/edit/card','CardController@edit');

Route::get('/home/tools/createEventCards','HomeController@toolCreateEventCards');
//tool page
Route::get('/home/tools','HomeController@tools');
//individual tools
Route::get('/home/tools/addSlides','HomeController@toolAddSlides');
Route::get('/home/tools/generatedText','HomeController@toolAddGeneratedText');
Route::get('/home/tools/createEventCards','HomeController@toolCreateEventCards');
Route::get('/home/tools/emailTest','HomeController@emailTest');
Route::get('/home/tools/scraper','HomeController@scraper');

//adding slides
Route::post('/add/translation/slides','HomeController@addSlides');
//adding generated text
Route::post('/add/translation/generatedText','HomeController@addGeneratedText');

//add edit blog
Route::get('/home/blog/add','BlogController@addDisplay');
Route::get('/home/blog/edit/{blog_id}','BlogController@editDisplay');
Route::get('/home/blog/list','BlogController@listDisplay');
//posting
Route::post('/add/blog','BlogController@add');
Route::post('/edit/blog','BlogController@edit');

//adding event data
Route::get('/home/event/data','HomeController@eventData');
Route::post('/add/event/data','HomeController@addEventData');

//add scout
Route::get('/home/scout/add','ScoutController@addDisplay');
Route::post('/add/scout','ScoutController@add');

//add event
Route::get('/home/event/add','EventController@addDisplay');
Route::post('/add/event','EventController@add');

// Add unit collection
Route::get('/home/unitcollection/add','CollectionController@addDisplay');
Route::post('/add/unitcollection','CollectionController@add');

//add event/scout from scraper
Route::get('/home/scraper/add','ScraperController@addDisplay');
Route::post('/add/scraper','ScraperController@add');
Route::post('/add/scraper/step/two','ScraperController@addStepTwo');


//add release notes
Route::get('/home/releasenote/add','ReleasenoteController@addDisplay');
Route::post('/add/releasenote','ReleasenoteController@add');
//edit release notes
Route::get('/home/releasenote/edit/{note_id}','ReleasenoteController@editDisplay');
Route::post('/edit/releasenote','ReleasenoteController@edit');
//display release notes for editing
Route::get('/home/releasenote/list','ReleasenoteController@listDisplay');

//suggestions
Route::get('/home/suggestions','HomeController@suggestions');

Route::post('/home/suggestion/clear','HomeController@suggestionClear');

//card issues
Route::get('/home/cardissues','HomeController@cardIssues');
Route::post('/home/cardissues/clear','HomeController@cardIssueClear');

//messages
Route::get('/home/messages','HomeController@messages');
Route::post('/home/message/clear','HomeController@messageClear');
Route::post('/home/message/delete','HomeController@messageDelete');

//feature requests
Route::get('/home/features','HomeController@features');
Route::post('/home/feature/approve','HomeController@featureApprove');
Route::post('/home/feature/delete','HomeController@featureDelete');

/////////////// USER ///////////////

///user stuff
Route::post('/add/user/card','UserController@addCard');
Route::post('/remove/user/card','UserController@removeCard');
//events
Route::post('/add/user/event','UserController@addEvent');
Route::post('/update/user/event','UserController@updateEvent');

//account options
Route::post('/update/user/account','UserController@updateAccount');

///users pages
//dashboard
Route::get('/user/dashboard','UserController@dashboard');
//all cards
Route::get('/user/{name}/cards','UserController@cards');
//scouts
Route::get('/user/{name}/scouts','UserController@scouts');
//account options
Route::get('/user/{name}/account','UserController@account');

//edit user card
Route::post('/user/edit/card','UserController@updateCard');

Route::post('/user/edit/dashboardCard','UserController@updateDashboardCard');

//update user team for event calculator
Route::post('/user/edit/team','UserController@updateTeam');

///feature requests
Route::get('/user/features','UserController@features');
Route::get('/user/feature/suggest','UserController@featureSuggest');
//add new feature
Route::post('/user/add/feature','UserController@featureAdd');