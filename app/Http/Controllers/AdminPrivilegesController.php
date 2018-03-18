<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Privilege;
use Session;

class AdminPrivilegesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return 'AdminPrivilegesController@index';
        // $privileges = Privilege::paginate(5);
        $privileges = Privilege::all();

        return view('admin.param.privilege.index', compact('privileges'));
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
            'name' => 'required|alpha_spaces|unique:privileges'
        ]);

        return Privilege::create($request->all());

        // Session::flash('created_privilege', 'Privilege created');

        // return redirect(route('admin.privileges.index'));

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

        Privilege::whereId($id)->update($request->all());

        return Privilege::whereId($id)->first();
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

        $deleted = Privilege::findOrFail($id)->delete();

        // Session::flash('deleted_privilege', 'Privilege id ' . $id . ' deleted');
        
        // return redirect(route('admin.privileges.index'));

        return response()->json(['status' => 'Delete OK', 'Num deleted' => $deleted, 'ID' => $id], 200);
    }
}
