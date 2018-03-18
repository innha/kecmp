<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Type;
use Session;

class AdminTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return 'AdminTypesController@index';
        // $types = Type::paginate(5);
        $types = Type::all();

        return view('admin.param.type.index', compact('types'));       
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

            'name' => 'required|alpha_spaces|unique:types'
        ]);        

        return Type::create($request->all());

        // Session::flash('created_type', 'Type created');

        // return redirect(route('admin.types.index'));
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

        Type::whereId($id)->update($request->all());

        return Type::whereId($id)->first();
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

        $deleted = Type::findOrFail($id)->delete();

        // Session::flash('deleted_type', 'Type id ' . $id . ' deleted');
        
        // return redirect(route('admin.types.index'));

        return response()->json(['status' => 'Delete OK', 'Num deleted' => $deleted, 'ID' => $id], 200);
    }
}
