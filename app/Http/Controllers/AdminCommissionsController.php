<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Commission;
use Session;
use DB;

class AdminCommissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return 'AdminCommissionsController@index';
        // $commissions = Commission::paginate(5);
        // $commissions = Commission::all();
        $commissions = DB::table('commissions')
                        ->join('chapelles', 'commissions.chapelle_id', '=', 'chapelles.id')
                        ->select('commissions.*', 'chapelles.name as chapelle')
                        ->get();        

        return view('admin.param.commission.index', compact('commissions'));
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
            'name' => 'required|alpha_spaces|unique:commissions'
        ]);

        // return Commission::create($request->all());

        $id = DB::table('commissions')->insertGetId(

            ['chapelle_id' => $request->chapelle_id, 'name' => $request->name]

        );

        $commission = DB::table('commissions')
                        ->where('commissions.id', $id)
                        ->join('chapelles', 'commissions.chapelle_id', '=', 'chapelles.id')
                        ->select('commissions.*', 'chapelles.name as chapelle')
                        ->get();

        return json_decode($commission);

        // Session::flash('created_commission', 'Commission created');

        // return redirect(route('admin.commissions.index'));
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

        Commission::whereId($id)->update($request->all());

        $commission = DB::table('commissions')
                        ->where('commissions.id', $id)
                        ->join('chapelles', 'commissions.province_id', '=', 'chapelles.id')
                        ->select('commissions.*', 'chapelles.name as chapelle')
                        ->get();        

        return json_decode($commission);

        // return Commission::whereId($id)->first();
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

        $deleted = Commission::findOrFail($id)->delete();

        // Session::flash('deleted_commission', 'Commission id ' . $id . ' deleted');
        
        // return redirect(route('admin.commissions.index'));

        return response()->json(['status' => 'Delete OK', 'Num deleted' => $deleted, 'ID' => $id], 200);
    }
}
