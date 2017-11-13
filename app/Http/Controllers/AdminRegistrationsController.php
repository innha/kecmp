<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;
use App\Registration;
use App\Type;
use App\Degree;
use App\Province;
use App\District;
use App\Sector;
use App\Cell;
use App\Village;
use App\Diocese;
use App\Parish;
use App\Chapelle;
use App\Zone;
use App\Duty;
use App\Category;
use App\Service;
use App\Commission;
use App\Choir;
use App\Status;
use Auth;
use Session;
use App\Http\Requests\StoreRegistrationRequest;

class AdminRegistrationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return 'AdminRegistrationsController@index';

        // $registrations = Registration::all();
        $registrations = Registration::orderByDesc('id')->paginate(5);

        return view('admin.app.registration.index', compact('registrations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return 'AdminRegistrationsController@create';

        $types = Type::pluck('name', 'id')->all();
        $degrees = Degree::pluck('name', 'id')->all();
        $provinces = Province::pluck('name', 'id')->all();
        $districts = District::pluck('name', 'id')->all();
        $sectors = Sector::pluck('name', 'id')->all();
        $cells = Cell::pluck('name', 'id')->all();
        $villages = Village::pluck('name', 'id')->all();
        $dioceses = Diocese::pluck('name', 'id')->all();
        $parishes = Parish::pluck('name', 'id')->all();
        $chapelles = Chapelle::pluck('name', 'id')->all();
        $zones = Zone::pluck('name', 'id')->all();
        $duties = Duty::pluck('name', 'id')->all();
        $categories = Category::pluck('name', 'id')->all();
        $services = Service::pluck('name', 'id')->all();
        $commissions = Commission::pluck('name', 'id')->all();
        $choirs = Choir::pluck('name', 'id')->all();
        $statuses = Status::pluck('name', 'id')->all();

        return view('admin.app.registration.create', compact('types', 'degrees', 'provinces', 'districts', 'sectors', 'cells', 'villages', 'dioceses', 'parishes', 'chapelles', 'zones', 'duties', 'categories', 'services', 'commissions', 'choirs', 'statuses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRegistrationRequest $request)
    {
        // dd($request->all());

        // Registration::create($request->all());        

        $user = Auth::user();

        /*
        $input_reg = $request->except(['service_id', 'status_id', 'duty_id', 'category_id', 'commission_id', 'degree_id', 'type_id']);
        $input_mem = $request->only(['service_id', 'status_id', 'duty_id', 'category_id', 'commission_id', 'degree_id', ' type_id']);

        $input_reg['user_id'] = $user->id;
        $input_mem['user_id'] = $user->id;
        
        $registration_id = $user->members()->create($input);

        $input_mem['user_id'] = $user->id;

        $registration = Registration::findOrFail($registration_id);

        $registration->member()->create($input_mem);
        */

        $input = $request->all();

        $input['user_id'] = $user->id;

        Registration::create($input);

        Session::flash('created_registration', 'Registration created');        

        // return redirect(route('admin.members.index'));

        $service_id = $request->service_id;

        if ($service_id == 1) {

            return redirect(route('admin.preachings.create'));            

        } else if ($service_id == 2) {

            return redirect(route('admin.receptions.create'));

        } else {

            return redirect(route('admin.members.index'));

        }
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

        $deleted = Registration::findOrFail($id)->delete();

        Session::flash('deleted_registration', 'Registration id ' . $id . ' deleted');
        
        return redirect(route('admin.members.index'));
    }
}
