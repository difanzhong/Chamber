<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blog;

class BlogController extends Controller
{
    public function index(){
    	$blogs = Blog::where('display', 1)->orderby('updated_at','desc')->get();

    	return View('Blog.list', compact('blogs'));
    }

    public function blog($id){
    	// get specific blog by id
        	$blog = Blog::find($id);
            //echo $blog;
    	// if (!$blog->diplay){
    	// 	abort(404, 'not found');
    	// }
    	// else{
    		return View('Blog.blog', compact('blog'));


    }
}
