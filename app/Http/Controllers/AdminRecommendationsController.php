<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Recommendation;
use App\Registration;
use Auth;
use Session;

class AdminRecommendationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return 'AdminRecommendationsController@index';
        $recommendations = Recommendation::paginate(5);

        return view('admin.app.recommendation.index', compact('recommendations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $registrations = Registration::pluck('regnumber', 'id')->all();

        return view('admin.app.recommendation.create', compact('registrations'));
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
            'date_issued' => 'required|date',
            'ownerName' => 'required|alpha_spaces',
            'destination' => 'required|alpha_spaces',
            'holderName' => 'required|alpha_spaces',
            'date_arrived' => 'required|date'
        ]);

        $input = $request->all();

        $user = Auth::user();

        $input['user_id'] = $user->id;

        Recommendation::create($input);

        Session::flash('created_recommendation', 'Recommendation added');

        return redirect(route('admin.recommendations.index'));        
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
        $deleted = Recommendation::findOrFail($id)->delete();

        Session::flash('deleted_recommendation', 'Recommendation id ' . $id . ' deleted');
        
        return redirect(route('admin.recommendations.index'));
    }
}
