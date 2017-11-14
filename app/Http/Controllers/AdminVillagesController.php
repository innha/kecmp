<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Village;
use App\Cell;
use App\Sector;
use App\District;
use App\Province;
use Session;

class AdminVillagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return 'AdminVillagesController@index';
        $villages = Village::orderByDesc('id')->paginate(15);
        $cells = Cell::pluck('name', 'id')->all();
        $sectors = Sector::pluck('name', 'id')->all();
        $districts = District::pluck('name', 'id')->all();
        $provinces = Province::pluck('name', 'id')->all();        

        return view('admin.param.village.index', compact('villages', 'cells', 'sectors', 'districts', 'provinces'));
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
            'cell_id' => 'required|numeric',
            'code' => 'required|numeric|unique:villages',
            'name' => 'required'
        ]);        

        Village::create($request->all());

        Session::flash('created_village', 'Village created');

        return redirect(route('admin.villages.index'));
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

        $deleted = Village::findOrFail($id)->delete();

        Session::flash('deleted_village', 'Village id ' . $id . ' deleted');
        
        return redirect(route('admin.villages.index'));
    }
}
