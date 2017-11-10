<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cell;
use App\Sector;
use Session;

class AdminCellsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->validate($request, [
            'sector_id' => 'required|numeric',
            'code' => 'required|numeric',
            'name' => 'required|alpha'
        ]);

        // return 'AdminCellsController@index';
        $cells = Cell::paginate(5);
        $sectors = Sector::pluck('name', 'id')->all();

        return view('admin.param.cell.index', compact('cells', 'sectors'));
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

        Cell::create($request->all());

        Session::flash('created_cell', 'Cell created');

        return redirect(route('admin.cells.index'));
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

        $deleted = Cell::findOrFail($id)->delete();

        Session::flash('deleted_cell', 'Cell id ' . $id . ' deleted');
        
        return redirect(route('admin.cells.index'));
    }
}
