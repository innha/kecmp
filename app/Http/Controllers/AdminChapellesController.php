<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Chapelle;
use App\Parish;
use Session;

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
        $chapelles = Chapelle::paginate(5);
        $parishes = Parish::pluck('name', 'id')->all();

        return view('admin.param.chapelle.index', compact('chapelles', 'parishes'));
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
            'name' => 'required|alpha'
        ]);        

        Chapelle::create($request->all());

        Session::flash('created_chapelle', 'Chapelle created');

        return redirect(route('admin.chapelles.index'));        
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
        //
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

        Session::flash('deleted_chapelle', 'Chapelle id ' . $id . ' deleted');
        
        return redirect(route('admin.chapelles.index'));
    }
}
