<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Diocese;
use Session;

class AdminDiocesesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return 'AdminDiocesesController@index';
        // $dioceses = Diocese::paginate(5);
        $dioceses = Diocese::all();

        return view('admin.param.diocese.index', compact('dioceses'));
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
            'name' => 'required|alpha_spaces|unique:dioceses'
        ]);        

        return Diocese::create($request->all());

        // Session::flash('created_diocese', 'Diocese created');

        // return redirect(route('admin.dioceses.index'));        
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

            'name' => 'required|alpha_spaces'            
        ]);

        Diocese::whereId($id)->update($request->all());

        return Diocese::whereId($id)->first();
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

        $deleted = Diocese::findOrFail($id)->delete();

        // Session::flash('deleted_diocese', 'Diocese id ' . $id . ' deleted');
        
        // return redirect(route('admin.dioceses.index'));

        return response()->json(['status' => 'Delete OK', 'Num deleted' => $deleted, 'ID' => $id], 200);
    }

    public function list()
    {
        $dioceses = Diocese::pluck('name', 'id')->all();

        return $dioceses;        
    }    
}
