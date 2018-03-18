<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Village;
use App\Cell;
use App\Sector;
use App\District;
use App\Province;
use Session;
use DB;

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
        // $villages = Village::orderByDesc('id')->paginate(15);
        // $cells = Cell::pluck('name', 'id')->all();
        // $sectors = Sector::pluck('name', 'id')->all();
        // $districts = District::pluck('name', 'id')->all();
        // $provinces = Province::pluck('name', 'id')->all();        

        $villages = DB::table('villages')
                        ->join('cells as c', 'villages.cell_id', '=', 'c.id')
                        ->join('sectors as s', 'c.sector_id', '=', 's.id')
                        ->join('districts as d', 's.district_id', '=', 'd.id')
                        ->join('provinces as p', 'd.province_id', '=', 'p.id')
                        ->select('villages.*', 'c.name as cell', 's.name as sector', 'd.name as district', 'p.name as province')
                        ->get();        

        // return view('admin.param.village.index', compact('villages', 'cells', 'sectors', 'districts', 'provinces'));
        return view('admin.param.village.index', compact('villages'));
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

        // Village::create($request->all());

        $id = DB::table('villages')->insertGetId(

            ['cell_id' => $request->cell_id, 'code' => $request->code, 'name' => $request->name]

        );

        $village = DB::table('villages')
                        ->where('villages.id', $id)
                        ->join('cells as c', 'villages.cell_id', '=', 'c.id')
                        ->join('sectors as s', 'c.sector_id', '=', 's.id')
                        ->join('districts as d', 's.district_id', '=', 'd.id')
                        ->join('provinces as p', 'd.province_id', '=', 'p.id')
                        ->select('villages.*', 'c.name as cell', 's.name as sector', 'd.name as district', 'p.name as province')
                        ->get();

        return json_decode($village);        

        // Session::flash('created_village', 'Village created');

        // return redirect(route('admin.villages.index'));
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
        $this->validate($request, [
            'cell_id' => 'required|numeric',
            'code' => 'required|numeric',
            'name' => 'required|alpha_spaces'
        ]);

        Village::whereId($id)->update($request->all());

        $village = DB::table('villages')
                        ->where('villages.id', $id)
                        ->join('cells as c', 'villages.cell_id', '=', 'c.id')
                        ->join('sectors as s', 'c.sector_id', '=', 's.id')
                        ->join('districts as d', 's.district_id', '=', 'd.id')
                        ->join('provinces as p', 'd.province_id', '=', 'p.id')
                        ->select('villages.*', 'c.name as cell', 's.name as sector', 'd.name as district', 'p.name as province')
                        ->get();

        return json_decode($village);
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

        // Session::flash('deleted_village', 'Village id ' . $id . ' deleted');
        
        // return redirect(route('admin.villages.index'));

        return response()->json(['status' => 'Delete OK', 'Num deleted' => $deleted, 'ID' => $id], 200);
    }

    public function list()
    {
        $villages = Village::pluck('name', 'id')->all();

        return $villages;
    }    
}
