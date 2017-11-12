<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repenting;
use App\Registration;
use Auth;
use Session;

class AdminRepentingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return 'AdminRepentingsController@index';
        $repentings = Repenting::paginate(5);

        return view('admin.app.repenting.index', compact('repentings'));      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $registrations = Registration::pluck('regNumber', 'id')->all();
        $regNums = Registration::pluck('regNumber', 'id')->all();

        return view('admin.app.repenting.create', compact('registrations', 'regNums'));
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
            'date_returned' => 'required|date',
            'authRegNum' => 'required|numeric'
        ]);

        $input = $request->all();

        $user = Auth::user();

        $input['user_id'] = $user->id;

        Repenting::create($input);

        Session::flash('created_repenting', 'Repenting added');

        return redirect(route('admin.repentings.index'));        
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
        $deleted = Repenting::findOrFail($id)->delete();

        Session::flash('deleted_repenting', 'Repenting id ' . $id . ' deleted');
        
        return redirect(route('admin.repentings.index'));
    }
}
