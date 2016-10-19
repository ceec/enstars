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


class BlogController extends Controller {

    /**
     * Show specific blog
     *
     * @return \Illuminate\Http\Response
     */
    public function blog($url) {
        $blog = Blog::where('url','=',$url)->first();
        $boys = Boy::where('class','!=','')->orderBy('first_name','asc')->get();
        $teachers = Boy::where('class','=','')->orderBy('first_name','asc')->get();

        return view('pages.blog')
        ->with('blog',$blog)
        ->with('boys',$boys)
        ->with('teachers',$teachers);
    } 



}
