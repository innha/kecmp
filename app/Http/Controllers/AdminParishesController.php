<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Parish;
use App\Diocese;
use Session;

class AdminParishesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return 'AdminParishesController@index';
        $parishes = Parish::paginate(5);
        $dioceses = Diocese::pluck('name', 'id')->all();

        return view('admin.param.parish.index', compact('parishes', 'dioceses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'diocese_id' => 'required|numeric',
            'name' => 'required|alpha_spaces|unique:parishes'
        ]);        

        Parish::create($request->all());

        Session::flash('created_parish', 'Parish created');

        return redirect(route('admin.parishes.index'));
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
        // dd($id);

        $deleted = Parish::findOrFail($id)->delete();

        Session::flash('deleted_parish', 'Parish id ' . $id . ' deleted');
        
        return redirect(route('admin.parishes.index'));
    }
}
