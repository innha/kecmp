<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Suspension;
use App\Registration;
use Auth;
use Session;

class AdminSuspensionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return 'AdminSuspensionsController@index';
        $suspensions = Suspension::paginate(5);

        return view('admin.app.suspension.index', compact('suspensions'));      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $registrations = Registration::pluck('regNumber', 'id')->all();
        $regNums = Registration::pluck('regNumber', 'id')->all();

        return view('admin.app.suspension.create', compact('registrations', 'regNums'));
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
            'reason' => 'required|alpha_spaces',
            'suspendor' => 'required'
        ]);

        $input = $request->all();

        $user = Auth::user();

        $input['user_id'] = $user->id;

        Suspension::create($input);

        Session::flash('created_suspension', 'Suspension added');

        return redirect(route('admin.suspensions.index'));        
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
        $deleted = Suspension::findOrFail($id)->delete();

        Session::flash('deleted_suspension', 'Suspension id ' . $id . ' deleted');
        
        return redirect(route('admin.suspensions.index'));
    }
}
