# enstars.info

[enstars.info](http://enstars.info)

enstars.info is a database for the Japanese app card game Ensemble Stars. It uses Laravel as a base and it's goal to
have easily acessable game data.

I am working on this by myself so any data errors you find let me know at cc@enstars.info! I'm open to any ideas and
feature requests as well!

# Versions

2016-09-18 Version 1.1

* Added ability to hide collections
* Added card issue form for each card

2016-09-24 Version 1.2 Admin:

* Add unupgraded lesson and dream festival skills to the database
* Added ability to edit scout and event names and times
* Added boy class buttons to Translation UI

General:

* Tied users to messages and card issues.

# Database

## agencies

id / name / udpdated_at / created_at

Holds the names for the agenices the idols belong to.

Last used 2020-03-17

## alerts

id / japanese_title / english_title / japanese_text / english_text / updated_at / updated_by / created_at

Translations for the pop up messages throughout the game.

Last used 2016-06-30

## blogs

Holds the news blogs.

## boys

Holds all the data on each idol.

Last used 2020-03-17

## cardissues

Holds the messages from users about card issues.

## cardroads

Holds the Idol Road information on each card.

## cards

Holds the info on each card.

## cardskills

id / card_id / type / updated_at / updated_by / created_at

Empty

## cardsuggestions

Holds the user entered suggested changes to cards.

## cardtags

Holds the tag lookup for each card.

Last used 2016-09-16

## chapterboys

Holds what boy was speaking in what chapter.

Last used 2019-04-15

## chapters

Holds the main information on each story's chapters.

## classrooms

Holds each classroom for the boys. Only used in classic.

Last updated 2018-08-12

## clubs

Holds each club for the boys. Only used in classic?

Last updated 2017-02-25

## collaborations

Holds the main information on each collaboration.

Last updated 2019-03-31

## collections

Holds each unit collection. Classic only.

Last updated 2020-01-09

## drawcards

Lookup table for cards scouted. Created but never used. Only has one entry

Last updated 2016-06-27

## draws

Main table for cards scouted. Created but never used. Only has one entry.

Last updated 2016-06-27

## eventcards

Somewhat lookup table to start to separate the scout/event info from the cards table.

Last updated 2019-10-01

## eventchoices

Unsure, I think this was for the mini event options during events. Maybe classic only?

Last upated 2016-08-07

## eventpoints

Holds the data for each tier for each event. Tried to do 2 data points per day.

Last updated 2019-10-15

## events

Holds the events from classic. Might also be relevant for basic?

Last updated 2019-10-01

## eventsold

This probably should be deleted. I think this was the original minievents?

Last updated 2016-08-05

## eventunits

Not used.

## eventypes

Not used.

## features

Not used.

## games

id / title / updated_at / created_at

Holds the name for each game: basic, music, classic

Last updated 2020-03-16.

## gameterms

id / jp / en / created_at / updated_at

Holds translations for the gameplay terms used throughout the game.

## gemcourses

Not used. Keeping track of what gem course was available what day. Could be updated for basic and used.

Last updated 2016-10-02.

## lessonskills

Original database to track skills, replaced by skills. This can be deleted.

Last updated 2016-09-19.

## logineventdays

Not used. Lookup table to loginevents. Abandoned effort to track login event things. I think this was for the 2nd (3rd?)
white day.

Last updated 2017-03-24.

## loginevents

Not used. Held the main login event information.

Last updated 2017-03-18.

## messages

Holds messages from users.

## minieventchoices

Lookup table for minievents. Abandoned effort to track course mini event and translations.

Last updated 2017-03-05.

## minievents

Helf the main info on each mini event. Translation focused table.

Last updated 2017-03-17

## minieventslides

Lookup table for minievents. Holds the translations for each screenshot in minievents.

Last updated 2017-03-09.

## minieventsOLD

Should be deleted. Original effort to track the character focused mini events. I had hand written a lot of these into
that journal.

Last updated 2016-07-03.

## missions

Basic table.

Holds the translations for the course mission objectives.

Last updated: 2020-03-19.

## news

Not used? Abandoned effort to track the in game news.

Last updated: 2016-08-14.

## offices

Basic table / Music table.

id / name / created_at / updated_at

Should be renamed agencies. Holds the agency names.

Last updated: 2020-03-16.

## releasenotes

Holds game changes. Somewhat abandoned.

Last updated: 2019-06-06

## rewards

Holds the event tiers and what rewards for that tier.

Last updated: 2016-11-27

## schools

Classic only?

Holds the name for each of the idol's schools.

Last updated: 2017-10-15

## scoutcards

Attempt of moving cards tied to a scout of the cards table. Should be combined into something general with eventcards.

Last updated: 2019-07-15

## scouts

Holds the main information on each scout. Should be combined with events into something general that can hold both.

Last updated: 2020-03-03

## scouttypes

id / name / updated_at / created_at

Holds the different types of scout.

Last updated: 2019-07-04.

## skills

Used for all three games.

Holds the two types of skills for each card.

Last updatedL 2020-03-16.

## slides

Translation table.

Holds each chapter's slides.

Last updated: 2019-04-05

## stories

Translation table.

Holds the main information on each story.

Last updated: 2019-04-10

## storytypes

Translation table.

Holds the type each story can be.

Last updated: 2016-10-02

## tags

Holds the name of each tag.

Last updated: 2016-09-23

## typegroups

I think this was my effort to break the scout/event cards into a lookup table? Horrible naming and I need to find the
notes to see what I did.

Last updated: 2019-04-04.

## types

Holds the three different card types. Not sure if this is used?

Last updated: 2016-11-04.

## unitevents

Lookup event for what units partipated in what event.

Last updated: 2019-02-15

## units

Holds the information on each unit.

Last updated: 2020-03-16

## unitskillboys

Classic only.

Ties each idol to a unit to create their unit skills.

Last updated: 2016-11-05

## unitskills

I am not sure if this is used beyond unit skills. There is some random skill information in there.

Last updated: 2016-11-06.