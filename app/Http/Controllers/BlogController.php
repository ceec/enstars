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

class BlogController extends Controller
{


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Add card  UI
     *
     * @return \Illuminate\Http\Response
     */
    public function addDisplay()
    {


        return view('home.blogAdd');
    }

    /**
     * Add blog post
     *
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {

        $this->validate($request, [
            'title' => 'required',
            'url' => 'required|unique:blogs|max:255',
        ]);

        $b = new Blog;
        $b->active = 0;
        $b->type = 'news';
        $b->keywords = '';
        $b->title = $request->input('title');
        $b->blurb = $request->input('blurb');
        $b->story_id = $request->input('story_id');
        $b->chapter_id = $request->input('chapter_id');
        $b->content = $request->input('content');
        $b->image = $request->input('image');
        $b->url = $request->input('url');
        $b->updated_by = $request->input('updated_by');
        $b->save();


        return redirect('/home');
    }


    /**
     * List blog posts for eiting
     *
     * @return \Illuminate\Http\Response
     */
    public function listDisplay()
    {
        $blogs = Blog::orderBy('created_at', 'DESC')->get();

        return view('home.blogList')
            ->with('blogs', $blogs);
    }

    /**
     * UI for eding
     *
     * @return \Illuminate\Http\Response
     */
    public function editDisplay($blog_id)
    {
        $blog = Blog::find($blog_id);

        return view('home.blogEdit')
            ->with('blog', $blog);
    }


    /**
     * Edit blog post
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $blog_id = $request->input('blog_id');

        $up = Blog::find($blog_id);
        $up->active = $request->input('active');
        $up->title = $request->input('title');
        $up->blurb = $request->input('blurb');
        $up->content = $request->input('content');
        $up->image = $request->input('image');
        $up->url = $request->input('url');
        $up->updated_by = $request->input('updated_by');
        $up->save();


        return redirect('/home');
    }


}
