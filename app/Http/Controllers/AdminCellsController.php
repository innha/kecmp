<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cell;
use App\Sector;
use App\District;
use App\Province;
use Session;
use DB;

class AdminCellsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return 'AdminCellsController@index';
        // $cells = Cell::orderByDesc('id')->paginate(15);
        // $sectors = Sector::pluck('name', 'id')->all();
        // $districts = District::pluck('name', 'id')->all();
        // $provinces = Province::pluck('name', 'id')->all();

        $cells = DB::table('cells')
                        ->join('sectors as s', 'cells.sector_id', '=', 's.id')
                        ->join('districts as d', 's.district_id', '=', 'd.id')
                        ->join('provinces as p', 'd.province_id', '=', 'p.id')
                        ->select('cells.*', 's.name as sector', 'd.name as district', 'p.name as province')
                        ->get();        

        // return view('admin.param.cell.index', compact('cells', 'sectors', 'districts', 'provinces'));
        return view('admin.param.cell.index', compact('cells'));
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
            'sector_id' => 'required|numeric',
            'code' => 'required|numeric|unique:cells',
            'name' => 'required|alpha_spaces|unique:cells'
        ]);        

        // Cell::create($request->all());

        $id = DB::table('cells')->insertGetId(

            ['sector_id' => $request->sector_id, 'code' => $request->code, 'name' => $request->name]

        );

        $cell = DB::table('cells')
                        ->where('cells.id', $id)
                        ->join('sectors as s', 'cells.sector_id', '=', 's.id')
                        ->join('districts as d', 's.district_id', '=', 'd.id')
                        ->join('provinces as p', 'd.province_id', '=', 'p.id')
                        ->select('cells.*', 's.name as sector', 'd.name as district', 'p.name as province')
                        ->get();

        return json_decode($cell);

        // Session::flash('created_cell', 'Cell created');

        // return redirect(route('admin.cells.index'));
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
            'sector_id' => 'required|numeric',
            'code' => 'required|numeric',
            'name' => 'required|alpha_spaces'
        ]);

        Cell::whereId($id)->update($request->all());

        $cell = DB::table('cells')
                        ->where('cells.id', $id)
                        ->join('sectors as s', 'cells.sector_id', '=', 's.id')
                        ->join('districts as d', 's.district_id', '=', 'd.id')
                        ->join('provinces as p', 'd.province_id', '=', 'p.id')
                        ->select('cells.*', 's.name as sector', 'd.name as district', 'p.name as province')
                        ->get();

        return json_decode($cell);
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

        $deleted = Cell::findOrFail($id)->delete();

        // Session::flash('deleted_cell', 'Cell id ' . $id . ' deleted');
        
        // return redirect(route('admin.cells.index'));

        return response()->json(['status' => 'Delete OK', 'Num deleted' => $deleted, 'ID' => $id], 200);
    }

    public function list()
    {
        $cells = Cell::pluck('name', 'id')->all();

        return $cells;
    }

    /**
     * Autocomplete search registration
     *
     * @return void
     **/
    public function searchAjax(Request $request)
    {
        // dd($request);

        // $q = $request->get('query', '');
        $q = $request->get('term', '');

        $cells = Cell::where('name', 'LIKE', '%' . $q . '%')->get();

        // $registrations = Type::where('name', 'LIKE', '%' . $q . '%')->get();

        $data = array();

        foreach ($cells as $cell) {
            $data[] = array('label' => $cell->name, 'value' => $cell->name, 'id' => $cell->name);
        }

        if(count($data)) {

            return $data;

        } else {

            return ['value' => 'No cells found', 'id' => ''];
        }
    }    
}
