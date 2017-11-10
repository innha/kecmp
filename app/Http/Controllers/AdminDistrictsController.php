<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\District;
use App\Province;
use Session;

class AdminDistrictsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return 'AdminDistrictsController@index';
        $districts = District::paginate(5);
        $provinces = Province::pluck('name', 'id')->all();

        return view('admin.param.district.index', compact('districts', 'provinces'));
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
            'province_id' => 'required|numeric',
            'code' => 'required|numeric',
            'name' => 'required|alpha'
        ]);        

        District::create($request->all());

        Session::flash('created_district', 'District created');

        return redirect(route('admin.districts.index'));        
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

        $deleted = District::findOrFail($id)->delete();

        Session::flash('deleted_district', 'District id ' . $id . ' deleted');
        
        return redirect(route('admin.districts.index'));
    }
}