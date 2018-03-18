<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bridal;
use App\Registration;
use Auth;
use Session;

class AdminBridalsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return 'AdminBridalsController@index';
        $bridals = Bridal::paginate(5);

        return view('admin.app.bridal.index', compact('bridals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $registrations = Registration::pluck('regnumber', 'id')->all();

        return view('admin.app.bridal.create', compact('registrations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $this->validate($request, [
            
            'm_bridal_id' => 'required|numeric',
            'f_bridal_id' => 'required|numeric',
            'origin' => 'required'
        ]);

        $input = $request->all();

        $user = Auth::user();

        // dd($user);

        $input['user_id'] = $user->id;

        // dd($input);

        Bridal::create($input);

        Session::flash('created_bridal', 'Bridal added');

        return redirect(route('admin.bridals.index'));        
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
        $deleted = Bridal::findOrFail($id)->delete();

        Session::flash('deleted_bridal', 'Bridal id ' . $id . ' deleted');
        
        return redirect(route('admin.bridals.index'));
    }
}
