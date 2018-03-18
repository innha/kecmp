<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Choir;
use Session;

class AdminChoirsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return 'AdminChoirsController@index';
        // $choirs = Choir::paginate(5);
        // $choirs = Choir::all();
        $choirs = DB::table('choirs')
                        ->join('chapelles', 'choirs.chapelle_id', '=', 'chapelles.id')
                        ->select('choirs.*', 'chapelles.name as chapelle')
                        ->get();

        return view('admin.param.choir.index', compact('choirs'));
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
            'name' => 'required|alpha_spaces|unique:choirs',
            'equipment' => 'required'
        ]);

        $id = DB::table('choirs')->insertGetId(

            ['chapelle_id' => $request->chapelle_id, 'name' => $request->name]

        );

        $choir = DB::table('choirs')
                        ->where('choirs.id', $id)
                        ->join('chapelles', 'choirs.chapelle_id', '=', 'chapelles.id')
                        ->select('choirs.*', 'chapelles.name as chapelle')
                        ->get();

        return json_decode($commission);        

        // return Choir::create($request->all());

        // Session::flash('created_choir', 'Choir created');

        // return redirect(route('admin.choirs.index'));
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
            'name' => 'required|alpha_spaces'            
        ]);

        Choir::whereId($id)->update($request->all());

        $choir = DB::table('choirs')
                        ->where('choirs.id', $id)
                        ->join('chapelles', 'choirs.province_id', '=', 'chapelles.id')
                        ->select('choirs.*', 'chapelles.name as chapelle')
                        ->get();        

        return json_decode($choir);

        // return Choir::whereId($id)->first();
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

        $deleted = Choir::findOrFail($id)->delete();

        // Session::flash('deleted_choir', 'Choir id ' . $id . ' deleted');

        // return redirect(route('admin.choirs.index'));

        return response()->json(['status' => 'Delete OK', 'Num deleted' => $deleted, 'ID' => $id], 200);

    }
}
