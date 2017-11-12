<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Singer;
use App\Registration;
use App\Choir;
use Auth;
use Session;

class AdminSingersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return 'AdminSingersController@index';
        $singers = Singer::paginate(5);

        return view('admin.app.singer.index', compact('singers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $registrations = Registration::pluck('regnumber', 'id')->all();
        $choirs = Choir::pluck('name', 'id')->all();

        return view('admin.app.singer.create', compact('registrations', 'choirs'));
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
            'choir_id' => 'required|numeric',
            'role' => 'required|alpha_spaces'
        ]);

        $input = $request->all();

        $user = Auth::user();

        $input['user_id'] = $user->id;

        Singer::create($input);

        Session::flash('created_singer', 'Singer added');

        return redirect(route('admin.singers.index'));        
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
        $deleted = Singer::findOrFail($id)->delete();

        Session::flash('deleted_singer', 'Singer id ' . $id . ' deleted');
        
        return redirect(route('admin.singers.index'));
    }
}
