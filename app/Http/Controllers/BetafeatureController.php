<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Card;
use App\Boy;
use App\Skill;
use App\Minievent;
use App\Minieventchoice;
use App\Event;

use App\Cardtag;
use App\Tag;
use App\Unit;

use App\Story;
use App\Chapter;
use App\Slide;

use App\Blog;

use Auth;
use DB;

class BetafeatureController extends Controller
{


    /**
     * Memory game
     *
     * @return \Illuminate\Http\Response
     */
    public function memoryGame($language = '')
    {

        $pictures = Boy::where('school_id', '=', 1)->pluck('id')->toArray();

        if ($language == 'japanese') {
            $boys = Boy::where('school_id', '=', 1)->pluck('japanese_name')->toArray();
            $rawanswers = Boy::where('school_id', '=', 1)->pluck('japanese_name', 'id');
        } else {
            $boys = Boy::where('school_id', '=', 1)->pluck('english_name')->toArray();
            $rawanswers = Boy::where('school_id', '=', 1)->pluck('english_name', 'id');
        }


        foreach ($rawanswers as $key => $answer) {
            $answers[] = $key . str_replace(' ', '-', $answer);
        }

        //of course doesnt return a new array
        shuffle($boys);
        shuffle($pictures);

        //randomize the arrays

        return view('pages.memory')
            ->with('answers', $answers)
            ->with('pictures', $pictures)
            ->with('boys', $boys);
    }
}
