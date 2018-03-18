<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\District;
use App\Province;
use Session;
use DB;

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
        // $districts = District::orderByDesc('id')->paginate(15);
        // $provinces = Province::pluck('name', 'id')->all();

        $districts = DB::table('districts')
                        ->join('provinces', 'districts.province_id', '=', 'provinces.id')
                        ->select('districts.*', 'provinces.name as province')
                        ->get();

        return view('admin.param.district.index', compact('districts'));
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
            'code' => 'required|numeric|unique:districts',
            'name' => 'required|alpha_spaces|unique:districts'
        ]);

        // $id = District::create($request->all());

        $id = DB::table('districts')->insertGetId(

            ['province_id' => $request->province_id, 'code' => $request->code, 'name' => $request->name]

        );

        $district = DB::table('districts')
                        ->where('districts.id', $id)
                        ->join('provinces', 'districts.province_id', '=', 'provinces.id')
                        ->select('districts.id', 'districts.code', 'districts.name', 'provinces.name as province')
                        ->get();

        return json_decode($district);

        // Session::flash('created_district', 'District created');

        // return redirect(route('admin.districts.index'));        
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
            'province_id' => 'required|numeric',
            'code' => 'required|numeric',
            'name' => 'required|alpha_spaces'
        ]);

        District::whereId($id)->update($request->all());

        $district = DB::table('districts')
                        ->where('districts.id', $id)
                        ->join('provinces', 'districts.province_id', '=', 'provinces.id')
                        ->select('districts.id', 'districts.code', 'districts.name', 'provinces.name as province')
                        ->get();        

        return json_decode($district);
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

        // Session::flash('deleted_district', 'District id ' . $id . ' deleted');
        
        // return redirect(route('admin.districts.index'));

        return response()->json(['status' => 'Delete OK', 'Num deleted' => $deleted, 'ID' => $id], 200);
    }

    public function list()
    {
        $districts = District::pluck('name', 'id')->all();

        return $districts;        
    }
}
