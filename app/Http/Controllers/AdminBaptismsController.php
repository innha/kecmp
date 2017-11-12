<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Baptism;
use App\Registration;
use Auth;
use Session;

class AdminBaptismsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return 'AdminBaptismsController@index';

        $baptisms = Baptism::paginate(5);

        return view('admin.app.baptism.index', compact('baptisms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $registrations = Registration::pluck('regnumber', 'id')->all();

        return view('admin.app.baptism.create', compact('registrations'));
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
            'date_baptized' => 'required|date'
        ]);

        $input = $request->all();

        $user = Auth::user();

        $input['user_id'] = $user->id;

        Baptism::create($input);

        Session::flash('created_baptism', 'Baptism added');

        return redirect(route('admin.baptisms.index'));
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
        $deleted = Baptism::findOrFail($id)->delete();

        Session::flash('deleted_baptism', 'Baptism id ' . $id . ' deleted');
        
        return redirect(route('admin.baptisms.index'));
    }
}
