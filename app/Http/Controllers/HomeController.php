<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Baptism;
use App\Bridal;
use App\Burial;
use App\Choir;
use App\Kid;
use App\Literacy;
use App\Marriage;
use App\Preaching;
use App\Reception;
use App\Recommendation;
use App\Registration;
use App\Repenting;
use App\Suspension;
use App\Teaching;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $dashboard = [

            'baptisms' => Baptism::count(),
            'bridals' => Bridal::count(),
            'burials' => Burial::count(),
            'choirs' => Choir::count(),
            'kids' => Kid::count(),
            'literacies' => Literacy::count(),
            'marriages' => Marriage::count(),
            'preachings' => Preaching::count(),
            'receptions' => Reception::count(),
            'recommendations' => Recommendation::count(),
            'registrations' => Registration::count(),
            'repentings' => Repenting::count(),
            'suspensions' => Suspension::count(),
            'teachings' => Teaching::count()
        ];

        return view('home', compact('dashboard'));
    }
}
