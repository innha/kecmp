<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Literacy;
use App\Registration;
use Auth;
use Session;

class AdminLiteraciesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return 'AdminLiteraciesController@index';
        $literacies = Literacy::paginate(5);

        return view('admin.app.literacy.index', compact('literacies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $registrations = Registration::pluck('regnumber', 'id')->all();

        return view('admin.app.literacy.create', compact('registrations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            
            'registration_id' => 'required|numeric',
            'period' => 'required|alpha_spaces'
        ]);

        $input = $request->all();

        $user = Auth::user();

        $input['user_id'] = $user->id;

        Literacy::create($input);

        Session::flash('created_literacy', 'Literacy added');

        return redirect(route('admin.literacies.index'));        
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
        $deleted = Literacy::findOrFail($id)->delete();

        Session::flash('deleted_literacy', 'Literacy id ' . $id . ' deleted');
        
        return redirect(route('admin.literacies.index'));
    }
}
