<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Zone;
use App\Chapelle;
use Session;
use DB;

class AdminZonesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return 'AdminZonesController@index';
        // $zones = Zone::paginate(5);
        // $chapelles = Chapelle::pluck('name', 'id')->all();

        $zones = DB::table('zones')
                        ->join('chapelles as s', 'zones.chapelle_id', '=', 's.id')
                        ->join('parishes as d', 's.parish_id', '=', 'd.id')
                        ->join('dioceses as p', 'd.diocese_id', '=', 'p.id')
                        ->select('zones.*', 's.name as chapelle', 'd.name as parish', 'p.name as diocese')
                        ->get();        

        // return view('admin.param.zone.index', compact('zones', 'chapelles'));
        return view('admin.param.zone.index', compact('zones'));
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
            'chapelle_id' => 'required|numeric',
            'code' => 'required|numeric',
            'name' => 'required'
        ]);        

        // Zone::create($request->all());

        $id = DB::table('zones')->insertGetId(

            ['chapelle_id' => $request->chapelle_id, 'code' => $request->code, 'name' => $request->name]

        );

        $zone = DB::table('zones')
                        ->where('zones.id', $id)
                        ->join('chapelles as s', 'zones.chapelle_id', '=', 's.id')
                        ->join('parishes as d', 's.parish_id', '=', 'd.id')
                        ->join('dioceses as p', 'd.diocese_id', '=', 'p.id')
                        ->select('zones.*', 's.name as chapelle', 'd.name as parish', 'p.name as diocese')
                        ->get();

        return json_decode($zone);

        // Session::flash('created_zone', 'Zone created');

        // return redirect(route('admin.zones.index'));
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
            'chapelle_id' => 'required|numeric',
            'code' => 'required|numeric',
            'name' => 'required'
        ]);

        Zone::whereId($id)->update($request->all());

        $zone = DB::table('zones')
                        ->where('zones.id', $id)
                        ->join('chapelles as s', 'zones.chapelle_id', '=', 's.id')
                        ->join('parishes as d', 's.parish_id', '=', 'd.id')
                        ->join('dioceses as p', 'd.diocese_id', '=', 'p.id')
                        ->select('zones.*', 's.name as chapelle', 'd.name as parish', 'p.name as diocese')
                        ->get();

        return json_decode($zone);
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

        $deleted = Zone::findOrFail($id)->delete();

        // Session::flash('deleted_zone', 'Zone id ' . $id . ' deleted');
        
        // return redirect(route('admin.zones.index'));

        return response()->json(['status' => 'Delete OK', 'Num deleted' => $deleted, 'ID' => $id], 200);
    }

    public function list()
    {
        $zones = Zone::pluck('name', 'id')->all();

        return $zones;        
    }    
}
