<?php

namespace App\Http\Controllers;

use App\HomePage;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){

        $rolling = HomePage::where([['type','=','滚动'],['display','=','1']])->get();
        $property = HomePage::where([['type','=','property'],['display','=','1']])->get();
        $travel = HomePage::where([['type','=','travel'],['display','=','1']])->get();
        $education = HomePage::where([['type','=','education'],['display','=','1']])->get();
        $media = HomePage::where([['type','=','media'],['display','=','1']])->get();


    	return view('Home.index')
                ->with('rolling', $rolling)
                ->with('property',$property)
                ->with('travel',$travel)
                ->with('education',$education)
                ->with('media', $media);
    }

    public function about(){
      return View('About.us');
    }
}
