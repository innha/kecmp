<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reception;
use App\Registration;
use App\Cell;
use App\Parish;
use Auth;
use Session;

class AdminReceptionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return 'AdminReceptionsController@index';
        $receptions = Reception::paginate(5);

        return view('admin.app.reception.index', compact('receptions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $registrations = Registration::pluck('regnumber', 'id')->all();
        $cells = Cell::pluck('name', 'id')->all();
        $parishes = Parish::pluck('name', 'id')->all();

        return view('admin.app.reception.create', compact('registrations', 'cells', 'parishes'));
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
            'cell_id' => 'required|numeric',
            'parish_id' => 'required|numeric'
        ]);

        $input = $request->all();

        $user = Auth::user();

        $input['user_id'] = $user->id;

        Reception::create($input);

        Session::flash('created_reception', 'Reception added');

        return redirect(route('admin.receptions.index'));        
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
        $deleted = Reception::findOrFail($id)->delete();

        Session::flash('deleted_reception', 'Reception id ' . $id . ' deleted');
        
        return redirect(route('admin.receptions.index'));
    }
}
