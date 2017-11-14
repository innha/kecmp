<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sector;
use App\District;
use App\Province;
use Session;

class AdminSectorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return 'AdminSectorsController@index';
        $sectors = Sector::orderByDesc('id')->paginate(15);
        $districts = District::pluck('name', 'id')->all();
        $provinces = Province::pluck('name', 'id')->all();

        return view('admin.param.sector.index', compact('sectors', 'districts', 'provinces'));     
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
            'district_id' => 'required|numeric',
            'code' => 'required|numeric|unique:sectors',
            'name' => 'required'
        ]);        

        Sector::create($request->all());

        Session::flash('created_sector', 'Sector created');

        return redirect(route('admin.sectors.index'));
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

        $deleted = Sector::findOrFail($id)->delete();

        Session::flash('deleted_sector', 'Sector id ' . $id . ' deleted');
        
        return redirect(route('admin.sectors.index'));
    }
}
