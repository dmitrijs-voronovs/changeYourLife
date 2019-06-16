<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    
    public function language(){
        return view('language');
    }

    public function postLanguage($locale){
        App::setLocale($locale);
        session()->put('locale',$locale);
        return redirect()->route('index');
    }
}
