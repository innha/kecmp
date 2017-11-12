<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Marriage;
use App\Registration;
use Auth;
use Session;

class AdminMarriagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return 'AdminMarriagesController@index';
        $marriages = Marriage::paginate(5);

        return view('admin.app.marriage.index', compact('marriages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $registrations = Registration::pluck('regnumber', 'id')->all();

        return view('admin.app.marriage.create', compact('registrations'));
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
            
            'registration_id' => 'required|numeric',
            'date_married' => 'required|date',
            'marriagePlace' => 'required|alpha_spaces'
        ]);

        $input = $request->all();

        $user = Auth::user();

        $input['user_id'] = $user->id;

        Marriage::create($input);

        Session::flash('created_marriage', 'Marriage added');

        return redirect(route('admin.marriages.index'));        
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
        $deleted = Marriage::findOrFail($id)->delete();

        Session::flash('deleted_marriage', 'Marriage id ' . $id . ' deleted');
        
        return redirect(route('admin.marriages.index'));
    }
}
