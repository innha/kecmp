<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;
use App\Registration;
use App\Type;
use App\Task;
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
use App\Job;
use App\Category;
use App\Service;
use App\Commission;
use App\Choir;
use App\Status;
use Auth;
use Session;
use App\Http\Requests\StoreRegistrationRequest;
use App\Http\Requests\UpdateRegistrationRequest;
use DB;
use Carbon\Carbon;

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

        // dd($registrations);

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

        // $types = Type::pluck('name', 'id')->all();
        $tasks = Task::pluck('name', 'id')->all();
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
        $jobs = Job::pluck('name', 'id')->all();
        $categories = Category::pluck('name', 'id')->all();
        // $services = Service::pluck('name', 'id')->all();
        $commissions = Commission::pluck('name', 'id')->all();
        $choirs = Choir::pluck('name', 'id')->all();
        $statuses = Status::pluck('name', 'id')->all();

        return view('admin.app.registration.create', compact('tasks', 'degrees', 'provinces', 'districts', 'sectors', 'cells', 'villages', 'dioceses', 'parishes', 'chapelles', 'zones', 'duties', 'jobs', 'categories', 'services', 'commissions', 'choirs', 'statuses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRegistrationRequest $request)
    // public function store(Request $request)
    {
        DB::beginTransaction();

        try {

            // dd($request->all());
            
            // dd($this->getNextRegistrationId());

            // $Village_code = Village::findOrFail($request->village_id);

            // dd(Village::findOrFail($request->village_id)->first()->code);

            // Registration::create($request->all());        

            $user = Auth::user();

            $user_id = $user->id;

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

            $chapelle_id = $request->chapelle_id;

            $status_id = $request->status_id;

            // dd(count($request->category_id));

            if(count($request->category_id)) {
                $categories = $request->category_id;
                $category_id = reset($categories);
            } else {
                $category_id = null;
            }

            $input['category_id'] = $category_id;

            if(count($request->commission_id)) {
                $commissions = $request->commission_id;
                $commission_id = reset($commissions);
            } else {
                $commission_id = null;
            }

            $input['commission_id'] = $commission_id;

            if(count($request->task_id)) {
                $tasks = $request->task_id;
                $task_id = reset($tasks);       
            } else {
                $task_id = null;
            }

            $input['task_id'] = $task_id;

            // dd($input);

            // $chapelle_code = Chapelle::findOrFail($request->chapelle_id)->first()->code;
            $chapelle_code = DB::table('chapelles')->where('id', $chapelle_id)->first()->code;

            // dd($chapelle_code);
            
            $reg_num = $this->getNextRegistrationId($chapelle_id);

            // dd($reg_num);

            // $regNumber = $village_code . $zone_code . sprintf('%07d', $next_reg_id);
            $regNumber = $chapelle_code . sprintf('%04d', $reg_num + 1);

            // dd($regNumber);

            $input['user_id'] = $user_id;
            $input['regNumber'] = $regNumber;

            $registration = Registration::create($input);

            $registration_id = $registration->id;

            $this->storeRegistrationId($chapelle_id, $regNumber);

            // dd($registration);

            $time = Carbon::now()->format('Y-m-d H:i:s');

            if ($status_id == 3) { // suspension

                // return redirect(route('admin.preachings.create'));
                $insert_id = DB::table('suspensions')->insertGetId(
                    ['registration_id' => $registration_id,
                     'reason' => $request->reason,
                     'suspendor' => $request->suspendor,
                     'date_suspended' => $request->date_suspended,
                     'user_id' => $user_id,
                     'created_at' => $time
                    ]
                );

            } else if ($status_id == 4) { // reinstated

                // return redirect(route('admin.receptions.create'));
                $insert_id = DB::table('repentings')->insertGetId(
                    ['registration_id' => $registration_id,
                     'date_returned' => $request->date_returned,
                     'reinstator' => $request->reinstator,
                     'user_id' => $user_id,
                     'created_at' => $time
                    ]
                );

            } else if ($status_id == 5) { // dead

                // return redirect(route('admin.registrations.index'));
                $insert_id = DB::table('burials')->insertGetId(
                    ['registration_id' => $registration_id,
                     'date_died' => $request->date_died,
                     'date_buried' => $request->date_buried,
                     'burialPlace' => $request->burialPlace,
                     'user_id' => $user_id,
                     'created_at' => $time
                    ]
                );

            } else {
                $insert_id = 1;                
            }

            $insert_status_id = DB::table('reg_statuses')->insertGetId(
                ['registration_id' => $registration_id,
                 'status_id' => $registration->task_id,
                 'date_started' => $time,
                 'user_id' => $user_id,
                 'created_at' => $time
                ]
            );            

            foreach ($categories as $key => $value) {
                $insert_category_id = DB::table('reg_categories')->insertGetId(
                    ['registration_id' => $registration_id,
                     'category_id' => $value,
                     'date_started' => $time,
                     'user_id' => $user_id,
                     'created_at' => $time
                    ]
                );                
            }

            foreach ($commissions as $key => $value) {
                if($request->commission_id) {
                    $insert_commission_id = DB::table('reg_commissions')->insertGetId(
                        ['registration_id' => $registration_id,
                         'commission_id' => $value,
                         'date_started' => $time,
                         'user_id' => $user_id,
                         'created_at' => $time
                        ]
                    );                
                } else {
                    $insert_commission_id = 1;
                }
            }

            foreach ($tasks as $key => $value) {
                if($request->task_id) {
                    $insert_task_id = DB::table('reg_tasks')->insertGetId(
                        ['registration_id' => $registration_id,
                         'task_id' => $value,
                         'date_started' => $time,
                         'user_id' => $user_id,
                         'created_at' => $time
                        ]
                    );
                } else {
                    $insert_task_id = 1;
                }
            }            

            if($insert_id && $registration_id && $insert_status_id && $insert_category_id && $insert_commission_id && $insert_task_id) {

                DB::commit();

                Session::flash('created_registration', 'Registration created');

                return redirect(route('admin.registrations.index'));

            } else {
                throw new \Exception('Registration failed');
            }
        } catch(ValidationException $e) {

            DB::rollback();

            return Redirect::back()->withInput();

        } catch(\Excepttion $e) {
            DB::rollback();
        }

        DB::commit();

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
        // return $id;

        $registration = Registration::findOrFail($id);

        // dd($registration);

        // $types = Type::pluck('name', 'id')->all();
        $tasks = Task::pluck('name', 'id')->all();
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
        $jobs = Job::pluck('name', 'id')->all();
        $categories = Category::pluck('name', 'id')->all();
        // $services = Service::pluck('name', 'id')->all();
        $commissions = Commission::pluck('name', 'id')->all();
        $choirs = Choir::pluck('name', 'id')->all();
        $statuses = Status::pluck('name', 'id')->all();

        return view('admin.app.registration.edit', compact('registration', 'tasks', 'degrees', 'provinces', 'districts', 'sectors', 'cells', 'villages', 'dioceses', 'parishes', 'chapelles', 'zones', 'duties', 'jobs', 'categories', 'services', 'commissions', 'choirs', 'statuses'));        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRegistrationRequest $request, $id)
    {
        // dd($request->all());
        // dd($request->status_id);

        $user = Auth::user();

        $status_id_old = $request->status_id_old;
        $status_id = $request->status_id;        

        $input = $request->all();

        $input['user_id'] = $user->id;        

        $updated = Registration::findOrFail($id)->update($input);

        Session::flash('updated_registration', 'Registration [id:' . $id . '] updated [' . $updated . ']');

        if($status_id_old != $status_id) {

            // dd('new status');
            if($status_id == 3) {
                return redirect(route('admin.suspensions.create'));
            }

            if($status_id == 4) {
                return redirect(route('admin.repentings.create'));
            }            
        }

        return redirect(route('admin.registrations.index'));
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
        
        return redirect(route('admin.registrations.index'));
    }

    /**
     * Search registration
     *
     * @return view
     **/
    public function search(Request $request)
    {
        // dd($request->q);
        $q = $request->q;

        // dd($q);

        // $registrations = Registration::orderByDesc('id')->paginate(5);
        $registrations = Registration::where('firstName', 'LIKE', '%' . $q . '%')->orWhere('lastname', 'LIKE', '%' . $q . '%')->orWhere('email', 'LIKE', '%' . $q . '%')->orWhere('phoneOne', 'LIKE', '%' . $q . '%')->orWhere('regNumber', 'LIKE', '%' . $q . '%')->orWhere('idNumber', 'LIKE', '%' . $q . '%')->paginate(5);

        return view('admin.app.registration.index', compact('registrations'));

    }

    /**
     * Autocomplete search registration
     *
     * @return void
     **/
    public function searchAjax(Request $request)
    {
        // dd($request);

        // $q = $request->get('query', '');
        $q = $request->get('term', '');

        $registrations = Registration::where('lastName', 'LIKE', '%' . $q . '%')->orWhere('firstName', 'LIKE', '%' . $q . '%')->orWhere('email', 'LIKE', '%' . $q . '%')->orWhere('phoneOne', 'LIKE', '%' . $q . '%')->orWhere('regNumber', 'LIKE', '%' . $q . '%')->orWhere('idNumber', 'LIKE', '%' . $q . '%')->get();

        // $registrations = Type::where('name', 'LIKE', '%' . $q . '%')->get();

        $data = array();

        foreach ($registrations as $registration) {
            $data[] = array('label' => $registration->lastName . ' ' . $registration->firstName . ' ' . $registration->idNumber . ' ' . $registration->email . ' ' . $registration->phoneOne, 'value' => $registration->id, 'id' => $registration->id);
        }

        if(count($data)) {

            return $data;

        } else {

            return ['value' => 'No results found', 'id' => ''];
        }
    }

    /**
     * Get next registration id
     *
     * @return int
     **/
    public function getNextRegistrationId ($chapelle_id)
    {
        // return DB::table('registrations')->max('id') + 1;
        if(DB::table('regnums')->where('chapelle_id', $chapelle_id)->exists()) {
            return DB::table('regnums')->where('chapelle_id', $chapelle_id)->max('id');
        } else {
            return 0;
        }
    }

    public function storeRegistrationId ($chapelle_id, $regNumber) {
        $id = DB::table('regnums')->insertGetId(
            ['chapelle_id' => $chapelle_id, 'regnum' => $regNumber]
        );
    }
}
