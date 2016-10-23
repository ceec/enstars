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




    /**
     * Add card  UI
     *
     * @return \Illuminate\Http\Response
     */
    public function addDisplay() {


            return view('home.blogAdd');
    } 

    /**
     * Add blog post 
     *
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request) {

        $b = new Blog;
        $b->active = 0;
        $b->type = 'news';
        $b->keywords = '';
        $b->title = $request->input('title');
        $b->blurb = $request->input('blurb');
        $b->content = $request->input('content');
        $b->image = $request->input('image');
        $b->url = $request->input('url');
        $b->updated_by = Auth::id();  
        $b->save();


        return redirect('/home');          
    } 


    /**
     * List blog posts for eiting
     *
     * @return \Illuminate\Http\Response
     */
    public function listDisplay() {
            $blogs = Blog::all();

            return view('home.blogList')
            ->with('blogs',$blogs);
    } 

    /**
     * UI for eding
     *
     * @return \Illuminate\Http\Response
     */
    public function editDisplay($blog_id) {
            $blog = Blog::find($blog_id);

            return view('home.blogEdit')
            ->with('blog',$blog);
    } 


    /**
     * Edit blog post 
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request) {
        $blog_id = $request->input('blog_id');

        $up = Blog::find($blog_id);
        $up->active = $request->input('active');
        $up->title = $request->input('title');
        $up->blurb = $request->input('blurb');
        $up->content = $request->input('content');
        $up->image = $request->input('image');
        $up->url = $request->input('url');
        $up->updated_by = Auth::id();  
        $up->save();


        return redirect('/home');          
    } 


}
