<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Chapelle;
use App\Parish;
use Session;
use DB;

class AdminChapellesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return 'AdminChapellesController@index';
        // $chapelles = Chapelle::paginate(5);
        // $parishes = Parish::pluck('name', 'id')->all();

        $chapelles = DB::table('chapelles')
                        ->join('parishes', 'chapelles.parish_id', '=', 'parishes.id')
                        ->join('dioceses', 'parishes.diocese_id', '=', 'dioceses.id')
                        ->select('chapelles.*', 'parishes.name as parish', 'dioceses.name as diocese')
                        ->get();

        // return view('admin.param.chapelle.index', compact('chapelles', 'parishes'));
        return view('admin.param.chapelle.index', compact('chapelles'));
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
            'parish_id' => 'required|numeric',
            'name' => 'required|alpha_spaces|unique:chapelles'
        ]);        

        // Chapelle::create($request->all());

        $id = DB::table('chapelles')->insertGetId(

            ['parish_id' => $request->parish_id, 'code' => $request->code, 'name' => $request->name]

        );

        $chapelle = DB::table('chapelles')
                        ->where('chapelles.id', $id)
                        ->join('parishes', 'chapelles.parish_id', '=', 'parishes.id')
                        ->join('dioceses', 'parishes.diocese_id', '=', 'dioceses.id')
                        ->select('chapelles.*', 'parishes.name as parish', 'dioceses.name as diocese')
                        ->get();

        return json_decode($chapelle);        

        // Session::flash('created_chapelle', 'Chapelle created');

        // return redirect(route('admin.chapelles.index'));        
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
            'parish_id' => 'required|numeric',
            'name' => 'required|alpha_spaces'
        ]);

        Chapelle::whereId($id)->update($request->all());

        $chapelle = DB::table('chapelles')
                        ->where('chapelles.id', $id)
                        ->join('parishes', 'chapelles.parish_id', '=', 'parishes.id')
                        ->join('dioceses', 'parishes.diocese_id', '=', 'dioceses.id')
                        ->select('chapelles.*', 'parishes.name as parish', 'dioceses.name as diocese')
                        ->get();

        return json_decode($chapelle);
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

        $deleted = Chapelle::findOrFail($id)->delete();

        // Session::flash('deleted_chapelle', 'Chapelle id ' . $id . ' deleted');
        
        // return redirect(route('admin.chapelles.index'));

        return response()->json(['status' => 'Delete OK', 'Num deleted' => $deleted, 'ID' => $id], 200);
    }

    public function list()
    {
        $chapelles = Chapelle::pluck('name', 'id')->all();

        return $chapelles;        
    }    
}
