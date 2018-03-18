<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Preaching;
use App\Registration;
use Auth;
use Session;

class AdminPreachingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return 'AdminPreachingsController@index';
        $preachings = Preaching::paginate(5);

        return view('admin.app.preaching.index', compact('preachings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $registrations = Registration::pluck('regNumber', 'id')->all();

        return view('admin.app.preaching.create', compact('registrations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            
            'visitor_names' => 'required|alpha_spaces',
            'topic' => 'required|alpha_spaces',
            'date_preached' => 'required|date',
            'num_repented' => 'required|numeric'
        ]);

        $input = $request->all();

        $user = Auth::user();

        $input['user_id'] = $user->id;

        Preaching::create($input);

        Session::flash('created_preaching', 'Preaching added');

        return redirect(route('admin.preachings.index'));        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = Preaching::findOrFail($id)->delete();

        Session::flash('deleted_preaching', 'Preaching id ' . $id . ' deleted');
        
        return redirect(route('admin.preachings.index'));
    }
}
