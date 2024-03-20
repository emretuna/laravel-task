<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Event;
class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // get all events from event model and push to home view
        $events = Event::all();
        return view('home', compact('events'));

    }
}
