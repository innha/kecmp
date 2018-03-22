<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Parish;
use App\Diocese;
use Session;
use DB;

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
        // $parishes = Parish::paginate(5);
        // $dioceses = Diocese::pluck('name', 'id')->all();

        $parishes = DB::table('parishes')
                        ->join('dioceses', 'parishes.diocese_id', '=', 'dioceses.id')
                        ->join('districts', 'parishes.district_id', '=', 'districts.id')
                        // ->select('parishes.*', 'dioceses.name as diocese')
                        ->select('parishes.*', 'districts.name as district', 'dioceses.name as diocese')
                        // ->select('parishes.*', 'districts.name as district')
                        ->get();                

        return view('admin.param.parish.index', compact('parishes'));
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
            'district_id' => 'required|numeric',
            'code' => 'required|numeric|unique:parishes',
            'name' => 'required|alpha_spaces|unique:parishes'
        ]);        

        // Parish::create($request->all());

        $id = DB::table('parishes')->insertGetId(

            ['diocese_id' => $request->diocese_id, 'district_id' => $request->district_id, 'code' => $request->code, 'name' => $request->name]

        );

        $parish = DB::table('parishes')
                        ->where('parishes.id', $id)
                        ->join('districts', 'parishes.district_id', '=', 'districts.id')
                        ->join('dioceses', 'parishes.diocese_id', '=', 'dioceses.id')
                        ->select('parishes.*', 'districts.name as district', 'dioceses.name as diocese')
                        ->get();

        return json_decode($parish);

        // Session::flash('created_parish', 'Parish created');

        // return redirect(route('admin.parishes.index'));
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
            'diocese_id' => 'required|numeric',
            'district_id' => 'required|numeric',
            'code' => 'required|numeric',
            'name' => 'required|alpha_spaces'
        ]);

        Parish::whereId($id)->update($request->all());

        $parish = DB::table('parishes')
                        ->where('parishes.id', $id)
                        ->join('districts', 'parishes.district_id', '=', 'districts.id')
                        ->join('dioceses', 'parishes.diocese_id', '=', 'dioceses.id')
                        ->select('parishes.*', 'districts.name as district', 'dioceses.name as diocese')
                        ->get();        

        return json_decode($parish);
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

        // Session::flash('deleted_parish', 'Parish id ' . $id . ' deleted');
        
        // return redirect(route('admin.parishes.index'));

        return response()->json(['status' => 'Delete OK', 'Num deleted' => $deleted, 'ID' => $id], 200);
    }

    public function list()
    {
        $parishes = Parish::pluck('name', 'id')->all();

        return $parishes;
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

        $parishes = Parish::where('name', 'LIKE', '%' . $q . '%')->get();

        // $registrations = Type::where('name', 'LIKE', '%' . $q . '%')->get();

        $data = array();

        foreach ($parishes as $parish) {
            $data[] = array('label' => $parish->name, 'value' => $parish->name, 'id' => $parish->name);
        }

        if(count($data)) {

            return $data;

        } else {

            return ['value' => 'No parishes found', 'id' => ''];
        }
    }
}
